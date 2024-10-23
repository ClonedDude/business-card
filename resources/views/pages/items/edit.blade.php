@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <div class="card-title">
                        Edit items
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            @livewire("expense-item-form", ["item" => $item])
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
                                            value="{{ $company->id }}"
                                            @if ((int) $company->id === (int) $item->company_id) selected @endif>
                                                {{ $company->name }}
                                        </option>
                                    @endforeach

                                    {{-- @foreach ($items as $availableItem)
                                            <option value="{{ $availableItem->id }}" 
                                                data-price="{{ $availableItem->price }}" 
                                                data-currency="{{ $availableItem->currency }}" 
                                                @if ((int) $item->expense_item_id === (int) $availableItem->id) selected @endif>
                                                {{ $availableItem->name }}
                                            </option>
                                        @endforeach --}}
                                </x-select-input>
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