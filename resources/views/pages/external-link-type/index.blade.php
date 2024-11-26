@extends('layouts.app')

@can('external.view')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('External Link Type List') }}
                    </div>
                    @can('external.store')
                    <div class="card-toolbar">
                        <a href="{{ route('external-link-types.create') }}" class="btn btn-sm btn-primary">
                            Create
                        </a>
                    </div>
                    @endcan
                </div>

                <div class="card-body">
                    @livewire("external-link-type-table")
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@endcan