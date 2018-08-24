
<?php $__env->startSection('title'); ?>
    <?php echo e(trans_choice('general.user',2)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="pageContent">
    <div class="container">
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"><?php echo e(trans_choice('general.user',2)); ?></h6>

            <div class="heading-elements">
                <?php if(Sentinel::hasAccess('users.create')): ?>
                    <a href="<?php echo e(url('user/create')); ?>" class="btn btn-info btn-xs">
                        <?php echo e(trans_choice('general.add',1)); ?> <?php echo e(trans_choice('general.user',1)); ?>

                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table  table-striped table-hover table-condensed" id="data-table">
                <thead>
                <tr>
                    <th><?php echo e(trans('general.name')); ?></th>
                    <th><?php echo e(trans('general.gender')); ?></th>
                    <th><?php echo e(trans('general.phone')); ?></th>
                    <th><?php echo e(trans_choice('general.email',1)); ?></th>
                    <th><?php echo e(trans('general.address')); ?></th>
                    <th><?php echo e(trans_choice('general.role',1)); ?></th>
                    <th><?php echo e(trans_choice('general.action',1)); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key->first_name); ?> <?php echo e($key->last_name); ?></td>
                        <td><?php echo e($key->gender); ?></td>
                        <td><?php echo e($key->phone); ?></td>
                        <td><?php echo e($key->email); ?></td>
                        <td><?php echo $key->address; ?></td>
                        <td>
                            <?php if(!empty($key->roles)): ?>
                                <?php if(!empty( $key->roles->first())): ?>
                                    <span class="label label-danger"><?php echo e($key->roles->first()->name); ?> </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <?php if(Sentinel::hasAccess('users.view')): ?>
                                            <li>
                                                <a href="<?php echo e(url('user/'.$key->id.'/show')); ?>"><i
                                                            class="fa fa-search"></i>
                                                    <?php echo e(trans_choice('general.detail',2)); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Sentinel::hasAccess('users.update')): ?>
                                            <li>
                                                <a href="<?php echo e(url('user/'.$key->id.'/edit')); ?>"><i
                                                            class="fa fa-edit"></i>
                                                    <?php echo e(trans('general.edit')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if(Sentinel::hasAccess('users.delete')): ?>
                                            <li>
                                                <a href="<?php echo e(url('user/'.$key->id.'/delete')); ?>"
                                                   class="delete"><i
                                                            class="fa fa-trash"></i>
                                                    <?php echo e(trans('general.delete')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>

    <script>

        $('#data-table').DataTable({
            "order": [[0, "asc"]],
            "columnDefs": [
                {"orderable": false, "targets": [6]}
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