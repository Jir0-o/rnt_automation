
<?php $__env->startSection('content'); ?>
<div class="row mt-5">
    <div class="col-12 col-md-12">
        <div class="card card-default">
            <div class="card-body">
                <!-- Left Side -->
                <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Add Product Category</h5>
                                <div class="table-responsive text-nowrap p-3">
                                    <table id="Temp_Requisitions_Table" class="table">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Add Category</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0" id="Temp_Requisitions_Table_Data">
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->index + 1); ?></td>
                                                <td><?php echo e($product->product->product_name); ?></td>
                                                <td><?php echo e($product->quantity); ?></td>
                                                <td>
                                                    <select class="form-select form-select-lg mb-3" name="sub_cat[]"
                                                        aria-label=".form-select-lg example" required>
                                                        <option selected disabled>select Category</option>
                                                        <?php $__currentLoopData = $subCatagory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($cat->id); ?>"
                                                            <?php echo e($cat->id == $product->sub_catagory_id  ? 'selected' : ''); ?>>
                                                            <?php echo e($cat->product_category_name); ?>

                                                        </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>

                                                    <?php $__errorArgs = ['sub_cat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="text-danger"><?php echo e($message); ?></div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="card-title">Create Initiator File</h5>


                                        <div class="col-12 mt-4">
                                            <label for="SubCategory">Select Initiator<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select form-select-lg mb-3"
                                                aria-label=".form-select-lg example" name="initiator" required>
                                                <option selected disabled>select</option>
                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"
                                                    <?php echo e($user->id == $initiatorFile->initiator_id ? 'selected' : ''); ?>>
                                                    <?php echo e($user->name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>

                                            <?php $__errorArgs = ['initiator'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <label for="file_name">File Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="file_name"
                                                placeholder="Enter File Name"
                                                value="<?php echo e(old('file_name', $initiatorFile->file_name ?? '')); ?>">
                                            <?php $__errorArgs = ['file_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- File Number -->
                                        <div class="col-12 mt-4">
                                            <label for="file_number">File Number<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="file_number"
                                                placeholder="Enter File Number"
                                                value="<?php echo e(old('file_number', $initiatorFile->file_number ?? '')); ?>">
                                            <?php $__errorArgs = ['file_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- File Category -->
                                        <div class="col-12 mt-4">
                                            <label for="file_catagory">File Category<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="file_catagory"
                                                placeholder="Enter File Category"
                                                value="<?php echo e(old('file_catagory', $initiatorFile->file_catagory ?? '')); ?>">
                                            <?php $__errorArgs = ['file_catagory'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- Department -->
                                        <div class="col-12 mt-4">
                                            <label for="department">Department<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="department"
                                                placeholder="Enter Department"
                                                value="<?php echo e(old('department', $initiatorFile->department ?? '')); ?>">
                                            <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <!-- Opening Date -->
                                        <div class="col-12 mt-4">
                                            <label for="opening_date">Opening Date<span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" name="opening_date"
                                                value="<?php echo e(old('opening_date', $initiatorFile->opening_date ?? '')); ?>">
                                            <?php $__errorArgs = ['opening_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="text-danger"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row mt-4">
                                    <div class="col-4">
                                        <a href="<?php echo e(route('drafts.file')); ?>" class="btn btn-secondary">
                                            <i class='bx bx-arrow-back' style="margin-right: 3px;"></i>Back
                                        </a>
                                    </div>

                                    <!-- Save Draft Button (Middle) -->
                                    <div class="col-4 text-center">
                                        <button class="btn btn-warning" type="button" id="updateDraftButton">
                                            <i class='bx bx-save' style="margin-right: 3px;"></i>Save
                                        </button>
                                    </div>
                                    <div class="col-4 text-end">
                                        <button class="btn btn-primary" type="submit" id="send_submit"><i
                                                class='bx bx-send'
                                                style="margin-left: -7px; margin-right: 3px;"></i>Send File</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script>
$(document).ready(function() {
    $('#updateDraftButton').click(function() {
        // Gather form data
        var formData = {
            "_token": "<?php echo e(csrf_token()); ?>",
            "sub_cat": $('select[name="sub_cat[]"]').map(function() {
                return $(this).val();
            }).get(), // Get all selected sub-categories
            "initiator": $('select[name="initiator"]').val(),
            "file_name": $('input[name="file_name"]').val(),
            "file_number": $('input[name="file_number"]').val(),
            "file_catagory": $('input[name="file_catagory"]').val(),
            "department": $('input[name="department"]').val(),
            "opening_date": $('input[name="opening_date"]').val(),
        };

        // Send the form data via AJAX for updating
        $.ajax({
            url: "<?php echo e(route('updateDraft', ['id' => $id])); ?>", // The update route
            type: "POST", // Use POST method
            data: formData,
            success: function(response) {
                // Display success message using Toastr
                toastr.success(response.message);
                window.location.href = "<?php echo e(route('drafts.file')); ?>";
            },
            error: function(xhr) {
                // Handle error - display error messages
                var errors = xhr.responseJSON.errors;
                for (var error in errors) {
                    toastr.error(errors[error]);
                }
            }
        });
    });

    $('#send_submit').click(function() {
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
                    url: "<?php echo e(route('send.File.Draft', ['id' => $id])); ?>", // The update route
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/createInitiator/createInitiatorEdit.blade.php ENDPATH**/ ?>