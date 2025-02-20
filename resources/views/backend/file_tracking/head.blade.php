@extends('layouts.master')
@section('content')

<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        {{-- File List --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Department List</h5>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade Requisitions" id="DepartmentShow" tabindex="-1"
                        aria-labelledby="AllocationsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Change Department Head</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="Department-Submit">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12 col md-12 col-lg-12">
                                                <div class="mb-3">
                                                    <label for="Department" class="form-label">Department</label>
                                                    <input type="hidden" id="DepartmentId" name="DepartmentId">
                                                    <input type="text" class="form-control" id="Department"
                                                        name="Department" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="Head" class="form-label">Head</label>
                                                    <select class="form-select" id="Head" name="Head">
                                                        <option value="">Select Head</option>
                                                        @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>

                                        <button type="submit" id="Department-Submit"
                                            class="btn btn-primary">Change</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable3" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Current Head</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($department as $departments)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $departments->name }}</td>
                            <td>{{ $departments->head->name ?? 'Not Assigned' }}</td>
                            <td>
                                <button type="button" class="btn btn-primary showdepartmentBtn"
                                    data-id="{{ $departments->id }}" data-name="{{ $departments->name }}"
                                    data-head_id="{{ $departments->head_id }}">
                                    <i class="bx bx-show me-1"></i> Change
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <!--/ Permissions -->
    </div>
</div>


<script>
$(document).ready(function() {
    $('#Requisitions_Table').DataTable();
});


$(document).on('click', '.showdepartmentBtn', function() {
    var id = $(this).data('id');
    var name = $(this).data('name');
    var head_id = $(this).data('head_id') ?? '';
    
    $('#DepartmentId').val(id); // Set the department ID
    $('#Department').val(name);
    $('#Head').val(head_id);


    $('#DepartmentShow').modal('show');
});


$('#Department-Submit').submit(function(e) {
    e.preventDefault();

    var departmentId = $('#DepartmentId').val();
    var head_id = $('#Head').val();

    // Check if head is selected
    if (head_id === "") {
        alert('Please select a department head');
        return;
    }

    $.ajax({
        url: "{{ route('department.update') }}", // Make sure to adjust the route
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: departmentId,
            head_id: head_id
        },
        success: function(response) {
            if (response.status) {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "green",
                    stopOnFocus: true,
                }).showToast();

                $('#DepartmentShow').modal('hide');

                // Reload the page
                location.reload();

            } else {
                alert('Failed to update department');
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while updating the department.');
        }
    });
});
</script>
@endsection