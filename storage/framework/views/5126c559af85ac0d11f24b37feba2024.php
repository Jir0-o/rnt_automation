
<?php $__env->startSection('content'); ?>

<style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    position: relative;
    top: 10px;
    min-height: 100vh;
    box-sizing: border-box;
}

.content {
    margin: 20px 0;
    line-height: 1.6;
}

.content p {
    margin: 5px 0;
}

.signature {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
}

.signature div {
    width: 50%;
    text-align: center;
}

.right-side {
    display: flex;
    float: right;
    justify-content: space-between;
}
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
        </div>
    </div>
    <div class="container">
        <?php if($note instanceof Illuminate\Database\Eloquent\Collection): ?>
        <?php $__currentLoopData = $note; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="content">
            <b><?php echo e($loop->iteration); ?> ) </b> <?php echo $notes->note; ?>

        </div>
        <div class="signature">
            <?php $__currentLoopData = $notes->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="text-center">
                <div class="reviewer-comment">
                    <p><strong><?php echo $review->comment; ?></strong></p>
                </div>
                <div class="reviewer-signature">
                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature); ?>" alt="Signature"
                            width="50"></p>
                </div>
                <div class="reviewer-date">
                    <p><strong><?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y')); ?></strong></p>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php elseif($note instanceof App\Models\InitiatorNote): ?>
        <div class="content">
            <b>1) </b> <?php echo $note->note; ?>

        </div>

        <div class="signature">
            <?php $__currentLoopData = $note->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="text-center">
                <div class="reviewer-comment">
                    <p><strong><?php echo $review->comment; ?></strong></p>
                </div>
                <div class="reviewer-signature">
                    <p><img src="/global_assets/user_images/signature/<?php echo e($review->signature); ?>" alt="Signature"
                            width="50"></p>
                </div>
                <div class="reviewer-date">
                    <p><strong><?php echo e(\Carbon\Carbon::parse($review->date)->format('d-F-Y')); ?></strong></p>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>

        <div class="right-side" id="reviewed">

        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    var url = window.location.href;
    var segments = url.split('/');
    var id = segments[segments.length - 2];

    $('#reviewed').empty();

    $('#reviewed').append(`

        <button type="button" class="btn btn-success unlockFileBtn"
            data-id="${id}">
            <i class="bx bx-lock-open me-1"></i> Unlock File
        </button>
    `);

     // Unlock File
     $(document).on('click', '.unlockFileBtn', function() {
        var file_id = $(this).data('id');

        $.ajax({
            url: "<?php echo e(route('initiator-note-reviews.show', ':id')); ?>".replace(':id', file_id),
            method: 'GET',
            success: function(response) {
                Toastify({
                    text: 'File unlocked successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();

                location.href = "<?php echo e(route('initiator-notes.create')); ?>";
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
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/archive_note_show.blade.php ENDPATH**/ ?>