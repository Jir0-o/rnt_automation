<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>All Products</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <?php if(Auth::user()->can('Can Access Product Create')): ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#Products">
                                <i class="bx bx-edit-alt me-1"></i> Create Product
                            </button>
                            <?php endif; ?>
                            
                            <!-- Products Modal -->
                            <div class="modal fade" id="Products" tabindex="-1" aria-labelledby="ProductsLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="Products-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ProductsLabel">Create Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="product-name" class="form-label">Product Name
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="product-name"
                                                                name="product_name" required>
                                                            <span class="text-danger" id="ProductNameError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="product-category">Category
                                                                <span class="text-danger">*</span></label>
                                                            <select id="product-category" class="form-control"
                                                                name="product_category_id" required>
                                                                <option disabled selected>Select a Category</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="product-sub-category" class="form-label">Product
                                                                Sub Category <span class="text-danger">*</span></label>
                                                            <select id="product-sub-category"
                                                                name="product_sub_category_id" class="form-control"
                                                                required>
                                                                <!-- Options will be populated dynamically based on category selection -->
                                                            </select>
                                                            <span class="text-danger"
                                                                id="ProductSubCategoryError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="product-quantity" class="form-label">Product
                                                                Quantity <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control"
                                                                id="product-quantity" name="quantity" required>
                                                            <span class="text-danger" id="ProductQuantityError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="product-quantity" class="form-label">Product
                                                                Specification <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="product-specification" name="product-specification"
                                                                required>
                                                            <span class="text-danger" id="ProductQuantityError"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="bill-no" class="form-label">Bill No
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="bill-no"
                                                                name="bill-no" required>
                                                            <span class="text-danger" id="BillNoError"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="unit-type" class="form-label">Select Unit Type
                                                                <span class="text-danger">*</span></label>
                                                            <select id="unit-type" name="unit_type_id"
                                                                class="form-control" required>
                                                            </select>
                                                            <span class="text-danger" id="UnitTypeError"></span>
                                                        </div>
                                                        <!-- <div class="mb-3">
                                                            <label for="bar-code" class="form-label">Bar Code</label>
                                                            <input type="text" class="form-control" id="bar-code"
                                                                name="bar_code">
                                                            <span class="text-danger" id="BarCodeError"></span>
                                                        </div> -->
                                                        <div class="mb-3">
                                                            <label for="unit-price" class="form-label">Unit Price <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control" id="unit-price"
                                                                name="unit" step="0.001" min="0" required>
                                                            <span class="text-danger" id="UnitPriceError"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="purchase" class="form-label">Purchase From
                                                                </label>
                                                            <input type="text" class="form-control" id="purchase"
                                                                name="purchase">
                                                            <span class="text-danger" id="PurchaseError"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="date" class="form-label">Purchase Date
                                                                </label>
                                                            <input type="date" class="form-control" id="date"
                                                                name="date">
                                                            <span class="text-danger" id="DateError"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="requisition-no" class="form-label">Requisition No</label>
                                                            <input type="text" class="form-control" id="requisition_no"
                                                                name="requisition_no">
                                                            <span class="text-danger" id="RequisitionError"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create Product</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Product Modal -->
                            <div class="modal fade" id="EditProduct" tabindex="-1" aria-labelledby="EditProductLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <form id="EditProduct-Submit" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="EditProductLabel">Edit Product</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="edit-product-id">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="edit-product-name" class="form-label">Product
                                                                Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="edit-product-name" name="product_name" required>
                                                            <span class="text-danger" id="EditProductNameError"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="product-category">Category
                                                                <span class="text-danger">*</span></label>
                                                            <select id="edit-product-category" class="form-control"
                                                                name="edit-product_category_id" required>
                                                                <option disabled selected>Select a Category</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-product-sub-category"
                                                                class="form-label">Product Sub Category <span
                                                                    class="text-danger">*</span></label>
                                                            <select id="edit-product-sub-category"
                                                                name="product_sub_categorie_id" class="form-control"
                                                                required></select>
                                                            <span class="text-danger"
                                                                id="EditProductSubCategoryError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-product-quantity"
                                                                class="form-label">Product Quantity <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" class="form-control"
                                                                id="edit-product-quantity" name="edit-quantity"
                                                                required>
                                                            <span class="text-danger" id="ProductQuantityError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-product-specification"
                                                                class="form-label">Product Specification <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="edit-product-specification" name="edit-quantity"
                                                                required>
                                                            <span class="text-danger" id="ProductQuantityError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-bill-no" class="form-label">Bill No </label>
                                                            <input type="text" class="form-control" id="edit-bill-no"
                                                                name="edit-bill-no">
                                                            <span class="text-danger" id="EditBillNoError"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label for="edit-unit-type" class="form-label">Unit Type
                                                                <span class="text-danger">*</span></label>
                                                            <select id="edit-unit-type" name="unit_type_id"
                                                                class="form-control" required></select>
                                                            <span class="text-danger" id="EditUnitTypeError"></span>
                                                        </div>

                                                        <!-- <div class="mb-3">
                                                            <label for="edit-bar-code" class="form-label">Bar
                                                                Code</label>
                                                            <input type="text" class="form-control" id="edit-bar-code"
                                                                name="bar_code">
                                                            <span class="text-danger" id="EditBarCodeError"></span>
                                                        </div> -->

                                                        <div class="mb-3">
                                                            <label for="edit-unit-price" class="form-label">Unit Price
                                                                <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control"
                                                                id="edit-unit-price" name="unit" step="0.001" min="0"
                                                                required>
                                                            <span class="text-danger" id="UnitPriceError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-purchase" class="form-label">Purchase From
                                                            </label>
                                                            <input type="text" class="form-control" id="edit-purchase"
                                                                name="edit_purchase" >
                                                            <span class="text-danger" id="EditPurchaseError"></span>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="edit-date" class="form-label">Purchase Date
                                                            </label>
                                                            <input type="date" class="form-control" id="edit-date"
                                                                name="edit_date" >
                                                            <span class="text-danger" id="EditDateError"></span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit-requisition-no" class="form-label">Requisition No</label>
                                                            <input type="text" class="form-control" id="edit_requisition_no"
                                                                name="edit_requisition_no">
                                                            <span class="text-danger" id="editrequisitionError"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update Product</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Products Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="Requisitions_Table" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Product Sub Category</th>
                            <th>Total Quantity</th>
                            <th>Unit Price</th>
                            <th>Unit Type</th>
                            <th>Specification</th>
                            <th>Requisition No</th>
                            <th>Barcode</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Requisitions-Table">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($product->product_name); ?></td>
                            <td><?php echo e($product->productSubCategory->product_sub_category_name); ?></td>
                            <td><?php echo e($product->final_quantity); ?></td>
                            <td><?php echo e($product->unit_price); ?></td>
                            <td><?php echo e($product->unitType->name); ?></td>
                            <td><?php echo e($product->spec); ?></td>
                            <td><?php echo e($product->requisition_no ?? 'No Requisition no found'); ?></td>
                            <td class="text-center">
                                <?php if($product->bar_code == null): ?>
                                <i class='bx bx-barcode crateBarcode' data-product_id=<?php echo e(encrypt($product->id)); ?>

                                    style='font-size: 28px;cursor: pointer;'></i>
                                <?php else: ?>
                                <a target="_blank" class="btn"
                                    href="<?php echo e(route('print.barcode', ['id' => encrypt($product->id)])); ?>">
                                    <img src="<?php echo e(asset('print/printer.webp')); ?>" alt="print"
                                        style="width: 2rem; cursor: pointer;">
                                </a>
                                <?php endif; ?>

                            </td>
                            <td>
                                <?php if($product->is_active == 0): ?>
                                <span class="badge bg-warning">Pending</span>
                                <?php elseif($product->is_active == 1): ?>
                                <span class="badge bg-success">Approved</span>
                                <?php else: ?>
                                <span class="badge bg-danger">Rejected</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary editrequisitionBtn"
                                    data-id="<?php echo e($product->id); ?>">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </button>
                                <button type="button" class="btn btn-danger deleterequisitionBtn"
                                    data-id="<?php echo e($product->id); ?>">
                                    <i class="bx bx-trash me-1"></i> Delete
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('unit-price').addEventListener('input', function() {
    var value = parseFloat(this.value);
    var errorSpan = document.getElementById('UnitPriceError');

    if (value < 0) {
        errorSpan.textContent = 'Unit price cannot be negative';
        this.value = ''; // Clear the invalid input
    } else {
        errorSpan.textContent = ''; // Clear the error message
    }
});

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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



    // Load categories on page load
    loadmyCategories();


    // Load Sub categories
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
                        productSubCategories.product_sub_category_name + '</option>'
                    );
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    }


    // Load unit types

    function loadUnitTypes() {
        $.ajax({
            url: "<?php echo e(route('unit-types.index')); ?>",
            type: "GET",
            success: function(response) {
                $('#unit-type, #edit-unit-type').empty();
                $('#unit-type, #edit-unit-type').append(
                    '<option disabled selected>Select a Unit Type</option>');
                response.data.forEach(function(unitType) {
                    $('#unit-type, #edit-unit-type').append('<option value="' + unitType
                        .id + '">' + unitType.name + '</option>');
                });
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    // Edit button click
    $(document).on('click', '.editrequisitionBtn', function() {
        var productId = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('products.show', ':id')); ?>".replace(':id', productId),
            type: 'GET',
            success: function(response) {
                var product = response.product;
                $('#edit-product-id').val(product.id);
                $('#edit-product-name').val(product.product_name);
                $('#edit-product-sub-category').val(product.product_sub_categorie_id);
                $('#edit-unit-type').val(product.unit_type_id);
                $('#edit-product-quantity').val(product.final_quantity);
                $('#edit-product-specification').val(product.spec);
                $('#edit-bar-code').val(product.bar_code);
                $('#edit-unit-price').val(product.unit_price);
                $('#edit-date').val(product.purchase_date);
                $('#edit-purchase').val(product.purchase_from);
                $('#edit-bill-no').val(product.bill_no);
                $('#edit_requisition_no').val(product.requisition_no);
                $('#edit-product-category').val(product.product_categorie_id);
                $('#EditProduct').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching product details:', error);
            }
        });
    });

    // Delete button click
    $(document).on('click', '.deleterequisitionBtn', function() {
        var productId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this product!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#228B22',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: "<?php echo e(route('products.destroy', ':id')); ?>".replace(':id',
                        productId),
                    data: {
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == 200) {
                            Toastify({
                                text: data.message,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "green",
                                stopOnFocus: true,
                            }).showToast();
                        } else {
                            Toastify({
                                text: data.message,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "red",
                                stopOnFocus: true,
                            }).showToast();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting product:', error);
                    }
                });

            }
        });
    });

    // Handle form submission for editing product
    $('#EditProduct-Submit').on('submit', function(e) {
        e.preventDefault();

        var productId = $('#edit-product-id').val();
        var formData = {
            'product_name': $('#edit-product-name').val(),
            'product_category_id': $('#edit-product-category').val(),
            'product_sub_categorie_id': $('#edit-product-sub-category').val(),
            'unit_type_id': $('#edit-unit-type').val(),
            'product_quantity': $('#edit-product-quantity').val(),
            'product_specification': $('#edit-product-specification').val(), // Add this line
            'bar_code': $('#edit-bar-code').val(),
            'unit_price': $('#edit-unit-price').val(),
            'edit-date': $('#edit-date').val(),
            'edit-purchase': $('#edit-purchase').val(),
            'edit-bill-no': $('#edit-bill-no').val(),
            'edit-requisition-no': $('#edit_requisition_no').val(),
        };

        $.ajax({
            url: "<?php echo e(route('products.update', ':id')); ?>".replace(':id', productId),
            type: "PUT",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            success: function(response) {
                if (response.status) {
                    location.reload(); // Reload the page to see the updated product
                } else {
                    if (response.errors) {
                        $.each(response.errors, function(key, error) {
                            $('#edit-' + key + '-error').text(error);
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
            }
        });
    });

    loadmyCategories();
    loadCategories();
    loadUnitTypes();

    //Store create Product

    $('#Products-Submit').on('submit', function(e) {
        e.preventDefault();
        // Disable the submit button to prevent multiple submissions
        let submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true);

        var formData = {
            'product_name': $('#product-name').val(),
            'product_category_id': $('#product-category').val(),
            'product_sub_categorie_id': $('#product-sub-category').val(),
            'unit_type_id': $('#unit-type').val(),
            'bar_code': $('#bar-code').val(),
            'product_quantity': $('#product-quantity').val(),
            'product_specification': $('#product-specification').val(), // Add this line
            'unit_price': $('#unit-price').val(),
            'bill_no': $('#bill-no').val(),
            'purchase': $('#purchase').val(),
            'date': $('#date').val(),
            'requisition_no': $('#requisition_no').val(), 
        };

        $.ajax({
            url: "<?php echo e(route('products.store')); ?>",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: 'application/json',
            processData: false,
            success: function(response) {
                if (response.status) {
                    location.reload(); // Reload the page to see the new product
                } else {
                    // Handle validation errors
                    if (response.errors) {
                        $.each(response.errors, function(key, error) {
                            $('#' + key + 'Error').text(error[0]);
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                var response = xhr.responseJSON;
                if (xhr.status === 422) {
                    // Clear previous errors
                    $('#ProductNameError').text('');
                    $('#ProductSubCategoryError').text('');
                    $('#UnitTypeError').text('');
                    $('#BarCodeError').text('');
                    $('#ProductQuantityError').text('');
                    $('#UnitPriceError').text('');
                    $('#BillNoError').text('');
                    $('#PurchaseError').text('');
                    $('#DateError').text('');
                    $('#RequisitionError').text('');

                    // Display validation errors
                    $.each(response.errors, function(key, error) {
                        $('#' + key.replace(/_/g, '-') + 'Error').text(error[
                            0]);
                    });
                } else {
                    // Handle server errors
                    var errorMsg =
                        'An unexpected error occurred. Please try again later.';
                    if (response && response.message) {
                        errorMsg = response.error;
                    }
                    $('#ProductNameError').text(errorMsg);
                    console.error('Form submission error:', error, response);
                }
            },
            complete: function() {
                submitButton.prop('disabled', false);
            }
        });
    });
});

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

$('#edit-product-category').change(function() {
    let categoryId = $(this).val();
    if (categoryId) {
        loadSubCategories(categoryId); // Load subcategories
    } else {
        // Clear subcategory dropdown if no category is selected
        $('#edit-product-sub-category').empty().append(
            '<option disabled selected>Select a Sub Category</option>'
        );
    }
});
// create barcode
$('.crateBarcode').on('click', function(e) {
    // e.preventDefault();

    var product_id = $(this).data('product_id');

    $.ajax({
        url: "<?php echo e(route('products.createBarcode', ':id')); ?>".replace(':id', product_id),
        type: "get",
        contentType: 'application/json',
        processData: false,
        success: function(response) {

            if (response.status) {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "green",
                    stopOnFocus: true,
                }).showToast();
            }
            if (response.exist) {
                Toastify({
                    text: response.message,
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "red",
                    stopOnFocus: true,
                }).showToast();
            }
            window.location.reload();
        },
        error: function(xhr, status, error) {

        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\RNT Automation\resources\views/backend/products/createProduct.blade.php ENDPATH**/ ?>