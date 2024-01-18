<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserApplicationResource;
use App\Http\Resources\ApplicationResource;
use App\Models\UserApplication;
use App\Models\TblApplications;
use App\Models\User;


class UserApplicationController extends Controller
{
    public function hal_tambah_akun_app(Request $request, $id_applications)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data['list'] = TblApplications::with('user_list.user_list_akun')->where('id_applications', $id_applications)->first();
        $data['app'] = TblApplications::all();
        // Menyaring data yang ada di $data['list'] agar tidak ditampilkan di $data['akun']
        $filteredAkun = User::with('userDetail')->whereNotIn('email', optional($data['list'])->user_list->pluck('user_list_akun.email'))->get();

        $data['akun'] = $filteredAkun;

        return view('admin.list_aplikasi.tambah_app', compact('data'));
    }

    public function tambah_akun_app(Request $request)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $request->validate([
            'id_applicationsacc' => 'required|array'
        ]);

        // Ambil email dari formulir
        $emails = $request->input('id_applicationsacc');

        // Ambil id_applications dari formulir (gunakan $request->input jika namanya 'id_applications')
        $idApplications = $request->input('id_applications');

        // Loop untuk menambahkan setiap data
        foreach ($emails as $key => $email) {
            // Pastikan untuk menyesuaikan cara Anda mendapatkan nilai email dan id_applications
            $dataUser = [
                'email' => $email,
                'id_applications' => $idApplications,
                'role_user' => $request->input('role_user')[$key],
            ];

            // Gunakan create untuk membuat dan menyimpan data
            $user = UserApplication::create($dataUser);

            // Lakukan penanganan kesalahan atau pesan keberhasilan sesuai kebutuhan
            if (!$user) {
                return back()->withErrors(['fail' => 'Akun gagal ditambah']);
            }
        }
        return redirect()->route('dashboard.admin.user_akun', ['id_applications' => $idApplications])->with(['success' => 'Akun Berhasil ditambah!']);
    }


    public function hapus_akun_app($email, $id_applications)
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $userApplication = UserApplication::where('email', $email)->where('id_applications', $id_applications)->first();

        if (!$userApplication) {
            return back()->withErrors(['fail' => 'Akun gagal dihapus']);
        }

        $user = $userApplication->delete();

        if ($user) {
            return back()->with(['success' => 'Akun berhasil dihapus!']); // Ganti dengan rute setelah login berhasil
        } else {
            return back()->withErrors(['fail' => 'Akun gagal dihapus']);
        }
    }
}
