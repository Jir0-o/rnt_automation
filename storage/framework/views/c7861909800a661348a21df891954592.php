<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>নগদ ক্রয় রিপোর্ট</title>
    </head>
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

<body>
    
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
        জারীকৃত স্মারক নং-০৭.০০.০০০০.১৫১.২২.০০৩.১৫-৩৫১(১)এর অন্তর্ভুক্ত ক্রমিক সংখ্যা ৪৪(গ) মোতাবেক প্রদত্ত ক্ষমতাবলে
        স্বায়ত্বশাসিত প্রতিষ্ঠানের প্রধান হিসাবে <?php echo e($debitAuthorisation->store_name); ?>,
        <?php echo e($debitAuthorisation->store_address); ?> এর দাখিলকৃত বিল নং
        <?php echo e($debitAuthorisation->bill_no); ?> তারিখঃ <?php echo e($debitAuthorisation->bill_date); ?> বলিত
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
</div>
</body>
</html>
<?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/auth_note_print/authNotePrint.blade.php ENDPATH**/ ?>