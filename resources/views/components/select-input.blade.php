@props(['disabled' => false, 'multiple' => false])
<div class="form-group mb-4">
    <label for="{{ $id }}" class="text-capitalize">{{ $title }}@if($required) <b class="text-danger">*</b> @endif</label>
    <select
        id="{{ $id }}"
        class="form-select h-100 @error($name) is-invalid @enderror"
        name="{{ $name }}"
        {{ $disabled ? 'disabled' : '' }}
        @if($multiple) data-control="select2" @endif
        @if($multiple) data-close-on-select="false" @endif
        data-placeholder="Select an option"
        data-allow-clear="true"
        @if(!$multiple && $required) required @endif
        @if($multiple) multiple="multiple" @endif>

        {{ $slot }}
    </select>

    @if ($info)
        <small>{{ $info }}</small>
    @endif

    @error($name)
        <span class="invalid-feedback d-block">
            {{ $message }}
        </span>
    @enderror
</div>

