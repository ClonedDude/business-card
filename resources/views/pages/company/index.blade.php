@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        {{ __('Company List') }}
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('companies.create') }}" class="btn btn-sm btn-primary">
                            Create
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="company-table" class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Admin Name</th>
                                    <th>Registration Number</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Fax</th>
                                    <th>Email</th>
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
        $('#company-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("companies.data") }}',
                data: function (d) {
                    // d.role = $('#role-filter').val();
                }
            },
            columns: [
                { data: 'logo', name: 'logo'},
                { data: 'admin_name', name: 'admin.name'},
                { data: 'registration_number', name: 'registration_number'},
                { data: 'name', name: 'name'},
                { data: 'address', name: 'address'},
                { data: 'phone_number', name: 'phone_number'},
                { data: 'fax', name: 'fax'},
                { data: 'email', name: 'email'},
                { data: 'action', name: 'action'}
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
        $('#company-table').DataTable().draw();
    });
</script>
@endpush