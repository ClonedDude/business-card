@extends('layouts.app')

@can('contacts.update')
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
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Edit Contact') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            @livewire("contact-form", ["contact" => $contact])
                            @livewire("contact-external-links-form", ["contact" => $contact])
                        </div>
                        <div class="col-3">
                            <x-image-input
                                title="profile picture"
                                name="profile_picture"
                                id="profile-picture-input"
                                value="{{ $contact->profile_picture_url }}"
                                height="500"
                                />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div> 
@endsection
@endcan

@cannot('contacts.update')
@section('content')
    <div style="padding-left: 2em">
        User does not have permission to view this
    </div>
@endsection
@endcannot