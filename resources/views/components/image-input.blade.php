<div class="mb-4 d-flex flex-column align-items-start">
    <label for="{{ $id }}" class="text-capitalize">{{ $title }}</label>
    <div class="image-input w-100 image-input-empty" data-kt-image-input="true" style="{!! $value ? "background-image:url('$value')" : "background-color:#f7f7f7" !!}">
        
        <div class="image-input-wrapper w-100 {{ $height ? 'h-'.$height.'px' : 'h-125px' }}" onclick="document.getElementById('{{ $id }}').click()" data-bs-toggle="tooltip"
        title="Change image">
            
            <input type="file" id="{{ $id }}" name="{{ $name }}" accept=".png, .jpg, .jpeg" style="display: none;" />
            <input type="hidden" name="avatar_remove" />
            
        </div>

        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
           data-kt-image-input-action="cancel"
           data-bs-toggle="tooltip"
           data-bs-dismiss="click"
           title="Cancel image">
            <i class="bi bi-x fs-2"></i>
        </span>
    
        <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
           data-kt-image-input-action="remove"
           data-bs-toggle="tooltip"
           data-bs-dismiss="click"
           title="Remove image">
            <i class="bi bi-x fs-2"></i>
        </span>
    </div>

    @error($name)
        <span class="invalid-feedback d-block">
            {{ $message }}
        </span>
    @enderror
</div>
