

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Default Committee List</h3>
                <a href="<?php echo e(route('create.default.committee')); ?>" class="btn btn-primary float-end">Create Default Committee</a>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap p-3">
                    <table id="datatable2" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Committee Name</th>
                                <th>Type</th>
                                <th>Chairman</th>
                                <th>Secretary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                            ?>
                            <?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($committee->name); ?></td>
                                    <td><?php echo e($committee->type); ?></td>
                                    <td><?php echo e($committee->chairmanUser->name); ?></td>
                                    <td><?php echo e($committee->secretaryUser->name); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/defaultCommitee.blade.php ENDPATH**/ ?>