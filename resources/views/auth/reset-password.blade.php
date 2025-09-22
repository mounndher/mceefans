<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Réinitialiser le mot de passe - MceeFans</title>

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
<script src="{{ asset('backend/assets/dist/js/demo-theme.min.js?1692870487') }}"></script>

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
                            <h2 class="h2 text-center mb-4">Réinitialiser le mot de passe</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $request->email) }}"
                                           required autofocus autocomplete="username">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input id="password" type="password" name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           required autocomplete="new-password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           required autocomplete="new-password">
                                    @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary">
                                     Réinitialiser le mot de passe
                                    </button>
                                </div>

                            </form>
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
