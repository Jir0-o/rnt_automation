
<?php $__env->startSection('content'); ?>

<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f8ff;
}

.page {
    width: 1152px;
    height: 1824px;
    margin: 0 auto;
    box-shadow: none;
    border: none;
    background-color: #59A4B7;
    /* position: relative;
    Added */
}


.content {
    margin-bottom: 20px;
    line-height: 1.6;
}

.content p {
    margin: 5px 0;
}

.signature {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: end;
}

.signature div {
    width: 50%;
    text-align: center;
}

.bottom-buttons {
    display: flex;
    justify-content: space-evenly;
    /* position: absolute; */
    bottom: 10px;
    left: 0.8in;
    right: 0.8in;
}

.bottom-buttons button {
    margin: 5px;
}

#noteArea {
    margin-top: 31px;
    margin-left: 57px;
    margin-bottom: 77px;
    margin-right: 10px;
    height: auto;
    /* Allow the height to adjust based on content */
    max-height: calc(19in - 1.5in);
    /* Adjust this based on your needs */
    color: black;
    text-align: left;
    /* overflow: auto; */
    overflow: hidden;
    /* Ensure content doesn't spill out visually */
    page-break-after: always;
    /* Ensure pages break correctly when printing */
    position: relative;
    /* Added */
}

#noteArea::before {
    content: ' ';
    position: absolute;
    width: 100%;
    height: 3px;
    background-color: black;
    top: 90px;
    left: 0;
}

#noteArea::after {
    content: ' ';
    position: absolute;
    width: 3px;
    height: 100%;
    background-color: black;
    top: 0;
    left: 108px;
}



.signature {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: end;
}

.signature div {
    width: 50%;
    text-align: center;
}

.page-number {
    position: absolute;
    top: 10px;
    width: 100%;
    text-align: center;
    font-weight: bold;
}

.cke_notification_message {
    display: none !important;
}

.cke_notifications_area {
    display: none !important;
}

