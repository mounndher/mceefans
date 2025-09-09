<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Register - My App</title>

    <!-- Tabler CSS -->
    <link href="{{ asset('backend/assets/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/demo.min.css') }}" rel="stylesheet"/>

    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body class="d-flex flex-column">
    <script src="{{ asset('backend/assets/dist/js/demo-theme.min.js') }}"></script>

    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="/" class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('backend/assets/static/logo.svg') }}" width="110" height="32" alt="Logo" class="navbar-brand-image">
          </a>
        </div>

        <!-- Laravel Register Form with Tabler Style -->
        <form method="POST" action="{{ route('register') }}" class="card card-md">
          @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>

            <!-- Name -->
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input id="name" type="text" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus autocomplete="name">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input id="email" type="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required autocomplete="username">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input id="password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                required autocomplete="new-password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input id="password_confirmation" type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                required autocomplete="new-password">
              @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>
          </div>
        </form>

        <div class="text-center text-secondary mt-3">
          Already have an account?
          <a href="{{ route('login') }}" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>

    <!-- Tabler JS -->
    <script src="{{ asset('backend/assets/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('backend/assets/dist/js/demo.min.js') }}" defer></script>
  </body>
</html>
