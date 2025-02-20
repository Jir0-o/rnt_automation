<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<h4 class="py-2 m-4"><span class="text-muted fw-light">Assign Reviewer</span></h4>

<div class="row mt-5">
    <div class="col-12">
        
        <div class="card">
            <div class="card-header">
                <h5>Assign Reviewer</h5>
            </div>
            <div class="card-body">
                <form id="Assign-Reviewer">
                    <div class="mb-3">
                        <label for="user_id">Reviewer Name</label>
                        <select id="user_id" name="user_id[]" class="form-control" multiple="multiple" required>
                            <option value="">Select User</option>
                            <?php $__currentLoopData = $reviewers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user->id != auth()->id()): ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_id">Approver Name</label>
                        <select id="approver_id" class="form-control" required>
                            <option value="">Select User</option>
                            <?php $__currentLoopData = $reviewers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user->id != auth()->id()): ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <a href="<?php echo e(route('initiator-notes.create')); ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Assign Reviewer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery first -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#user_id').select2({
        placeholder: 'Select User',
        allowClear: true
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#Assign-Reviewer').on('submit', function(e) {
        e.preventDefault();

        // Extract the ID from the URL
        var pathArray = window.location.pathname.split('/');
        var intId = pathArray[pathArray.length - 1];

        var formData = {
            'user_id': $('#user_id').val(),
            'approver_id': $('#approver_id').val()
        };

        $.ajax({
            url: "<?php echo e(route('initiator-files.update', ':id')); ?>".replace(':id', intId),
            type: "PUT",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function(response) {
                console.log('Response received:', response);
                if (response.status) {
                    Toastify({
                        text: 'Reviewer Assigned Successfully.',
                        backgroundColor: 'green',
                        className: 'info',
                    }).showToast();

                    Swal.fire({
                        icon: "success",
                        title: "Approval",
                        text: "Do you want to create committee?",
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var redirectUrl = "<?php echo e(route('initiator-files.committee', ':id')); ?>".replace(':id', intId);
                            window.location.href = redirectUrl;
                        } else {
                            var redirectUrl =
                                "<?php echo e(route('initiator-notes.create')); ?>"
                                .replace(':id', intId);
                            window.location.href = redirectUrl;
                        }
                    });
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(key, error) {
                            $('#edit-' + key + '-error').text(error);
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
            }
        });

    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/reviewer.blade.php ENDPATH**/ ?>