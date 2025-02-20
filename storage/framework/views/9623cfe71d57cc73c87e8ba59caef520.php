
<?php $__env->startSection('content'); ?>
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>File List</h5>
                    </div>
                    <!-- Show Modal -->
                    <div class="modal fade Requisitions" id="FileShow" tabindex="-1" aria-labelledby="AllocationsLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">File Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="Issue-Submit">
                                    <div class="modal-body">
                                        <div class="table-responsive text-nowrap p-3">
                                            <table id="Requisitions_Table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Reviewer By</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0" id="File-Details-Table">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer" id="CreateNoteButton">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade Requisitions" id="EditNote" tabindex="-1" aria-labelledby="AllocationsLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Edit</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="Note-Edit-Submit">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Note: </label>
                                                <textarea class="form-control" name="edit_note_details"
                                                    id="editNoteVale" cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">date: </label>
                                                <input type="date" class="form-control" id="editDateValue"
                                                    name="editDateValue">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success EditNoteBtn">
                                            <i class="bx bx-edit me-1"></i> Edit Note
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Reject Modal -->
                    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectModalLabel">Reject Initiator File</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="rejectForm">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Note: </label>
                                                <textarea class="form-control" name="reject_note_details"
                                                    id="rejectnote" cols="30" rows="3" required></textarea>
                                                <span class="text-danger" id="rejectnoteError"></span>
                                            </div>
                                        </div>
                                        <input type="hidden" id="rejectId" name="id">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger submitRejectBtn">
                                            <i class="bx bx-check me-1"></i> Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade Requisitions" id="FinalNoteShow" tabindex="-1"
                        aria-labelledby="AllocationsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form id="Issue-Submit">
                                    <div class="modal-body">
                                        <div id="notes_container" class="mt-3">
                                            <!-- Notes and reviewers will be appended here -->
                                        </div>
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
                                Pending Files
                            </button>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Unlock File')): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">
                                Archive Files
                            </button>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="allocated_list-tab" data-bs-toggle="tab"
                                data-bs-target="#allocated_list" type="button" role="tab" aria-controls="allocated_list"
                                aria-selected="false">
                                All Files
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable9" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>File Name</th>
                                    <th>Number</th>
                                    <th>Opening Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $init; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($inits->file_name); ?></td>
                                    <td><?php echo e($inits->file_number); ?></td>
                                    <td><?php echo e($inits->opening_date); ?></td>
                                    <td>
                                        <?php if($inits->status == 0): ?>
                                        <span class="badge bg-warning">Waiting for Admin Approve..</span>
                                        <?php elseif($inits->status == 0 && $inits->reviewer != null): ?>
                                        <span class="badge bg-info">Waiting for Assign Reviewer..</span>
                                        <?php elseif($inits->status == 1): ?>
                                        <span class="badge bg-success">Approved</span>
                                        <?php elseif($inits->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- show requisition details -->
                                        <button type="button" class="btn btn-primary showFileBtn"
                                            data-id="<?php echo e($inits->id); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>

                                        <?php if($inits->status == 1 && $inits->initiatorNotes->isEmpty()): ?>
                                        <button type="button" class="btn btn-success createNiteBtn"
                                            data-id="<?php echo e($inits->id); ?>">
                                            <i class="bx bx-save me-1"></i> Create Note
                                        </button>
                                        <?php endif; ?>

                                        <?php if($inits->reviewer == null && $inits->toc_committee_member == null && $inits->tec_committee_member == null): ?>
                                        <a class="btn btn-info" href="<?php echo e(route('initiator-files.show', $inits->id)); ?>">
                                            <i class="bx bx-edit-alt me-1"></i> Assign Reviewer
                                        </a>
                                        <?php endif; ?>

                                        <?php if($inits->reviewer != null && $inits->toc_committee_member == null || $inits->tec_committee_member == null): ?>
                                        <a class="btn btn-info" href="<?php echo e(route('initiator-files.committee', $inits->id)); ?>">
                                            <i class="bx bx-edit-alt me-1"></i> Assign Committee Member
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable5" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>File Name</th>
                                    <th>Number</th>
                                    <th>Opening Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $archive; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($inits->file_name); ?></td>
                                    <td><?php echo e($inits->file_number); ?></td>
                                    <td><?php echo e($inits->opening_date); ?></td>
                                    <td>
                                        <?php if($inits->status == 0): ?>
                                        <span class="badge bg-warning">Waiting for Admin Approve..</span>
                                        <?php elseif($inits->status == 0 && $inits->reviewer != null): ?>
                                        <span class="badge bg-info">Waiting for Assign Reviewer..</span>
                                        <?php elseif($inits->status == 1): ?>
                                        <span class="badge bg-success">Approved</span>
                                        <?php elseif($inits->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- show requisition details -->
                                        <button type="button" class="btn btn-primary showFinalFileBtn"
                                            data-id="<?php echo e($inits->id); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>

                                        <!-- //unlock File button -->
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Unlock File')): ?>
                                        <?php if($inits->is_complete == 1): ?>
                                        <button type="button" class="btn btn-success unlockFileBtn"
                                            data-id="<?php echo e($inits->id); ?>">
                                            <i class="bx bx-lock-open me-1"></i> Unlock File
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
                        <table id="datatable6" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>File Name</th>
                                    <th>Number</th>
                                    <th>Opening Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                <?php $__currentLoopData = $allFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $inits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td><?php echo e($inits->file_name); ?></td>
                                    <td><?php echo e($inits->file_number); ?></td>
                                    <td><?php echo e($inits->opening_date); ?></td>
                                    <td>
                                        <?php if($inits->status == 0): ?>
                                        <span class="badge bg-warning">Waiting for Admin Approve..</span>
                                        <?php elseif($inits->status == 0 && $inits->reviewer != null): ?>
                                        <span class="badge bg-info">Waiting for Assign Reviewer..</span>
                                        <?php elseif($inits->status == 1): ?>
                                        <span class="badge bg-success">Approved</span>
                                        <?php elseif($inits->status == 2): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <!-- show requisition details -->
                                        <button type="button" class="btn btn-primary showFileBtn"
                                            data-id="<?php echo e($inits->id); ?>">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>

                                        <?php if($inits->status == 1 && $inits->initiatorNotes->isEmpty()): ?>
                                        <button type="button" class="btn btn-success createNiteBtn"
                                            data-id="<?php echo e($inits->id); ?>">
                                            <i class="bx bx-save me-1"></i> Create Note
                                        </button>
                                        <?php endif; ?>

                                        <?php if($inits->reviewer == null && $inits->toc_committee_member == null && $inits->tec_committee_member == null): ?>
                                        <a class="btn btn-info" href="<?php echo e(route('initiator-files.show', $inits->id)); ?>">
                                            <i class="bx bx-edit-alt me-1"></i> Assign Reviewer
                                        </a>
                                        <?php endif; ?>

                                        <?php if($inits->reviewer != null && $inits->toc_committee_member == null || $inits->tec_committee_member == null): ?>
                                        <a class="btn btn-info" href="<?php echo e(route('initiator-files.committee', $inits->id)); ?>">
                                            <i class="bx bx-edit-alt me-1"></i> Assign Committee Member
                                        </a>
                                        <?php endif; ?>
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
CKEDITOR.replace('note_details');
CKEDITOR.replace('edit_note_details');
CKEDITOR.replace('reject_note_details');
</script>


<script>
$(document).ready(function() {
    $('#Requisitions_Table').DataTable();

    $(document).on('click', '.showFinalFileBtn', function() {

        var id = $(this).data('id');

        location.href = "<?php echo e(route('note-show.edit', ':id')); ?>".replace(':id', id);

        // var notes = [];
        // $.ajax({
        //     url: "<?php echo e(route('initiator-note-attachments.show', ':id')); ?>".replace(':id', id),
        //     method: 'GET',
        //     success: function(response) {
        //         notes = response.data[0].initiator_notes;

        //         // Clear the existing reviewers container, notes container, and attachments list
        //         $('#notes_container').empty();
        //         $('#attachments_list').empty();

        //         // Append all notes and reviewer information
        //         notes.forEach(function(note, index) {
        //             let noteHtml = `
        //             <div class="note-section mb-2">
        //                 <div class="mt-2 text-center">
        //                     <p>${note.note}</p>
        //                 </div>
        //             </div>
        //             `;

        //             let reviewersHtml = '';
        //             if (note.reviews) {
        //                 note.reviews.forEach(function(review) {
        //                     reviewersHtml += `
        //                     <div class="reviewer-section mb-2 me-2 text-center">
        //                         <div class="reviewer-comment" style="border: 1px solid #000; padding: 3px; margin-bottom: 3px;">
        //                             <p><strong>${review.comment || ''}</strong></p>
        //                         </div>
        //                         <div class="reviewer-signature" style="border: 1px solid #000; padding: 3px; margin-bottom: 3px;">
        //                             <p><img src="/global_assets/user_images/signature/${review.signature}" alt="Signature" width="50"></p>
        //                         </div>
        //                         <div class="reviewer-date" style="border: 1px solid #000; padding: 3px; margin-bottom: 3px;">
        //                             <p><strong>${review.date}</strong></p>
        //                         </div>
        //                     </div>
        //                     `;
        //                 });
        //             }

        //             let combinedHtml = `
        //             <div class="note-reviewer-section mb-2">
        //                 ${noteHtml}
        //                 <div class="d-flex justify-content-center flex-wrap">
        //                     ${reviewersHtml}
        //                 </div>
        //             </div>
        //             `;

        //             $('#notes_container').append(combinedHtml);
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Failed to unlock file:', error);
        //     }
        // });

        // $('#FinalNoteShow').modal('show');


    });

    //redirect to create note page
    $(document).on('click', '.createNiteBtn', function() {
        var id = $(this).data('id');
        var url = '<?php echo e(route("notes.create", ":id")); ?>';
        url = url.replace(':id', id);

        window.location.href = url;
    });

    // Unlock File
    $(document).on('click', '.unlockFileBtn', function() {
        var file_id = $(this).data('id');

        $.ajax({
            url: "<?php echo e(route('initiator-note-reviews.show', ':id')); ?>".replace(':id',
                file_id),
            method: 'GET',
            success: function(response) {
                Toastify({
                    text: 'File unlocked successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();

                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Failed to unlock file:', error);
                Toastify({
                    text: 'Failed to unlock file.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });

    // Custom function to truncate HTML content
    function truncateHtml(str, n) {
        var div = document.createElement('div');
        div.innerHTML = str;
        var textContent = div.textContent || div.innerText || '';
        return textContent.length > n ? textContent.substring(0, n) + '...' : textContent;
    }

    // Show Requisition
    $(document).on('click', '.showFileBtn', function() {
        var file_id = $(this).data('id');

        // AJAX request to fetch allocation details
        $.ajax({
            url: "<?php echo e(route('initiator-notes.show', ':id')); ?>".replace(':id', file_id),
            method: 'GET',
            success: function(response) {
                $('#File-Details-Table').empty();

                const data = response.data;
                console.log('Data received:', data);

                // Handle reviewer names
                if (Array.isArray(data.reviewerNames) && data.reviewerNames.length > 0) {
                    const reviewerNames = data.reviewerNames.join(', ');
                    $('#File-Details-Table').append(`
                    <tr>
                        <td>${reviewerNames}</td>
                    </tr>
                `);
                } else {
                    $('#File-Details-Table').append(`
                    <tr>
                        <td>N/A</td>
                    </tr>
                `);
                }

               // Extract and display TOC committee members
               if(data.initiatorFile.toc_committee_member == null){
                    $('#File-Details-Table').append(
                        '<tr><td>Opening Committee - Information not available</td></tr>');
                }else{
                    const tocCommitteeIds = data.initiatorFile.toc_committee_member.split(',')
                        .map(id => parseInt(id.trim()));
                    console.log('Parsed TOC Committee IDs:', tocCommitteeIds);

                    if (tocCommitteeIds.length > 2) {
                        const middleTOC = tocCommitteeIds.slice(1, -1);
                        console.log('TOC IDs:', middleTOC);
                        const tocMembers = middleTOC.map(id => data.users.find(user => user
                            .id === id));
                        console.log("TOC Members:", tocMembers);

                        if (tocMembers.length > 0) {
                            $('#File-Details-Table').append(
                                '<tr><td><strong>Opening Committee:</strong></td></tr>');
                            $('#File-Details-Table').append(tocMembers.map((member, index) => `
                            <tr>
                                <td>${index === 0 ? 'Secretary' : 'Chairman'}: ${member.name}</td>
                            </tr>
                        `).join(''));
                        } else {
                            $('#File-Details-Table').append(
                                '<tr><td>Opening Committee - Information not available</td></tr>'
                            );
                        }
                    } else {
                        $('#File-Details-Table').append(
                            '<tr><td>Opening Committee - Information not available</td></tr>');
                    }
                }

               // Extract and display TEC committee members
               if(data.initiatorFile.tec_committee_member == null){
                    $('#File-Details-Table').append(
                        '<tr><td>Evaluation Committee - Information not available</td></tr>');
                }else{
                    const tecCommitteeIds = data.initiatorFile.tec_committee_member.split(',')
                        .map(id => parseInt(id.trim()));

                    if (tecCommitteeIds.length > 2) {
                        const middleTEC = tecCommitteeIds.slice(1, -1);
                        const tecMembers = middleTEC.map(id => data.users.find(user => user
                            .id === id));
                        console.log("TEC Members:", tecMembers);

                        if (tecMembers.length > 0) {
                            $('#File-Details-Table').append(
                                '<tr><td><strong>Evaluation Committee:</strong></td></tr>');
                            $('#File-Details-Table').append(tecMembers.map((member, index) => `
                            <tr>
                                <td>${index === 0 ? 'Secretary' : 'Chairman'}: ${member.name}</td>
                            </tr>
                        `).join(''));
                        } else {
                            $('#File-Details-Table').append(
                                '<tr><td>Evaluation Committee - Information not available</td></tr>'
                            );
                        }
                    } else {
                        $('#File-Details-Table').append(
                            '<tr><td>Evaluation Committee - Information not available</td></tr>');
                    }
                }

                // Extract and display Receiving committee members
                if(data.initiatorFile.receiving_committee_member == null){
                    $('#File-Details-Table').append(
                        '<tr><td>Receiving Committee - Information not available</td></tr>');
                }else{
                    const tocCommitteeIds = data.initiatorFile.receiving_committee_member.split(',')
                        .map(id => parseInt(id.trim()));
                    console.log('Parsed TOC Committee IDs:', tocCommitteeIds);

                    if (tocCommitteeIds.length > 2) {
                        const middleTOC = tocCommitteeIds.slice(1, -1);
                        console.log('TOC IDs:', middleTOC);
                        const tocMembers = middleTOC.map(id => data.users.find(user => user
                            .id === id));
                        console.log("TOC Members:", tocMembers);

                        if (tocMembers.length > 0) {
                            $('#File-Details-Table').append(
                                '<tr><td><strong>Receiving Committee:</strong></td></tr>');
                            $('#File-Details-Table').append(tocMembers.map((member, index) => `
                            <tr>
                                <td>${index === 0 ? 'Secretary' : 'Chairman'}: ${member.name}</td>
                            </tr>
                        `).join(''));
                        } else {
                            $('#File-Details-Table').append(
                                '<tr><td>Receiving Committee - Information not available</td></tr>'
                            );
                        }
                    } else {
                        $('#File-Details-Table').append(
                            '<tr><td>Receiving Committee - Information not available</td></tr>');
                    }
                }

                // Handle initiator notes
                $('#Note-Details-Table').empty();
                let allNotesApproved = true;

                data.initiatorNotes.forEach(note => {
                    let statusBadge = '';

                    if (note.status == 1) {
                        statusBadge =
                            '<span class="badge bg-primary">Waiting for VC Approval..</span>';
                    } else if (note.status == 2) {
                        statusBadge =
                            '<span class="badge bg-danger">Rejected</span>';
                    } else if (note.status == 3) {
                        statusBadge =
                            '<span class="badge bg-success">VC Approved</span>';
                    } else if (note.status == 0) {
                        statusBadge =
                            '<span class="badge bg-warning">Waiting for Review..</span>';
                    }

                    const shortNote = truncateHtml(note.note, 7);

                    $('#Note-Details-Table').append(`
                    <tr>
                        <td>${note.date}</td>
                        <td>${note.initiator.name}</td>
                        <td>
                            <span class="short-note">${shortNote}</span>
                            <span class="full-note" style="display:none;">${note.note}</span>
                        </td>
                        <td>${statusBadge}</td>
                        <td>
                            <button type="button" class="btn btn-primary editNoteBtn"
                                data-id="${note.id}" data-date="${note.date}" data-note="${note.note}"
                                data-status="${note.status}">
                                <i class="bx bx-edit me-1"></i>Edit
                            </button>
                        </td>
                    </tr>
                `);

                    // Show VC Review
                    if (note.vc_note != null) {
                        $('#vc_review').empty();
                        $('#vc_review').append(`
                        <br>
                        <div class="col-12">
                            <label for="vc_note" class="form-label">VC Review: </label>
                            <div class="form-control" id="vc_note" name="vc_note" rows="3" readonly></div>
                            <span class="text-danger" id="CategoryError"></span>
                        </div>
                    `);
                        $('#vc_note').html(note.vc_note);
                    }

                    // Show Reviewer Review
                    if (note.reviewer_note != null) {
                        $('#reviewer_review').empty();
                        $('#reviewer_review').append(`
                        <br>
                        <div class="col-12">
                            <label for="reviewer_note" class="form-label">Reviewer Review: </label>
                            <div class="form-control" id="reviewer_note" name="reviewer_note" rows="3" readonly></div>
                            <span class="text-danger" id="CategoryError"></span>
                        </div>
                    `);
                        $('#reviewer_note').html(note.reviewer_note);
                    }

                    if (note.status != 3) {
                        allNotesApproved = false;
                    }
                });

                $('#FileShow').modal('show');

                // Event listener for "See More" buttons
                $(document).on('click', '.see-more', function(event) {
                    event.preventDefault();
                    const shortNote = $(this).siblings('.short-note');
                    const fullNote = $(this).siblings('.full-note');
                    if (fullNote.is(':visible')) {
                        fullNote.hide();
                        shortNote.show();
                        $(this).text('See More');
                    } else {
                        fullNote.show();
                        shortNote.hide();
                        $(this).text('See Less');
                    }
                });

            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch allocation details:', error);
                $('#allocation-details').html(
                    '<p class="text-danger">Failed to load allocation details.</p>');
            }
        });
    });



    // Edit Note
    $(document).on('click', '.editNoteBtn', function() {
        var note_id = $(this).data('id');
        var note = $(this).data('note');
        var date = $(this).data('date');
        var status = $(this).data('status');


        if (status == 3) {
            alert('Note already approved by VC. You can not edit this note.');
            return false;
        } else if (status == 0) {
            alert('Note is under review. You can not edit this note.');
            return false;
        }
        $('#FileShow').modal('hide');

        $('#EditNote').modal('show');

        CKEDITOR.instances['editNoteVale'].setData(note);
        $('#editDateValue').val(date);


        // Submit Note
        $(document).on('submit', '#Note-Edit-Submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?php echo e(route('initiator-note-reviews.store')); ?>",
                type: 'POST',
                data: {
                    id: note_id,
                    note: CKEDITOR.instances['editNoteVale'].getData(),
                    date: $('#editDateValue').val(),
                },
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                success: function(response) {
                    Toastify({
                        text: 'Note updated successfully.',
                        backgroundColor: 'green',
                        className: 'info',
                    }).showToast();

                    // Clear form fields
                    $('#editDateValue').val('');
                    $('#editNoteVale').val('');

                    location.reload();

                    $('#EditNote').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error('Failed to update note:', error);
                    Toastify({
                        text: 'Failed to update note.',
                        backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                        className: 'info',
                    }).showToast();
                }
            });
        });
    });

    // Accept Issue Voucher
    $(document).on('click', '.createNoteBtn', function() {
        var file_id = $(this).data('id');

        // Check if the alert is set on this button
        if ($(this).attr('onclick')) {
            return; // Do nothing if the alert is triggered
        }

        $('#FileShow').modal('hide');

        localStorage.setItem('file_id', file_id);

        // AJAX request to fetch allocation details
        $.ajax({
            url: "<?php echo e(route('initiator-notes.show', ':id')); ?>".replace(':id', file_id),
            method: 'GET',
            success: function(response) {
                const data = response.data;

                $('#Create-Note-Details-Table').empty();
                data.initiatorNotes.forEach(note => {
                    let statusBadge = '';

                    if (note.status == 1) {
                        statusBadge =
                            '<span class="badge bg-primary">Waiting for VC Approval..</span>';
                    } else if (note.status == 2) {
                        statusBadge =
                            '<span class="badge bg-danger">Rejected</span>';
                    } else if (note.status == 3) {
                        statusBadge =
                            '<span class="badge bg-success">VC Approved</span>';
                    } else if (note.status == 0) {
                        statusBadge =
                            '<span class="badge bg-warning">Waiting for Review..</span>';
                    }

                    $('#Create-Note-Details-Table').append(`
                <tr>
                    <td>${note.date}</td>
                    <td>${note.initiator.name}</td>
                    <td>${note.note}</td>
                    <td>${statusBadge}</td>
                </tr>
            `);

                    if (note.vc_note != null) {
                        $('#vc_review').empty();
                        $('#vc_review').append(`
                            <br>
                            <div class="col-12">
                                <label for="vc_note" class="form-label">VC Review: </label>
                                <div class="form-control" id="vc_note"" name="reviewer_note" rows="3" readonly></div>
                                <span class="text-danger" id="CategoryError"></span>
                            </div>
                        `);

                        $('#vc_note').html(note.vc_note);
                    }

                    // Show Reviewer Review
                    if (note.reviewer_note != null) {
                        $('#reviewer_review').empty();
                        $('#reviewer_review').append(`
                            <br>
                            <div class="col-12">
                                <label for="reviewer_note" class="form-label">Reviewer Review: </label>
                                <div class="form-control" id="reviewer_note"" name="reviewer_note" rows="3" readonly></div>
                                <span class="text-danger" id="CategoryError"></span>
                            </div>
                        `);

                        $('#reviewer_note').html(note.reviewer_note);
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch allocation details:', error);
                $('#allocation-details').html(
                    '<p class="text-danger">Failed to load allocation details.</p>'
                );
            }
        });

        $('#NoteCreate').modal('show');

    });

    // Submit Note
    $(document).on('submit', '#Note-Submit', function(e) {
        e.preventDefault();

        const file_id = localStorage.getItem('file_id');
        const note = CKEDITOR.instances['note'].getData();
        const date = $('#date').val();
        const is_close = $('#is_close').val();
        const files = $('#file').prop('files');

        const formData = new FormData();
        formData.append('file_id', file_id);
        formData.append('note', note);
        formData.append('date', date);
        formData.append('is_close', is_close);

        // Loop through all selected files and append them to the formData object
        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }
        $.ajax({
            url: "<?php echo e(route('initiator-notes.store')); ?>",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            contentType: false,
            processData: false,
            success: function(response) {
                Toastify({
                    text: 'Note submitted successfully.',
                    backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                    className: 'info',
                }).showToast();

                // Clear form fields
                CKEDITOR.instances['note'].setData('');
                $('#date').val('');
                $('#is_close').val('');
                $('#file').val('');

                location.reload();

                $('#NoteCreate').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Failed to submit note:', error);
                Toastify({
                    text: 'Failed to submit note.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });

    $('.showAcceptBtn').on('click', function() {
        var initiatorId = $(this).data('id');
        $.ajax({
            url: "<?php echo e(route('initiator-files.accept')); ?>",
            type: "POST",
            data: {
                _token: "<?php echo e(csrf_token()); ?>",
                id: initiatorId
            },
            success: function(response) {
                if (response.status) {
                    alert('Initiator file status updated successfully!');
                    location.reload(); // Reload the page to reflect the change
                } else {
                    alert('Failed to update status: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
                alert('An error occurred while updating the status.');
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.showRejectBtn').on('click', function() {
        var id = $(this).data('id');
        $('#rejectId').val(id);
        $('#rejectModal').modal('show');
    });

    $('#rejectForm').on('submit', function(e) {
        e.preventDefault();

        var formData = {
            id: $('#rejectId').val(),
            note: CKEDITOR.instances['rejectnote'].getData(),
        };

        $.ajax({
            url: "<?php echo e(route('initiator-files.reject')); ?>",
            type: "POST",
            data: formData,
            success: function(response) {
                if (response.status) {
                    alert('Initiator File Rejected');
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission error:', error);
                alert('An error occurred while rejecting the initiator file.');
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/list.blade.php ENDPATH**/ ?>