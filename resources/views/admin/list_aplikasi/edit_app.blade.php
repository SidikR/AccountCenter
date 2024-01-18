@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Aplikasi/Sistem</h1>

        </div>

        <!-- Content Row -->
        <div class="row ">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">Edit</h6>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ route('dashboard.admin.update_app', ['id_applications' => $data->id_applications]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_aplikasi">Nama Aplikasi/Sistem</label>
                                <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi"
                                    placeholder="nama aplikasi.." value="{{ $data->nama_aplikasi }}">
                            </div>

                            <button type="submit" class="btn btn-sm btn-danger mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
