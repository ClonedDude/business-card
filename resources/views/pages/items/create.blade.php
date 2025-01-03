@extends('layouts.app')

@can('items.store')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card card-custom">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('items.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{route('items.store')}}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        Create Item
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            @livewire("expense-item-form", ["item" => null])
                        </div>
                        <div class="col-9">
                        <x-select-input
                                title="company"
                                name="company_id"
                                id="company-ids-input"
                                required="required"
                                multiple="multiple"
                                >
                                @foreach ($companies as $company)
                                    <option
                                        value="{{ $company->id }}">
                                        
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
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

@cannot('items.store')
@section('content')
    <div style="padding-left: 2em">
        User does not have permission to view this
    </div>
@endsection
@endcannot