@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('external-link-types.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{ route('external-link-types.store') }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Create External Link Type') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <x-text-input
                        title="name"
                        name="name"
                        id="name-input"
                        required="required"
                        />
                    
                    <x-image-input
                        title="icon"
                        name="icon"
                        id="icon-input"
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