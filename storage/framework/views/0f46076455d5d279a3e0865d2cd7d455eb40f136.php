
<?php $__env->startSection('title'); ?>
    Exchange Sell History
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"> Sell History </h6>

            <div class="heading-elements">
            </div>
        </div>
        <div class="panel-body ">
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>User Name</th>
                        <th>Order ID</th>
                        <th>Count</th>
                        <th>Symbol</th>
                        <th>Rate</th>
                        <th>Amount</th>
                        <th>Price</th>
                        
                        
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                    <?php $__currentLoopData = $sell_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td><?php echo e($i++); ?></td>
                        <td><?php echo e($key->userdata->first_name); ?> <?php echo e($key->userdata->last_name); ?></td>
                        <td><?php echo e($key->order_id); ?></td>
                        <td>1</td>
                        <td><?php echo e(strtoupper($key->symbol)); ?></td>
                        <td><?php echo e(number_format($key->same_price,2)); ?></td>
                        <td><?php echo e(number_format($key->price,2)); ?></td>
                        <td><?php echo e(number_format($key->final_aed,2)); ?></td>
                       
                        <td>
                            <?php if($key->status == 0): ?> <label class="label label-default"> Pending</label>
                            <?php elseif($key->status == 1): ?><label class="label label-success">  Success </label>
                            <?php elseif($key->status == 2): ?><label class="label label-warning">  Partially </label>
                            <?php elseif($key->status == 3): ?><label class="label label-warning">  Cancel </label>
                            <?php else: ?>
                            <?php endif; ?>
                        </td>
                     </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        $('#data-table').DataTable({});
    </script>

    <script>
        $(document).ready(function() {
            setInterval(function () {
                getMessage();
            }, 60 * 50); // 60 * 1000 milsec
            setInterval(function () {
                location.reload();
            }, 120000);
            function getMessage() {
                var t = $('#data-table').DataTable();
                var table = $('#data-table').dataTable();
                var numItems = table.fnGetData().length;

                $.ajax({
                    type: 'get',
                    url: '<?php echo e(url('buycountshow')); ?>'+'/sell/'+ numItems,
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        var buy = data.data;
                        var table = $('#data-table').dataTable();
                        //Get the total rows
                        if (data.error == 'ok') {
                            $.each(buy, function (index, value) {

                                if (value.status == 0) {

                                    var row = '<label class="label label-default buycount "> Pending</label>';
                                }
                                else if (value.status == 1) {
                                    var row = '<label class="label label-success buycount ">  Success </label>';
                                }
                                else if (value.status == 2) {
                                    var row = '<label class="label label-warning buycount ">  Partially </label>';
                                }
                                else if (value.status == 3) {
                                    var row = '<label class="label label-danger buycount ">  Cancel </label>';
                                }
                                // $('#data-table tbody  ').after(row);
                                counter = 1;
                                t.row.add([
                                    0,
                                    value.userdata.first_name + ' ' + value.userdata.last_name,
                                    value.order_id, 1,
                                    value.symbol,
                                    value.same_price,
                                    value.price,
                                    value.final_aed,
                                    row,
                                ]).draw(false);


                            });
                        }
                    }
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>