@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{ route('users.store') }}" method="POST" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Create User') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <x-text-input
                                title="name"
                                name="name"
                                id="name-input"
                                required="required"
                                />
        
                            <x-text-input
                                title="email"
                                name="email"
                                id="email-input"
                                required="required"
                                />
        
                            <x-text-input
                                type="password"
                                title="password"
                                name="password"
                                id="password-input"
                                required="required"
                                />
        
                            <x-text-input
                                type="password"
                                title="password_confirmation"
                                name="password_confirmation"
                                id="password-confirmation-input"
                                required="required"
                                />
        
                            <x-select-input
                                title="company"
                                name="company_ids[]"
                                id="company-ids-input"
                                required="required"
                                multiple="multiple"
                                >
                                @foreach ($companies as $company)
                                    <option
                                        value="{{ $company->id }}"
                                        @if (in_array($company->id, old("company_ids", []))) selected @endif>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>
                        <div class="col-3">
                            <x-image-input
                                title="profile picture"
                                name="profile_picture"
                                id="profile-picture-input"
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