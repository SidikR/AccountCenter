@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Akun {{ $data->nama_opds }}</h1>

        </div>

        <!-- Content Row -->
        <div class="row">
            {{-- @php
                dd($data);
            @endphp --}}
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Tabel Akun
                        <!-- <a class='btn btn-sm btn-warning' style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#tambahSoal">Tambah Soal</a> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @forelse ($data->user_list_opd as $key)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $key->email }}</td>
                                            <td>{{ $key->nama_lengkap }}</td>
                                            <td>
                                                <a class='btn btn-sm btn-primary'
                                                    href='{{ route('dashboard.admin.detail_akun', ['email' => $key->email]) }}'>Detail</a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('dashboard.admin.hapus_akun', ['email' => $key['email']]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Data Kosong</p>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
