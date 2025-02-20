
<?php $__env->startSection('content'); ?>
<title>নগদ ক্রয় রিপোর্ট</title>

<style>
@media print {
    input {
        border: none;
        appearance: none;
        -webkit-appearance: none;
        font-weight: bold;
        color: black;
    }

    input::placeholder {
        visibility: hidden;
    }

    input[type="text"] {
        width: auto;
    }

    input,
    input[type="date"] {
        background-color: transparent;
        border-bottom: none;
        pointer-events: none;
    }
}
</style>

<!-- Return Reason Modal Structure -->
<div class="modal fade" id="returnReasonModal" tabindex="-1" aria-labelledby="returnReasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnReasonModalLabel">Return Reason</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="returnReason" class="form-control" rows="6" placeholder="Enter the reason for return"></textarea>
            </div>
            <div class="modal-footer">
                <!-- Close Button -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- Submit Button -->
                <button type="button" data-id="<?php echo e($debitAuthorisation->id); ?>" class="btn btn-primary submitReturnReason">Submit</button>
            </div>
        </div>
    </div>
</div>

<div>
    <center>
        <h3>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</h3>
        <p>
            হোল্ডিং নং-০৮, রোড নং-০১, নিরালা আ/এ
            <br>
            খুলনা -৯১০০
        </p>
        <p>
            www.shmu.ac.bd
        </p>
    </center>
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-end">
            <p>
                স্মারক নং- <?php echo e($debitAuthorisation->requisition_no); ?>

            </p>
        </div>
        <div class="d-flex justify-content-end">
            <p>
                তারিখঃ <?php echo e($debitAuthorisation->date); ?>

            </p>
        </div>
    </div>
    <p style="text-indent: 3em;">
        অর্থ মন্ত্রণালয়ের অর্থ বিভাগ, বায় নিয়ন্ত্রণ অনুবিভাগের ০১-০৫-১৪২২ বঙ্গাব্দ/১৬-০৮-২০১৫ খ্রিস্টাব্দ তারিখের
        জারীকৃত স্মারক নং-০৭.০০.০০০০.১৫১.২২.০০৩.১৫-৩৫১(১)এর অন্তর্ভুক্ত ক্রমিক সংখ্যা <?php echo e($debitAuthorisation->serial_no ?? "N/A"); ?> মোতাবেক প্রদত্ত ক্ষমতাবলে
        স্বায়ত্বশাসিত প্রতিষ্ঠানের প্রধান হিসাবে <?php echo e($debitAuthorisation->store_name); ?>,
        <?php echo e($debitAuthorisation->store_address); ?> এর দাখিলকৃত বিল নং
        <?php echo e($debitAuthorisation->bill_no); ?> তারিখঃ <?php echo e($debitAuthorisation->bill_date); ?> এ বর্ণিত
        রাজস্ব খাতের অধীনে
        <?php echo e($debitAuthorisation->product_name); ?> ক্রয়ের বিলে
        দাবীকৃত মোট <?php echo e($debitAuthorisation->amount); ?> (<?php echo e($debitAuthorisation->in_word); ?>)/মঞ্জুর করা
        হলো।
    </p>
    <p style="text-indent: 3em;">
        এই ব্যায় <?php echo e($debitAuthorisation->budget_year); ?> অর্থ বৎসরের বরাদ্দকৃত
        বাজেটের
        নিম্নোক্ত খাত/উপ-খাত হতে
        নির্বাহ
        করা হবে।
    </p>
    <p style="text-indent: 3em;">
        কোড নং ১২৫-১২৫০১-১৩১০০৫২০০ শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা, <?php echo e($debitAuthorisation->work_name); ?>

        (<?php echo e($debitAuthorisation->work_code); ?>)।
    </p>
    <br>
    <p>
        নোট নং-<?php echo e($debitAuthorisation->note_no); ?>

    </p>

    <div class="d-flex justify-content-end">
        <p class="text-center">
            <?php

            $designation = App\Models\Designation::where('designation', 'Vice Chancellor')->first();

            $user = App\Models\User::where('designation_id', $designation->id)->first();

            ?>
            <?php if($debitAuthorisation->status == 1): ?>
            <img src="/global_assets/user_images/signature/<?php echo e($user->signature ?? ''); ?>" alt="Signature" width="100">
            <br>
            <span>
                <strong><?php echo e($user->name ?? ''); ?></strong>
            </span>
            <br>
            <span>
                উপাচার্য
            </span>
            <br>
            <span>
                শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা
            </span>
            <?php endif; ?>
            <?php if($debitAuthorisation->status != 1): ?>
            <br>
            <br>
            <br>
            <br>
            <br>
            <?php endif; ?>
        </p>
    </div>
    <?php if($debitAuthorisation->status == 3): ?>
    <div class="d-flex justify-content-end">
        <br>
        <p class="text-center">
            <span>
                <strong>মন্তব্য</strong>
            </span>
            <br>
        </p>
        <br>
    </div>

    <div class="d-flex justify-content-end">
        <p class="text-center">
            <span>
                <?php echo $debitAuthorisation->decision; ?>

            </span>
        </p>
    </div>
    <?php endif; ?>

    <p>
        ট্রেজারার
        <br>
        শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়,
        <br>
        খুলনা
    </p>
    <ol style="list-style-position: outside;">
        অনুলিপি
        <li class="ps-4">
            পি এস টু ডিসি, অত্র বিশ্ববিদ্যালয়।
        </li>
        <li class="ps-4">
            দাপ্তরিক নথি।
        </li>
    </ol>
   <div class="d-flex justify-content-between">
        <!-- Back Button -->
        <a href="#" class="btn btn-secondary mt-3" id="backButton">
            <i class="fas fa-arrow-left mx-1"></i> Back
        </a>
        <?php if($debitAuthorisation->status == 0 && auth()->id() == $user->id): ?>
        <!-- Center Return Button -->
        <button type="button" class="btn btn-warning mt-3 mx-2 return" id="returnBtn">
            <i class="fas fa-undo mx-1"></i> Return
        </button>

        <!-- Accept, Reject, and Print Buttons on the Right -->
        <div>
            <button type="button" data-id="<?php echo e($debitAuthorisation->id); ?>" class="btn btn-success mt-3 mx-1 accept" id="acceptBtn">
                <i class="fas fa-check mx-1"></i> Accept
            </button>
            <button type="button" data-id="<?php echo e($debitAuthorisation->id); ?>"class="btn btn-danger mt-3 mx-1 reject" id="rejectBtn">
                <i class="fas fa-times mx-1"></i> Reject
            </button>
            <?php endif; ?>
            <?php if($debitAuthorisation->status == 1 && auth()->id() != $user->id): ?>
            <button type="button" onclick="printContent()" data-id="<?php echo e($debitAuthorisation->id); ?>" class="btn btn-primary mt-3 mx-1 print" id="printBtn">
                <i class="fas fa-print mx-1"></i> Print
            </button>
            <?php endif; ?>

            <?php if($debitAuthorisation->status == 3 && auth()->id() != $user->id): ?>
            <form action="<?php echo e(route('debit.authorisations.edit', $debitAuthorisation->id)); ?>" method="GET">
                <button type="submit" class="btn btn-secondary mt-3 mx-1 editReport">
                    <i class="bx bx-edit me-1"></i> Edit
                </button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function printContent() {
    // Get all the input values and store them in variables
    var memorial = "<?php echo e($debitAuthorisation->requisition_no ?? ''); ?>";
    var date = "<?php echo e($debitAuthorisation->date ?? ''); ?>";
    var store = "<?php echo e($debitAuthorisation->store_name ?? ''); ?>";
    var store_address = "<?php echo e($debitAuthorisation->store_address ?? ''); ?>";
    var bill = "<?php echo e($debitAuthorisation->bill_no ?? ''); ?>";
    var pur_date = "<?php echo e($debitAuthorisation->bill_date?? ''); ?>";
    var product = "<?php echo e($debitAuthorisation->product_name ?? ''); ?>";
    var price = "<?php echo e($debitAuthorisation->amount ?? ''); ?>";
    var price_in_word = "<?php echo e($debitAuthorisation->in_word ?? ''); ?>";
    var budget_year = "<?php echo e($debitAuthorisation->budget_year ?? ''); ?>";
    var work = "<?php echo e($debitAuthorisation->work_name ?? ''); ?>";
    var work_code = "<?php echo e($debitAuthorisation->work_code ?? ''); ?>";
    var note_no = "<?php echo e($debitAuthorisation->note_no ?? ''); ?>";
    var serial_no = "<?php echo e($debitAuthorisation->serial_no ?? ''); ?>";

    var userSignature = "<?php echo e($user->signature ?? ''); ?>";
    var userName = "<?php echo e($user->name ?? ''); ?>";

    // Create a new window for printing
    let printWindow = window.open('', '_blank');

    // Write the content to the new window, replacing input fields with their values
    printWindow.document.write(`
            <html>
            <head>
                <title>Print Page</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                    }
                    .d-flex {
                        display: flex;
                    }
                    .justify-content-between {
                        justify-content: space-between;
                    }
                    .justify-content-end {
                        justify-content: flex-end;
                    }
                    .text-center {
                        text-align: center;
                    }
                    p, h3 {
                        margin: 0;
                        padding: 0;
                    }
                    ol {
                        padding-left: 20px;
                    }
                </style>
            </head>
            <body>
                <center>
                    <h3>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</h3>
                    <p>
                        হোল্ডিং নং-০৮, রোড নং-০১, নিরালা আ/এ
                        <br>
                        খুলনা -৯১০০
                    </p>
                    <p>
                        www.shmu.ac.bd
                    </p>
                </center>
                <br>
                <br>
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-end">
                        <p>স্মারক নং- ${memorial}</p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <p>তারিখঃ ${date}</p>
                    </div>
                </div>
                <br>
                <br>
                <p style="text-indent: 3em;">
                    অর্থ মন্ত্রণালয়ের অর্থ বিভাগ, বায় নিয়ন্ত্রণ অনুবিভাগের ০১-০৫-১৪২২ বঙ্গাব্দ/১৬-০৮-২০১৫ খ্রিস্টাব্দ তারিখের
                    জারীকৃত স্মারক নং-০৭.০০.০০০০.১৫১.২২.০০৩.১৫-৩৫১(১)এর অন্তর্ভুক্ত ক্রমিক সংখ্যা ${serial_no} মোতাবেক প্রদত্ত ক্ষমতাবলে
                    স্বায়ত্বশাসিত প্রতিষ্ঠানের প্রধান হিসাবে ${store}, ${store_address} এর দাখিলকৃত বিল নং
                    ${bill} তারিখঃ ${pur_date} এ বর্ণিত রাজস্ব খাতের অধীনে
                    ${product} ক্রয়ের বিলে দাবীকৃত মোট ${price} (${price_in_word})/মঞ্জুর করা
                    হলো।
                </p>
                <br>
                <p style="text-indent: 3em;">
                    এই ব্যায় ${budget_year} অর্থ বৎসরের বরাদ্দকৃত বাজেটের নিম্নোক্ত খাত/উপ-খাত হতে
                    নির্বাহ করা হবে।
                </p>
                <p style="text-indent: 3em;">
                    কোড নং ১২৫-১২৫০১-১৩১০০৫২০০ শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা, ${work}
                    (${work_code})।
                </p>
                    <br>
                <p style="text-indent: ">
                    নোট নং-${note_no}
                </p>
                <div class="d-flex justify-content-end">
                    <p class="text-center">
                        <img src="/global_assets/user_images/signature/${userSignature}" alt="Signature" width="100">
                        <br>
                        <span>
                            <strong>${userName}</strong>
                        </span>
                        <br>
                        <span>উপাচার্য</span>
                        <br>
                        <span>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</span>
                    </p>
                </div>
                <p>
                    ট্রেজারার
                    <br>
                    শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়,
                    <br>
                    খুলনা
                </p>
                <ol style="list-style-position: outside;">
                    অনুলিপি
                    <li class="ps-4">
                        পি এস টু ডিসি, অত্র বিশ্ববিদ্যালয়।
                    </li>
                    <li class="ps-4">
                        দাপ্তরিক নথি।
                    </li>
                </ol>
            </body>
            </html>
        `);

    // Close the document to trigger the content rendering
    printWindow.document.close();

    // Focus and print the content
    printWindow.focus();
    printWindow.print();

    // Close the print window after printing
    printWindow.onafterprint = function() {
        printWindow.close();
    };
}
</script>

