@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card-header">
                <div class="card-toolbar">
                    <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-primary">
                        Back
                    </a>
                </div>
            </div>
            <form action="{{ route('expenses.update', $expense->id) }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        Edit expense
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            @livewire("expense-form", ["expense" => $expense, "item" => $item])
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