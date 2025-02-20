@extends('layouts.master')
@section('content')

<style>
.specification-column {
    width: 250px;
    /* Adjust the width as needed */
}

.note_column {
    width: 250px;
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
                            <label for="requisition_no">Channal No:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="requisition_no" id="requisition_no"
                                    placeholder="Enter Channal No"></input>
                                <div class="input-group-append" style="margin-left: 5px;">
                                    <button type='button' class="btn btn-outline-secondary" id="auto-generate-btn"
                                        title="Auto Generate">
                                        <i class="fas fa-magic"></i>
                                        Generate
                                    </button>
                                </div>
                            </div>
                            <span class="text-danger" id="requisition_noError"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6" >
                            <div class="mb-3">
                                <label for="requisition_date">Requisition Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="requisition_date" id="requisition_date">
                                <span class="text-danger" id="requisition_dateError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="requisition_company">Company <span class="text-danger">*</span></label>
                                <select id="requisition_company" name="requisition_company" class="form-control">
                                </select>
                                <span class="text-danger" id="companyError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="buyer_name">Buyer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="requisition_buyer_name" id="requisition_buyer_name" placeholder="Enter Buyer Name">
                                <span class="text-danger" id="buyer_nameError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Category">Product Category</label>
                                <select id="Category-DropDown" name="Category-DropDown" class="form-control"></select>
                                <span class="text-danger" id="CategoryError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="address">Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="requisition_address" id="requisition_address" placeholder="Enter Address">
                                <span class="text-danger" id="addressError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="SubCategory">Product Sub Category</label>
                                <select id="Sub-Category-DropDown" name="Sub-Category-DropDown"
                                    class="form-control"></select>
                                <span class="text-danger" id="SubCategoryError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="SrNo">Order No.</label>
                                <input type="number" id="sr_no" name="sr_no" class="form-control">
                                <span class="text-danger" id="SubCategoryError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="requisition_type">Challan Type <span class="text-danger">*</span></label>
                                <select id="requisition_type" name="requisition_type" class="form-control">
                                    <option disabled selected>Select Challan Type</option>
                                    <option value="1">Cash Challan</option>
                                    <option value="2">Loan Challan</option>
                                    <option value="3">Sample Challan</option>
                                </select>
                                <span class="text-danger" id="requisition_typeError"></span>
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
                                        @foreach($products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->spec }}</td>
                                            <td>{{ $product->unitType->name }}</td>
                                            <td>{{ $product->unit_package_size}}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary addProductBtn"
                                                    data-id="{{ $product->id }}"
                                                    data-product-name="{{ $product->product_name }}"
                                                    data-price="{{ $product->unit_price }}"
                                                    data-spec="{{ $product->spec }}"
                                                    data-unit-price="{{ $product->unit_price }}"
                                                    data-unit-package-size="{{ $product->unit_package_size }}">
                                                    <i class="bx bx-cart-add"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- //add a button name "Missing" to the top right corner of the page -->
                    <!-- <div class="float-end">
                        <button class="btn btn-primary" type="button" id="missing-btn"><i class='bx bx-plus'
                                style="margin-right: 3px;"></i>Missing</button>
                    </div> -->
                    <br>
                    <!-- <br>
                    <br> -->
                    <!-- Form that is hidden initially -->
                    <!-- <div id="missing-form" style="display: none;">
                        <div>
                            <h5 class="card-title">Missing Item Form</h5>
                            <div id="no_requisitions_submit">
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
                                        @foreach($unitTypes as $unitType)
                                        <option value="{{ $unitType->id }}">{{ $unitType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control" id="note" rows="3"
                                        placeholder="Add any notes"></textarea>
                                </div>
                                <br>
                                <div class="float-end">
                                    <button class="btn btn-primary" type="button" id="addMissingProductButton">
                                        <i class='bx bx-plus' style="margin-left: -7px; margin-right: 3px;"></i>Add
                                        Missing Product
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                    </div> -->
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
                    <!-- <div class="card card-default" id="help">
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
                                <input type="radio" name="category_two" value="2" required> অন্তর্ভুক্ত করা প্রয়োজন
                            </label>
                        </div>
                    </div> -->
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


                                <!-- Middle "Save Draft" button -->
                                <button class="btn btn-warning mx-auto" type="button" id="save_draft_button"><i
                                        class='bx bx-save' style="margin-left: -7px; margin-right: 3px;"></i>Save
                                    Draft</button>

                                <!-- Right side "Requisition" button -->
                                <button class="btn btn-primary" type="button" id="new_requisitions_submit">
                                    <i class='bx bx-plus' style="margin-left: -7px; margin-right: 3px;"></i>Requisition
                                </button>
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
                                    @foreach($unitTypes as $unitType)
                                    <option value="{{ $unitType->id }}">{{ $unitType->name }}</option>
                                    @endforeach
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
        //                 @foreach($unitTypes as $unitType)
        //                 <option value="{{ $unitType->id }}">{{ $unitType->name }}</option>
        //                 @endforeach
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
                // let submitButton = $(this).find('button[type="submit"]');
                // submitButton.prop('disabled', true);

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
                    url: "{{ route('no.requisitions.add') }}",
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
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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
                    url: "{{ route('product-categories.index') }}",
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
                    url: "{{ route('product.category.sub-categories', ':id') }}".replace(':id',
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
                    url: "{{ route('product.category.products', ':id') }}".replace(':id',
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
                    url: "{{ route('temp-requisition-products.index') }}",
                    type: 'GET',
                    success: function(response) {
                        if (response.status == true) {
                            $('#Temp_Requisitions_Table_Data').empty();
                            let serialNo = 1; // Initialize the serial number
                            let randomNumber = String(Math.floor(Math.random() * (98765 - 12345 +
                                1)) + 5);

                            response.data.forEach(Product => {
                                const remarks = Product.remarks ??
                                    ''; // Ensure 'remarks' is not null or undefined

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
                                    Product.id + '" cols="20" rows="6">' + Product
                                    .spec +
                                    '</textarea>' +
                                    '</td>' +
                                    '<td>' +
                                    '<input type="number" class="form-control unit-package-size-input" name="unit_package_size" data-id="' +
                                    Product.id + '" value="' + Product.unit_package_size + '">' +
                                    '</td>' +
                                    '<td>' + Product.product.unit_type.name + '</td>' +
                                    // '<td>' +
                                    // '<textarea class="form-control note-input" data-id="' +
                                    // Product.id + '" cols="20" rows="6">' + remarks +
                                    // '</textarea>' +
                                    // '</td>' +
                                    '<td>' +
                                    '<button type="button" class="btn removeProductBtn" data-id="' +
                                    Product.id +
                                    '"><i class="bx bx-trash text-danger"></i></button>' +
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
                            //show the total quantity of items
                            // $('#totalQuantityLabel').text('Quantity of ' + response.data.length + ' Item');

                            // Calculate the total quantity
                            var totalQuantity = response.data.reduce(function(acc, product) {
                                return acc + parseFloat(product.quantity,
                                    3); // Ensure quantity is treated as an integer
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
                                '<tr><td colspan="4">No Product Available</td></tr>');
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
                            url: "{{ route('temp-requisition-products.update', ':id') }}".replace(':id',
                                editorObj.productId),
                            type: 'PUT',
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
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

            getTempProduct();
            
            $('#Product_Table').on('click', '.addProductBtn', function() {
                var productId = $(this).data('id');
                var productName = $(this).data('product-name');
                var price = $(this).data('price');
                var spec = $(this).data('spec');
                var unit_price = $(this).data('unit-price');
                var unit_package_size = $(this).data('unit-package-size');

                $.ajax({
                    url: "{{ route('temp-requisition-products.store') }}",
                    type: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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
                    url: "{{ route('temp-requisition-products.destroy', ':id') }}".replace(
                        ':id',
                        productId),
                    type: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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

                $.ajax({
                    url: "{{ route('temp-requisition-products.update', ':id') }}".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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
                    url: "{{ route('temp-requisition-products.update', ':id') }}".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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

            $('#Temp_Requisitions_Table').on('change', '.spec-input', function() {
                var productId = $(this).data('id');
                var spec = $(this).val();

                $.ajax({
                    url: "{{ route('temp-requisition-products.update', ':id') }}".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    data: {
                        product_id: productId,
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

            $('#Temp_Requisitions_Table').on('change', '.unit-price-input', function() {
                var productId = $(this).data('id');
                var unit_price = $(this).val();

                $.ajax({
                    url: "{{ route('temp-requisition-products.update', ':id') }}".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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

            $(document).on('click', '#back_button', function() {
                window.location.href = "{{ route('requisitions.create') }}";
            });


            $('#Temp_Requisitions_Table').on('change', '.note-input', function() {
                var productId = $(this).data('id');
                var note = $(this).val();

                $.ajax({
                    url: "{{ route('temp-requisition-products.update', ':id') }}".replace(':id',
                        productId),
                    type: 'PUT',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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
            $(document).on('click', '#new_requisitions_submit', function(e) {
                e.preventDefault(); 
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to send this requisition for authorization?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    allowOutsideClick: false,  // Prevent closing by clicking outside
                    showCloseButton: true      // Show "X" close button
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If "Yes" is clicked
                        submitRequisition("{{ route('requisitions.store') }}", false);
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // If "No" is clicked
                        submitRequisition("{{ route('requisitions.noAuth') }}", true);
                    }
                });
            });

            function submitRequisition(route, noFlag) {
                const data = {
                    requisition_date: $('#requisition_date').val(),
                    company_value: $('#requisition_company').val(),
                    category: $('input[name="category"]:checked').val(),
                    category_two: $('input[name="category_two"]:checked').val(),
                    requisition_no: $('#requisition_no').val(),
                    buyer_name: $('#requisition_buyer_name').val(),
                    address: $('#requisition_address').val(), 
                    requisition_type: $('#requisition_type').val(),
                    sr:$('#sr_no').val(),
                    no_flag: noFlag
                };

                $.ajax({
                    url: route,
                    type: 'POST',
                    data: data,
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        let message = noFlag 
                            ? "Requisition approved without authentication." 
                            : "Requisition sent for approval.";

                        if (response.status) {
                            Swal.fire({
                                title: "Success!",
                                text: message,
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: true
                            }).then(() => {
                                location.href = "{{ route('requisitions.create') }}";
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: response.message || "Something went wrong!",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    },
                    error: function (xhr) {
                        if (xhr.responseJSON?.errors?.requisition_no) {
                            $('#requisition_noError').text(xhr.responseJSON.errors.requisition_no);
                        }
                        console.error('AJAX request error:', xhr);
                    }
                });
            }

            // Save Draft requisition
            $('#save_draft_button').on('click', function(e) {
                e.preventDefault();
                // Disable the submit button to prevent multiple submissions
                let submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                $.ajax({
                    url: "{{ route('requisitions_draft.save') }}",
                    type: 'POST',
                    data: {
                        requisition_date: $('#requisition_date').val(),
                        category: $('input[name="category"]:checked').val(),
                        category_two: $('input[name="category_two"]:checked').val(),
                        requisition_no: $('#requisition_no').val(),
                        buyer_name: $('#requisition_buyer_name').val(),
                        address: $('#requisition_address').val(),
                        requisition_type: $('#requisition_type').val(),
                        company_value: $('#requisition_company').val(),
                        sr:$('#sr_no').val(),
                        no_flag: false
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
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
                            location.href = "{{ route('requisitions.create') }}";
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

            $('#auto-generate-btn').on('click', function() {
                $.ajax({
                    url: "{{ route('requisitions.generate') }}",
                    type: 'GET',
                    success: function(data) {
                        $('#requisition_no').val(data.data);
                        Toastify({
                            text: "Requisition Number Generated Successfully",
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();
                    },
                    error: function(xhr) {
                        $('#requisition_noError').text(
                            'Error generating requisition number.');
                    }
                });
            });

            //hide
            $('#no_auto-generate-btn').on('click', function() {
                $.ajax({
                    url: "{{ route('requisitions.generate') }}",
                    type: 'GET',
                    success: function(data) {
                        $('#no_requisition_no').val(data.data);
                        Toastify({
                            text: "Requisition Number Generated Successfully",
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();
                    },
                    error: function(xhr) {
                        $('#requisition_noError').text(
                            'Error generating requisition number.');
                    }
                });
            });

            // Get company in dropdown
            let companyData = {};

            $.ajax({
                url: "{{ route('companies.create') }}",
                type: "GET",
                success: function(response) {
                    $('#requisition_company').empty(); // Make sure you're targeting the correct ID
                    $('#requisition_company').append('<option disabled selected>Select Company</option>');

                    response.company.forEach(function(company) {
                        $('#requisition_company').append('<option value="' + company.id + '">' + company.name + '</option>');
                        companyData[company.id] = company;
                    });
                },
                error: function(err) {
                    console.log(err);
                }
            });

            // Update buyer name and address on company selection
            $('#requisition_company').on('change', function() {
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
        @endsection