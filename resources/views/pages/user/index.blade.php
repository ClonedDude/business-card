@extends('layouts.app')

@can('users.view')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('User List') }}
                    </div>
                    @can('users.store')
                    <div class="card-toolbar">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                            Create
                        </a>
                    </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-table" class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Companies</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

@push('css')
<link href="{{ asset("assets/admin/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
<script src="{{ asset("assets/admin/plugins/custom/datatables/datatables.bundle.js") }}"></script>
<script>
    $(document).ready(function () {
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("users.data") }}',
                data: function (d) {
                    // d.role = $('#role-filter').val();
                },
                error: function (xhr, error, thrown) {
                // Show an error message
                    alert('Error fetching data: ' + xhr.responseJSON?.message || 'Unknown error occurred.');
                    console.error('Error details:', xhr.responseJSON || xhr.responseText);
                },
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'companies', name: 'companies', orderable: false, searchable: false },
                { data: 'roles', name: 'roles', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            ">" +

            "<'table-responsive'tr>" +

            "<'row'" +
            "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            ">"
        });
    });
</script>

<script>
    $('#role-filter').on('change', function() {
        $('#user-table').DataTable().draw();
    });
</script>
@endpush
@endcan