@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex flex-column">
        <div class="d-flex justify-content-center p-12">
            <div class="bg-body d-flex flex-column flex-center rounded custom-rounded w-md-500px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                        @error("role")
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">
                                    Login into your account
                                </h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    <p class="small-text">Manage your business card</p>
                                </div>
                            </div>
                            <div class="fv-row mb-8 fv-plugins-icon-container">
                                <input placeholder="Email" class="form-control bg-transparent @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <div class="fv-row mb-3 fv-plugins-icon-container">
                                <input placeholder="Password" class="form-control bg-transparent @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password" value="{{ $newPassword ?? '' }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-primary">
                                        Forgot Password ?
                                    </a>
                                @endif
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Sign In</span>
                                    <span class="indicator-progress">
                                        Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="link-primary text-center" style="margin-top: 2em">
                                        Already have an account? Register here
                                    </a>
                                @endif
                            </div>
                            {{-- <div class="text-gray-500 text-center fw-semibold fs-6">
                                Do not have an account ?
                                <a href="{{ route('register') }}" class="link-primary">
                                    Request Here
                                </a>
                            </div> --}}
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('head')

<style>

    .image-class {
        max-width: 100%;
        height: auto;
    }

    .custom-rounded {
        border-radius: 30px;
        min-height: 600px; 
    }

    .image-1 {
        margin-bottom: 40%;
    }

    .image-2 {
        margin-bottom: 0;
    }
</style>
@endpush
                   
