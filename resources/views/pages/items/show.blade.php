@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center px-4">
            <div class="col-12 col-md-12">
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Item</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <x-expense-item-detail :item="$item" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
