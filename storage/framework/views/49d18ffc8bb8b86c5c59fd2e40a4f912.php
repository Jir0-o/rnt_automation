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
        height: 90px;
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
        margin-top: 70px;
        display: flex;
        justify-content: space-around;
    }

    .signature div {
        /* width: 50%; */
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

    .btm-top {
        padding: 15px;
        border-top: 1px dotted #363636;
    }
    </style>
</head>

<body>
    <div class="card">
        <div class="container">
            <div class="img-container">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNTByE28m0LR-w-JNQ6ZrvJjMxZQ9ciyS-Cg&s"
                    alt="Logo" class="img">
            </div>
            <div class="header">
                <h1>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</h1>
            </div>
            <div class="header">
                <h3>বরাদ্দপত্র</h3>
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
                <p>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা।</p>
                <br>
                <p>চাহিদাকারীর নাম: <b><?php echo e($user->name); ?></b> চাহিদাকারীর পদবী:
                    <b><?php echo e($user->designation->designation); ?>r</b>
                </p>
                <!-- <p>চাহিদার শ্রেণী:
                <div class="checkbox-group">
                    <label><input type="checkbox"> পণ্য ও সংশ্লিষ্ট সেবা</label>
                    <label><input type="checkbox"> কার্য ও ভৌত সেবা</label>
                    <label><input type="checkbox"> বৃদ্ধিবৃত্তিক সেবা</label>
                    <label><input type="checkbox"> অন্যান্য সেবা</label>
                </div>
                </p> -->
                <!-- <p>ক্রয় পরিকল্পনায় অন্তর্ভুক্ত কিনা:
                <div class="checkbox-group">
                    <label><input type="checkbox"> অন্তর্ভুক্ত</label>
                    <label><input type="checkbox"> অন্তর্ভুক্ত করা প্রয়োজন</label>
                </div>
                </p> -->
                <br>
                <p>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা এর দাপ্তরিক কার্যক্রম যথাযথভাবে
                    পরিচালনার জন্য
                    নিম্নবর্ণিত পণ্যে সরবরাহ করা হলো।</p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ক্র. নং</th>
                        <th>বিবরণ</th>
                        <th>কারিগরি বিনির্দেশ</th>
                        <th>একক</th>
                        <th>চাহিত পন্য</th>
                        <th>বরাদ্দকৃত পন্য</th>
                        <th>মন্তব্য</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i = 1;
                ?>
                <?php $__currentLoopData = $requisition->requisitionProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Find if there is an allocated product with a similar product_name using "like" condition
                        $matchedAllocatedProduct = $allocatedproducts->filter(function($allocatedProduct) use ($requisition_product) {
                            return stripos($allocatedProduct->product->product_name, $requisition_product->product->product_name) !== false;
                        })->first();

                        // Set default remarks to "In progress"
                        $remarks = 'In progress';
                        $allocatedQuantity = 0;

                        // Check if a matching allocated product exists and set remarks accordingly
                        if ($matchedAllocatedProduct) {
                            $allocatedQuantity = $matchedAllocatedProduct->quantity ?? 0;

                            if ($requisition_product->quantity <= $allocatedQuantity) {
                                $remarks = 'Dispatch';
                            } elseif ($allocatedQuantity == 0) {
                                $remarks = 'To be considered';
                            }
                        }
                    ?>

                    <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($requisition_product->product->product_name); ?></td>
                        <td><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                        <td><?php echo e($requisition_product->product->unitType->name); ?></td>
                        <td><?php echo e($requisition_product->quantity); ?></td>
                        <td><?php echo e($allocatedQuantity); ?></td>
                        <td><?php echo e($remarks); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div class="signature">
                <div>
                    <p class="btm-top">কিপার (স্টোর)</p>
                </div>
                <div>
                    <p class="btm-top">অফিসার (স্টোর)</p>
                </div>
                <div>
                    <p class="btm-top">ডিরেক্টর (স্টোর)</p>
                </div>
                <div>
                    <p class="btm-top">গ্রহণকারী</p>
                </div>
            </div>
            <hr>
            <div class="footer">
                <p>ঠিকানা: নিরালা রেসিডেনশিয়াল এরিয়া, খুলনা-৯১০০</p>
                <p>ই-মেইল: shmu_khulna@shmu.ac.bd</p>
                <p>ওয়েবসাইট: www.shmu.ac.bd</p>
            </div>
        </div>
    </div>

    <script>
    window.print();
    </script>
</body>

</html><?php /**PATH D:\laragon\www\Procurement_final\resources\views/backend/issue_vouchers/print.blade.php ENDPATH**/ ?>