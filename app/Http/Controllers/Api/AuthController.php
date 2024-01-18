<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LoginResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\TblApplications;
use App\Models\UserApplication;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:60',
            'password' => 'required|min:3',
            'kode_aplikasi' => 'required',
        ]);

        $User = User::where('email', $request->email)->first();

        if (!$User) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if (!Hash::check($request->password, $User->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

        $TblApplications = TblApplications::where('kode_aplikasi', $request->kode_aplikasi)->first();

        if ($TblApplications) {
            $UserApplication = UserApplication::where('id_applications', $TblApplications->id_applications)->where('email', $request->email)->first();

            if ($UserApplication) {
                $token = $User->createToken($request->email)->plainTextToken;
                // $getusers = User::with('userDetail')->findOrFail($User->id_user);
                $getusers = User::with('userDetail:email,nama_lengkap,foto_user,nip,no_hp')->findOrFail($User->id_user);
                $urlFotoUser = $getusers->userDetail->foto_user;

                return response()->json([
                    'user' => [
                        'email' => $getusers->userDetail->email,
                        'nama_lengkap' => $getusers->userDetail->nama_lengkap,
                        'role_user' => $UserApplication->role_user,
                        'status_akun' => $getusers->status_akun,
                        'foto_user' => url('storage/assets/userProfile/' . $urlFotoUser),
                        'nip' => $getusers->userDetail->nip,
                        'no_hp' => $getusers->userDetail->no_hp,
                    ],
                    'token' => $token,
                ]);
            } else {
                throw ValidationException::withMessages([
                    'fail' => ['Anda belum terdaftar pada aplikasi..'],
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'fail' => ['Gagal Login..'],
            ]);
        }
    }

    public function show($email, $kode_aplikasi)
    {
        // $users = User::with('userDetail')->findOrFail($id_user);
        $getusers = User::with('userDetail.opdDetail')->where('email', $email)->first();

        // return new UserDetailResource($users);
        $urlFotoUser = $getusers->userDetail->foto_user;

        $TblApplications = TblApplications::where('kode_aplikasi', $kode_aplikasi)->first();

        $UserApplication = UserApplication::where('id_applications', $TblApplications->id_applications)->where('email', $email)->first();


        return response()->json([
            'email' => $getusers->userDetail->email,
            'nama_lengkap' => $getusers->userDetail->nama_lengkap,
            'role_user' => $UserApplication->role_user,
            'status_akun' => $getusers->status_akun,
            'foto_user' => url('storage/assets/userProfile/' . $urlFotoUser),
            'nip' => $getusers->userDetail->nip,
            'no_hp' => $getusers->userDetail->no_hp,
            'OPD' => $getusers->userDetail->opdDetail->nama_opds
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return 'Berhasil logout';
    }
}
