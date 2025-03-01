

<?php $__env->startSection('content'); ?>
<div class="container">
    <h4 class="mt-3">All Transactions</h4>

    <!-- Filter Section -->
    <div class="card p-3">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>Transaction Type</label>
                <select class="form-control" id="trxType">
                    <option value="">All</option>
                    <option value="1">Income</option>
                    <option value="2">Expense</option>
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>Cost Type</label>
                <select class="form-control" id="costType">
                    <option value="">All</option>
                    <?php $__currentLoopData = $costTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type->name); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6 mt-3">
                <label>From</label>
                <input type="date" class="form-control" id="fromDate">
            </div>
            <div class="col-md-6 mt-3">
                <label>To</label>
                <input type="date" class="form-control" id="toDate">
            </div>
        </div>
        <br>
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary" id="resetBtn">Reset</button>
            <button class="btn btn-primary" id="filterBtn">Submit</button>
        </div>
    </div>

    <!-- Print & Export Buttons -->
    <div class="mt-3">
        <button class="btn btn-primary" onclick="printTable()">Print</button>
    </div>

    <div class="card p-3 mt-3">
        <!-- Transactions Table -->
        <div class="table-responsive mt-3">
            <table id="transactionsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Date Time</th>
                    <th>Trx Mode</th>
                    <th>Cost Type</th>
                    <th>Description</th>
                    <th>Income</th>
                    <th>Expense</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $totalIncome = 0;
                    $totalExpense = 0;
                ?>
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($trx->date)->format('M d, Y')); ?></td>
                    <td><?php echo e($trx->trx_mode); ?></td>
                    <td><?php echo e($trx->cost_type); ?></td>
                    <td><?php echo e($trx->description); ?></td>
                    <td>
                        <?php if($trx->trx_type == 1): ?>
                            <?php $totalIncome += $trx->amount; ?>
                            <?php echo e(number_format($trx->amount, 2)); ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?php if($trx->trx_type == 2): ?>
                            <?php $totalExpense += $trx->amount; ?>
                            <?php echo e(number_format($trx->amount, 2)); ?>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?php echo e(number_format($trx->balance, 2)); ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5" class="text-end">Total</th>
                    <th class="text-end"><?php echo e(number_format($totalIncome, 2)); ?></th>
                    <th class="text-end"><?php echo e(number_format($totalExpense, 2)); ?></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

        </div>
    </div>
</div>

<!-- Include jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
function printTable() {
    var table = document.getElementById("transactionsTable").cloneNode(true); // Clone table to modify without affecting original

    // Add S.L No. column dynamically
    var rows = table.getElementsByTagName("tr");
    var call = table.getElementsByTagName("th");

    for (let i = 0; i < rows.length; i++) {
        let cell = document.createElement(i === 0 ? "th" : "td"); // Header for first row, TD for others
        cell.innerText = i === 0 ? "S.L No." : i; // "S.L No." for header, numbers for rows
        rows[i].insertBefore(cell, rows[i].firstChild); // Insert at the beginning of each row

        // Hide the first column
        if (i === 1) {
            call[i].style.display = "none";
        }
    }

    // Remove the first column (first child) from all rows
    for (let i = 1; i < rows.length; i++) {
        // Remove the first column 
        rows[i].removeChild(rows[i].firstChild);
    }

    var newWin = window.open("", "_blank");

    newWin.document.write(`
        <html>
            <head>
                <title>Print Transactions</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid black; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                </style>
            </head>
            <body>
                <h2>All Transactions</h2>
                ${table.outerHTML} <!-- Use modified table -->
            </body>
        </html>
    `);

    newWin.document.close();
    
    // Add a small delay before printing to allow rendering
    setTimeout(() => {
        newWin.print();
        newWin.close();
        newWin.print();
    }, 500);
}


</script>

<script>

$(document).ready(function() {
    // Initialize DataTable with global search
    var table = $('#transactionsTable').DataTable({
        "paging": true,
        "searching": true,  // Enables global search
        "ordering": true
    });

    // Filter Functionality
    $("#filterBtn").click(function() {
        var trxType = $("#trxType").val();  // 1 for Income, 2 for Expense
        var costType = $("#costType").val();
        var fromDate = $("#fromDate").val();
        var toDate = $("#toDate").val();

        $.fn.dataTable.ext.search = []; // Clear previous filters

        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            var income = data[5].trim(); // Income Column
            var expense = data[6].trim(); // Expense Column
            var costTypeData = data[3].trim(); // Cost Type Column
            var date = new Date(data[1]); // Date Column

            var from = fromDate ? new Date(fromDate) : null;
            var to = toDate ? new Date(toDate) : null;

            // Filter by Transaction Type
            if (trxType == "1" && !income) return false; // Show only Income
            if (trxType == "2" && !expense) return false; // Show only Expense

            // Filter by Cost Type
            if (costType && costTypeData !== costType) return false;

            // Filter by Date Range
            if ((from && date < from) || (to && date > to)) return false;

            return true;
        });

        // Update the serial numbers after filtering
        table.rows({ search: "applied" }).every(function(index) {
            this.cell(index, 0).data(index + 1).invalidate();
        });

        table.draw();
    });

    // Reset Filter
    $("#resetBtn").click(function() {
        $("#trxType, #costType, #fromDate, #toDate").val("");
        $.fn.dataTable.ext.search = [];
        table.search("").columns().search("").draw();
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\RNT Automation\resources\views/backend/transactions/transactionList.blade.php ENDPATH**/ ?>