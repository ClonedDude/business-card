@extends('layouts.app')

@can('items.view')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Item List
                    </div>
                    @can('items.store')
                        <div class="card-toolbar">
                        <a href="{{ route('items.create') }}" class="btn btn-sm btn-primary">
                            Create
                        </a>
                        </div>
                    @endcan
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="company-table" class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Company-ID</th>
                                    <th>Price</th>
                                    <th>Currency</th>
                                    <th>Created at</th>
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
                url: '{{ route("items.data") }}',
                data: function (d) {
                    // d.role = $('#role-filter').val();
                }
            },
            columns: [
                { data: 'placeholder', name: 'placeholder'}, //logo placeholder
                { data: 'item_id', name: 'item_id'},
                { data: 'item_name', name: 'item_name'},
                { data: 'description', name: 'description'},
                { data: 'company_id', name: 'company_id'},
                { data: 'price', name: 'price'},
                { data: 'currency', name: 'currency'},
                { data: 'created_at', name: 'created_at'},
                { data: 'action', name: 'action'},
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
@endcan