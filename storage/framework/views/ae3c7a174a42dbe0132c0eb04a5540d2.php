
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
                CHALLAN
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
                                <strong>Challan No.:</strong> <span id="requisitionNo"><?php echo e($requisition->requisition_no); ?></span>
                                <?php if($requisition->status == 0 || $requisition->status == 1): ?>
                                    <button id="editRequisitionNo" class="btn btn-sm btn-link"><i class="bx bx-edit"></i></button>
                                    <button id="cancelEditRequisitionNo" class="btn btn-sm btn-link" style="display: none;"><i class="bx bx-x"></i></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Purchase Order No:</strong> <!-- Add here -->
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Order No: <span id="requisitionNo"><?php echo e($requisition->sr_no); ?></span></strong> <!-- Add here -->
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0px 0px 5px;">
                                <strong>Challan Type:</strong> 
                                <?php if($requisition->requisition_type == 1): ?>
                                    Cash Challan
                                <?php elseif($requisition->requisition_type == 2): ?>
                                    Loan Challan
                                <?php elseif($requisition->requisition_type == 3): ?>
                                    Sample Challan
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
                    $dataCount = count($requisition->requisitionProducts);
                ?>
        
                <?php $__currentLoopData = $requisition->requisitionProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                <?php $__currentLoopData = $requisition->requisitionSignatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_signature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="margin-bottom: auto;">  <!-- Ensures each signature is separate -->
                        <!-- Signature Image -->
                        <img src="<?php echo e(asset('global_assets/user_images/signature/' . $requisition_signature->signature)); ?>" 
                             alt="Signature" width="100"> <br>
                             <?php echo e(Carbon::parse($requisition_signature->date)->format('d-F-Y')); ?><br>
                             <strong><?php echo e($requisition_signature->name); ?></strong><br>
                             <?php echo e($requisition_signature->designation); ?><br>

                        <p>______________________</p>
                        <!-- "For- RIZTU CORPORATION" below signature -->
                        <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($requisition->requisitionSignatures) == 0): ?>
                    <div style="margin-bottom: auto;">
                        <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                            <p>______________________</p>
                            <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                        </p>
                    </div>
                <?php endif; ?>
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
            <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                target="_blank">
                <button class="btn btn-info">
                    <i class="bx bx-printer me-1"></i> Print
                </button>
            </a>
        </div>
        

        <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
            <?php if($requisition->status == 0): ?>
            <div class="right-side" id="allocation">
                <!-- Additional buttons if needed -->
            </div>
            <?php endif; ?>
        <?php endif; ?>

        <script>
        var authUserId = '<?php echo e(Auth::id()); ?>';
        CKEDITOR.replace('newreturn-text');
        </script>

        <script>
        $(document).ready(function() {

             // edit return requisition button click handler
             $(document).on('click', '.editReturnRequisitionBtn', function() {
                    // Extract the requisition ID from the URL (e.g., /requisitions/view/45)
                    let url = window.location.pathname;
                    let requisition_id = url.substring(url.lastIndexOf('/') + 1);
                    
                    // Store the status in localStorage
                    var status = $(this).data('status');
                    
                    if (localStorage.getItem('status')) {
                        localStorage.removeItem('status');
                        localStorage.setItem('status', status);
                    } else {
                        localStorage.setItem('status', status);
                    }
                    
                    console.log(requisition_id);
                    
                    location.href = "<?php echo e(route('requisition.return', ':id')); ?>".replace(':id', requisition_id);
                });

            // Event listener for when the product is selected from the dropdown
            $('#product-name').on('change', function() {
                // Get the selected option
                let selectedOption = $(this).find('option:selected');

                // Extract spec and unit type data attributes from the selected option
                let spec = selectedOption.data('spec');
                let unitType = selectedOption.data('unit_type');

                // Set the values in the respective fields
                $('#spec').val(spec || 'N/A'); // If no spec, display 'N/A'
                $('#unit-type').val(unitType || 'N/A'); // If no unit type, display 'N/A'
            });


            var originalRequisitionNo = $('#requisitionNo').text().trim();
            var cancelEdit = false;
            

            // When the "Return" button is clicked
            $('.returnRequisitionBtn').click(function() {
                requisition_id = $(this).data('id'); // Get the requisition ID
                $('#returnModal').modal('show'); // Show the modal
            });

            // Handle edit button click
            $('#editRequisitionNo').on('click', function() {
                var requisitionNo = $('#requisitionNo').text().trim();
                $('#requisitionNo').html(
                    '<input type="text" id="requisitionNoInput" class="form-control form-control-sm" value="' +
                    requisitionNo + '">');
                $('#editRequisitionNo').hide();
                $('#cancelEditRequisitionNo').show();

                // Automatically focus the input field
                $('#requisitionNoInput').focus();

                // Handle the blur event or pressing Enter to save the new value
                $('#requisitionNoInput').on('blur', function() {
                    if (cancelEdit) {
                        cancelEdit = false;
                        return;
                    }

                    var updatedRequisitionNo = $(this).val().trim();

                    // Get the current URL
                    var currentUrl = window.location.href;

                    // Use a regular expression to extract the ID
                    var id = currentUrl.match(/requisitions\/(\d+)/)[1];
                    var requisition_id = id;

                    // Send an AJAX request to update the requisition number
                    $.ajax({
                        url: "<?php echo e(route('requisitions.number.update', ':id')); ?>".replace(
                            ':id',
                            requisition_id),
                        type: 'PUT',
                        headers: {
                            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                        },
                        data: {
                            requisition_no: updatedRequisitionNo,
                        },
                        success: function(response) {
                            if (response.status) {
                                Toastify({
                                    text: "Requisition Number Updated Successfully",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#228B22",
                                    stopOnFocus: true,
                                }).showToast();

                                $('#requisitionNo').text(response.data
                                    .requisition_no);
                                originalRequisitionNo = response.data
                                    .requisition_no;

                                $('#editRequisitionNo').show();
                                $('#cancelEditRequisitionNo').hide();
                            } else {
                                Toastify({
                                    text: response.message ||
                                        "Failed to update requisition number.",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#FF6347", // red color for errors
                                    stopOnFocus: true,
                                }).showToast();
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = "An error occurred.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.status === 422 && xhr.responseJSON
                                .errors) {
                                errorMessage = xhr.responseJSON.errors
                                    .requisition_no[0];
                            }

                            Toastify({
                                text: errorMessage,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#FF6347", // red color for errors
                                stopOnFocus: true,
                            }).showToast();

                            console.error('Error updating requisition number:', xhr
                                .responseText);
                        }
                    });
                });

                $('#requisitionNoInput').on('keypress', function(e) {
                    if (e.which == 13) { // Enter key pressed
                        $(this).blur();
                    }
                });
            });

            $(document).on('click', '#back_button', function() {
                window.location.href = "<?php echo e(route('requisitions.create')); ?>";
            });

            // send requisition button click handler
            $(document).on('click', '.sendRequisitionBtn', function() {
                var requisition_id = $(this).data('id');

                Swal.fire({
                    title: 'Do you want to send this requisition for authorization?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    reverseButtons: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?php echo e(route('requisitions.sent', ':id')); ?>".replace(
                                ':id',
                                requisition_id),
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' // CSRF token added here
                            },
                            success: function(response) {
                                if (response.status) {
                                    Toastify({
                                        text: "Requisition Sent Successfully",
                                        duration: 3000,
                                        gravity: "top",
                                        position: 'right',
                                        backgroundColor: "#228B22",
                                        stopOnFocus: true,
                                    }).showToast();
                                    location.href =
                                        "<?php echo e(route('requisitions.create')); ?>";
                                } else {
                                    console.log(response.message);
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        console.log('Requisition sending canceled');
                    }
                });
            });


            // Handle cancel button click
            $('#cancelEditRequisitionNo').on('click', function() {
                cancelEdit = true;
                $('#requisitionNo').text(originalRequisitionNo);
                $('#editRequisitionNo').show();
                $('#cancelEditRequisitionNo').hide();
            });

            // Get the current URL
            var currentUrl = window.location.href;

            // Use a regular expression to extract the ID
            var id = currentUrl.match(/requisitions\/(\d+)/)[1];
            var requisition_id = id;
            var status = localStorage.getItem('status');

            var requisition = <?php echo json_encode($requisition); ?>;
            var authUserId = "<?php echo e(auth()->user()->id); ?>";


            if (requisition.user.auth_by == authUserId && status == 0) {
                $('#auth').empty();
                $('#auth').append(`
                    <button type="button" class="btn btn-success acceptAuthrequisitionBtn"
                                        data-id="${requisition_id}" style="margin-right:5px;">Accept</button>
                                    <button type="button" class="btn btn-danger rejectrequisitionBtn"
                                    data-id="${requisition_id}">Reject</button>
                `);
            } else if (status == 1) {
                $('#allocation').empty();
                $('#allocation').append(`

                    <button type="button" class="btn btn-success acceptrequisitionBtn"
                                        data-id="${requisition_id}" style="margin-right:5px;">Accept</button>
                                    <button type="button" class="btn btn-danger rejectrequisitionBtn"
                                    data-id="${requisition_id}">Reject</button>
                `);
            } else {
                $('#auth').empty();
                $('#allocation').empty();
            }

            function loadUnitTypes() {
                $.ajax({
                    url: "<?php echo e(route('unit-types.index')); ?>",
                    type: "GET",
                    success: function(response) {
                        $('#unit-type, #edit-unit-type').empty();
                        $('#unit-type, #edit-unit-type').append(
                            '<option disabled selected>Select a Unit Type</option>');
                        response.data.forEach(function(unitType) {
                            $('#unit-type, #edit-unit-type').append('<option value="' +
                                unitType
                                .id + '">' + unitType.name + '</option>');
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            // Load sub categories
            function loadCategories() {
                $.ajax({
                    url: "<?php echo e(route('product-sub-categories.index')); ?>",
                    type: "GET",
                    success: function(response) {

                        $('#product-sub-category, #edit-product-sub-category').empty();
                        $('#product-sub-category, #edit-product-sub-category').append(
                            '<option disabled selected>Select a Sub Category</option>');
                        response.data.forEach(function(productSubCategories) {
                            $('#product-sub-category, #edit-product-sub-category').append(
                                '<option value="' + productSubCategories.id + '">' +
                                productSubCategories.product_sub_category_name +
                                '</option>'
                            );
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            // Load sub categories
            function loadSubCategories(categoryId) {
                var url = "<?php echo e(route('product-sub-categories.by-category', '')); ?>/" + categoryId;
                console.log("Fetching from URL:", url); // Debugging URL
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        $('#product-sub-category').empty().append(
                            '<option disabled selected>Select a Sub Category</option>');

                        // Clear existing subcategories
                        $('#edit-product-sub-category').empty().append(
                            '<option disabled selected>Select a Sub Category</option>'
                        );

                        response.data.forEach(function(subCategory) {
                            $('#product-sub-category').append(
                                '<option value="' + subCategory.id + '">' + subCategory
                                .product_sub_category_name + '</option>'
                            );

                            $('#edit-product-sub-category').append(
                                '<option value="' + subCategory.id + '">' + subCategory
                                .product_sub_category_name + '</option>'
                            );
                        });
                    },
                    error: function(err) {
                        console.error("Error fetching subcategories:", err);
                    }
                });
            }
            // Event listener for category change
            $('#product-category').change(function() {
                let categoryId = $(this).val();
                if (categoryId) {
                    loadSubCategories(categoryId);
                } else {
                    $('#product-sub-category').empty().append(
                        '<option disabled selected>Select a Sub Category</option>');
                }
            });

            function loadmyCategories() {
                $.ajax({
                    url: "<?php echo e(route('product-categories.catagory')); ?>",
                    type: "GET",
                    success: function(response) {
                        $('#product-category').empty().append(
                            '<option disabled selected>Select a Category</option>');

                        $('#edit-product-category').empty().append(
                            '<option disabled selected>Select a Category</option>');
                        response.data.forEach(function(category) {
                            $('#product-category').append(
                                '<option value="' + category.id + '">' + category
                                .product_category_name + '</option>'
                            );

                            $('#edit-product-category').append(
                                '<option value="' + category.id + '">' + category
                                .product_category_name + '</option>'
                            );
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }

            //Store create Product

            $('#Products-Submit').on('submit', function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                // Form data to send in the request
                var formData = {
                    'product_name': $('#product-name').val(),
                    'product_category_id': $('#product-category').val(),
                    'product_sub_categorie_id': $('#product-sub-category').val(),
                    'unit_type_id': $('#unit-type').val(),
                    'product_quantity': 0,
                    'product_specification': $('#spec').val(),
                    'unit_price': 0,
                };

                // AJAX request
                $.ajax({
                    url: "<?php echo e(route('products.missing')); ?>",
                    type: "POST",
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    processData: false,
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(response) {
                        if (response.status) {
                            // Display success Toastify message
                            Toastify({
                                text: response
                                    .message, // Display 'Product created successfully'
                                duration: 3000,
                                gravity: "top", // Position at the top
                                position: 'right',
                                backgroundColor: "#28a745", // Green background for success
                                stopOnFocus: true,
                            }).showToast();

                            // Optionally, reload the page or perform other actions
                            setTimeout(function() {},
                                1500); // Delay for a smoother experience
                        } else {
                            // Display error Toastify message for failure in response
                            Toastify({
                                text: response
                                    .message, // Display the message from the server
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#FF6347", // Red background for error
                                stopOnFocus: true,
                            }).showToast();

                            // Handle validation errors if provided
                            if (response.errors) {
                                $.each(response.errors, function(key, error) {
                                    $('#' + key + 'Error').text(error[
                                        0]); // Show validation errors in the form
                                });
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        var response = xhr.responseJSON;

                        // Display error Toastify message for server-side errors (500, 422, etc.)
                        Toastify({
                            text: response && response.message ? response.message :
                                'An unexpected error occurred.',
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#FF6347", // Red background for error
                            stopOnFocus: true,
                        }).showToast();

                        if (xhr.status === 422) {
                            // Display validation errors for 422 status (unprocessed data)
                            $.each(response.errors, function(key, error) {
                                $('#' + key.replace(/_/g, '-') + 'Error').text(
                                    error[0]);
                            });
                        }
                    },
                    complete: function() {
                        // Re-enable the submit button after request is complete
                        submitButton.prop('disabled', false);
                    }
                });
            });


            // Reject requisition button click handler
            $(document).on('click', '.rejectrequisitionBtn', function() {
                console.log('reject');
                var requisition_id = $(this).data('id');
                $.ajax({
                    url: "<?php echo e(route('requisitions.reject', ':id')); ?>".replace(':id',
                        requisition_id),
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            Toastify({
                                text: "Requisition Rejected Successfully",
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
            });

            // Accept requisition button click handler
            $(document).on('click', '.acceptrequisitionBtn', function() {
                var requisition_id = $(this).data('id');

                $.ajax({
                    url: "<?php echo e(route('auth.requisitions.accept', ':id')); ?>".replace(':id',
                        requisition_id),
                    type: 'GET',
                    success: function(response) {
                        if (response.status == true) {
                            console.log(response);

                            localStorage.setItem('requisition_id', requisition_id);
                            location.href = "<?php echo e(route('allocations.create')); ?>";
                        } else {
                            // Trigger SweetAlert confirmation dialog for 404 error
                            Swal.fire({
                                title: response.message,
                                text: "Do you want to add products now?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: 'Yes, add now!',
                                cancelButtonText: 'No, later'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // User clicked 'Yes'
                                    //model show
                                    $('#Products').modal('show');


                                } else {
                                    // User clicked 'No'
                                    Toastify({
                                        text: "You can add products later.",
                                        duration: 3000,
                                        gravity: "top",
                                        position: 'right',
                                        backgroundColor: "#FF6347",
                                        stopOnFocus: true,
                                    }).showToast();
                                }
                            });
                        }
                    },
                    error: function(error) {
                        let errorMessage = "An error occurred.";
                        if (error.responseJSON && error.responseJSON.message) {
                            errorMessage = error.responseJSON.message;

                            // Check if it's the missing products error (404)
                            if (error.status === 404) {
                                Swal.fire({
                                    title: errorMessage,
                                    text: "Do you want to add products now?",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes, add now!',
                                    cancelButtonText: 'No, later'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // User clicked 'Yes'
                                        $('#Products').modal('show');
                                    } else {
                                        // User clicked 'No'
                                        Toastify({
                                            text: "You can add products later.",
                                            duration: 3000,
                                            gravity: "top",
                                            position: 'right',
                                            backgroundColor: "#FF6347",
                                            stopOnFocus: true,
                                        }).showToast();
                                    }
                                });
                            }
                        } else {
                            Toastify({
                                text: errorMessage,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#FF6347",
                                stopOnFocus: true,
                            }).showToast();
                        }
                        console.log(error); // For debugging
                    }
                });
                loadmyCategories();
                loadCategories();
                loadUnitTypes();

            });
            $('#submitReturn').click(function() {
        const reason = CKEDITOR.instances['returnReason'].getData(); // Get data from CKEditor

        if (reason.trim() === '') {
            toastr.error('Please provide a reason for returning.'); // Show error message
            return;
        }

        $.ajax({
            url: "<?php echo e(route('requisitions.return', ':id')); ?>".replace(':id', requisition_id), 
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', 
                id: requisition_id,
                reason: reason
            },
            success: function(response) {
                $('#returnModal').modal('hide'); // Close the modal
                toastr.success('Requisition returned successfully.'); // Show success message
                setTimeout(function() {
                location.href = "<?php echo e(route('requisitions.create')); ?>";
                }, 1000); // 2-second delay before reload
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error);
                toastr.error('Failed to return requisition. Please try again.'); // Show error message
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
            $(document).on('click', '.acceptAuthrequisitionBtn', function() {
                console.log('accept');
                var requisition_id = $(this).data('id');
                $.ajax({
                    url: "<?php echo e(route('auth.requisitions.accept', ':id')); ?>".replace(':id',
                        requisition_id),
                    type: 'GET',
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
                            location.href = "<?php echo e(route('requisitions.create')); ?>";
                        } else {
                            console.log(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
            
        });
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/backend/requisitions/requisition_show.blade.php ENDPATH**/ ?>