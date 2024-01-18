<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApplicationResource;
use App\Models\TblApplications;
use App\Models\UserDetails;
use App\Models\User;
use App\Models\UserApplication;

class ApplicationController extends Controller
{
    public function index()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data['app'] = TblApplications::all();
        $data['jumlah'] = UserApplication::all();

        return view('admin.list_aplikasi.aplikasi', compact('data'));
    }

    public function user_akun($id_applications)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data['list'] = TblApplications::with('user_list.user_list_akun')->where('id_applications', $id_applications)->first();
        $data['app'] = TblApplications::all();

        // $data['akun'] = User::with('userDetail')->get();
        // $data['akun'] = User::with('userDetail')->paginate(5);
        $filteredAkun = User::with('userDetail')->whereNotIn('email', optional($data['list'])->user_list->pluck('user_list_akun.email'))->get();

        $data['akun'] = $filteredAkun;

        return view('admin.list_aplikasi.list_akun_aplikasi', compact('data'));
    }


    public function create_app(Request $request)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $request->validate([
            'nama_aplikasi' => 'required'
        ]);
        $dataApp = [
            'nama_aplikasi' => $request->nama_aplikasi,
            'kode_aplikasi' => 'SI' . str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT)
        ];
        $app = TblApplications::create($dataApp);
        if ($app) {
            return back()->with(['success' => 'Aplikasi Berhasil ditambah!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'Aplikasi gagal ditambah']);
        }
    }

    public function edit_app($id_applications)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }


        $data = TblApplications::where('id_applications', $id_applications)->first();
        return view('admin.list_aplikasi.edit_app', compact('data'));
    }

    public function update_app(Request $request, $id_applications)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $request->validate([
            'nama_aplikasi' => 'required',
        ]);

        $updateData = [
            'nama_aplikasi' => $request->nama_aplikasi,
        ];

        $data = TblApplications::where('id_applications', $id_applications)->first();
        $app = $data->update($updateData);

        if ($app) {
            return redirect()->route('dashboard.admin.aplikasi')->with(['success' => 'Aplikasi Berhasil diupdate!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'Aplikasi gagal diupdate']);
        }
    }

    public function delete_app($id_applications)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $app = TblApplications::where('id_applications', $id_applications)->first();

        if (!$app) {
            return back()->withErrors(['fail' => 'Aplikasi tidak ada']);
        }

        $user = UserApplication::where('id_applications', $id_applications)->first();

        if ($user) {
            return back()->with(['fail' => 'Aplikasi gagal dihapus']);
        }

        $delete = $app->delete();

        if ($delete) {
            return back()->with(['success' => 'Aplikasi Berhasil dihapus!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'Aplikasi gagal dihapus']);
        }
    }
}
