<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>

    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 0 auto;
        padding: 10px;
        position: relative;
        top: 5px;
        min-height: 100vh;
        box-sizing: border-box;
    }

    .header {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
    }

    .img-container {
        text-align: center;
    }

    .img {
        width: 90px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 5px;
    }

    .header h1 {
        margin: 3px 0;
        font-size: 24px;
        display: inline-block;
        vertical-align: middle;
    }

    .header h2 {
        margin: 3px 0;
        font-size: 20px;
    }

    .header h3 {
        margin: 3px 0;
        font-size: 18px;
    }

    .flex-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 3px;
    }

    .flex-item {
        width: 50%;
    }

    .content {
        margin: 10px 0;
        line-height: 1.6;
    }

    .content p {
        margin: 5px 0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th,
    .table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
        font-size: 14px;
    }

    .table th {
        text-align: center;
    }

    .signature {
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
    }

    .signature div {
        width: 50%;
        text-align: center;
    }

    .footer {
        margin-top: 30px;
        width: 100%;
        text-align: center;
        font-size: 12px;
    }

    .container hr {
        margin: 5px 0;
        border: 1px solid #000;
    }

    .checkbox-group {
        margin: 5px 0;
    }

    .checkbox-group label {
        margin-right: 5px;
    }
    </style>
</head>

<body>
    <div class="card">
        <div class="container">
            <div class="img-container">
                <img src="<?php echo e(asset('Sheikh_Hasina_Medical_University,_Khulna_Logo.png')); ?>" alt="Logo" class="img">
            </div>
            <div class="header">
                <h1>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</h1>
            </div>
            <div class="header">
                <h3>চাহিদাপত্র</h3>
            </div>
            <hr>
            <div class="flex-container">
                <div class="flex-item">
                    <p>স্মারক নং: <?php echo e($requisition->requisition_no); ?></p>
                </div>
                <div class="flex-item" style="text-align: right;">
                    <?php
                    use Carbon\Carbon;
                    ?>

                    <p>তারিখ: <?php echo e(Carbon::parse($requisition->requisition_date)->format('d-F-Y')); ?></p>
                </div>
            </div>
            <div class="content">
                <p>বরাবর,</p>
                <p>স্টোর শাখা,</p>
                <p>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা।</p>
                <br>
                <p>চাহিদাকারীর নাম: <b><?php echo e($requisition->user->name); ?></b> চাহিদাকারীর পদবী:
                    <b><?php echo e($requisition->user->designation->designation); ?></b>
                </p>
                <p>চাহিদার শ্রেণী:
                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" <?php echo e($requisition->cc == 1 ? 'checked' : ''); ?> disabled> পণ্য ও সংশ্লিষ্ট
                        সেবা
                    </label>
                    <label>
                        <input type="checkbox" <?php echo e($requisition->cc == 2 ? 'checked' : ''); ?> disabled> কার্য ও ভৌত সেবা
                    </label>
                    <label>
                        <input type="checkbox" <?php echo e($requisition->cc == 3 ? 'checked' : ''); ?> disabled> বৃদ্ধিবৃত্তিক সেবা
                    </label>
                    <label>
                        <input type="checkbox" <?php echo e($requisition->cc == 4 ? 'checked' : ''); ?> disabled> অন্যান্য সেবা
                    </label>
                </div>
                </p>
                <p>ক্রয় পরিকল্পনায় অন্তর্ভুক্ত কিনা:
                <div class="checkbox-group">
                    <label><input type="checkbox" <?php echo e($requisition->auth == 1 ? 'checked' : ''); ?> disabled>
                        অন্তর্ভুক্ত</label>
                    <label><input type="checkbox" <?php echo e($requisition->auth == 2 ? 'checked' : ''); ?> disabled> অন্তর্ভুক্ত
                        করা
                        প্রয়োজন</label>
                </div>
                </p>
                <br>
                <p>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা এর রেজিস্ট্রার দপ্তরের দাপ্তরিক কার্যক্রম যথাযথভাবে
                    পরিচালনার জন্য
                    নিম্নবর্ণিত পণ্যে জুরুরি ভিত্তিতে সরবরাহ করার জন্য অনুরোধ করা হলো।</p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ক্র. নং</th>
                        <th>বিবরণ</th>
                        <th>কারিগরি নির্দিষ্টকরণ</th>
                        <th>একক</th>
                        <th>সংখ্যা</th>
                        <th>মন্তব্য</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    ?>
                    <?php if($requisition->requisitionProducts->isEmpty()): ?>
                    <?php $__currentLoopData = $requisition->missingRequisitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($requisition_product->product_name); ?></td>
                        <td><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                        <td><?php echo e($requisition_product->unit->name ??'N/A'); ?></td>
                        <td><?php echo e($requisition_product->quantity); ?></td>
                        <td><?php echo e(strip_tags($requisition_product->note ?? 'N/A')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php $__currentLoopData = $requisition->requisitionProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($requisition_product->product->product_name); ?></td>
                        <td><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                        <td><?php echo e($requisition_product->unitType->name ??'N/A'); ?></td>
                        <td><?php echo e($requisition_product->quantity); ?></td>
                        <td><?php echo e(strip_tags($requisition_product->remarks ?? 'N/A')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="signature">
                <?php $__currentLoopData = $requisition->requisitionSignatures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $requisition_signature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($index == 0): ?>
                <div class="text-center">
                    <img src="<?php echo e(asset('global_assets/user_images/signature/' . $requisition_signature->signature)); ?>"
                        alt="Signature" width="100">
                    <p>(চাহিদাকারীর স্বাক্ষর)</p>
                    <?php echo e(Carbon::parse($requisition_signature->date)->format('d-F-Y')); ?>

                    <br>
                    <strong> <?php echo e($requisition_signature->name); ?> </strong>
                    <br>
                    <?php echo e($requisition_signature->designation); ?>

                    <br>
                    <?php echo e($requisition_signature->department); ?>

                </div>
                <?php elseif($index == 1): ?>
                <div class="text-center">
                    <img src="<?php echo e(asset('global_assets/user_images/signature/' . $requisition_signature->signature)); ?>"
                        alt="Signature" width="100">
                    <p>(চাহিদাকারীর স্বাক্ষর)</p>
                    <?php echo e(Carbon::parse($requisition_signature->date)->format('d-F-Y')); ?>

                    <br>
                    <strong> <?php echo e($requisition_signature->name); ?> </strong>
                    <br>
                    <?php echo e($requisition_signature->designation); ?>

                    <br>
                    <?php echo e($requisition_signature->department); ?>

                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <hr>
            <div class="footer">
                <p>ঠিকানা: অস্থায়ী অফিস: হোল্ডিং নং-০৮, রোড নং-০১, নিরালা রেসিডেনশিয়াল এরিয়া, খুলনা-৯১০০</p>
                <p>ওয়েবসাইট: www.shmu.ac.bd</p>
            </div>
        </div>
    </div>
</body>

</html>

<script>
window.print();
</script><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/requisitions/requisition_print.blade.php ENDPATH**/ ?>