@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">{{ __('Dashboard') }}</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- User Info -->
                        <div class="col-md-6">
                            <h5 class="mb-3">User Information</h5>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Username:</strong> {{ $user->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>User ID:</strong> {{ $user->id }}
                                </li>
                            </ul>
                        </div>

                        <!-- Company Users -->
                        <div class="col-md-6">
                            <h5 class="mb-3">Associated Companies</h5>
                            @if ($company)
                                <ul class="list-group">
                                    @foreach ($company as $comp)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                <strong>Company Name:</strong> {{ $comp->name }}
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                <strong>Company ID:</strong> {{ $comp->id }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No associated companies found.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Roles and Permissions -->
                    <div class="mt-4">
                        <h5>Roles and Permissions</h5>
                        @if ($user->roles->isNotEmpty())
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center align-middle" style="padding-left: 1em">Role</th>
                                        <th class="text-center align-middle">Permissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->roles as $role)
                                    <tr>
                                        <td style="padding-left: 1em">
                                            <span class="badge bg-info text-dark">{{ $role->name }}</span>
                                        </td>
                                        <td>
                                            @if ($role->permissions->isNotEmpty())
                                                @foreach ($role->permissions as $perm)
                                                    <span class="badge bg-success">{{ $perm->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No permissions assigned</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No roles assigned to the user.</p>
                        @endif
                    </div>

                    <!-- Role Deletion Check -->
                    <div class="mt-3">
                        @can('roles.delete')
                            <div class="alert alert-success" role="alert">
                                You have permission to delete roles.
                            </div>
                        @else
                            <div class="alert alert-warning" role="alert">
                                You do not have permission to delete roles.
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection