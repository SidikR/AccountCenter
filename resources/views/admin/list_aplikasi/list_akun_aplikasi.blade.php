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
                        <a class='btn btn-sm btn-danger' style="float: right;" data-toggle="modal"
                            data-target="#tambahakun">Tambah
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
                                        <th>Nama</th>
                                        <th>Role</th>
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
                                            <td>{{ $key->role_user }}</td>
                                            <td>
                                                <a class='btn btn-sm btn-primary'
                                                    href='{{ route('dashboard.admin.detail_akun', ['email' => $key->user_list_akun->email]) }}'>Detail</a>
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('dashboard.admin.hapus_akun_app', ['email' => $key->user_list_akun->email, 'id_applications' => $data['list']->id_applications]) }}"
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
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Akun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                action="{{ route('dashboard.admin.tambah_akun_app') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-danger btn-sm mb-3"><i
                                                class="fas fa-plus "></i>
                                            Tambah</button>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3 justify-content-end">
                                            <input type="text" class="form-control bg-light border-0 small"
                                                placeholder="Search for..." aria-label="Search"
                                                aria-describedby="basic-addon2" id="searchInput">
                                            <div class="input-group-append">
                                                <button class="btn btn-danger" disabled type="button">
                                                    <i class="fas fa-search fa-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                    <thead>
                                        <tr align="center">
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Nama</th>
                                            <th>Aplikasi</th>
                                            <th>Role</th>
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
                                                <td>
                                                    <select class="custom-select" name="role_user[]">
                                                        <option value="user" disabled selected>-- Pilih --</option>
                                                        <option value="admin">
                                                            Admin</option>
                                                        <option value="user">
                                                            User
                                                        </option>
                                                        <option value="verifikator">
                                                            Verifikator
                                                        </option>
                                                        <option value="super_admin">
                                                            Super Admin
                                                        </option>
                                                        <option value="bupati">
                                                            Bupati</option>
                                                        <option value="kadis">
                                                            Kepala Dinas</option>
                                                        <option value="sekdis">
                                                            Sekretaris Dinas</option>
                                                        <option value="kabid">
                                                            Kepala Bidang</option>
                                                        <option value="kasi">
                                                            Kasi/Kasubbag</option>
                                                        <option value="staff">
                                                            Staff</option>
                                                    </select>
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
                                {{-- {{ $data['akun']->links() }} --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <script>
            // Fungsi untuk melakukan pencarian
            function search() {
                // Ambil nilai input pencarian
                var keyword = document.getElementById('searchInput').value.toUpperCase();

                // Ambil semua baris pada tabel
                var rows = document.getElementById('dataTable2').getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                // Loop melalui setiap baris tabel
                for (var i = 0; i < rows.length; i++) {
                    var rowData = rows[i].getElementsByTagName('td');

                    // Inisialisasi status pencarian menjadi tidak ditemukan
                    var found = false;

                    // Loop melalui setiap sel pada baris
                    for (var j = 0; j < rowData.length; j++) {
                        // Cek apakah nilai sel mengandung kata kunci pencarian
                        if (rowData[j].innerHTML.toUpperCase().indexOf(keyword) > -1) {
                            found = true;
                            break;
                        }
                    }

                    // Tampilkan atau sembunyikan baris berdasarkan status pencarian
                    if (found) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }

            // Event listener untuk memanggil fungsi pencarian saat nilai input berubah
            document.getElementById('searchInput').addEventListener('input', search);
        </script>
    @endsection
