@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Akun {{ $data['list']->nama_aplikasi }}</h1>

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
                        <a class='btn btn-sm btn-danger' style="float: right;"
                            href='{{ route('halaman_tambah_akun_app', ['id_applications' => $data['list']->id_applications]) }}'><i
                                class="fas fa-plus"></i> Tambah</a>
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
                                    @forelse ($data['list']->user_list as $key)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $key->user_list_akun->email }}</td>
                                            <td>{{ $key->user_list_akun->nama_lengkap }}</td>
                                            <td>
                                                <a class='btn btn-sm btn-primary'
                                                    href='{{ route('detail_akun', ['email' => $key->user_list_akun->email]) }}'>Detail</a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('hapus_akun_app', ['email' => $key->user_list_akun->email, 'id_applications' => $data['list']->id_applications]) }}"
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
    </div>
@endsection
