@extends('layouts.master')
@section('content')

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: 0.4s;
        border-top-color: rgba(85, 88, 228, 0.1);
    }
</style>
<div class="row row-cols-1 row-cols-md-4">
    @can('Can Access User Card')
    <div class="col mb-4">
        <div class="card total-user-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">TOTAL USERS</h6>
                    <div class="text-900 fs-4" id="total_users"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-user-account'></i>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can('Can Access Requisition Card')
    <div class="col mb-4">
        <div class="card total-poes-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">PENDING REQUISITIONS</h6>
                    <div class="text-900 fs-4" id="pending_requisition"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-id-card'></i>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can('Can Access Product Card')
    <div class="col mb-4">
        <div class="card total-criterias-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">TOTAL PRODUCTS</h6>
                    <div class="text-900 fs-4" id="total_product"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bx-check-double'></i>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>

@can('Can Access Full Card')
<div class="row row-cols-2 row-cols-md-6">
    <div class="col mb-4" style="width: 50%; height: 50%;">
        <div class="card">
            <div class="card-body text-center">
                <h3>MONTHLY SALES REPORTS</h3>
            </div>
            <div class="pb-3">
                <div id="monthly" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="col mb-4 box" style="width: 50%;">
        <div class="card">
            <div class="card-body text-center">
                <h3>YEARLY SALES REPORTS</h3>
            </div>
            <div class="pb-3">
                <div id="yearly" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
@endcan


<div class="row row-cols-0 row-cols-md-6">
    <div class="col mb-4 box" style="width: 50%;">
        <div class="card">
            <div class="card-body">
                <h3>STOCK ALERT</h3>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Available Quantity</th>
                            <th>Alert Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lowStock as $product)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->final_quantity}}</td>
                            <td>{{$product->final_quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col mb-4 box" style="width: 50%;">
        <div class="card">
            <div class="card-body">
                <h3>EXPIRING PRODUCTS</h3>
            </div>
            <div class="table-responsive text-nowrap p-3">
                <table id="datatable2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Expiry Date</th>
                            <th>In Days</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($expiringProduct as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($product->expiry_date)->format('M d, Y') }}</td>
                            <td>
                                @php
                                    $days = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($product->expiry_date)) + 1;
                                    echo floor($days) . ' ' . Str::plural('day', floor($days));
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@can('Can Access Full Card')
<div class="row row-cols-2 row-cols-md-6">
    <div class="col mb-4 box" style="width: 50%;">
        <div class="card">
            <div class="card-body text-center">
                <h3>MONTHLY COST REPORTS</h3>
            </div>
            <div class="pb-3">
                <div id="monthly_cost" style="height: 400px;"></div>
            </div>
        </div>
    </div>
    <div class="col mb-4 box" style="width: 50%;">
        <div class="card">
            <div class="card-body text-center">
                <h3>YEARLY COST REPORTS</h3>
            </div>
            <div class="pb-3">
                <div id="yearly_cost" style="height: 400px;"></div>
            </div>
        </div>
    </div>
</div>
@endcan

<!-- <div class="card p-3">
    <div id="calendar">

    </div>
</div> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>

