
<?php $__env->startSection('content'); ?>
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Save Draft File List</h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable9" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>File Name</th>
                            <th>Number</th>
                            <th>Opening Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Requisitions-Table">
                        <?php $__currentLoopData = $initiatorFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td><?php echo e($inits->file_name); ?></td>
                            <td><?php echo e($inits->file_number); ?></td>
                            <td><?php echo e($inits->opening_date); ?></td>
                            <td>
                                <?php if($inits->status == 9): ?>
                                <span class="badge bg-warning">Save Draft File</span>
                                <?php elseif($inits->status == 0): ?>
                                <span class="badge bg-success">Send</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('drafts.edit',['id'=>$inits->requisition_id])); ?>">
                                    <button type="button" class="btn btn-warning ">
                                        <i class="bx bx-edit me-1"></i> Edit
                                    </button>
                                </a>
                                <a id="send_submit" data-id="<?php echo e($inits->requisition_id); ?>">
                                    <button type="button" class="btn btn-success">
                                        <i class="bx bx-send" style="margin-left: -7px; margin-right: 3px;"></i> Send
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!--/ Permissions -->
    </div>
</div>
<script>
$(document).ready(function() {
    $('#send_submit').click(function() {
        var requisitionId = $(this).data('id');
        console.log(requisitionId);

        // Show confirmation dialog using SweetAlert2
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to send the file?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, send it!',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms, proceed with the AJAX request

                $.ajax({
                    url: "<?php echo e(route('send.File.Draft', ['id' => ':id'])); ?>".replace(':id', requisitionId), // Use the correct route
                    type: "GET", // Use POST method
                    success: function(response) {
                        // Show success message after file is sent
                        Swal.fire(
                            'Sent!',
                            'The file has been sent successfully.',
                            'success'
                        ).then(() => {
                            // Redirect after success
                            window.location.href =
                                "<?php echo e(route('drafts.file')); ?>";
                        });
                    },
                    error: function(xhr) {
                        // Handle errors and display them in a SweetAlert modal
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';
                        for (var error in errors) {
                            errorMessage += errors[error] + '<br>';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessage
                        });
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/ShowOceApprovelForAdminEdit.blade.php ENDPATH**/ ?>