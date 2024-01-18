@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Akun Pada Aplikasi {{ $data['list']->nama_aplikasi }}</h1>

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
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('tambah_akun_app') }}"
                            method="POST">
                            @csrf
                            @method('POST')

                            <button type="submit" class="btn btn-danger btn-sm mb-3"><i class="fas fa-plus "></i>
                                Tambahkan Akun</button>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Aplikasi</th>
                                            <th>Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $counter = 1;
                                        @endphp
                                        @forelse ($data['akun'] as $keyacc)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $keyacc->email }}</td>
                                                <td>{{ $keyacc->userDetail->nama_lengkap }}</td>
                                                <td>
                                                    <fieldset disabled>
                                                        <select class="custom-select disabled">
                                                            @forelse ($data['app'] as $key)
                                                                <option value="{{ $key->id_applications }}"
                                                                    {{ $key->id_applications == $data['list']->id_applications ? 'selected' : '' }}>
                                                                    {{ $key->nama_aplikasi }}
                                                                </option>
                                                            @empty
                                                                <p>Data Kosong</p>
                                                            @endforelse
                                                        </select>
                                                    </fieldset>
                                                    <input type="hidden" name="id_applications"
                                                        value="{{ $data['list']->id_applications }}">
                                                </td>
                                                <td align="center">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="id_applicationsacc[]" value="{{ $keyacc->email }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">Data Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
