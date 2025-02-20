@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>All Department</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#SubCategory">
                                <i class="bx bx-edit-alt me-1"></i> Create Department
                            </button>

                            <!-- Create Category Modal -->
                            <div class="modal fade" id="SubCategory" tabindex="-1" aria-labelledby="CategoryLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="Department-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="CategoryLabel">Create Department</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="department-name" class="form-label">Department Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="department-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="CategoryNameError"></span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="department-short-name" class="form-label">Department Short Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="department-short-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="CategoryNameError"></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create Department</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="EditDepartment" tabindex="-1"
                                aria-labelledby="EditCategoryLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="EditDepartment-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditCategoryLabel">Edit Department</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="edit-department-id">
                                                <div class="mb-3">
                                                    <label for="edit-department-name" class="form-label">Department
                                                        Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="edit-department-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="EditCategoryNameError"></span>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="edit-department-short-name" class="form-label">Department Short Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="edit-department-short-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="CategoryNameError"></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Department</button>
                                            </div>
                                        </form>
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
                            <th>Departmenty Name</th>
                            <th>Short Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Categories-Table">
                        @foreach ($department as $departments)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $departments->name }}</td>
                            <td>{{ $departments->short_name }}</td>
                            <td>
                                @if ($departments->code == 0)
                                <span class="badge bg-warning">Pending</span>
                                @elseif($departments->code == 1)
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-danger">Rejected</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary editDepartmentBtn"
                                    data-id="{{ $departments->id }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>
                                <button type="button" class="btn btn-danger deleteDepartmentBtn"
                                    data-id="{{ $departments->id }}">
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
    $(document).on('click', '.editDepartmentBtn', function() {
    var DepartmentId = $(this).data('id');
    $.ajax({
        url: "{{ route('department.edit.show', ':id') }}".replace(':id', DepartmentId),
        type: 'GET',
        success: function(response) {
            var department = response.department; // Adjust based on response
            $('#edit-department-id').val(department.id);
            $('#edit-department-name').val(department.name);
            $('#edit-department-short-name').val(department.short_name);
            
            // Ensure the modal is initialized and shown
            $('#EditDepartment').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching department details:', error);
        }
    });
});

    // Delete button click
    $(document).on('click', '.deleteDepartmentBtn', function() {
        var DepartmentId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Department!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#228B22',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route('department.delete', ':id') }}"
                        .replace(':id', DepartmentId),
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status) {
                            Toastify({
                                text: data.message,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "green",
                                stopOnFocus: true,
                            }).showToast();

                            location
                        .reload(); // Reload the page to see the updated category list
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
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting category:', error);
                    }
                });
            }
        });
    });

 // Update category form submission
$('#EditDepartment-Submit').on('submit', function(e) {
    e.preventDefault();

    var DepartmentId = $('#edit-department-id').val();
    var formData = {
        'department_name': $('#edit-department-name').val(),
        'department_short_name': $('#edit-department-short-name').val(),
    };

    $.ajax({
        url: "{{ route('department.edit.update', ':id') }}".replace(':id', DepartmentId),
        type: "PUT",
        data: formData,
        success: function(response) {
            if (response.status) {
                // Show success toast notification
                Toastify({
                    text: "Department updated successfully!",
                    duration: 1000, 
                    gravity: "top", // Positioning the toast at the top
                    position: "right", // Right-side alignment
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Custom background
                    close: true
                }).showToast();

                setTimeout(function() {
                    location.reload(); // Reload the page to see the updated department
                }, 1000); // Reload after 3 seconds (matching toast duration)
                
            } else {
                // Handle validation errors
                if (response.errors) {
                    $.each(response.errors, function(key, error) {
                        $('#Edit' + key.charAt(0).toUpperCase() + key.slice(1) + 'Error').text(error[0]);
                    });
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Form submission error:', error);

            // Show error toast notification
            Toastify({
                text: "Error updating department. Please try again.",
                duration: 1000, 
                gravity: "top",
                position: "right",
                backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)", // Error background
                close: true
            }).showToast();
        }
    });
});


    // Handle form Department for creating 
    $('#Department-Submit').on('submit', function(e) {
        e.preventDefault();
        
        // Disable the submit button to prevent multiple submissions
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);

        var formData = {
            'department_name': $('#department-name').val(),
            'department_short_name': $('#department-short-name').val(),
        };

        $.ajax({
            url: "{{ route('department.new.store') }}",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            success: function(response) {
                if (response.status) {
                    // Show success toast notification
                    Toastify({
                        text: "Department created successfully!",
                        duration: 1000, // Show for 3 seconds
                        gravity: "top", // Positioning the toast at the top
                        position: "right", // Right-side alignment
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Custom background
                        close: true
                    }).showToast();

                    // Reload after 3 seconds (matching toast duration)
                    setTimeout(function() {
                        location.reload(); // Reload the page to see the new department
                    }, 1000);
                    
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

                // Show error toast notification
                Toastify({
                    text: "Error creating department. Please try again.",
                    duration: 1000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)", // Error background
                    close: true
                }).showToast();
            },
            complete: function() {
                submitButton.prop('disabled', false); // Re-enable the submit button
            }
        });
    });
});
</script>
@endsection