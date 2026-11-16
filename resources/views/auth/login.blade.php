<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin-login.css') }}">
</head>
<body>

    <div class="login-wrapper">

        <!-- Animated background blobs -->
        <div class="bg-blob blob-1"></div>
        <div class="bg-blob blob-2"></div>
        <div class="bg-blob blob-3"></div>

        <div class="login-card">

            <div class="login-logo">
                <div class="logo-icon">P</div>
                <h1>Portfolio<span>.</span></h1>
                <p>Admin Panel</p>
            </div>

            @if(session('error'))
                <div class="alert alert-error">
                    <span class="alert-icon">⚠</span>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <span class="alert-icon">✓</span>
                    {{ session('success') }}
                </div>
            @endif

            <div class="login-info">
                <h2>Welcome Back</h2>
                <p>Enter your credentials to access the admin dashboard.</p>
            </div>

            <form method="POST" action="{{ route('admin.login.submit') }}" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="admin@example.com"
                        required
                        autofocus
                        autocomplete="email"
                    >
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions-row">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="login-submit-btn">
                    <span>Sign In</span>
                </button>
            </form>

            <p class="login-note">
                🔒 Access is restricted to authorized administrators only.
            </p>

        </div>

    </div>

</body>
</html>
