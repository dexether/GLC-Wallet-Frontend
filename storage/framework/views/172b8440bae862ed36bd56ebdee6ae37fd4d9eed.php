
<?php $__env->startSection('title'); ?>
    Send   <?php echo e($btc->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section>
      <div class="pageContent wallets">
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
            <div class="panel panel-white with_drw">
                <div class="panel-heading">
                    <h6 class="panel-title"> Send  <?php echo e($btc->name); ?></h6>

                    <div class="heading-elements">

                    </div>
                </div>
                <?php echo Form::open(array('url' => url('wallets/send/btc'), 'method' => 'post', 'id' => 'send-form',"enctype"=>"multipart/form-data")); ?>

                
                <div class="panel-body ">
                    <span id="otpSuccess"></span>
                    <span id="otpError"></span>
                    
        <?php if(session('success')): ?><br><div class="alert alert-success" id="success"><?php echo e(session('success')); ?></div><br><?php endif; ?>
                  <?php if(session('error')): ?><br><div class="alert alert-danger" id="error"><?php echo e(session('error')); ?></div><br><?php endif; ?>
                    <div class="form-group">
                        <?php echo Form::label('receiver_address',trans_choice('general.address',1),array('class'=>'')); ?>

                        <?php echo Form::text('receiver_address',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'receiver_address')); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('amount',trans_choice('general.amount',1),array('class'=>'')); ?>

                        <?php echo Form::text('amount',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'amount')); ?>

                    </div>
                     <div class="form-group">
                        <?php echo Form::label('otp','OTP',array('class'=>'')); ?>

                        <?php echo Form::text('otp',null, array('class' => 'form-control cust_fld', 'required'=>"required",'id'=>'otp')); ?>

                    <a id="sendOTP">Send OTP</a>
                    </div>
                    
                    <div class="act_btns withdrw_btc">        
                        <button type="submit" class="btn btn-default  btn-xs send_rec pull-left"
                                id="submit_form"><i class="fa fa-paper-plane" aria-hidden="true"></i>Send</button>
                         </div>
                </div>
                
                <?php echo Form::close(); ?>

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

    $("#sendOTP").click(function(){
     $.ajax({
            type:"GET",
            url:"<?php echo e(url('wallets/send/otp')); ?>",
                 success:function(res){
            if(res == 'success'){
              $("#otpSuccess").html('<div class="alert alert-success" id="">OTP Send Successfully..</div>');
              $("#success").html('');
              $("#error").html('');
            } else if(res == 'error') {
                $("#otpError").html('<div class="alert alert-danger" id="">Please update your mobile no.</div>');
                 $("#success").html('');
              $("#error").html('');
               
           }
         }
       });
});
        $("#withdraw-form").validate({
            rules: {
                field: {
                    required: true,
                    step: 10
                }
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
        $("#amount").blur(function (e) {
           //update fees
            var amount=$("#amount").val();
            var withdrawal_fixed_fee=$("#withdrawal_fixed_fee").val();
            var withdrawal_percentage_fee=$("#withdrawal_percentage_fee").val();
            if($("#fee_method").val()==="fixed"){
                $("#fee").val(withdrawal_fixed_fee);
                $("#total").val(amount-withdrawal_fixed_fee);
            }
            if($("#fee_method").val()==="percentage"){
                $("#fee").val((withdrawal_percentage_fee*amount/100));
                $("#total").val(amount-(withdrawal_percentage_fee*amount/100));
            }
            if($("#fee_method").val()==="both"){
                $("#fee").val((withdrawal_percentage_fee*amount/100)+withdrawal_fixed_fee);
                $("#total").val(amount-(withdrawal_percentage_fee*amount/100)-withdrawal_fixed_fee);
            }
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>