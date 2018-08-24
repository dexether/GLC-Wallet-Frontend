
<?php $__env->startSection('title'); ?>
    Exchange Balance
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> MY Balance </h6>

            <div class="heading-elements">
            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Name</th>
                        <th>Balance</th>
                        <th>Available</th>
                        <th>Reserved</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>USD</td>
                        <td><?php echo e(@$data['usd_balance']); ?></td>
                        <td><?php echo e(@$data['usd_available']); ?></td>
                        <td><?php echo e(@$data['usd_reserved']); ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>BTC</td>
                        <td><?php echo e(@$data['btc_balance']); ?></td>
                        <td><?php echo e(@$data['btc_available']); ?></td>
                        <td><?php echo e(@$data['btc_reserved']); ?></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>ETH</td>
                        <td><?php echo e(@$data['eth_balance']); ?></td>
                        <td><?php echo e(@$data['eth_available']); ?></td>
                        <td><?php echo e(@$data['eth_reserved']); ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>XRP</td>
                        <td><?php echo e(@$data['xrp_balance']); ?></td>
                        <td><?php echo e(@$data['xrp_available']); ?></td>
                        <td><?php echo e(@$data['xrp_reserved']); ?></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>LTC</td>
                        <td><?php echo e(@$data['ltc_balance']); ?></td>
                        <td><?php echo e(@$data['ltc_available']); ?></td>
                        <td><?php echo e(@$data['ltc_reserved']); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
</div>
</div>
    <!-- /.box -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
    <script>
        $('#data-table').DataTable({
            "order": [[9, "desc"]],
            "columnDefs": [
                {"orderable": false, "targets": [7]}
            ],
            "language": {
                "lengthMenu": "<?php echo e(trans('general.lengthMenu')); ?>",
                "zeroRecords": "<?php echo e(trans('general.zeroRecords')); ?>",
                "info": "<?php echo e(trans('general.info')); ?>",
                "infoEmpty": "<?php echo e(trans('general.infoEmpty')); ?>",
                "search": "<?php echo e(trans('general.search')); ?>",
                "infoFiltered": "<?php echo e(trans('general.infoFiltered')); ?>",
                "paginate": {
                    "first": "<?php echo e(trans('general.first')); ?>",
                    "last": "<?php echo e(trans('general.last')); ?>",
                    "next": "<?php echo e(trans('general.next')); ?>",
                    "previous": "<?php echo e(trans('general.previous')); ?>"
                }
            },
            responsive: false
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>