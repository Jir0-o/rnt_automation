@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>All Challan</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Create Company Modal -->
                            <div class="modal fade" id="Company" tabindex="-1" aria-labelledby="CompanyLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="Company-Submit" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="company-name" class="form-label">Company Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="company-name" name="company_name" required>
                                                    <span class="text-danger" id="CompanyNameError"></span> <!-- Unique ID -->
                                                </div>

                                                <div class="mb-3">
                                                    <label for="buyer-name" class="form-label">Buyer Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="buyer-name" name="buyer_name" required>
                                                    <span class="text-danger" id="BuyerNameError"></span> <!-- Unique ID -->
                                                </div>

                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="address" name="address" required>
                                                    <span class="text-danger" id="AddressError"></span> <!-- Unique ID -->
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="description" name="description" required>
                                                    <span class="text-danger" id="DescriptionError"></span> <!-- Unique ID -->
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create Company</button> <!-- Updated Button Text -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                    <label for="comnpany name">Company Name: </label>
                        <select id="companyFilter" class="form-select">
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->name }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="col-md-6">
                    <label for="user name">User Name: </label>
                        <select id="userFilter" class="form-select">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="table-responsive text-nowrap p-3">
                    <table id="Requisitions_Table" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Challan No</th>
                                <th>Company Name</th>
                                <th>Buyer Name</th>
                                <th>Address</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($requisitions as $companies)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $companies->user?->name ?? 'No User Found' }}</td>
                                <td>{{ \Carbon\Carbon::parse($companies->requisition_date)->format('d-F-Y') }}</td>
                                <td>{{ $companies->requisition_no }}</td>
                                <td>{{ $companies->company?->name ?? 'No Company Found' }}</td>
                                <td>{{ $companies->company?->buyer_name ?? 'No Buyer Name Found' }}</td>
                                <td>{{ $companies->company?->address ?? 'No Address Found' }}</td>
                                <td>{{ $companies->company?->description ?? 'No Description Found' }}</td>
                                <td>
                                    @if ($companies->status == 0)
                                    <span class="badge bg-warning">Pending Authorization</span>
                                    @elseif($companies->status == 1)
                                    <span class="badge bg-success">Accepted</span>
                                    @elseif($companies->status == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                    @elseif($companies->status == 3)
                                    <span class="badge bg-success">Accepted</span>
                                    @elseif($companies->status == 4)
                                    <span class="badge bg-info">Issued</span>
                                    @elseif($companies->status == 5)
                                    <span class="badge bg-secondary">Ready To Pick</span>
                                    @elseif($companies->status == 11)
                                    <span class="badge bg-secondary">Save Draft</span>
                                    @elseif($companies->status == 12)
                                    <span class="badge bg-danger">Return Requisition</span>
                                    @elseif($companies->status == 13)
                                    <span class="badge bg-warning">Saved Return Requisition</span>
                                    @elseif($companies->status == 14)
                                    <span class="badge bg-warning">Waiting For Loan Return</span>
                                    @elseif($companies->status == 15)
                                    <span class="badge bg-success">Loan Returned</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary showCompanyBtn" data-id="{{ $companies->id }}">
                                        <i class="bx bx-show-alt me-1"></i> Show
                                    </button>
                                    <a href="{{ route('requisitions.print', $companies->id) }}" class=""
                                        target="_blank">
                                        <button class="btn btn-info">
                                            <i class="bx bx-printer me-1"></i> Print
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>         
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    // Show requisition button click handler
    $(document).on('click', '.showCompanyBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "{{ route('requisitions.show', ':id') }}".replace(':id', requisition_id);
    });

    // Destroy the DataTable instance if it exists to avoid reinitialization error
    if ($.fn.dataTable.isDataTable('#Requisitions_Table')) {
        $('#Requisitions_Table').DataTable().destroy();
    }

    // Initialize the DataTable once
    var table = $('#Requisitions_Table').DataTable({
        "responsive": true, // Bootstrap responsive layout
        "columnDefs": [
            { "targets": [0], "orderable": false } // Disable sorting for the first column (SL)
        ]
    });

    // Apply filter based on selected company and user
    $('#companyFilter, #userFilter').on('change', function() {
        var companyFilter = $('#companyFilter').val();
        var userFilter = $('#userFilter').val();

        // Apply filters to DataTable
        table
            .columns(4) // Column 5 is Company Name
            .search(companyFilter ? '^' + companyFilter + '$' : '', true, false) // Exact match for company
            .columns(1) // Column 2 is User Name
            .search(userFilter ? '^' + userFilter + '$' : '', true, false) // Exact match for user
            .draw(); // Redraw table with the new filters
    });
});
</script>
@endsection