<!-- highchart -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
$(document).ready(function() {

    // Destroy and reinitialize datatable1
    if ($.fn.dataTable.isDataTable('#datatable1')) {
        $('#datatable1').DataTable().destroy();
    }
    $('#datatable1').DataTable({
        "pageLength": 3, // Set the number of rows per page to 3
        "lengthMenu": [3, 6, 10], // Option to change number of rows (3, 6, 10)
    });

    // Destroy and reinitialize datatable2
    if ($.fn.dataTable.isDataTable('#datatable2')) {
        $('#datatable2').DataTable().destroy();
    }
    $('#datatable2').DataTable({
        "pageLength": 3, // Set the number of rows per page to 3
        "lengthMenu": [3, 6, 10], // Option to change number of rows (3, 6, 10)
    });

    //total user 
    function GetUser() {
        return $.ajax({
            url: "{{route('roles.index')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    var totalUser = response.users.length;
                    $('#total_users').html(totalUser);
                } else {
                    $('#total_users').html(0);
                }
            }
        });
    }
    GetUser();

    //pending_requisition
    function GetPendingRequisition() {
        return $.ajax({
            url: "{{route('requisitions.index')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var pendingRequisition = response.data.length;
                    $('#pending_requisition').html(pendingRequisition);
                } else {
                    $('#pending_requisition').html(0);
                }
            }
        });
    }
    GetPendingRequisition();

    //total product
    function GetTotalProduct() {
        return $.ajax({
            url: "{{route('products.index')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var totalProduct = response.data.length;
                    $('#total_product').html(totalProduct);
                } else {
                    $('#total_product').html(0);
                }
            }
        });
    }
    GetTotalProduct();

    //todays_allocated_quantity
    function GetTodaysAllocatedQuantity() {
        return $.ajax({
            url: "{{route('statistics.today.allocations')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var todaysAllocatedQuantity = response.data;
                    $('#todays_allocated_quantity').html(todaysAllocatedQuantity);
                } else {
                    $('#todays_allocated_quantity').html(0);
                }
            }
        });
    }
    GetTodaysAllocatedQuantity();

    //todays_sales
    function GetTodaysSales() {
        return $.ajax({
            url: "{{route('statistics.today.sales')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var todaysSales = response.data;
                    var formattedSales = 'Tk. ' + todaysSales.toString().replace(
                        /\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#todays_sales').html(formattedSales);
                } else {
                    $('#todays_sales').html('Tk. 0');
                }
            }
        });
    }
    GetTodaysSales();

    //monthly_allocated_quantity
    function GetMonthlyAllocatedQuantity() {
        return $.ajax({
            url: "{{route('statistics.month.allocations')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var monthlyAllocatedQuantity = response.data;
                    $('#monthly_allocated_quantity').html(monthlyAllocatedQuantity);
                } else {
                    $('#monthly_allocated_quantity').html(0);
                }
            }
        });
    }
    GetMonthlyAllocatedQuantity();

    //monthly_sales
    function GetMonthlySales() {
        return $.ajax({
            url: "{{route('statistics.month.sales')}}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var monthlySales = response.data;
                    var formattedSales = 'Tk. ' + monthlySales.toString().replace(
                        /\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#monthly_sales').html(formattedSales);
                } else {
                    $('#monthly_sales').html('Tk. 0');
                }
            }
        });
    }
    GetMonthlySales();

    function GetMonthlyReport() {
        $.ajax({
            url: "{{ route('statistics.monthly') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    var monthlyData = response.data.map(Number); // Convert data to numbers
                    var categories = ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'];

                    Highcharts.chart('monthly', {
                        chart: {
                            type: 'pie',
                            backgroundColor: '#FFFFFF', // Light background
                            options3d: {
                                enabled: true,
                                alpha: 45
                            }
                        },
                        title: {
                            text: "Monthly Report"
                        },
                        plotOptions: {
                            pie: {
                                innerSize: 100, // Donut effect
                                depth: 45,
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        tooltip: {
                            pointFormat: "{series.name}: <b>{point.y} Tk</b>"
                        },
                        series: [{
                            name: 'Total Cost',
                            data: categories.map((month, index) => ({
                                name: month,
                                y: monthlyData[index] || 0
                            })),
                            colors: [
                                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                                '#FF9F40', '#C9CBCF', '#5283FF', '#38BF64', '#4B92C0',
                                '#99CAFF', '#FF6D40'
                            ]
                        }]
                    });
                }
            }
        });
    }

    GetMonthlyReport();

    function GetYearlyReport() {
        $.ajax({
            url: "{{ route('statistics.yearly') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    var yearlyReport = response.data;

                    Highcharts.chart('yearly', {
                        chart: {
                            type: 'column', // Bar chart type
                            backgroundColor: '#ffffff', // White background
                            zoomType: 'xy' // Enable zooming on both axes
                        },
                        title: {
                            text: 'Yearly Sales Report',
                            align: 'center',
                            style: {
                                fontSize: '18px',
                                fontWeight: 'bold',
                                color: '#333'
                            }
                        },
                        xAxis: {
                            categories: yearlyReport.years,
                            title: {
                                text: 'Years'
                            },
                            crosshair: true,
                            gridLineWidth: 1
                        },
                        yAxis: {
                            title: {
                                text: 'Total Sales (Tk.)'
                            },
                            gridLineWidth: 1,
                            labels: {
                                format: '{value} Tk'
                            }
                        },
                        tooltip: {
                            shared: true,
                            useHTML: true,
                            headerFormat: '<b>{point.x}</b><br>',
                            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y} Tk</b><br>',
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            style: {
                                color: '#ffffff'
                            },
                            borderRadius: 10
                        },
                        series: [
                            {
                                name: 'Yearly Sales',
                                type: 'column',
                                data: yearlyReport.sales,
                                color: '#36A2EB',
                                borderWidth: 2
                            },
                            {
                                name: 'Sales Trend',
                                type: 'spline', // Smooth line chart for trend analysis
                                data: yearlyReport.sales,
                                color: '#FF6384',
                                lineWidth: 3,
                                marker: {
                                    enabled: true,
                                    symbol: 'circle',
                                    radius: 5,
                                    fillColor: '#ffffff',
                                    lineWidth: 2,
                                    lineColor: '#FF6384'
                                }
                            }
                        ],
                        legend: {
                            enabled: true,
                            align: 'center',
                            verticalAlign: 'bottom'
                        },
                        exporting: {
                            enabled: true // Allows export to PNG, PDF, etc.
                        }
                    });
                }
            }
        });
    }

    GetYearlyReport();

    // Monthly Report using Highcharts
    function GetMonthlyCostReport() {
        $.ajax({
            url: "{{ route('statistics.monthly.cost') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    var monthlyData = response.data.map(Number); // Convert data to numbers
                    var categories = ['January', 'February', 'March', 'April', 'May', 'June',
                        'July', 'August', 'September', 'October', 'November', 'December'];

                    Highcharts.chart('monthly_cost', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: "Monthly Cost Distribution"
                        },
                        tooltip: {
                            pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                                }
                            }
                        },
                        series: [{
                            name: 'Cost',
                            colorByPoint: true,
                            data: categories.map((month, index) => ({
                                name: month,
                                y: monthlyData[index] || 0
                            }))
                        }]
                    });
                }
            }
        });
    }

    function GetYearlyCostReport() {
        $.ajax({
            url: "{{ route('statistics.yearly.cost') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    var yearlyReport = response.data;

                    Highcharts.chart('yearly_cost', {
                        chart: {
                            type: 'spline', // Smooth curved line chart
                            backgroundColor: '#FFFFFF', // Light background
                            zoomType: 'x', // Zoom functionality
                            animation: {
                                duration: 2000,
                                easing: 'easeOutBounce'
                            }
                        },
                        title: {
                            text: 'Yearly Cost Report',
                            align: 'center',
                            style: {
                                fontSize: '18px',
                                fontWeight: 'bold',
                                color: '#333'
                            }
                        },
                        xAxis: {
                            categories: yearlyReport.years,
                            title: {
                                text: 'Years'
                            },
                            gridLineWidth: 1, // Light grid lines
                            crosshair: true
                        },
                        yAxis: {
                            title: {
                                text: 'Total Cost (Tk.)'
                            },
                            gridLineWidth: 1, // Light grid lines
                            labels: {
                                format: '{value} Tk'
                            }
                        },
                        tooltip: {
                            shared: true,
                            useHTML: true,
                            headerFormat: '<b>{point.x}</b><br>',
                            pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: <b>{point.y} Tk</b><br>',
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            style: {
                                color: '#ffffff'
                            },
                            borderRadius: 10
                        },
                        series: [{
                            name: 'Yearly Cost',
                            data: yearlyReport.sales,
                            color: {
                                linearGradient: [0, 0, 0, 400], // Gradient color
                                stops: [
                                    [0, 'rgba(255, 99, 132, 1)'],
                                    [1, 'rgba(255, 99, 132, 0.2)']
                                ]
                            },
                            lineWidth: 3, // Thicker line
                            marker: {
                                enabled: true, // Show points
                                symbol: 'circle',
                                radius: 5,
                                fillColor: '#ffffff',
                                lineWidth: 2,
                                lineColor: '#FF6384'
                            },
                            shadow: {
                                color: 'rgba(0, 0, 0, 0.3)',
                                width: 10,
                                offsetX: 0,
                                offsetY: 3
                            },
                            states: {
                                hover: {
                                    lineWidth: 4
                                }
                            }
                        }],
                        legend: {
                            enabled: true,
                            align: 'center',
                            verticalAlign: 'bottom'
                        },
                        exporting: {
                            enabled: true // Allows export to PNG, PDF, etc.
                        }
                    });
                }
            }
        });
    }
    // Fetch Reports
    GetMonthlyCostReport();
    GetYearlyCostReport();
});
</script>
@endsection