
<?php $__env->startSection('content'); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 20px;
        text-align: center;
    }
    .container {
        width: 80%;
        margin: auto;
        border: 2px solid #fff;
        padding: 20px;
    }
    h1 {
        margin: 0;
    }
    .title {
        font-size: 18px;
        font-style: italic;
        text-decoration: underline;
    }
    .details {
        text-align: left;
        margin-top: 10px;
        font-size: 14px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    table, th, td {
        border: 1px solid #fff;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    .total {
        font-weight: bold;
    }
    .signature {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .signature div {
        text-align: center;
        flex: 1;
    }
    .footer {
        margin-top: 20px;
        font-size: 12px;
    }
    .footer a {
        color: #00f;
        text-decoration: none;
    }
    .note {
        font-size: 12px;
        margin-top: 10px;
    }
</style>

<div class="card">
    <!-- Modal Structure -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Return Requisition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Textbox for user's input -->
                <textarea id="returnReason" name="newreturn-text" class="form-control" rows="5" placeholder="Enter reason for returning"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitReturn">Send</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="header" style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
        <!-- Left Section: Logo and Company Name -->
        <div style="display: flex; flex-direction: column; align-items: flex-start;">
            <div style="display: flex; align-items: center;">
                <div class="logo">
                    <img src="<?php echo e(asset('RNT-Logo.png')); ?>" alt="Logo" style="height: 50px; border-radius: 50%;">
                </div>
                <h1 style="margin: 0; margin-left: 10px;">RIZTU CORPORATION</h1>
            </div>
            <p style="font-size: 12px; margin-left: 70px; margin-top: 2px;">Be with us, be the best</p>
        </div>

        <!-- Right Section: CHALLAN -->
        <div class="display" style="border: 2px solid black; padding: 3px; font-weight: bold; border-radius: 5px;">
            ORDER
        </div>
    </div> 


        <!-- Divider Line -->
        <hr style="border: 1px solid black; margin-top: 10px; margin-bottom: 10px;">

        <!-- Table for Buyer Name, Address, Date, Challan No, Purchase Order No, and S.R No -->
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 10px;">
            <tr>
                <!-- Left Side -->
                <td style="border: 1px solid black; padding: 0px; width: 50%; vertical-align: top;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Buyer Name:</strong> <?php echo e($requisition->buyer_name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0px 0px 5px;">
                                <strong>Address:</strong> <?php echo e($requisition->address); ?>

                            </td>
                        </tr>
                    </table>
                </td>

                <?php
                    use Carbon\Carbon;
                ?>

                <!-- Right Side -->
                <td style="border: 1px solid black; padding: 0px; width: 50%; vertical-align: top;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Date:</strong> <?php echo e(Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Order No: <span id="requisitionNo"><?php echo e($requisition->order_no); ?></span></strong> <!-- Add here -->
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0px 0px 5px;">
                                <strong>Order Type:</strong> 
                                <?php if($requisition->order_type == 1): ?>
                                    Cash Order
                                <?php elseif($requisition->order_type == 2): ?>
                                    Loan Order
                                <?php elseif($requisition->order_type == 3): ?>
                                    Sample Order
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">S.L</th>
                    <th style="border: 1px solid black; padding: 8px;">Product Name</th>
                    <th style="border: 1px solid black; padding: 8px;">Product Description</th>
                    <th style="border: 1px solid black; padding: 8px;">Unit</th>
                    <th style="border: 1px solid black; padding: 8px;">Type</th>
                    <th style="border: 1px solid black; padding: 8px;">Package Size</th>
                    <th style="border: 1px solid black; padding: 8px;">Quantity (Kg)</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1; 
                    $totalQuantity = 0;
                    $staticRowCount = 10; // Adjust this value for fixed empty rows
                    $dataCount = count($requisition->orderProducts);
                ?>
        
                <?php $__currentLoopData = $requisition->orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $quantityKg = $requisition_product->quantity * ($requisition_product->unit_package_size ?? 1); 
                        $totalQuantity += $quantityKg;
                    ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($i++); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->product->product_name); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->quantity ?? 'N/A'); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->unitType->name ?? 'N/A'); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->unit_package_size ?? 'N/A'); ?> KG</td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($quantityKg); ?> KG</td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                
        
                <!-- Total Row -->
                <tr>
                    <td colspan="6" style="border: 1px solid black; text-align: right; font-weight: bold; padding: 8px;">Total</td>
                    <td colspan="7" style="border: 1px solid black; padding: 8px; font-weight: bold;"><?php echo e($totalQuantity); ?> KG</td>
                </tr>
            </tbody>
        </table>

        <?php if($requisition->status ==12 ): ?>
        <strong>
            <span class="return-reason" style="text-align: left; margin-top: 30px;">
                Return Requisition Reason: <?php echo strip_tags($requisition->remarks ?? 'N/A'); ?>

            </span>
        </strong>
        
        <?php endif; ?>
        
        <p style="text-align: left; margin-top: 10px;">➡Received the above-mentioned products in good condition.</p>
        <p style="text-align: left; margin-top: -10px;">➡Sold Goods are not returnable or exchangeable.</p>
        <p style="text-align: left; margin-top: -10px;">➡No Claims will be entertained for shortages, etc. after acceptance/ delivery.</p>

        <!-- Divider Line -->
        <hr style="border: 1px solid black; margin-top: 10px; margin-bottom: 0px;">
        
    
        <div class="signatures" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>______________________</p>
                        <p><em>Received by</em></p>
                    </p>
                </div>
            </div>
        
            <!-- Store in Charge -->
            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>______________________</p> <!-- Underline moved above -->
                        <p><em>Store in Charge</em></p>
                    </p>
                </div>
            </div>

            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>______________________</p> <!-- Underline moved above -->
                        <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                    </p>
                </div>
            </div>
        </div>
        
        
    
        <div class="footer" style="text-align: center;">
            <p><strong>Corporate Office:</strong> House - 32, Flat-A3(3rd floor),Gareeb-e-Newaz Avenue, Sector-11, Uttara, Dhaka-1230</p>
            <p style="margin-top: -10px"><strong>Registered Office:</strong>  577, Nolvog, Block-A, Nishat Nagar,Turag, Dhaka-1230</p>
            <p style="margin-top: -10px">Cell: +88 01719 182832, +88 01717 822605, E-mail: <a href="mailto:riztucorporation@gmail.com">riztucorporation@gmail.com</a></p>
        </div>
    </div>
    

        <!-- Left side container for the Back button -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <button class="btn btn-secondary" type="button" id="back_button">
                    <i class='bx bx-arrow-back' style="margin-left: -7px; margin-right: 3px;"></i> Back
                </button>
            </div>
            <!-- Middle: Return button -->
            <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
             <?php if($requisition->status == 0): ?>
            <div>
                <button type="button" class="btn btn-warning returnRequisitionBtn" data-id="<?php echo e($requisition->id); ?>">
                    <i class="bx bx-undo me-1"></i> Return
                </button>
            </div>
             <?php endif; ?>
            <?php endif; ?>

            <!-- Right side container for the Send button -->
            <?php if($requisition->status == 11 || $requisition->status == 12 || $requisition->status == 13): ?>
            <div>
                <button type="button" class="btn btn-success sendRequisitionBtn" data-id="<?php echo e($requisition->id); ?>"
                    style="margin-right: 20px;">
                    <i class="bx bx-send me-1"></i> Send
                </button>
            </div>
            <?php endif; ?>
            <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
            <?php if($requisition->status == 0): ?>
            <button type="button" class="btn btn-success acceptOrderBtn" data-id="<?php echo e($requisition->id); ?>" style="margin-right:5px;">
                <i class="bx bx-check me-1"></i> Accept
                </button> 
                <button type="button" class="btn btn-danger rejectOrderBtn" data-id="<?php echo e($requisition->id); ?>" style="margin-right: 5px;">
                <i class="bx bx-x me-1"></i> Reject
            </button>  
            <?php endif; ?>
            <?php endif; ?>
            <?php if($requisition->status == 12 || $requisition->status == 13 || $requisition->status == 11): ?>
            <button type="button" class="btn btn-warning editReturnRequisitionBtn" data-id="<?php echo e($requisition->id); ?>" style="margin-right:5px;">
                <i class="bx bx-edit me-1"></i> Edit
            </button> 
            <button type="button" class="btn btn-danger deleteReturnRequisitionBtn" data-id="<?php echo e($requisition->id); ?>" style="margin-right: 5px;">
                <i class="bx bx-trash me-1"></i> Delete
            </button>  
            <?php else: ?>
            <div class="right-side" id="auth">
            </div>
            <?php endif; ?>
            <a href="<?php echo e(route('order.print', $requisition->id)); ?>" class=""
                target="_blank">
                <button class="btn btn-info">
                    <i class="bx bx-printer me-1"></i> Print
                </button>
            </a>
        </div>

