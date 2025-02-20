<?php $__env->startSection('content'); ?>

<script>
    .cke_notification_message {
    display: none !important;
}

.cke_notifications_area {
    display: none !important;
}
</script>


<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Requisitions</h5>
                    </div>
                    <?php if(Auth::user()->can('Can Access Requisitions Create')): ?>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button type="button" id="create_requisitions" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#Requisitions">
                                <i class="bx bx-edit-alt me-1"></i> Create Requisitions
                            </button>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Modal -->
                    <div class="modal fade Requisitions" id="RequisitionShow" tabindex="-1"
                        aria-labelledby="RequisitionsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RequisitionsLabel">Requisition Product List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive text-nowrap p-3">
                                        <table id="Requisitions_Table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product Name</th>
                                                    <th>Requisition Quantity</th>
                                                    <th>Allocated Quantity</th>
                                                    <th>Specification</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0" id="Requisitions-Product-Table">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <p>Notes: </p>
                                        <textarea name="notes" id="notes" cols="4" rows="2" class="form-control"
                                            disabled></textarea>
                                    </div>
                                    <br>
                                    <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
                                    <div class="modal-footer" id="acceptOrRejectButton">

                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade Requisitions" id="AuthRequisitionShow" tabindex="-1"
                        aria-labelledby="RequisitionsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RequisitionsLabel">Requisition Product List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive text-nowrap p-3">
                                        <table id="datatable7" class="table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Specification</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0" id="AuthRequisitions-Product-Table">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <p>Notes: </p>
                                        <textarea name="notes" id="Authnotes" cols="4" rows="2" class="form-control"
                                            disabled></textarea>
                                    </div>
                                    <br>
                                    <div class="modal-footer" id="AuthAcceptOrRejectButton">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nav tabs -->
            <div class="container">
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">
                                Pending Authorizes
                            </button>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Requisition All Tabs')): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">
                                Pending Allocates
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="allocated_list-tab" data-bs-toggle="tab"
                                data-bs-target="#allocated_list" type="button" role="tab" aria-controls="allocated_list"
                                aria-selected="false">
                                Allocated Lists
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
                                type="button" role="tab" aria-controls="messages" aria-selected="false">
                                Issued
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="skill-tab" data-bs-toggle="tab" data-bs-target="#skill"
                                type="button" role="tab" aria-controls="skill" aria-selected="false">
                                Ready To pick
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected"
                                type="button" role="tab" aria-controls="rejected" aria-selected="false">
                                Rejected
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="save-draft" data-bs-toggle="tab" data-bs-target="#save"
                                type="button" role="tab" aria-controls="save" aria-selected="false">
                                Draft
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="return-req-tab" data-bs-toggle="tab" data-bs-target="#return"
                                type="button" role="tab" aria-controls="return" aria-selected="false">
                                Return Requisition
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                                type="button" role="tab" aria-controls="all" aria-selected="false">
                                All Requisition
                            </button>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
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
                            <textarea id="returnReason" name="return-text" class="form-control" rows="5" placeholder="Enter reason for returning"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitReturn">Send</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable1" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <?php
                            $user_id = auth()->user()->id;
                            $user = \App\Models\User::where('id', $user_id)->first();
                            
                                $department = \App\Models\Department::where('id', $user->department_id)->first();
                                $department_head = \App\Models\User::where('id', $department->head_id)->first();
                                $designation = \App\Models\Designation::where('id', $department_head->designation_id)->first();
                           
                            ?>
                            
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $authRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">In Hand <?php echo e($designation->designation); ?> </span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">In Hand Assistant Director </span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class=" showAuthrequisitionBtn btn btn-primary"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>

                                        </a>
                                        <?php if(Auth::id() == $requisition->user->auth_by): ?>
                                        <?php if($requisition->status == 0): ?>
                                        <button type="button" class="acceptAuthrequisitionBtn btn btn-success"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-check me-1"></i> Accept
                                        </button>
                                        <?php endif; ?>
                                        <?php if($requisition->status == 0): ?>
                                        <button type="button" class=" rejectrequisitionBtn btn btn-danger"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-x me-1"></i> Reject
                                        </button>
                                        <?php endif; ?>
                                        <?php if($requisition->status == 0): ?>
                                        <button type="button" class=" returnrequisitionBtn btn btn-warning"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-undo me-1"></i> Return
                                        </button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
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
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $allocationRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">In Hand <?php echo e($designation->designation); ?></span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">In Hand Assistant Director</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <button type="button" class=" showAuthrequisitionBtn btn btn-primary"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>

                                        </a>
                                        <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
                                        <?php if($requisition->status == 1): ?>
                                        <button type="button" class="btn btn-success acceptrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" style="margin-right:5px;">Accept
                                        </button>

                                        <button type="button" class="btn btn-danger rejectrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>">Reject
                                        </button>
                                        <button type="button" class=" returnrequisitionBtn btn btn-warning"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-undo me-1"></i> Return
                                        </button>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if(Auth::id() == $requisition->user->auth_by): ?>
                                        <?php if($requisition->status == 0): ?>
                                        <button type="button" class="acceptAuthrequisitionBtn btn btn-success"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-check me-1"></i> Accept
                                        </button>
                                        <?php endif; ?>
                                        <?php if($requisition->status == 0): ?>
                                        <button type="button" class=" rejectrequisitionBtn btn btn-danger"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-x me-1"></i> Reject
                                        </button>
                                        <?php endif; ?>
                                        <?php if($requisition->status == 0): ?>
                                        <button type="button" class=" returnrequisitionBtn btn btn-danger"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-x me-1"></i> Return
                                        </button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="allocated_list" role="tabpanel" aria-labelledby="allocated_list-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable3" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $AllocatedRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">Waiting For Authorize</span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">Waiting For Allocate</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                        <?php if(Auth::user()->can('Can Access Requisitions Accept and Reject')): ?>
                                        <?php if($requisition->status == 1): ?>
                                        <button type="button" class="btn btn-success acceptrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-check me-1"></i> Accept
                                        </button>
                                        <?php endif; ?>
                                        <?php if($requisition->status == 1): ?>
                                        <button type="button" class="btn btn-danger rejectrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>">
                                            <i class="bx bx-x me-1"></i> Reject
                                        </button>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable4" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $isuedRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">Waiting For Authorize</span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">Waiting For Allocate</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="skill" role="tabpanel" aria-labelledby="skill-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable5" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $redayToPickRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">Waiting For Authorize</span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">Waiting For Allocate</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable6" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $rejectedRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">Waiting For Authorize</span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">Waiting For Allocate</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="save" role="tabpanel" aria-labelledby="save-draft">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable9" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $saveRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">Waiting For Authorize</span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">Waiting For Allocate</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <button type="button" class=" showAuthrequisitionBtn btn btn-primary"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-success sendRequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" style="margin-right:2px;">
                                            <i class="bx bx-send me-1"></i> Send
                                        </button>
                                        <button type="button" class="btn btn-warning editReturnRequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" style="margin-right:5px;">
                                            <i class="bx bx-edit me-1"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger deleteReturnRequisitionBtn" data-id="<?php echo e($requisition->id); ?>" style="margin-right: 5px;">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="return" role="tabpanel" aria-labelledby="return-req-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="Allocations_Table" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $returnRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">Waiting For Authorize</span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">Waiting For Allocate</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php elseif($requisition->status == 13): ?>
                                        <span class="badge bg-warning">Saved Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <button type="button" class=" editrequisitionBtn btn btn-primary"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                        <?php if($requisition->status == 12 || $requisition->status == 13): ?>
                                        <button type="button" class="btn btn-warning editReturnRequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" style="margin-right:5px;">
                                            <i class="bx bx-edit me-1"></i> Edit
                                        </button>
                                        <?php endif; ?>
                                        <?php if($requisition->status == 13): ?>
                                        <button type="button" class="btn btn-success sendRequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" style="margin-right:5px;">
                                            <i class="bx bx-send me-1"></i> Send
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable8" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $requisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($requisition->user->name); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?>

                                    </td>
                                    <td><?php echo e($requisition->requisition_no); ?></td>
                                    <td>
                                        <?php if($requisition->status == 0): ?>
                                        <span class="badge bg-warning">In Hand <?php echo e($designation->designation); ?></span>
                                        <?php elseif($requisition->status == 1): ?>
                                        <span class="badge bg-primary">In Hand Assistant Director</span>
                                        <?php elseif($requisition->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php elseif($requisition->status == 3): ?>
                                        <span class="badge bg-success">Allocated</span>
                                        <?php elseif($requisition->status == 4): ?>
                                        <span class="badge bg-info">Issued</span>
                                        <?php elseif($requisition->status == 5): ?>
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        <?php elseif($requisition->status == 11): ?>
                                        <span class="badge bg-secondary">Save Draft</span>
                                        <?php elseif($requisition->status == 12): ?>
                                        <span class="badge bg-danger">Return Requisition</span>
                                        <?php elseif($requisition->status == 13): ?>
                                        <span class="badge bg-warning">Saved Return Requisition</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="<?php echo e($requisition->id); ?>" data-status="<?php echo e($requisition->status); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="<?php echo e(route('requisitions.print', $requisition->id)); ?>" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>

                                        </a>
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
var authUserId = '<?php echo e(Auth::id()); ?>';
CKEDITOR.replace('return-text');
</script>


<script>
$(document).ready(function() {
    // Reject requisition button click handler
    $(document).on('click', '.rejectrequisitionBtn', function() {
        console.log('reject');
        var requisition_id = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('requisitions.reject', ':id')); ?>".replace(':id', requisition_id),
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
    $(document).ready(function() {
    var requisition_id;

    // When the "Return" button is clicked
    $('.returnrequisitionBtn').click(function() {
        requisition_id = $(this).data('id'); // Get the requisition ID
        $('#returnModal').modal('show'); // Show the modal
    });

    $('#submitReturn').click(function() {
        const reason = CKEDITOR.instances['returnReason'].getData(); 

        if (reason.trim() === '') {
            toastr.error('Please provide a reason for returning.');
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
                    location.reload(); // Reload the page after a short delay
                }, 2000); // 2-second delay before reload
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error);
                toastr.error('Failed to return requisition. Please try again.'); // Show error message
            }
        });
    });
});



    // Accept requisition button click handler
    $(document).on('click', '.acceptrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        localStorage.setItem('requisition_id', requisition_id);

        location.href = "<?php echo e(route('allocations.add')); ?>";
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
                    url: "<?php echo e(route('requisitions.sent', ':id')); ?>".replace(':id',
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
                console.log('Requisition sending canceled');
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
    
    $('#Requisitions_Table').DataTable();

    $('#create_requisitions').on('click', function() {
        location.href = "<?php echo e(route('requisitions.add')); ?>";
    });

    // Show requisition button click handler
    $(document).on('click', '.showrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "<?php echo e(route('requisitions.show', ':id')); ?>".replace(':id', requisition_id);
    });

        // Show edit requisition button click handler
        $(document).on('click', '.editrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "<?php echo e(route('requisitionedit.show', ':id')); ?>".replace(':id', requisition_id);
    });

    //     // Reject requisition button click handler
    //     $(document).on('click', '.sendDeleteRequisitionBtn', function() {
    //     console.log('reject');
    //     var requisition_id = $(this).data('id');
    //     $.ajax({
    //         url: "<?php echo e(route('senddelete.requisition', ':id')); ?>".replace(':id', requisition_id),
    //         type: 'GET',
    //         success: function(response) {
    //             if (response.status) {
    //                 Toastify({
    //                     text: "Save Draft Deleted Successfully",
    //                     duration: 3000,
    //                     gravity: "top",
    //                     position: 'right',
    //                     backgroundColor: "#228B22",
    //                     stopOnFocus: true,
    //                 }).showToast();
    //                 setTimeout(() => {
    //                     location.reload();
    //                 }, 1000);
    //             } else {
    //                 console.log(response.message);
    //             }
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     });
    // });

  // edit return requisition button click handler
  $(document).on('click', '.editReturnRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "<?php echo e(route('requisition.return', ':id')); ?>".replace(':id', requisition_id);
    });


    // Show auth requisition button click handler
    $(document).on('click', '.showAuthrequisitionBtn', function() {
        var requisition_id = $(this).data('id');
        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }

        location.href = "<?php echo e(route('requisitions.show', ':id')); ?>".replace(':id', requisition_id);

    });

    // Reject requisition button click handler
    $(document).on('click', '.rejectrequisitionBtn', function() {
        console.log('reject');
        var requisition_id = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('requisitions.reject', ':id')); ?>".replace(':id', requisition_id),
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
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
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

        localStorage.setItem('requisition_id', requisition_id);

        location.href = "<?php echo e(route('allocations.add')); ?>";
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
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\Procurement_final\resources\views/backend/requisitions/requisitions.blade.php ENDPATH**/ ?>