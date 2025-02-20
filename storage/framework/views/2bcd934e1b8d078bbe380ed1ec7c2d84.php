
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>All Unit Types</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#SubCategory">
                                <i class="bx bx-edit-alt me-1"></i> Create Unit Type
                            </button>

                            <!-- Create Category Modal -->
                            <div class="modal fade" id="SubCategory" tabindex="-1" aria-labelledby="CategoryLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="Sub-Category-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="CategoryLabel">Create Unit Type</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="sub-category-name" class="form-label">Full Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="full-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="FullNameError"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product-category" class="form-label">Short Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="short-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="ShortNameError"></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create Unit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="EditSubCategory" tabindex="-1"
                                aria-labelledby="EditCategoryLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="EditCategory-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditCategoryLabel">Edit Unit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="edit-unit-id">
                                                <div class="mb-3">
                                                    <label for="edit-sub-category-name" class="form-label">Full Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="edit-full-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="EditCategoryNameError"></span>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit-product-category" class="form-label">Short Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="edit-short-name"
                                                        name="category_name" required>
                                                    <span class="text-danger" id="EditProductSubCategoryError"></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Unit</button>
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
                            <th>Name</th>
                            <th>Short Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Categories-Table">
                        <?php $__currentLoopData = $unitType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unitTypes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($unitTypes->name); ?></td>
                            <td><?php echo e($unitTypes->symbol); ?></td>
                            <td>
                                <?php if($unitTypes->is_active == 0): ?>
                                <span class="badge bg-warning">Pending</span>
                                <?php elseif($unitTypes->is_active == 1): ?>
                                <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                <span class="badge bg-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary editSubCategoryBtn"
                                    data-id="<?php echo e($unitTypes->id); ?>">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>
                                <button type="button" class="btn btn-danger deleteSubCategoryBtn"
                                    data-id="<?php echo e($unitTypes->id); ?>">
                                    <i class="bx bx-trash me-1"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    $(document).on('click', '.editSubCategoryBtn', function() {
        var subCategoryId = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('unit-types.show', ':id')); ?>".replace(':id',
                subCategoryId),
            type: 'GET',
            success: function(response) {
                $('#edit-unit-id').val(response.data.id);
                $('#edit-full-name').val(response.data.name);
                $('#edit-short-name').val(response.data.symbol);

                $('#EditSubCategory').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching sub category details:', error);
            }
        });
    });

    // Delete button click
    $(document).on('click', '.deleteSubCategoryBtn', function() {
        var SubcategoryId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Sub category!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#228B22',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: "<?php echo e(route('unit-types.destroy', ':id')); ?>"
                        .replace(':id', SubcategoryId),
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>"
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

                            location.reload();
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
    $('#EditCategory-Submit').on('submit', function(e) {
        e.preventDefault();

        var subCategoryId = $('#edit-unit-id').val();

        var formData = {
            'full_name': $('#edit-full-name').val(),
            'short_name': $('#edit-short-name').val()
        };

        $.ajax({
            url: "<?php echo e(route('unit-types.update', ':id')); ?>".replace(':id',
                subCategoryId),
            type: "PUT",
            data: formData,
            success: function(response) {
                if (response.status) {
                    location.reload(); // Reload the page to see the updated category
                } else {
                    // Handle validation errors
                    if (response.errors) {
                        $.each(response.errors, function(key, error) {
                            $('#Edit' + key.charAt(0).toUpperCase() + key.slice(
                                1) + 'Error').text(error[0]);
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
            }
        });
    });

    // Handle form submission for creating category
    $('#Sub-Category-Submit').on('submit', function(e) {
        e.preventDefault();
        // Disable the submit button to prevent multiple submissions
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);

        var formData = {
            'full_name': $('#full-name').val(),
            'short_name': $('#short-name').val()
        };

        $.ajax({
            url: "<?php echo e(route('unit-types.store')); ?>",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            success: function(response) {
                if (response.status) {
                    location.reload(); // Reload the page to see the new category
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/backend/products/createUnitType.blade.php ENDPATH**/ ?>