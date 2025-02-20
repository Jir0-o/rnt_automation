@extends('layouts.guest')
@section('content')
<div class="mb-4 text-sm text-gray-600 text-center">
    {{ __('Please enter the OTP sent to your email address.') }}
</div>
<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="card-title py-3">
                        <h3 class="text-center">Verify OTP</h3>
                    </div>
                    <hr>
                    <div class="card-body">
                        @if (Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                        @endif

                        @if (Session::has('success'))
                        <p class="alert alert-success">{{ Session::get('success') }}</p>
                        @endif

                        <form method="POST" action="{{ route('otp-verification') }}">
                            @csrf
                            <!-- OTP -->
                            <div class="p-3 mb-5">
                                <label class="h4">Enter OTP</label><br>
                                <input type="number" name="verifyToken" class="form-control p-2" placeholder="OTP">
                            </div>

                            <div>
                                <div class="float-end">
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-success btn-block">
                                        <i class="fa fa-check fa-lg text-light"></i>&nbsp;
                                        <span id="payment-button-amount" class="text-light">Submit OTP</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid"
            alt="Sample image">
    </div>
</div>
@endsection