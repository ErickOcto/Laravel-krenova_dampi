<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="./template/assets/css/bootstrap.css">

    <link rel="shortcut icon" href="./template/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="./template/assets/css/app.css">
</head>

<body>
    <div id="auth">

<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="./template/assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Masuk</h3>
                        <p>Mohon masukkan email dan password</p>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <label for="email">Email</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="email" name="email">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mt-2">
                            {{-- @if (Route::has('password.request'))
                                <a class="float-end" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif --}}
                            <div class="clearfix">
                                <label for="password">Password</label>
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password" name="password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class=" d-grid mt-5">
                            <button class="btn btn-primary float-end w-full">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="./template/assets/js/feather-icons/feather.min.js"></script>
    <script src="./template/assets/js/app.js"></script>

    <script src="./template/assets/js/main.js"></script>
</body>

</html>
