<html>

<head>
    <title>Barcode</title>
    <style>
    @media print {

        @page {
            size: portrait;
            margin: 10px;
        }

        html,
        body {
            width: 54mm;
            height: 25mm;
            margin: 0;
            padding: 0;
            overflow: visible;
            /* Show all content */
        }

        .grid-container {
            display: grid;
            justify-content: center;
        }

        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            /* Reduced font size */
            text-align: center;
            word-wrap: break-word;
            /* Ensure long words break */
            line-height: 1.1;
            /* Adjust line height */
        }
    }

    html,
    body {
        width: 54mm;
        height: 25mm;
        margin: 0;
        padding: 0;
        overflow: visible;
        /* Show all content */
    }

    .grid-container {
        display: grid;
        justify-content: center;
    }

    .grid-item {
        background-color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        /* Reduced font size */
        text-align: center;
        word-wrap: break-word;
        /* Ensure long words break */
        line-height: 1.1;
        /* Adjust line height */
    }
    </style>
</head>

<body>

    <div id="print" xmlns:margin-top="http://www.w3.org/1999/xhtml">
        <div class="grid-container">

            <div class="grid-item">
                <p>
                    <?php echo DNS1D::getBarcodeSVG($barcode, 'C39'); ?><br>
                    <?php echo e($Product->product_name); ?><br>
                    <?php echo e($Product->unit_price); ?><br>
                    <?php echo e($Product->spec); ?>

                </p>
            </div>

        </div>

    </div>


    <script>
    window.print();
    </script>
</body>

</html><?php /**PATH C:\laragon\www\Procurement_final\resources\views/print/printBarcode.blade.php ENDPATH**/ ?>