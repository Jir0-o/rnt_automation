@extends('layouts.master')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Invoice</h5>
                <a href="{{ route('get-invoice.index') }}" class="btn btn-success">
                    <i class="bx bx-plus"></i> Create Invoice
                </a>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="Requisitions_Table" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Challan No</th>
                            <th>Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="Categories-Table">
                        @foreach ($requisition as $subCategory)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $subCategory->requisition_no }}</td>
                            <td>{{ $subCategory->invoice_no }}</td>
                            <td>{{ \Carbon\Carbon::parse($subCategory->invoice_date)->format('d-F-Y') }}</td>
                            <td>
                                @if ($subCategory->is_active == 0)
                                <span class="badge bg-warning">Pending</span>
                                @elseif($subCategory->is_active == 1)
                                <span class="badge bg-success">Approved</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary showInvoice" 
                                data-id="{{ $subCategory->id }}" 
                                onclick="window.location='{{ route('invoice.show', $subCategory->id) }}'">
                                <i class="bx bx-show-alt me-1"></i> Show
                            </button>
                            <button type="button" class="btn btn-warning showInvoice" 
                                data-id="{{ $subCategory->id }}" 
                                onclick="window.location='{{ route('invoice.print', $subCategory->id) }}'">
                                <i class="bx bx-printer me-1"></i>Print
                            </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection