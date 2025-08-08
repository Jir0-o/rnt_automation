<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order number <?php echo e($requisition->order_no); ?></title>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 20px;
        text-align: center;
    }
    .container {
        width: 80%;
        margin: auto;
        border: 2px solid #fff;
        padding: 20px;
    }
    h1 {
        margin: 0;
    }
    .title {
        font-size: 18px;
        font-style: italic;
        text-decoration: underline;
    }
    .details {
        text-align: left;
        margin-top: 10px;
        font-size: 14px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    table, th, td {
        border: 1px solid #fff;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    .total {
        font-weight: bold;
    }
    
    .watermark {

    position: fixed;

    top: 40%;

    left: 50%;

    transform: translate(-50%, -50%);

    opacity: 0.2; /* Increased opacity */

    z-index: -1; /* Ensure the watermark is behind the content */

    }

    .watermark img {

    width: 300px; /* Adjust the size of the watermark */

    height: 300px; /* Ensure the height matches the width for a perfect circle */

    border-radius: 50%; /* Make the image round */

    object-fit: cover; /* Ensure the image fits within the circle */

    }
    .signature {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
    }
    .signature div {
        text-align: center;
        flex: 1;
    }
    .footer {
        margin-top: 20px;
        font-size: 12px;
    }
    .footer a {
        color: #00f;
        text-decoration: none;
    }
    .note {
        font-size: 12px;
        margin-top: 10px;
    }
</style>

<div class="watermark">

    <img src="<?php echo e(asset('RNT-Logo.png')); ?>" alt="Watermark Logo">

</div>

<div class="card">
<div class="container">
    <div class="header" style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
        <!-- Left Section: Logo and Company Name -->
        <div style="display: flex; flex-direction: column; align-items: flex-start;">
            <div style="display: flex; align-items: center;">
                <div class="logo">
                    <img src="<?php echo e(asset('RNT-Logo.png')); ?>" alt="Logo" style="height: 50px; border-radius: 50%;">
                </div>
                <h1 style="margin: 0; margin-left: 10px;">RIZTU CORPORATION</h1>
            </div>
            <p style="font-size: 12px; margin-left: 70px; margin-top: 2px;">Be with us, be the best</p>
        </div>

        <!-- Right Section: CHALLAN -->
        <div class="display" style="border: 2px solid black; padding: 3px; font-weight: bold; border-radius: 5px;">
            ORDER
        </div>
    </div> 


        <!-- Divider Line -->
        <hr style="border: 1px solid black; margin-top: 10px; margin-bottom: 10px;">

        <!-- Table for Buyer Name, Address, Date, Challan No, Purchase Order No, and S.R No -->
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black; margin-top: 10px;">
            <tr>
                <!-- Left Side -->
                <td style="border: 1px solid black; padding: 0px; width: 50%; vertical-align: top;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Buyer Name:</strong> <?php echo e($requisition->buyer_name); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0px 0px 5px;">
                                <strong>Address:</strong> <?php echo e($requisition->address); ?>

                            </td>
                        </tr>
                    </table>
                </td>

                <?php
                    use Carbon\Carbon;
                ?>

                <!-- Right Side -->
                <td style="border: 1px solid black; padding: 0px; width: 50%; vertical-align: top;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Date:</strong> <?php echo e(Carbon::parse($requisition->order_date)->format('d-F-Y')); ?>

                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Order No: <span id="requisitionNo"><?php echo e($requisition->order_no); ?></span></strong> <!-- Add here -->
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 0px 0px 5px;">
                                <strong>Order Type:</strong> 
                                <?php if($requisition->order_type == 1): ?>
                                    Cash Order
                                <?php elseif($requisition->order_type == 2): ?>
                                    Loan Order
                                <?php elseif($requisition->order_type == 3): ?>
                                    Sample Order
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    
        <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 8px;">S.L</th>
                    <th style="border: 1px solid black; padding: 8px;">Product Name</th>
                    <th style="border: 1px solid black; padding: 8px;">Product Description</th>
                    <th style="border: 1px solid black; padding: 8px;">Unit</th>
                    <th style="border: 1px solid black; padding: 8px;">Type</th>
                    <th style="border: 1px solid black; padding: 8px;">Package Size</th>
                    <th style="border: 1px solid black; padding: 8px;">Quantity (Kg)</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1; 
                    $totalQuantity = 0;
                    $staticRowCount = 10; // Adjust this value for fixed empty rows
                    $dataCount = count($requisition->orderProducts);
                ?>
        
                <?php $__currentLoopData = $requisition->orderProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requisition_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php 
                        $quantityKg = $requisition_product->quantity * ($requisition_product->unit_package_size ?? 1); 
                        $totalQuantity += $quantityKg;
                    ?>
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($i++); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->product->product_name); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo $requisition_product->spec ?? 'N/A'; ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->quantity ?? 'N/A'); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->unitType->name ?? 'N/A'); ?></td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($requisition_product->unit_package_size ?? 'N/A'); ?> KG</td>
                        <td style="border: 1px solid black; padding: 8px;"><?php echo e($quantityKg); ?> KG</td>
                        
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                
        
                <!-- Total Row -->
                <tr>
                    <td colspan="6" style="border: 1px solid black; text-align: right; font-weight: bold; padding: 8px;">Total</td>
                    <td colspan="7" style="border: 1px solid black; padding: 8px; font-weight: bold;"><?php echo e($totalQuantity); ?> KG</td>
                </tr>
            </tbody>
        </table>

        <?php if($requisition->status ==12 ): ?>
        <strong>
            <span class="return-reason" style="text-align: left; margin-top: 30px;">
                Return Requisition Reason: <?php echo strip_tags($requisition->remarks ?? 'N/A'); ?>

            </span>
        </strong>
        
        <?php endif; ?>
        
        <p style="text-align: left; margin-top: 10px;">➡Received the above-mentioned products in good condition.</p>
        <p style="text-align: left; margin-top: -10px;">➡Sold Goods are not returnable or exchangeable.</p>
        <p style="text-align: left; margin-top: -10px;">➡No Claims will be entertained for shortages, etc. after acceptance/ delivery.</p>

        <!-- Divider Line -->
        <hr style="border: 1px solid black; margin-top: 10px; margin-bottom: 0px;">
        
    
        <div class="signatures" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>__________________</p>
                        <p><em>Received by</em></p>
                    </p>
                </div>
            </div>
        
            <!-- Store in Charge -->
            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>__________________</p> <!-- Underline moved above -->
                        <p><em>Store in Charge</em></p>
                    </p>
                </div>
            </div>

            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>__________________</p> <!-- Underline moved above -->
                        <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                    </p>
                </div>
            </div>
        </div>
        
        
    
        <div class="footer" style="text-align: center;">
            <p><strong>Corporate Office:</strong> House - 32, Flat-A3(3rd floor),Gareeb-e-Newaz Avenue, Sector-11, Uttara, Dhaka-1230</p>
            <p style="margin-top: -10px"><strong>Registered Office:</strong>  577, Nolvog, Block-A, Nishat Nagar,Turag, Dhaka-1230</p>
            <p style="margin-top: -10px">Cell: +88 01719 182832, +88 01717 822605, E-mail: <a href="mailto:riztucorporation@gmail.com">riztucorporation@gmail.com</a></p>
        </div>
    </div>

</body>



</html>
 <script>

    window.print();
    
</script><?php /**PATH C:\xampp\htdocs\RNT Automation\RNT Automation\resources\views/backend/order/orderPrint.blade.php ENDPATH**/ ?>