
<?php $__env->startSection('title'); ?>
    <?php echo e($usd->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section>
      <div class="pageContent  wallets">
        <div class="container">

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-white2">
                <div class="panel-body2 ">
                    <?php echo $__env->make('left_menu.client_balance', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title"> <?php echo e($usd->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h6>

                    <div class="heading-elements">
                        <a href="<?php echo e(url('wallets/aed/deposit')); ?>"
                           class="btn btn-default send_rec"><i class="fa fa-plus"></i> <?php echo e(trans_choice('general.deposit',1)); ?>

                        </a>
                        <a href="<?php echo e(url('wallets/aed/withdraw')); ?>"
                           class="btn btn-default send_rec"><i class="fa fa-send"></i> <?php echo e(trans_choice('general.withdraw',1)); ?>

                        </a>
                    </div>
                </div>
                <?php if(Session::has('flash_notification.message')): ?>
                    <div class="alert alert-<?php echo e(Session::get('flash_notification.level')); ?>">
                        <?php echo e(Session::get("flash_notification.message")); ?>

                    </div>
                <?php endif; ?>



                <div class="panel-body ">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#deposits" data-toggle="tab"
                                                  class="legitRipple"><?php echo e(trans_choice('general.deposit',2)); ?></a></li>
                            <li class=""><a href="#withdrawals" data-toggle="tab"
                                            class="legitRipple"><?php echo e(trans_choice('general.withdrawal',2)); ?></a></li>
                        </ul>



                        <div class="tab-content">
                            <div class="tab-pane active" id="deposits">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.id',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.from',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.note',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key->id); ?></td>
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td><?php echo e(round($key->amount,$usd->decimals)); ?></td>
                                                <td>
                                                    <?php if($key->bank_account): ?>
                                                        <?php if(!empty($key->bank_account->withdrawal_method)): ?>
                                                            <?php echo e($key->bank_account->withdrawal_method->name); ?>

                                                        <?php endif; ?>
                                                         (<?php echo e($key->bank_account->account_name); ?>- <?php echo e($key->bank_account->account_number); ?>)
                                                    <?php else: ?>
                                                        <?php echo e($key->account_name); ?>- <?php echo e($key->account_number); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($key->notes): ?>
                                                        <?php echo e($key->notes); ?>

                                                    <?php else: ?>
                                                        <?php echo e('-'); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($key->status=="pending"): ?>
                                                        <?php echo e(trans_choice('general.pending',1)); ?>

                                                        <a href="<?php echo e(url('wallet/deposit/'.$key->id.'/cancel')); ?>"
                                                           class="delete">
                                                            <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"
                                                               aria-hidden="true"
                                                               style="color: #797474" title=""
                                                               data-original-title="Cancel"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($key->status=="processing"): ?>
                                                        <?php echo e(trans_choice('general.processing',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->status=="cancelled"): ?>
                                                        <?php echo e(trans_choice('general.cancelled',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->status=="done"): ?>
                                                        <?php echo e(trans_choice('general.done',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->status=="accepted"): ?>
                                                        <?php echo e(trans_choice('general.accepted',1)); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="withdrawals">
                                <div class="table-responsive">
                                    <table id="data-table" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.id',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.account',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.fee',2)); ?></th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key->id); ?></td>
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td>
                                                    <?php if($key->bank_account): ?>
                                                        <?php if(!empty($key->bank_account->withdrawal_method)): ?>
                                                            <?php echo e($key->bank_account->withdrawal_method->name); ?>

                                                        <?php endif; ?>
                                                        (<?php echo e($key->bank_account->account_name); ?>- <?php echo e($key->bank_account->account_number); ?>)
                                                    <?php else: ?>
                                                        <?php echo e($key->account_name); ?>- <?php echo e($key->account_number); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(round($key->amount,$usd->decimals)); ?></td>
                                                <td><?php echo e(round( $key->fee,$usd->decimals)); ?></td>
                                                <td>
                                                    <?php if($key->status=="pending"): ?>
                                                        <?php echo e(trans_choice('general.pending',1)); ?>

                                                        <a href="<?php echo e(url('wallet/withdrawal/'.$key->id.'/cancel')); ?>"
                                                           class="delete">
                                                            <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"
                                                               aria-hidden="true"
                                                               style="color: #797474" title=""
                                                               data-original-title="Cancel"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($key->status=="processing"): ?>
                                                        <?php echo e(trans_choice('general.processing',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->status=="cancelled"): ?>
                                                        <?php echo e(trans_choice('general.cancelled',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->status=="done"): ?>
                                                        <?php echo e(trans_choice('general.done',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->status=="accepted"): ?>
                                                        <?php echo e(trans_choice('general.accepted',1)); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
</div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
    <script>
        $('.data-table').DataTable({
            "order": [[0, "desc"]],
            "columnDefs": [
                {"orderable": false, "targets": []}
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