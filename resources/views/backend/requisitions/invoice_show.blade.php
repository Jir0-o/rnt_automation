@extends('layouts.master')
@section('content')
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
        position: absolute;
        top: 60%;
        left: 60%;
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
</style>

{{-- <div class="card">
    <!-- Modal Structure -->
<div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="returnModalLabel">Return Requisition</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Textbox for user's input -->
                <textarea id="returnReason" name="newreturn-text" class="form-control" rows="5" placeholder="Enter reason for returning"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitReturn">Send</button>
            </div>
        </div>
    </div>
</div> --}}

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
                INVOICE
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
                                <strong>Date:</strong> {{ Carbon::parse($requisition->invoice_date)->format('d-F-Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Invoice No.:</strong> <span id="invoiceNo">{{ $requisition->invoice_no }}</span>
                                @if ($requisition->status == 0 || $requisition->status == 1)
                                    <button id="editInvoiceNo" class="btn btn-sm btn-link"><i class="bx bx-edit"></i></button>
                                    <button id="cancelEditInvoiceNo" class="btn btn-sm btn-link" style="display: none;"><i class="bx bx-x"></i></button>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid black; padding: 0px 0px 0px 5px;">
                                <strong>Order No:</strong><span id="orderNo">{{ $requisition->order_no ? $requisition->order_no : '' }}</span> 
                                <button id="editOrderNo" class="btn btn-sm btn-link"><i class="bx bx-edit"></i></button>
                                <button id="cancelEditOrderNo" class="btn btn-sm btn-link" style="display: none;"><i class="bx bx-x"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px 0px 5px;">
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
                    <th style="border: 1px solid black; padding: 8px;">Quantity (Kg)</th>
                    <th style="border: 1px solid black; padding: 8px;">Unit</th>
                    <th style="border: 1px solid black; padding: 8px;">Unit Price Tk</th>
                    <th style="border: 1px solid black; padding: 8px;">Total Tk</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $i = 1; 
                    $totalQuantity = 0;
                    $totalAmount = 0;
                @endphp
        
                @foreach ($requisition->requisitionProducts as $requisition_product)
                    @php 
                        $quantityKg = $requisition_product->quantity * ($requisition_product->unit_package_size ?? 1); 
                        $totalQuantity += $quantityKg;
                        $totalAmount += $requisition_product->unit_price * $requisition_product->quantity;
                    @endphp
                    <tr>
                        <td style="border: 1px solid black; padding: 8px;">{{ $i++ }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->product->product_name }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $quantityKg }} KG</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->quantity ?? 'N/A' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->unit_price ?? 'N/A' }}</td>
                        <td style="border: 1px solid black; padding: 8px;">{{ $requisition_product->unit_price * $requisition_product->quantity }}</td> 
                    </tr>
                @endforeach
                
                <tr>
                    <td colspan="2" style="border: 1px solid black; text-align: right; font-weight: bold; padding: 8px;">Total</td>
                    <td style="border: 1px solid black; padding: 8px; font-weight: bold;">{{ $totalQuantity }} KG</td>
                    <td style="border: 1px solid black; padding: 8px;"></td>
                    <td style="border: 1px solid black; padding: 8px;"></td>
                    <td style="border: 1px solid black; padding: 8px; font-weight: bold;">{{ $totalAmount }} TK</td>
                </tr>
            </tbody>
        </table>
        
        <strong>
            <p class="amount-in-words small-text" style="text-align: left; margin-top: 10px; font-weight: bold;">
                AMOUNT IN WORDS: {{ convertNumberToWords($totalAmount) }}
            </p>
        </strong>
        
        <p class="small-text" style="text-align: left; margin-top: 10px;">➡Received the above-mentioned products in good condition.</p>
        <p class="small-text" style="text-align: left; margin-top: -10px;">➡Sold Goods are not returnable or exchangeable.</p>
        <p class="small-text" style="text-align: left; margin-top: -10px;">➡No Claims will be entertained for shortages, etc. after acceptance/ delivery.</p>

        <!-- Divider Line -->
        <hr style="border: 1px solid black; margin-top: 10px; margin-bottom: 0px;">
        
    
        <div class="signatures" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>______________________</p>
                        <p><em>Received by</em></p>
                    </p>
                </div>
            </div>
        
            <!-- Store in Charge -->
            <div class="signature" style="text-align: center; flex: 1;">
                <div style="margin-bottom: auto;">
                    <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                        <p>______________________</p> <!-- Underline moved above -->
                        <p><em>Store in Charge</em></p>
                    </p>
                </div>
            </div>
        
            <div class="signature" style="text-align: center; flex: 1;">
                @foreach ($requisition->requisitionSignatures as $requisition_signature)
                    <div style="margin-bottom: auto;">  <!-- Ensures each signature is separate -->
                        <!-- Signature Image -->
                        <img src="{{ asset('global_assets/user_images/signature/' . $requisition_signature->signature) }}" 
                             alt="Signature" width="100"> <br>
                             {{ Carbon::parse($requisition_signature->date)->format('d-F-Y') }}<br>
                             <strong>{{ $requisition_signature->name }}</strong><br>
                             {{ $requisition_signature->designation }}<br>

                        <p>______________________</p>
                        <!-- "For- RIZTU CORPORATION" below signature -->
                        <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                    </div>
                @endforeach
                @if (count($requisition->requisitionSignatures) == 0)
                    <div style="margin-bottom: auto;">
                        <p class="flex-container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 100px;">
                            <p>______________________</p>
                            <p><em>For- <strong>RIZTU CORPORATION</strong></em></p>
                        </p>
                    </div>
                @endif
            </div>
        </div>
        
        
    
        <div class="footer" style="text-align: center;">
            <p><strong>Corporate Office:</strong> House - 32, Flat-A3(3rd floor),Gareeb-e-Newaz Avenue, Sector-11, Uttara, Dhaka-1230</p>
            <p style="margin-top: -10px"><strong>Registered Office:</strong>  577, Nolvog, Block-A, Nishat Nagar,Turag, Dhaka-1230</p>
            <p style="margin-top: -10px">Cell: +88 01719 182832, +88 01717 822605, E-mail: <a href="mailto:riztucorporation@gmail.com">riztucorporation@gmail.com</a></p>
        </div>
    </div>
    

        <!-- Left side container for the Back button -->
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <button class="btn btn-secondary" type="button" id="back_button">
                    <i class='bx bx-arrow-back' style="margin-left: -7px; margin-right: 3px;"></i> Back
                </button>
            </div>

            <!-- Right side container for the Send button -->
            @if ($requisition->status == 1)
            <div>
                <a href="{{ route('invoice.print', $requisition->id) }}" class="" target="_blank">
                    <button type="button" class="btn btn-success printInvoiceBtn" data-id="{{ $requisition->id }}"
                        style="margin-right: 20px;">
                        <i class="bx bx-printer me-1"></i> Print
                    </button>
                </a>
            </div>
            @endif
            {{-- @if ($requisition->status == 1)
            <button type="button" class="btn btn-warning editInvoiceBtn" data-id="{{ $requisition->id }}" style="margin-right:5px;">
            <i class="bx bx-edit me-1"></i> Edit
            </button> 
            @endif --}}
        </div>


        <script>
        $(document).ready(function() {

            var originalInvoiceNo = $('#invoiceNo').text().trim();
            var cancelEdit = false;
            // Handle edit button click
            $('#editInvoiceNo').on('click', function() {
                var invoiceNo = $('#invoiceNo').text().trim();
                $('#invoiceNo').html(
                    '<input type="text" id="invoiceNoInput" class="form-control form-control-sm" value="' +
                    invoiceNo + '">');
                $('#editInvoiceNo').hide();
                $('#cancelEditInvoiceNo').show();

                // Automatically focus the input field
                $('#invoiceNoInput').focus();

                // Handle the blur event or pressing Enter to save the new value
                $('#invoiceNoInput').on('blur', function() {
                    if (cancelEdit) {
                        cancelEdit = false;
                        return;
                    }

                    var updatedInvoiceNo = $(this).val().trim();

                    // Get the current URL
                    var currentUrl = window.location.href;

                    // Use a regular expression to extract the ID
                    var id = currentUrl.match(/invoice\/(\d+)/)[1];
                    var invoice_id = id;

                    // Send an AJAX request to update the requisition number
                    $.ajax({
                        url: "{{ route('invoice.number.update', ':id') }}".replace(
                            ':id',
                            invoice_id),
                        type: 'PUT',
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        data: {
                            invoice_no: updatedInvoiceNo,
                        },
                        success: function(response) {
                            if (response.status) {
                                Toastify({
                                    text: "Invoice Number Updated Successfully",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#228B22",
                                    stopOnFocus: true,
                                }).showToast();

                                $('#invoiceNo').text(response.data
                                    .invoice_no);
                                originalInvoiceNo = response.data
                                    .invoice_no;

                                $('#editInvoiceNo').show();
                                $('#cancelEditInvoiceNo').hide();
                            } else {
                                Toastify({
                                    text: response.message ||
                                        "Failed to update invoice number.",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#FF6347", // red color for errors
                                    stopOnFocus: true,
                                }).showToast();
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = "An error occurred.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.status === 422 && xhr.responseJSON
                                .errors) {
                                errorMessage = xhr.responseJSON.errors
                                    .requisition_no[0];
                            }

                            Toastify({
                                text: errorMessage,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#FF6347", // red color for errors
                                stopOnFocus: true,
                            }).showToast();

                            console.error('Error updating invoice number:', xhr
                                .responseText);
                        }
                    });
                });

                $('#invoiceNoInput').on('keypress', function(e) {
                    if (e.which == 13) { // Enter key pressed
                        $(this).blur();
                    }
                });
            });
            // Handle cancel button click
            $('#cancelEditInvoiceNo').on('click', function() {
                cancelEdit = true;
                $('#invoiceNo').text(originalInvoiceNo);
                $('#editInvoiceNo').show();
                $('#cancelEditInvoiceNo').hide();
            });

            var originalOrderNo = $('#orderNo').text().trim();
            // Handle edit button click
            $('#editOrderNo').on('click', function() {
                var orderNo = $('#orderNo').text().trim();
                $('#orderNo').html(
                    '<input type="text" id="orderNoInput" class="form-control form-control-sm" value="' +
                    orderNo + '">');
                $('#editOrderNo').hide();
                $('#cancelEditOrderNo').show();

                // Automatically focus the input field
                $('#orderNoInput').focus();

                // Handle the blur event or pressing Enter to save the new value
                $('#orderNoInput').on('blur', function() {
                    if (cancelEdit) {
                        cancelEdit = false;
                        return;
                    }

                    var updatedOrderNo = $(this).val().trim();

                    // Get the current URL
                    var currentUrl = window.location.href;

                    // Use a regular expression to extract the ID
                    var id = currentUrl.match(/invoice\/(\d+)/)[1];
                    var order_id = id;

                    // Send an AJAX request to update the requisition number
                    $.ajax({
                        url: "{{ route('order.number.update', ':id') }}".replace(
                            ':id',
                            order_id),
                        type: 'PUT',
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        data: {
                            order_no: updatedOrderNo,
                        },
                        success: function(response) {
                            if (response.status) {
                                Toastify({
                                    text: "Order Number Updated Successfully",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#228B22",
                                    stopOnFocus: true,
                                }).showToast();

                                $('#orderNo').text(response.data
                                    .order_no);
                                originalOrderNo = response.data
                                    .order_no;

                                $('#editOrderNo').show();
                                $('#cancelEditOrderNo').hide();
                            } else {
                                Toastify({
                                    text: response.message ||
                                        "Failed to update order number.",
                                    duration: 3000,
                                    gravity: "top",
                                    position: 'right',
                                    backgroundColor: "#FF6347", // red color for errors
                                    stopOnFocus: true,
                                }).showToast();
                            }
                        },
                        error: function(xhr) {
                            let errorMessage = "An error occurred.";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.status === 422 && xhr.responseJSON
                                .errors) {
                                errorMessage = xhr.responseJSON.errors
                                    .requisition_no[0];
                            }

                            Toastify({
                                text: errorMessage,
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#FF6347", // red color for errors
                                stopOnFocus: true,
                            }).showToast();

                            console.error('Error updating order number:', xhr
                                .responseText);
                        }
                    });
                });

                $('#orderNoInput').on('keypress', function(e) {
                    if (e.which == 13) { // Enter key pressed
                        $(this).blur();
                    }
                });
            });
            // Handle cancel button click
            $('#cancelEditOrderNo').on('click', function() {
                cancelEdit = true;
                $('#orderNo').text(originalOrderNo);
                $('#editOrderNo').show();
                $('#cancelEditOrderNo').hide();
            });
    });
        
</script>
@endsection