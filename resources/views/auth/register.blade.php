@extends('layouts.guest')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        margin: 0;
        padding: 0;
    }

    .form-container {
        width: 420px;
        background: #fff;
        padding: 30px;
        margin: 60px auto;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        animation: fadeIn 0.6s ease-in-out;
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: bold;
        color: #1565c0;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #444;
    }

    input {
        width: 100%;
        height:40px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        transition: 0.3s;
        outline: none;
        padding-left:10px;
    }
    [type=text]{
        border-radius: 3px;
    }

    input:focus {
        border-color: #42a5f5;
        box-shadow: 0 0 5px rgba(66,165,245,0.5);
    }

    .invalid-feedback {
        font-size: 13px;
        color: #d32f2f;
        margin-top: 4px;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .btn-primary {
        background: #42a5f5;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: #1e88e5;
    }

    .link-small {
        font-size: 13px;
        text-decoration: none;
        color: #1565c0;
        transition: 0.3s;
    }

    .link-small:hover {
        color: #0d47a1;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="form-container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" 
                   class="@error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" 
                   required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="form-group" style="margin-top: 15px;">
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" 
                   class="@error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" 
                   required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="form-group" style="margin-top: 15px;">
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" 
                   class="@error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="form-group" style="margin-top: 15px;">
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password"
                   name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-actions">
            <a href="{{ route('login') }}" class="link-small">{{ __('Already registered?') }}</a>
            <button type="submit" class="btn-primary">{{ __('Register') }}</button>
        </div>
    </form>
</div>

<!-- Optional jQuery for smooth focus glow -->
 @push('scripts')
 <script>
    $(document).ready(function(){
        $("input").focus(function(){
            $(this).css("background-color", "#f1f8ff");
        }).blur(function(){
            $(this).css("background-color", "#fff");
        });
    });
</script>
 @endpush

@endsection
