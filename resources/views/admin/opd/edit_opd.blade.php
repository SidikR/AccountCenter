@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Organisasi Perangkat Daerah (OPD)</h1>

        </div>

        <!-- Content Row -->
        <div class="row ">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-danger">Edit</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dashboard.admin.update_opd', ['id_opds' => $data->id_opds]) }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_opds">Nama OPD</label>
                                <input type="text" class="form-control" id="nama_opds" name="nama_opds"
                                    placeholder="nama opd.." value="{{ $data->nama_opds }}">
                            </div>

                            <button type="submit" class="btn btn-sm btn-danger mt-3">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
