@extends('layouts.guess')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-center p-12">
                <div class="bg-body d-flex flex-column flex-center rounded custom-rounded w-md-500px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            @error('role')
                                <div class="alert alert-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{ route('2fa') }}">
                                {{ csrf_field() }}

                                <div class="text-center mb-11">
                                    <h1 class="text-dark fw-bolder mb-3">
                                        2FA Authentication
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        <p class="small-text">
                                            Please enter the <strong>OTP</strong> generated on your Authenticator App. <br>
                                            Ensure you submit the current one because it refreshes every 30 seconds.
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <label for="one_time_password" class="col-md-4 control-label mb-2">One Time Password:</label>

                                    <div class="col-md-12">
                                        <input id="one_time_password" type="number" class="form-control"
                                            name="one_time_password" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <div class="col-md-12 mt-5">
                                        <button type="submit" class="btn btn-primary w-100">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
