<div>

  {{-- Item name input --}}
  <div class="form-group mb-4">
     <label class="text-capitalize" for="">Item Name</label>
     <input
         class="form-control"
         type="text"
         name="name"
         id="item_name-input"
         @if (!$is_detail_inputs_allowed)
             enabled
         @endif
         value="{{ old('name', $name) }}">
         
     @error('item_name')
         <span class="invalid-feedback d-block">
             {{ $message }}
         </span>
     @enderror  
 </div>

  {{-- Item description input --}}
  <div class="form-group mb-4">
     <label class="text-capitalize" for="">Item Description</label>
     <input
         class="form-control"
         type="text"
         name="description"
         id="description-input"
         @if (!$is_detail_inputs_allowed)
             enabled
         @endif
         value="{{ old('description', $description) }}">
         
     @error('description')
         <span class="invalid-feedback d-block">
             {{ $message }}
         </span>
     @enderror  
 </div>

  {{-- Item price input --}}
  <div class="form-group mb-4">
     <label class="text-capitalize" for="">Price amount</label>
     <input
         class="form-control"
         type="text"
         name="price"
         id="price-input"
         @if (!$is_detail_inputs_allowed)
             enabled
         @endif
         value="{{ old('price', $price) }}">
         
     @error('price')
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
</div>
