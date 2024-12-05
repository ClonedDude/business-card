@extends('layouts.app')

@can('roles.update')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-toolbar">
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">
                            Back
                        </a>
                    </div>
                </div>
            <form action="{{ route('roles.update', $role->id) }}" method="POST" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Edit Role') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <x-text-input
                                title="name"
                                name="name"
                                id="name-input"
                                required="required"
                                value="{{ $role->name }}"
                                />
        
                                <div class="row">
                                    @php
                                    // Group permissions by the prefix (e.g., 'expenses', 'items')
                                    $groupedPermissions = $permissions->groupBy(function ($permission) {
                                        return explode('.', $permission->name)[0]; // Extract the prefix
                                    });
                                    @endphp
                                    @foreach ($groupedPermissions as $category => $permissionsGroup)
                                    <div class="col-12 mb-3">
                                        <div class="d-flex align-items-center">
                                            <h5 class="me-2 mb-0">{{ ucfirst($category) }}</h5> <!-- Section title -->
                                            <input
                                                type="checkbox"
                                                class="role-checkbox"
                                                id="role-checkbox-{{ $category }}"
                                                data-category="{{ $category }}"
                                                style="transform: scale(1.2);"
                                            >
                                            <label for="role-checkbox-{{ $category }}" class="ms-2 mb-0">Select All</label>
                                        </div>
                                    </div>
                                    @foreach ($permissionsGroup as $permission)
                                        @if (!preg_match("/\*/", $permission->name))
                                            <div class="col-3 mb-2">
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input
                                                            class="form-check-input permission-checkbox"
                                                            type="checkbox"
                                                            name="permissions[]"
                                                            id="{{ $permission->name."-".$permission->id }}"
                                                            value="{{ $permission->name }}"
                                                            data-category="{{ $category }}"
                                                            @if ($role->hasPermissionTo($permission))
                                                            checked
                                                            @endif
                                                        >
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @endforeach
                                </div>
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
</div> 
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Select all role checkboxes
    const roleCheckboxes = document.querySelectorAll('.role-checkbox');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

    // Function to initialize the state of the "Select All" checkboxes
    function initializeRoleCheckboxes() {
        roleCheckboxes.forEach(roleCheckbox => {
            const category = roleCheckbox.getAttribute('data-category');
            const relatedCheckboxes = document.querySelectorAll(
                `.permission-checkbox[data-category="${category}"]`
            );
            
            // Check if all related checkboxes are already checked
            const allChecked = [...relatedCheckboxes].every(cb => cb.checked);
            roleCheckbox.checked = allChecked;
        });
    }

    // Initialize the state on page load
    initializeRoleCheckboxes();

    // Add event listener to "Select All" checkboxes
    roleCheckboxes.forEach(roleCheckbox => {
        roleCheckbox.addEventListener('change', function () {
            const category = this.getAttribute('data-category');
            const relatedCheckboxes = document.querySelectorAll(
                `.permission-checkbox[data-category="${category}"]`
            );

            relatedCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    });

    // Add event listener to individual permission checkboxes
    permissionCheckboxes.forEach(permissionCheckbox => {
        permissionCheckbox.addEventListener('change', function () {
            const category = this.getAttribute('data-category');
            const roleCheckbox = document.querySelector(`.role-checkbox[data-category="${category}"]`);
            const relatedCheckboxes = document.querySelectorAll(
                `.permission-checkbox[data-category="${category}"]`
            );

            // Check if all related checkboxes are checked
            roleCheckbox.checked = [...relatedCheckboxes].every(cb => cb.checked);
        });
    });
});
</script>
@endcan