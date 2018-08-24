
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('general.reset')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-body login-form">
        <?php if(Session::has('flash_notification.message')): ?>
            <script>toastr.<?php echo e(Session::get('flash_notification.level')); ?>('<?php echo e(Session::get("flash_notification.message")); ?>', 'Response Status')</script>
        <?php endif; ?>
        <?php if(isset($msg)): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo e($msg); ?>

            </div>
        <?php endif; ?>
        <?php if(isset($error)): ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php echo e($error); ?>

            </div>
        <?php endif; ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="text-center">
            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
        </div>
        <?php echo Form::open(array('url' => url('reset'), 'method' => 'post', 'name' => 'form','class'=>'f-login-form')); ?>

        <div class="text-center">
            <h5 class="content-group"><?php echo e(trans('general.reset')); ?>

                <small class="display-block"><?php echo e(trans('general.forgot_password_msg')); ?></small>
            </h5>
        </div>
        <div class="form-group has-feedback has-feedback">
            <?php echo Form::email('email', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.email',1),'required'=>'required')); ?>

            <div class="form-control-feedback">
                <i class="icon-envelop text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-pink-400 btn-block"><?php echo e(trans('general.reset')); ?> <i
                        class="icon-arrow-right14 position-right"></i></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <script>
        $(document).ready(function () {

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>