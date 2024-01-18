@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Akun</h1>

        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-12">
                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                @error('password')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                @error('login')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                @error('fail')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @enderror
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        Tabel Akun
                        <a class='btn btn-sm btn-danger' style="float: right;" data-toggle="modal"
                            data-target="#tambahakun"><i class="fas fa-plus"></i> Tambah
                            Akun</a>

                        <!-- <a class='btn btn-sm btn-warning' style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#tambahSoal">Tambah Soal</a> -->
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @forelse ($data as $key)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $key['email'] }}</td>
                                            <td>{{ $key['status_akun'] }}</td>
                                            <td>
                                                <a class='btn btn-sm btn-primary'
                                                    href='{{ route('dashboard.admin.detail_akun', ['email' => $key['email']]) }}'>Detail</a>
                                                <a onclick='return confirm("Apakah anda yakin mengedit data ini?")'
                                                    class='btn btn-sm btn-outline-success'
                                                    href='{{ route('dashboard.admin.edit_akun', ['email' => $key['email']]) }}'>Edit</a>
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

        <div class="modal fade" id="tambahakun" tabindex="-1" aria-labelledby="tambahakunLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrasi Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('dashboard.admin.list_akun') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_lengkap" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
