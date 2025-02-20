@extends('layouts.master')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row mt-5">

    <div class="col-12 col-md-12 col-lg-12">

        <div class="card">

            <div class="card-header">

                <div class="row">

                    <div class="col-12 col-md-6">

                        <h5>All Company</h5>

                    </div>

                    <div class="col-12 col-md-6">

                        <div class="float-end">

                            <!-- Button trigger modal -->

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"

                                data-bs-target="#Company">

                                <i class="bx bx-edit-alt me-1"></i> Create Company

                            </button>

                            <!-- Create Company Modal -->

                            <div class="modal fade" id="Company" tabindex="-1" aria-labelledby="CompanyLabel" aria-hidden="true">

                                <div class="modal-dialog modal-lg">

                                    <div class="modal-content">

                                        <form id="Company-Submit" enctype="multipart/form-data">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="CompanyLabel">Create Company</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                            </div>

                                        <div class="modal-body">

                                            <div class="row">

                                                <div class ="col-6">

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

                                                </div>

                                                <div class ="col-6">

                                                    <div class="mb-3">

                                                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="description" name="description" required>

                                                        <span class="text-danger" id="DescriptionError"></span>

                                                    </div>

                                                    {{-- <div class="mb-3">

                                                        <label for="sr" class="form-label">S.R No</label>

                                                        <input type="number" class="form-control" id="sr" name="sr">

                                                        <span class="text-danger" id="srError"></span>

                                                    </div> --}}

                                                    <div class="mb-3">

                                                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="address" name="address" required>

                                                        <span class="text-danger" id="AddressError"></span> <!-- Unique ID -->

                                                    </div>

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

                            <!-- Edit Company Modal -->

                            <div class="modal fade" id="EditCompany" tabindex="-1" aria-labelledby="EditCompanyLabel" aria-hidden="true">

                                <div class="modal-dialog modal-lg">

                                    <div class="modal-content">

                                        <form id="EditCompany-Submit" enctype="multipart/form-data">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="EditCompanyLabel">Edit Company</h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                            </div>

                                            

                                            <div class="modal-body">

                                            <!-- Hidden field to store company ID -->

                                            <input type="hidden" id="edit-company-id" name="company_id">

                                            <div class="row">

                                                <div class ="col-6">

                                                    <div class="mb-3">

                                                        <label for="edit-company-name" class="form-label">Company Name <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="edit-company-name" name="company_name" required>

                                                        <span class="text-danger" id="EditCompanyNameError"></span>

                                                    </div>



                                                    <div class="mb-3">

                                                        <label for="edit-buyer-name" class="form-label">Buyer Name <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="edit-buyer-name" name="buyer_name" required>

                                                        <span class="text-danger" id="EditBuyerNameError"></span>

                                                    </div>

                                                </div>

                                                <div class ="col-6">

                                                    <div class="mb-3">

                                                        <label for="edit-description" class="form-label">Description <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="edit-description" name="description" required>

                                                        <span class="text-danger" id="EditDescriptionError"></span>

                                                    </div>

                                                    {{-- <div class="mb-3">

                                                        <label for="edit-sr" class="form-label">S.R No</label>

                                                        <input type="number" class="form-control" id="edit-sr" name="sr">

                                                        <span class="text-danger" id="EditSrError"></span>

                                                    </div> --}}

                                                    <div class="mb-3">

                                                        <label for="edit-address" class="form-label">Address <span class="text-danger">*</span></label>

                                                        <input type="text" class="form-control" id="edit-address" name="address" required>

                                                        <span class="text-danger" id="EditAddressError"></span>

                                                    </div>

                                                </div>

                                            </div>



                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <button type="submit" class="btn btn-primary">Update Company</button>

                                            </div>

                                        </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="table-responsive text-nowrap p-3">

                <table id="Requisitions_Table" class="table">

                    <thead>

                        <tr>

                            <th>SL</th>

                            <th>Company Name</th>

                            <th>Buyer Name</th>

                            <th>Address</th>

                            {{-- <th>SR No</th> --}}

                            <th>Description</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody class="table-border-bottom-0" id="Categories-Table">

                        @foreach ($company as $companies)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $companies->name }}</td>

                            <td>{{ $companies->buyer_name }}</td>

                            <td>{{ $companies->address }}</td>

                            {{-- <td>{{ $companies->sr_no ?? 'No SR No found' }}</td> --}}

                            <td>{{ $companies->description ?? 'No Description found' }}</td>

                            <td>

                                @if ($companies->status == 0)

                                <span class="badge bg-warning">Pending</span>

                                @elseif($companies->status == 1)

                                <span class="badge bg-success">Approved</span>

                                @else

                                <span class="badge bg-danger">Rejected</span>

                                @endif

                            </td>

                            <td>



                                <button type="button" class="btn btn-primary editCompanyBtn"

                                    data-id="{{ $companies->id }}">

                                    <i class="bx bx-edit-alt me-1"></i> Edit

                                </button>

                                <button type="button" class="btn btn-danger deleteCompanyBtn"

                                    data-id="{{ $companies->id }}">

                                    <i class="bx bx-trash me-1"></i> Delete

                                </button>



                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>



