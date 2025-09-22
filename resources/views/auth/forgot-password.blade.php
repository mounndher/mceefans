<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Forgot Password - Admin</title>

    <!-- CSS files -->
    <link href="{{ asset('backend/assets/dist/css/tabler.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/dist/css/tabler-flags.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/dist/css/tabler-payments.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/dist/css/tabler-vendors.min.css?1692870487') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/dist/css/demo.min.css?1692870487') }}" rel="stylesheet" />

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont,
                San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            --tblr-primary: #04430c;
            --tblr-primary-rgb: 59, 171, 99;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .btn-primary {
            background-color: #04430c !important;
            border-color: #3bab63 !important;
        }

        .btn-primary:hover {
            background-color: #04430c !important;
            border-color: #339b54 !important;
        }

        a {
            color: #04430c !important;
        }

        a:hover {
            color: #339b54 !important;
        }
    </style>
</head>
<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a href="." class="navbar-brand navbar-brand-autodark">
                                <img src="{{ asset('backend/assets/static/illustrations/generated-image.png') }}" height="56" alt="">
                            </a>
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4">Forgot Password</h2>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <p class="text-center mb-4">
                                    Enter your email address and we will send you a password reset link.
                                </p>

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </form>

                                <div class="mt-3 text-center">
                                    <a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('backend/assets/static/illustrations/Ancien_logo_MCEE.png') }}" height="300" class="d-block mx-auto" alt="">
                </div>
            </div>
        </div>
    </div>

    <!-- JS files -->
    <script src="{{ asset('backend/assets/dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('backend/assets/dist/js/demo.min.js?1692870487') }}" defer></script>
</body>
</html>
