

<?php $__env->startSection('content'); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Invoice</h5>
                <a href="<?php echo e(route('get-invoice.index')); ?>" class="btn btn-success">
                    <i class="bx bx-plus"></i> Create Invoice
                </a>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="Requisitions_Table" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Challan No</th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Categories-Table">
                        <?php $__currentLoopData = $requisition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($subCategory->requisition_no); ?></td>
                            <td><?php echo e($subCategory->invoice_no); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($subCategory->invoice_date)->format('d-F-Y')); ?></td>
                            <td>
                                <?php if($subCategory->is_active == 0): ?>
                                <span class="badge bg-warning">Pending</span>
                                <?php elseif($subCategory->is_active == 1): ?>
                                <span class="badge bg-success">Approved</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary showInvoice" 
                                data-id="<?php echo e($subCategory->id); ?>" 
                                onclick="window.location='<?php echo e(route('invoice.show', $subCategory->id)); ?>'">
                                <i class="bx bx-show-alt me-1"></i> Show
                            </button>
                            <button type="button" class="btn btn-warning showInvoice" 
                                data-id="<?php echo e($subCategory->id); ?>" 
                                onclick="window.location='<?php echo e(route('invoice.print', $subCategory->id)); ?>'">
                                <i class="bx bx-printer me-1"></i>Print
                            </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/backend/requisitions/invoice_create.blade.php ENDPATH**/ ?>