<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Opd;
use App\Models\TblApplications;


class DashboardController extends Controller
{
    public function index()
    {
        // Pengecekan apakah pengguna yang mengakses memiliki peran 'admin'
        if (session('role_user') !== 'admin') {
            // Jika bukan admin, redirect atau ambil tindakan yang sesuai
            return redirect('/')->with('aksesfail', 'Akses ditolak! Anda bukan admin.');
        }

        $data['user'] = User::all();
        $data['opd'] = Opd::all();
        $data['app'] = TblApplications::all();

        // dd($data);
        return view('admin.dashboard', compact('data'));

        // return view('admin.dashboard', $data);
    }
}
