

<?php $__env->startSection('content'); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Audit Report List</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable2" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Specefication</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($product->product_name); ?></td>
                            <td><?php echo e($product->spec); ?></td>
                            <td><?php echo e($product->final_quantity); ?></td>
                            <td>
                                <a href="<?php echo e(route('audit-report', ['product_id' => $product->id])); ?>">
                                    <button class="btn btn-primary">Show Audit</button></a>

                                <a href="<?php echo e(route('product.print', $product->id)); ?>" target="_blank">
                                    <button class="btn btn-info" id="printButton">
                                        <i class="bx bx-printer me-1"></i>
                                        Print
                                    </button>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                </button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/backend/initiator_file/leisureReport.blade.php ENDPATH**/ ?>