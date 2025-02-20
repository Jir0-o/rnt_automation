@extends('layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Cost Types</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button to trigger the Create Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCostTypeModal">
                                <i class="bx bx-edit-alt me-1"></i> Add New Cost Type
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="Requisitions_Table" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($costTypes as $costType)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $costType->name }}</td>
                            <td>
                                <!-- Button to trigger the Edit Modal -->
                                <button type="button" class="btn btn-sm btn-primary edit-cost-type" data-id="{{ $costType->id }}" data-bs-toggle="modal" data-bs-target="#editCostTypeModal">
                                    Edit
                                </button>
                                <form action="{{ route('cost-types.destroy', $costType->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Cost Type Modal -->
<div class="modal fade" id="createCostTypeModal" tabindex="-1" aria-labelledby="createCostTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cost-types.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCostTypeModalLabel">Add New Cost Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Cost Type Name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Cost Type Modal -->
<div class="modal fade" id="editCostTypeModal" tabindex="-1" aria-labelledby="editCostTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCostTypeForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCostTypeModalLabel">Edit Cost Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        // Handle Edit Button Click
        $('.edit-cost-type').on('click', function () {
            var id = $(this).data('id');
            var url = "{{ route('cost-types.edit', ':id') }}";
            url = url.replace(':id', id);

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    $('#edit_id').val(response.id);
                    $('#edit_name').val(response.name);

                    // Update form action URL
                    var updateUrl = "{{ route('cost-types.update', ':id') }}";
                    updateUrl = updateUrl.replace(':id', response.id);
                    $('#editCostTypeForm').attr('action', updateUrl);

                    // Open the modal
                    $('#editCostTypeModal').modal('show');
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