.pagination-buttons {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-buttons button {
    margin: 0 10px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.pagination-buttons button:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}

.fileNumber {
    margin-top: 84px;
    position: relative;
    top: 10px;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: -61px;
    margin-left: 117px;
}
</style>

<!-- Show Modal -->
<div class="modal fade Requisitions" id="SentShow" tabindex="-1" aria-labelledby="AllocationsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AllocationsLabel">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="selectedUser" id="user<?php echo e($user->id); ?>"
                            value="<?php echo e($user->id); ?>">
                        <label class="form-check-label" for="user<?php echo e($user->id); ?>">
                            <strong>Name:</strong> <?php echo e($user->name); ?> <br>
                            <strong>Designation:</strong> <?php echo e($user->designation->designation); ?> <br>
                            <strong>Department:</strong> <?php echo e($user->department->name); ?>

                        </label>
                    </div>
                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendToButton">Send To</button>
            </div>
        </div>
    </div>
</div>

<!-- Show Modal -->
<div class="modal fade Requisitions" id="SentCommitteeShow" tabindex="-1" aria-labelledby="AllocationsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AllocationsLabel">Committee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="committeeForm">
                    <?php $__currentLoopData = $fileCommitte; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $committee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="selectedCommittee" id="committee<?php echo e($committee->id); ?>" value="<?php echo e($committee->id); ?>">
                            <label class="form-check-label" for="committee<?php echo e($committee->id); ?>">
                                <strong>Committee Name:</strong> <?php echo e($committee->committee_name); ?> <br>
                                <strong>Secretary Name:</strong> <?php echo e($committee->secretaryFileCommittees->name); ?> <br>
                                <strong>Chairman Name:</strong> <?php echo e($committee->chairmanFileCommittees->name); ?>

                            </label>
                        </div>
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sendToCommitteeButton">Send To Committee</button>
            </div>
        </div>
    </div>
</div>

<div class="card page">
    <p class="page-number text-center text-dark"></p>
    <p class="text-dark fileNumber"><?php echo e($file->file_number); ?></p>
    <div id="pageContainer">

        <div id="noteArea" style="position: relative;">

            <?php
                // Function to convert number to Bengali digits
                if (!function_exists('convertToBengaliNumberForSentToUser')) {
                    function convertToBengaliNumberForSentToUser($number) {
                        $bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                        $numberStr = strval($number);
                        $bengaliNumber = '';

                        for ($i = 0; $i < strlen($numberStr); $i++) {
                            $digit = intval($numberStr[$i]);
                            $bengaliNumber .= $bengaliDigits[$digit]; // Append corresponding Bengali digit
                        }

                        return $bengaliNumber;
                    }
                }

                $counter = 1; // Counter for the note index
            ?>

            <?php $__currentLoopData = $file->initiatorNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php if($note->note != null): ?>
                <div class="d-flex">
                    <?php echo e(convertToBengaliNumberForSentToUser($counter)); ?>)&nbsp <div><?php echo $note->note; ?></div> <br>
                </div>
                <?php
                $counter++; // Increment counter only for displayed notes
                ?>
                <?php endif; ?>

                <?php $__currentLoopData = $note->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d-flex justify-content-between">
                    <a href="/global_assets/initiator_notes/<?php echo e($attachment->files); ?>" target="_blank"
                        class="text-dark ml-3">
                        &#x2022; <?php echo e($attachment->files); ?></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($note->is_toc == 0 && $note->is_tec == 0 && $note->is_receiving == 0): ?>
                <div class="signature">

                    <?php
                    // Decode the reviewers list
                    $reviewers = array_map('trim', explode(',', $file->reviewer));
                    $reviewerCount = count($reviewers);
                    $sectionWidth = 100 / $reviewerCount; // Calculate width for each reviewer section

                    // Create an array to hold the ordered reviews based on reviewer ID
                    $orderedReviews = [];

                    foreach ($note->reviews as $review) {
                        // Collect all reviews, even if they are by the same reviewer
                        $position = array_search($review->reviewer_id, $reviewers);
                        if (!isset($orderedReviews[$position])) {
                            $orderedReviews[$position] = []; // Create an array for each reviewer position
                        }
                        $orderedReviews[$position][] = $review; // Group reviews by position
                    }

                    ksort($orderedReviews); // Sort reviews based on their position in the reviewers list
                    ?>

                    <?php $__currentLoopData = $orderedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position => $reviews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            // Calculate the position for 'is_forword == 0' based on 'signature_order' field from the database
                            $leftPosition = (($review->signature_order - 1) * $sectionWidth); // Calculate the left position for the signature based on signature_order

                            // Calculate the position for 'is_forword == 1' based on reviewers list order
                            $order = array_search($review->reviewer_id, $reviewers) + 1;
                            $defaultLeftPosition = ($order - 1.01) * $sectionWidth; // Calculate the left position for the signature (default for is_forward == 1)
                            ?>

                            <?php if($note->is_forword == 1): ?>
                            <!-- For forwarded notes, display signatures normally -->
                            <div class="text-center">
                                <div class="reviewer-signature">
                                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>"
                                            alt="Signature" width="50"></p>
                                </div>
                                <div class="reviewer-date">
                                    <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                    <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                    <?php if($review->designation != null && $review->department != null): ?>
                                    <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?>

                                    <br>
                                    <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- For non-forwarded notes, position signatures absolutely based on signature_order -->
                            <div class="text-center"
                                style="position: relative; left: <?php echo e($leftPosition); ?>%; width: <?php echo e($sectionWidth); ?>%; overflow: hidden;">
                                <div class="reviewer-signature">
                                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>"
                                            alt="Signature" width="50"></p>
                                </div>
                                <div class="reviewer-date">
                                    <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                    <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                    <?php if($review->designation != null && $review->department != null): ?>
                                    <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?>

                                    <br>
                                    <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <?php if($note->is_toc == 1 && $note->is_tec == 0 && $note->is_receiving == 0): ?>
                <div class="signature">

                    <?php
                    // Decode the reviewers list
                    $reviewers = array_map('trim', explode(',', $file->toc_committee_member));
                    $reviewerCount = count($reviewers);
                    $sectionWidth = 100 / $reviewerCount; // Calculate width for each reviewer section

                    // Create an array to hold the ordered reviews based on reviewer ID
                    $orderedReviews = [];

                    foreach ($note->reviews as $review) {
                        // Collect all reviews, even if they are by the same reviewer
                        $position = array_search($review->reviewer_id, $reviewers);
                        if (!isset($orderedReviews[$position])) {
                            $orderedReviews[$position] = []; // Create an array for each reviewer position
                        }
                        $orderedReviews[$position][] = $review; // Group reviews by position
                    }

                    ksort($orderedReviews); // Sort reviews based on their position in the reviewers list
                    ?>

                    <?php $__currentLoopData = $orderedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position => $reviews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            // Calculate the position for 'is_forword == 0' based on 'signature_order' field from the database
                            $leftPosition = (($review->signature_order - 1) * $sectionWidth); // Calculate the left position for the signature based on signature_order

                            // Calculate the position for 'is_forword == 1' based on reviewers list order
                            $order = array_search($review->reviewer_id, $reviewers) + 1;
                            $defaultLeftPosition = ($order - 1.01) * $sectionWidth; // Calculate the left position for the signature (default for is_forward == 1)
                            ?>

                            <?php if($note->is_forword == 1): ?>
                            <!-- For forwarded notes, display signatures normally -->
                            <div class="text-center">
                                <div class="reviewer-signature">
                                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>"
                                            alt="Signature" width="50"></p>
                                </div>
                                <div class="reviewer-date">
                                    <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                    <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                    <?php if($review->designation != null && $review->department != null): ?>
                                    <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?>

                                    <br>
                                    <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- For non-forwarded notes, position signatures absolutely based on signature_order -->
                            <div class="text-center"
                                style="position: relative; left: <?php echo e($leftPosition); ?>%; width: <?php echo e($sectionWidth); ?>%; overflow: hidden;">
                                <div class="reviewer-signature">
                                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>"
                                            alt="Signature" width="50"></p>
                                </div>
                                <div class="reviewer-date">
                                    <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                    <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                    <?php if($review->designation != null && $review->department != null): ?>
                                    <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?>

                                    <br>
                                    <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <?php if($note->is_tec == 1 && $note->is_toc == 0 && $note->is_receiving == 0): ?>
                <div class="signature">

                    <?php
                    // Decode the reviewers list
                    $reviewers = array_map('trim', explode(',', $file->tec_committee_member));
                    $reviewerCount = count($reviewers);
                    $sectionWidth = 100 / $reviewerCount; // Calculate width for each reviewer section

                    // Create an array to hold the ordered reviews based on reviewer ID
                    $orderedReviews = [];

                    foreach ($note->reviews as $review) {
                        // Collect all reviews, even if they are by the same reviewer
                        $position = array_search($review->reviewer_id, $reviewers);
                        if (!isset($orderedReviews[$position])) {
                            $orderedReviews[$position] = []; // Create an array for each reviewer position
                        }
                        $orderedReviews[$position][] = $review; // Group reviews by position
                    }

                    ksort($orderedReviews); // Sort reviews based on their position in the reviewers list
                    ?>

                    <?php $__currentLoopData = $orderedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position => $reviews): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            // Calculate the position for 'is_forword == 0' based on 'signature_order' field from the database
                            $leftPosition = (($review->signature_order - 1) * $sectionWidth); // Calculate the left position for the signature based on signature_order

                            // Calculate the position for 'is_forword == 1' based on reviewers list order
                            $order = array_search($review->reviewer_id, $reviewers) + 1;
                            $defaultLeftPosition = ($order - 1.01) * $sectionWidth; // Calculate the left position for the signature (default for is_forward == 1)
                            ?>

                            <?php if($note->is_forword == 1): ?>
                            <!-- For forwarded notes, display signatures normally -->
                            <div class="text-center">
                                <div class="reviewer-signature">
                                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>"
                                            alt="Signature" width="50"></p>
                                </div>
                                <div class="reviewer-date">
                                    <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                    <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                    <?php if($review->designation != null && $review->department != null): ?>
                                    <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?>

                                    <br>
                                    <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <!-- For non-forwarded notes, position signatures absolutely based on signature_order -->
                            <div class="text-center"
                                style="position: relative; left: <?php echo e($leftPosition); ?>%; width: <?php echo e($sectionWidth); ?>%; overflow: hidden;">
                                <div class="reviewer-signature">
                                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>"
                                            alt="Signature" width="50"></p>
                                </div>
                                <div class="reviewer-date">
                                    <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                    <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                    <?php if($review->designation != null && $review->department != null): ?>
                                    <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?>

                                    <br>
                                    <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <?php if($note->is_tec == 0 && $note->is_toc == 0 && $note->is_receiving == 1): ?>
                <div class="signature">

                    <?php
                    // Decode the reviewers list
                    $reviewers = array_map('trim', explode(',', $file->receiving_committee_member));
                    $reviewerCount = count($reviewers);
                    $sectionWidth = 100 / $reviewerCount; // Calculate width for each reviewer section

                    // Sort the reviews based on the date or signature_order to handle multiple signatures from the same reviewer
                    $sortedReviews = $note->reviews->sortBy('signature_order'); // Sort reviews by signature_order or date

                    ?>

                    <?php $__currentLoopData = $sortedReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        // Calculate the position based on the reviewer's position in the reviewers list
                        $order = array_search($review->reviewer_id, $reviewers) + 1;
                        $leftPosition = (($review->signature_order - 1) * $sectionWidth); // Calculate the left position for the signature based on signature_order

                        ?>

                        <?php if($note->is_forword == 1): ?>
                        <!-- For forwarded notes, display signatures normally -->
                        <div class="text-center">
                            <div class="reviewer-signature">
                                <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>" alt="Signature" width="50"></p>
                            </div>
                            <div class="reviewer-date">
                                <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                <?php if($review->designation != null && $review->department != null): ?>
                                <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?> <br>
                                <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <?php else: ?>
                        <!-- For non-forwarded notes, position signatures absolutely based on signature_order -->
                        <div class="text-center" style="position: relative; left: <?php echo e($leftPosition); ?>%; width: <?php echo e($sectionWidth); ?>%; overflow: hidden;">
                            <div class="reviewer-signature">
                                <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature ?? ''); ?>" alt="Signature" width="50"></p>
                            </div>
                            <div class="reviewer-date">
                                <?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y') ?? ''); ?><br>
                                <strong><?php echo e($review->reviewer->name); ?></strong> <br>
                                <?php if($review->designation != null && $review->department != null): ?>
                                <?php echo e(\App\Models\Designation::where('id', $review->designation)->pluck('designation')->first() ?? 'No Designation'); ?> <br>
                                <?php echo e(\App\Models\Department::where('id', $review->department)->pluck('name')->first() ?? 'No Department'); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>
                <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <br>
                <div id="append_box_note_content"></div>
                <?php if($noteFlag): ?>
                <button class="btn btn-sm btn-primary float-end" type="button" onclick="add_more()">
                    <i class="bx bx-plus"></i> Add More</button>
                <?php endif; ?>
        </div>
    </div>
