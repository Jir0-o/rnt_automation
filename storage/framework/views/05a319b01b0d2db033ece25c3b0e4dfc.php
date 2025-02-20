<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <center>
                    <h3>Create Demand Committee</h3>
                </center>
            </div>
            <div class="card-body">
                <!-- Form for creating a demand committee -->
                <form id="CreateDemandCommitteeForm" action="<?php echo e(route('committees.storeDemand')); ?>" method="POST"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="requisition_id" value="<?php echo e($requisition_id); ?>">
                    <input type="hidden" name="default_committee_id" id="hidden-default-committee-id">
                    <div class="mb-3">
                        <label for="demand-name" class="form-label">Name
                            <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="demand-name" name="demand_name"
                            placeholder="Enter Demand Committee Name">
                        <span class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="demand-secretary" class="form-label">Select Secretary
                            <span class="text-danger">*</span></label>
                        <select id="demand-secretary" name="demand_secretary" class="form-control">
                            <option value="" disabled selected>Select Secretary</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="demand-chairman" class="form-label">Select Chairman
                            <span class="text-danger">*</span></label>
                        <select id="demand-chairman" name="demand_chairman" class="form-control">
                            <option value="" disabled selected>Select Chairman</option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>
                    <div class="mt-3 float-end">
                        <button type="submit" class="btn btn-primary">Create Demand Committee</button>
                    </div>
                </form>

                <!-- Button to open modal for selecting a default committee -->
                <button type="button" class="btn btn-secondary mt-3 float-end me-2" data-bs-toggle="modal"
                    data-bs-target="#defaultCommitteeModal">
                    Select Default Committee
                </button>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left mx-1"></i> Back
                </a>

                <!-- Modal for selecting a default committee -->
                <div class="modal fade" id="defaultCommitteeModal" tabindex="-1"
                    aria-labelledby="defaultCommitteeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="defaultCommitteeModalLabel">Select Default Demand Committee</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="defaultCommitteeForm">
                                    <div class="mb-3">
                                        <label for="default-committee" class="form-label">Default Committee</label>
                                        <select id="default-committee" name="default_committee_id" class="form-control">
                                            <option value="" disabled selected>Select a Default Committee</option>
                                            <?php $__currentLoopData = $defaultCommittees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($committee->id); ?>"
                                                    data-secretary="<?php echo e($committee->secretary_id); ?>"
                                                    data-chairman="<?php echo e($committee->chairman_id); ?>"
                                                    data-name="<?php echo e($committee->name); ?>">
                                                    <?php echo e($committee->name); ?> - Secretary:
                                                    <?php echo e($committee->secretaryUser->name); ?> - Chairman:
                                                    <?php echo e($committee->chairmanUser->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="custom-name" class="form-label">Custom Committee Name</label>
                                        <input type="text" class="form-control" id="custom-name" name="custom_name">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Use this Committee</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const defaultCommitteeForm = document.getElementById('defaultCommitteeForm');
                const defaultCommitteeSelect = document.getElementById('default-committee');
                const customNameInput = document.getElementById('custom-name');
                const mainForm = document.getElementById('CreateDemandCommitteeForm');
                const hiddenDefaultCommitteeId = document.getElementById('hidden-default-committee-id');

                defaultCommitteeSelect.addEventListener('change', function() {
                    const selectedOption = this.options[this.selectedIndex];
                    customNameInput.value = selectedOption.getAttribute('data-name');
                });

                defaultCommitteeForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const selectedOption = defaultCommitteeSelect.options[defaultCommitteeSelect.selectedIndex];

                    // Update main form inputs based on the selected option in the modal
                    document.getElementById('demand-name').value = customNameInput.value || selectedOption.getAttribute('data-name');
                    document.getElementById('demand-secretary').value = selectedOption.getAttribute('data-secretary');
                    document.getElementById('demand-chairman').value = selectedOption.getAttribute('data-chairman');
                    hiddenDefaultCommitteeId.value = selectedOption.value;

                    // Close the modal
                    $('#defaultCommitteeModal').modal('hide');

                    // Submit the main form to the specified route
                    mainForm.submit();
                });
            });
        </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/createDemandCommittee.blade.php ENDPATH**/ ?>