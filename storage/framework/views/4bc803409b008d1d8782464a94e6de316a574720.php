
<?php $__env->startSection('title'); ?>
    Ethereum <?php echo e(trans_choice('general.wallet',1)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="modal fade text-center" id="myModaleth" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <!--<div class="modal-header border-model">-->
        <!--  <button type="button" class="close" data-dismiss="modal">&times;</button>-->
        <!--  <h4 class="modal-title">Modal Header</h4>-->
        <!--</div>-->
        <div class="modal-body">

            <div class="p-5">
                <div class="qr_data">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="model-title"><b>Use this address to receive eth in your wallet</b></h2>
                        </div>
                        <div class="col-sm-12">
                                    <img
                                    src="data:image/png;base64, <?php echo e(DNS2D::getBarcodePNG($wallet->address, "QRCODE",5,5)); ?>"
                                    alt="barcode"/>
                        </div>
                        <div class="col-sm-12">
                            <h4><?php echo e(trans_choice('general.my_address',1)); ?></h4>
                            <h6><b><?php echo e($wallet->address); ?></b></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
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
            <div class="btc_wall">
                          <div class="panel panel-white">
                    <div class="panel-heading">
                    <h6 class="panel-title"> Ethereum Wallet<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                         <?php if(session('error')): ?><br><div class="alert alert-danger"><?php echo e(session('error')); ?></div><br><?php endif; ?>
                        <div class="qr_sec">

                        <?php if(empty($wallet->address)): ?>
                        <div class="alert alert-warning alert-bordered">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                        class="sr-only">Close</span></button>
                            <?php echo e(trans_choice('general.no_address',1)); ?>

                        </div>
                      
<?php if(!empty($wallet->wallet_id)): ?>

          <form action="<?php echo e(url('wallets/show_address')); ?>" method="post" >
                          <?php echo e(csrf_field()); ?>

                          <input class="form-control cust_fld" id="name" name="coin" value="teth" type="hidden">
                            <div class="act_btns withdrw_btc">        
                                    <button type="submit" class="btn btn-default  btn-xs send_rec">
                                       Show Address
                                   </button>
                             </div>
                        </form>


<?php else: ?>
                       <form action="<?php echo e(url('wallets/create_address')); ?>" method="post" >
                          <?php echo e(csrf_field()); ?>

                        <input class="form-control cust_fld" id="name" name="coin" value="teth" type="hidden">
                            <div class="act_btns withdrw_btc">        
                                    <button type="submit" class="btn btn-default  btn-xs send_rec">
                                       <i class="fa fa-plus"></i> <?php echo e(trans_choice('general.new',1)); ?> <?php echo e(trans_choice('general.address',1)); ?>

                                   </button>
                             </div>
                        </form>
<?php endif; ?>
          
                    <?php else: ?>
                    <div class="qr_data">
                        <div class="row">
                            <div class="col-sm-3">
                            <img
                                    src="data:image/png;base64, <?php echo e(DNS2D::getBarcodePNG($wallet->address, "QRCODE",5,5)); ?>"
                                    alt="barcode"/>
                            </div>
                            <div class="col-sm-9">
                        <h4><?php echo e(trans_choice('general.my_address',1)); ?></h4>
                        <p><b><?php echo e($wallet->address); ?></b>
                            <?php if(\App\Models\Setting::where('setting_key','wallet_address_limit')->first()->setting_value>\App\Models\WalletAddress::where('user_id',Sentinel::getUser()->id)->where('trade_currency_id',$eth->id)->count()): ?>
                                <div class="act_btns withdrw_btc">        
                                    <a href="<?php echo e(url('wallet/generate_address?coin=eth')); ?>"
                                       class="btn btn-default  btn-xs send_rec"><i class="fa fa-plus"></i> <?php echo e(trans_choice('general.new',1)); ?> <?php echo e(trans_choice('general.address',1)); ?>

                                    </a>
                                 </div>
                            <?php endif; ?>
                        </p>
                    </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    </div>
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#deposits" data-toggle="tab"
                                                  class="legitRipple"><?php echo e(trans_choice('general.deposit',2)); ?></a></li>
                            <li class=""><a href="#withdrawals" data-toggle="tab"
                                            class="legitRipple"><?php echo e(trans_choice('general.withdrawal',2)); ?></a></li>
                        </ul>

                        <div class="tab-content wallet_tble">
                             <div class="tab-pane active" id="deposits">
                                <div class="table-responsive">
                                    <table id="deposits1" class="table table-striped table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.trans_id',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th>Receiver Address </th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td>
                                                    <a href="https://live.blockcypher.com/btc/tx/<?php echo e($key->transaction_id); ?>"
                                                       target="_blank"> <?php echo e(substr($key->transaction_id,0,32)); ?>...</a>
                                                </td>
                                                <td><?php echo e(round($key->amount,$btc->decimals)); ?></td>
                                                <td><?php echo e($key->receiver_address); ?></td>
                                                <td>
                                                    <?php if($key->status=="pending"): ?>
                                                        <?php echo e(trans_choice('general.pending',1)); ?>

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
                                    <table id="withdrawals1" class="table table-striped table-condensed table-hover">
                                        <thead>
                                        <tr>
                                          
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th>TXID</th>
                                            <th>SENDER ADDRESS</th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                               
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td><?php echo e(round($key->amount,$btc->decimals)); ?></td>
                                                <td><?php echo e($key->transaction_id); ?></td>
                                                <td><?php echo e($key->sender_address); ?></td>
                                                <td>
                                                    <?php if($key->status=="pending"): ?>
                                                        <?php echo e(trans_choice('general.pending',1)); ?>

                                                        <!--<a href="<?php echo e(url('wallet/withdrawal/'.$key->id.'/cancel')); ?>"-->
                                                        <!--   class="delete">-->
                                                        <!--    <i data-toggle="tooltip" class="fa fa-times-circle-o fa-2x"-->
                                                        <!--       aria-hidden="true"-->
                                                        <!--       style="color: #797474" title=""-->
                                                        <!--       data-original-title="Cancel"></i>-->
                                                        <!--</a>-->
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
<!--               <div class="col-sm-2">-->
<!--                        <div class="act_btns withdrw_btc">        -->
<!--                        <a href="<?php echo e(url('wallets/eth/send')); ?>"-->
<!--                           class="btn btn-default send_rec">-->
<!--<i class="fa fa-paper-plane" aria-hidden="true"></i> Send-->
<!--                        </a>-->
<!--                         </div>-->
<!--                    </div>-->
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
            $('#deposits1').DataTable();
        $('#withdrawals1').DataTable();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>