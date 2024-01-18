<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login ACCOUNT CENTER</title>
    <link rel="shorcut icon" href="{{ asset('storage/assets/img/') }}logo.png">
    <!-- Custom fonts for this template-->
    <link href="{{ asset('sbadmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .login {
            background-color: var(--color-primary-red);
        }
    </style>
</head>
@error('email')
    <script>
        function sweet() {
            swal("Gagal!", "{{ $message }}", "error");
        }
    </script>
@enderror

@error('password')
    <script>
        function sweet() {
            swal("Gagal!", "{{ $message }}", "error");
        }
    </script>
@enderror

@error('fail')
    <script>
        function sweet() {
            swal("Gagal!", "{{ $message }}", "error");
        }
    </script>
@enderror

@error('aksesfail')
    <script>
        function sweet() {
            swal("Gagal!", "{{ $message }}", "error");
        }
    </script>
@enderror

@if (session('aksesfail'))
    <script>
        function sweet() {
            swal("Gagal!", "{{ session('aksesfail') }}", "error");
        }
    </script>
@endif

<body class="login" onload="sweet()">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg text-center m-auto"><img
                                    src="{{ asset('storage/assets/img/logo.png') }}" width="200" alt="logo">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center"><br>
                                        <h1 class="h3 text-gray-900 mb-4"><strong>ACCOUNT CENTER</strong></h1>
                                        <h1 class="h3 text-gray-900 mb-4">Silahkan Login!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                name="email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password">
                                        </div>

                                        <button type="submit" class="btn btn-danger btn-user btn-block">
                                            Login
                                        </button>


                                    </form>
                                    <hr>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sbadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sbadmin/js/sb-admin-2.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</body>

</html>
