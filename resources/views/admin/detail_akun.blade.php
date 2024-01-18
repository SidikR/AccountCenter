@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Akun</h1>

        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-10">

                <div class="card">
                    <div class="card-header text-center">
                        @if ($data->userDetail->foto_user != null)
                            <img src="{{ asset('storage/assets/userProfile/' . $data->userDetail->foto_user) }}"
                                alt="Photo Profile" width="170" class="img-thumbnail rounded-circle">
                        @else
                            <img src="{{ asset('sbadmin/img/undraw_profile.svg') }}" alt="Photo Profile" width="170"
                                class="img-thumbnail rounded-circle">
                        @endif


                        {{-- @php

                            dd($data->userDetails);
                        @endphp --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <tbody>
                                    <tr>
                                        <td class="text-bold-500">Nama Lengkap</td>
                                        <td>:</td>

                                        <td>{{ $data->userDetail->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">Email</td>
                                        <td>:</td>
                                        <td>{{ $data->userDetail->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">Status Akun</td>
                                        <td>:</td>
                                        <td>{{ $data->status_akun }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">No Telepon</td>
                                        <td>:</td>
                                        <td>{{ $data->userDetail->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">NIP</td>
                                        <td>:</td>
                                        <td>{{ $data->userDetail->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">OPD</td>
                                        <td>:</td>
                                        <td>
                                            @if ($data->userDetail && $data->userDetail->opdDetail)
                                                {{ $data->userDetail->opdDetail->nama_opds ?? '' }}
                                            @else
                                                <!-- Jika salah satu relasi null -->
                                                {{ '' }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br>
                        <div class="d-flex justify-content-start">
                            <a href="{{ route('dashboard.admin.edit_akun', ['email' => $data->userDetail->email]) }}"
                                class="btn btn-sm btn-danger">Edit
                                Profile</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