<script>

$(document).ready(function() {



    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });



    // Edit button click

    $(document).on('click', '.editCompanyBtn', function() {

        var companyId = $(this).data('id');

        $.ajax({

            url: "{{ route('companies.show', ':id') }}".replace(':id', companyId),

            type: 'GET',

            success: function(response) {

                var company = response.company;

                $('#edit-company-id').val(company.id);

                $('#edit-company-name').val(company.name);

                $('#edit-buyer-name').val(company.buyer_name);

                $('#edit-address').val(company.address);

                $('#edit-description').val(company.description);

                $('#EditCompany').modal('show');

            },

            error: function(xhr, status, error) {

                console.error('Error fetching Company details:', error);

            }

        });

    });



    // Delete button click

    $(document).on('click', '.deleteCompanyBtn', function() {

        var companyId = $(this).data('id');

        Swal.fire({

            title: 'Are you sure?',

            text: "You want to delete this company!",

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#228B22',

            cancelButtonColor: '#d33',

            confirmButtonText: 'Yes, delete it!'

        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({

                    type: 'DELETE',

                    url: "{{ route('companies.destroy', ':id') }}".replace(

                        ':id', companyId),

                    data: {

                        "_token": "{{ csrf_token() }}"

                    },

                    dataType: 'JSON',

                    success: function(data) {

                        if (data.status == 200) {

                            Toastify({

                                text: data.message,

                                duration: 3000,

                                gravity: "top",

                                position: 'right',

                                backgroundColor: "green",

                                stopOnFocus: true,

                            }).showToast();

                        } else {

                            Toastify({

                                text: data.message,

                                duration: 3000,

                                gravity: "top",

                                position: 'right',

                                backgroundColor: "red",

                                stopOnFocus: true,

                            }).showToast();

                        }

                        location.reload();

                    },

                    error: function(xhr, status, error) {

                        console.error('Error deleting category:', error);

                    }

                }); // Reload the page to see the updated category list

            }

        });

    });





    // Update category form submission

    $('#EditCompany-Submit').on('submit', function(e) {

        e.preventDefault();



        var companyId = $('#edit-company-id').val();

        var formData = {

            company_name: $('#edit-company-name').val(),

            buyer_name: $('#edit-buyer-name').val(),

            address: $('#edit-address').val(),

            description: $('#edit-description').val(),
        };



        $.ajax({

            url: "{{ route('companies.update', ':id') }}".replace(':id',

                companyId),

            type: "PUT",

            data: formData,

            success: function(response) {

                if (response.status) {

                    location.reload(); // Reload the page to see the updated category

                } else {

                    // Handle validation errors

                    if (response.errors) {

                        $.each(response.errors, function(key, error) {

                            $('#EditCompanyNameError').text(error[0]);

                        });

                    }

                }

            },

            error: function(xhr, status, error) {

                console.error('Form submission error:', error);

            }

        });

    });



    // Handle form submission for creating a company

    $('#Company-Submit').on('submit', function(e) {

        e.preventDefault();



        // Disable the submit button to prevent multiple submissions

        let submitButton = $(this).find('button[type="submit"]');

        submitButton.prop('disabled', true);



        // Clear previous errors

        $('.text-danger').text('');



        var formData = {

            'company_name': $('#company-name').val(),

            'address': $('#address').val(),

            'buyer_name': $('#buyer-name').val(),

            'description': $('#description').val(),

            'sr': $('#sr').val(),

        };



        $.ajax({

            url: "{{ route('companies.store') }}",

            type: "POST",

            data: formData,

            dataType: "json",  // Ensure the server knows we expect JSON

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Laravel CSRF token

            },

            success: function(response) {

                if (response.status) {

                    // Success: Close the modal and reset the form

                    $('#Company').modal('hide');

                    $('#Company-Submit')[0].reset(); 

                    

                    // Optionally, refresh the table or update the UI

                    location.reload();

                } else {

                    // Handle validation errors

                    if (response.errors) {

                        $.each(response.errors, function(key, error) {

                            $('#' + key + 'Error').text(error);

                        });

                    }

                }

            },

            error: function(xhr, status, error) {

                console.error('Form submission error:', error);

            },

            complete: function() {

                submitButton.prop('disabled', false);

            }

        });

    });

});

</script>

@endsection