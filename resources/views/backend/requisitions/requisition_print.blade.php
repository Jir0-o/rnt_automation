<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challan for Challan No- {{ $requisition->requisition_no }}</title>

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

    /* Watermark Style */
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
    .small-text {
    font-size: 14px; /* Adjust as needed */
    text-align: left;
    margin-top: -10px;
    }

    .footer-text {
    font-size: 11px; /* Adjust as needed */ 
    }

    </style>
</head>

<body>
    <!-- Watermark -->
    <div class="watermark">
        <img src="{{ asset('RNT-Logo.png') }}" alt="Watermark Logo">
    </div>
        <div class="container">
            <div class="header" style="display: flex; align-items: center; justify-content: space-between; text-align: center;">
                <!-- Left Section: Logo and Company Name -->
                <div style="display: flex; flex-direction: column; align-items: flex-start;">
                    <div style="display: flex; align-items: center;">
                        <div class="logo">
                            <img src="{{ asset('RNT-Logo.png') }}" alt="Logo" style="height: 50px; border-radius: 50%;">
                        </div>
                        <h1 style="margin: 0; margin-left: 10px;">RIZTU CORPORATION</h1>
                    </div>
                    <p style="font-size: 12px; margin-left: 70px; margin-top: 2px;">Be with us, be the best</p>
                </div>
        
                <!-- Right Section: CHALLAN -->
                <div class="display" style="border: 2px solid black; padding: 3px; font-weight: bold; border-radius: 5px;">
                    CHALLAN
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
                                    <strong>Buyer Name:</strong> {{ $requisition->buyer_name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0px 0px 5px;">
                                    <strong>Address:</strong> {{ $requisition->address }}
                                </td>
                            </tr>
                        </table>
                    </td>
    
                    @php
                        use Carbon\Carbon;
                    @endphp
    
                    <!-- Right Side -->
                    <td style="border: 1px solid black; padding: 0px; width: 50%; vertical-align: top;">
                        <table style="width: 100%; border-collapse: collapse; margin-top: 0px;">
                            <tr>
                                <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                    <strong>Date:</strong> {{ Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                    <strong>Challan No.:</strong> <span id="requisitionNo">{{ $requisition->requisition_no }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                    <strong>Purchase Order No:</strong> <!-- Add here -->
                                </td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                    <strong>S.R No: <span id="requisitionNo">{{ $requisition->sr_no }}</span></strong> <!-- Add here -->
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0px 0px 5px;">
                                    <strong>Challan Type:</strong> 
                                    @if ($requisition->requisition_type == 1)
                                        Cash Challan
                                    @elseif ($requisition->requisition_type == 2)
                                        Loan Challan
                                    @elseif ($requisition->requisition_type == 3)
                                        Sample Challan
                                    @endif
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
                        {{-- <th style="border: 1px solid black; padding: 8px;">Remarks</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $i = 1; 
                        $totalQuantity = 0;
                        $staticRowCount = 10; // Adjust this value for fixed empty rows
                        $dataCount = count($requisition->requisitionProducts);
                    @endphp
            
                    @foreach ($requisition->requisitionProducts as $requisition_product)
                        @php 
                            $quantityKg = $requisition_product->quantity * ($requisition_product->unit_package_size ?? 1); 
                            $totalQuantity += $quantityKg;
                        @endphp
                        <tr>
                            <td style="border: 1px solid black; padding: 8px;">{{ $i++ }}</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->product->product_name }}</td>
                            <td style="border: 1px solid black; padding: 8px;">{!! $requisition_product->spec ?? 'N/A' !!}</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->quantity ?? 'N/A' }}</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->unitType->name ?? 'N/A' }}</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->unit_package_size ?? 'N/A' }} KG</td>
                            <td style="border: 1px solid black; padding: 8px;">{{ $quantityKg }} KG</td>
                            {{-- <td style="border: 1px solid black; padding: 8px;">{{ strip_tags($requisition_product->remarks ?? 'N/A') }}</td> --}}
                        </tr>
                    @endforeach
            
                    {{-- <!-- Add Static Empty Rows -->
                    @for ($j = $dataCount; $j < $staticRowCount; $j++)
                        <tr>
                            <td style="border: 1px solid black; padding: 8px;">{{ $i++ }}</td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                            <td style="border: 1px solid black; padding: 8px;"></td>
                        </tr>
                    @endfor --}}
            
                    <!-- Total Row -->
                    <tr>
                        <td colspan="6" style="border: 1px solid black; text-align: right; font-weight: bold; padding: 8px;">Total</td>
                        <td colspan="7" style="border: 1px solid black; padding: 8px; font-weight: bold;">{{ $totalQuantity }} KG</td>
                    </tr>
                </tbody>
            </table>
    
            @if($requisition->status ==12 )
            <strong>
                <span class="return-reason" style="text-align: left; margin-top: 30px;">
                    Return Requisition Reason: {!! strip_tags($requisition->remarks ?? 'N/A') !!}
                </span>
            </strong>
            {{-- <Strong><p style="margin-top: -10px; margin-left: -100px;"> {!! $requisition->remarks ?? 'N/A' !!}</p></Strong> --}}
            @endif
            
            <p class="small-text" style="margin-top: 10px;">
                ➡ Received the above-mentioned products in good condition.
            </p>
            <p class="small-text">
                ➡ Sold Goods are not returnable or exchangeable.
            </p>
            <p class="small-text">
                ➡ No Claims will be entertained for shortages, etc. after acceptance/ delivery.
            </p>
    
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
                    @foreach ($requisition->requisitionSignatures as $requisition_signature)
                        <div style="margin-bottom: -25px;">
                            <!-- Signature Image -->
                            <img style="margin-bottom: -15px;" src="{{ asset('global_assets/user_images/signature/' . $requisition_signature->signature) }}" 
                                 alt="Signature" width="100"> <br>
                                <p style="margin-bottom: -15px;">{{ Carbon::parse($requisition_signature->date)->format('d-F-Y') }}<br></p> 
                                <p style="margin-bottom: -15px;"><strong>{{ $requisition_signature->name }}</strong><br></p> 
                                <p style="margin-bottom: -15px;">{{ $requisition_signature->designation }}<br></p> 
    
                            <p >___________________</p>
                            <!-- "For- RIZTU CORPORATION" below signature -->
                            <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                        </div>
                    @endforeach
                    @if (count($requisition->requisitionSignatures) == 0)
                        <div style="margin-bottom: auto;">
                            <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                                <p>_____________________</p>
                                <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
            
            
        
            <div class="footer footer-text" style="text-align: center;">
                <p><strong>Corporate Office:</strong> House - 32, Flat-A3(3rd floor),Gareeb-e-Newaz Avenue, Sector-11, Uttara, Dhaka-1230</p>
                <p style="margin-top: -10px"><strong>Registered Office:</strong>  577, Nolvog, Block-A, Nishat Nagar,Turag, Dhaka-1230</p>
                <p style="margin-top: -10px">Cell: +88 01719 182832, +88 01717 822605, E-mail: <a href="mailto:riztucorporation@gmail.com">riztucorporation@gmail.com</a></p>
            </div>
        </div>
</body>

</html>

<script>
window.print();
</script>