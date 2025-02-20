<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h1>Committee Approval</h1>
                <div class="table-responsive text-nowrap p-3">
                    <table id="datatable2" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Committee Name</th>
                                <th>Committee Type</th>
                                <th>Product Names</th>
                                <th>Specs</th>
                                <th>Quantities</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_id => $committeeGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <!-- Row for Demand Committee -->
                                <?php if($committeeGroup->firstWhere('demand_committee_id')): ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>

                                        <!-- Demand Committee Name -->
                                        <td>
                                            <?php
                                                $demandCommittee = $committeeGroup->firstWhere('demand_committee_id');
                                            ?>
                                            <?php if($demandCommittee && $demandCommittee->committeeName): ?>
                                                <?php echo e($demandCommittee->committeeName->name); ?> (Demand)
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>

                                        <!-- Committee Type -->
                                        <td>Demand</td>

                                        <!-- Combine Product Names in one cell for Demand -->
                                        <td>
                                            <?php $__currentLoopData = $committeeGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($committee->demand_committee_id): ?>
                                                    <?php echo e($committee->product->product_name); ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <!-- Combine Specs in one cell for Demand -->
                                        <td>
                                            <?php $__currentLoopData = $committeeGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($committee->demand_committee_id): ?>
                                                    <?php echo $committee->note; ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <!-- Combine Quantities in one cell for Demand -->
                                        <td>
                                            <?php $__currentLoopData = $committeeGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($committee->demand_committee_id): ?>
                                                    <?php echo e($committee->quantity); ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <!-- Actions for Demand Committee -->
                                        <td>
                                            <?php
                                                $needsApproval = $committeeGroup
                                                    ->where('demand_committee_id')
                                                    ->contains('status', 0);
                                                $firstDemandCommittee = $committeeGroup->firstWhere(
                                                    'demand_committee_id',
                                                );
                                                $signature = $committeeSignatures
                                                    ->where('requisition_id', $requisition_id)
                                                    ->where('committee_type', 'Demand')
                                                    ->where('is_active', 1)
                                                    ->first();
                                                $notShow = $committeeGroup
                                                    ->where('demand_committee_id')
                                                    ->contains('status', 11);

                                                $notShow2 = $committeeGroup
                                                    ->where('demand_committee_id')
                                                    ->contains('status', 1);
                                                // dd($needsApproval);

                                            ?>

                                            <?php if($needsApproval): ?>
                                                <!-- Approve button for Demand -->
                                                <form
                                                    action="<?php echo e(route('vc.approved', $firstDemandCommittee->requisition_id)); ?>"
                                                    method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bx bx-check me-1"></i> Approve
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <!-- Show report button for Demand -->
                                            <?php if($firstDemandCommittee): ?>
                                                <a href="<?php echo e(route('committee.demandReport', ['id' => $firstDemandCommittee->demand_committee_id, 'requisition_id' => $firstDemandCommittee->requisition_id])); ?>"
                                                    class="btn btn-primary">
                                                    <i class="bx bx-show me-1"></i> Show Report
                                                </a>
                                            <?php endif; ?>

                                            <?php if($signature && !$needsApproval || ($notShow2 && $notShow)): ?>
                                                <form
                                                    action="<?php echo e(route('committee.send', ['committee_id' => $firstDemandCommittee->demand_committee_id, 'signature_id' => $signature->id])); ?>"
                                                    method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-info">
                                                        <i class="bx bx-send me-1"></i> Send
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <!-- Row for Tech Committee -->
                                <?php if($committeeGroup->firstWhere('tech_committee_id')): ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>

                                        <!-- Tech Committee Name -->
                                        <td>
                                            <?php
                                                $techCommittee = $committeeGroup->firstWhere('tech_committee_id');
                                            ?>
                                            <?php if($techCommittee && $techCommittee->committeeTechName): ?>
                                                <?php echo e($techCommittee->committeeTechName->name); ?> (Tech)
                                            <?php else: ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>

                                        <!-- Committee Type -->
                                        <td>Tech</td>

                                        <!-- Combine Product Names in one cell for Tech -->
                                        <td>
                                            <?php $__currentLoopData = $committeeGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($committee->tech_committee_id): ?>
                                                    <?php echo e($committee->product->product_name); ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <!-- Combine Specs in one cell for Tech -->
                                        <td>
                                            <?php $__currentLoopData = $committeeGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($committee->tech_committee_id): ?>
                                                    <?php echo $committee->note; ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <!-- Combine Quantities in one cell for Tech -->
                                        <td>
                                            <?php $__currentLoopData = $committeeGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($committee->tech_committee_id): ?>
                                                    <?php echo e($committee->quantity); ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                        <!-- Actions for Tech Committee -->
                                        <td>
                                            <?php
                                                $needsApproval = $committeeGroup
                                                    ->where('tech_committee_id')
                                                    ->contains('status', 4);
                                                $firstTechCommittee = $committeeGroup->firstWhere('tech_committee_id');
                                                $signature = $committeeSignatures
                                                    ->where('requisition_id', $requisition_id)
                                                    ->where('committee_type', 'Tech')
                                                    ->where('is_active', 1)
                                                    ->first();
                                                $notShow = $committeeGroup
                                                    ->where('tech_committee_id')
                                                    ->contains('status', 13);

                                                $notShow2 = $committeeGroup
                                                    ->where('tech_committee_id')
                                                    ->contains('status', 1);

                                                // dd($committeeGroup);
                                                //     // dd($needsApproval);
                                                //     dd($committeeGroup.committeeTechName);
                                            ?>

                                            <?php if($needsApproval): ?>
                                                <!-- Approve button for Tech -->
                                                <form
                                                    action="<?php echo e(route('vc.approved.tech', $firstTechCommittee->requisition_id)); ?>"
                                                    method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="bx bx-check me-1"></i> Approve
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <!-- Show report button for Tech -->
                                            <?php if($firstTechCommittee): ?>
                                                <a href="<?php echo e(route('committee.report', ['id' => $firstTechCommittee->tech_committee_id, 'requisition_id' => $firstTechCommittee->requisition_id])); ?>"
                                                    class="btn btn-primary">
                                                    <i class="bx bx-show me-1"></i> Show Report
                                                </a>
                                            <?php endif; ?>

                                            <?php if($signature && !$needsApproval && $notShow2 && $notShow): ?>
                                                <form
                                                    action="<?php echo e(route('committee.send', ['committee_id' => $firstTechCommittee->tech_committee_id, 'signature_id' => $signature->id])); ?>"
                                                    method="POST" style="display:inline;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-info">
                                                        <i class="bx bx-send me-1"></i> Send
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/vc_approve.blade.php ENDPATH**/ ?>