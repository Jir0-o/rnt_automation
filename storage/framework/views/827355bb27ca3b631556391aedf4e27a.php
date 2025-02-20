<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<h4 class="py-2 m-4"><span class="text-muted fw-light">Create Committee</span></h4>

<div class="row mt-5">

    <?php
    $defaultCommittees = \App\Models\DefaultCommittee::whereIn('type', ['TOC Committee', 'TEC Committee', 'Receiving Committee'])
    ->with(['chairmanUser','secretaryUser'])
    ->get();

    ?>

    <!-- Modal for selecting a default committee -->
    <div class="modal fade" id="defaultCommitteeModal" tabindex="-1" aria-labelledby="defaultCommitteeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultCommitteeModalLabel">Select Default Demand Committee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="defaultCommitteeForm">
                        <div class="mb-3">
                            <label for="default-committee" class="form-label">Default Committee</label>
                            <select id="default-committee" name="default_committee_id" class="form-control">
                                <option value="" disabled selected>Select a Default Committee</option>

                                <?php $__currentLoopData = $defaultCommittees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committeee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($committeee->id); ?>" data-secretary="<?php echo e($committeee->secretary); ?>"
                                    data-chairman="<?php echo e($committeee->chairman); ?>" data-name="<?php echo e($committeee->name); ?>" data-type="<?php echo e($committeee->type); ?>">
                                    <?php echo e($committeee->name); ?> -
                                    Secretary: <?php echo e($committeee->secretaryUser ? $committeee->secretaryUser->name : 'N/A'); ?> -
                                    Chairman: <?php echo e($committeee->chairmanUser ? $committeee->chairmanUser->name : 'N/A'); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="justify-content-end">
                            <button type="submit" class="btn btn-primary">Use this Committee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        
        <div class="card">
            <div class="card-header">
                <h5>Create Committee</h5>
            </div>
            <div class="card-body">
                <form id="Assign-Committee">
                    <div class="mb-3">
                        <label for="committee_id">Committee Name</label>
                        <select id="committee_id" name="committee_id" class="form-control" required>
                            <option value="">Select Committee</option>
                            <option value="TOC Committee">Opening Committee</option>
                            <option value="TEC Committee">Evaluation Committee</option>
                            <option value="Receiving Committee">Receiving Committee</option>
                        </select>
                    </div>
                    <!-- Hidden div for additional options -->
                    <div id="additionalOptions">
                        <div class="mb-3">

                            <label for="user1">Select Secretary</label>
                            <select id="user1" name="user1" class="form-control">
                                <option value="">Select User</option>
                                <?php $__currentLoopData = $committee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user2">Select Chairman</label>
                            <select id="user2" name="user2" class="form-control">
                                <option value="">Select User</option>
                                <?php $__currentLoopData = $committee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="#" id="backButton" class="btn btn-secondary"
                            data-check-route="<?php echo e(route('committee.check', ':id')); ?>"
                            data-create-route="<?php echo e(route('initiator-notes.create')); ?>">Back</a>
                        <!-- Button to open modal for selecting a default committee -->
                        <button type="button" class="btn btn-secondary mt-3 float-end me-2" data-bs-toggle="modal"
                            data-bs-target="#defaultCommitteeModal">
                            Select Default Committee
                        </button>
                        <button type="submit" class="btn btn-primary">Create Committee</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery first -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

    // defaultCommitteeForm submission
    $('#defaultCommitteeForm').on('submit', function(e) {
        e.preventDefault();

        var selectedOption = $('#default-committee option:selected');
        var committeeId = selectedOption.val();
        var secretaryId = selectedOption.data('secretary');
        var chairmanId = selectedOption.data('chairman');
        var type = selectedOption.data('type');

        console.log('Selected option:', selectedOption);
        console.log('Committee ID:', committeeId);
        console.log('Secretary ID:', secretaryId);
        console.log('Chairman ID:', chairmanId);
        console.log('Type:', type);

        // set the selected values in the Assign-Committee form
        $('#committee_id').val(type);
        $('#user1').val(secretaryId);
        $('#user2').val(chairmanId);

        // Hide the modal
        $('#defaultCommitteeModal').modal('hide');
    });


    // Extract the ID from the URL
    var pathArray = window.location.pathname.split('/');
    var intId = pathArray[pathArray.length - 1];

    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#backButton').on('click', function(event) {

        var createRoute = $(this).data('create-route');

        window.location.href = createRoute;

        // $.ajax({
        //     url: checkRoute,
        //     type: "GET",
        //     success: function(response) {
        //         if (response.status === true) {
        //             window.location.href = createRoute;
        //         } else {
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Oops...',
        //                 text: 'Please Create TOC And TEC Committee First.',
        //                 timer: 3000
        //             });
        //         }
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Failed to check committee:', error);
        //     }
        // });
    });

    // Handle form submission
    $('#Assign-Committee').on('submit', function(e) {
        e.preventDefault();

        // Construct formData with the ID included
        var formData = {
            'int_id': intId,
            'committee_id': $('#committee_id').val(),
            'user1': $('#user1').val(),
            'user2': $('#user2').val(),
        };

        $.ajax({
            url: "<?php echo e(route('committee.store')); ?>",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function(response) {
                console.log('Response received:', response);
                if (response.status == true) {
                    Toastify({
                        text: response.message,
                        backgroundColor: 'green',
                        className: "info",
                    }).showToast();
                    location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                        timer: 3000
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Committee Already exist',
                    timer: 3000
                });
            }
        });

    });

    // Show additional options based on selected committee
    // $('#committee_id').on('change', function() {
    //     var committee = $(this).val();
    //     if (committee !== '') {
    //         $('#additionalOptions').slideDown(); // Show the additional options
    //     } else {
    //         $('#additionalOptions').slideUp(); // Hide the additional options
    //     }
    // });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/optionalCommittee.blade.php ENDPATH**/ ?>