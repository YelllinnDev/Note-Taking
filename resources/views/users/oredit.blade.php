@extends('layouts.app')

@section('title', 'Register')

@section('content')

<style>
    .register-div {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .register-form {
        background: white;
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .register-form h2 {
        margin-bottom: 24px;
        font-weight: 600;
        color: #333;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: #444;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s;
        outline: none;
    }

    input:focus {
        border-color: #6c63ff;
    }

    button {
        display: inline-block;
        width: 100%;
        background: linear-gradient(to right, #6c63ff, #4e54c8);
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 10px;
        padding: 14px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background: linear-gradient(to right, #574b90, #4e54c8);
    }
</style>

<div class="register-div">
    <form method="POST" action="{{ route('users.update', $user->id) }}"  class="register-form">
        
        @csrf
        @method('PUT')

        <h2>Edit User</h2>

        <!-- Username Field -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="name" placeholder="Enter your username" required value="{{ old('name', $user->name) }}"/>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email"  value="{{ old('email', $user->email) }}" required />
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required />
            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Update User</button>
    </form>
</div>

@endsection

