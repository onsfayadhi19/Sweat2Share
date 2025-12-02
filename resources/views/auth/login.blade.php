@extends('layouts.guest')

@section('content')
<div class="form-wrapper">
    <div style="text-align: center; margin-bottom: 24px;">
        <img src="{{ asset('Images/primary_logo.svg') }}" alt="Logo" style="height: 50px;">
    </div>

    <h2>Sign in to your account</h2>
    <p style="text-align: center; margin-bottom: 24px; font-size: 0.95rem; color: #666;">
        Welcome back! Please enter your details.
    </p>

    @if ($errors->any())
        <div style="background: #ffebee; border-left: 4px solid #f57e30; padding: 14px; margin-bottom: 24px; border-radius: 8px; color: #d32f2f; font-size: 0.9rem;">
            <strong>Oops! Please fix the following:</strong>
            <ul style="margin-top: 8px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
            @error('email')
                <p class="helper-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="input-group">
            <label>
                Password 
                <span id="toggle-password" class="toggle-password">
                    <i class="far fa-eye-slash"></i> Hide
                </span>
            </label>
            <input type="password" name="password" id="password" required placeholder="••••••••">
            @error('password')
                <p class="helper-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember me</label>
        </div>

        <button type="submit" class="btn-primary">Sign in</button>

        <div class="form-footer">
            Don’t have an account? <a href="{{ route('register') }}">Sign up</a>
        </div>
    </form>
</div>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Figtree Font --}}
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

<style>
    /* Sweat2Share - Login Page (harmonized with Register) */
    :root {
        --sidebar-bg: #233D4D;
        --bg-color: #F8F9FB;
        --accent-orange: #F57E30;
        --text-light: #495E6F;
        --border-color: #e2e8f0;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Figtree', 'Helvetica Neue', Arial, sans-serif;
    }

    body {
        background-color: var(--text-light);
        color: var(--text-light);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 30px 20px;
    }

    .form-wrapper {
        width: 100%;
        max-width: 460px;
        background: white;
        padding: 40px 35px;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    h2 {
        color: var(--sidebar-bg);
        margin-bottom: 12px;
        font-weight: 600;
        text-align: center;
        font-size: 24px;
    }

    .input-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }

    .radio-item span, .checkbox-group label {
        color: var(--text-light);
        font-size: 14px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 16px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 15px;
        outline: none;
        transition: all 0.2s;
    }

    input:focus {
        border-color: var(--accent-orange);
        box-shadow: 0 0 0 3px rgba(245, 126, 48, 0.15);
    }

    .helper-text {
        font-size: 12px;
        color: #d32f2f;
        margin-top: 6px;
    }

    .btn-primary {
        width: 100%;
        padding: 14px;
        background: var(--accent-orange);
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        cursor: pointer;
        margin-top: 24px;
        transition: background 0.2s;
    }

    .btn-primary:hover {
        background: #e66c20;
    }

    .checkbox-group {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin: 20px 0;
        font-size: 14px;
        line-height: 1.5;
    }

    .checkbox-group input {
        width: 18px;
        height: 18px;
        accent-color: var(--accent-orange);
        margin-top: 3px;
    }

    .form-footer {
        text-align: center;
        margin-top: 24px;
        font-size: 14px;
        color: #555;
    }

    .form-footer a {
        color: var(--accent-orange);
        text-decoration: none;
        font-weight: 600;
    }

    .toggle-password {
        float: right;
        font-size: 12px;
        color: #777;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
        width: 60px;
        justify-content: flex-end;
    }

    .toggle-password:hover {
        color: var(--accent-orange);
    }
</style>

<script>
    document.getElementById('toggle-password').addEventListener('click', function () {
        const input = document.getElementById('password');
        const icon = this.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'far fa-eye';
            this.innerHTML = '<i class="far fa-eye"></i> Show';
        } else {
            input.type = 'password';
            icon.className = 'far fa-eye-slash';
            this.innerHTML = '<i class="far fa-eye-slash"></i> Hide';
        }
    });
</script>
@endsection