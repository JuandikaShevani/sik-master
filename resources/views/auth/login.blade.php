<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} - Login</title>

    <link rel="icon" href="{{ Storage::disk('public')->url($setting->path_image ?? '') }}" type="image/*">

    <!-- icon img -->
    <link rel="icon" href="{{ asset('AdminLTE/dist/img/AdminLTELogo.png') }}" type="image/*">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        @font-face {
            font-family: 'Roboto';
            src: url('{{ asset('fonts/Roboto-Regular.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Roboto';
            src: url('{{ asset('fonts/Roboto-Bold.ttf') }}') format('truetype');
            font-weight: bold;
            font-style: normal;
        }

        .login {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('{{ asset('img/jumbotron-bg.jpg') }}');
            background-size: cover;
            background-position: absoulute;
        }

        .bg-image::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3));
        }

        .login-heading {
            font-weight: 300 bold;
        }

        .login .form-control {
            height: calc(1.5em + 1rem + 2px);
            padding: 0.5rem 1rem;
            line-height: 1.5;
            border-radius: 0.3rem;
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1.5rem;
        }

        .input-group-text {
            background-color: transparent;
            border: none;
        }

        .open-eye,
        .closed-eye {
            width: 20px;
            height: auto;
            cursor: pointer;
        }

        .closed-eye {
            display: none;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
            <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <h4 class="login-heading mb-4" style="text-align: center">Selamat Datang</h4>
                                {{-- Form --}}
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email">Email :</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password">Password :</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" value="{{ old('password') }}">
                                            <div class="input-group-append">
                                                <span toggle="#password" class="input-group-text eye-toggle">
                                                    <i class="fas fa-eye open-eye"></i>
                                                    <i class="fas fa-eye-slash closed-eye" style="display: none;"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <button class="btn btn-lg btn-success btn-login">
                                            <i class="fas fa-sign-in-alt"></i> Masuk
                                        </button>
                                        <a href="{{ route('landing_page') }}" class="btn btn-lg btn-info btn-login">
                                            <i class="fas fa-arrow-rotate-left"></i> Kembali
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eyeToggle = document.querySelector('.eye-toggle');
            const passwordInput = document.querySelector('#password');
            const openEyeIcon = document.querySelector('.open-eye');
            const closedEyeIcon = document.querySelector('.closed-eye');

            eyeToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                openEyeIcon.style.display = type === 'password' ? 'inline' : 'none';
                closedEyeIcon.style.display = type === 'password' ? 'none' : 'inline';
            });
        });
    </script>
</body>

</html>
