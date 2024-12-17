@extends('layouts.app')

@can('expenses.view')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center px-4">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Expense list
                    </div>
                    <!-- Check if user is in company-->
                    @if ($company->contains('user_id', $user->id))
                        @can('expenses.store')
                            <div class="card-toolbar">
                                <a href="{{ route('expenses.create') }}" class="btn btn-sm btn-primary">
                                Create
                                </a>
                            </div>
                        @endcan
                    @else

                   <!--If user not in company--> 
                    <div class="card-toolbar">
                        <button class="btn btn-sm btn-primary btn-create-expense" style="color:grey;">
                        Create
                        </button>
                    </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="company-table" class="table table-rounded table-striped border gy-7 gs-7">
                            <thead>
                                <tr>
                                    <th id="header-id">ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Total</th>
                                    <th>Currency</th>
                                    <th>Date</th>
                                    <th>User-ID</th>
                                    <th>Approval</th>
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
                url: '{{ route("expenses.data") }}',
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
                { data: 'expense_id', name: 'expense_id'},
                { data: 'expense_name', name: 'expense_name'},
                { data: 'additional_details', name: 'additional_details'},
                { data: 'total_amount', name: 'total_amount'},
                { data: 'currency', name: 'currency'},
                { data: 'date_of_expense', name: 'date_of_expense'},
                { data: 'user_id', name: 'user_id'},
                { data: 'approval', name: 'approval'},
                { data: 'action', name: 'action'},
            ],
            dom:
            "<'row'" +
            "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
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
    $(document).ready(function() {
    
    //For approving button script
    $('#company-table').on('click', '.btn-approve', function() {
        let expenseId = $(this).data('id');

        // Call approve function via AJAX
        $.ajax({
            url: '/expenses/approve/' + expenseId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                // Optionally refresh the table or change button state
                $('#company-table').DataTable().ajax.reload();
            },
            error: function(xhr) {
                alert('Error approving expense: ' + xhr.responseText);
            }
        });
    });

    //For rejecting button script
    $('#company-table').on('click', '.btn-reject', function() {
        let expenseId = $(this).data('id');
        // Call approve function via AJAX
        $.ajax({
            url: '/expenses/reject/' + expenseId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                // Optionally refresh the table or change button state
                $('#company-table').DataTable().ajax.reload();
            },
            error: function(xhr) {
                alert('Error approving expense: ' + xhr.responseText);
            }
        });
    });


    $('.btn-create-expense').on('click', function() {
        alert('User must be in a company to create expenses');
    });

    $('#role-filter').on('change', function() {
        $('#company-table').DataTable().draw();
    });

    $('#company-table').on('click', '.btn-delete', function(e) {
        e.preventDefault(); // Prevent default form submission

        let expenseId = $(this).data('id');
        let deleteUrl = '/expenses/delete/' + expenseId; // Replace with the correct delete route if different

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this expense? This action cannot be undone.")) {
            // If confirmed, proceed with the delete request
            $.ajax({
                url: deleteUrl,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);
                    // Optionally refresh the table or update the UI
                    $('#company-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    alert('Error deleting expense: ' + xhr.responseText);
                }
            });
        } else {
            // If canceled, do nothing
            return false;
        }
    });

    });
</script>

@endpush
@endcan

@cannot('expenses.view')
@section('content')
    <div style="padding-left: 2em">
        User does not have permission to view this
    </div>
@endsection
@endcannot