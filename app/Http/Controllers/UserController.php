<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserDetailResource;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Opd;
use App\Models\UserApplication;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data = User::all();

        return view('admin.list_akun', compact('data'));
    }

    public function create_akun(Request $request)
    {

        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }


        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3',
            'nama_lengkap' => 'required'
        ]);
        $dataUser = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'status_akun' => 'aktif'
        ];
        $dataUserDetails = [
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap
        ];
        $user = User::create(($dataUser));
        $UserDetails = UserDetails::create(($dataUserDetails));
        if ($user) {
            return redirect()->route('dashboard.admin.list_akun')->with(['success' => 'Akun Berhasil ditambah!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'Akun gagal ditambah']);
        }
    }

    public function show_akun($email)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data = User::when(['userDetail', 'userDetail.opdDetail'])->where('email', $email)->first();
        return view('admin.detail_akun', compact('data'));
    }

    public function edit_akun($email)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data['akun'] = User::with(['userDetail', 'userDetail.opdDetail'])->where('email', $email)->first();
        $data['opd'] = OPD::all();

        return view('admin.edit_akun', compact('data'));
    }
    public function update_akun(Request $request, $email)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
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
        // $photo = fopen('photo.jpg', 'r');
        $updateDataUser = [
            'email' => $request->email,
            // 'password' => $request->password,
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
            if (session('email') == $email) {
                $request->session()->put('foto_user', $image);
            }
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
            if (session('email') == $email) {
                $request->session()->put('email', $request->email);
                $request->session()->put('nama_lengkap', $request->nama_lengkap);
            }
            $updateUserApp = [
                'email' => $request->email,
            ];
            UserApplication::where('email', $email)->update($updateUserApp);
            // $usersApp->update($updateUserApp);
            return redirect()->route('dashboard.admin.list_akun')->with(['success' => 'Akun Berhasil diupdate!']); // Ganti dengan rute setelah login berhasil
        } else {
            return redirect()->route('dashboard.admin.list_akun')->with(['fail' => 'Akun Gagal diupdate!']); // Ganti dengan rute setelah login berhasil
        }
    }

    public function hapus_akun($email)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $users = User::with('userDetail')->where('email', $email)->first();

        if (!$users) {
            return redirect()->route('list_akun')->with(['fail' => 'Akun tidak ada!']);
        }
        if ($users->foto_user != null) {
            # code...
            Storage::delete('public/assets/userProfile/' . $users->foto_user);
        }
        $delete = $users->delete();
        $usersDetail = UserDetails::where('email', $email)->first();
        $usersDetail->delete();

        if ($delete) {
            return redirect()->route('dashboard.admin.list_akun')->with(['success' => 'Akun Berhasil dihapus!']); // Ganti dengan rute setelah login berhasil
        } else {
            return redirect()->route('dashboard.admin.list_akun')->with(['fail' => 'Akun Gagal dihapus!']); // Ganti dengan rute setelah login berhasil
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
