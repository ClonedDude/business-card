@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('External Link Type List') }}
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('external-link-types.create') }}" class="btn btn-sm btn-primary">
                            Create
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @livewire('external-link-type-table')
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection