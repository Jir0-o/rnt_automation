<?php $__env->startSection('content'); ?>
    <style>
        .cke_notification_message {
            display: none !important;
        }

        .cke_notifications_area {
            display: none !important;
        }
    </style>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Tech Committee Page</h3>
            </div>
            <div class="card-body">
                <div id="tableView">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable2" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Committee Type</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $demandLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $techCommittee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $isSecretary = $techCommittee->secretary == auth()->user()->id;
                                        $isChairman = $techCommittee->chairman_id == auth()->user()->id;
                                        $statusBadgeClass = 'bg-secondary';

                                        if ($techCommittee->status == 1 && $isSecretary) {
                                            $statusBadgeClass = 'bg-success';
                                        } elseif ($techCommittee->status == 11 && $isChairman) {
                                            $statusBadgeClass = 'bg-success';
                                        } elseif ($techCommittee->status == 12 && $isSecretary) {
                                            $statusBadgeClass = 'bg-success';
                                        } elseif ($techCommittee->status == 13 && $isChairman) {
                                            $statusBadgeClass = 'bg-success';
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td><?php echo e($techCommittee->name); ?></td>
                                        <td>Tech</td>
                                        <td><?php echo e($isSecretary ? 'Secretary' : 'Chairman'); ?></td>
                                        <td>
                                            <span class="badge <?php echo e($statusBadgeClass); ?>">
                                                <?php if($techCommittee->status == 1): ?>
                                                    Waiting for Tech Secretary...
                                                <?php elseif($techCommittee->status == 11): ?>
                                                    Waiting for Tech Chairman...
                                                <?php elseif($techCommittee->status == 12): ?>
                                                    Processed by Secretary...
                                                <?php elseif($techCommittee->status == 13): ?>
                                                    Processed by Chairman...
                                                <?php else: ?>
                                                    Closed
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if(($techCommittee->status == 25 || $techCommittee->status == 1) && $isSecretary): ?>
                                                <button type="button" class="btn btn-success processBtn"
                                                    data-id="<?php echo e($techCommittee->id); ?>"
                                                    data-requisition-id="<?php echo e($techCommittee->requisition_id); ?>"
                                                    data-status="2">
                                                    <i class="bx bx-check me-1"></i> Process
                                                </button>
                                                <button type="button" class="btn btn-success sendBtn"
                                                    data-id="<?php echo e($techCommittee->id); ?>"
                                                    data-requisition-id="<?php echo e($techCommittee->requisition_id); ?>"
                                                    data-status="2">
                                                    <i class="bx bx-send me-1"></i> Send
                                                </button>
                                            <?php elseif($techCommittee->status == 13 && $isChairman): ?>
                                                <button type="button" class="btn btn-success processBtn"
                                                    data-id="<?php echo e($techCommittee->id); ?>"
                                                    data-requisition-id="<?php echo e($techCommittee->requisition_id); ?>"
                                                    data-status="2">
                                                    <i class="bx bx-check me-1"></i> Process
                                                </button>
                                                <button type="button" class="btn btn-success sendBtn"
                                                    data-id="<?php echo e($techCommittee->id); ?>"
                                                    data-requisition-id="<?php echo e($techCommittee->requisition_id); ?>"
                                                    data-status="2">
                                                    <i class="bx bx-send me-1"></i> Send
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-primary showBtn"
                                                data-id="<?php echo e($techCommittee->id); ?>"
                                                data-requisition-id="<?php echo e($techCommittee->requisition_id); ?>" data-status="0">
                                                <i class="bx bx-show me-1"></i> Show
                                            </button>
                                            <a href="<?php echo e(route('committee.report', ['id' => $techCommittee->id, 'requisition_id' => $techCommittee->requisition_id])); ?>"
                                                class="btn btn-primary">
                                                Report
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="formView" style="display: none;">
                    <h4 class="mb-4">Tech Committee Details</h4>
                    <div id="referenceNoDisplay"></div>
                    <form id="quantityForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="requisition_id" id="requisitionId">
                        <input type="hidden" name="tech_committee_id" id="techCommitteeId">
                        <div class="mb-3">
                            <label for="referenceNo" class="form-label">Reference No</label>
                            <input type="text" class="form-control" id="referenceNo" name="reference_no" required>
                        </div>
                        <div id="editableFields"></div>
                        <div class="mt-4">
                            <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            $('.processBtn, .showBtn').on('click', function() {
                var techCommitteeId = $(this).data('id');
                var requisitionId = $(this).data('requisition-id');
                var isEditable = $(this).hasClass('processBtn');
                $('#requisitionId').val(requisitionId);
                $('#techCommitteeId').val(techCommitteeId);

                $.ajax({
                    url: isEditable ?
                        "<?php echo e(route('tech.details', ':id')); ?>".replace(':id', requisitionId) :
                        "<?php echo e(route('demand.tech.show', ':id')); ?>".replace(':id', requisitionId),
                    type: 'GET',
                    success: function(response) {
                        var editableFields = '';
                        var reference = response.length > 0 && response[0].reference ? response[
                            0].reference : "";

                        if (isEditable) {
                            $('#referenceNo').val(reference);
                            $('#referenceNoDisplay').hide();
                            $('#referenceNo').show();
                        } else {
                            $('#referenceNoDisplay').html(`
                                <p><strong>Reference No:</strong> ${reference}</p>`).show();
                            $('#referenceNo').hide();
                        }

                        response.forEach(function(product, index) {
                            editableFields += `
                                <div class="mb-4 border p-3 rounded">
                                    <h5>Product Name: ${product.product_name}</h5>
                                    <input type="hidden" name="products[${index}][product_id]" value="${product.product_id}">
                                    <input type="hidden" name="products[${index}][product_committee_id]" value="${product.id}">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Specification: </label>
                                            <textarea class="form-control ckeditor" name="products[${index}][spec]" ${isEditable ? '' : 'readonly'} placeholder="Specification">${product.spec || ''}</textarea>
                                        </div>
                                    </div>
                                </div>`;
                        });

                        $('#editableFields').html(editableFields);
                        $('#saveChangesBtn, button[name="send"]').toggle(isEditable);

                        $('#tableView').hide();
                        $('#formView').show();

                        // Initialize CKEditor for each specification textarea
                        $('.ckeditor').each(function() {
                            CKEDITOR.replace(this, {
                                readOnly: !isEditable
                            });
                        });
                    }
                });
            });

            $('#quantityForm').on('submit', function(e) {
                e.preventDefault();

                // Update CKEditor instances before form submission
                for (var instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }

                var formData = $(this).serialize();
                var url = "<?php echo e(route('update.quantity.tech')); ?>";

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        $('#techAllocationModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.sendBtn').on('click', function() {
                var demandId = $(this).data('id');
                var requisitionId = $(this).data('requisition-id');
                console.log(demandId)
                console.log('Send button clicked');
                Swal.fire({
                    title: 'Do You Want to Send?',
                    text: "This action will Send Data",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, send it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "<?php echo e(route('send.tech')); ?>",
                            type: 'PUT',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                requisition_id: requisitionId,
                                demand_committee_id: demandId,
                            },
                            success: function(response) {
                                Swal.fire('Success!', 'Your data has been sent.',
                                        'success')
                                    .then(() => {
                                        location.reload();
                                    });
                            },
                            error: function(xhr) {
                                Swal.fire('Error!',
                                    'There was an error processing your request.',
                                    'error');
                            }
                        });
                    }
                });
            });

            $('#cancelBtn').on('click', function() {
                $('#tableView').show();
                $('#formView').hide();
            });
        });

        function submitForm(url, formData) {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Success!', response.message, 'success');
                        location.reload(); // Reload to reflect changes
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire('Error!', 'An error occurred.', 'error');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/techCommittee.blade.php ENDPATH**/ ?>