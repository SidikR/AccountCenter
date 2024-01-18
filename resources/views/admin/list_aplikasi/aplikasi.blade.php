@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Aplikasi</h1>

        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col">
                <a class='btn btn-sm btn-danger mb-3' data-toggle="modal" data-target="#tambahapp"><i class="fas fa-plus"></i>
                    Tambah Aplikasi/Sistem</a>
            </div>
        </div>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            @php
                $total = 0;
            @endphp
            @forelse ($data['app'] as $key)
                <div class="col-xl-4 col-md-6 mb-4">
                    <a href="{{ route('dashboard.admin.user_akun', ['id_applications' => $key['id_applications']]) }}"
                        class="text-decoration-none">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            {{ $key['nama_aplikasi'] }}</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            @foreach ($data['jumlah'] as $jml)
                                                @if ($jml->id_applications == $key['id_applications'])
                                                    @php
                                                        $total++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            {{ $total }}
                                            <br>
                                            {{ '#' . $key['kode_aplikasi'] }}
                                        </div>
                                    </div>
                                    <div class="col text-right">
                                        <div class="mb-3">
                                            <a href="{{ route('dashboard.admin.edit_app', ['id_applications' => $key->id_applications]) }}"
                                                class="btn btn-warning btn-circle btn-sm mx-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            {{-- <a href="#" class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a> --}}
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('dashboard.admin.delete_app', ['id_applications' => $key['id_applications']]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </div>
                                        <i class="fas fa-dice-d6 fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @php
                    $total = 0; // Reset total untuk setiap iterasi
                @endphp
            @empty
                <p>Data Kosong</p>
            @endforelse
        </div>
    </div>

    <div class="modal fade" id="tambahapp" tabindex="-1" aria-labelledby="tambahakunLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Aplikasi/Sistem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.admin.aplikasi') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_aplikasi" class="col-form-label">Nama Aplikasi/Sistem</label>
                            <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi">
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
