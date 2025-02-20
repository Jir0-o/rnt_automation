<?php $__env->startSection('content'); ?>

<style>
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
                <form id="tamp_allocations_submit">
                    <div class="row">
                        <div class="col-12">
                            <label for="requisition">Requisitions <span class="text-danger">*</span></label>
                            <select id="Requisition-DropDown" name="Requisition-DropDown" class="form-control"></select>
                            <span class="text-danger" id="RequisitionError"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">Requisition Product List</h5>
                            <div class="table-responsive text-nowrap p-3">
                                <table id="Temp_Requisitions_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Specification</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="Temp_Requisitions_Table_Data">
                                        <!-- Data will be dynamically added here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="SubCategory">Requested Product<span class="text-danger">*</span></label>
                            <select id="Requested-Product-DropDown" name="Requested-Product-DropDown"
                                class="form-control"></select>
                            <span class="text-danger" id="RequestedProductError"></span>
                        </div>
                        <div class="col-6">
                            <label for="Quantity">Allocated Quantity<span class="text-danger">*</span></label>
                            <input type="number" id="Requested-Quantity" name="Quantity" class="form-control"
                                step="0.001" min="0" />
                            <span class="text-danger" id="QuantityError"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="Quantity">Current Stock<span class="text-danger"></span></label>
                            <input type="text" id="Current-Stock" name="Quantity" class="form-control" disabled />
                            <span class="text-danger" id="QuantityError"></span>
                        </div>
                        <div class="col-6">
                            <label for="Quantity">Unite Price<span class="text-danger"></span></label>
                            <input type="text" id="Unite-Price" name="Quantity" class="form-control" disabled />
                            <span class="text-danger" id="QuantityError"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="Specefication">Specefication<span class="text-danger"></span></label>
                            <input type="text" id="Specefication" name="Specefication" class="form-control" disabled />
                        </div>
                    </div>
                    <br>
                    <div class="float-end">
                        <button class="btn btn-primary" type="submit" id="tamp_allocations_submit"><i class='bx bx-plus'
                                style="margin-left: -7px; margin-right: 3px;"></i>Add
                            Product</button>
                    </div>
                    <br>
                    <br>
                </form>
                <div class="card card-default">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form id="allocations_submit">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-title">Products</h5>
                                            <div class="table-responsive text-nowrap p-3">
                                                <table id="Product_Table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Product Name</th>
                                                            <th>Unite Price</th>
                                                            <th>Quantity</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0" id="Product_Table_data">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="float-end">
                                        <button class="btn btn-primary" type="submit" id="allocations_submit"><i
                                                class='bx bx-plus'
                                                style="margin-left: -7px; margin-right: 3px;"></i>Allocation</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="card card-default">
                    <div class="card-body">
                        <h5 class="card-title">Allocation Details</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td id="itemQuantityLabel">Quantity of Items</td>
                                        <td id="itemQuantityValue"></td>
                                    </tr>
                                    <tr>
                                        <td>Total Value (TK)</td>
                                        <td id="subTotal"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="productList" tabindex="-1" aria-labelledby="allocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="allocationModalLabel">Add for purchases</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessages" class="alert alert-danger d-none"></div> <!-- Error message container -->
                <form id="purchaseForm">
                    <input type="hidden" id="requisition_id" name="requisition_id">
                    <input type="hidden" id="product_id" name="product_id">
                    <table id="Temp_Requisitions_Table" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Specification</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="all_products">
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary mt-3 float-end" id="purchesBtn">Proceed</button>
                </form>
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

    // Get Requisitions
    function getRequisitions() {
        $.ajax({
            url: "<?php echo e(route('requisitions.index')); ?>",
            type: "GET",
            success: function(response) {
                $('#Requisition-DropDown').empty();

                $('#Requisition-DropDown').append(`
                    <option value="">Select Requisition</option>
                `);
                response.data.forEach(requisition => {
                    $('#Requisition-DropDown').append(`
                        <option value="${requisition.id}">${requisition.requisition_no}</option>
                    `);
                });

                let requisition_id = localStorage.getItem('requisition_id');

                if (requisition_id) {
                    $('#Requisition-DropDown').val(requisition_id);
                    $('#Requisition-DropDown').trigger('change');
                    getTempProduct();
                } else {
                    $('#Requisition-DropDown').val('');
                    $('#Requisition-DropDown').trigger('change');
                }
            }
        });
    }
    getRequisitions();


    //getRequisitions on change
    $('#Requisition-DropDown').on('change', function() {

        $('#Current-Stock').val('');
        $('#Unite-Price').val('');

        // Clear the requested quantity field initially
        $('#Requested-Quantity').val('');
        getTempAllocationProduct();
        getTempProduct();
    });

    function getTempProduct() {
        let requisition_id = $('#Requisition-DropDown').val();
        $.ajax({
            url: "<?php echo e(route('temp-requisition-products.show', ':id')); ?>".replace(':id',
                requisition_id),
            type: 'GET',
            success: function(response) {
                console.log(response);
                if (response.status == true) {
                    $('#Temp_Requisitions_Table_Data').empty();
                    let serialNo = 1; // Initialize the serial number
                    response.data.forEach(Product => {
                        $('#Temp_Requisitions_Table_Data').append(
                            '<tr>' +
                            '<td>' + serialNo + '</td>' +
                            '<td>' + Product.product.product_name + '</td>' +
                            '<td>' + Product.quantity + '</td>' +
                            '<td>' + Product.unit_type.name + '</td>' +
                            '<td>' + Product.spec + '</td>' +
                            '<td>' +
                            '<button type="button" class="btn btn-primary purchaseProductBtn " data-id="' +
                            Product.id +
                            '" data-requisition_id="' + Product.requisition_id +
                            '" data-quantity="' + Product.quantity +
                            '" data-product_id="' + Product.product_id +
                            '" data-spec="' + Product.spec +
                            '" data-product_name ="' + Product.product
                            .product_name +
                            '" data-unit_type="' + Product.unit_type.name +
                            '"><i class="bx bx-plus"></i>Buy</button>' +
                            '</td>' +
                            '</tr>'
                        );

                        serialNo++; // Increment the serial number
                    });

                    // Empty the dropdown before the loop
                    $('#Requested-Product-DropDown').empty();

                    // Add the default "Select Product" option
                    $('#Requested-Product-DropDown').append(
                        '<option value="">Select Product</option>'
                    );

                    // Loop through each product and append it to the dropdown
                    response.allProduct.forEach(product => {
                        $('#Requested-Product-DropDown').append(
                            '<option value="' + product.id + '">' + product
                            .product_name + '</option>'
                        );
                    });

                    var button = $('#createBtn');
                    if (button.length) {
                        button.css('display', 'block');
                    } else {
                        console.error('Button not found');
                    }
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

    $('#Requested-Product-DropDown').on('change', function() {
        let product_id = $(this).val();
        $.ajax({
            url: "<?php echo e(route('requisition-products.show', ':id')); ?>".replace(':id',
                product_id),
            type: 'GET',
            success: function(response) {
                if (response.status) {
                    let product = response.data;
                    let requisitionProducts = response.requisitionProducts;

                    $('#Current-Stock').val(product.temp_quantity + ' ' + product
                        .unit_type
                        .name);
                    $('#Unite-Price').val(product.unit_price + ' TK');

                    // Clear the requested quantity field initially
                    $('#Requested-Quantity').val('');
                    $('#Specefication').val(product.spec);

                    requisitionProducts.forEach(reqProduct => {
                        $('#Requested-Quantity').val(reqProduct.quantity);

                        localStorage.removeItem('requested_quantity');

                        localStorage.setItem('requested_quantity', reqProduct.quantity);
                    });
                } else {
                    console.error('Failed to fetch data:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            }
        });
    });

    function getTempAllocationProduct() {
        let requisition_id = $('#Requisition-DropDown').val();
        $.ajax({
            url: "<?php echo e(route('temp-allocation-products.show', ':id')); ?>".replace(':id',
                requisition_id),
            type: 'GET',
            success: function(response) {
                // console.log(response);
                if (response.status) {
                    $('#Product_Table_data').empty();
                    let serialNo = 1; // Initialize the serial number
                    response.data.forEach(Product => {
                        $('#Product_Table_data').append(
                            '<tr>' +
                            '<td>' + serialNo + '</td>' +
                            '<td>' + Product.product.product_name + '</td>' +
                            '<td>' + Product.unit_price + '</td>' +
                            '<td>' + Product.quantity + '</td>' +
                            '<td>' +
                            '<button type="button" class="btn removeProductBtn" data-id="' +
                            Product.id +
                            '"><i class="bx bx-trash text-danger"></i></button>' +
                            '</td>' +
                            '</tr>'
                        );

                        serialNo++; // Increment the serial number
                    });

                    //show the total quantity of items
                    $('#totalQuantityLabel').text('Quantity of ' + response.data.length +
                        ' Item');

                    // Calculate the total quantity
                    var totalQuantity = response.data.reduce(function(acc, product) {
                        return acc + parseFloat(product.quantity,
                            10); // Ensure quantity is treated as an integer
                    }, 0);

                    $('#itemQuantityValue').text(totalQuantity);

                    // Calculate the total price
                    var totalPrice = response.data.reduce(function(acc, product) {
                        var quantity = parseFloat(product.quantity) ||
                            0; // Convert to float, default to 0 if NaN
                        var unitPrice = parseFloat(product.unit_price) ||
                            0; // Convert to float, default to 0 if NaN
                        return acc + (quantity * unitPrice);
                    }, 0);

                    // Optionally, format the total price to 2 decimal places
                    totalPrice = totalPrice.toFixed(2);

                    // Update the subtotal element
                    $('#subTotal').text(totalPrice);

                    // Calculate the payable amount
                    var payableAmount = totalPrice;
                    $('#payAbale').text(payableAmount);

                    $('#dueAmount').text(payableAmount);

                    $('#paidAmount').text(payableAmount);
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
    }

    $('#tamp_allocations_submit').on('submit', function(e) {
        e.preventDefault();
        // Disable the submit button to prevent multiple submissions
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);

        let product_id = $('#Requested-Product-DropDown').val();
        let quantity = $('#Requested-Quantity').val();

        if (product_id == '') {
            $('#RequestedProductError').text('Product is required');
            return;
        } else {
            $('#RequestedProductError').text('');
        }

        if (quantity == '') {
            $('#QuantityError').text('Quantity is required');
            return;
        } else {
            $('#QuantityError').text('');
        }

        if (parseInt(quantity) > parseInt($('#Current-Stock').val())) {
            $('#QuantityError').text('Quantity is greater than current stock');
            return;
        } else {
            $('#QuantityError').text('');
        }

        if (parseInt(quantity) < 0) {
            $('#QuantityError').text('Quantity must be greater than 0');
            return;
        } else {
            $('#QuantityError').text('');
        }

        // Fetch the values and convert them to integers
        var requestedQuantity = parseInt(localStorage.getItem('requested_quantity'));

        if (parseInt(quantity) > parseInt(requestedQuantity)) {
            $('#QuantityError').text('Quantity must be less than to requested quantity');
            return;
        } else {
            $('#QuantityError').text('');
        }

        $.ajax({
            url: "<?php echo e(route('temp-allocation-products.store')); ?>",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            data: {
                requisition_id: $('#Requisition-DropDown').val(),
                product_id: product_id,
                quantity: quantity,
                unit_price: $('#Unite-Price').val(),
            },
            success: function(response) {
                if (response.status) {
                    getTempAllocationProduct();
                } else if (response.status == false) {
                    console.error('Failed to add product:', response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Product already allocated');
                console.error('AJAX request error:', error);
            },
            complete: function() {
                submitButton.prop('disabled', false);
            }
        });
    });

    $('#Product_Table_data').on('click', '.removeProductBtn', function() {
        var productId = $(this).data('id');

        $.ajax({
            url: "<?php echo e(route('temp-allocation-products.destroy', ':id')); ?>".replace(':id',
                productId),
            type: 'DELETE',
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            success: function(response) {
                if (response.status) {
                    getTempAllocationProduct();
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            }
        });
    });

    $('#allocations_submit').on('submit', function(e) {
        e.preventDefault();
        // Disable the submit button to prevent multiple submissions
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);

        $.ajax({
            url: "<?php echo e(route('allocations.store')); ?>",
            type: 'POST',
            data: {
                requisition_id: $('#Requisition-DropDown').val(),
            },
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            success: function(response) {
                if (response.status) {
                    Toastify({
                        text: "Allocation created successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    localStorage.removeItem('requisition_id');
                    location.href = "<?php echo e(route('allocations.create')); ?>";
                } else {
                    console.error('Failed to add product:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);
            },
            complete: function() {
                submitButton.prop('disabled', false);
            }
        });
    });

    $('#Requisition-DropDown').on('change', function() {
        let requisition_id = $(this).val();
        let createCommitteeUrl = "<?php echo e(route('requisitions.committee')); ?>?requisition_id=" +
            requisition_id;
        $('#create-committee-btn').attr('href', createCommitteeUrl);
    });

    $('#Requisition-DropDown').trigger('change');


    // Global variable to store the clicked Buy button reference
    let clickedBuyButton = null;
    // Use event delegation to bind the click event to dynamically added buttons
    $(document).on('click', '.purchaseProductBtn', function() {
        // Store the reference to the clicked Buy button
        clickedBuyButton = $(this);
        // Clear error messages
        clearErrorMessages();

        let product_id = $(this).data('product_id');
        let requisition_id = $(this).data('requisition_id');
        let product_spec = $(this).data('spec');
        let product_quantity = $(this).data('quantity');
        let product_name = $(this).data('product_name');
        let unit_type = $(this).data('unit_type');

        // Clear the modal's table body
        $('#all_products').empty();

        // Append the product details to the modal's table body
        $('#all_products').append(
            '<tr>' +
            '<td>1</td>' +
            '<td>' + product_name + '</td>' +
            '<td><input type="number" class="form-control" name="quantity" value="' +
            product_quantity + '" /></td>' +
            '<td>' + unit_type + '</td>' +
            '<td><textarea class="form-control" name="spec" data-id="' + product_id + '">' +
            product_spec + '</textarea></td>' +
            '</tr>'
        );

        // Initialize CKEditor for the newly added textarea
        var specTextarea = $('textarea[name="spec"][data-id="' + product_id + '"]')[0];
        if (specTextarea) {
            CKEDITOR.replace(specTextarea, {
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList']
                    },
                    {
                        name: 'styles',
                        items: ['Format']
                    }
                ],
                height: 100,
                removePlugins: 'elementspath',
                resize_enabled: false,
                versionWarning: false
            });
        }

        // Store the editor instance in the array           
        // Set the requisition_id and product_id in the hidden inputs
        $('#requisition_id').val(requisition_id);
        $('#product_id').val(product_id);

        // Show the modal
        $('#productList').modal('show');
    });

    function clearErrorMessages() {
        $('#errorMessages').html('').addClass('d-none');
    }


    // Handle form submission
    $('#purchaseForm').on('submit', function(event) {
        event.preventDefault();

        // Get form data
        let formData = new FormData();
        formData.append('requisition_id', $('#requisition_id').val());
        formData.append('product_id', $('#product_id').val());
        formData.append('spec', CKEDITOR.instances['spec'].getData());
        formData.append('quantity', $('input[name="quantity"]').val());

        // AJAX request to send form data to the controller
        $.ajax({
            url: "<?php echo e(route('purchases.demand')); ?>",
            type: 'POST',
            data: formData,
            contentType: false, // Prevent jQuery from overriding the content type
            processData: false, // Prevent jQuery from processing the data
            success: function(response) {
                $('#productList').modal('hide');
                Toastify({
                    text: 'Product Added successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();
                // Disable the Buy button that was clicked
                if (clickedBuyButton) {
                    clickedBuyButton.prop('disabled', true).text('Buy Requested');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request error:', error);

                // Parse the error messages
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';

                // Loop through the errors and format them
                if (errors) {
                    $.each(errors, function(key, value) {
                        errorMessages += '<p>' + value[0] + '</p>';
                    });
                } else if (xhr.responseJSON.message) {
                    errorMessages = '<p>' + xhr.responseJSON.message + '</p>';
                }

                // Display the error messages in the modal
                $('#errorMessages').html(errorMessages).removeClass('d-none');
            }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/allocations_add.blade.php ENDPATH**/ ?>