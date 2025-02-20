
<?php $__env->startSection('content'); ?>
    <div class="row mt-5">
        <div class="col-12 col-md-12 col-lg-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5>OCE Committee List</h5>
                        </div>


                    </div>
                </div>
                <div class="table-responsive text-nowrap p-3">
                    <table id="datatable2" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Requisition No</th>
                                <th>Name</th>
                                <th>Committee Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="Requisitions-Table">
                            <?php $__currentLoopData = $oceLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $oceList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index + 1); ?></td>
                                    <td><?php echo e($oceList->requisition->requisition_no); ?></td>
                                    <td><?php echo e($oceList->name); ?></td>
                                    <td><?php echo e($oceList->committee_type); ?></td>

                                    <td>
                                        <?php if($oceList->status == 6): ?>
                                        <span class="badge bg-success">Approved by vc</span>
                                        <?php elseif($oceList->status == 8): ?>
                                            <span class="badge bg-secondary">File Created </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        
                                                <a href="<?php echo e(route('show.report',['id'=>$oceList->requisition_id])); ?>">
                                                    <button type="button" class="btn btn-primary ">
                                                        <i class="bx bx-show me-1"></i> Show
                                                    </button>
                                                </a>
                                                <?php if(!($oceList->status == 8)): ?>
                                                    <a href="<?php echo e(route('create.initiator',['id'=>  $oceList->requisition_id])); ?>">
                                                        <button type="button" class="btn btn-success btn-primary ">
                                                            <i class="bx bx-plus" style="margin-left: -7px; margin-right: 3px;"></i> Create File & Initiator
                                                        </button>
                                                    </a>
                                                <?php endif; ?>
                                                
                                                
                                            
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/ShowOceApprovelForAdmin.blade.php ENDPATH**/ ?>