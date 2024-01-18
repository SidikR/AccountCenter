<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('email') == null) {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda belum login.');
        }
        $role_user = session('role_user');

        // Redirect ke dashboard sesuai peran
        // return redirect()->route('dashboard', ['role_user' => $role_user]);
        return redirect()->to('dashboard/' . $role_user);
    }
}
