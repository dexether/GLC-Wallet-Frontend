
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('general.login')); ?>

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
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
        </div>
        <?php echo Form::open(array('url' => url('login'), 'method' => 'post', 'name' => 'form','class'=>'f-login-form')); ?>

        <div class="text-center">
            <h5 class="content-group"><p class="login-box-msg"><?php echo e(trans('general.sign_in')); ?></p>
            </h5>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <?php echo Form::email('email', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.email',1),'required'=>'required')); ?>

            <div class="form-control-feedback">
                <i class="icon-envelop text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <?php echo Form::password('password', array('class' => 'form-control', 'placeholder'=>trans('login.password'),'required'=>'required')); ?>

            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <label class="checkbox-inline">
                        <input type="checkbox" name="remember" class="styled">
                        <?php echo e(trans('general.remember')); ?>

                    </label>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="<?php echo e(url('reset')); ?>"><?php echo e(trans('general.forgot_password')); ?></a>
                </div>
            </div>
        </div>
        <?php if(\App\Models\Setting::where('setting_key','enable_google_recaptcha')->first()->setting_value=="1"): ?>

            <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="g-recaptcha"
                             data-sitekey="<?php echo e(\App\Models\Setting::where('setting_key','google_recaptcha_site_key')->first()->setting_value); ?>"
                             style="width: 100%" data-callback="enableBtn"></div>
                        <script type="text/javascript"
                                src="https://www.google.com/recaptcha/api.js?">
                        </script>
                        <script>
                            function enableBtn() {
                                document.getElementById("login_btn").disabled = false;
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn bg-pink-400 btn-block" id="login_btn"
                        disabled="disabled"><?php echo e(trans('general.login')); ?> <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        <?php else: ?>
            <div class="form-group">
                <button type="submit" class="btn bg-pink-400 btn-block" id="login_btn"><?php echo e(trans('general.login')); ?> <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>
        <?php endif; ?>

        <?php echo Form::close(); ?>

        <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
        <div class="text-center">
            <a href="<?php echo e(url('register')); ?>"
               class="btn btn-default btn-block content-group legitRipple"><?php echo e(trans('general.register')); ?></a>
        </div>
    </div>
    <script>
        $(document).ready(function () {

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>