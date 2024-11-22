@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <form action="{{ route('roles.store') }}" method="POST" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Create Role') }}
                    </div>
                </div>

                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="company_id" value="{{ getPermissionsTeamId()}}">
                        
                            <x-text-input
                                title="name"
                                name="name"
                                id="name-input"
                                required="required"
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
                                    <h>{{ ucfirst($category) }}</h> <!-- Display category title -->
                                </div>
                                @foreach ($permissionsGroup as $permission)
                                    @if (!preg_match("/\*/", $permission->name))
                                        <div class="col-3 mb-2">
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        name="permissions[]"
                                                        id="{{ $permission->name."-".$permission->id }}"
                                                        value="{{ $permission->name }}"
                                                        @if (in_array($permission->name, old("permissions", $permissions->pluck("name")->toArray())))
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
@endsection