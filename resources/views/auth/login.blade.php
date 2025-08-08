@extends('layouts.guest')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, rgb(39, 38, 38) 50%, rgb(247, 246, 246) 50%); /* Split black and white background */
        background-size: 200% 200%; /* For smooth gradient animation */
        animation: gradientAnimation 10s ease infinite; /* Apply the animation */
        color: #000; /* Black text for better contrast */
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden; /* Prevent scrollbars during animations */
    }

    @keyframes gradientAnimation {
        0% { background-position: 50% 100%; }
        50% { background-position: 0% 50%; }
        100% { background-position: 50% 100%; }
    }

    .card {
        background: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 850px; /* Increased width */
        padding: 2rem; /* Slightly reduced padding */
        margin: 20px;
        backdrop-filter: blur(10px); /* Blur effect for glassmorphism */
        animation: fadeIn 1s ease-in-out; /* Fade-in animation */
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .logo-container {
        text-align: center;
        margin-bottom: 2rem;
        animation: bounce 2s infinite; /* Bounce animation for logo */
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .logo {
        max-width: 120px;
        height: 120px; /* Make it square */
        border-radius: 50%; /* Make it round */
        object-fit: cover; /* Ensure it stays properly fitted */
        margin-bottom: 1.5rem;
    }

    .login-title {
    font-size: 28px;
    font-weight: bold;
    color: #000;
    margin-bottom: 2rem;
    text-align: center;
    overflow: hidden; /* Hide overflow to create the typing effect */
    white-space: nowrap; /* Keep text on one line */
    border-right: 2px solid #000; /* Cursor effect */
    animation: typing 5s steps(40, end) infinite, blink-cursor 0.75s step-end infinite;
    }

    @keyframes slideIn {
        0% { opacity: 0; transform: translateX(-50px); }
        100% { opacity: 1; transform: translateX(0); }
    }

    /* Typing animation */
    @keyframes typing {
        0% { width: 0; } /* Start with no width */
        50% { width: 100%; } /* Expand to full width */
        70%, 100% { width: 100%; } /* Hold at full width for 2 seconds */
    }

    /* Cursor blink animation */
    @keyframes blink-cursor {
        from, to { border-color: transparent; } /* Hide cursor */
        50% { border-color: #000; } /* Show cursor */
    }

    .form-control {
        background: #f9f9f9; /* Light gray input fields */
        border: 1px solid #ddd;
        color: #333;
        border-radius: 8px;
        padding: 12px;
        width: 100%;
        margin-bottom: 1.5rem; /* More spacing between fields */
        transition: all 0.3s ease; /* Smooth transition */
    }

    .form-control:focus {
        background: #fff; /* White on focus */
        border-color: #000; /* Black border on focus */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transform: scale(1.02); /* Slight zoom effect */
    }

    .btn-primary {
        background: #000; /* Black button */
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-size: 16px;
        color: #fff; /* White text */
        width: 100%;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
        background: #333; /* Darker black on hover */
        transform: translateY(-2px); /* Lift effect */
    }

    .forgot-password-link {
        color: #000; /* Black link */
        text-decoration: none;
        transition: color 0.3s ease, transform 0.3s ease;
        display: block;
        text-align: center;
        margin-top: 1.5rem;
    }

    .forgot-password-link:hover {
        color: #555; /* Darker gray on hover */
        transform: translateX(5px); /* Slight shift on hover */
    }

    .alert {
        background: rgba(255, 255, 255, 0.9); /* Semi-transparent alerts */
        border: 1px solid #ddd;
        color: #333;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.5s ease-in-out; /* Fade-in for alerts */
    }

    .alert-danger {
        background: rgba(255, 0, 0, 0.1); /* Red background for danger alerts */
        border-color: rgba(255, 0, 0, 0.2);
    }

    .alert-success {
        background: rgba(0, 255, 0, 0.1); /* Green background for success alerts */
        border-color: rgba(0, 255, 0, 0.2);
    }

    .password-wrapper { position: relative; }
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        padding: 4px;
        cursor: pointer;
        line-height: 0;
    }
    .toggle-password svg { display: block; width: 20px; height: 20px; }

</style>
<section class="vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-xl-11">
                <div class="card">
                    <div class="card-body">
                        <!-- Logo at the top -->
                        <div class="logo-container">
                            <img src="{{ asset('RNT-Logo.png') }}" alt="RNT Automation Logo" class="logo">
                        </div>

                        <!-- Login title -->
                        <h5 class="login-title">Login to RNT Automation</h5>

                        @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                        @endif

                        @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                        @endif

                        <!-- Login form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email input -->
                            <div class="mb-4">
                                <label class="form-label" for="form3Example3">Email address</label>
                                <input type="email" id="form3Example3" name="email"
                                    class="form-control form-control-lg"
                                    placeholder="Enter a valid email address" />
                            </div>

                            <!-- Password input -->
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="password-wrapper" style="position: relative;">
                                    <input id="password" class="form-control form-control-lg" type="password" name="password"
                                        required autocomplete="current-password"
                                        placeholder="Enter your password" />
                                    <button type="button" class="toggle-password" aria-label="Show password" tabindex="0"></button>
                                </div>
                            </div>
                            <!-- Remember me and Forgot password -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="block">
                                    <label for="remember_me" class="flex items-center">
                                        <x-checkbox id="remember_me" name="remember" />
                                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <a class="forgot-password-link"
                                        href="{{ route('forgot-password.create') }}">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>

                            <!-- Error messages -->
                            <div class="d-flex flex-row align-items-center mt-2">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>

                            <!-- Login button -->
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="btn btn-lg btn-primary btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const eyeSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>`;
    const eyeOffSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.86 21.86 0 0 1 5.06-5.94"/><path d="M9.88 9.88a3 3 0 0 0 4.24 4.24"/><path d="M1 1l22 22"/></svg>`;

    document.querySelectorAll('.password-wrapper').forEach(function (wrapper) {
        const input = wrapper.querySelector('input[type="password"], input[type="text"]');
        if (!input) return;
        const btn = wrapper.querySelector('.toggle-password');
        if (!btn) return;

        // initial state: hidden
        btn.innerHTML = eyeSVG;
        btn.setAttribute('aria-label', 'Show password');
        btn.style.cursor = 'pointer';

        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            if (isPassword) {
                btn.innerHTML = eyeOffSVG;
                btn.setAttribute('aria-label', 'Hide password');
            } else {
                btn.innerHTML = eyeSVG;
                btn.setAttribute('aria-label', 'Show password');
            }
            input.focus();
        });
    });
});
</script>


@endsection