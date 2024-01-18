@extends('admin.layout.index')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Akun</h1>

        </div>

        <!-- Content Row -->
        <div class="row">

            <div class="col-10">

                <div class="card">
                    <form action="{{ route('dashboard.admin.update_akun', ['email' => $data['akun']->email]) }}"
                        method="POST" enctype="multipart/form-data">
                        <div class="card-header ">
                            @csrf
                            {{-- {{session('token'),}} --}}
                            @method('put')

                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('role')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('status_akun')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('nama_lengkap')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('no_hp')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('foto_pengguna')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="d-flex justify-content-center">
                                @if ($data['akun']->userDetail->foto_user != null)
                                    <img src="{{ asset('storage/assets/userProfile/' . $data['akun']->userDetail->foto_user) }}"
                                        alt="Photo Profile" width="170"
                                        class="img-thumbnail rounded-circle img-previewProfile">
                                @else
                                    <img src="{{ asset('sbadmin/img/undraw_profile.svg') }}" alt="Photo Profile"
                                        width="170" class="img-thumbnail rounded-circle img-previewProfile">
                                @endif
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <div class="custom-file col-6">

                                    <input type="hidden" name="foto_user_lama"
                                        value="{{ $data['akun']->userDetail->foto_user }}">
                                    <input type="file" class="custom-file-inputProfile custom-file-input" id="foto_user"
                                        name="foto_user" onchange="previewImgProfile()"><br>
                                    <label class="custom-file-labelProfile custom-file-label"
                                        for="foto_user">{{ $data['akun']->userDetail->foto_user != null ? $data['akun']->userDetail->foto_user : 'Masukkan Foto' }}</label>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">Nama Lengkap</td>
                                            <td>:</td>

                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="nama_lengkap" class="form-control"
                                                        name="nama_lengkap" placeholder="nama_lengkap"
                                                        value="{{ $data['akun']->userDetail->nama_lengkap }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Email</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="email" id="email" class="form-control" name="email"
                                                        placeholder="email" value="{{ $data['akun']->userDetail->email }}">
                                                    <div id="hasil-email" style="color:red;"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="text-bold-500">Role</td>
                                            <td>:</td>
                                            <td><select class="custom-select" name="role">
                                                    <option value="admin"
                                                        {{ $data['akun']->role == 'admin' ? 'selected' : '' }}>
                                                        Admin</option>
                                                    <option value="user"
                                                        {{ $data['akun']->role == 'user' ? 'selected' : '' }}>
                                                        User
                                                    </option>
                                                    <option value="verifikator"
                                                        {{ $data['akun']->role == 'verifikator' ? 'selected' : '' }}>
                                                        Verifikator
                                                    </option>
                                                    <option value="super_admin"
                                                        {{ $data['akun']->role == 'super_admin' ? 'selected' : '' }}>Super
                                                        Admin
                                                    </option>
                                                    <option value="bupati"
                                                        {{ $data['akun']->role == 'bupati' ? 'selected' : '' }}>
                                                        Bupati</option>
                                                    <option value="kadis"
                                                        {{ $data['akun']->role == 'kadis' ? 'selected' : '' }}>
                                                        Kepala Dinas</option>
                                                    <option value="sekdis"
                                                        {{ $data['akun']->role == 'sekdis' ? 'selected' : '' }}>
                                                        Sekretaris Dinas</option>
                                                    <option value="kabid"
                                                        {{ $data['akun']->role == 'kabid' ? 'selected' : '' }}>
                                                        Kepala Bidang</option>
                                                    <option value="kasi"
                                                        {{ $data['akun']->role == 'kasi' ? 'selected' : '' }}>
                                                        Kasi/Kasubbag</option>
                                                    <option value="staff"
                                                        {{ $data['akun']->role == 'staff' ? 'selected' : '' }}>
                                                        Staff</option>
                                                </select>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td class="text-bold-500">Status Akun</td>
                                            <td>:</td>
                                            <td>
                                                <select class="custom-select" name="status_akun">
                                                    <option value="aktif"
                                                        {{ $data['akun']->status_akun == 'aktif' ? 'selected' : '' }}>
                                                        Aktif</option>
                                                    <option value="mati"
                                                        {{ $data['akun']->status_akun == 'mati' ? 'selected' : '' }}>
                                                        Mati</option>
                                                    <option value="proses"
                                                        {{ $data['akun']->status_akun == 'proses' ? 'selected' : '' }}>
                                                        Proses
                                                    </option>
                                                    <option value="belum"
                                                        {{ $data['akun']->status_akun == 'belum' ? 'selected' : '' }}>
                                                        Belum</option>
                                                </select>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">No Telepon</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" id="no_hp" class="form-control" name="no_hp"
                                                        placeholder="No Telepon"
                                                        value="{{ $data['akun']->userDetail->no_hp }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">NIP</td>
                                            <td>:</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" id="nip" class="form-control" name="nip"
                                                        placeholder="NIP" value="{{ $data['akun']->userDetail->nip }}">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">OPD</td>
                                            <td>:</td>
                                            <td><select class="custom-select" name="id_opds">
                                                    <option value="" disabled>-- Pilih OPD --</option>
                                                    @foreach ($data['opd'] as $key)
                                                        <option value="{{ $key->id_opds }}"
                                                            {{ $key->id_opds == $data['akun']->userDetail->id_opds ? 'selected' : '' }}>
                                                            {{ $key->nama_opds }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><br>
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-danger" id="submit">Simpan</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            selesai();
        });


        function selesai() {
            setTimeout(function() {
                selesai();
                email();
            }, 200);
        }

        function email() {
            $.getJSON("{{ route('cek_email_all', ['email' => $data['akun']->email]) }}", function(data) {
                $("#email").empty();
                $('#email').keyup(function() {
                    $.each(data.result, function() {
                        if (this['email'] == $('#email').val()) {
                            // $('#emailni').val($('#emailya').val());
                            var y = 'Email Sudah Terpakai';
                            document.getElementById("hasil-email").innerHTML = y;
                            $("#submit").prop('disabled', true);
                        }
                    });
                });

            });
        }


        $('#email').keyup(function() {
            // data span dan field
            var x = document.getElementById("email").value;
            var y = document.getElementById("hasil-email").value;
            var z = ''
            if (x != y) {
                document.getElementById("hasil-email").innerHTML = z;
                $("#submit").prop('disabled', false);
            }
        });

        function previewImgProfile() {
            const sampul = document.querySelector('#foto_user');
            const sampulLabel = document.querySelector('.custom-file-labelProfile');
            const imgPreview = document.querySelector('.img-previewProfile');

            sampulLabel.textContent = sampul.files[0].name;

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
@endsection
