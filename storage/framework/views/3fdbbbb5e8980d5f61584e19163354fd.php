
<?php $__env->startSection('content'); ?>

<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>File Note List</h5>
                    </div>
                    <!-- Show Modal -->
                    <div class="modal fade Requisitions" id="NoteShow" tabindex="-1" aria-labelledby="AllocationsLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Note Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="Issue-Submit">
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong>Send by:</strong> <span id="initiator_name"></span>
                                            </div>
                                            <div>
                                                <strong>Date:</strong> <span id="note_date"></span>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <p id="note_content"></p>
                                        </div>
                                        <div id="attachments_section" class="d-flex justify-content-between">
                                            <div>
                                                <strong>Attachments:</strong>
                                                <ul id="attachments_list"></ul>
                                            </div>
                                            <div>
                                                <strong>Existing Review:</strong> 
                                                <div id="note_review">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" id="CreateNoteButton">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade Requisitions" id="FinalNoteShow" tabindex="-1" aria-labelledby="AllocationsLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <form id="Issue-Submit">
                                    <div class="modal-body">
                                    <div id="notes_container" class="mt-3">
                                        <!-- Notes and reviewers will be appended here -->
                                    </div>
                                    </div>
                                    <div class="modal-footer" id="CreateFinalNoteButton">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ Show Modal -->
                    <div class="modal fade Requisitions" id="ReviewShow" tabindex="-1"
                        aria-labelledby="AllocationsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="review-Submit">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Comment: </label>
                                                <textarea class="form-control" id="comment" name="comment"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Date: </label>
                                                <input type="date" class="form-control" id="ReviewDate" name="ReviewDate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" id="rewiew_submit_button">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/ Show Modal -->
                    <div class="modal fade Requisitions" id="VcRejectNote" tabindex="-1"
                        aria-labelledby="AllocationsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Give a Reason</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="review-Submit">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Note: </label>
                                                <textarea class="form-control" id="vc_note" name="vc_note"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" id="vc_note_submit_button">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade Requisitions" id="ReviewerRejectNote" tabindex="-1"
                        aria-labelledby="AllocationsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Give a Reason</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="review-Submit">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="note" class="form-label">Note: </label>
                                                <textarea class="form-control" id="reviewer_note" name="reviewer_note"
                                                    rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" id="reviewer_note_submit_button">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable3" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>File Name</th>
                            <th>File Number</th>
                            <th>Initiator</th>
                            <th>Status</th>
                            <th>Reviewed by Current User</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $visibleNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index + 1); ?></td>
                            <td><?php echo e($note->opening_date); ?></td>
                            <td><?php echo e($note->file_name); ?></td>
                            <td><?php echo e($note->file_number); ?></td>
                            <td><?php echo e($note->users ? $note->users->name : 'N/A'); ?></td>
                            
                            <td>
                                <?php if($note->status == 1): ?>
                                <span class="badge bg-primary">Waiting for Review..</span>
                                <?php elseif($note->status == 2): ?>
                                <span class="badge bg-danger">Rejected</span>
                                <?php elseif($note->status == 3): ?>
                                <span class="badge bg-success">VC Approved</span>
                                <?php else: ?>
                                <span class="badge bg-warning">Waiting for Review..</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $reviewStatus = json_decode($note->review_status, true) ?: [];
                                    $currentUserReviewed = false;

                                    // Loop through the reviewStatus array and check if the current user has approved
                                    foreach ($reviewStatus as $review) {
                                        if ($review['user_id'] == auth()->user()->id && $review['status'] == 'approved') {
                                            $currentUserReviewed = true;
                                            break;
                                        }
                                    }
                                ?>

                                <?php if($currentUserReviewed): ?>
                                    <span class="badge bg-success">Reviewed</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Not Reviewed</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                
                                        <!-- Show requisition details -->
                                        <a href="<?php echo e(route('show.review',['id'=>$note->id])); ?>">
                                        <button type="button" class="btn btn-primary showBtn" >
                                            <i class="bx bx-show me-1"></i> Give Review
                                        </button>
                                        </a>
                                       
                                  
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

    // VC Rejected
    $(document).on('click', '.VcRejectedBtn', function() {
        var id = $(this).data('id');

        $('#NoteShow').modal('hide');
        $('#VcRejectNote').modal('show');

        $('#vc_note_submit_button').empty();
        $('#vc_note_submit_button').append(`

            <button type="button" class="btn btn-danger VcRejectSubmitBtn" data-id="${id}">
                <i class="bx bx-x me-1"></i> Reject
            </button>
        `);
    });

    // VC Rejected Submit
    $(document).on('click', '.VcRejectSubmitBtn', function() {
        var id = $(this).data('id');
        var vc_note = $('#vc_note').val();

        $.ajax({
            url: "<?php echo e(route('initiator-note-attachments.store')); ?>",
            type: 'POST',
            data: {
                id: id,
                vcRejectFlag: true,
                vc_note: vc_note
            },
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            success: function(response) {
                Toastify({
                    text: 'Note rejected successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();

                // Clear form fields
                $('#vc_note').val('');

                location.reload();

                $('#VcRejectNote').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Failed to reject note:', error);
                Toastify({
                    text: 'Failed to reject note.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });

    // Show Requisition
    $(document).on('click', '.reviewBtn', function() {
        var id = $(this).data('id');

        $('#NoteShow').modal('hide');
        $('#FinalNoteShow').modal('hide');
        $('#ReviewShow').modal('show');

        $('#rewiew_submit_button').empty();
        $('#rewiew_submit_button').append(`
            <button type="button" class="btn btn-success reviewSubmitBtn" data-id="${id}">
                <i class="bx bx-check me-1"></i> Review
            </button>
        `);
    });

    // Submit Review
    $(document).on('click', '.reviewSubmitBtn', function() {
        var id = $(this).data('id');
        var comment = $('#comment').val();


        $.ajax({
            url: "<?php echo e(route('initiator-note-attachments.store')); ?>",
            type: 'POST',
            data: {
                id: id,
                comment: comment,
                date: $('#ReviewDate').val()
            },
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            success: function(response) {
                Toastify({
                    text: 'Review submitted successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();

                // Clear form fields
                $('#comment').val('');

                location.reload();

                $('#ReviewShow').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Failed to submit review:', error);
                Toastify({
                    text: 'Failed to submit review.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });

    // Accept Issue Voucher
    $(document).on('click', '.showBtn', function() {
        
        // var note = $(this).data('note');
        // var date = $(this).data('date');
        // var initiator = $(this).data('initiator');
        var id = $(this).data('id');

        location.href = "<?php echo e(route('note-show.show', ':id')); ?>".replace(':id', id);

        // var reviewStatus = $(this).data('review-status');
        // var currentUserId = '<?php echo e(auth()->user()->id); ?>';

        // var attachments = $(this).data('attachment');

        // var reviews = $(this).data('review');

        // var closingNote = $(this).data('closing_note');

        // if(closingNote == 0){

        //     $('#initiator_name').empty();
        //     $('#note_date').empty();
        //     $('#note_content').empty();
        //     $('#attachments_list').empty();
        //     $('#note_review').empty();


        //     $('#initiator_name').text(initiator);
        //     $('#note_date').text(date);
        //     $('#note_content').text(note);

        //     // Clear the existing attachment list
        //     $('#attachments_list').empty();

        //     // Check if there are attachments
        //     if (attachments && attachments.length > 0) {
        //         attachments.forEach(function(attachment) {
        //             var attachmentUrl = `/global_assets/initiator_notes/${attachment.files}`; // Adjust the path as necessary
        //             $('#attachments_list').append(`
        //                 <li>
        //                     <a href="${attachmentUrl}" download>${attachment.files}</a>
        //                 </li>
        //             `);
        //         });
        //     } else {
        //         $('#attachments_list').append('<li>No attachments available</li>');
        //     }

        //     $('#CreateNoteButton').empty();

        //     if (!reviewStatus[currentUserId] || reviewStatus[currentUserId] !== 'approved') {
        //         $('#CreateNoteButton').append(`
        //             <button type="button" class="btn btn-success reviewBtn" data-id="${id}">
        //                 <i class="bx bx-check me-1"></i> Review
        //             </button>
        //             <button type="button" class="btn btn-danger rejectBtn" data-id="${id}">
        //                 <i class="bx bx-x me-1"></i> Rejected
        //             </button>
        //         `);
        //     }

        //     // Display existing reviews
        //     var reviewContainer = document.getElementById('note_review');

        //     reviews.forEach(function(review) {
        //         var comment = review.comment ? review.comment : "No comment provided";
        //         var reviewerName = comment === "No comment provided" ? `${review.reviewer.name} (Initiator)` : review.reviewer.name ;
                
        //         var reviewHtml = `
        //             <div class="review-section">
        //                 <div class="review-comment">${comment}</div>
        //                 <div class="reviewer-name">${reviewerName}</div>
        //             </div>
        //         `;
        //         reviewContainer.innerHTML += reviewHtml;
        //     });
        //     $('#NoteShow').modal('show');
        // } else {
        //     $('#NoteShow').modal('hide');

        //     var notes = [];
        //     $.ajax({
        //         url: "<?php echo e(route('initiator-note-attachments.show', ':id')); ?>".replace(':id', id),
        //         method: 'GET',
        //         success: function(response) {
        //             notes = response.data[0].initiator_notes;

        //             // Clear the existing reviewers container, notes container, and attachments list
        //             $('#notes_container').empty();
        //             $('#attachments_list').empty();

        //             // Append all notes and reviewer information
        //             notes.forEach(function(note, index) {
        //                 let noteHtml = `
        //                 <div class="note-section mb-2">
        //                     <div class="mt-2 text-center">
        //                         <p>${note.note}</p>
        //                     </div>
        //                 </div>
        //                 `;

        //                 let reviewersHtml = '';
        //                 if (note.reviews) {
        //                     note.reviews.forEach(function(review) {
        //                         reviewersHtml += `
        //                         <div class="reviewer-section mb-2 me-2 text-center">
        //                             <div class="reviewer-comment" style="border: 1px solid #000; padding: 3px; margin-bottom: 3px;">
        //                                 <p><strong>${review.comment || ''}</strong></p>
        //                             </div>
        //                             <div class="reviewer-signature" style="border: 1px solid #000; padding: 3px; margin-bottom: 3px;">
        //                                 <p><img src="/global_assets/user_images/signature/${review.signature}" alt="Signature" width="50"></p>
        //                             </div>
        //                             <div class="reviewer-date" style="border: 1px solid #000; padding: 3px; margin-bottom: 3px;">
        //                                 <p><strong>${review.date}</strong></p>
        //                             </div>
        //                         </div>
        //                         `;
        //                     });
        //                 }

        //                 let combinedHtml = `
        //                 <div class="note-reviewer-section mb-2">
        //                     ${noteHtml}
        //                     <div class="d-flex justify-content-center flex-wrap">
        //                         ${reviewersHtml}
        //                     </div>
        //                 </div>
        //                 `;

        //                 $('#notes_container').append(combinedHtml);
        //             });

        //             $('#CreateFinalNoteButton').empty();

        //             if (!reviewStatus[currentUserId] || reviewStatus[currentUserId] !== 'approved') {
        //                 $('#CreateFinalNoteButton').append(`
        //                     <button type="button" class="btn btn-success reviewBtn" data-id="${id}">
        //                         <i class="bx bx-check me-1"></i> Review
        //                     </button>
        //                     <button type="button" class="btn btn-danger rejectBtn" data-id="${id}">
        //                         <i class="bx bx-x me-1"></i> Rejected
        //                     </button>
        //                 `);
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Failed to unlock file:', error);
        //         }
        //     });


        //     $('#FinalNoteShow').modal('show');


        // }
    });

    // Reject Issue Voucher
    $(document).on('click', '.rejectBtn', function() {
        var id = $(this).data('id');

        $('#NoteShow').modal('hide');
        $('#FinalNoteShow').modal('hide');
        $('#ReviewerRejectNote').modal('show');

        $('#reviewer_note_submit_button').empty();
        $('#reviewer_note_submit_button').append(`

            <button type="button" class="btn btn-danger ReviewerRejectSubmitBtn" data-id="${id}">
                <i class="bx bx-x me-1"></i> Reject
            </button>
        `);
    });

    $(document).on('click', '.ReviewerRejectSubmitBtn', function() {
        var id = $(this).data('id');
        var reviewer_note = $('#reviewer_note').val();

        $.ajax({
            url: "<?php echo e(route('initiator-note-attachments.store')); ?>",
            type: 'POST',
            data: {
                id: id,
                rejectFlag: true,
                reviewer_note: reviewer_note
            },
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            success: function(response) {
                Toastify({
                    text: 'Note rejected successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();

                // Clear form fields
                $('#reviewer_note').val('');

                location.reload();

                $('#ReviewerRejectNote').modal('hide');
            },
            error: function(xhr, status, error) {
                console.error('Failed to reject note:', error);
                Toastify({
                    text: 'Failed to reject note.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/notes.blade.php ENDPATH**/ ?>