@extends('layouts.master')
@section('content')

<style>
    .cke_notification_message {
    display: none !important;
}

.cke_notifications_area {
    display: none !important;
}
</style>

{{-- {{ dd($user_id) }}  --}}
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        {{-- Requisitions --}}
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Order List</h5>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="float-end">
                            <!-- Button trigger modal -->
                            <button type="button" id="create_requisitions" class="btn btn-primary"
                                data-bs-toggle="modal" data-bs-target="#Requisitions">
                                <i class="bx bx-edit-alt me-1"></i> Create Order
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade Requisitions" id="RequisitionShow" tabindex="-1"
                        aria-labelledby="RequisitionsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RequisitionsLabel">Requisition Product List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive text-nowrap p-3">
                                        <table id="Requisitions_Table" class="table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product Name</th>
                                                    <th>Requisition Quantity</th>
                                                    <th>Allocated Quantity</th>
                                                    <th>Specification</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0" id="Requisitions-Product-Table">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <p>Notes: </p>
                                        <textarea name="notes" id="notes" cols="4" rows="2" class="form-control"
                                            disabled></textarea>
                                    </div>
                                    <br>
                                    @if (Auth::user()->can('Can Access Requisitions Accept and Reject'))
                                    <div class="modal-footer" id="acceptOrRejectButton">

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade Requisitions" id="AuthRequisitionShow" tabindex="-1"
                        aria-labelledby="RequisitionsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="RequisitionsLabel">Requisition Product List</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive text-nowrap p-3">
                                        <table id="datatable7" class="table">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Specification</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0" id="AuthRequisitions-Product-Table">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <p>Notes: </p>
                                        <textarea name="notes" id="Authnotes" cols="4" rows="2" class="form-control"
                                            disabled></textarea>
                                    </div>
                                    <br>
                                    <div class="modal-footer" id="AuthAcceptOrRejectButton">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Nav tabs -->
            <div class="container">
                <div class="row justify-content-center">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                                type="button" role="tab" aria-controls="all" aria-selected="false">
                                All Order
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">
                                Pending Order
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="accepted-tab" data-bs-toggle="tab" data-bs-target="#accepted"
                                type="button" role="tab" aria-controls="accept" aria-selected="false">
                                Accepted Order
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected"
                                type="button" role="tab" aria-controls="rejected" aria-selected="false">
                                Rejected Order
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="loan-req-tab" data-bs-toggle="tab" data-bs-target="#loan"
                                type="button" role="tab" aria-controls="loan" aria-selected="false">
                                Loan Order
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="save-draft" data-bs-toggle="tab" data-bs-target="#save"
                                type="button" role="tab" aria-controls="save" aria-selected="false">
                                Draft Order
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="return-req-tab" data-bs-toggle="tab" data-bs-target="#return"
                                type="button" role="tab" aria-controls="return" aria-selected="false">
                                Return Order
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
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
                            <textarea id="returnReason" name="return-text" class="form-control" rows="5" placeholder="Enter reason for returning"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitReturn">Send</button>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- Tab panes -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable1" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($order as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->order_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->order_no }}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        @if ($requisition->status == 12 || $requisition->status == 13 || $requisition->status == 11)
                                        <button type="button" class="btn btn-warning editReturnRequisitionBtn" data-id="{{ $requisition->id }}" style="margin-right:5px;">
                                        <i class="bx bx-edit me-1"></i> Edit
                                        </button> 
                                        @endif
                                        @if($requisition->status == 13 || $requisition->status == 11)
                                        <button type="button" class="btn btn-success sendRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:5px;">
                                            <i class="bx bx-send me-1"></i> Send
                                        </button>
                                        @endif
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>

                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable2" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            @php
                            $user_id = auth()->user()->id;
                            $user = \App\Models\User::where('id', $user_id)->first();
                            
                                $department = \App\Models\Department::where('id', $user->department_id)->first();
                                $department_head = \App\Models\User::where('id', $department->head_id)->first();
                                $designation = \App\Models\Designation::where('id', $department_head->designation_id)->first();
                           
                            @endphp
                            {{-- {{dd ($designation)}} --}}
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($pendingOrder as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class=" showAuthrequisitionBtn btn btn-primary"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>

                                        </a>
                                        @if (Auth::id() == $requisition->user->auth_by)
                                        @if ($requisition->status == 0)
                                        <button type="button" class="acceptAuthrequisitionBtn btn btn-success"
                                            data-id="{{ $requisition->id }}">
                                            <i class="bx bx-check me-1"></i> Accept
                                        </button>
                                        @endif
                                        @if ($requisition->status == 0)
                                        <button type="button" class=" rejectrequisitionBtn btn btn-danger"
                                            data-id="{{ $requisition->id }}">
                                            <i class="bx bx-x me-1"></i> Reject
                                        </button>
                                        @endif
                                        @if ($requisition->status == 0)
                                        <button type="button" class=" returnrequisitionBtn btn btn-warning"
                                            data-id="{{ $requisition->id }}">
                                            <i class="bx bx-undo me-1"></i> Return
                                        </button>
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable3" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($acceptOrder as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        @if ($requisition->status == 1)
                                        <button type="button" class="btn btn-primary showInvoiceBtn"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-receipt me-1"></i> Invoice
                                        </button>
                                        @endif
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable4" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($rejectOrder as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary showrequisitionBtn"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="save" role="tabpanel" aria-labelledby="save-draft">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable5" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($loanOrder as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class=" showAuthrequisitionBtn btn btn-primary"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-success sendRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:2px;">
                                            <i class="bx bx-send me-1"></i> Send
                                        </button>
                                        <button type="button" class="btn btn-warning editReturnRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:5px;">
                                            <i class="bx bx-edit me-1"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger deleteReturnRequisitionBtn" data-id="{{ $requisition->id }}" style="margin-right: 5px;">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="loan" role="tabpanel" aria-labelledby="loan-req-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="datatable6" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($saveOrder as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class=" showAuthrequisitionBtn btn btn-primary"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                        <button type="button" class="btn btn-success loanRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:2px;">
                                            <i class="bx bx-send me-1"></i> Return
                                        </button>
                                        {{-- <button type="button" class="btn btn-warning editReturnRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:5px;">
                                            <i class="bx bx-edit me-1"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger deleteReturnRequisitionBtn" data-id="{{ $requisition->id }}" style="margin-right: 5px;">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="return" role="tabpanel" aria-labelledby="return-req-tab">
                    <div class="table-responsive text-nowrap p-3">
                        <table id="Allocations_Table" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Requisition No</th>
                                    <th>Return Reason</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="Requisitions-Table">
                                @foreach ($returnOrder as $requisition)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $requisition->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($requisition->requisition_date)->format('d-F-Y') }}
                                    </td>
                                    <td>{{ $requisition->requisition_no }}</td>
                                    <td>{!! $requisition->remarks !!}</td>
                                    <td>
                                        @if ($requisition->status == 0)
                                        <span class="badge bg-warning">Pending Authorization</span>
                                        @elseif($requisition->status == 1)
                                        <span class="badge bg-success">Accepted</span>
                                        @elseif($requisition->status == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                        @elseif($requisition->status == 4)
                                        <span class="badge bg-info">Issued</span>
                                        @elseif($requisition->status == 5)
                                        <span class="badge bg-secondary">Ready To Pick</span>
                                        @elseif($requisition->status == 11)
                                        <span class="badge bg-secondary">Save Draft</span>
                                        @elseif($requisition->status == 12)
                                        <span class="badge bg-danger">Return Order</span>
                                        @elseif($requisition->status == 13)
                                        <span class="badge bg-warning">Saved Return Order</span>
                                        @elseif($requisition->status == 14)
                                        <span class="badge bg-warning">Loan Order</span>
                                        @elseif($requisition->status == 15)
                                        <span class="badge bg-success">Loan Returned</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class=" showrequisitionBtn btn btn-primary"
                                            data-id="{{ $requisition->id }}" data-status="{{ $requisition->status}}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </button>
                                        <!-- //print requisition -->
                                        <a href="{{ route('requisitions.print', $requisition->id) }}" class=""
                                            target="_blank">
                                            <button class="btn btn-info">
                                                <i class="bx bx-printer me-1"></i> Print
                                            </button>
                                        </a>
                                        @if($requisition->status == 12 || $requisition->status == 13)
                                        <button type="button" class="btn btn-warning editReturnRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:5px;">
                                            <i class="bx bx-edit me-1"></i> Edit
                                        </button>
                                        @endif
                                        @if($requisition->status == 13)
                                        <button type="button" class="btn btn-success sendRequisitionBtn"
                                            data-id="{{ $requisition->id }}" style="margin-right:5px;">
                                            <i class="bx bx-send me-1"></i> Send
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Permissions -->
    </div>
</div>  

<script>
var authUserId = '{{ Auth::id() }}';
CKEDITOR.replace('return-text');
</script>


<script>
$(document).ready(function() {
    // Reject requisition button click handler
    $(document).on('click', '.rejectrequisitionBtn', function() {
        console.log('reject');
        var requisition_id = $(this).data('id');
        $.ajax({
            url: "{{ route('requisitions.reject', ':id') }}".replace(':id', requisition_id),
            type: 'GET',
            success: function(response) {
                if (response.status) {
                    Toastify({
                        text: "Requisition Rejected Successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    location.href = "{{ route('requisitions.create') }}";
                } else {
                    console.log(response.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    $(document).ready(function() {
    var requisition_id;

    // When the "Return" button is clicked
    $('.returnrequisitionBtn').click(function() {
        requisition_id = $(this).data('id'); // Get the requisition ID
        $('#returnModal').modal('show'); // Show the modal
    });

    $('#submitReturn').click(function() {
        const reason = CKEDITOR.instances['returnReason'].getData(); 

        if (reason.trim() === '') {
            toastr.error('Please provide a reason for returning.');
            return;
        }

        $.ajax({
            url: "{{ route('requisitions.return', ':id') }}".replace(':id', requisition_id), 
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', 
                id: requisition_id,
                reason: reason
            },
            success: function(response) {
                $('#returnModal').modal('hide'); // Close the modal
                toastr.success('Requisition returned successfully.'); // Show success message
                setTimeout(function() {
                    location.reload(); // Reload the page after a short delay
                }, 2000); // 2-second delay before reload
            },
            error: function(xhr, status, error) {
                console.error('An error occurred:', error);
                toastr.error('Failed to return requisition. Please try again.'); // Show error message
            }
        });
    });
});



    // Accept requisition button click handler
    $(document).on('click', '.acceptrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        localStorage.setItem('requisition_id', requisition_id);

        location.href = "{{ route('requisitions.create') }}";
    });

    // Function to handle sending requisition
    function submitRequisition(url, noAuth) {
        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}" // Include CSRF token if using Laravel
            },
            success: function(response) {
                Swal.fire({
                    title: noAuth ? "Requisition Sent Without Authorization!" : "Requisition Sent!",
                    text: noAuth ? "Requisition has been sent without authorization." : "Requisition has been sent for authorization.",
                    icon: "success"
                 }).then(() => {
                    window.location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    title: "Error!",
                    text: "Something went wrong. Please try again.",
                    icon: "error"
                });
            }
        });
    }

    // send requisition button click handler
    $(document).on('click', '.sendRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to send this requisition for authorization?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            allowOutsideClick: false, 
            showCloseButton: true    
        }).then((result) => {
            if (result.isConfirmed) {
                // If "Yes" is clicked
                submitRequisition("{{ route('requisitions.sent', ':id') }}".replace(':id', requisition_id), false);
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // If "No" is clicked
                submitRequisition("{{ route('requisitions.noAuth.sent', ':id') }}".replace(':id', requisition_id), true);
            }
        });
    });


        // loan requisition button click handler
        $(document).on('click', '.loanRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        Swal.fire({
            title: 'Do you want to add those product back into stock?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('requisitions.loan', ':id') }}".replace(':id',
                        requisition_id),
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token added here
                    },
                    success: function(response) {
                        if (response.status) {
                            Toastify({
                                text: "Product added back into stock",
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#228B22",
                                stopOnFocus: true,
                            }).showToast();
                            location.href = "{{ route('requisitions.create') }}";
                        } else {
                            console.log(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log('Requisition sending canceled');
            }
        });
    });

    // Delete requisition button click handler
    $(document).on('click', '.deleteReturnRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        Swal.fire({
            title: 'Do you want to delete this requisition?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('requisitions.delete', ':id') }}".replace(':id',
                        requisition_id),
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            Toastify({
                                text: "Requisition Deleted Successfully",
                                duration: 3000,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "#228B22",
                                stopOnFocus: true,
                            }).showToast();
                            location.href = "{{ route('requisitions.create') }}";
                        } else {
                            console.log(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log('Requisition deletion canceled');
            }
        });
    });
    
    $('#Requisitions_Table').DataTable();

    $('#create_requisitions').on('click', function() {
        location.href = "{{ route('orders.create') }}";
    });

    // Show requisition button click handler
    $(document).on('click', '.showrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "{{ route('orders.show', ':id') }}".replace(':id', requisition_id);
    });

        // Show invoice button click handler
        $(document).on('click', '.showInvoiceBtn', function () {
            var requisition_id = $(this).data('id');
            var status = $(this).data('status');

            // Store status in local storage
            localStorage.setItem('status', status);

            // Check if InvoiceDate is null using AJAX
            $.ajax({
                url: "{{ route('invoice.checkInvoiceDate', ':id') }}".replace(':id', requisition_id),
                type: "GET",
                success: function (response) {
                    if (response.invoice_date === null) {
                        // Show SweetAlert confirmation if InvoiceDate is null
                        Swal.fire({
                            title: "Create Invoice?",
                            text: "Do you want to create an invoice for this requisition? Invoice Date will be Today.",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonText: "Yes, create it!",
                            cancelButtonText: "No",
                            allowOutsideClick: false,
                            showCloseButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to invoice creation page if confirmed
                                location.href = "{{ route('invoice.show', ':id') }}".replace(':id', requisition_id);
                            }
                        });
                    } else {
                        // If InvoiceDate is not null, directly redirect
                        location.href = "{{ route('invoice.show', ':id') }}".replace(':id', requisition_id);
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                    console.error('AJAX request error:', xhr);
                }
            });
        });


        // Show edit requisition button click handler
        $(document).on('click', '.editrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "{{ route('requisitionedit.show', ':id') }}".replace(':id', requisition_id);
    });

    //     // Reject requisition button click handler
    //     $(document).on('click', '.sendDeleteRequisitionBtn', function() {
    //     console.log('reject');
    //     var requisition_id = $(this).data('id');
    //     $.ajax({
    //         url: "{{ route('senddelete.requisition', ':id') }}".replace(':id', requisition_id),
    //         type: 'GET',
    //         success: function(response) {
    //             if (response.status) {
    //                 Toastify({
    //                     text: "Save Draft Deleted Successfully",
    //                     duration: 3000,
    //                     gravity: "top",
    //                     position: 'right',
    //                     backgroundColor: "#228B22",
    //                     stopOnFocus: true,
    //                 }).showToast();
    //                 setTimeout(() => {
    //                     location.reload();
    //                 }, 1000);
    //             } else {
    //                 console.log(response.message);
    //             }
    //         },
    //         error: function(error) {
    //             console.log(error);
    //         }
    //     });
    // });

  // edit return requisition button click handler
  $(document).on('click', '.editReturnRequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }
        location.href = "{{ route('orders.edit', ':id') }}".replace(':id', requisition_id);
    });


    // Show auth requisition button click handler
    $(document).on('click', '.showAuthrequisitionBtn', function() {
        var requisition_id = $(this).data('id');
        var status = $(this).data('status');

        if (localStorage.getItem('status')) {
            localStorage.removeItem('status');

            localStorage.setItem('status', status);
        } else {
            localStorage.setItem('status', status);
        }

        location.href = "{{ route('requisitions.show', ':id') }}".replace(':id', requisition_id);

    });

    // Reject requisition button click handler
    $(document).on('click', '.rejectrequisitionBtn', function() {
        console.log('reject');
        var requisition_id = $(this).data('id');
        $.ajax({
            url: "{{ route('requisitions.reject', ':id') }}".replace(':id', requisition_id),
            type: 'GET',
            success: function(response) {
                if (response.status) {
                    Toastify({
                        text: "Requisition Rejected Successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    console.log(response.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Accept requisition button click handler
    $(document).on('click', '.acceptrequisitionBtn', function() {
        var requisition_id = $(this).data('id');

        localStorage.setItem('requisition_id', requisition_id);

        location.href = "{{ route('requisitions.create') }}";
    });

    // Accept auth requisition button click handler
    $(document).on('click', '.acceptAuthrequisitionBtn', function() {
        console.log('accept');
        var requisition_id = $(this).data('id');
        $.ajax({
            url: "{{ route('auth.requisitions.accept', ':id') }}".replace(':id',
                requisition_id),
            type: 'GET',
            success: function(response) {
                if (response.status) {
                    Toastify({
                        text: "Authorized Requisition Accepted Successfully",
                        duration: 3000,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "#228B22",
                        stopOnFocus: true,
                    }).showToast();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    console.log(response.message);
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
</script>
@endsection