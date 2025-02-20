
<?php $__env->startSection('content'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class="row mt-5">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-2"></div>

                <div class="card col-md-8">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 col-md-6">
                                <h5>Create OCE Committee</h5>
                            </div>

                            <form action="<?php echo e(route('create.oce.committee')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" value="<?php echo e($id); ?>" name="requisition_id">
                                <div class=" my-4">
                                    <!-- Committee Name -->
                                    <div class="col-12 mt-4">
                                        <label for="committee-name">Committee Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter Committee Name">
                                        <?php $__errorArgs = ['name'];
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

                                    <!-- Select Secretary -->
                                    <div class="col-12 mt-4">
                                        <label for="secretary">Select Secretary <span class="text-danger">*</span></label>
                                        <select name="secretary" class="form-control">
                                            <option value="" selected disabled>Select Secretary</option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['secretary'];
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

                                    <!-- Select Chairman -->
                                    <div class="col-12 mt-4">
                                        <label for="chairman">Select Chairman <span class="text-danger">*</span></label>
                                        <select name="chairman" class="form-control">
                                            <option value="" selected disabled>Select Chairman</option>
                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['chairman'];
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

                                    <!-- Create Button -->
                                    <div class="mt-4">
                                        <button class="btn btn-primary float-end" type="submit">
                                            <i class='bx bx-plus' style="margin-left: -7px; margin-right:3px;"></i>Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Back Button -->
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary col-md-2">
                            <i class="fas fa-arrow-left mx-1"></i> Back
                        </a>
                        <div class="row mt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#defaultOceCommitteeModal">
                                    Select Default Committee
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-2"></div>
            </div>
        </div>
    </div>

    <!-- Button to open modal for selecting a default committee -->


    <!-- Modal for selecting a default committee -->
  <!-- Modal for selecting a default committee -->
<div class="modal fade" id="defaultOceCommitteeModal" tabindex="-1" aria-labelledby="defaultOceCommitteeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="defaultOceCommitteeModalLabel">Select Default OCE Committee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to use the selected default committee -->
                <form action="<?php echo e(route('create.oce.committee')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="requisition_id" value="<?php echo e($id); ?>">

                    <!-- Default Committee Selection -->
                    <div class="mb-3">
                        <label for="default-committee" class="form-label">Select a Default Committee</label>
                        <select id="default-committee" name="default_committee_id" class="form-control">
                            <option value="" disabled selected>Select a Default Committee</option>
                            <?php $__currentLoopData = $defaultCommittees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($committee->id); ?>">
                                    <?php echo e($committee->name); ?> - Secretary: <?php echo e($committee->secretaryUser->name); ?> -
                                    Chairman: <?php echo e($committee->chairmanUser->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Manual Entry of Default Committee Name -->
                    <div class="mb-3">
                        <label for="custom-committee-name" class="form-label">Or Enter a Custom Committee Name</label>
                        <input type="text" name="nameOCE" id="custom-committee-name"
                            class="form-control" placeholder="Enter Custom Committee Name">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Use this Committee</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/dpmAndOce.blade.php ENDPATH**/ ?>