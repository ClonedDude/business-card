@props(['disabled' => false, 'type' => 'text'])


@if ($orientation == "vertical")
    <div class="form-group mb-4">
        <label for="{{ $id }}" class="text-capitalize">{{ $title }}@if($required) <b class="text-danger">*</b> @endif</label>
        <input
            id="{{ $id }}"
            class="form-control @error($name) is-invalid @enderror"
            type="{{ $type }}"
            name="{{ $name }}"
            @if($required) required @endif
            value="{!! old($name, $value) !!}"
            {{ $disabled ? 'disabled' : '' }}
            @if($min !== null) min="{{ $min }}" @endif
            @if($max !== null) max="{{ $max }}" @endif
            >

        @if ($info)
            <small>{{ $info }}</small>
        @endif

        @error($name)
            <span class="invalid-feedback d-block">
                {{ $message }}
            </span>
        @enderror
    </div>
@else
    <div class="d-flex flex-row mb-8">
        <h5 for="{{ $id }}" class="my-auto col-2 text-capitalize">{{ $title }}@if($required) <b class="text-danger">*</b> @endif</h5>
        <div class="form-check px-0 col-5">
            <input
                id="{{ $id }}"
                class="form-control @error($name) is-invalid @enderror"
                type="{{ $type }}"
                name="{{ $name }}"
                @if($required) required @endif
                value="{{ old($name, $value) }}"
                {{ $disabled ? 'disabled' : '' }}
                @if($min) min="{{ $min }}" @endif
                @if($max) max="{{ $max }}" @endif
                >

            @if ($info)
                <small>{{ $info }}</small>
            @endif

            @error($name)
                <span class="invalid-feedback d-block">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
@endif