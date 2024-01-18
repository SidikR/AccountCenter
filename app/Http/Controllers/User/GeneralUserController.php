<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\TblApplications;
use App\Models\UserApplication;
use App\Models\Opd;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class GeneralUserController extends Controller
{
    public function index()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'user') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }
        // $TblApplications = TblApplications::where('kode_aplikasi', 'SI002')->first();
        // $UserApplication = UserApplication::where('id_applications', $TblApplications->id_applications)->where('email', session('email'))->first();

        // $data['role_user'] = $UserApplication->role_user;
        // $data['akun'] = User::when(['userDetail', 'userDetail.opdDetail'])->where('email', session('email'))->first();
        return view('user.dashboard');
    }

    public function profile()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'user') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }
        // $TblApplications = TblApplications::where('kode_aplikasi', 'SI002')->first();
        // $UserApplication = UserApplication::where('id_applications', $TblApplications->id_applications)->where('email', session('email'))->first();

        // $data['role_user'] = $UserApplication->role_user;
        $data['akun'] = User::when(['userDetail', 'userDetail.opdDetail'])->where('email', session('email'))->first();
        return view('user.profile.profile', compact('data'));
    }

    public function edit_profile()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'user') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }
        $data['akun'] = User::when(['userDetail', 'userDetail.opdDetail'])->where('email', session('email'))->first();
        // $TblApplications = TblApplications::where('kode_aplikasi', 'SI002')->first();
        // $UserApplication = UserApplication::where('id_applications', $TblApplications->id_applications)->where('email', session('email'))->first();

        // $data['role_user'] = $UserApplication->role_user;
        $data['opd'] = OPD::all();

        return view('user.profile.edit_profile', compact('data'));
    }

    public function update_profile(Request $request, $email)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'user') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }
        // dd($request);
        $request->validate([
            'email' => 'required|email',
            'status_akun' => 'required',
            'nama_lengkap' => 'required',
            'no_hp' => 'nullable|max:15',
            'nip' => 'nullable|max:20',
            'id_opds' => 'nullable|max:55',
            'foto_user' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $updateDataUser = [
            'email' => $request->email,
            'status_akun' => $request->status_akun
        ];

        if ($request->file('foto_user') != '' || $request->file('foto_user') != null) {
            $filename = $this->RandomString();
            $extension = $request->file('foto_user')->extension();
            $image = $filename . '.' . $extension;
            $inFolder = $request->file('foto_user')->storeAs('public/assets/userProfile', $image);

            if ($request->input('foto_user_lama') != null) {
                # code...
                Storage::delete('public/assets/userProfile/' . $request->foto_user_lama);
            }
            // $image = $request->file('foto_user');
            // $image->storeAs('public/assets/userProfile', $image->hashName());
            // Storage::putFileAs('image', new File('/assets/userProfile/' . $request->file('foto_pengguna')), $image);
            $updateUserDetail = [
                'email' => $request->email,
                'nama_lengkap' => $request->nama_lengkap,
                'no_hp' => $request->no_hp,
                'nip' => $request->nip,
                'id_opds' => $request->id_opds,
                'foto_user' => $image
            ];

            $UserDetails = UserDetails::where('email', $email)->first();
            $UserDetails->update($updateUserDetail);
            $request->session()->put('foto_user', $image);
        } else {
            $updateUserDetail = [
                'email' => $request->email,
                'nama_lengkap' => $request->nama_lengkap,
                'no_hp' => $request->no_hp,
                'nip' => $request->nip,
                'id_opds' => $request->id_opds,
                'foto_user' => $request->foto_user_lama
            ];
            // $UserDetails = UserDetails::where('email', $request->email)->first();
            $UserDetails = UserDetails::where('email', $email)->first();
            $UserDetails->update($updateUserDetail);
        }
        // dd($request);
        $users = User::where('email', $email)->first();
        $update =  $users->update($updateDataUser);
        if ($update) {
            $request->session()->put('email', $request->email);
            $request->session()->put('nama_lengkap', $request->nama_lengkap);

            $updateUserApp = [
                'email' => $request->email,
            ];
            UserApplication::where('email', $email)->update($updateUserApp);

            return redirect()->route('dashboard.user.profile')->with(['success' => 'Profile Berhasil diupdate!']); // Ganti dengan rute setelah login berhasil
        } else {
            return redirect()->route('dashboard.user.profile')->with(['fail' => 'Profile Gagal diupdate!']); // Ganti dengan rute setelah login berhasil
        }
    }

    function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }
        return $randstring;
    }
}
