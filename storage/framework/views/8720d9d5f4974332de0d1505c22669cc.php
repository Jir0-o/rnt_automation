<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo e(asset('template/assets/vendor/fonts/boxicons.css')); ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('template/assets/vendor/css/core.css')); ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo e(asset('template/assets/vendor/css/theme-default.css')); ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo e(asset('')); ?>template/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('template/assets/vendor/libs/apex-charts/apex-charts.css')); ?>" />
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <!-- Page CSS -->

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />



    <!-- Helpers -->
    <script src="<?php echo e(asset('template/assets/vendor/js/helpers.js')); ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo e(asset('template/assets/js/config.js')); ?>"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- rich textbox -->
    <script src="<?php echo e(asset('template/assets/ckeditor/ckeditor.js')); ?>"></script>

    <!-- FullCalendar CSS -->
    <link href='https://unpkg.com/@fullcalendar/core@4.4.0/main.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/timeline@4.4.0/main.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/resource-timeline@4.4.0/main.css' rel='stylesheet' />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timeline@4.4.0/main.js'></script>
    <script src='https://unpkg.com/@fullcalendar/resource-common@4.4.0/main.js'></script>
    <script src='https://unpkg.com/@fullcalendar/resource-timeline@4.4.0/main.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction@4.4.0/main.js'></script>

    

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        <?php echo $__env->make('backend.includes.side-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Layout container -->
        <div class="layout-page">

          <?php echo $__env->make('backend.includes.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?php echo e(asset('template/assets/vendor/libs/jquery/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/vendor/libs/popper/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/vendor/js/bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('template/assets/vendor/js/menu.js')); ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo e(asset('template/assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>

    <!-- Main JS -->
    <script src="<?php echo e(asset('template/assets/js/main.js')); ?>"></script>

    <!-- Page JS -->
    <script src="<?php echo e(asset('template/assets/js/dashboards-analytics.js')); ?>"></script>

    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/Chart.js"></script>
    <script>
        new DataTable('#datatable');
        new DataTable('#datatable1');
        new DataTable('#datatable2');
        new DataTable('#datatable3');
        new DataTable('#datatable4');
        new DataTable('#datatable5');
        new DataTable('#datatable6');
        new DataTable('#datatable7');
        new DataTable('#datatable8');
        new DataTable('#datatable9');
        new DataTable('#Requisitions_Table');
        new DataTable('#Temp_Requisitions_Table');
        new DataTable('#Product_Table');
        new DataTable('#Allocations_Table')

    </script>
    
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Bootstrap JS, if you are using Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

   
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
      integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <?php if(Session::has('success')): ?>
      <script>
          toastr.options = {
              'progressBar': true,
              'closeButton': true,
              "positionClass": "toast-top-right",
              "marginTop": "10rem",
          }
          toastr.success("<?php echo e(Session::get('success')); ?>");
          var toastrContainer = document.querySelector('.toast-top-right');
          toastrContainer.style.marginTop = '4.5rem';
      </script>
      <?php endif; ?>
      
      <?php if(Session::has('error')): ?>
      <script>
          toastr.options = {
              'progressBar': true,
              'closeButton': true,
              "positionClass": "toast-top-right",
              "marginTop": "10rem",
          }
          toastr.error("<?php echo e(Session::get('error')); ?>");
          var toastrContainer = document.querySelector('.toast-top-right');
          toastrContainer.style.marginTop = '4.5rem';
      </script>
      <?php endif; ?>
  </body>
</html>
<?php /**PATH C:\laragon\www\Procurement_final\resources\views/layouts/master.blade.php ENDPATH**/ ?>