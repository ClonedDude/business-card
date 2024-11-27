@extends('layouts.app')

@can('expenses.store')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card card-custom">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{route('expenses.store')}}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        Create Expense
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            @livewire("expense-form", ["expense" => null])
                            <x-image-input
                                title="receipt picture"
                                name="receipt_picture"
                                id="receipt-picture-input"
                                height="200"
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