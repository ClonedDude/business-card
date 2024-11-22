@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
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
                                @foreach ($permissions as $permission)
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