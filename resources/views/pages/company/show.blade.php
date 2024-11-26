@extends('layouts.app')

@can('companies.view')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center px-4">
            <div class="col-12 col-md-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-toolbar">
                            <a href="{{ route('companies.index') }}" class="btn btn-sm btn-primary">
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Company</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-company-detail :company="$company" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endcan