</div>



<div class="bottom-buttons ">
    <?php if($noteFlag): ?>
    <button type="button" class="btn btn-secondary saveDraft">
        <i class="bx bx-save me-1"></i> Save Draft
    </button>
    <button type="button" class="btn btn-primary" id="forward" <?php if($file->sent_to != null): ?>
        disabled
        <?php endif; ?>
        >
        <i class="bx bx-send me-1"></i> Forward
    </button>
    <?php
    $reviewStatusArray = json_decode($file->review_status, true);

    // Check if the review status array is not an array or has only one item
    $reviewStatus = 1;
    if (!is_array($reviewStatusArray) || count($reviewStatusArray) == 1) {
        $reviewStatus = 0;
    }
    ?>

    <button type="button" class="btn btn-info" id="backword" <?php if( $reviewStatus == 0 || $file->is_forword == 0 || $file->full_review == 1 || $file->sent_to != null): ?>
        disabled
        <?php endif; ?>
        > 
        <i class="bx bx-reply me-1"></i> Backward
    </button>

    <button type="button" class="btn btn-success" id="sent_to" <?php if($file->sent_to != null): ?>
        disabled
        <?php endif; ?>
        >
        <i class="bx bx-send me-1"></i> Send To User
    </button>

    <button type="button" class="btn btn-success" id="sent_to_committee" <?php if($file->sent_to != null || $file->initiator_id != Auth::user()->id): ?>
        disabled
        <?php endif; ?>
        >
        <i class="bx bx-send me-1"></i> Send To Committee
    </button>

    <a type="button" class="btn btn-info" href="<?php echo e(route('note-print')); ?>" <?php if($file->sent_to != null || $file->initiator_id != Auth::user()->id): ?>
        disabled
        <?php endif; ?>
        >
        <i class="bx bx-printer me-1"></i> Print
    </a>
    <?php endif; ?>
    <div class="pagination-buttons">
        <button type="button" class="btn btn-info" id="prevPage" disabled>
            <i class="bx bx-chevron-left me-1"></i> Previous
        </button>
        <button type="button" class="btn btn-info" id="nextPage">
            Next <i class="bx bx-chevron-right ms-1"></i>
        </button>
    </div>
