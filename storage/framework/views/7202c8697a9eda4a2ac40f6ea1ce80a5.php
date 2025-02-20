<?php $__env->startSection('content'); ?>
    <div class="row mt-5">
        <div class="col-12 col-md-12 col-lg-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5>OCE Approval List</h5>
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
                            <?php $__currentLoopData = $approvalLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                <tr>
                                    <td><?php echo e($loop->index + 1); ?></td>
                                    <td><?php echo e($list->requisition->requisition_no); ?></td>
                                    <td><?php echo e($list->name); ?></td>
                                    <td><?php echo e($list->committee_type); ?></td>
                                    <td>
                                        <?php if($list->status == 5): ?>
                                            <span class="badge bg-warning">Waiting for approval..</span>
                                        <?php elseif($list->status == 6): ?>
                                            <span class="badge bg-success">Approved</span>
                                        <?php elseif($list->status == 7): ?>
                                            <span class="badge bg-danger">Reject</span>
                                        <?php elseif($list->status == 8): ?>
                                            <span class="badge bg-secondary">Working on next steps</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>

                                        <a href="<?php echo e(route('show.report', ['id' => $list->requisition_id])); ?>">
                                            <button type="button" class="btn btn-primary ">
                                                <i class="bx bx-show me-1"></i> Show
                                            </button>
                                        </a>
                                        <?php if(!($list->status > 7)): ?>
                                            <button type="button" class="btn btn-success oce-details"
                                                data-requisition_id = "<?php echo e($list->requisition_id); ?>">
                                                <i class="bx bx-check me-1"></i> Action
                                            </button>
                                        <?php endif; ?>
                                            <a href="<?php echo e(route('oce.committee.report', ['id' => $list->id, 'requisition_id' => $list->requisition_id])); ?>">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="bx bx-show me-1"></i> Report
                                                </button>
                                            </a>

                                        

                                    </td>
                                </tr>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>

                </div>
            </div>
            <!--/ Permissions -->

            <!-- show product list Modal -->
            <div class="modal fade" id="productList" tabindex="-1" aria-labelledby="CategoryLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content p-5">
                        <h5 class="text-center">Products details</h5>
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
                            <tbody class="table-border-bottom-0" id="all_products">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"><strong>Total Quantity</strong></td>
                                    <td id="total-quantity"><strong></strong></td>
                                    <td></td>
                                    <td id="final-value" class="text-end fw-bold">0</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
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

            // fetch all products
            $(document).on('click', '.oce-details', function(e) {
                e.preventDefault();

                var requisition_id = $(this).data('requisition_id');
                // console.log(requisition_id);
                $.ajax({
                    url: "<?php echo e(route('oce.product.list')); ?>",
                    type: 'GET',
                    data: {
                        requisition_id: requisition_id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            var products = response.data;
                            var totalQuantity = 0;
                            var finalValue = 0;

                            $('#all_products').empty();

                            $.each(products, function(index, product) {
                                var totalValue = product.unit_price * product.quantity;
                                totalQuantity += product.quantity;
                                finalValue += totalValue;

                                var row = `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${product.product.product_name}</td>
                                        <td>${product.quantity}</td>
                                        <td>${product.unit_price}</td>
                                        <td>${totalValue}</td>
                                    </tr>
                                `;
                                $('#all_products').append(row);
                            });

                            $('#total-quantity strong').text(totalQuantity);
                            $('#final-value').text(finalValue.toFixed(2));

                            // Append buttons div
                            $('#buttons-group').remove();
                            var buttonsDiv = `
                                <div class="d-flex justify-content-end mt-4" id='buttons-group'>
                                    ${response.committee.status != 6 ? ` <a href="<?php echo e(route('approve.oce', ['req_id' => ':requisition_id'])); ?>" class="approve-link approve-btn">
                                            <button class="btn btn-primary me-2"><i class="menu-icon tf-icons bx bx-check"></i>Approve</button>
                                        </a>` : ''}

                                    ${response.committee.status != 7 ? ` <button class="btn btn-danger reject-btn" data-requisition_id="${requisition_id}"><i class='bx bx-x'></i>Reject</button>` : ''}

                                </div>
                            `;
                            buttonsDiv = buttonsDiv.replace(':requisition_id', requisition_id);

                            $('#Temp_Requisitions_Table').after(buttonsDiv);
                        }

                        $('#productList').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product details:', error);
                    }
                });
            });

            $(document).on('click', '.reject-btn', function(e) {
                e.preventDefault();
                $('#productList').modal('hide');
                Swal.fire({
                    icon: "error",
                    title: "Reject",
                    text: "Do You Want To Reject?",
                    // input: 'textarea',
                    // inputPlaceholder: 'Enter your reason here...',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // var rejectionReason = result.value;

                        var requisition_id = $(this).data('requisition_id');

                        // Handle the rejection reason, for example, send it to the server
                        $.ajax({
                            url: "<?php echo e(route('reject.oce')); ?>",
                            type: 'POST',
                            data: {
                                requisition_id: requisition_id,
                                // reason: rejectionReason
                            },
                            success: function(response) {
                                console.log(response);
                                Toastify({
                                    text: response.message,
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "green",
                                    stopOnFocus: true,
                                }).showToast();

                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error submitting rejection reason:',
                                    error);
                            }
                        });
                    }
                });
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

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/dpmAndOce/oceApproval.blade.php ENDPATH**/ ?>