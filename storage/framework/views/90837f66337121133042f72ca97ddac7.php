<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>All Demand and Tech Committees</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap p-3">
                    <table id="datatable2" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Requisition No</th>
                                <th>Demand Committee</th>
                                <th>Tech Committee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php $__currentLoopData = $committees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->index+1); ?></td>
                                    <td>
                                        <?php if($group->first()->requisition): ?>
                                            <?php echo e($group->first()->requisition->requisition_no); ?>

                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <?php
                                        $committee = \App\Models\Committee::where('requisition_id', $group->first()->requisition->id)->get();
                                        $demandCommittee = $committee->where('committee_type', 'Demand')->first();
                                        $techCommittee = $committee->where('committee_type', 'Tech')->first();
                                    ?>
                                    <td>
                                        <?php if($demandCommittee): ?>
                                            <?php echo e($demandCommittee->name); ?>

                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($techCommittee): ?>
                                            <?php echo e($techCommittee->name); ?>

                                        <?php else: ?>
                                            N/A
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Pending creation of DPM or OCE..</span>
                                    </td>

                                    <td>
                                        
                                                <a href="<?php echo e(route('show.report',['id'=>$group[0]->requisition_id])); ?>">
                                                    <button type="button" class="btn btn-primary " data-id="" data-requisition-id="" data-status="2">
                                                        <i class="bx bx-show me-1"></i>Show
                                                    </button>
                                                </a>
                                                <a href="javascript:void(0);" onclick="confirmIsDpm('<?php echo e(route('isDpm', ['id' => $group->first()->requisition_id])); ?>')">
                                                    <button type="button" class="btn btn-success " data-id="" data-requisition-id="" data-status="2">
                                                        <i class="bx bx-check me-1"></i>DPM
                                                    </button>
                                                </a>
                                                <a href="javascript:void(0);" onclick="confirmIsOce('<?php echo e(route('dpm.oce', ['id' => $group->first()->requisition_id])); ?>')">
                                                    <button type="button" class="btn btn-info " data-id="" data-requisition-id="" data-status="2">
                                                        <i class="bx bx-check me-1"></i>Is_OCE
                                                    </button>
                                                </a>
                                            
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmIsDpm(routeUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Create DPM...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = routeUrl;
            }
        })
    }

    function confirmIsOce(routeUrl) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Create OCE Committee...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes,'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = routeUrl;
            }
        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/showcommittees.blade.php ENDPATH**/ ?>