

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Create Default Committee</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('store.default.committee')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <!-- Committee Name -->
                    <div class="mb-3">
                        <label for="committee_name" class="form-label">Committee Name</label>
                        <input type="text" class="form-control" id="committee_name" name="committee_name" required>
                    </div>

                    <!-- Committee Type Dropdown -->
                    <div class="mb-3">
                        <label for="committee_type" class="form-label">Committee Type</label>
                        <select class="form-select" id="committee_type" name="committee_type" required>
                            <option value="Tech">Tech</option>
                            <option value="Demand">Demand</option>
                            <option value="OCE">OCE</option>
                            <option value="TOC Committee">Opening Committee</option>
                            <option value="TEC Committee">Evaluation Committee</option>
                            <option value="Receiving Committee">Receiving Committee</option>
                        </select>
                    </div>

                    <!-- Secretary Dropdown -->
                    <div class="mb-3">
                        <label for="secretary" class="form-label">Secretary</label>
                        <select class="form-select" id="secretary" name="secretary" required>
                            <option value="" selected disabled>Select Secretary</option>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Chairman Dropdown -->
                    <div class="mb-3">
                        <label for="chairman" class="form-label">Chairman</label>
                        <select class="form-select" id="chairman" name="chairman" required>
                            <option value="" selected disabled>Select Chairman</option>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary float-end">Create Committee</button>
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary">Back</a> <!-- Back button -->
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/defaultCommiteeCreate.blade.php ENDPATH**/ ?>