@extends('layouts.master')
@section('content')

<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        {{-- Requisitions --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Request Product List</h5>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade Requisitions" id="ShowReqProdust" tabindex="-1"
                        aria-labelledby="AllocationsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="AllocationsLabel">Product List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="Issue-Submit">
                                    <div class="modal-body">
                                        <div class="table-responsive text-nowrap p-3">
                                            <table id="Requisitions_Table" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Product Name</th>
                                                        <th>Product Specefication</th>
                                                        <th>Unit Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0" id="Allocations-Product-Table">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @can('Can Access Product Accept & Reject')
                                    <div class="modal-footer">
                                        <div id="AuthAcceptOrRejectButton">

                                        </div>
                                    </div>
                                    @endcan
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable1" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>User Name</th>
                                    <th>Recieved Date</th>
                                    <th>Billing No</th>
                                    <th>Purchase From</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product->recieve_date)->format('d-F-Y')}}</td>
                                    <td>{{ $product->bill_no}}</td>
                                    <td>{{ $product->purchase_from}}</td>
                                    <td>
                                        @if ($product->status == 0)
                                        <span class="badge bg-warning">Waiting For Approval</span>
                                        @elseif($product->status == 1)
                                        <span class="badge bg-success">Approved</span>
                                        @elseif($product->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                                <!-- accpect requisition -->
                                                <button type="button" class="btn btn-primary showRequestProductBtn"
                                                    data-id="{{ $product->id }}">
                                                    <i class="bx bx-show me-1"></i> Show
                                                </button>
                                                @if($product->status == 0)
                                                @can('Can Access Product Accept & Reject')
                                                <button type="button" class="btn btn-success acceptProductBtn"
                                                    data-id="{{ $product->id }}">
                                                    <i class="bx bx-check me-1"></i>Approve
                                                </button>
                                                <button type="button" class="btn btn-danger rejectProductBtn"
                                                    data-id="{{ $product->id }}">
                                                    <i class="bx bx-x me-1"></i>Reject
                                                </button>
                                                @endcan
                                                @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--/ Permissions -->
            </div>
        </div>


<script>
$(document).ready(function() {
    $('#Requisitions_Table').DataTable();


    $(document).on('click', '.acceptProductBtn', function() {
        var product_id = $(this).data('id');
        $.ajax({
            url: "{{ route('product-accept.accept', ':id') }}".replace(':id', product_id),
            method: 'GET',
            success: function(response) {
                if (response.status == true) {
                    setTimeout(() => {
                        Toastify({
                            text: "Product Approved Successfully",
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();
                        location.reload();
                    }, 1000);
                } else {
                    console.log(response.data);
                    toastr.error('Failed to approve product');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to accept product:', error);
                toastr.error('Failed to accept product');
            }
        });
    });

    // Use event delegation to handle reject button clicks
    $(document).on('click', '.rejectProductBtn', function() {
        var product_id = $(this).data('id');
        $.ajax({
            url: "{{ route('product-reject.reject', ':id') }}".replace(':id', product_id),
            method: 'GET',
            success: function(response) {
                if (response.status == true) {
                    setTimeout(() => {
                        Toastify({
                            text: "Product Rejected Successfully",
                            duration: 3000,
                            gravity: "top",
                            position: 'right',
                            backgroundColor: "#228B22",
                            stopOnFocus: true,
                        }).showToast();
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error('Failed to reject product');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to reject product:', error);
                toastr.error('Failed to reject product');
            }
        });
    });

    $(document).on('click', '.showRequestProductBtn', function() {
        var request_id = $(this).data('id');
        $.ajax({
            url: "{{ route('received-products.show', ':id') }}".replace(':id',
                request_id),
            type: 'GET',
            success: function(response) {
                let serial = 1; // Start serial from 1
                $('#Allocations-Product-Table').empty();
                response.data.forEach(receivedProduct => {
                    $('#Allocations-Product-Table').append(`
            <tr>
                <td>${serial}</td>
                <td>${receivedProduct.product.product_name}</td>
                <td>${receivedProduct.product.spec}</td>
                <td>${receivedProduct.unit_price}</td>
                <td>${receivedProduct.quantity}</td>
                <td>${receivedProduct.total_price}</td>
            </tr>
        `);
                    serial++;
                });
                $('#Authnotes').val(response.requisition ? response.requisition
                    .remarks : '');

                    if(response.requisition.status == 0){
                        
                        $('#AuthAcceptOrRejectButton').empty();
                        $('#AuthAcceptOrRejectButton').append(`
                <button type="button" class="btn btn-success acceptProductBtn"
                    data-id="${request_id}" data-bs-dismiss="modal">Accept</button>
                <button type="button" class="btn btn-danger rejectProductBtn"
                    data-id="${request_id}">Reject</button>
            `);
        }else{
            $('#AuthAcceptOrRejectButton').empty();
        }
                $('#ShowReqProdust').modal('show');
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

});
</script>
@endsection
