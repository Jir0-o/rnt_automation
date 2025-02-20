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
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="Requisitions-Table">
                            <?php $counter = 1; ?>
                            <?php $__currentLoopData = $oceLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $oceList): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isSecretary = $oceList->secretary == auth()->user()->id;
                                    $isChairman = $oceList->chairman_id == auth()->user()->id;
                                    $isProcurementAdmin =
                                        auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin';
                                ?>

                                <?php if(
                                    ($oceList->status == 3 && $isSecretary) ||
                                        ($oceList->status == 4 && $isChairman) ||
                                        ($oceList->status == 7 && $isChairman)): ?>
                                    <tr>
                                        <td><?php echo e($counter++); ?></td>
                                        <td><?php echo e($oceList->requisition->requisition_no); ?></td>
                                        <td><?php echo e($oceList->name); ?></td>
                                        <td><?php echo e($oceList->committee_type); ?></td>
                                        <td><?php echo e($isSecretary ? 'Secretary' : 'Chairman'); ?></td>
                                        <td>
                                            <?php if($oceList->status == 3 || $oceList->status == 4): ?>
                                                <span class="badge bg-warning">Pending addition of values...</span>
                                            <?php elseif($oceList->status == 7): ?>
                                                <span class="badge bg-danger">Reject by VC</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>

                                            <?php if($oceList->status == 3 || $oceList->status == 4 || ($oceList->status == 7 && $isChairman)): ?>
                                                <a href="<?php echo e(route('show.report', ['id' => $oceList->requisition_id])); ?>">
                                                    <button type="button" class="btn btn-primary ">
                                                        <i class="bx bx-show me-1"></i> Show
                                                    </button>
                                                </a>
                                                <a
                                                    href="<?php echo e(route('oce.add.product.values', ['id' => $oceList->requisition_id])); ?>">
                                                    <button type="button" class="btn btn-success ">
                                                        <i class="bx bx-check me-1"></i> Process
                                                    </button>
                                                </a>

                                                <a href="<?php echo e(route('oce.send', ['id' => $oceList->requisition_id])); ?>">
                                                    <button type="button" class="btn btn-info">
                                                        <i class="bx bx-paper-plane me-1"></i> Send
                                                    </button>
                                                </a>
                                                <a
                                                    href="<?php echo e(route('oce.committee.report', ['id' => $oceList->id, 'requisition_id' => $oceList->requisition_id])); ?>">
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="bx bx-show me-1"></i> Report
                                                    </button>
                                                </a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php elseif(
                                    ($oceList->status == 4 && $isSecretary) ||
                                        ($oceList->status >= 5 && $oceList->status <= 8 && ($isSecretary || $isChairman)) ||
                                        ($oceList->status == 3 && $isChairman)): ?>
                                    <tr>
                                        <td><?php echo e($counter++); ?></td>
                                        <td><?php echo e($oceList->requisition->requisition_no); ?></td>
                                        <td><?php echo e($oceList->name); ?></td>
                                        <td><?php echo e($oceList->committee_type); ?></td>
                                        <td><?php echo e($isSecretary ? 'Secretary' : 'Chairman'); ?></td>
                                        <td>
                                            <?php if($oceList->status == 4): ?>
                                                <span class="badge bg-info">Waiting for Chairman review..</span>
                                            <?php elseif($oceList->status == 5): ?>
                                                <span class="badge bg-info"> Waiting for VC sir approval..</span>
                                            <?php elseif($oceList->status == 6): ?>
                                                <span class="badge bg-success">Approved by VC</span>
                                            <?php elseif($oceList->status == 7): ?>
                                                <span class="badge bg-danger">Reject by VC</span>
                                            <?php elseif($oceList->status == 8): ?>
                                                <span class="badge bg-secondary">Working on next steps</span>
                                            <?php elseif($oceList->status == 3): ?>
                                                <span class="badge bg-info">Waiting for Secretary review..</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            
                                            <a href="<?php echo e(route('show.report', ['id' => $oceList->requisition_id])); ?>">
                                                <button type="button" class="btn btn-primary ">
                                                    <i class="bx bx-show me-1"></i> Show
                                                </button>
                                            </a>
                                            <a
                                                href="<?php echo e(route('oce.committee.report', ['id' => $oceList->id, 'requisition_id' => $oceList->requisition_id])); ?>">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="bx bx-show me-1"></i> Report
                                                </button>
                                            </a>
                                            
                                            <?php if($oceList->status == 6): ?>
                                            <a href="<?php echo e(route('create.initiator', ['id' => $oceList->requisition_id])); ?>">
                                                <button type="button" class="btn btn-success btn-primary ">
                                                    <i class="bx bx-plus"></i> Create File &
                                                    Initiator
                                                </button>
                                            </a>
                                            <?php endif; ?>
                                            
                                            
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <?php if($isProcurementAdmin && !$isSecretary && !$isChairman && $oceList->status != 6 && $oceList->status <= 7): ?>
                                    <tr>
                                        <td><?php echo e($counter++); ?></td>
                                        <td><?php echo e($oceList->requisition->requisition_no); ?></td>
                                        <td><?php echo e($oceList->name); ?></td>
                                        <td><?php echo e($oceList->committee_type); ?></td>
                                        <td>Admin</td>
                                        <td>
                                            <?php if($oceList->status == 4): ?>
                                                <span class="badge bg-info">Waiting for Chairman review..</span>
                                            <?php elseif($oceList->status == 3): ?>
                                                <span class="badge bg-info"> Waiting for Secretary review..</span>
                                            <?php elseif($oceList->status == 5): ?>
                                                <span class="badge bg-info"> Waiting for VC sir approval..</span>
                                            <?php elseif($oceList->status == 6): ?>
                                                <span class="badge bg-success">Approved by VC</span>
                                            <?php elseif($oceList->status == 7): ?>
                                                <span class="badge bg-danger">Reject by VC</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            
                                            <a href="<?php echo e(route('show.report', ['id' => $oceList->requisition_id])); ?>">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="bx bx-show me-1"></i> Show
                                                </button>
                                            </a>
                                            <a
                                                href="<?php echo e(route('oce.committee.report', ['id' => $oceList->id, 'requisition_id' => $oceList->requisition_id])); ?>">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="bx bx-show me-1"></i> Report
                                                </button>
                                            </a>

                                            <a href="<?php echo e(route('create.initiator', ['id' => $oceList->requisition_id])); ?>">
                                                <button type="button" class="btn btn-success btn-primary ">
                                                    <i class="bx bx-plus"></i> Create File &
                                                    Initiator
                                                </button>
                                            </a>


                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!--/ Permissions -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/oceCommittee.blade.php ENDPATH**/ ?>