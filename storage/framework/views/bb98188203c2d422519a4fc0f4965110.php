
<?php $__env->startSection('content'); ?>

<style>
.specification-column {
    width: 450px;
    /* Adjust the width as needed */
}

.note_column {
    width: 350px;
    /* Adjust the width as needed */
}

.cke_notification_message {
    display: none !important;
}

.cke_notifications_area {
    display: none !important;
}
</style>
<div class="row mt-5">
    <div class="col-12 col-md-12">
        <!-- Left Side -->
        <div class="card card-default">
            <div class="card-body">
                <br>
                <form id="requisitions_submit">
                    <div class="row" id="sharock_name">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="requisition_no">Channal No:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="requisition_no" value="<?php echo e($requisition->requisition_no); ?>" id="requisition_no"
                                        placeholder="Enter Channal No"> </input>
                                </div>
                                <span class="text-danger" id="requisition_noError"></span>
                            </div>
                        </div> 
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="requisition_date">Requisition Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="requisition_date" value="<?php echo e($requisition->requisition_date); ?>" id="requisition_date">
                                <span class="text-danger" id="requisition_dateError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="edit_requisition_company">Company <span class="text-danger">*</span></label>
                                <select id="edit_requisition_company" name="edit_requisition_company" class="form-control">
                                </select>
                                <input type="hidden" id="edit_requisition_company_id" value="<?php echo e($requisition->company_id); ?>">
                                <span class="text-danger" id="editCompanyError"></span>
                            </div>
                        </div>                        
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="buyer_name">Buyer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="requisition_buyer_name" value="<?php echo e($requisition->buyer_name); ?>" id="requisition_buyer_name" placeholder="Enter Buyer Name">
                                <span class="text-danger" id="buyer_nameError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="buyer_address">Buyer Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="requisition_address" value="<?php echo e($requisition->address); ?>" id="requisition_address" placeholder="Enter Buyer Address">
                                <span class="text-danger" id="buyer_addressError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="requisition_type">Requisition Type <span class="text-danger">*</span></label>
                                <select class="form-select" name="requisition_type" id="requisition_type">
                                    <option value="1" <?php echo e($requisition->requisition_type == 1 ? 'selected' : ''); ?>>Cash Challan</option>
                                    <option value="2" <?php echo e($requisition->requisition_type == 2 ? 'selected' : ''); ?>>Loan Challan</option>
                                    <option value="3" <?php echo e($requisition->requisition_type == 3 ? 'selected' : ''); ?>>Sample Challan</option>
                                </select>
                                <span class="text-danger" id="requisitionTypeError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Category">Product Category <span class="text-danger">*</span></label>
                                <select id="Category-DropDown" name="Category-DropDown" class="form-control"></select>
                                <span class="text-danger" id="CategoryError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="SubCategory">Product Sub Category <span class="text-danger">*</span></label>
                                <select id="Sub-Category-DropDown" name="Sub-Category-DropDown"
                                    class="form-control"></select>
                                <span class="text-danger" id="SubCategoryError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="SrNo">Order No.</label>
                                <input type="number" id="sr_no" name="sr_no" value="<?php echo e($requisition->sr_no); ?>" class="form-control">
                                <span class="text-danger" id="SubCategoryError"></span>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" id="product">
                        <div class="col-12">
                            <h5 class="card-title">Products</h5>
                            <div class="table-responsive text-nowrap p-3">
                                <table id="Product_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Specification</th>
                                            <th>Unit Type</th>
                                            <th>Package Size</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="Product_Table_data">
                                        <!-- first data will be manually added here -->
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($product->product_name); ?></td>
                                            <td><?php echo e($product->spec); ?></td>
                                            <td><?php echo e($product->unitType->name); ?></td>
                                            <td><?php echo e($product->unit_package_size); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary addProductBtn"
                                                    data-id="<?php echo e($product->id); ?>"
                                                    data-product-name="<?php echo e($product->product_name); ?>"
                                                    data-price="<?php echo e($product->unit_price); ?>"
                                                    data-spec="<?php echo e($product->spec); ?>"
                                                    data-unit-price="<?php echo e($product->unit_price); ?>"
                                                    data-unit-package-size="<?php echo e($product->unit_package_size); ?>">
                                                    <i class="bx bx-cart-add"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- //add a button name "Missing" to the top right corner of the page -->
                    <br>
                    <br>
                    <br>
                    <div class="card card-default" id="requisition_item">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-title">Requisitions Items</h5> 
                                    <div class="table-responsive text-nowrap p-3">
                                        <table id="Temp_Requisitions_Table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product Name</th>
                                                    <th>Total Stock</th>
                                                    <th>Unit &nbsp &nbsp &nbsp</th>
                                                    <th>Unit Price</th>
                                                    <th class="specification-column">Specification</th>
                                                    <th class="note_column">Package Size</th>
                                                    <th>Unit Type</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0" id="Temp_Requisitions_Table_Data">
                                                <!-- Data will be dynamically added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>                   
                    <br>
                    <div class="card card-default" id="requisition-details">
                        <div class="card-body">
                            <h5 class="card-title">Requisitions Details</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td id="itemQuantityLabel">Quantity of Items</td>
                                            <td id="itemQuantityValue"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>

                            <!-- Button Container with flexbox -->
                            <div class="d-flex justify-content-between" id="requisition_button">
                                <!-- Left side "Back" button -->
                                <button class="btn btn-secondary" type="button" id="back_button">
                                    <i class='bx bx-arrow-back' style="margin-left: -7px; margin-right: 3px;"></i>
                                    Back
                                </button>

                                <?php if($requisition->status == 12 || $requisition->status == 13 || $requisition->status == 11): ?>
                                <!-- Middle "Save Draft" button -->
                                <button class="btn btn-warning mx-auto" type="button" id="saveRequisitions_submit"><i
                                        class='bx bx-save' style="margin-left: -7px; margin-right: 3px;"></i>Save
                                    Draft</button>
                                
                                <?php endif; ?>
                                <!-- Right side "Requisition" button -->
                                <button class="btn btn-primary" type="submit" id="new_requisitions_submit"><i
                                        class='bx bx-plus'
                                        style="margin-left: -7px; margin-right: 3px;"></i>Send Requisition</button>
                            </div>
                            <br>

                            <!-- Form that is hidden initially -->
                            <!-- <div id="missing-form" style="display: none; margin-top: -220px">
                    <div>
                        <h5 class="card-title">Missing Item Form</h5>
                        <form id="no_requisitions_submit">
                            <div class="mb-3">
                                <label for="requisition_no">স্মারক নং:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="requisition_no" id="no_requisition_no"
                                        placeholder="স্মারক নং লিখুন"></input>
                                    <div class="input-group-append" style="margin-left: 5px;">
                                        <button type='button' class="btn btn-outline-secondary"
                                            id="no_auto-generate-btn" title="Auto Generate">
                                            <i class="fas fa-magic"></i>
                                            Generate
                                        </button>
                                    </div>
                                </div>
                                <span class="text-danger" id="requisition_noError"></span>
                            </div>
                            <div class="mb-3">
                                <label for="requisition_date">Requisition Date <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="requisition_date" id="no_requisition_date">
                                <span class="text-danger" id="requisition_dateError"></span>
                            </div>
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName"
                                    placeholder="Enter product name">
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" step="0.001" min="0"
                                    placeholder="Enter quantity">
                            </div>
                            <div class="mb-3">
                                <label for="specification" class="form-label">Specification</label>
                                <textarea class="form-control" id="specification" rows="3"
                                    placeholder="Enter specification"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="unitType" class="form-label">Unit Type</label>
                                <select class="form-select" id="unitType">
                                    <option selected>Select Unit Type</option>
                                    <?php $__currentLoopData = $unitTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unitType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($unitType->id); ?>"><?php echo e($unitType->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note</label>
                                <textarea class="form-control" id="note" rows="3"
                                    placeholder="Add any notes"></textarea>
                            </div>
                            <div id="append_box_product_content"></div>
                            <br>
                            <div class="float-end">
                                <button class="btn btn-sm btn-secondary" type="button" onclick="add_more()">
                                    <i class="bx bx-plus" style="margin-left: -7px; margin-right: 3px;"></i> Add
                                    More</button>
                            </div>
                            <br>
                            <br>
                            <div class="card card-default">
                                <div class="card-body">
                                    <br>
                                    <label for="note">চাহিদার শ্রেণী: </label> <br> <br>
                                    <label style="margin-right: 20px;">
                                        <input type="radio" name="category" value="1" required> পণ্য ও সংশ্লিষ্ট
                                        সেবা
                                    </label>
                                    <label style="margin-right: 20px;">
                                        <input type="radio" name="category" value="2" required> কার্য ও ভৌত সেবা
                                    </label>
                                    <label style="margin-right: 20px;">
                                        <input type="radio" name="category" value="3" required> বৃদ্ধিবৃত্তিক সেবা
                                    </label>
                                    <label>
                                        <input type="radio" name="category" value="4" required> অন্যান্য সেবা
                                    </label>
                                    <br>
                                    <br>
                                    <label for="note">ক্রয় পরিকল্পনায় অন্তর্ভুক্ত কিনা: </label> <br> <br>
                                    <label style="margin-right: 20px;">
                                        <input type="radio" name="category_two" value="1" required> অন্তর্ভুক্ত
                                        সেবা
                                    </label>
                                    <label style="margin-right: 20px;">
                                        <input type="radio" name="category_two" value="2" required> অন্তর্ভুক্ত করা
                                        প্রয়োজন
                                    </label>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="float-end">
                                <button class="btn btn-primary" type="submit" id="no_requisitions_submit"><i
                                        class='bx bx-plus'
                                        style="margin-left: -7px; margin-right: 3px;"></i>Requisition</button>
                            </div>
                        </form>
                    </div>
                </div> -->
                        </div>
                    </div>
            </div>
        </div>

        <script>
        CKEDITOR.replace('note_details');
        CKEDITOR.replace('spec');
        CKEDITOR.replace('specification');
        // CKEDITOR.replace('note');
        CKEDITOR.replace('spec-input');
        CKEDITOR.replace('note-input');

        </script>


        <script>
        function remove_box(event) {

            $(event.target).parent().parent().remove();


        }

        // script for add more text field for mission page
        // function add_more() {

        //     let randomNumber = String(Math.floor(Math.random() * (98765 - 12345 + 1)) + 5);

        //     let add_element = `
        //         <div class="mb-3">
        //             <label for="productName" class="form-label">Product Name</label>
        //             <input type="text" class="form-control" id="dynamic_productName_${randomNumber}"
        //                 placeholder="Enter product name">
        //         </div>
        //         <div class="mb-3">
        //             <label for="quantity" class="form-label">Quantity</label>
        //             <input type="number" class="form-control" id="dynamic_quantity_${randomNumber}" step="0.001" min="0"
        //                 placeholder="Enter quantity">
        //         </div>
        //         <div class="mb-3">
        //             <label for="specification" class="form-label">Specification</label>
        //             <textarea class="form-control" id="dynamic_specification_${randomNumber}" rows="3"
        //                 placeholder="Enter specification"> </textarea>
        //         </div>
        //         <div class="mb-3">
        //             <label for="unitType" class="form-label">Unit Type</label>
        //             <select class="form-select" id="dynamic_unitType_${randomNumber}">
        //                 <option selected>Select Unit Type</option>
        //                 <?php $__currentLoopData = $unitTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unitType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        //                 <option value="<?php echo e($unitType->id); ?>"><?php echo e($unitType->name); ?></option>
        //                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        //             </select>
        //         </div>
        //         <div class="mb-3">
        //             <label for="note" class="form-label">Note:</label>
        //             <textarea class="form-control" id="dynamic_note_${randomNumber}" rows="3"></textarea>
        //             <span class="text-danger" id="NoteError"></span>
        //         </div>
        // `;

        //     let textbox_script = `<script> CKEDITOR.replace('${randomNumber}'); </scr` +
        //         `ipt>`;

        //     let append_box = $("#append_box_product_content");

        //     $(append_box).append(`<li>
        //     <div class='d-flex justify-content-between'>
        //         <h5>New Item</h5><button class='btn btn-sm btn-danger' onclick='remove_box(event)'>Remove</button>
        //     </div>${add_element}${textbox_script}
        // </li>`);

        // }
        $(document).ready(function() {
            $("#missing-btn").click(function() {
                // $("#requisition-details").toggle(); // This hides/shows the div
                // $("#sub_category").toggle(); // This hides/shows the div
                // $("#product").toggle(); // This hides/shows the div
                // $("#requisition_item").toggle(); // This hides/shows the div
                // $("#category").toggle(); // This hides/shows the div
                // $("#requisition_button").toggle(); // This hides/shows the div
                // $("#help").toggle(); // This hides/shows the div
                // $("#sharock_name").toggle(); // This hides/shows the div
                // $("#date").toggle(); // This hides/shows the div

                // Toggle the missing item form
                $("#missing-form").toggle(); // Use toggle to show/hide the form
            });

            //no requisition form submit
            $('#addMissingProductButton').on('click', function(e) {
                e.preventDefault();

                // Disable the submit button to prevent multiple submissions
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                // Get the form data
                // var requisition_no = $('#no_requisition_no').val();
                // var requisition_date = $('#no_requisition_date').val();
                var product_name = $('#productName').val();
                var quantity = $('#quantity').val();
                const spec = CKEDITOR.instances['specification'].getData();
                var unit_type = $('#unitType').val();
                var note = $('#note').val();
                // var category = $('input[name="category"]:checked').val();
                // var category_two = $('input[name="category_two"]:checked').val();

                // var dynamicValues = [];
                // $('#append_box_product_content').find('li').each(function(index, element) {
                //     var dynamicValue = {};
                //     dynamicValue.product_name = $(this).find('input[id^="dynamic_productName_"]').val();

                //     dynamicValue.quantity = $(this).find('input[id^="dynamic_quantity_"]').val();

                //     dynamicValue.spec = $(this).find('textarea[id^="dynamic_specification_"]').val();

                //     dynamicValue.unit_type = $(this).find('select[id^="dynamic_unitType_"]').val();

                //     dynamicValue.note = $(this).find('textarea[id^="dynamic_note_"]').val();

                //     dynamicValues.push(dynamicValue);
                // });

                $.ajax({
                    url: "<?php echo e(route('edit.no.requisitions.add')); ?>",
                    type: 'POST',
                    data: {
                        // requisition_date: requisition_date,
                        // category: category,
                        // category_two: category_two,
                        // requisition_no: requisition_no,
                        product_name: product_name,
                        quantity: quantity,
                        spec: spec,
                        unit_type: unit_type,
                        note: note,
                        // dynamicValues: dynamicValues,
                        // no_flag: true
                    },
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                            $('#productName').val('');
                            $('#quantity').val('');
                            CKEDITOR.instances['specification'].setData('');
                            $('#unitType').val('');
                            $('#note').val('');

                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    },
                    complete: function() {
                        // Re-enable the submit button after the request is completed
                        submitButton.prop('disabled', false);
                    }
                });
            });

            function loadCategory() {
                $.ajax({
                    url: "<?php echo e(route('product-categories.index')); ?>",
                    type: "GET",
                    success: function(response) {
                        $('#Category-DropDown').empty();
                        $('#Category-DropDown').append(
                            '<option disabled selected>Please a Category </option>');
                        response.data.forEach(function(category) {
                            $('#Category-DropDown').append('<option value="' + category.id +
                                '">' +
                                category.product_category_name + '</option>');
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            loadCategory();

            $('#Category-DropDown').on('change', function() {
                var categoryId = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('product.category.sub-categories', ':id')); ?>".replace(':id',
                        categoryId),
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            $('#Sub-Category-DropDown').empty().append(
                                '<option value="" selected disabled>Select a Sub Category</option>'
                            );
                            response.data.forEach(SubCategory => {
                                $('#Sub-Category-DropDown').append(
                                    '<option value="' +
                                    SubCategory.id + '">' + SubCategory
                                    .product_sub_category_name + '</option>');
                            });
                        } else {
                            $('#Sub-Category-DropDown').empty().append(
                                '<option value="" selected disabled>No Sub Category Available</option>'
                            );
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $('#Sub-Category-DropDown').on('change', function() {
                var categoryId = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('product.category.products', ':id')); ?>".replace(':id',
                        categoryId),
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            $('#Product_Table_data').empty();
                            let serialNo = 1; // Initialize the serial number
                            response.data.forEach(Product => {
                                $('#Product_Table_data').append(`
                                    <tr>
                                        <td>${serialNo}</td>
                                        <td>${Product.product_name}</td>
                                        <td>${Product.spec}</td>
                                        <td>${Product.unit_type.name}</td>
                                        <td>${Product.unit_package_size}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary addProductBtn" 
                                                data-id="${Product.id}" 
                                                data-product-name="${Product.product_name}" 
                                                data-price="${Product.unit_price}" 
                                                data-spec="${Product.spec}" 
                                                data-unit-price="${Product.unit_price}" 
                                                data-unit-package-size="${Product.unit_package_size}">
                                                <i class="bx bx-cart-add"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `);
                                serialNo++; // Increment the serial number
                            });
                        } else {
                            $('#Product_Table_data').empty().append(
                                '<tr><td colspan="4">No Product Available</td></tr>');
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            const editorInstances = []; // Array to hold CKEditor instances
            function getTempProduct() {
                $.ajax({
                    url: "<?php echo e(route('temprequisitions.add')); ?>", 
                    type: 'GET',
                    success: function(response) {
                        if (response.status == true) {
                            $('#Temp_Requisitions_Table_Data').empty();
                            let serialNo = 1; // Initialize the serial number

                            // Store unitTypes for later use
                            const unitTypes = response.unitTypes;

                            response.data.forEach(Product => {
                                const remarks = Product.remarks ?? ''; // Ensure 'remarks' is not null or undefined

                                let unitTypeOptions = '';
                                unitTypes.forEach(unitType => {
                                    const isSelected = (unitType.id === Product.unit_type) ? 'selected' : ''; 
                                    unitTypeOptions += `<option value="${unitType.id}" ${isSelected}>${unitType.name}</option>`;
                                });

                                // Append the row to the table
                                $('#Temp_Requisitions_Table_Data').append(
                                    '<tr>' +
                                    '<td>' + serialNo + '</td>' +
                                    '<td>' + Product.product.product_name + '</td>' +
                                    '<td>' +
                                    '<input type="number" disabled class="form-control final-quantity-input" name="final_quantity" data-id="' +
                                    Product.product.id + '" value="' + Product.product.final_quantity + '">' +
                                    '</td>' +
                                    '<td>' +
                                    '<input type="number" class="form-control quantity-input" name="quantity" data-id="' +
                                    Product.id + '" value="' + Product.quantity + '">' +
                                    '</td>' +
                                    '<td>' +
                                    '<input type="number" class="form-control unit-price-input" name="unit_price" data-id="' +
                                    Product.id + '" value="' + Product.unit_price + '">' +
                                    '</td>' +
                                    '<td>' +
                                    '<textarea class="form-control spec-input" name="spec-input-temp" data-id="' +
                                    Product.id + '" cols="20" rows="6">' + Product.spec +
                                    '</textarea>' +
                                    '</td>' +
                                    '<td>' +
                                    '<input type="number" class="form-control unit-package-size-input" name="unit_package_size" data-id="' +
                                    Product.id + '" value="' + Product.unit_package_size + '">' +
                                    '</td>' +
                                    '<td>' +
                                    '<select class="form-control unit-type-select" data-id="' + Product.id + '">' +
                                    unitTypeOptions +
                                    '</select>' +
                                    '</td>' +
                                    // '<td>' +
                                    // '<textarea class="form-control note-input" name="note-input" data-id="' + Product.id + '" cols="20" rows="6">' + remarks +
                                    // '</textarea>' +
                                    // '</td>' +
                                    '<td>' +
                                    '<button type="button" class="btn removeProductBtn" data-id="' +
                                    Product.id + '"><i class="bx bx-trash text-danger"></i></button>' +
                                    '</td>' +
                                    '</tr>'
                                );

                                serialNo++; // Increment the serial number
                                // Initialize CKEditor on the dynamically added textarea
                                var specTextarea = $('textarea[name="spec-input-temp"][data-id="' + Product.id + '"]')[0];
                                var editorInstance = CKEDITOR.replace(specTextarea, {
                                    toolbar: [
                                        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline'] },
                                        { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
                                        { name: 'styles', items: ['Format'] }
                                    ],
                                    height: 100,
                                    removePlugins: 'elementspath',
                                    resize_enabled: false,
                                });

                                // Store the editor instance in the array
                                    editorInstances.push({ instance: editorInstance, productId: Product.id });
                                });

                            // Calculate the total quantity
                            var totalQuantity = response.data.reduce(function(acc, product) {
                                return acc + parseFloat(product.quantity, 3); // Ensure quantity is treated as a float
                            }, 0);

                                // Add event listener for quantity input validation
                                $('.quantity-input').on('input', function() {
                                const finalQuantity = $(this).closest('tr').find('.final-quantity-input').val();
                                const enteredQuantity = $(this).val();

                                if (parseInt(enteredQuantity) > parseInt(finalQuantity)) {
                                    alert('Quantity cannot exceed the final quantity.');
                                    $(this).val(finalQuantity); // Reset the value to the final quantity
                                }
                            });

                            $('#itemQuantityValue').text(totalQuantity);
                        } else if (response.status == false) {
                            $('#Temp_Requisitions_Table_Data').empty().append(
                                '<tr><td colspan="7">No Product Available</td></tr>');
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });

            }

             // Attach the 'blur' event to each CKEditor instance
             function attachCKEditorBlurEvents() {
                editorInstances.forEach(editorObj => {
                    editorObj.instance.on('blur', function() {
                        var spec = this.getData(); // Get updated data from CKEditor after blur
                        console.log('Product ID:', editorObj.productId);
                        console.log('Specification:', spec);

                        $.ajax({
                            url: "<?php echo e(route('temp-requisition-products.update', ':id')); ?>".replace(':id',
                                editorObj.productId),
                            type: 'PUT',
                            headers: {
                                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                            },
                            data: {
                                product_id: editorObj.productId,
                                spec: spec
                            },
                            success: function(response) {
                                if (response.status) {
                                    getTempProduct();
                                } else {
                                    console.error(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX request error:', error);
                            }
                        });
                    });
                });
            }

            // Trigger the 'blur' event after the CKEditors are initialized
            $(document).ajaxComplete(function() {
                attachCKEditorBlurEvents();
            });

            // Call the function to load the data and initialize CKEditors
            getTempProduct();

            $('#Product_Table').on('click', '.addProductBtn', function() {
                var productId = $(this).data('id');
                var productName = $(this).data('product-name');
                var price = $(this).data('price');
                var spec = $(this).data('spec');
                var unit_price = $(this).data('unit-price');
                var unit_package_size = $(this).data('unit-package-size');

                $.ajax({
                    url: "<?php echo e(route('temprequisitions.store')); ?>",
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    data: {
                        product_id: productId,
                        product_name: productName,
                        price: price,
                        spec: spec,
                        quantity: 0,
                        unit_price: unit_price,
                        unit_package_size: unit_package_size
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $('#Temp_Requisitions_Table').on('click', '.removeProductBtn', function() {
                var productId = $(this).data('id');
                console.log(productId);

                $.ajax({
                    url: "<?php echo e(route('temp-requisition-products.destroy', ':id')); ?>".replace(
                        ':id',
                        productId),
                    type: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(response) {
                        if (response.status) {
                            console.log('Product removed successfully');
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $('#Temp_Requisitions_Table').on('change', '.quantity-input', function() {
                var productId = $(this).data('id');
                var quantity = $(this).val();

                console.log('Product ID:', productId);
                console.log('Quantity:', quantity);

                $.ajax({
                    url: "<?php echo e(route('temp-requisition-products.update', ':id')); ?>".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $('#Temp_Requisitions_Table').on('change', '.unit-package-size-input', function() {
                var productId = $(this).data('id');
                var unit_package_size = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('temp-requisition-products.update', ':id')); ?>".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    data: {
                        product_id: productId,
                        unit_package_size: unit_package_size
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $('#Temp_Requisitions_Table').on('change', '.unit-price-input', function() {
                var productId = $(this).data('id');
                var unit_price = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('temp-requisition-products.update', ':id')); ?>".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    data: {
                        product_id: productId,
                        unit_price: unit_price
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $('#Temp_Requisitions_Table').on('change', '.unit-type-select', function() {
                var productId = $(this).data('id');
                var unit_type = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('temp-requisition-products.update', ':id')); ?>".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    data: {
                        product_id: productId,
                        unit_type: unit_type
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

            $(document).on('click', '#back_button', function() {
                window.location.href = "<?php echo e(route('requisitions.create')); ?>";
            });


            $('#Temp_Requisitions_Table').on('change', '.note-input', function() {
                var productId = $(this).data('id');
                var note = $(this).val();

                $.ajax({
                    url: "<?php echo e(route('temp-requisition-products.update', ':id')); ?>".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    data: {
                        product_id: productId,
                        remarks: note
                    },
                    success: function(response) {
                        if (response.status) {
                            getTempProduct();
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });

        // Submit the requisition
        $(document).on('click', '#new_requisitions_submit', function (e) {
            e.preventDefault();

            let submitButton = $(this); // Ensure correct button selection
            submitButton.prop('disabled', true);

            let url = window.location.pathname;
            let requisitionId = url.substring(url.lastIndexOf('/') + 1);

            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to send this return requisition for authorization?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                allowOutsideClick: false,
                showCloseButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If "Yes" is clicked
                    submitRequisition("<?php echo e(route('editReturnRequisition.Submit', ':id')); ?>".replace(':id', requisitionId), false);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // If "No" is clicked
                    submitRequisition("<?php echo e(route('editReturnRequisition.noAuth', ':id')); ?>".replace(':id', requisitionId), true);
                }
            }).finally(() => {
                submitButton.prop('disabled', false); // Re-enable button after confirmation
            });
        });

        // Function to submit requisition via AJAX
        function submitRequisition(route, noFlag) {
            const data = {
                requisition_date: $('#requisition_date').val(),
                category: $('input[name="category"]:checked').val(),
                category_two: $('input[name="category_two"]:checked').val(),
                requisition_no: $('#requisition_no').val(),
                unit_type: $('input[name="unit_type"]:checked').val(),
                buyer_name: $('#requisition_buyer_name').val(),
                address: $('#requisition_address').val(),
                requisition_type: $('#requisition_type').val(),
                company_value: $('#edit_requisition_company').val(),
                sr: $('#sr_no').val(),
                no_flag: noFlag
            };

            $.ajax({
                url: route,
                type: 'PUT',
                data: data,
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                success: function (response) {
                    console.log('response', response);
                    let message = noFlag
                        ? "Requisition approved without authentication."
                        : "Requisition sent for approval.";

                    Swal.fire({
                        title: "Success!",
                        text: message,
                        icon: "success",
                        timer: 2000,
                        showConfirmButton: true
                    }).then(() => {
                        // location.href = "<?php echo e(route('requisitions.create')); ?>"; // Redirect after success
                    });
                },
                error: function (xhr) {
                    if (xhr.responseJSON?.errors?.requisition_no) {
                        $('#requisition_noError').text(xhr.responseJSON.errors.requisition_no);
                    }
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                    console.error('AJAX request error:', xhr);
                }
            });
        }


            // // Submit the requisition
            // $('#requisitions_submit').on('submit', function(e) {
            //     e.preventDefault();
                
            //     let submitButton = $(this).find('button[type="submit"]');
            //     submitButton.prop('disabled', true);
            //     let url = window.location.pathname;
            //     let requisitionId = url.substring(url.lastIndexOf('/') + 1);

            //     $.ajax({
            //         url: "<?php echo e(route('editReturnRequisition.Submit', ':id')); ?>".replace(':id', requisitionId), 
            //         type: 'PUT', 
            //         data: {
            //             requisition_date: $('#requisition_date').val(),
            //             category: $('input[name="category"]:checked').val(),
            //             category_two: $('input[name="category_two"]:checked').val(),
            //             requisition_no: $('#requisition_no').val(),
            //             unit_type: $('input[name="unit_type"]:checked').val(),
            //             buyer_name: $('#requisition_buyer_name').val(),
            //             address: $('#requisition_address').val(), 
            //             requisition_type: $('#requisition_type').val(),
            //             company_value: $('#edit_requisition_company').val(),
            //             sr:$('#sr_no').val(),
            //             no_flag: false
            //         },
            //         headers: {
            //             "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            //         },
            //         success: function(response) {
            //             if (response.status) {
            //                 // Clear previous errors
            //                 $('#requisition_noError').text('');

            //                 Toastify({
            //                     text: "Requisition Updated Successfully",
            //                     duration: 3000,
            //                     gravity: "top",
            //                     position: 'right',
            //                     backgroundColor: "#228B22",
            //                     stopOnFocus: true,
            //                 }).showToast();

            //                 location.href = "<?php echo e(route('requisitions.create')); ?>";
            //             } else {
            //                 console.error(response.message);
            //             }
            //         },
            //         error: function(xhr, status, error) {
            //             if (xhr.responseJSON.errors.requisition_no) {
            //                 $('#requisition_noError').text(xhr.responseJSON.errors.requisition_no);
            //             }
            //             console.error('AJAX request error:', error);
            //         },
            //         complete: function() {
            //             submitButton.prop('disabled', false); // Re-enable the submit button
            //         }
            //     });
            // });

            // save as draft the requisition
            $('#saveRequisitions_submit').on('click', function(e) {
                e.preventDefault();
                
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true); 
                let url = window.location.pathname;
                let requisitionId = url.substring(url.lastIndexOf('/') + 1);

                $.ajax({
                    url: "<?php echo e(route('saveReturnRequisition.Submit', ':id')); ?>".replace(':id', requisitionId), 
                    type: 'PUT', 
                    data: {
                        requisition_date: $('#requisition_date').val(),
                        category: $('input[name="category"]:checked').val(),
                        category_two: $('input[name="category_two"]:checked').val(),
                        requisition_no: $('#requisition_no').val(),
                        unit_type: $('input[name="unit_type"]:checked').val(),
                        buyer_name: $('#requisition_buyer_name').val(),
                        address: $('#requisition_address').val(), 
                        requisition_type: $('#requisition_type').val(),
                        company_value: $('#edit_requisition_company').val(),
                        sr:$('#sr_no').val(),
                        no_flag: false
                    },
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(response) {
                        if (response.status) {
                            // Clear previous errors
                            $('#requisition_noError').text('');

                            Toastify({
                                text: "Requisition saved Successfully",
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#228B22",
                                stopOnFocus: true,
                            }).showToast();

                            location.href = "<?php echo e(route('requisitions.create')); ?>";
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.errors.requisition_no) {
                            $('#requisition_noError').text(xhr.responseJSON.errors.requisition_no);
                        }
                        console.error('AJAX request error:', error);
                    },
                    complete: function() {
                        submitButton.prop('disabled', false); // Re-enable the submit button
                    }
                });
            });

                // save as draft the requisition
                $('#saveDraft_submit').on('click', function(e) {
                    e.preventDefault();
                    
                    let submitButton = $(this).find('button[type="submit"]');
                    submitButton.prop('disabled', true);
                    let url = window.location.pathname;
                    let requisitionId = url.substring(url.lastIndexOf('/') + 1);

                    $.ajax({
                        url: "<?php echo e(route('saveDraftRequisition', ':id')); ?>".replace(':id', requisitionId), 
                        type: 'PUT', 
                        data: {
                            requisition_date: $('#requisition_date').val(),
                            category: $('input[name="category"]:checked').val(),
                            category_two: $('input[name="category_two"]:checked').val(),
                            requisition_no: $('#requisition_no').val(),
                            unit_type: $('input[name="unit_type"]:checked').val(),
                            buyer_name: $('#requisition_buyer_name').val(),
                            address: $('#requisition_address').val(), 
                            requisition_type: $('#requisition_type').val(),
                            company_value: $('#edit_requisition_company').val(),
                            sr:$('#sr_no').val(),
                            no_flag: false
                        },
                        headers: {
                            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                        },
                        success: function(response) {
                            if (response.status) {
                                // Clear previous errors
                                $('#requisition_noError').text('');

                                Toastify({
                                    text: "Requisition saved Successfully",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#228B22",
                                    stopOnFocus: true,
                                }).showToast();

                                location.href = "<?php echo e(route('requisitions.create')); ?>";
                            } else {
                                console.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON.errors.requisition_no) {
                                $('#requisition_noError').text(xhr.responseJSON.errors.requisition_no);
                            }
                            console.error('AJAX request error:', error);
                        },
                        complete: function() {
                            submitButton.prop('disabled', false); // Re-enable the submit button
                        }
                    });
                });


            // Save Draft requisition
            $('#save_draft_button').on('click', function(e) {
                e.preventDefault();
                // Disable the submit button to prevent multiple submissions
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: "<?php echo e(route('requisitions_draft.save')); ?>",
                    type: 'POST',
                    data: {
                        requisition_date: $('#requisition_date').val(),
                        category: $('input[name="category"]:checked').val(),
                        category_two: $('input[name="category_two"]:checked').val(),
                        requisition_no: $('#requisition_no').val(),
                        unit_type: $('input[name="unit_type"]:checked').val(),
                        buyer_name: $('#requisition_buyer_name').val(),
                        address: $('#requisition_address').val(),
                        requisition_type: $('#requisition_type').val(),
                        company_value: $('#edit_requisition_company').val(),
                        sr:$('#sr_no').val(),
                        no_flag: false
                    },
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(response) {
                        console.log('Response:');
                        if (response.status) {
                            // Clear previous errors
                            $('#requisition_noError').text('');

                            Toastify({
                                text: "Save Draft Successfully",
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#228B22",
                                stopOnFocus: true,
                            }).showToast();
                            location.href = "<?php echo e(route('requisitions.create')); ?>";
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON.errors.requisition_no) {
                            $('#requisition_noError').text(xhr.responseJSON.errors
                                .requisition_no);
                        }
                        console.error('AJAX request error:', error);
                    },
                    complete: function() {
                        // Re-enable the submit button after the request is completed
                        submitButton.prop('disabled', false);
                    }
                });
            });

            // Get company in dropdown
            let companyData = {};
            let selectedCompanyId = $('#edit_requisition_company_id').val(); // Get value from hidden input

            $.ajax({
                url: "<?php echo e(route('companies.create')); ?>",
                type: "GET",
                success: function(response) {
                    $('#edit_requisition_company').empty();
                    $('#edit_requisition_company').append('<option disabled>Select Company</option>');

                    response.company.forEach(function(company) {
                        $('#edit_requisition_company').append('<option value="' + company.id + '">' + company.name + '</option>');
                        companyData[company.id] = company;
                    });

                    // Ensure value is set after dropdown is populated
                    $('#edit_requisition_company').val(selectedCompanyId).trigger('change');
                },
                error: function(err) {
                    console.log(err);
                }
            });

            // Update buyer name and address on company selection
            $('#edit_requisition_company').on('change', function() {
                let selectedCompanyId = $(this).val();
                if (companyData[selectedCompanyId]) {
                    $('#requisition_address').val(companyData[selectedCompanyId].address || '');
                    $('#requisition_buyer_name').val(companyData[selectedCompanyId].buyer_name || '');
                    $('#sr_no').val(companyData[selectedCompanyId].sr_no || '');
                } else {
                    $('#requisition_address').val('');
                    $('#requisition_buyer_name').val('');
                    $('#sr_no').val('');
                }
            });
        });
        </script>
        <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/backend/requisitions/return_requisition_edit.blade.php ENDPATH**/ ?>