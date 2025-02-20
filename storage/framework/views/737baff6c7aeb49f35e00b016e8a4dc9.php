<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Purchase Demand List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap p-3">
                    <table id="datatable2" class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Requisition NO</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $importantPurchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisitionId => $purchases): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($purchases->first()->requisition_no); ?></td>
                                    <?php if($purchases->first()->status == 0): ?>
                                        <td><span class="badge bg-secondary">Waiting for Create Committee</span></td>
                                    <?php else: ?>
                                        <td><span class="badge bg-success">Committee Created</span></td>
                                    <?php endif; ?>
                                    
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#allocationModal"
                                            data-requisition-id="<?php echo e($requisitionId); ?>">Show</button>
                                        <?php if(!in_array($requisitionId, $committeesWithIsdpm)): ?>
                                            <?php if($purchases->first()->is_demand == 0): ?>
                                                <button class="btn btn-info demand-committee-btn"
                                                    data-requisition-id="<?php echo e($requisitionId); ?>">Demand Committee</button>
                                            <?php endif; ?>
                                            <?php if($purchases->first()->is_tech == 0): ?>
                                                <button class="btn btn-warning tech-committee-btn"
                                                    data-requisition-id="<?php echo e($requisitionId); ?>">Tech Committee</button>
                                            <?php endif; ?>
                                            <?php if($purchases->first()->is_oce == 0): ?>
                                                <button class="btn btn-success oce-btn"
                                                    data-requisition-id="<?php echo e($requisitionId); ?>">OCE</button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <button class="btn btn-secondary committees-btn"
                                            data-requisition-id="<?php echo e($requisitionId); ?>">Committees</button>
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for showing details -->
    <div class="modal fade" id="allocationModal" tabindex="-1" aria-labelledby="allocationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="allocationModalLabel">Requisition Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Specification</th>
                                </tr>
                            </thead>
                            <tbody id="modalContent">
                                <!-- Dynamic content will be appended here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for showing committee details -->
    <div class="modal fade" id="committeeModal" tabindex="-1" aria-labelledby="committeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="committeeModalLabel">Committee Details</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Committee Name</th>
                                    <th>Committee Type</th>
                                    <th>Secretary</th>
                                    <th>Chairman</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="committeeModalContent">
                                <!-- Dynamic content will be appended here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('allocationModal');
            modal.addEventListener('show.bs.modal', function(event) {
                document.getElementById('modalContent').innerHTML = '';

                var button = event.relatedTarget;
                var requisitionId = button.getAttribute('data-requisition-id');

                var relatedRecords = <?php echo json_encode($importantPurchases, 15, 512) ?>;
                var records = relatedRecords[requisitionId];

                var modalContent = document.getElementById('modalContent');
                records.forEach(function(record) {
                    var newRow = `
                    <tr>
                        <td>${record.name}</td>
                        <td>${record.product_name}</td>
                        <td>${record.quantity}</td>
                        <td>${record.spec}</td>
                    </tr>
                `;
                    modalContent.insertAdjacentHTML('beforeend', newRow);
                });
            });

            // Function to handle the SweetAlert confirmation and redirection
            function handleCommitteeButton(buttonClass, title, routeName, fallbackRoute = null) {
                var buttons = document.querySelectorAll(buttonClass);
                buttons.forEach(function(button) {
                    button.addEventListener('click', function() {
                        var requisitionId = button.getAttribute('data-requisition-id');

                        Swal.fire({
                            title: `Do you want to create ${title}?`,
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = routeName.replace(':id',
                                    requisitionId);
                            } else if (fallbackRoute) {
                                window.location.href = fallbackRoute.replace(':id',
                                    requisitionId);
                            }
                        });
                    });
                });
            }

            // Event handler for committee buttons
            var committeeBtns = document.querySelectorAll('.committees-btn');
            committeeBtns.forEach(function(button) {
                button.addEventListener('click', function() {
                    var requisitionId = button.getAttribute('data-requisition-id');
                    var committeesData = <?php echo json_encode($committees, 15, 512) ?>;

                    // Filter the committees based on the requisition ID
                    var relatedCommittees = committeesData.filter(function(committee) {
                        return committee.requisition_id == requisitionId;
                    });

                    var modalContent = document.getElementById('committeeModalContent');
                    modalContent.innerHTML = ''; // Clear previous content

                    // Check if there's any Demand committee with status 1, 21, or 11
                    let hasDemandWithStatus = relatedCommittees.some(function(committee) {
                        return committee.committee_type === 'Demand' &&
                            (committee.status == 1 || committee
                                .status == 11 || committee
                                .status == 4);
                    });

                    relatedCommittees.forEach(function(committee) {
                        var showSendButton = true;

                        if (hasDemandWithStatus && (committee.committee_type === 'Tech' ||
                                committee.committee_type === 'OCE')) {
                            showSendButton = false;
                        }

                        var newRow = `
                            <tr>
                                <td>${committee.name}</td>
                                <td>${committee.committee_type}</td>
                                <td>${committee.secretary_user ? committee.secretary_user.name : 'N/A'}</td>
                                <td>${committee.chairman_user ? committee.chairman_user.name : 'N/A'}</td>
                                <td>
                                    ${
                                        showSendButton
                                            ? (committee.status == "21"
                                                ? `<button class="btn btn-primary send-committee-btn" data-committee-type="${committee.committee_type}" data-committee-id="${committee.id}">Send</button>`
                                                : ``)
                                            : ''
                                    }
                                </td>
                            </tr>
                        `;
                        modalContent.insertAdjacentHTML('beforeend', newRow);
                    });

                    var committeeModal = new bootstrap.Modal(document.getElementById(
                        'committeeModal'));
                    committeeModal.show();

                    var sendButtons = document.querySelectorAll('.send-committee-btn');
                    sendButtons.forEach(function(sendButton) {
                        sendButton.addEventListener('click', function() {
                            var committeeId = sendButton.getAttribute(
                                'data-committee-id');

                            committeeModal.hide();
                            setTimeout(() => {
                                Swal.fire({
                                    title: 'Do you want to send this committee?',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "<?php echo e(route('send.committee', ['id' => ':id'])); ?>"
                                            .replace(':id',
                                                committeeId);
                                    } else {
                                        committeeModal.show();
                                    }
                                });
                            }, 300);
                        });
                    });
                });
            });

            // Demand Committee Button
            handleCommitteeButton('.demand-committee-btn', 'Demand Committee',
                "<?php echo e(route('requisitions.committee')); ?>" + "?requisition_id=:id");

            // Tech Committee Button
            handleCommitteeButton('.tech-committee-btn', 'Tech Committee',
                "<?php echo e(route('requisitions.tech.committee')); ?>" + "?requisition_id=:id");

            // OCE Committee Button (includes isDPM fallback route)
            handleCommitteeButton('.oce-btn', 'OCE', "<?php echo e(route('dpm.oce', ['id' => ':id'])); ?>",
                "<?php echo e(route('isDpm', ['id' => ':id'])); ?>");
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/createComittee.blade.php ENDPATH**/ ?>