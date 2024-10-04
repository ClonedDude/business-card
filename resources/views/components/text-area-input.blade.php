<div class="form-group mb-4">
    <label for="{{ $id }}" class="text-capitalize">{{ $title }}@if($required) <b class="text-danger">*</b> @endif</label>
    <textarea
        id="{{ $id }}"
        class="form-control @error($name) is-invalid @enderror"
        type="{{ $type }}"
        @if($required) required @endif
        name="{{ $name }}">{!! old($name, $value) !!}</textarea>

    @if ($info)
        <small>{{ $info }}</small>
    @endif

    @error($name)
        <span class="invalid-feedback d-block">
            {{ $message }}
        </span>
    @enderror
</div> 