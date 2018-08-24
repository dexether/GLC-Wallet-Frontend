
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('general.register')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-5 col-lg-offset-3">
            <div class="panel  registration-form">
                <div class="panel-body">
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
                        <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                    </div>
                    <?php echo Form::open(array('url' => url('register'), 'method' => 'post', 'name' => 'form','class'=>'register-form')); ?>

                    <div class="text-center">
                        <h5 class="content-group-lg"><?php echo e(trans('general.sign_up')); ?>

                            <small class="display-block"><?php echo e(trans('general.all_fields_required')); ?></small>
                        </h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <?php echo Form::text('first_name', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.first_name',1),'required'=>'required','id'=>'first_name')); ?>

                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <?php echo Form::text('last_name', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.last_name',1),'required'=>'required','id'=>'last_name')); ?>

                                <div class="form-control-feedback">
                                    <i class="icon-user-check text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-feedback has-feedback">
                        <?php echo Form::email('email', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.email',1),'required'=>'required','id'=>'email')); ?>

                        <div class="form-control-feedback">
                            <i class="icon-envelop text-muted"></i>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-md-4">
                    <div class="form-group has-feedback has-feedback">

                        <?php echo Form::select('code',array(''=>'Country Code','91'=>'IN (+91)','971' => 'UAE (+971) ','1'=>'USA (+1)',),old('code'),array('class' => 'select form-control','required'=>'required','id'=>'code')); ?>


                        <div class="form-control-feedback">

                        </div>
                    </div>
                            </div>
                            <div class="col-md-8">
                        <div class="form-group has-feedback has-feedback">

                        <?php echo Form::text('phone', null, array('class' => 'form-control', 'placeholder'=>trans_choice('general.phone',1),'required'=>'required','id'=>'phone')); ?>

                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>
                    </div>

                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <?php echo Form::password('password', array('class' => 'form-control', 'placeholder'=>trans('general.password'),'required'=>'required','id'=>'password')); ?>

                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <?php echo Form::password('repeat_password', array('class' => 'form-control', 'placeholder'=>trans('general.repeat_password'),'required'=>'required','id'=>'repeat_password')); ?>

                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="newsletter" class="styled" checked="checked"
                                       id="newsletter">
                                <?php echo e(trans('general.subscribe_to_newsletter')); ?>

                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="terms" class="styled" checked="checked" id="terms"
                                       required>
                                <?php echo e(trans('general.accept_terms')); ?>

                            </label>
                        </div>
                    </div>

                    <div class="text-right">
                        <a href="<?php echo e(url('login')); ?>" class="btn btn-link"><i
                                    class="icon-arrow-left13 position-left"></i> <?php echo e(trans('general.back')); ?>

                            <?php echo e(trans('general.to')); ?> <?php echo e(trans('general.login')); ?>

                        </a>
                        <button type="submit" class="btn bg-teal-400 "> <?php echo e(trans('general.sign_up')); ?>

                        </button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
    <script>
        $.validator.addMethod('mypassword', function (value, element) {
                return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
            },
            'Password must contain at least one numeric and one alphabetic character.');

        $.validator.addMethod('phone', function (value, element) {
                return this.optional(element) || (value.match(/[0-9]/));
            },
            'Invalid mobile number, please enter with country code.');



        $(".register-form").validate({
            rules: {
                field: {
                    required: true,
                    step: 10
                },
                code: {
                    required: true,
                  },
                password: {
                    required: true,
                    minlength: 6,
                    mypassword: true
                },
                repeat_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },

            }, highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });




    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>