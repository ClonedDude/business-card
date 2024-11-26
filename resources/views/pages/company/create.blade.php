@extends('layouts.app')

@can('companies.store')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('companies.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Create Company') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <x-text-input
                                title="registration number"
                                name="registration_number"
                                id="registration-number-input"
                                required="required"
                                />
                                
                            <x-text-input
                                title="name"
                                name="name"
                                id="name-input"
                                required="required"
                                />

                            <x-text-input
                                title="address"
                                name="address"
                                id="address-input"
                                required="required"
                                />

                            <x-text-input
                                title="phone number"
                                name="phone_number"
                                id="phone-number-input"
                                required="required"
                                />

                            <x-text-input
                                title="fax"
                                name="fax"
                                id="fax-input"
                                required="required"
                                />

                            <x-text-input
                                title="email"
                                name="email"
                                id="email-input"
                                required="required"
                                />

                            <x-text-input
                                title="website"
                                name="website"
                                id="website-input"
                                required="required"
                                />
                            
                            <div class="w-125px">
                                <x-image-input
                                    title="logo"
                                    name="logo"
                                    id="logo-input"
                                    />
                            </div>
                        </div>
                        <div class="col-3">
                            <x-image-input
                                title="picture"
                                name="picture"
                                id="picture-input"
                                height="500"
                                />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 
@endsection
@endcan