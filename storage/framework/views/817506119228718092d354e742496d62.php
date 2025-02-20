
<?php $__env->startSection('content'); ?>
    <style>
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
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: end;
        }

        .signature div {
            width: 50%;
            text-align: center;
        }
    </style>

    <div class="card font-nikosh">
        <div class="container py-5">
            <div class="text-center">
                <img width="65px" src="<?php echo e(asset('Sheikh_Hasina_Medical_University,_Khulna_Logo.png')); ?>" alt="Logo"
                    class="img">

                <h1>শেখ হাসিনা মেডিকেল বিশ্ববিদ্যালয়, খুলনা</h1>
                <p>ঠিকানা: অস্থায়ী অফিস: হোল্ডিং নং-০৮, রোড নং-০১, নিরালা রেসিডেনশিয়াল এরিয়া, খুলনা-৯১০০</p>
                <p>ই-মেইল: shmu.khulna2021@gmail.com</p>
                <p>ওয়েবসাইট: www.shmu.ac.bd</p>
                <h3 class="pt-4"><?php echo e($committee->name); ?></h3>
            </div>
            <hr>
            <div class="content">
                <p><strong>Referance ID:</strong> <?php echo e($committee->reference_no); ?></p>

                <!-- Add class="table" to apply styles -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ক্র: নং</th>
                            <th>পণ্যের নাম</th>
                            <th>পরিমান</th>
                            <th>একক</th>
                            <th>স্পেসিফিকেশন</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $productCommittees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td> <!-- Corrected to show serial number -->
                                <td><?php echo e($product->product->product_name); ?></td>
                                <td><?php echo e($product->quantity); ?></td>
                                <td><?php echo e($product->product->unitType->name); ?></td>
                                <td><?php echo $product->note; ?></td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <br>
                <br>
                <br>
                <!-- //Secretary Signature, Chairman Signature, VC Signature -->
                <div class="signature">
                    <!-- Secretary Signature -->
                    <div class="text-center">
                        <?php if($committeeSignatures->secretary): ?>
                            <img src="<?php echo e(asset('/global_assets/user_images/signature/' . $committeeSignatures->secretary)); ?>"
                                alt="Secretary Signature" style="width: 100px;">
                        <?php else: ?>
                            <p>Signature not available</p>
                        <?php endif; ?>
                        <br> সচিবের স্বাক্ষর <br>

                        
                        <?php echo e($committeeSignatures->secretary_date ? \Carbon\Carbon::parse($committeeSignatures->secretary_date)->format('d-F-Y') : ''); ?><br>

                        
                        <strong><?php echo e($committeeSignatures->secretary_name); ?></strong>
                        <br>
                        <?php echo e($committeeSignatures->secretary_designation); ?>

                        <br>
                        <?php echo e($committeeSignatures->secretary_dept); ?>

                        



                    </div>

                    <!-- Chairman Signature -->
                    <div class="text-center">
                        <?php if($committeeSignatures->chairman): ?>
                            <img src="<?php echo e(asset('/global_assets/user_images/signature/' . $committeeSignatures->chairman)); ?>"
                                alt="Chairman Signature" style="width: 100px;">
                        <?php else: ?>
                            <p></p>
                        <?php endif; ?>
                        <br> চেয়ারম্যানের স্বাক্ষর <br>

                        
                        <?php echo e($committeeSignatures->chairman_date ? \Carbon\Carbon::parse($committeeSignatures->chairman_date)->format('d-F-Y') : ''); ?><br>
                        
                        <strong><?php echo e($committeeSignatures->chairman_name); ?></strong>
                        <br>
                        <?php echo e($committeeSignatures->chairman_designation); ?>

                        <br>
                        <?php echo e($committeeSignatures->chairman_dept); ?>

                    </div>

                    <!-- Vice Chancellor Signature -->
                    <div class="text-center">
                        <?php if($committeeSignatures->vc): ?>
                            <img src="<?php echo e(asset('/global_assets/user_images/signature/' . $committeeSignatures->vc)); ?>"
                                alt="VC Signature" style="width: 100px;">
                        <?php else: ?>
                            <p></p>
                        <?php endif; ?>
                        <br> ভাইস চ্যান্সেলরের স্বাক্ষর <br>

                        
                        <?php echo e($committeeSignatures->vc_date ? \Carbon\Carbon::parse($committeeSignatures->vc_date)->format('d-F-Y') : ''); ?><br>
                        <strong><?php echo e($committeeSignatures->vc_name); ?></strong>
                        <br>
                        <?php echo e($committeeSignatures->vc_designation); ?>

                        <br>
                        <?php echo e($committeeSignatures->vc_dept); ?>

                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary mt-3">
                    <i class="fas fa-arrow-left mx-1"></i> Back
                </a>
                <?php
                    $buttonShown = false;
                    // dd($committee);
                ?>

                <!-- Check if the "Send" button should be displayed -->


                <?php $__currentLoopData = $productCommittees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productCommittee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Your other code for the loop -->
                    
                    <!-- Display the "Approve" button if the status is not 3 and only once -->
                    <?php if(Auth::user()->designation_id == 3 &&
                            !$buttonShown &&
                            $committee->status != 6 &&
                            $committeeSignatures->is_active == 1): ?>
                        
                        <a href="<?php echo e(route('approve.oce', $committee->requisition_id)); ?>" class="approve-link approve-btn">
                            <button class="btn btn-primary me-2"><i
                                    class="menu-icon tf-icons bx bx-check"></i>Approve</button>
                        </a>

                        <?php
                            //  dd($productCommittee->status);
                            $buttonShown = true; // Set the flag to true so the button won't be shown again
                        ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(Auth::user()->designation_id == 3 && $committeeSignatures->is_active == 1 && !$buttonShown): ?>
                    <div class="text-center mt-4">
                        <form action="<?php echo e(route('committee.send', [$committee->id, $committeeSignatures->id])); ?>"
                            method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success float-end">Send</button>
                        </form>
                    </div>
                <?php endif; ?>


                <?php if($committee->status == 3 && Auth::id() == $committee->secretary): ?>
                    <div class="text-center mt-4">
                        
                            
                            <a href="<?php echo e(route('oce.send', ['id' => $committee->requisition_id])); ?>">
                                <button type="submit" class="btn btn-success">Send</button>
                            </a>

                        
                    </div>
                <?php elseif($committee->status == 4 && Auth::id() ==  $committee->chairman_id): ?>
                    <div class="text-center mt-4">
                        
                            
                           <a href="<?php echo e(route('oce.send', ['id' => $committee->requisition_id])); ?>">
                                <button type="submit" class="btn btn-success">Send</button>
                            </a>
                        
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/OCEcommittee_report.blade.php ENDPATH**/ ?>