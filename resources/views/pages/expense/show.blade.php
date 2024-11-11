@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center px-4">
            <div class="col-12 col-md-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Expense</h3>
                            <div class="card-toolbar">
                                <a href="{{ route('expenses.create') }}" class="btn btn-sm btn-primary">
                                Create
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-expense-detail :expense="$expense" :media="$media" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
