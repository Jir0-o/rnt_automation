
<?php $__env->startSection('content'); ?>

    <div class="row mt-5">
        <div class="col-12 col-md-12 mb-3">
            <!-- Left Side -->
            <div class="card card-default">
                <div class="card-body">

                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">Product List</h5>
                            <div class="table-responsive text-nowrap p-3">
                                <table id="Temp_Requisitions_Table" class="table">
                                    <thead>
                                        <?php
                                            $totalQuantity = 0;
                                            $isSecretary =
                                                isset($committee) && $committee->secretary == auth()->user()->id;
                                            $isChairman =
                                                isset($committee) && $committee->chairman_id == auth()->user()->id;
                                            // $isProcurementAdmin = auth()->check() && auth()->user()->roles->first()->name == 'Procurement Admin';
                                            // dd($committee);
                                        ?>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            
                                            
                                            <?php if(
                                                (isset($committee) && $committee->status == 3 && $isSecretary) ||
                                                    (isset($committee) && $committee->status == 4 && $isChairman) ||
                                                    (isset($committee) && $committee->status == 7 && $isChairman)): ?>
                                                <th>Unit Price</th>
                                                <th>Total Value</th>
                                            <?php elseif(auth()->user()->designation_id == 3): ?>
                                                <th>Unit Price</th>
                                                <th>Total Value</th>
                                            <?php endif; ?>
                                            
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="Temp_Requisitions_Table_Data">


                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->index + 1); ?></td>
                                                <td><?php echo e($product->product->product_name); ?></td>
                                                <td><?php echo e($product->quantity); ?></td>
                                                
                                                
                                                <?php if(
                                                    (isset($committee) && $committee->status == 3 && $isSecretary) ||
                                                        (isset($committee) && $committee->status == 4 && $isChairman) ||
                                                        (isset($committee) && $committee->status == 7 && $isChairman)): ?>
                                                    <td><?php echo e($product->unit_price); ?></td>
                                                    <td class="text-end total-value">
                                                        <?php echo e($product->total_price ?? 0); ?>

                                                    </td>
                                                <?php elseif(auth()->user()->designation_id == 3): ?>
                                                    <td><?php echo e($product->unit_price); ?></td>
                                                    <td class="text-end total-value">
                                                        <?php echo e($product->total_price ?? 0); ?>

                                                    </td>
                                                <?php endif; ?>
                                                
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

                                            
                                            
                                            <?php if((isset($committee) && $committee->status == 3 && $isSecretary) ||
                                                    (isset($committee) && $committee->status == 4 && $isChairman) ||
                                                    (isset($committee) && $committee->status == 7 && $isChairman)): ?>
                                                <td></td>
                                                <td id="final-value" class="text-end fw-bold">0</td>
                                            <?php elseif(auth()->user()->designation_id == 3): ?>
                                                <td></td>
                                                <td id="final-value" class="text-end fw-bold">0</td>
                                            <?php endif; ?>
                                            
                                        </tr>
                                    </tfoot>

                                </table>


                                <?php if(auth()->user()->designation_id == 3): ?>
                                    <?php if(isset($committee) && $committee->status != 8): ?>
                                        <div class="d-flex justify-content-end mt-4" id='buttons-group'>
                                            <?php if(isset($committee) && $committee->status != 6): ?>
                                                <a href="<?php echo e(route('approve.oce', ['req_id' => $committee->requisition_id])); ?>"
                                                    class="approve-link approve-btn">
                                                    <button class="btn btn-primary me-2"><i
                                                            class="menu-icon tf-icons bx bx-check"></i>Approve</button>
                                                </a>
                                            <?php endif; ?>
                                            <?php if(isset($committee) && $committee->status != 7): ?>
                                            <button class="btn btn-danger reject-btn"
                                                data-requisition_id="<?php echo e($committee->requisition_id); ?>"><i
                                                    class='bx bx-x'></i>Reject
                                            </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if(auth()->user()->roles->first()->name == 'Procurement Admin' && $committee == null): ?>
                                    <div class="float-end mt-4">
                                        <a href="javascript:void(0);" onclick="confirmIsDpm('<?php echo e(route('isDpm', ['id' => $products[0]->requisition_id])); ?>')">
                                            <button type="button" class="btn btn-success " data-id="" data-requisition-id="" data-status="2">
                                                <i class="bx bx-check me-1"></i>Is_DPM
                                            </button>
                                        </a>
                                        <a href="javascript:void(0);" onclick="confirmIsOce('<?php echo e(route('dpm.oce', ['id' => $products[0]->requisition_id])); ?>')">
                                            <button type="button" class="btn btn-info" data-id="" data-requisition-id="" data-status="2">
                                                <i class="bx bx-check me-1"></i>Is_OCE
                                            </button>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <?php if((isset($committee) && $committee->status == 3 && $isSecretary) || (isset($committee) && $committee->status == 4 && $isChairman) || (isset($committee) && $committee->status == 7 && $isChairman)): ?>
                                    <div class="float-end mt-4">
                                        <a href="<?php echo e(route('oce.add.product.values', ['id' => $committee->requisition_id])); ?>">
                                            <button type="button" class="btn btn-success ">
                                                <i class="bx bx-check me-1"></i> Add Values
                                            </button>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <?php if(auth()->user()->roles->first()->name == 'Procurement Admin' && (isset($committee) && $committee->status == 6)): ?>
                                    <div class="float-end mt-4">
                                        <a href="<?php echo e(route('create.initiator',['id'=>  $committee->requisition_id])); ?>">
                                            <button type="button" class="btn btn-success btn-primary ">
                                                <i class="bx bx-plus" style="margin-left: -7px; margin-right: 3px;"></i> Create File & Initiator
                                            </button>
                                        </a>
                                    </div>
                                <?php endif; ?>


                            </div>
                        </div>
                    </div>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary mt-1">
                        <i class="fas fa-arrow-left mx-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

    </div>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.approve-btn', function(e) {
                e.preventDefault();
                $('#productList').modal('hide');
                var approveLink = $(this).attr('href'); // Store the approve link

                Swal.fire({
                    icon: "success",
                    title: "Approve",
                    text: "Are you sure you want to approve?",
                    showCancelButton: true,
                    confirmButtonText: 'Yes, approve it!',
                    cancelButtonText: 'Cancel',

                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = approveLink; // Proceed with approval
                    } else {
                        // Reopen the modal if cancel is clicked
                        $('#productList').modal('show');
                    }
                });
            });

            $(document).on('click', '.reject-btn', function(e) {
                e.preventDefault();
                $('#productList').modal('hide');
                Swal.fire({
                    icon: "error",
                    title: "Reject",
                    text: "Please provide a reason for rejection:",
                    input: 'textarea',
                    inputPlaceholder: 'Enter your reason here...',
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var rejectionReason = result.value;

                        var requisition_id = $(this).data('requisition_id');

                        // Handle the rejection reason, for example, send it to the server
                        $.ajax({
                            url: "<?php echo e(route('reject.oce')); ?>",
                            type: 'POST',
                            data: {
                                requisition_id: requisition_id,
                                reason: rejectionReason
                            },
                            success: function(response) {
                                window.location.href =
                                    "<?php echo e(route('oce.approval.list')); ?>";
                                // console.log(response);
                                Toastify({
                                    text: 'Reject successfull',
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "green",
                                    stopOnFocus: true,
                                }).showToast();

                                // setTimeout(function() {
                                //     location.reload();
                                // }, 1000);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error submitting rejection reason:',
                                    error);
                            }
                        });
                    }
                });
            });






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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/showReport.blade.php ENDPATH**/ ?>