<script>
    CKEDITOR.replace('newreturn-text');
</script>

        <script>
        $(document).ready(function() {

            // When the "Return" button is clicked
            $('.returnRequisitionBtn').click(function() {
                requisition_id = $(this).data('id'); // Get the requisition ID
                $('#returnModal').modal('show'); // Show the modal
            });

            $(document).on('click', '#back_button', function() {
                window.location.href = "<?php echo e(route('orders.index')); ?>";
            });

        $('#submitReturn').click(function() {
            const reason = CKEDITOR.instances['returnReason'].getData(); // Get data from CKEditor

            if (reason.trim() === '') {
                toastr.error('Please provide a reason for returning.'); // Show error message
                return;
            }

        $.ajax({
            url: "<?php echo e(route('orders.return', ':id')); ?>".replace(':id', requisition_id), 
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', 
                id: requisition_id,
                reason: reason
            },
            success: function(response) {
                $('#returnModal').modal('hide'); // Close the modal
                toastr.success('Order returned successfully.'); // Show success message
                setTimeout(function() {
                location.href = "<?php echo e(route('orders.index')); ?>";
                }, 1000); // 2-second delay before reload
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error);
                toastr.error('Failed to return Order. Please try again.'); // Show error message
            }
        });
    });

        // Delete requisition button click handler
        $(document).on('click', '.deleteReturnRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        Swal.fire({
            title: 'Do you want to delete this requisition?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo e(route('requisitions.delete', ':id')); ?>".replace(':id',
                        requisition_id),
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            Toastify({
                                text: "Requisition Deleted Successfully",
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#228B22",
                                stopOnFocus: true,
                            }).showToast();
                            location.href = "<?php echo e(route('requisitions.create')); ?>";
                        } else {
                            console.log(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log('Requisition deletion canceled');
            }
        });
    });
        // Accept auth requisition button click handler
        $(document).on('click', '.acceptOrderBtn', function() {
            console.log('accept');
            var requisition_id = $(this).data('id');
            $.ajax({
                url: "<?php echo e(route('orders.accept', ':id')); ?>".replace(':id',
                    requisition_id),
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                success: function(response) {
                    if (response.status) {
                        Toastify({
                            text: "Authorized Requisition Accepted Successfully",
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();
                        location.href = "<?php echo e(route('requisitions.add')); ?>";
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

            // Accept auth requisition button click handler
            $(document).on('click', '.rejectOrderBtn', function() {
            console.log('accept');
            var requisition_id = $(this).data('id');
            $.ajax({
                url: "<?php echo e(route('orders.reject', ':id')); ?>".replace(':id',
                    requisition_id),
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                success: function(response) {
                    if (response.status) {
                        Toastify({
                            text: "Authorized Requisition Accepted Successfully",
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();
                        location.href = "<?php echo e(route('orders.index')); ?>";
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).on('click', '.editReturnRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "<?php echo e(route('orders.edit', ':id')); ?>".replace(':id', requisition_id);
    });
            
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/backend/order/orderShow.blade.php ENDPATH**/ ?>