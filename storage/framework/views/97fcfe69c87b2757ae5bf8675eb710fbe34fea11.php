
<?php $__env->startSection('title'); ?>
    <?php echo e(trans_choice('general.edit',1)); ?> <?php echo e(trans_choice('general.user',1)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title"><?php echo e(trans_choice('general.edit',1)); ?> <?php echo e(trans_choice('general.user',1)); ?></h6>

            <div class="heading-elements">

            </div>
        </div>
        <?php echo Form::open(array('url' => 'user/'.$user->id.'/update','class'=>'',"enctype" => "multipart/form-data")); ?>

        <div class="panel-body">
            <?php echo Form::hidden('previous_role',$selected,array('class'=>'form-control','required'=>'required')); ?>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('first_name',trans('general.first_name'),array('class'=>'control-label')); ?>

                        <?php echo Form::text('first_name',$user->first_name,array('class'=>'form-control','required'=>'required','id'=>'first_name')); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('last_name',trans('general.last_name'),array('class'=>'control-label')); ?>

                        <?php echo Form::text('last_name',$user->last_name,array('class'=>'form-control','required'=>'required','id'=>'last_name')); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('gender',trans('general.gender'),array('class'=>'control-label')); ?>

                        <?php echo Form::select('gender', array('male' =>trans('general.male'), 'female' => trans('general.female')),$user->gender,array('class'=>'form-control')); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('dob',trans('general.dob'),array('class'=>'control-label')); ?>

                        <?php echo Form::text('dob',$user->dob,array('class'=>'form-control date-picker','id'=>'dob')); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('country_id',trans('general.country'),array('class'=>'control-label')); ?>

                        <?php echo Form::select('country_id',$countries,$user->country_id,array('class'=>'form-control select2','required'=>'required','id'=>'country')); ?>

                    </div>
                </div>
                <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>

                <?php
                if($user->address){
                    $address = explode("|", $user->address);

                    $street = $address[0];
                    $street_2 = $address[1];
                    $city = $address[2];
                    $state = $address[3];
                    $postcode = $address[4];
                }


                ?>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('city',trans('general.city'),array('class'=>'control-label')); ?>

                        <?php echo Form::text('city',$city,array('class'=>'form-control','id'=>'city')); ?>

                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('address',trans('general.address'),array('class'=>'control-label')); ?>

                        <?php echo Form::text('address',$street,array('class'=>'form-control','id'=>'address','rows'=>'2')); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group" id="">
                        <?php echo Form::label('phone',trans('general.phone'),array('class'=>'control-label')); ?>

                        <?php echo Form::number('phone',$user->phone,array('class'=>'form-control','id'=>'phone')); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group" id="">
                        <?php echo Form::label(trans_choice('general.email',1),null,array('class'=>'control-label')); ?>

                        <?php echo Form::email('email',$user->email,array('class'=>'form-control','required'=>'required')); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="">
                        <?php echo Form::label(trans('general.password'),null,array('class'=>'control-label')); ?>

                        <?php echo Form::password('password',array('class'=>'form-control')); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="">
                        <?php echo Form::label(trans('general.repeat_password'),null,array('class'=>'control-label')); ?>

                        <?php echo Form::password('rpassword',array('class'=>'form-control')); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('role',trans_choice('general.role',1),array('class'=>' control-label')); ?>

                        <?php echo Form::select('role',$role,$selected,array('class'=>'form-control')); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('email_verified',trans_choice('general.email_verified',1),array('class'=>' control-label')); ?>

                        <?php echo Form::select('email_verified',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$user->email_verified,array('class'=>'form-control')); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('phone_verified',trans_choice('general.phone_verified',1),array('class'=>' control-label')); ?>

                        <?php echo Form::select('phone_verified',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$user->phone_verified,array('class'=>'form-control')); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('documents_verified',trans_choice('general.documents_verified',1),array('class'=>' control-label')); ?>

                        <?php
                            if($user->id_picture!='' && $user->proof_of_residence_picture!='')
                               $disabled=  "";
                                else
                                 $disabled=  "disabled =>true";


                        ?>
                        <br>

                        <?php if(Sentinel::getUser()->proof_of_residence_picture): ?>
                                                             <a  target="_blank" href="<?php echo e(URL::asset('uploads/'.Sentinel::getUser()->proof_of_residence_picture)); ?>">proof_of_residence_picture :: <?php echo e(Sentinel::getUser()->proof_of_residence_picture); ?></a>
                        <?php endif; ?>
                        <br>
                                                              <?php if(Sentinel::getUser()->id_picture): ?>
                                                               <a target="_blank" href="<?php echo e(URL::asset('uploads/'.Sentinel::getUser()->id_picture)); ?>">id_picture <?php echo e(Sentinel::getUser()->id_picture); ?></a>

                                                               <?php endif; ?>

                        <?php echo Form::select('documents_verified',array('1'=>trans_choice('general.yes',1),'0'=>trans_choice('general.no',1)),$user->documents_verified,array('class'=>'form-control',$disabled )); ?>

                    </div>
                    <span ><?php if($user->id_picture=='' || $user->proof_of_residence_picture==''): ?> No documents uploaded by user <?php elseif($user->id_picture!='' || $user->proof_of_residence_picture!=''): ?> documents uploaded by user <?php endif; ?></span>
                </div>
            </div>

        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <div class="heading-elements">
                <button type="submit" class="btn btn-primary pull-right"><?php echo e(trans_choice('general.save',1)); ?></button>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>