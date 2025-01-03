@extends('layouts.app')

@can('contacts.store')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Create Contact') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            @livewire("contact-form", ["contact" => null])
                            @livewire("contact-external-links-form")
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
</div> 
@endsection
@endcan

@cannot('contacts.store')
@section('content')
    <div style="padding-left: 2em">
        User does not have permission to view this
    </div>
@endsection
@endcannot