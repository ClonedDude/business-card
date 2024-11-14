@extends('layouts.app')

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
            <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Edit Company') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <x-text-input
                                title="registration number"
                                name="registration_number"
                                value="{{ $company->registration_number }}"
                                id="registration-number-input"
                                />
                                
                            <x-text-input
                                title="name"
                                name="name"
                                value="{{ $company->name }}"
                                id="name-input"
                                />

                            <x-text-input
                                title="address"
                                name="address"
                                value="{{ $company->address }}"
                                id="address-input"
                                />

                            <x-text-input
                                title="phone number"
                                name="phone_number"
                                value="{{ $company->phone_number }}"
                                id="phone-number-input"
                                />

                            <x-text-input
                                title="fax"
                                name="fax"
                                value="{{ $company->fax }}"
                                id="fax-input"
                                />

                            <x-text-input
                                title="email"
                                name="email"
                                value="{{ $company->email }}"
                                id="email-input"
                                />

                            <x-text-input
                                title="website"
                                name="website"
                                value="{{ $company->website }}"
                                id="website-input"
                                />
                            
                            <div class="w-125px">
                                <x-image-input
                                    title="logo"
                                    name="logo"
                                    id="logo-input"
                                    value="{{ $company->logo_url }}"
                                    />
                            </div>
                        </div>
                        <div class="col-3">
                            <x-image-input
                                title="picture"
                                name="picture"
                                id="picture-input"
                                value="{{ $company->company_picture_url }}"
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