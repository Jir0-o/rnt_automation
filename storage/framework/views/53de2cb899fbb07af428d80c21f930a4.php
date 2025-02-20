
<?php $__env->startSection('content'); ?>
    <div class="row mt-5">
        <div class="col-12 col-md-12 mb-3">
            <!-- Left Side -->
            <div class="card card-default">
                <div class="card-body">
                    <form action="<?php echo e(route('update.product.values', ['rq_id' => $rq_id])); ?>" method="post"
                        id="updateProductForm">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">Product List</h5>
                                <div class="table-responsive text-nowrap p-3">
                                    <table id="Temp_Requisitions_Table" class="table">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total Value</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0" id="Temp_Requisitions_Table_Data">
                                            <?php
                                                $totalQuantity = 0;
                                            ?>
                                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->index + 1); ?></td>
                                                    <td><?php echo e($product->product->product_name); ?></td>
                                                    <td><?php echo e($product->quantity); ?></td>
                                                    <td>
                                                        <input class="form-control unit-price"
                                                            value="<?php echo e($product->unit_price); ?>" type="number"
                                                            name="unitPrice[]" data-quantity="<?php echo e($product->quantity); ?>"
                                                            placeholder="Enter unit price" required>
                                                        <?php $__errorArgs = ['unitePrice'];
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
                                                    <td class="text-end total-value">
                                                        <?php echo e($product->total_price ?? 0); ?>

                                                        <input type="hidden" class="total-value-input" name="totalValue[]"
                                                            value="<?php echo e($product->total_price); ?>">
                                                    </td>
                                                    <input type="hidden" value="<?php echo e($product->id); ?>" name="id[]">
                                                </tr>
                                                <?php
                                                    $totalQuantity += $product->quantity;
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"><strong>Total Quantity</strong></td>
                                                <td id="total-quantity"><strong><?php echo e($totalQuantity); ?></strong></td>
                                                <td></td>
                                                <td id="final-value" class="text-end fw-bold">0</td>
                                            </tr>
                                        </tfoot>

                                    </table>

                                    

                                    <button class="btn btn-primary float-end mt-4" type="button"
                                        onclick="confirmSubmit()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary mt-3 float-start">
                        <i class="fas fa-arrow-left mx-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

    </div>


    <script>
        $(document).ready(function() {
            // Attach event handler to unit price input fields
            $('.unit-price').on('input', function() {
                var unitPrice = $(this).val();

                var quantity = $(this).data('quantity');

                var totalValue = unitPrice * quantity;

                var totalValueCell = $(this).closest('tr').find('.total-value');

                totalValueCell.contents().first().replaceWith(totalValue.toFixed(2) + ' ');

                totalValueCell.find('.total-value-input').val(totalValue.toFixed(2));

                // Update the final value
                updateFinalValue();
            });


            function updateFinalValue() {
                var finalValue = 0;
                $('.total-value').each(function() {
                    finalValue += parseFloat($(this).text());
                });
                $('#final-value').text(finalValue.toFixed(2));
            }
            updateFinalValue();
        });

        function confirmSubmit() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Once submitted, you won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateProductForm').submit();
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/oceAddProductValue.blade.php ENDPATH**/ ?>