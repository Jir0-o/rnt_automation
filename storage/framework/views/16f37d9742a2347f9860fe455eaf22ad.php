

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Designation List</h3>
                <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create New Designation
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap p-3">
                    <table id="datatable2" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Designation</th>
                                <th>Short</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $designations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $designation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($designation->designation); ?></td>
                                    <td><?php echo e($designation->short); ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal"
                                            data-id="<?php echo e($designation->id); ?>"
                                            data-designation="<?php echo e($designation->designation); ?>"
                                            data-short="<?php echo e($designation->short); ?>">
                                            Update
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="<?php echo e($designation->id); ?>">
                                            Delete
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

   
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('designations.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="new_designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="new_designation" name="designation" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_short" class="form-label">Short</label>
                            <input type="text" class="form-control" id="new_short" name="short">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Designation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('designations.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="designation_id" id="designation_id">
                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" required>
                        </div>
                        <div class="mb-3">
                            <label for="short" class="form-label">Short</label>
                            <input type="text" class="form-control" id="short" name="short">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        const updateModal = document.getElementById('updateModal');
        updateModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const designation = button.getAttribute('data-designation');
            const short = button.getAttribute('data-short');

            const modalId = updateModal.querySelector('#designation_id');
            const modalDesignation = updateModal.querySelector('#designation');
            const modalShort = updateModal.querySelector('#short');

            modalId.value = id;
            modalDesignation.value = designation;
            modalShort.value = short;
        });

        // Delete Handling with SweetAlert
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const designationId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete the designation!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`<?php echo e(route('designations.delete')); ?>`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                            },
                            body: JSON.stringify({ designation_id: designationId })
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire('Deactivated!', 'The designation has been deleted.', 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Error!', 'Failed to delete the designation.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/backend/allocations/designation.blade.php ENDPATH**/ ?>