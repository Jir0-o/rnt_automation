
<?php $__env->startSection('content'); ?>

<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Issue Vouchers</h5>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade Requisitions" id="IssueShow" tabindex="-1" aria-labelledby="AllocationsLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Issue Product List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="Issue-Submit">
                                    <div class="modal-body">
                                        <div class="table-responsive text-nowrap p-3">
                                            <table id="Requisitions_Table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Product Name</th>
                                                        <th>Unite Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0" id="Allocations-Product-Table">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer" id="ApprovedOrRejectButton">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable1" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Issue No</th>
                            <th>Issue Date</th>
                            <th>Allocation No</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Requisitions-Table">
                        <?php $__currentLoopData = $issueVouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issueVoucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($issueVoucher->user->name); ?></td>
                            <td><?php echo e($issueVoucher->issue_no); ?></td>
                            <td><?php echo e(\Carbon\Carbon::parse($issueVoucher->issue_date)->format('d-F-Y')); ?></td>
                            <td><?php echo e($issueVoucher->allocation->allocation_no); ?></td>
                            <td>
                                <?php if($issueVoucher->status == 0): ?>
                                <span class="badge bg-warning">In Hand Assistant Director</span>
                                <?php elseif($issueVoucher->status == 1): ?>
                                <span class="badge bg-success">Gatepass Approved</span>
                                <?php elseif($issueVoucher->status == 2): ?>
                                <span class="badge bg-danger">Gatepass Rejected</span>
                                <?php endif; ?>
                            <td>
                                        <!-- show requisition details -->
                                        <button type="button" class="btn btn-primary showissueVoucherBtn"
                                            data-id="<?php echo e($issueVoucher->id); ?>" data-status="<?php echo e($issueVoucher->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <?php if(Auth::user()->can('Can Access Approves Gatepass and Reject Gatepass')): ?>
                                            <!-- accpect requisition -->
                                            <?php if($issueVoucher->status == 0): ?>
                                            <button type="button" class="btn btn-success acceptissueVoucherBtn"
                                                data-id="<?php echo e($issueVoucher->id); ?>">
                                                <i class="bx bx-check me-1"></i> Gatepass Approved
                                            </button>
                                            <button type="button" class="btn btn-danger rejectissueVoucherBtn"
                                                data-id="<?php echo e($issueVoucher->id); ?>">
                                                <i class="bx bx-x me-1"></i>Gatepass Rejected
                                            </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($issueVoucher->status == 1): ?>
                                            <button type="button" class="btn btn-info printtab"
                                                data-id="<?php echo e($issueVoucher->id); ?>">
                                                <i class="bx bx-printer me-1"></i> print
                                            </button>

                                        <?php endif; ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Permissions -->
    </div>
</div>


<script>
$(document).ready(function() {
    $('#Requisitions_Table').DataTable();

    // Show Requisition
    $(document).on('click', '.showissueVoucherBtn', function() {
        var issueVoucher_id = $(this).data('id');
        var status= $(this).data('status');
        // AJAX request to fetch allocation details
        $.ajax({
            url: "<?php echo e(route('issue-vouchers.show', ':id')); ?>".replace(':id', issueVoucher_id),
            method: 'GET',
            success: function(response) {
                $('#Allocations-Product-Table').empty();
                response.data.forEach(function(product, index) {
                    $('#Allocations-Product-Table').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${product.product.product_name}</td>
                                <td>${product.unit_price}</td>
                                <td>${product.quantity}</td>
                                <td>${product.total_price}</td>
                            </tr>
                        `);
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch allocation details:', error);
                $('#allocation-details').html(
                    '<p class="text-danger">Failed to load allocation details.</p>');
            }
        });



        // Show approve or reject button
        $('#ApprovedOrRejectButton').empty();
        if(status==0){
        $('#ApprovedOrRejectButton').append(`
                <button type="button" class="btn btn-success acceptissueVoucherBtn" data-id="${issueVoucher_id}">
                    <i class="bx bx-check me-1"></i> Gatepass Approved
                </button>
                <button type="button" class="btn btn-danger rejectissueVoucherBtn" data-id="${issueVoucher_id}">
                    <i class="bx bx-x me-1"></i> Gatepass Rejected
                </button>
            `);
        }


        $('#IssueShow').modal('show');
    });




    // Accept Issue Voucher
    $(document).on('click', '.acceptissueVoucherBtn', function() {
        var issueVoucher_id = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('issue-vouchers.approve', ':id')); ?>".replace(':id', issueVoucher_id),
            method: 'GET',
            success: function(response) {
                if (response.status == true) {
                    Toastify({
                        text: "Issue Voucher Accepted Successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    setTimeout(() => {
                        openPrintTab(issueVoucher_id);
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error('Failed to accept issue voucher');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to accept issue voucher:', error);
                toastr.error('Failed to accept issue voucher');
            }
        });
    });
    $(document).on('click', '.printtab', function() {
        var issueVoucher_id = $(this).data('id');
        openPrintTab(issueVoucher_id);
    });

    function openPrintTab(issueVoucherId) {
        var url = "<?php echo e(route('print.pass.approve', ':id')); ?>".replace(':id', issueVoucherId);
        window.open(url, '_blank'); // Opens the URL in a new tab
    }

    // Reject Issue Voucher
    $(document).on('click', '.rejectissueVoucherBtn', function() {
        var issueVoucher_id = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('issue-vouchers.reject', ':id')); ?>".replace(':id', issueVoucher_id),
            method: 'GET',
            success: function(response) {
                if (response.status == true) {
                    Toastify({
                        text: "Issue Voucher Rejected Successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error('Failed to reject issue voucher');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to reject issue voucher:', error);
                toastr.error('Failed to reject issue voucher');
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\Procurement_final\resources\views/backend/issue_vouchers/issue_vouchers.blade.php ENDPATH**/ ?>