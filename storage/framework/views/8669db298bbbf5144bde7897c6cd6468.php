
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
                স্মারক নং- <input type="text" name="memorial" value="<?php echo e($debitAuthorisation->requisition_no); ?>" id="memorial" placeholder="স্মারক নং">
                </input>
            </p>
        </div>
        <div class="d-flex justify-content-end">
            <p>
                তারিখঃ <input type="date" name="date" value="<?php echo e($debitAuthorisation->date); ?>" id="date">
            </p>
        </div>
    </div>
    <p style="text-indent: 3em;">
        অর্থ মন্ত্রণালয়ের অর্থ বিভাগ, বায় নিয়ন্ত্রণ অনুবিভাগের ০১-০৫-১৪২২ বঙ্গাব্দ/১৬-০৮-২০১৫ খ্রিস্টাব্দ তারিখের
        জারীকৃত স্মারক নং-০৭.০০.০০০০.১৫১.২২.০০৩.১৫-৩৫১(১)এর অন্তর্ভুক্ত ক্রমিক সংখ্যা <input type="text" name="serial_no" value="<?php echo e($debitAuthorisation->serial_no); ?>" id="serial_no" placeholder="ক্রমিক নং"> মোতাবেক প্রদত্ত ক্ষমতাবলে
        স্বায়ত্বশাসিত প্রতিষ্ঠানের প্রধান হিসাবে <input type="text" name="store" value="<?php echo e($debitAuthorisation->store_name); ?>" id="store" placeholder="দোকান নাম">,
        <input type="text" name="store_address" value="<?php echo e($debitAuthorisation->store_address); ?>" id="store_address" placeholder="ঠিকানা"> এর দাখিলকৃত বিল নং
        <input type="text" name="bill" value="<?php echo e($debitAuthorisation->bill_no); ?>" id="bill" placeholder="বিল নং"> তারিখঃ <input type="date" name="pur_date" value="<?php echo e($debitAuthorisation->bill_date); ?>"
            id="pur_date"> এ বর্ণিত
        রাজস্ব খাতের অধীনে
        <input type="text" name="product" value="<?php echo e($debitAuthorisation->product_name); ?>" id="product" placeholder="পণ্যের নাম"> ক্রয়ের বিলে
        দাবীকৃত মোট <input type="text" name="price" value="<?php echo e($debitAuthorisation->amount); ?>" id="price" placeholder="মূল্য"> (<input type="text"
            name="price_in_word" value="<?php echo e($debitAuthorisation->in_word); ?>" id="price_in_word" placeholder="মূল্য কথা">)/মঞ্জুর করা
        হলো।
    </p>
    <p style="text-indent: 3em;">
        এই ব্যায় <input type="text" name="budget_year" value="<?php echo e($debitAuthorisation->budget_year); ?>" id="budget_year" placeholder="বাজেট বছর"> অর্থ বৎসরের বরাদ্দকৃত
        বাজেটের
        নিম্নোক্ত খাত/উপ-খাত হতে
        নির্বাহ
        করা হবে।
    </p>
    <p style="text-indent: 3em;">
        কোড নং ১২৫-১২৫০১-১৩১০০৫২০০ শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা, <input type="text" name="work" id="work" value="<?php echo e($debitAuthorisation->work_name); ?>"
            placeholder="কাজের নাম">
        (<input type="text" name="work_code" value="<?php echo e($debitAuthorisation->work_code); ?>" id="work_code" placeholder="কাজের কোড">)।
    </p>
    <br>
    <p>
        নোট নং-<input type="text" name="note_no"  value="<?php echo e($debitAuthorisation->note_no); ?>" id="note_no" placeholder="নোট নং">
    </p>

    <div class="d-flex justify-content-end">
        <p class="text-center">
            <?php

            $designation = App\Models\Designation::where('designation', 'Vice Chancellor')->first();

            $user = App\Models\User::where('designation_id', $designation->id)->first();

            ?>
            
            <br>
            <br>
            <br>
            <br>
            <span>
                শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা
            </span>
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
    <div class="d-flex justify-content-between">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left mx-1"></i> Back
        </a>
        <!-- Button to trigger print -->
        <button type="button" class="btn btn-primary" data-id="<?php echo e($debitAuthorisation->id); ?>" id="sendBtn">Update</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("#sendBtn").click(function() {
            var id = $(this).data('id')
            // Collect each form field's value individually
            var formData = {
                memorial: $("#memorial").val(),
                date: $("#date").val(),
                store: $("#store").val(),
                store_address: $("#store_address").val(),
                bill: $("#bill").val(),
                pur_date: $("#pur_date").val(),
                product: $("#product").val(),
                price: $("#price").val(),
                price_in_word: $("#price_in_word").val(),
                budget_year: $("#budget_year").val(),
                work: $("#work").val(),
                work_code: $("#work_code").val(),
                note_no: $("#note_no").val(),
                serial_no: $("#serial_no").val(),
                id: id
            };
    
            $.ajax({
                url: "<?php echo e(route('debit.authorisations.update', ':id')); ?>".replace(':id', id),
                type: 'PUT',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token here
                },
                data: formData,
                success: function(response) {
                    // Display a success message using Toastify
                    Toastify({
                        text: "Form submitted successfully!",
                        duration: 3000,
                        gravity: "top", // Position of the toast
                        position: "right", // Align the toast to the right
                        backgroundColor: "#4CAF50", // Green background for success
                    }).showToast();
                    
                    console.log("Form submitted successfully:", response);
                        // Clear the input fields
                        $("#memorial").val('');
                        $("#date").val('');
                        $("#store").val('');
                        $("#store_address").val('');
                        $("#bill").val('');
                        $("#pur_date").val('');
                        $("#product").val('');
                        $("#price").val('');
                        $("#price_in_word").val('');
                        $("#budget_year").val('');
                        $("#work").val('');
                        $("#work_code").val('');
                        $("#note_no").val('');
                        $("#serial_no").val('');

                        window.location.href = "<?php echo e(url()->previous()); ?>";
                },
                error: function(error) {
                    // Display an error message using Toastify
                    Toastify({
                        text: "Error submitting form.",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#f44336", // Red background for error
                    }).showToast();
                    
                    console.error("Error submitting form:", error);
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/debit_authorisation_edit.blade.php ENDPATH**/ ?>