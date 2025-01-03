@extends('layouts.app')

@can('external.update')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="card-header">
            <div class="card-toolbar">
                <a href="{{ route('external-link-types.index') }}" class="btn btn-sm btn-primary">
                    Back
                </a>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <form action="{{ route('external-link-types.update', $external_link_type->id) }}" enctype="multipart/form-data" method="POST" class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Edit External Link Type') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <x-text-input
                        title="name"
                        name="name"
                        value="{{ old('name', $external_link_type->name) }}"
                        id="name-input"
                        required="required"
                        />

                    <x-image-input
                        title="icon"
                        name="icon"
                        id="icon-input"
                        value="{{ $external_link_type->icon_url }}"
                        />
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

@cannot('external.update')
@section('content')
    <div style="padding-left: 2em">
        User does not have permission to view this
    </div>
@endsection
@endcannot