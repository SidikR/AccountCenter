<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\TblApplications;
use App\Models\UserApplication;
use App\Models\UserDetails;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function index(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|max:60',
            'password' => 'required|min:3',
        ]);

        $User = User::where('email', $request->email)->first();

        // dd($user);

        if (!$User) {
            throw ValidationException::withMessages([
                'email' => ['Email atau Password anda salah, silahkan coba lagi..'],
            ]);
        }

        if (!Hash::check($request->password, $User->password)) {
            throw ValidationException::withMessages([
                'password' => ['Email atau Password anda salah, silahkan coba lagi..'],
            ]);
        }

        $TblApplications = TblApplications::where('kode_aplikasi', 'SI002')->first();

        if ($TblApplications) {
            $UserApplication = UserApplication::where('id_applications', $TblApplications->id_applications)->where('email', $request->email)->first();

            if ($UserApplication) {

                if ($UserApplication->role_user == 'admin' || $UserApplication->role_user == 'user') {
                    if (Auth::attempt($credentials)) {

                        $request->session()->regenerate();
                        $userDetail = UserDetails::where('email', $request->email)->first();
                        $request->session()->put('email', $userDetail->email);
                        $request->session()->put('nama_lengkap', $userDetail->nama_lengkap);
                        $request->session()->put('foto_user', $userDetail->foto_user);
                        $request->session()->put('role_user', $UserApplication->role_user);

                        return redirect()->intended('dashboard');
                    }
                } else {
                    return back()->withErrors([
                        'fail' => 'Gagal login..',
                    ]);
                }
            } else {

                throw ValidationException::withMessages([
                    'fail' => ['Anda tidak terdaftar pada aplikasi..'],
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'fail' => ['Aplikasi tidak terdaftar..'],
            ]);
        }
        // $token = $User->createToken('user login')->plainTextToken;

        // return new UserResource($User);


    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }

    public function cek_email_all($email)
    {
        // $data = User::where('email', $email)->first();
        $data = User::where('email', '!=', $email)
            ->select('email')
            ->get()
            ->toArray();
        echo json_encode(array("result" => $data));
        // return response()->json(Auth::user());
    }

    public function cek_email_profile()
    {
        // $data = User::where('email', $email)->first();
        $data = User::where('email', '!=', session('email'))
            ->select('email')
            ->get()
            ->toArray();
        echo json_encode(array("result" => $data));
        // return response()->json(Auth::user());
    }
}
