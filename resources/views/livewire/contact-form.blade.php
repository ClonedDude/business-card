<div>
    <div class="form-group mb-4">
        <label for="user-id-input" class="text-capitalize">
            User
            {{-- <b class="text-danger">*</b> --}}
        </label>
        <select
            id="user-id-input"
            class="form-select h-100 @error("user_id") is-invalid @enderror"
            name="user_id"
            data-placeholder="Select an option"
            data-allow-clear="true"
            required
            wire:model.live="user_id">
            @if ($contact)
                disabled
            @endif>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    
        @error("user_id")
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label for="company-id-input" class="text-capitalize">
            Company
            {{-- <b class="text-danger">*</b> --}}
        </label>
        <select
            id="company-id-input"
            class="form-select h-100 @error("company_id") is-invalid @enderror"
            name="company_id"
            data-placeholder="Select an option"
            data-allow-clear="true"
            wire:model.live="company_id"
            required
            @if ($contact)
                disabled
            @endif>
            @foreach ($companies ?? [] as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </select>
    
        @error("company_id")
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">name</label>
        <input
            class="form-control"
            type="text"
            name="name"
            id="name-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('name', $name) }}">
            
        @error('name')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">subtitle</label>
        <input
            class="form-control"
            type="text"
            name="subtitle"
            id="subtitle-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('subtitle', $subtitle) }}">
            
        @error('subtitle')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">job title</label>
        <input
            class="form-control"
            type="text"
            name="job_title"
            id="job_title-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('job_title', $job_title) }}">
            
        @error('job_title')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">quote</label>
        <input
            class="form-control"
            type="text"
            name="quote"
            id="quote-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('quote', $quote) }}">
            
        @error('quote')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>


    <div class="form-group mb-4">
        <label class="text-capitalize" for="">address</label>
        <input
            class="form-control"
            type="text"
            name="address"
            id="address-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('address', $address) }}">
            
        @error('address')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">phone number</label>
        <input
            class="form-control"
            type="text"
            name="phone_number"
            id="phone-number-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('phone_number', $phone_number) }}">
            
        @error('phone_number')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">fax</label>
        <input
            class="form-control"
            type="text"
            name="fax"
            id="fax-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('fax', $fax) }}">
            
        @error('fax')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror  
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">email</label>
        <input
            class="form-control"
            type="text"
            name="email"
            id="email-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('email', $email) }}">
            
        @error('email')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form-group mb-4">
        <label class="text-capitalize" for="">website url</label>
        <input
            class="form-control"
            type="text"
            name="website_url"
            id="website-url-input"
            @if ($contact)
                disabled
            @endif
            value="{{ old('website_url', $website_url) }}">
            
        @error('website_url')
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror
    </div>
</div>