</div>

<script>
function remove_box(event) {
    $(event.target).parent().parent().remove();
}

// script for add more text field for mission page
function add_more() {

    let randomNumber = String(Math.floor(Math.random() * (98765 - 12345 + 1)) + 5);

    let add_element = `
        <div class="mb-3">
            <label for="note" class="form-label text-dark">Note:</label>
            <textarea class="form-control" name="${randomNumber}" id="dynamic_details_${randomNumber}" cols="30" rows="3"></textarea>
            <span class="text-danger" id="NoteError"></span>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label text-dark">Date:</label>
            <input type="date" class="form-control" id="date_${randomNumber}" name="date">
            <span class="text-danger" id="DateError"></span>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label text-dark">Attachment:</label>
            <input type="file" class="form-control file-input" id="file_${randomNumber}" name="file" multiple>
            <span class="text-danger" id="FileError"></span>
            <div id="file-preview-${randomNumber}" class="d-flex justify-content-between mt-3"></div>
        </div>
    `;

    let textbox_script = `<script> CKEDITOR.replace('${randomNumber}'); </scr` +
        `ipt>`;

    let append_box = $("#append_box_note_content");

    $(append_box).append(`<li style='list-style:none'>
            <div class='d-flex justify-content-between float-end'>
                <button class='btn btn-sm btn-danger ' onclick='remove_box(event)'>Remove</button>
            </div>${add_element}${textbox_script}
        </li>`);

    // Add file preview functionality
    $(`#file_${randomNumber}`).on('change', function(event) {
        var files = event.target.files;
        var previewContainer = $(`#file-preview-${randomNumber}`);

        // console.log(previewContainer);

        previewContainer.empty(); // Clear any previous previews

        $.each(files, function(i, file) {
            var fileReader = new FileReader();

            fileReader.onload = function(e) {
                var fileURL = e.target.result;
                var previewElement;

                if (file.type.startsWith('image/')) {
                    previewElement = $('<img>').attr('src', fileURL).css({
                        maxWidth: '300px',
                        maxHeight: '300px',
                        marginRight: '10px',
                        display: 'block',
                        marginBottom: '10px'
                    });
                } else if (file.type === 'application/pdf') {
                    previewElement = $('<embed>').attr('src', fileURL).attr('type',
                        'application/pdf').css({
                        maxWidth: '300px',
                        maxHeight: '300px',
                        marginRight: '10px',
                        display: 'block',
                        marginBottom: '10px'
                    });
                } else if (file.type === 'application/msword' || file.type ===
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    previewElement = $('<a>').attr('href', fileURL).attr('download', file.name)
                        .html(`<i class="fas fa-file-word"></i> ${file.name}`).css({
                            marginBottom: '10px',
                            fontSize: '16px',
                            display: 'block'
                        });
                } else {
                    previewElement = $('<a>').attr('href', fileURL).attr('download', file.name)
                        .html(`${file.name}`).css({
                            marginBottom: '10px'
                        });
                }

                previewContainer.append(previewElement);
            };

            fileReader.readAsDataURL(file);
        });
    });
}

