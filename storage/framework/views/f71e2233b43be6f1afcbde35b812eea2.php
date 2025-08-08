
<?php $__env->startSection('content'); ?>

<div class="row mt-5">
    <form id="requisitions_submit">
        <div class="col-12 col-md-12">
            <!-- Left Side -->
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="Category">Product Category <span class="text-danger">*</span></label>
                            <select id="Category-DropDown" name="Category-DropDown" class="form-control"></select>
                            <span class="text-danger" id="CategoryError"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="SubCategory">Product Sub Category <span class="text-danger">*</span></label>
                            <select id="Sub-Category-DropDown" name="Sub-Category-DropDown"
                                class="form-control"></select>
                            <span class="text-danger" id="SubCategoryError"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">Product</h5>
                            <div class="table-responsive text-nowrap p-3">
                                <table id="Product_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Current Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0" id="Product_Table_data">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card card-default">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="card-title">Purchase Items</h5>
                            <div class="table-responsive text-nowrap p-3">
                                <table id="Temp_Requisitions_Table" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
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

            <div class="card">
                <div class="card-header">
                    <h4>Billing Details</h4>
                </div>
                <div class="card-body">

                    <!-- Billing Date (user-provided) -->
                    <div class="form-group">
                        <label for="billing_date">Billing Date</label>
                        <input type="date" name="billing_date" id="billing_date" class="form-control" required>
                    </div>
                    <br>
                    <!-- Billing No (input field) -->
                    <div class="form-group">
                        <label for="billing_no">Billing No</label>
                        <input type="text" name="billing_no" id="billing_no" class="form-control"
                            placeholder="Enter Billing No" required>
                    </div>
                    <br>
                    <!-- Purchase From (input field) -->
                    <div class="form-group">
                        <label for="purchase_from">Purchase From</label>
                        <input type="text" name="purchase_from" id="purchase_from" class="form-control"
                            placeholder="Enter Purchase From" required>
                    </div>
                    <br>
                </div>
            </div>


            <br>
            <div class="card card-default">
                <div class="card-body">
                    <h5 class="card-title">Purchase Details</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td id="itemQuantityLabel">Quantity of Items</td>
                                    <td id="itemQuantityValue"></td>
                                </tr>
                                <tr>
                                    <td>Total Value</td>
                                    <td id="subTotal"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <div class="float-end">
                        <button class="btn btn-primary" type="submit" id="requisitions_submit"><i
                                class='bx bxs-cart-add' style="margin-left: -7px; margin-right: 3px;">
                            </i>Purchase</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
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
                        $('#Sub-Category-DropDown').append('<option value="' +
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
                        $('#Product_Table_data').append(
                            '<tr>' +
                            '<td>' + serialNo + '</td>' +
                            '<td>' + Product.product_name + '</td>' +
                            '<td>' + Product.unit_price + '</td>' +
                            '<td>' + Product.final_quantity + '</td>' +
                            '<td>' +
                            '<button type="button" class="btn btn-primary addProductBtn" data-id="' +
                            Product.id + '" data-product-name="' + Product
                            .product_name +
                            '" data-price="' + Product.unit_price +
                            '"><i class="bx bx-cart-add"></i></button>' +
                            '</td>' +
                            '</tr>'
                        );
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

    function getTempProduct() {
        $.ajax({
            url: "<?php echo e(route('temp-received-products.index')); ?>",
            type: 'GET',
            success: function(response) {
                if (response.status == true) {
                    $('#Temp_Requisitions_Table_Data').empty();
                    let serialNo = 1; // Initialize the serial number
                    response.data.forEach(Product => {
                        $('#Temp_Requisitions_Table_Data').append(
                            '<tr>' +
                            '<td>' + serialNo + '</td>' +
                            '<td>' + Product.product.product_name + '</td>' +
                            // '<td>' + Product.unit_price + '</td>' +
                            '<td>' +
                            '<input type="text" class="form-control price-input" name="price" data-id="' +
                            Product.id + '" value="' + Product.unit_price + '">' +
                            '</td>' +
                            '<td>' +
                            '<input type="number" class="form-control quantity-input" name="quantity" data-id="' +
                            Product.id + '" value="' + Product.quantity + '">' +
                            '</td>' +
                            '<td>' + Product.total_price + '</td>' +
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
                    $('#totalQuantityLabel').text('Quantity of ' + response.data.length + ' Item');

                    // Calculate the total quantity
                    var totalQuantity = response.data.reduce(function(acc, product) {
                        return acc + product.quantity;
                    }, 0);
                    $('#itemQuantityValue').text(totalQuantity);

                    // Calculate the total price
                    var totalPrice = response.data.reduce(function(acc, product) {
                        return acc + (product.quantity * product.unit_price);
                    }, 0);

                    $('#subTotal').text(totalPrice);

                    // Calculate the payable amount
                    var payableAmount = totalPrice;
                    $('#payAbale').text(payableAmount);

                    $('#dueAmount').text(payableAmount);

                    $('#paidAmount').text(payableAmount);
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
    getTempProduct();

    $('#Product_Table').on('click', '.addProductBtn', function() {
        var productId = $(this).data('id');
        var productName = $(this).data('product-name');
        var price = $(this).data('price');

        $.ajax({
            url: "<?php echo e(route('temp-received-products.store')); ?>",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            data: {
                product_id: productId,
                product_name: productName,
                price: price,
                quantity: 1
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
            url: "<?php echo e(route('temp-received-products.destroy', ':id')); ?>".replace(':id',
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


    $('#Temp_Requisitions_Table').on('change', '.price-input', function() {
        console.log('Quantity changed');
        var productId = $(this).data('id');
        var price = $(this).val();
        var quantity = $(this).closest('tr').find('.quantity-input')
    .val(); // Get quantity for the same product row

        console.log(price);
        console.log(quantity);
        $.ajax({
            url: "<?php echo e(route('temp-received-products.update', ':id')); ?>".replace(':id',
                productId),
            type: 'PUT',
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            data: {
                product_id: productId,
                price: price,
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

    $('#Temp_Requisitions_Table').on('change', '.quantity-input', function() {
        console.log('Quantity changed');
        var productId = $(this).data('id');
        var quantity = $(this).val();
        var price = $(this).closest('tr').find('.price-input').val();
        console.log(price);
        console.log(quantity);
        $.ajax({
            url: "<?php echo e(route('temp-received-products.update', ':id')); ?>".replace(':id',
                productId),
            type: 'PUT',
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            data: {
                product_id: productId,
                quantity: quantity,
                price: price
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
    $('#requisitions_submit').on('submit', function(e) {
        e.preventDefault();

        // Disable the submit button to prevent multiple submissions
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);

        var formData = {
            billing_date: $('#billing_date').val(),
            billing_no: $('#billing_no').val(),
            purchase_from: $('#purchase_from').val()
        };

        $.ajax({
            url: "<?php echo e(route('received-products.store')); ?>",
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            data: formData,
            success: function(response) {
                if (response.status) {
                    Toastify({
                        text: 'Purchase successful!',
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    location.reload();
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
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/backend/purchases/purchases.blade.php ENDPATH**/ ?>