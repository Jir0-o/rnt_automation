<!doctype html>
<html lang="en">

<head>
    <title>Audit report</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .item-audit-report {
            background-color: #7abcde;
        }

        .item-audit-report table {
            border-color: #363636;
        }

        .item-audit-report tr,
        .item-audit-report td,
        .item-audit-report th {
            border-width: 1px;
        }

        .item-audit-report th,
        .item-audit-report td {
            border-color: #363636;
        }

        .header-audit {
            position: relative;
        }

        .header-audit img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
        }

        #page_number {
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            font-weight: 700;
            color: #363636;
        }

        .item-audit-report .btm-top {
            border-top: 1px dotted #363636;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
             @page {
                size: landscape;
            }
        }
    </style>
</head>

<body>
    <?php
        use \Carbon\Carbon;
    ?>
    <div class="destination-slider" id="auditTable">
        <div class="item-audit-report p-3">
            <div class="header-audit d-flex justify-content-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/db/Sheikh_Hasina_Medical_University%2C_Khulna_Logo.jpg"
                    alt="SHMU">
                <div class="header-audit-content text-center px-3">
                    <h3 class="ms-3">শেখ হাসিনা মেডিকেল ইউনিভার্সিটি, খুলনা</h3>
                    <p>স্টক রেজিস্টার</p>
                </div>
                <div id="page_number"><?php echo e($pageNumber); ?></div>
            </div>
            <div class="text-center">
                <p>দ্রব্যের নাম: <span class="btm-top"><?php echo e($product->product_name); ?></span></p>
            </div>
            <div>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th colspan="8" scope="col">গ্রহণ</th>
                            <th colspan="8" scope="col">বিতরণ</th>
                        </tr>
                        <tr>
                            <!-- store in data -->
                            <th scope="col">গ্রহণের তারিখ</th>
                            <th scope="col">পাওয়ার সূত্র <br> চালান নং ও তারিখ</th>
                            <th scope="col">বিবরণ</th>
                            <th scope="col">পরিমান</th>
                            <th scope="col">ইউনিট</th>
                            <th scope="col">দর</th>
                            <th scope="col">টাকার পরিমাণ</th>
                            <th scope="col">মন্তব্য</th>
                            <!-- store out data -->
                            <th scope="col">বিতরণের তারিখ</th>
                            <th scope="col">চাহিদাপত্রের <br> নম্বর</th>
                            <th scope="col">কোথায় প্রদত্ত হলো</th>
                            <th scope="col">পরিমান</th>
                            <th scope="col">মজুদের পরিমান</th>
                            <th scope="col">স্টোরে কীপারের স্বাক্ষর</th>
                            <th scope="col">স্টোরে অফিসারের স্বাক্ষর</th>
                            <th scope="col">মন্তব্য</th>
                        </tr>
                    </thead>

                    <?php if($leisureaccept->isEmpty() && $leisuredistribution->isEmpty()): ?>
                        <tr>
                            <td colspan="16">No data available</td>
                        </tr>
                    <?php else: ?>
                        <?php $__currentLoopData = $leisureaccept; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $accept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $distribution = $leisuredistribution[$index] ?? null;
                            ?>
                            <tr>
                                <td><?php echo e($accept->date); ?></td>
                                <td><?php echo e($accept->purchase_from); ?> <br> <?php echo e($accept->bill_no); ?> <br> <?php echo e(Carbon::parse($accept->date)->format('d-F-Y')); ?></td>
                                <td><?php echo e($accept->details); ?></td>
                                <td><?php echo e($accept->quantity); ?></td>
                                <td><?php echo e($unitType->name); ?></td>
                                <td><?php echo e($accept->price); ?></td>
                                <td><?php echo e($accept->amount); ?></td>
                                <td><?php echo e($accept->discussion); ?></td>

                                <?php if($distribution): ?>
                                    <td><?php echo e($distribution->date); ?></td>
                                    <td><?php echo e($distribution->requisition_no); ?></td>
                                    <td><?php echo e($distribution->place); ?></td>
                                    <td><?php echo e($distribution->quantity); ?></td>
                                    <td><?php echo e($distribution->total_quantity); ?></td>
                                    <td>
                                        <?php if($storeSignatures[$distribution->id]): ?>
                                            <img src="<?php echo e(asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id])); ?>"
                                                alt="Signature" width="50">
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($storeSignatures[$distribution->id]): ?>
                                            <img src="<?php echo e(asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id])); ?>"
                                                alt="Signature" width="50">
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($distribution->discussion); ?></td>
                                <?php else: ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = $leisuredistribution; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $distribution): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!isset($leisureaccept[$index])): ?>
                                <tr>
                                    <!-- Store in data (leisure_accept) -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <!-- Store out data (leisure_distribution) -->
                                    <td><?php echo e($distribution->date); ?></td>
                                    <td><?php echo e($distribution->requisition_no); ?></td>
                                    <td><?php echo e($distribution->place); ?></td>
                                    <td><?php echo e($distribution->quantity); ?></td>
                                    <td><?php echo e($distribution->total_quantity); ?></td>
                                    <td>
                                        <?php if($storeSignatures[$distribution->id]): ?>
                                            <img src="<?php echo e(asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id])); ?>"
                                                alt="Signature" width="50">
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($storeSignatures[$distribution->id]): ?>
                                            <img src="<?php echo e(asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id])); ?>"
                                                alt="Signature" width="50">
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($distribution->discussion); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </table>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
<?php /**PATH D:\laragon\www\RNT Automation\resources\views/backend/initiator_file/printAuditReport.blade.php ENDPATH**/ ?>