$(document).ready(function() {
    // Extract the ID from the URL
    var pathArray = window.location.pathname.split('/');
    var url_file_id = pathArray[pathArray.length - 1];

    // Save draft
    $('.saveDraft').on('click', function() {
        const file_id = url_file_id;
        const note = CKEDITOR.instances['note'].getData();
        const date = $('#date').val();
        const files = $('#file').prop('files');


        const formData = new FormData();
        formData.append('file_id', file_id);
        formData.append('note', note);
        formData.append('date', date);

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        //dynamic values
        var dynamicValues = [];
        $('#append_box_note_content').find('li').each(function(index, element) {
            var dynamicValue = {};
            dynamicValue.date = $(this).find('input[name="date"]').val();

            // Retrieve the unique identifier of the textarea
            var textareaId = $(this).find('textarea').attr('id');

            // Retrieve the value of the textarea using the unique identifier
            dynamicValue.note = CKEDITOR.instances[textareaId].getData();

            // Retrieve the multi files using the unique identifier
            var files = $(this).find('input[type="file"]').prop('files');
            dynamicValue.files = files;

            dynamicValues.push(dynamicValue);
        });

        formData.append('dynamicValues', JSON.stringify(dynamicValues));

        $.ajax({
            url: "<?php echo e(route('drafts.store')); ?>",
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

    function showDrafts() {
        const file_id = url_file_id;

        $.ajax({
            url: "<?php echo e(route('drafts.show', ':file_id')); ?>".replace(':file_id', file_id),
            type: 'GET',
            success: function(response) {
                console.log('show', response);

                if (response.data && response.data.length > 0) {
                    console.log('Drafts found:', response.data);
                    // Loop through the remaining data starting from the second item
                    for (var i = 0; i < response.data.length; i++) {
                        console.log('Draft:', response.data[i]);
                        var dynamicValue = response.data[i];
                        var randomNumber = String(Math.floor(Math.random() * (
                            98765 - 12345 + 1)) + 5);

                        var add_element =
                            //add hidden input field for CLO id
                            `<div class="mb-3">
                                        <label for="note" class="form-label">Note:</label>
                                        <textarea class="form-control" name="${randomNumber}" id="dynamic_details_${randomNumber}" cols="30" rows="3">${dynamicValue.note}</textarea>
                                        <span class="text-danger" id="NoteError"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date:</label>
                                        <input type="date" class="form-control" id="date_${randomNumber}" name="date" value="${dynamicValue.date}">
                                        <span class="text-danger" id="DateError"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label">Attachment:</label>
                                        <input type="file" class="form-control file-input" id="file_${randomNumber}" name="file" multiple>
                                        <span class="text-danger" id="FileError"></span>
                                        <div id="file-preview-${randomNumber}" class="d-flex justify-content-between mt-3"></div>
                                    </div>
                                `;
                        var textbox_script =
                            `<script> CKEDITOR.replace('${randomNumber}'); </scr` +
                            `ipt>`;

                        var append_box = $("#append_box_note_content");

                        $(append_box).append(`<li style='list-style:none'>
                                <div class='d-flex justify-content-between float-end'>
                                    <button class='btn btn-sm btn-danger ' onclick='remove_box(event)'>Remove</button>
                                </div>${add_element}${textbox_script}
                            </li>`);

                        var attachments = dynamicValue.attachment.split(
                            ', '); // Split the attachment string into an array

                        // Add file preview functionality for the draft
                        for (let i = 0; i < attachments.length; i++) {
                            var fileName = attachments[i];
                            var fileURL = '/public/global_assets/initiator_notes/' +
                                fileName; // Adjust the path according to your file storage location
                            var previewElement;
                            let previewContainer = $(`#file-preview-${randomNumber}`);

                            // Determine the type based on file extension (assuming no MIME type is available)
                            var fileExtension = fileName.split('.').pop().toLowerCase();

                            if (['jpg', 'jpeg', 'png', 'gif', 'bmp'].includes(fileExtension)) {
                                previewElement = $('<img>').attr('src', fileURL).css({
                                    maxWidth: '300px',
                                    maxHeight: '300px',
                                    marginRight: '10px',
                                    display: 'block',
                                    marginBottom: '10px'
                                });
                            } else if (fileExtension === 'pdf') {
                                previewElement = $('<embed>').attr('src', fileURL).attr('type',
                                    'application/pdf').css({
                                    maxWidth: '300px',
                                    maxHeight: '300px',
                                    marginRight: '10px',
                                    display: 'block',
                                    marginBottom: '10px'
                                });
                            } else if (['doc', 'docx'].includes(fileExtension)) {
                                previewElement = $('<a>').attr('href', fileURL).attr('download',
                                        fileName)
                                    .html(`<i class="fas fa-file-word"></i> ${fileName}`).css({
                                        marginBottom: '10px',
                                        fontSize: '16px',
                                        display: 'block'
                                    });
                            } else {
                                previewElement = $('<a>').attr('href', fileURL).attr('download',
                                        fileName)
                                    .html(`${fileName}`).css({
                                        marginBottom: '10px'
                                    });
                            }

                            previewContainer.append(previewElement);
                        }
                    }
                } else {
                    console.log('No drafts found.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch drafts:', error);
            }
        });
    }
    showDrafts();

    // Send to
    $('#sent_to').on('click', function() {
        $('#SentShow').modal('show');
    });

     // Send to committee
     $('#sent_to_committee').on('click', function() {
        $('#SentCommitteeShow').modal('show');
    });

    // Handle the sendToCommitteeButton click
    $('#sendToCommitteeButton').on('click', function() {
        console.log('sendToCommitteeButton clicked');
        // Extract the ID from the URL
        var pathArray = window.location.pathname.split('/');
        var file_id = pathArray[pathArray.length - 1];

        // Get the selected committee ID
        var selectedCommitteeId = $('input[name="selectedCommittee"]:checked').val();

         // Collect the dynamic values
         var dynamicValues = [];
        $('#append_box_note_content').find('li').each(function(index, element) {
            var dynamicValue = {};
            dynamicValue.date = $(this).find('input[name="date"]').val();

            // Retrieve the unique identifier of the textarea
            var textareaId = $(this).find('textarea').attr('id');

            // Retrieve the value of the textarea using the unique identifier
            dynamicValue.note = CKEDITOR.instances[textareaId].getData();

            // Skip file handling since we're not using FormData
            dynamicValues.push(dynamicValue);
        });

        // Prepare the data to send
        var data = {
            dynamicValues: dynamicValues,
            committee_id: selectedCommitteeId,
            file_id: file_id
        };

        console.log('Data to send:', data);

        if (selectedCommitteeId) {
            // Perform the AJAX request using the named route
            $.ajax({
                url: "<?php echo e(route('sent.to.committee', ['file_id' => ':file_id', 'committee_id' => ':committee_id'])); ?>"
                    .replace(':file_id', file_id)
                    .replace(':committee_id', selectedCommitteeId),
                type: 'PUT', // Since your route is using a GET method
                data: JSON.stringify(data), // Send data as a JSON string
                contentType: 'application/json', // Set the content type to JSON
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
                },
                success: function(response) {
                    if (response.status) {
                        alert('File sent to committee successfully');
                        // close the modal or refresh the page
                        $('#SentCommitteeShow').modal('hide');
                        window.location.href = "<?php echo e(route('initiator-note-attachments.create')); ?>";
                    } else {
                        alert('Failed to send file to committee');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        } else {
            alert('Please select a committee.');
        }
    });

    // Handle the "Send To" button click
    $('#sendToButton').on('click', function() {
        // Extract the ID from the URL
        var pathArray = window.location.pathname.split('/');
        var file_id = pathArray[pathArray.length - 1];

        // Get the selected user ID
        var selectedUserId = $('input[name="selectedUser"]:checked').val();

        if (selectedUserId) {
            // Perform the AJAX request using the named route
            $.ajax({
                url: "<?php echo e(route('sent.to', ['file_id' => ':file_id', 'user_id' => ':user_id'])); ?>"
                    .replace(':file_id', file_id)
                    .replace(':user_id', selectedUserId),
                type: 'GET', // Since your route is using a GET method
                success: function(response) {
                    if (response.status) {
                        alert('File sent to user successfully');
                        // close the modal or refresh the page
                        $('#SentShow').modal('hide');
                        location.reload();
                    } else {
                        alert('Failed to send file to user');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        } else {
            alert('Please select a user.');
        }
    });

    // Pagination script
    const pageHeight = 1824 // 19 inches to pixels
    const pageWidth = 1152 // 10 inches to pixels
    const pageContainer = $('#pageContainer');
    const prevPageButton = $('#prevPage');
    const nextPageButton = $('#nextPage');
    const pageNumberElement = $('.page-number');
    let currentPage = 0;
    let pages = [];

    function paginateContent(content) {
        let pages = [];
        let tempDiv = $('<div>').css({
            width: pageWidth + 'px',
            visibility: 'hidden'
        }).appendTo('body');

        content.each(function() {
            tempDiv.append($(this).clone());

            // Check if the content exceeds page height
            if (tempDiv.height() > pageHeight) {
                // Remove the last appended note if it causes overflow
                tempDiv.contents().last().remove();
                pages.push(tempDiv.html());

                // Clear temporary div and add the current content
                tempDiv.empty().append($(this).clone());
            }
        });

        // Add remaining content
        if (tempDiv.contents().length > 0) {
            pages.push(tempDiv.html());
        }

        tempDiv.remove(); // Cleanup the temporary div
        return pages;
    }


    function renderPage(pageIndex) {
        if (pageIndex < 0 || pageIndex >= pages.length) return;
        currentPage = pageIndex;

        pageContainer.html(
            `<div class="noteArea" style="
            margin-top: 76px;
            margin-left: 118px;
            margin-right: 10px;
            height: auto;
            max-height: calc(19in - 1.5in);
            color: black;
            text-align: left;
            overflow: auto;
            page-break-after: always;";
            position: relative;
            >
            ${pages[currentPage]}
        </div>`
        );


        // Update page number
        pageNumberElement.text(`Page ${currentPage + 1} of ${pages.length}`);

        // Apply the pseudo-element styles directly in CSS
        const style = document.createElement('style');
        style.innerHTML = `
        .noteArea::before {
            content: ' ';
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: black;
            top: 90px;
            left: 0;
        }

        .noteArea::after {
            content: ' ';
            position: absolute;
            width: 3px;
            height: 100%;
            background-color: black;
            top: 0;
            left: 108px;
        }

        .noteArea::-webkit-scrollbar {
            width: 1px;
        }

        .noteArea::-webkit-scrollbar-thumb {
            width: 1px;
            background-color: #258095;
        }
    `;
        document.head.appendChild(style);

        updateButtons();
    }


    function updateButtons() {
        prevPageButton.prop('disabled', currentPage === 0);
        nextPageButton.prop('disabled', currentPage === pages.length - 1);
    }

    // Select the content you want to paginate
    const contentToPaginate = $('#noteArea').children();

    // Paginate the content
    pages = paginateContent(contentToPaginate);

    // Render the first page
    renderPage(0);

    // Button click events
    prevPageButton.on('click', function() {
        if (currentPage > 0) {
            renderPage(currentPage - 1);
        }
    });

    nextPageButton.on('click', function() {
        if (currentPage < pages.length - 1) {
            renderPage(currentPage + 1);
        }
    });

    // forward ajax
    $('#forward').on('click', function(e) {
        e.preventDefault();
        var formData = new FormData();

        // dynamic values
        //dynamic values
        var dynamicValues = [];
        $('#append_box_note_content').find('li').each(function(index, element) {
            var dynamicValue = {};
            dynamicValue.date = $(this).find('input[name="date"]').val();

            // Retrieve the unique identifier of the textarea
            var textareaId = $(this).find('textarea').attr('id');

            // Retrieve the value of the textarea using the unique identifier
            dynamicValue.note = CKEDITOR.instances[textareaId].getData();

            // Retrieve the multi files using the unique identifier
            var files = $(this).find('input[type="file"]').prop('files');
            dynamicValue.files = files;

            dynamicValues.push(dynamicValue);
        });

        formData.append('dynamicValues', JSON.stringify(dynamicValues));

        // Extract the ID from the URL
        var pathArray = window.location.pathname.split('/');
        var url_file_id = pathArray[pathArray.length - 1];
        formData.append('file_id', url_file_id);

        $.ajax({
            url: "<?php echo e(route('receiving.forward')); ?>",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            contentType: false,
            processData: false,
            success: function(response) {
                Toastify({
                    text: 'Note Forward successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();
                window.location.href = "<?php echo e(route('tec.file.show')); ?>";
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

    $('#backword').on('click', function(e) {
        e.preventDefault();
        var formData = new FormData();

        // dynamic values
        var dynamicValues = [];
        $('#append_box_note_content').find('li').each(function(index, element) {
            var dynamicValue = {};
            dynamicValue.date = $(this).find('input[name="date"]').val();

            // Retrieve the unique identifier of the textarea
            var textareaId = $(this).find('textarea').attr('id');

            // Retrieve the value of the textarea using the unique identifier
            dynamicValue.note = CKEDITOR.instances[textareaId].getData();

            // Retrieve the multi files using the unique identifier
            var files = $(this).find('input[type="file"]').prop('files');
            dynamicValue.files = files;

            dynamicValues.push(dynamicValue);
        });

        formData.append('dynamicValues', JSON.stringify(dynamicValues));

        // Extract the ID from the URL
        var pathArray = window.location.pathname.split('/');
        var url_file_id = pathArray[pathArray.length - 1];
        formData.append('file_id', url_file_id);

        $.ajax({
            url: "<?php echo e(route('receiving.backward')); ?>",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            contentType: false,
            processData: false,
            success: function(response) {
                Toastify({
                    text: 'Note Backword successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();
                window.location.href = "<?php echo e(route('tec.file.show')); ?>";
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

    $('#printButton').on('click', function() {
        // Select the content of the noteArea div
        var noteAreaContent = $('#noteArea').html();


        if (!noteAreaContent) {
            console.error("noteAreaContent is undefined or empty.");
            return;
        }

        console.log(noteAreaContent);

        // Create a new window for the print job
        var printWindow = window.open('', '_blank');

        // Write the necessary HTML structure for printing
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Notes</title>
                <style>
                    body {
                        font-family: 'Arial', sans-serif;
                        margin: 0;
                        padding: 0;
                        background-color: #f0f8ff;
                    }

                    .page {
                        width: 1152px;
                        height: 1824px;
                        margin: 0 auto;
                        box-shadow: none;
                        border: none;
                        background-color: #59A4B7;
                        /* position: relative;
                        Added */
                    }


                    .content {
                        margin-bottom: 20px;
                        line-height: 1.6;
                    }

                    .content p {
                        margin: 5px 0;
                    }

                    #noteArea {
                        margin-top: 31px;
                        margin-left: 57px;
                        margin-bottom: 77px;
                        margin-right: 10px;
                        height: auto;
                        /* Allow the height to adjust based on content */
                        max-height: calc(19in - 1.5in);
                        /* Adjust this based on your needs */
                        color: black;
                        text-align: left;
                        /* overflow: auto; */
                        overflow: hidden;
                        /* Ensure content doesn't spill out visually */
                        page-break-after: always;
                        /* Ensure pages break correctly when printing */
                        position: relative;
                        /* Added */
                    }

                    #noteArea::before {
                        content: ' ';
                        position: absolute;
                        width: 100%;
                        height: 3px;
                        background-color: black;
                        top: 90px;
                        left: 0;
                    }

                    #noteArea::after {
                        content: ' ';
                        position: absolute;
                        width: 3px;
                        height: 100%;
                        background-color: black;
                        top: 0;
                        left: 108px;
                    }

                    .signature {
                        margin-top: 40px;
                        display: flex;
                        justify-content: space-between;
                        align-items: end;
                    }

                    .signature div {
                        width: 50%;
                        text-align: center;
                    }

                    .page-number {
                        position: absolute;
                        top: 10px;
                        width: 100%;
                        text-align: center;
                        font-weight: bold;
                    }

                    .fileNumber {
                        margin-top: 84px;
                        position: relative;
                        top: 10px;
                        font-size: 15px;
                        font-weight: bold;
                        margin-bottom: -61px;
                        margin-left: 117px;
                    }
                </style>
            </head>
            <body>
                <div class="noteArea">
                    ${noteAreaContent}
                </div>
            </body>
            </html>
        `);

        // Close the document and initiate the print
        printWindow.print();
    });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/receiving_file/note_show.blade.php ENDPATH**/ ?>