@extends('layouts.master')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3>Audit Report List</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable2" class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Specefication</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->spec }}</td>
                            <td>{{ $product->final_quantity }}</td>
                            <td>
                                <a href="{{ route('audit-report', ['product_id' => $product->id]) }}">
                                    <button class="btn btn-primary">Show Audit</button></a>

                                <a href="{{ route('product.print', $product->id) }}" target="_blank">
                                    <button class="btn btn-info" id="printButton">
                                        <i class="bx bx-printer me-1"></i>
                                        Print
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
