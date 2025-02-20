
<?php $__env->startSection('content'); ?>
    <div class="row mt-5">
        <div class="col-12 col-md-12 col-lg-12">
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <h5>Allocations</h5>
                        </div>
                        <?php if(Auth::user()->can('Can Access Allocation Create')): ?>
                            <div class="col-12 col-md-6">
                                <div class="float-end">
                                    <!-- Button trigger modal -->
                                    <button type="button" id="create_allocations" class="btn btn-primary"
                                        data-bs-toggle="modal" data-bs-target="#Allocations">
                                        <i class="bx bx-edit-alt me-1"></i> Create Allocations
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Modal -->
                        <div class="modal fade Requisitions" id="AllocationShow" tabindex="-1"
                            aria-labelledby="AllocationsLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="AllocationsLabel">Allocation Product List</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="Issue-Submit">
                                        <div class="modal-body">
                                            <div class="table-responsive text-nowrap p-3">
                                                <table id="datatable" class="table">
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <?php if(Auth::user()->can('Can Access Issue')): ?>
                                                <button type="submit" id="Issue-Submit"
                                                    class="btn btn-primary">Issue</button>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-center">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                    type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Pending Allocation
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                    type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Allocated List
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="allocated_list-tab" data-bs-toggle="tab"
                                    data-bs-target="#allocated_list" type="button" role="tab"
                                    aria-controls="allocated_list" aria-selected="false">
                                    All Allocation
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="table-responsive text-nowrap p-3">
                            <table id="datatable1" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Allocation No</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                    $model_has_role = \App\Models\ModelHasRole::where('role_id', 5)->first();
                                    $user = \App\Models\User::where('id', $model_has_role->model_id)->first();
                                    $designation = \App\Models\Designation::where('id', $user->designation_id)->first();
                                ?>
                                <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                    <?php $__currentLoopData = $pandingAllocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($allocation->user->name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($allocation->allocation_date)->format('d-F-Y')); ?>

                                            </td>
                                            <td><?php echo e($allocation->allocation_no); ?></td>
                                            <td>
                                                <?php if($allocation->is_active == 0): ?>
                                                    <span class="badge bg-success">Approved</span>
                                                <?php elseif($allocation->is_active == 1): ?>
                                                    <span class="badge bg-warning">In Hand <?php echo e($designation->designation); ?></span>
                                                <?php elseif($allocation->is_active == 2): ?>
                                                    <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>

                                                <!-- show requisition details -->
                                                <button type="button" class="btn btn-primary showallocationBtn"
                                                    data-id="<?php echo e($allocation->id); ?>">
                                                    <i class="bx bx-show me-1"></i> Show
                                                </button>
                                                <!-- <button type="button" class="dropdown-item editallocationnBtn"
                                                        data-id="<?php echo e($allocation->id); ?>">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </button>
                                                    <button type="button" class="dropdown-item deleteallocationBtn"
                                                        data-id="<?php echo e($allocation->id); ?>">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button> -->

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="table-responsive text-nowrap p-3">
                            <table id="datatable2" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Allocation No</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                    <?php $__currentLoopData = $IssuedAllocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($allocation->user->name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($allocation->allocation_date)->format('d-F-Y')); ?>

                                            </td>
                                            <td><?php echo e($allocation->allocation_no); ?></td>
                                            <td>
                                                <?php if($allocation->is_active == 0): ?>
                                                    <span class="badge bg-success">Approved</span>
                                                <?php elseif($allocation->is_active == 1): ?>
                                                    <span class="badge bg-warning">In Hand <?php echo e($designation->designation); ?></span>
                                                <?php elseif($allocation->is_active == 2): ?>
                                                    <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>

                                                <!-- show requisition details -->
                                                <button type="button" class="btn btn-primary showallocationBtn"
                                                    data-id="<?php echo e($allocation->id); ?>">
                                                    <i class="bx bx-show me-1"></i> Show
                                                </button>
                                                <!-- <button type="button" class="dropdown-item editallocationnBtn"
                                                        data-id="<?php echo e($allocation->id); ?>">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </button>
                                                    <button type="button" class="dropdown-item deleteallocationBtn"
                                                        data-id="<?php echo e($allocation->id); ?>">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button> -->

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="allocated_list" role="tabpanel" aria-labelledby="allocated_list-tab">
                        <div class="table-responsive text-nowrap p-3">
                            <table id="Requisitions_Table" class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Allocation No</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                    <?php $__currentLoopData = $allocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allocation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($allocation->user->name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($allocation->allocation_date)->format('d-F-Y')); ?>

                                            </td>
                                            <td><?php echo e($allocation->allocation_no); ?></td>
                                            <td>
                                                <?php if($allocation->is_active == 0): ?>
                                                    <span class="badge bg-success">Approved</span>
                                                <?php elseif($allocation->is_active == 1): ?>
                                                    <span class="badge bg-warning">In Hand <?php echo e($designation->designation); ?></span>
                                                <?php elseif($allocation->is_active == 2): ?>
                                                    <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- show requisition details -->
                                                <button type="button" class="btn btn-primary showallocationBtn"
                                                    data-id="<?php echo e($allocation->id); ?>">
                                                    <i class="bx bx-show me-1"></i> Show
                                                </button>
                                                <!-- <button type="button" class="dropdown-item editallocationnBtn"
                                                        data-id="<?php echo e($allocation->id); ?>">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </button>
                                                    <button type="button" class="dropdown-item deleteallocationBtn"
                                                        data-id="<?php echo e($allocation->id); ?>">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button> -->
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Permissions -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#Requisitions_Table').DataTable();
            $('#Allocations_Table').DataTable();

            // Show Requisition
            $('.showallocationBtn').on('click', function() {
                var allocation_id = $(this).data('id');

                localStorage.setItem('allocation_id', allocation_id);
                // AJAX request to fetch allocation details
                $.ajax({
                    url: "<?php echo e(route('allocations.show', ':id')); ?>".replace(':id', allocation_id),
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

                $('#AllocationShow').modal('show');
            });

            // Create Requisition
            $('#create_allocations').on('click', function() {
                location.href = "<?php echo e(route('allocations.add')); ?>";
            });

            // Issue-Submit
            $('#Issue-Submit').on('submit', function(e) {
                e.preventDefault();
                var allocation_id = localStorage.getItem('allocation_id');

                $.ajax({
                    url: "<?php echo e(route('issue-vouchers.store')); ?>",
                    method: 'POST',
                    data: {
                        allocation_id: allocation_id
                    },
                    headers: {
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#AllocationShow').modal('hide');
                            localStorage.removeItem('allocation_id');
                            Toastify({
                                text: "Issue Voucher created successfully.",
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#228B22",
                                stopOnFocus: true,
                            }).showToast();
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to issue allocation:', error);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/allocations.blade.php ENDPATH**/ ?>