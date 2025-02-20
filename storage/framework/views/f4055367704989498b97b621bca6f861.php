<?php $__env->startSection('content'); ?>
<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    position: relative;
    top: 10px;
    min-height: 100vh;
    box-sizing: border-box;
}

.header {
    text-align: center;
    margin-bottom: 20px;
    position: relative;
}

.header img {
    width: 90px;
    height: 80px;
    border-radius: 50%;
    position: absolute;
    top: 90%;
    left: 15%;
    transform: translateY(-50%);
}

.header h1 {
    margin: 5px 0;
    font-size: 24px;
    display: inline-block;
    vertical-align: middle;
}

.header h2 {
    margin: 5px 0;
    font-size: 20px;
}

.header h3 {
    margin: 5px 0;
    font-size: 18px;
}

.flex-container {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.flex-item {
    width: 50%;
}

.content {
    margin: 20px 0;
    line-height: 1.6;
}

.content p {
    margin: 5px 0;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    border: 1px solid #000;
    padding: 8px;
    text-align: center;
    font-size: 14px;
}

.table th {
    text-align: center;
}

.signature {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
}

.signature div {
    width: 50%;
    text-align: center;
}

.footer {
    margin-top: 40px;
    /* Adjust this value as needed */
    width: 100%;
    text-align: center;
    font-size: 12px;
}

.container hr {
    margin: 20px 0;
    border: 1px solid #000;
}

.checkbox-group {
    margin: 10px 0;
}

.checkbox-group label {
    margin-right: 15px;
}

.right-side {
    display: flex;
    float: right;
    justify-content: space-between;
}

.cke_notification_message {
    display: none !important;
}

.cke_notifications_area {
    display: none !important;
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
    <div class="modal fade" id="Products" tabindex="-1" aria-labelledby="ProductsLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="Products-Submit" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProductsLabel">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="product-name" class="form-label">Product Name
                                        <span class="text-danger">*</span></label>
                                    <select id="product-name" class="form-control" name="product_id" required>
                                        <option disabled selected>Select a Product</option>
                                        <?php $__currentLoopData = $missingRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($product->product_name); ?>" data-spec="<?php echo e($product->spec); ?>"
                                            data-unit_type="<?php echo e($product->unit_type); ?>"><?php echo e($product->product_name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger" id="ProductNameError"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="product-category">Category
                                        <span class="text-danger">*</span></label>
                                    <select id="product-category" class="form-control" name="product_category_id"
                                        required>
                                        <option disabled selected>Select a Category</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="product-sub-category" class="form-label">Product
                                        Sub Category <span class="text-danger">*</span></label>
                                    <select id="product-sub-category" name="product_sub_category_id"
                                        class="form-control" required>
                                        <!-- Options will be populated dynamically based on category selection -->
                                    </select>
                                    <span class="text-danger" id="ProductSubCategoryError"></span>
                                </div>
                                <div class="mb-3">
                                    <label for="product-quantity" class="form-label">Product
                                        Specification <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="spec" name="product-specification"
                                        required>
                                    <span class="text-danger" id="ProductQuantityError"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="unit-type" class="form-label">Select Unit Type
                                        <span class="text-danger">*</span></label>
                                    <select id="unit-type" name="unit_type_id" class="form-control" required>
                                    </select>
                                    <span class="text-danger" id="UnitTypeError"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="header">
            <img src="<?php echo e(asset('Sheikh_Hasina_Medical_University,_Khulna_Logo.png')); ?>" alt="Logo">
            <h1>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</h1>
        </div>
        <div class="header">
            <h3>চাহিদাপত্র</h3>
        </div>
        <hr>
        <div class="flex-container">
            <div class="flex-item">
                <p>
                    স্মারক নং:
                    <span id="requisitionNo"><?php echo e($requisition->requisition_no); ?></span>

                    <?php if($requisition->status == 0 || $requisition->status == 1): ?>
                    <!-- Edit Button -->
                    <button id="editRequisitionNo" class="btn btn-sm btn-link">
                        <i class="bx bx-edit"></i>
                    </button>

                    <!-- Cancel Button (Initially hidden) -->
                    <button id="cancelEditRequisitionNo" class="btn btn-sm btn-link" style="display: none;">
                        <i class="bx bx-x"></i>
                    </button>
                    <?php endif; ?>
                </p>
            </div>

            <div class="flex-item" style="text-align: right;">
                <?php
                use Carbon\Carbon;
                ?>

                <p>তারিখ: <?php echo e(Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?></p>
            </div>
        </div>
        <div class="content">
            <p>বরাবর,</p>
            <p>স্টোর শাখা,</p>
            <p>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা।</p>
            <br>
            <p>চাহিদাকারীর নাম: <b><?php echo e($requisition->user->name); ?></b> চাহিদাকারীর পদবী:
                <b><?php echo e($requisition->user->designation->designation); ?></b>
            </p>
            <p>চাহিদার শ্রেণী:
            <div class="checkbox-group">
                <label>
                    <input type="checkbox" <?php echo e($requisition->cc == 1 ? 'checked' : ''); ?> disabled> পণ্য ও সংশ্লিষ্ট সেবা
                </label>
                <label>
                    <input type="checkbox" <?php echo e($requisition->cc == 2 ? 'checked' : ''); ?> disabled> কার্য ও ভৌত সেবা
                </label>
                <label>
                    <input type="checkbox" <?php echo e($requisition->cc == 3 ? 'checked' : ''); ?> disabled> বৃদ্ধিবৃত্তিক সেবা
                </label>
                <label>
                    <input type="checkbox" <?php echo e($requisition->cc == 4 ? 'checked' : ''); ?> disabled> অন্যান্য সেবা
                </label>
            </div>
            </p>
            <p>ক্রয় পরিকল্পনায় অন্তর্ভুক্ত কিনা:
            <div class="checkbox-group">
                <label><input type="checkbox" <?php echo e($requisition->auth == 1 ? 'checked' : ''); ?> disabled>
                    অন্তর্ভুক্ত</label>
                <label><input type="checkbox" <?php echo e($requisition->auth == 2 ? 'checked' : ''); ?> disabled> অন্তর্ভুক্ত করা
                    প্রয়োজন</label>
            </div>
            </p>
            <br>
            <p>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা এর রেজিস্ট্রার দপ্তরের দাপ্তরিক কার্যক্রম যথাযথভাবে
                পরিচালনার জন্য
                নিম্নবর্ণিত পণ্যে জুরুরি ভিত্তিতে সরবরাহ করার জন্য অনুরোধ করা হলো।</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ক্র. নং</th>
                    <th>বিবরণ</th>
                    <th>কারিগরি নির্দিষ্টকরণ</th>
                    <th>একক</th>
                    <th>সংখ্যা</th>
                    <th>মন্তব্য</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                ?>
                <?php if($requisition->requisitionProducts->isEmpty()): ?>
                <?php $__currentLoopData = $requisition->missingRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($requisition_product->product_name); ?></td>
                    <td><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                    <td><?php echo e($requisition_product->unit->name ??'N/A'); ?></td>
                    <td><?php echo e($requisition_product->quantity); ?></td>
                    <td><?php echo e(strip_tags($requisition_product->note ?? 'N/A')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <?php $__currentLoopData = $requisition->requisitionProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i++); ?></td>
                    <td><?php echo e($requisition_product->product->product_name); ?></td>
                    <td><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                    <td><?php echo e($requisition_product->unitType->name ??'N/A'); ?></td>
                    <td><?php echo e($requisition_product->quantity); ?></td>
                    <td><?php echo e(strip_tags($requisition_product->remarks ?? 'N/A')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="signature">
            <?php $__currentLoopData = $requisition->requisitionSignatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $requisition_signature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($index == 0): ?>
            <div class="text-center">
                <img src="<?php echo e(asset('global_assets/user_images/signature/' . $requisition_signature->signature)); ?>"
                        alt="Signature" width="100">
                <p>(চাহিদাকারীর স্বাক্ষর)</p>
                <?php echo e(Carbon::parse($requisition_signature->date)->format('d-F-Y')); ?>

                <br>
                <strong> <?php echo e($requisition_signature->name); ?> </strong>
                <br>
                <?php echo e($requisition_signature->designation); ?>

                <br>
                <?php echo e($requisition_signature->department); ?>

            </div>
            <?php elseif($index == 1): ?>
            <div class="text-center">
                <img src="<?php echo e(asset('global_assets/user_images/signature/' . $requisition_signature->signature)); ?>"
                        alt="Signature" width="100">
                <p>(চাহিদাকারীর স্বাক্ষর)</p>
                <?php echo e(Carbon::parse($requisition_signature->date)->format('d-F-Y')); ?>

                <br>
                <strong> <?php echo e($requisition_signature->name); ?> </strong>
                <br>
                <?php echo e($requisition_signature->designation); ?>

                <br>
                <?php echo e($requisition_signature->department); ?>

            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <hr>
        <div class="footer">
            <p>ঠিকানা: অস্থায়ী অফিস: হোল্ডিং নং-০৮, রোড নং-০১, নিরালা রেসিডেনশিয়াল এরিয়া, খুলনা-৯১০০</p>
            <p>ওয়েবসাইট: www.shmu.ac.bd</p>
        </div>
        <br>

        <!-- Left side container for the Back button -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <button class="btn btn-secondary" type="button" id="back_button">
                    <i class='bx bx-arrow-back' style="margin-left: -7px; margin-right: 3px;"></i> Back
                </button>
            </div>
            <!-- Middle: Return button -->
            <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
            <div>
                <button type="button" class="btn btn-warning returnRequisitionBtn" data-id="<?php echo e($requisition->id); ?>">
                    <i class="bx bx-undo me-1"></i> Return
                </button>
            </div>
            <?php endif; ?>

            <!-- Right side container for the Send button -->
            <?php if($requisition->status == 11): ?>
            <div>
                <button type="button" class="btn btn-success sendRequisitionBtn" data-id="<?php echo e($requisition->id); ?>"
                    style="margin-right: 20px;">
                    <i class="bx bx-send me-1"></i> Send
                </button>
            </div>
            <?php endif; ?>
            <?php if($requisition->status == 11): ?>
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
        </div>

        <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
        <div class="right-side" id="allocation">
            <!-- Additional buttons if needed -->
        </div>
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
                    url: "<?php echo e(route('requisitions.edit', ':id')); ?>".replace(':id',
                        requisition_id),
                    type: 'GET',
                    success: function(response) {
                        if (response.status == true) {
                            console.log(response);

                            localStorage.setItem('requisition_id', requisition_id);
                            location.href = "<?php echo e(route('allocations.add')); ?>";
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\Procurement_final\resources\views/backend/requisitions/requisition_show.blade.php ENDPATH**/ ?>