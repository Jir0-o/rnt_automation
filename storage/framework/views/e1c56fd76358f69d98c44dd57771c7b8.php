
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Daily Cost</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button to trigger the Create Modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDailyCostModal">
                                <i class="bx bx-edit-alt me-1"></i> Add New Cost
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="Requisitions_Table" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Cost Type</th>
                            <th>Transaction Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $dailyCosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dailyCost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($dailyCost->name); ?></td>
                            <td><?php echo e($dailyCost->date); ?></td>
                            <td><?php echo e($dailyCost->cost_type); ?></td>
                            <td><?php echo e($dailyCost->tnx_type); ?></td>
                            <td><?php echo e($dailyCost->description); ?></td>
                            <td class="text-end"><?php echo e($dailyCost->amount); ?></td>
                            <td>
                                <!-- Button to trigger the Edit Modal -->
                                <button type="button" class="btn btn-sm btn-primary edit-daily-cost" data-id="<?php echo e($dailyCost->id); ?>" data-bs-toggle="modal" data-bs-target="#editDailyCostModal">
                                    Edit
                                </button>
                                <form action="<?php echo e(route('daily-costs.destroy', $dailyCost->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Daily Cost Modal -->
<div class="modal fade" id="createDailyCostModal" tabindex="-1" aria-labelledby="createDailyCostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="createDailyCostForm" action="<?php echo e(route('daily-costs.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="createDailyCostModalLabel">Add New Daily Cost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Cost Name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date" placeholder="Enter Date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="cost_type" class="form-label">Cost Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="cost_type" name="cost_type" required>
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tnx_type" class="form-label">Transaction Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="tnx_type" name="tnx_type" required>
                            <option value="">Select Transaction Type</option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" placeholder="Enter Cost Description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount" 
                            placeholder="Enter Your Amount" required step="0.01" 
                            pattern="^\d+(\.\d{1,2})?$" oninput="validateDecimal(this)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Daily Cost Modal -->
<div class="modal fade" id="editDailyCostModal" tabindex="-1" aria-labelledby="editDailyCostModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editDailyCostForm" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editDailyCostModalLabel">Edit Daily Cost</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_cost_type" class="form-label">Cost Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="edit_cost_type" name="cost_type" required>
                            
                        </select>
                    </div>

                     <div class="mb-3">
                        <label for="edit_tnx_type " class="form-label">Transaction Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="edit_tnx_type" name="tnx_type" required>
                            <option value="">Select Transaction Type</option>
                            <option value="Income">Income</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="edit_amount" class="form-label">Amount <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="edit_amount" name="amount" 
                            required step="0.01" pattern="^\d+(\.\d{1,2})?$" 
                            oninput="validateDecimal(this)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateDecimal(input) {
    let value = input.value;
    if (value.includes(".")) {
        let parts = value.split(".");
        if (parts[1].length > 2) {
            input.value = parseFloat(value).toFixed(2);
        }
    }
}
    $(document).ready(function () {
        // Handle Edit Button Click
        $('.edit-daily-cost').on('click', function () {
            var id = $(this).data('id');
            var url = "<?php echo e(route('daily-costs.edit', ':id')); ?>";
            url = url.replace(':id', id);

            // Fetch data via AJAX
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    // Populate the form fields in the modal
                    $('#edit_id').val(response.id);
                    $('#edit_name').val(response.name);
                    $('#edit_date').val(response.date);
                    $('#edit_cost_type').val(response.cost_type); // Pre-select the cost type
                    $('#edit_description').val(response.description);
                    $('#edit_amount').val(response.amount);
                    $('#edit_tnx_type').val(response.tnx_type); // Pre-select the transaction type

                    // Update form action URL
                    var updateUrl = "<?php echo e(route('daily-costs.update', ':id')); ?>";
                    updateUrl = updateUrl.replace(':id', response.id);
                    $('#editDailyCostForm').attr('action', updateUrl);

                    // Open the modal
                    $('#editDailyCostModal').modal('show');
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        $.ajax({
            url: "<?php echo e(route('get-cost-types')); ?>", // Route to fetch cost types
            type: 'GET',
            success: function (response) {
                var options = '<option value="">Select Cost Type</option>';
                response.forEach(function (type) {
                    options += '<option value="' + type.name + '">' + type.name + '</option>';
                });
                $('#cost_type').html(options);
                $('#edit_cost_type').html(options);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/backend/cost-management/dailyCost.blade.php ENDPATH**/ ?>