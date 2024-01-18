<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\OpdResource;
use App\Models\Opd;
use App\Models\UserDetails;


class OpdController extends Controller
{
    public function index()
    {

        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }


        $data['data'] = Opd::all();
        $data['jumlah'] = UserDetails::all();


        // return OpdResource::collection($opd);
        return view('admin.opd.opd', compact('data'));
    }

    public function get_user_opd($id_opds)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data = Opd::with('user_list_opd')->where('id_opds', $id_opds)->first();
        return view('admin.opd.list_akun_opd', compact('data'));
    }

    public function create_opd(Request $request)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $request->validate([
            'nama_opds' => 'required'
        ]);
        $dataOpd = [
            'nama_opds' => $request->nama_opds,
        ];
        $opd = Opd::create(($dataOpd));
        if ($opd) {
            return back()->with(['success' => 'OPD Berhasil ditambah!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'OPD gagal ditambah']);
        }
    }

    public function edit_opd($id_opds)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data = Opd::where('id_opds', $id_opds)->first();
        return view('admin.opd.edit_opd', compact('data'));
    }

    public function update_opd(Request $request, $id_opds)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $request->validate([
            'nama_opds' => 'required',
        ]);

        $updateData = [
            'nama_opds' => $request->nama_opds,
        ];

        $data = Opd::where('id_opds', $id_opds)->first();
        $opd = $data->update($updateData);

        if ($opd) {
            return redirect()->route('dashboard.admin.opd')->with(['success' => 'OPD Berhasil diupdate!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'OPD gagal diupdate']);
        }
    }

    public function delete_opd($id_opds)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $opd = Opd::where('id_opds', $id_opds)->first();

        if (!$opd) {
            return back()->withErrors(['fail' => 'OPD tidak ada']);
        }

        $user = UserDetails::where('id_opds', $id_opds)->first();

        if ($user) {
            return back()->with(['fail' => 'OPD gagal dihapus']);
        }

        $delete = $opd->delete();

        if ($delete) {
            return back()->with(['success' => 'OPD Berhasil dihapus!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'OPD gagal dihapus']);
        }
    }
}
