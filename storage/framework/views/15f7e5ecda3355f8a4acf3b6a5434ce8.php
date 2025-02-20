<?php $__env->startSection('content'); ?>

<div class="row row-cols-1 row-cols-md-4">
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access User Card')): ?>
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
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Requisition Card')): ?>
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
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Allocation Card')): ?>
    <div class="col mb-4">
        <div class="card total-standards-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">PENDING ALLOCATIONS</h6>
                    <div class="text-900 fs-4" id="pending_allocation"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-layout'></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Full Card')): ?>
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

    <div class="col mb-4">
        <div class="card total-section-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">TODAY'S ALLOCATED QUANTITY</h6>
                    <div class="text-900 fs-4" id="todays_allocated_quantity"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-folder-open'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col mb-4">
        <div class="card total-rubrics-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">TODAY'S ALLOCATION VALUE</h6>
                    <div class="text-900 fs-4" id="todays_sales"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col mb-4">
        <div class="card total-rubrics-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">MONTHLY ALLOCATED QUANTITY</h6>
                    <div class="text-900 fs-4" id="monthly_allocated_quantity"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col mb-4">
        <div class="card total-rubrics-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">MONTHLY ALLOCATION VALUE</h6>
                    <div class="text-900 fs-4" id="monthly_sales"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php
    $authId = Illuminate\Support\Facades\Auth::user()->id;

    // Find the designation for Vice Chancellor (VC)
    $designation = App\Models\Designation::where('designation', 'Vice Chancellor')
    ->orWhere('short', 'VC')
    ->first();

    // Retrieve the first user with this designation, if any
    $users = $designation ? App\Models\User::where('designation_id', $designation->id)->first() : null;
    ?>

    <?php if($users && $authId == $users->id): ?>
    <div class="col mb-4">
        <div class="card total-rubrics-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">TOTAL PENDING COMMITTEES</h6>
                    <div class="text-900 fs-4" id="pending_committee"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-4">
        <div class="card total-rubrics-hover" style="height: 135px;">
            <div class="d-flex justify-content-between mb-3">
                <div class="card-body">
                    <h6 class="d-block text-500 font-medium mb-3">TOTAL PENDING NOTES</h6>
                    <div class="text-900 fs-4" id="pending_note"></div>
                </div>
                <div class="d-flex align-items-center justify-content-center rounded"
                    style="width: 2.5rem; height: 2.5rem; margin-top: 10px; margin-right: 5px">
                    <i class='bx bxs-bar-chart-alt-2'></i>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Can Access Full Card')): ?>
<div class="row row-cols-2 row-cols-md-6">
    <div class="col mb-4" style="width: 50%;">
        <div class="card">
            <div class="card-body text-center">
                <h3>MONTHLY REPORTS</h3>
            </div>
            <div class="pb-3">
                <canvas id="monthly"></canvas>
            </div>
        </div>
    </div>
    <div class="col mb-4" style="width: 50%;">
        <div class="card">
            <div class="card-body text-center">
                <h3>YEARLY REPORTS</h3>
            </div>
            <div class="pb-3">
                <canvas id="yearly"></canvas>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="card p-3">
    <div id="calendar">

    </div>
</div>

<script>
$(document).ready(function() {
    calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['timeline', 'dayGrid', 'timeGrid', 'interaction'],
        editable: true,
        header: {
            left: 'today prev,next',
            center: 'title',
            right: 'timelineDay,timeGridWeek,dayGridMonth'
        },
        defaultView: 'dayGridMonth',
        displayEventEnd: true,
        selectable: true,
    });
    calendar.render();

    //total pending committee 
    function GetPendingCommittee() {
        return $.ajax({
            url: "<?php echo e(route('pending.committee')); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    var totalUser = response.data.length;
                    $('#pending_committee').html(totalUser);
                } else {
                    $('#pending_committee').html(0);
                }
            }
        });
    }
    GetPendingCommittee();

    //total pending note
    function GetPendingNote() {
        return $.ajax({
            url: "<?php echo e(route('pending.note')); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == 200) {
                    var totalUser = response.data.length;
                    $('#pending_note').html(totalUser);
                } else {
                    $('#pending_note').html(0);
                }
            }
        });
    }
    GetPendingNote();

    //total user 
    function GetUser() {
        return $.ajax({
            url: "<?php echo e(route('roles.index')); ?>",
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
            url: "<?php echo e(route('requisitions.index')); ?>",
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

    //pending_allocation
    function GetPendingAllocation() {
        return $.ajax({
            url: "<?php echo e(route('allocations.index')); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    var pendingAllocation = response.data.length;
                    $('#pending_allocation').html(pendingAllocation);
                } else {
                    $('#pending_allocation').html(0);
                }
            }
        });
    }
    GetPendingAllocation();

    //total product
    function GetTotalProduct() {
        return $.ajax({
            url: "<?php echo e(route('products.index')); ?>",
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
            url: "<?php echo e(route('statistics.today.allocations')); ?>",
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
            url: "<?php echo e(route('statistics.today.sales')); ?>",
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
            url: "<?php echo e(route('statistics.month.allocations')); ?>",
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
            url: "<?php echo e(route('statistics.month.sales')); ?>",
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

    // Monthly report
    function GetMonthlyReport() {
        return $.ajax({
            url: "<?php echo e(route('statistics.monthly')); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    var monthlyReport = response.data;
                    var ctx = document.getElementById('monthly').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July',
                                'August', 'September', 'October', 'November', 'December'
                            ],
                            datasets: [{
                                label: 'Monthly Sales',
                                data: monthlyReport,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)', // January
                                    'rgba(54, 162, 235, 0.2)', // February
                                    'rgba(255, 206, 86, 0.2)', // March
                                    'rgba(75, 192, 192, 0.2)', // April
                                    'rgba(153, 102, 255, 0.2)', // May
                                    'rgba(255, 159, 64, 0.2)', // June
                                    'rgba(199, 199, 199, 0.2)', // July
                                    'rgba(83, 102, 255, 0.2)', // August
                                    'rgba(56, 159, 64, 0.2)', // September
                                    'rgba(75, 92, 192, 0.2)', // October
                                    'rgba(153, 202, 255, 0.2)', // November
                                    'rgba(255, 109, 64, 0.2)' // December
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)', // January
                                    'rgba(54, 162, 235, 1)', // February
                                    'rgba(255, 206, 86, 1)', // March
                                    'rgba(75, 192, 192, 1)', // April
                                    'rgba(153, 102, 255, 1)', // May
                                    'rgba(255, 159, 64, 1)', // June
                                    'rgba(199, 199, 199, 1)', // July
                                    'rgba(83, 102, 255, 1)', // August
                                    'rgba(56, 159, 64, 1)', // September
                                    'rgba(75, 92, 192, 1)', // October
                                    'rgba(153, 202, 255, 1)', // November
                                    'rgba(255, 109, 64, 1)' // December
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }
        });
    }
    GetMonthlyReport();

    // Yearly report
    function GetYearlyReport() {
        return $.ajax({
            url: "<?php echo e(route('statistics.yearly')); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    var yearlyReport = response.data;
                    var ctx = document.getElementById('yearly').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: yearlyReport.years,
                            datasets: [{
                                label: 'Yearly Sales',
                                data: yearlyReport.sales,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }
        });
    }
    GetYearlyReport();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/dashboard.blade.php ENDPATH**/ ?>