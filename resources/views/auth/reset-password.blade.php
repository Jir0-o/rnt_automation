@extends('layouts.guest')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <br>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Reset Your Password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Enter your new password to reset your account
            </p>
        </div>
        @if (Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif

        @if (Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
        @endif

        <!-- Show validation errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('reset-password') }}">
            @csrf

            <!-- Email Field (as hidden) -->
            <div class="block">
                <input type="hidden" name="email" value="{{ request('email') }}" />
            </div>

            <!-- Password Fields -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('New Password') }}" />
                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password Field -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                    required autocomplete="new-password" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@endsection