<script>
    $(document).ready(function() {
        CKEDITOR.replace('returnReason');

        // Set the back button's href to the stored URL
        var previousUrl = localStorage.getItem("current_url");
        if (previousUrl) {
            $('#backButton').attr('href', previousUrl);
        }

        // VC accept Submit
$(document).on('click', '.accept', function() {
    var id = $(this).data('id');

    $.ajax({
        url: "<?php echo e(route('debit.authorisations.Accept', ':id')); ?>".replace(':id', id),
        type: 'POST',
        data: {
            id: id,
        },
        headers: {
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
        },
        success: function(response) {
            Toastify({
                text: 'Report accepted successfully.',
                backgroundColor: 'green',
                className: 'info',
            }).showToast();
            location.reload();

            $('#reportModal').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Failed to accept report:', error);
            Toastify({
                text: 'Failed to accept note.',
                backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                className: 'info',
            }).showToast();
        }
    });
});

    // VC reject Submit
$(document).on('click', '.reject', function() {
    var id = $(this).data('id');

    $.ajax({
        url: "<?php echo e(route('debit.authorisations.Reject', ':id')); ?>".replace(':id', id),
        type: 'POST',
        data: {
            id: id,
        },
        headers: {
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
        },
        success: function(response) {
            Toastify({
                text: 'Report rejected successfully.',
                backgroundColor: 'red',
                className: 'info',
            }).showToast();
            location.reload();

            $('#reportModal').modal('hide');
        },
        error: function(xhr, status, error) {
            console.error('Failed to reject report:', error);
            Toastify({
                text: 'Failed to reject note.',
                backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                className: 'info',
            }).showToast();
        }
    });
});


    // return button click
    $(document).on('click', '.return', function() {
        $('#reportModal').modal('hide');
        $('#returnReasonModal').modal('show');
    });

    // Store the latest ID in localStorage each time a Return button is clicked
    $(document).on('click', '.return', function() {
        var id = $(this).data('id');
        localStorage.removeItem('returnId');
        localStorage.setItem('returnId', id); // This will replace any existing ID with the new one
        console.log("ID saved to local storage:", id);
    });

         // Handle the Submit button click in the modal
         $(document).on('click', '.submitReturnReason', function() {
        var id = $(this).data('id');
        var reason = CKEDITOR.instances['returnReason'].getData();

        $.ajax({
            url: "<?php echo e(route('debit.authorisations.return', ':id')); ?>".replace(':id', id),
            type: 'POST',
            data: {
                id: id,
                reason: reason,
            },
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            success: function(response) {
                // Show success message or handle response
                $('#returnReasonModal').modal('hide');
                Toastify({
                    text: 'Requisition returned successfully.',
                    backgroundColor: 'green',
                    className: 'info',
                }).showToast();
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                console.error('Failed to submit return reason:', error);
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/debit_authorisation_show.blade.php ENDPATH**/ ?>