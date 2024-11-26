@extends('layouts.app')

@can('users.store')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
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
                            <input type="hidden" name="company_id" value="{{ getPermissionsTeamId() }}">

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
                                title="password confirmation"
                                name="password_confirmation"
                                id="password-confirmation-input"
                                required="required"
                                />
                            
                            <x-select-input
                                title="role"
                                name="role"
                                id="role"
                                required="required"
                                >
                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->name }}">  {{ $role->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                            
                            <x-select-input
                                title="Company"
                                name="company_id"
                                id="company_id"
                                required="required"
                                >
                                @foreach ($companies as $company)
                                    <option
                                        value="{{ $company->id }}"> {{ $company->name }}
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
@endcan