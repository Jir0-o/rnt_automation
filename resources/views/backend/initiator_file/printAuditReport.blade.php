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
        /* .item-audit-report {
            background-color:rgb(243, 245, 247);
        } */

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

        /* .item-audit-report .btm-top {
            border-top: 1px dotted #363636;
        } */

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
    @php
        use \Carbon\Carbon;
    @endphp
    <div class="destination-slider" id="auditTable">
        <div class="item-audit-report p-3">
            <div class="header-audit d-flex justify-content-center">
            <img src="{{ asset('RNT-Logo.png') }}" alt="RNT logo">
                <div class="header-audit-content text-center px-3">
                    <h3 class="ms-3">RIZTU CORPORATION</h3>
                    <p>Stock Register</p>
                </div>
                <!-- <div id="page_number">{{ $pageNumber }}</div> -->
            </div>
            <div class="text-center">
                <p>Product Name: <span class="btm-top">{{ $product->product_name }}</span></p>
            </div>
            <div>
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th colspan="7" scope="col">Receipt</th>
                            <th colspan="5" scope="col">Distribution</th>
                        </tr>
                        <tr>
                            <!-- Store In Data -->
                            <th scope="col">Receipt Date</th>
                            <th scope="col">Source of Supply <br> Invoice No. & Date</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Total Amount</th>
                            <!-- <th scope="col">Remarks</th> -->
                            
                            <!-- Store Out Data -->
                            <th scope="col">Distribution Date</th>
                            <th scope="col">Requisition <br> Number</th>
                            <th scope="col">Issued To</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Stock Balance</th>
                            <!-- <th scope="col">Store Keeper's Signature</th>
                            <th scope="col">Store Officer's Signature</th>
                            <th scope="col">Remarks</th> -->
                        </tr>
                    </thead>

                    @if ($leisureaccept->isEmpty() && $leisuredistribution->isEmpty())
                        <tr>
                            <td colspan="16">No data available</td>
                        </tr>
                    @else
                        @foreach ($leisureaccept as $index => $accept)
                            @php
                                $distribution = $leisuredistribution[$index] ?? null;
                            @endphp
                            <tr>
                                <td>{{ $accept->date }}</td>
                                <td>{{ $accept->purchase_from }} <br> {{ $accept->bill_no }} <br> {{ Carbon::parse($accept->date)->format('d-F-Y') }}</td>
                                <td>{{ $accept->details }}</td>
                                <td>{{ $accept->quantity }}</td>
                                <td>{{ $unitType->name }}</td>
                                <td>{{ $accept->price }}</td>
                                <td>{{ $accept->amount }}</td>
                                <!-- <td>{{ $accept->discussion }}</td> -->

                                @if ($distribution)
                                    <td>{{ $distribution->date }}</td>
                                    <td>{{ $distribution->requisition_no }}</td>
                                    <td>{{ $distribution->place }}</td>
                                    <td>{{ $distribution->quantity }}</td>
                                    <td>{{ $distribution->total_quantity }}</td>
                                    <!-- <td>
                                        @if ($storeSignatures[$distribution->id])
                                            <img src="{{ asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id]) }}"
                                                alt="Signature" width="50">
                                        @else

                                        @endif
                                    </td>
                                    <td>
                                        @if ($storeSignatures[$distribution->id])
                                            <img src="{{ asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id]) }}"
                                                alt="Signature" width="50">
                                        @else

                                        @endif
                                    </td>
                                    <td>{{ $distribution->discussion }}</td> -->
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td></td>
                                    <td></td>
                                    <td></td> -->
                                @endif
                            </tr>
                        @endforeach

                        @foreach ($leisuredistribution as $index => $distribution)
                            @if (!isset($leisureaccept[$index]))
                                <tr>
                                    <!-- Store in data (leisure_accept) -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <!-- <td></td> -->

                                    <!-- Store out data (leisure_distribution) -->
                                    <td>{{ $distribution->date }}</td>
                                    <td>{{ $distribution->requisition_no }}</td>
                                    <td>{{ $distribution->place }}</td>
                                    <td>{{ $distribution->quantity }}</td>
                                    <td>{{ $distribution->total_quantity }}</td>
                                    <!-- <td>
                                        @if ($storeSignatures[$distribution->id])
                                            <img src="{{ asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id]) }}"
                                                alt="Signature" width="50">
                                        @else

                                        @endif
                                    </td>
                                    <td>
                                        @if ($storeSignatures[$distribution->id])
                                            <img src="{{ asset('global_assets/user_images/signature/' . $storeSignatures[$distribution->id]) }}"
                                                alt="Signature" width="50">
                                        @else

                                        @endif
                                    </td>
                                    <td>{{ $distribution->discussion }}</td> -->
                                </tr>
                            @endif
                        @endforeach
                    @endif

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
