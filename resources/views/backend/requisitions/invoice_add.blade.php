@extends('layouts.master')
@section('content')
<div class="row mt-5">
    <div class="col-12 col-md-12">
        <div class="card card-default">
            <div class="card-body">
                <br>
                <form id="requisitions_submit">
                    <div class="row" id="sharock_name">
                    <div class="row">
                        <div class="col-6" >
                            <div class="mb-3">
                            <label for="requisition_no">Invoice No:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="requisition_no" id="requisition_no"
                                        placeholder="Enter Channal No"></input>
                                    <div class="input-group-append" style="margin-left: 5px;">
                                        <button type='button' class="btn btn-outline-secondary" id="auto-generate-btn"
                                            title="Auto Generate">
                                            <i class="fas fa-magic"></i>
                                            Generate
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger" id="requisition_noError"></span>
                        </div>
                    <br>
                        <div class="col-6" >
                            <div class="mb-3">
                                <label for="requisition_date">Invoice Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="requisition_date" id="requisition_date">
                                <span class="text-danger" id="requisition_dateError"></span>
                            </div>
                        </div>
                        <br>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Category">Select Challan</label>
                                <select id="Category-DropDown" name="Category-DropDown" class="form-control">
                                    @if($invoiceNo->isEmpty())
                                        <option value="">No available Challan to Create Invoice</option>
                                    @else
                                        <option value="">-- Select Challan --</option>
                                        @foreach($invoiceNo as $invoice)
                                            <option value="{{ $invoice->id }}">{{ $invoice->requisition_no }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="text-danger" id="CategoryError"></span>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="card card-default" id="requisition-details">
                        <div class="card-body">

                            <!-- Button Container with flexbox -->
                            <div class="d-flex justify-content-between" id="requisition_button">
                                <!-- Left side "Back" button -->
                                <button class="btn btn-secondary" type="button" id="back_button">
                                    <i class='bx bx-arrow-back' style="margin-left: -7px; margin-right: 3px;"></i>
                                    Back
                                </button>

                                <!-- Right side "Requisition" button -->
                                <button class="btn btn-primary" type="button" id="new_requisitions_submit">
                                    <i class='bx bx-plus' style="margin-left: -7px; margin-right: 3px;"></i>Create
                                </button>
                            </div>
                            <br>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#new_requisitions_submit').click(function () {
            let requisitionId = $('#Category-DropDown').val(); // Get selected requisition ID
            let invoiceNo = $('#requisition_no').val(); // Get invoice_no input
            let invoiceDate = $('#requisition_date').val(); // Get invoice_date input

            if (!requisitionId) {
                toastr.error("Please select a Challan before creating a requisition.");
                return;
            }

            $.ajax({
                url: "{{ route('get-invoice.update', ':id') }}".replace(':id', requisitionId),
                type: 'PUT', // Laravel update method
                data: {
                    _token: '{{ csrf_token() }}', // CSRF Token for security
                    invoice_no: invoiceNo,
                    invoice_date: invoiceDate
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Requisition updated successfully. Do you want to proceed?",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "Yes, Go to Invoice",
                        cancelButtonText: "Stay Here"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to invoice.show if confirmed
                            location.href = "{{ route('invoice.show', ':id') }}".replace(':id', requisitionId);
                        }
                    });
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    toastr.error("Error updating requisition. Please try again.");
                }
            });
        });

        $(document).on('click', '#back_button', function() {
            window.location.href = "{{ route('get-invoice.create') }}";
        });

        $('#auto-generate-btn').on('click', function() {
        $.ajax({
            url: "{{ route('invoice.generate') }}",
            type: 'GET',
            success: function(response) {
                console.log(response);
                
                // Ensure response contains 'invoice_no'
                if (response.success) {
                    $('#requisition_no').val(response.invoice_no); // Assign invoice_no to requisition_no field

                    Toastify({
                        text: "Invoice Number Generated Successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                } else {
                    $('#requisition_noError').text("Failed to generate invoice number.");
                }
            },
            error: function(xhr) {
                $('#requisition_noError').text("Error generating invoice number.");
            }
        });
    });

    });
</script>
@endsection