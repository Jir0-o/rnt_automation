<?php $__env->startSection('content'); ?>
    <script>
        window.onload = function() {
            Swal.fire({
                title: 'Do you want to create a Tech Committee?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    var requisitionId = "<?php echo e($requisition_id); ?>";
                    // window.location.href = "<?php echo e(route('requisitions.tech.committee', ['requisition_id' => ':requisition_id'])); ?>".replace(':requisition_id', requisitionId);
                    window.location.href = "<?php echo e(route('requisitions.tech.committee')); ?>" + "?requisition_id=" + requisitionId;
                } else if (result.dismiss === Swal.DismissReason.cancel) {

                    window.location.href = "<?php echo e(route('create.committee.list')); ?>";
                }
            });
        };
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/allocations/showTech.blade.php ENDPATH**/ ?>