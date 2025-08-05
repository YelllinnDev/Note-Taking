@extends('layouts.guest')

@section('content')
<style>
    .login-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        background-color: #f2f2f2;
    }

    .login-box {
        background-color: #fff;
        padding: 2rem;
        width:400px;
        min-width:400px;
        max-width: 400px;
        width: 100%;
        border-radius: 6px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }

    .login-title {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 0.5rem;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
        width: 100%;
        padding: 0.5rem;
        font-size: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .input-error {
        border-color: red;
    }

    .error {
        color: red;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .note {
        font-size: 0.8rem;
        color: #666;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .form-footer {
        text-align: right;
        margin-bottom: 1rem;
    }

    .btn-submit {
        width: 100%;
        padding: 0.75rem;
        font-size: 1rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    .alert.success {
        padding: 0.75rem;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        border-radius: 4px;
        margin-bottom: 1rem;
    }

</style>
<div class="login-wrapper">
    <div class="login-box">
        <h2 class="login-title">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email address</label>
                <input id="email" type="email" name="email" required autofocus
                       value="{{ old('email') }}"
                       class="@error('email') input-error @enderror">

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <small class="note">We'll never share your email with anyone else.</small>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required
                       class="@error('password') input-error @enderror">

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="checkbox-group">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            {{-- Forgot Password --}}
            <div class="form-footer">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">Log in</button>
        </form>
    </div>
</div>
@endsection
