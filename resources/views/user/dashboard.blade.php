@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

        </div>

        <div class="row mt-5">
            {{-- <div class="col-sm-6 text-center">
                <img width="200" src="{{ asset('storage/assets/img/logo.png') }}" alt="">
            </div> --}}
            <div class="col-sm-12 text-center mt-5 ">
                <h1 class="font-weight-bold text-danger" style="font-size: 30px;">Selamat Datang!</h1>
                <h1 class="text-danger" style="font-size: 35px;">Di ACCOUNT CENTER </h1>
            </div>

        </div>
    </div>
@endsection
