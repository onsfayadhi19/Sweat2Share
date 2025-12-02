@extends('layouts.guest')

@section('content')
<div class="form-wrapper">
    <div style="text-align: center; margin-bottom: 24px;">
        <img src="{{ asset('Images/primary_logo.svg') }}" alt="Logo" style="height: 50px;">
    </div>

    <h2>Create your account</h2>
    <p style="text-align: center; margin-bottom: 24px; font-size: 0.95rem; color: #666;">
        Join the Sweat2Share community today
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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group">
            <label>Profile name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ex: Ines Fayadhi">
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com">
        </div>

        <div class="input-group">
            <label>
                Password 
                <span id="toggle-password" class="toggle-password">
                    <i class="far fa-eye-slash"></i> Hide
                </span>
            </label>
            <input type="password" name="password" id="password" required placeholder="••••••••">
            <p class="helper-text">At least 8 characters with letters, numbers & symbols</p>
        </div>

        <div class="input-group">
            <label>
                Confirm Password 
                <span id="toggle-confirm-password" class="toggle-password">
                    <i class="far fa-eye-slash"></i> Hide
                </span>
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="••••••••">
        </div>

        <div class="input-group">
            <label>Role <span style="font-weight: normal; color: #777;">(required)</span></label>
            <select name="role" required>
                <option value="">Select your role</option>
                <option value="Citizen" {{ old('role') == 'Citizen' ? 'selected' : '' }}>Citizen</option>
                <option value="Partner" {{ old('role') == 'Partner' ? 'selected' : '' }}>Partner</option>
                <option value="Association" {{ old('role') == 'Association' ? 'selected' : '' }}>Association</option>
                <option value="ContentCreator" {{ old('role') == 'ContentCreator' ? 'selected' : '' }}>Content Creator</option>
                <option value="Coach" {{ old('role') == 'Coach' ? 'selected' : '' }}>Coach</option>
                <option value="Sponsor" {{ old('role') == 'Sponsor' ? 'selected' : '' }}>Sponsor</option>
                <option value="HealthInstitution" {{ old('role') == 'HealthInstitution' ? 'selected' : '' }}>Health Institution</option>
            </select>
        </div>

        <div class="input-group">
            <label>Gender <span style="font-weight: normal; color: #777;">(optional)</span></label>
            <div class="radio-group">
                <label class="radio-item">
                    <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}>
                    <span>Female</span>
                </label>
                <label class="radio-item">
                    <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}>
                    <span>Male</span>
                </label>
            </div>
        </div>

        <div class="input-group">
            <label>Date of birth</label>
            <div class="date-row">
                <select name="birth_month">
                    <option value="">Month</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ old('birth_month') == $i ? 'selected' : '' }}>
                            {{ \DateTime::createFromFormat('!m', $i)->format('F') }}
                        </option>
                    @endfor
                </select>
                <select name="birth_day">
                    <option value="">Day</option>
                    @for($i = 1; $i <= 31; $i++)
                        <option value="{{ $i }}" {{ old('birth_day') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <select name="birth_year">
                    <option value="">Year</option>
                    @for($year = date('Y'); $year >= 1920; $year--)
                        <option value="{{ $year }}" {{ old('birth_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="marketing_consent" value="1" {{ old('marketing_consent') ? 'checked' : '' }} id="marketing">
            <label for="marketing">
                Share my data with partners for personalized offers.
            </label>
        </div>

        <p class="legal-text">
            By signing up, you agree to our <a href="#">Terms</a> and <a href="#">Privacy Policy</a>.
        </p>

        <button type="submit" class="btn-primary">Create Account</button>

        <div class="form-footer">
            Already have an account? <a href="{{ route('login') }}">Log in</a>
        </div>
    </form>
</div>

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* Sweat2Share - Register Page */
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

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 12px 16px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 15px;
        outline: none;
        transition: all 0.2s;
    }

    input:focus,
    select:focus {
        border-color: var(--accent-orange);
        box-shadow: 0 0 0 3px rgba(245, 126, 48, 0.15);
    }

    .helper-text {
        font-size: 12px;
        color: #888;
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

    .radio-group {
        display: flex;
        gap: 24px;
        margin-top: 8px;
    }

    .radio-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .radio-item input {
        width: 18px;
        height: 18px;
        accent-color: var(--accent-orange);
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

    .date-row {
        display: flex;
        gap: 12px;
    }

    .date-row select {
        flex: 1;
    }

    .legal-text {
        font-size: 13px;
        color: #666;
        margin-top: 20px;
        line-height: 1.5;
    }

    .legal-text a {
        color: var(--accent-orange);
        text-decoration: none;
    }

    .legal-text a:hover {
        text-decoration: underline;
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
    }

    .toggle-password:hover {
        color: var(--accent-orange);
    }
</style>

{{-- Figtree Font --}}
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

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

    document.getElementById('toggle-confirm-password').addEventListener('click', function () {
        const input = document.getElementById('password_confirmation');
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