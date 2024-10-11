<div>

     {{-- Expense name input --}}
     <div class="form-group mb-4">
        <label class="text-capitalize" for="">Expense Name</label>
        <input
            class="form-control"
            type="text"
            name="expense_name"
            id="expense_name-input"
            @if (!$is_detail_inputs_allowed)
                enabled
            @endif
            value="{{ old('expense_name', $expense_name) }}">
            
        @error('expense_name')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

     {{-- Additional details input --}}
     <div class="form-group mb-4">
        <label class="text-capitalize" for="">Additional Details</label>
        <input
            class="form-control"
            type="text"
            name="additional_details"
            id="additional_details-input"
            @if (!$is_detail_inputs_allowed)
                enabled
            @endif
            value="{{ old('additional_details', $additional_details) }}">
            
        @error('additional_details')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

     {{-- Total amount input --}}
     <div class="form-group mb-4">
        <label class="text-capitalize" for="">Total Amount</label>
        <input
            class="form-control"
            type="text"
            name="total_amount"
            id="total_amount-input"
            @if (!$is_detail_inputs_allowed)
                enabled
            @endif
            value="{{ old('total_amount', $total_amount) }}">
            
        @error('total_amount')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    {{-- Currency input --}}
    <div class="form-group mb-4">
        <label class="text-capitalize" for="">Currency</label>
        <input
            class="form-control"
            type="text"
            name="currency"
            id="currency-input"
            @if (!$is_detail_inputs_allowed)
                enabled
            @endif
            value="{{ old('currency', $currency) }}">
            
        @error('currency')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

      
    {{-- Date of Expense input --}}
    <div class="form-group mb-4">
        <label class="text-capitalize" for="">Date of Expense</label>
        <input
            class="form-control"
            type="date"
            name="date_of_expense"
            id="date_of_expense-input"
            @if (!$is_detail_inputs_allowed)
                enabled
            @endif
            value="{{ old('date_of_expense', $date_of_expense) }}">
            
        @error('date_of_expense')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    

    {{-- Approval input --}}
    <div class="form-group mb-4">
        <label for="approval-input" class="text-capitalize">
            Approval
            {{-- <b class="text-danger">*</b> --}}
        </label>
        <select
            id="approval-input"
            class="form-select h-100 @error("approval") is-invalid @enderror"
            name="approval"
            data-placeholder="Select an option"
            wire:model.live="approval"
            required>
            <option value="1">Approved</option>
            <option value="0">Not Approved</option>
        </select>
    
        @error("company_id")
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror
    </div>
    

</div>
