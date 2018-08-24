
<?php $__env->startSection('title'); ?>
    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></h6>
                    <div class="heading-elements">

                    </div>
                </div>

                    <?php


                         $address = explode("|", $user->address);

                        $street = $address[0];
                        $street_2 = $address[1];
                        $city = $address[2];
                        $state = $address[3];
                        $postcode = $address[4];

                    ?>

                <div class="panel-body">
                    <table class="table table-responsive table-hover">
                        <tr>
                            <td><?php echo e(trans('general.gender')); ?></td>
                            <td><?php echo e($user->gender); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans_choice('general.email',1)); ?></td>
                            <td><?php echo e($user->email); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.email_verified')); ?></td>
                            <td>
                                <?php if($user->email_verified==1): ?>
                                    <?php echo e(trans('general.yes')); ?>

                                <?php else: ?>
                                    <?php echo e(trans('general.no')); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.phone')); ?></td>
                            <td><?php echo e($user->phone); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.phone_verified')); ?></td>
                            <td>
                                <?php if($user->phone_verified==1): ?>
                                    <?php echo e(trans('general.yes')); ?>

                                <?php else: ?>
                                    <?php echo e(trans('general.no')); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.dob')); ?></td>
                            <td><?php echo e($user->dob); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.country')); ?></td>
                            <td>
                                <?php if(!empty($user->country)): ?>
                                    <?php echo e($user->country->name); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.city')); ?></td>
                            <td><?php echo e($user->city); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.address')); ?></td>
                            <td><?php echo $street.'|'.$street_2; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.zip')); ?></td>
                            <td><?php echo e($postcode); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.documents_verified')); ?></td>
                            <td>
                                <?php if($user->documents_verified==1): ?>
                                    <?php echo e(trans('general.yes')); ?>

                                <?php else: ?>
                                    <?php echo e(trans('general.no')); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans_choice('general.id',1)." ".trans_choice('general.type',1)); ?></td>
                            <td>
                                <?php if($user->id_type=="id_card"): ?>
                                    <?php echo e(trans('general.id_card')); ?>

                                <?php endif; ?>
                                <?php if($user->id_type=="passport"): ?>
                                    <?php echo e(trans('general.passport')); ?>

                                <?php endif; ?>
                                <?php if($user->id_type=="driver_license"): ?>
                                    <?php echo e(trans('general.driver_license')); ?>

                                <?php endif; ?>
                                <?php if(!empty($user->id_picture)): ?>
                                    <br>
                                    <a href="<?php echo e(asset('uploads/'.$user->id_picture)); ?>"
                                       target="_blank"><?php echo e($user->id_picture); ?></a>
                                <?php endif; ?>
                                 <span ><?php if($user->id_picture!='' && $user->proof_of_residence_picture!=''): ?> No documents uploaded by user <?php endif; ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans_choice('general.proof_of_residence_type',1)); ?></td>
                            <td>
                                <?php if($user->proof_of_residence_type=="bank_statement"): ?>
                                    <?php echo e(trans('general.bank_statement')); ?>

                                <?php endif; ?>
                                <?php if($user->proof_of_residence_type=="utility_bill"): ?>
                                    <?php echo e(trans('general.utility_bill')); ?>

                                <?php endif; ?>

                                <?php if(!empty($user->proof_of_residence_picture)): ?>
                                    <br>
                                    <a href="<?php echo e(asset('uploads/'.$user->proof_of_residence_picture)); ?>"
                                       target="_blank"><?php echo e($user->proof_of_residence_picture); ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.created_at')); ?></td>
                            <td><?php echo e($user->created_at); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.updated_at')); ?></td>
                            <td><?php echo e($user->updated_at); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('general.last_login')); ?></td>
                            <td><?php echo e($user->last_login); ?></td>
                        </tr>
                            
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <?php
            $usd = \App\Models\TradeCurrency::where('default_currency', 1)->first();
            $btc = \App\Models\TradeCurrency::where('network', "bitcoin")->first();
            $dogecoin = \App\Models\TradeCurrency::where('network', "dogecoin")->first();
            $ltc = \App\Models\TradeCurrency::where('network', "litecoin")->first();
            ?>
            <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-green has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin"><?php echo e(number_format(\App\Helpers\GeneralHelper::user_usd_balance($user->id)-\App\Helpers\GeneralHelper::user_usd_locked_balance($user->id),2)); ?></h3>
                                <span class="text-uppercase text-size-mini"><?php echo e($usd->xml_code); ?> <?php echo e(trans_choice('general.balance',1)); ?></span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-blue-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin"><?php echo e(round(\App\Helpers\GeneralHelper::user_btc_balance($user->id)-\App\Helpers\GeneralHelper::user_btc_locked_balance($user->id),$btc->decimals)); ?></h3>
                                <span class="text-uppercase text-size-mini"><?php echo e($btc->xml_code); ?> <?php echo e(trans_choice('general.balance',1)); ?></span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-orange-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin"><?php echo e(round(\App\Helpers\GeneralHelper::user_dogecoin_balance($user->id)-\App\Helpers\GeneralHelper::user_dogecoin_locked_balance($user->id),$dogecoin->decimals)); ?></h3>
                                <span class="text-uppercase text-size-mini"><?php echo e($dogecoin->xml_code); ?> <?php echo e(trans_choice('general.balance',1)); ?></span>
                            </div>

                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-body bg-blue-400 has-bg-image">
                        <div class="media no-margin">
                            <div class="media-body">
                                <h3 class="no-margin"> <?php echo e(round(\App\Helpers\GeneralHelper::user_ltc_balance($user->id)-\App\Helpers\GeneralHelper::user_ltc_locked_balance($user->id),$ltc->decimals)); ?></h3>
                                <span class="text-uppercase text-size-mini"><?php echo e($ltc->xml_code); ?> <?php echo e(trans_choice('general.balance',1)); ?></span>
                            </div>
                            <div class="media-right media-middle">
                                <i class="icon-wallet icon-3x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo e(trans_choice('general.activity',2)); ?></h3>
                    <div class="heading-elements">

                    </div>
                </div>
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#deposits" data-toggle="tab"
                                                  class="legitRipple"><?php echo e(trans_choice('general.deposit',2)); ?></a></li>
                            <li class=""><a href="#withdrawals" data-toggle="tab"
                                            class="legitRipple"><?php echo e(trans_choice('general.withdrawal',2)); ?></a></li>
                            <li class=""><a href="#orders" data-toggle="tab"
                                            class="legitRipple"><?php echo e(trans_choice('general.order',2)); ?></a></li>
                            <li class=""><a href="#bank_accounts" data-toggle="tab"
                                            class="legitRipple"><?php echo e(trans_choice('general.bank',1)); ?> <?php echo e(trans_choice('general.account',2)); ?></a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="deposits">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.id',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.currency',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.account',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.action',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = \App\Models\Deposit::where('user_id',$user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                                            ?>
                                            <tr>
                                                <td><?php echo e($key->id); ?></td>

                                                <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>

                                                <td>
                                                    <?php if(!empty($trade_currency)): ?>
                                                        <?php echo e($trade_currency->xml_code); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(number_format($key->amount,2)); ?></td>
                                                <td>
                                                    <?php if($key->network!="usd"): ?>
                                                        <?php echo e($key->receiver_address); ?>

                                                    <?php else: ?>
                                                        <?php echo e(trans_choice('general.method',1)); ?>:
                                                        <?php if(!empty($key->deposit_method)): ?>
                                                            <?php echo e($key->deposit_method->name); ?>

                                                        <?php endif; ?>
                                                        <br>
                                                        <?php echo e(trans_choice('general.name',1)); ?>:<?php echo e($key->account_name); ?><br>
                                                        <?php echo e(trans_choice('general.number',1)); ?>:<?php echo e($key->account_number); ?>

                                                        <br>
                                                        <?php echo e(trans_choice('general.address',1)); ?>:<?php echo e($key->address); ?><br>
                                                    <?php endif; ?>
                                                </td>
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
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                <?php if(Sentinel::hasAccess('borrowers.update')): ?>
                                                                    <li>
                                                                        <a href="<?php echo e(url('deposit/'.$key->id.'/cancel')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.cancel')); ?> </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('deposit/'.$key->id.'/pending')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.pending')); ?> </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('deposit/'.$key->id.'/processing')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.processing')); ?> </a>
                                                                    </li>
                                                                    <li><a href="<?php echo e(url('deposit/'.$key->id.'/done')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.done')); ?> </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if(Sentinel::hasAccess('borrowers.delete')): ?>
                                                                    <li>
                                                                        <a href="<?php echo e(url('deposit/'.$key->id.'/delete')); ?>"
                                                                           class="delete"> <?php echo e(trans('general.delete')); ?>

                                                                        </a>
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
                            <div class="tab-pane " id="withdrawals">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.id',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.currency',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.account',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.action',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = \App\Models\Withdrawal::where('user_id',$user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                                            ?>
                                            <tr>
                                                <td><?php echo e($key->id); ?></td>


                                                <td>
                                                    <?php if(!empty($trade_currency)): ?>
                                                        <?php echo e($trade_currency->xml_code); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(number_format($key->amount,2)); ?></td>
                                                <td>
                                                    <?php if($key->network!="usd"): ?>
                                                        <?php echo e($key->receiver_address); ?>

                                                    <?php else: ?>
                                                        <?php echo e(trans_choice('general.method',1)); ?>:
                                                        <?php if(!empty($key->withdrawal_method)): ?>
                                                            <?php echo e($key->withdrawal_method->name); ?>

                                                        <?php endif; ?>
                                                        <br>
                                                        <?php echo e(trans_choice('general.name',1)); ?>:<?php echo e($key->account_name); ?><br>
                                                        <?php echo e(trans_choice('general.number',1)); ?>:<?php echo e($key->account_number); ?>

                                                        <br>
                                                        <?php echo e(trans_choice('general.address',1)); ?>:<?php echo e($key->address); ?><br>
                                                    <?php endif; ?>
                                                </td>
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
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                <?php if(Sentinel::hasAccess('borrowers.update')): ?>
                                                                    <li>
                                                                        <a href="<?php echo e(url('withdrawal/'.$key->id.'/cancel')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.cancel')); ?> </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('withdrawal/'.$key->id.'/pending')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.pending')); ?> </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('withdrawal/'.$key->id.'/processing')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.processing')); ?> </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('withdrawal/'.$key->id.'/done')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.done')); ?> </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if(Sentinel::hasAccess('borrowers.delete')): ?>
                                                                    <li>
                                                                        <a href="<?php echo e(url('withdrawal/'.$key->id.'/delete')); ?>"
                                                                           class="delete"> <?php echo e(trans('general.delete')); ?>

                                                                        </a>
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
                            <div class="tab-pane " id="orders">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.id',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.type',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.market',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.price',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.volume',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.amount',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.time',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.action',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = \App\Models\OrderBook::where('user_id',$user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            $trade_currency = \App\Models\TradeCurrency::find($key->trade_currency_id);
                                            $default = \App\Models\TradeCurrency::where('default_currency', 1)->first();
                                            ?>
                                            <tr>
                                                <td><?php echo e($key->id); ?></td>
                                                <td>
                                                    <?php if($key->order_type=="ask"): ?>
                                                        <?php echo e(trans_choice('general.ask',1)); ?>

                                                    <?php endif; ?>
                                                    <?php if($key->order_type=="bid"): ?>
                                                        <?php echo e(trans_choice('general.bid',1)); ?>

                                                    <?php endif; ?>
                                                </td>
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

                                                        <i class="fa fa-link" data-toggle="tooltip"
                                                           title="<?php echo e($key->linked_order_id); ?>"></i>
                                                    <?php endif; ?>
                                                    <?php if($key->status=="accepted"): ?>
                                                        <?php echo e(trans_choice('general.accepted',1)); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(!empty($trade_currency)): ?>
                                                        <?php echo e($trade_currency->xml_code); ?>/
                                                    <?php endif; ?>
                                                    <?php if(!empty($default)): ?>
                                                        <?php echo e($default->xml_code); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(number_format($key->price,2)); ?></td>
                                                <td><?php echo e(round( $key->volume,6)); ?></td>
                                                <td><?php echo e(number_format($key->amount,2)); ?></td>
                                                <td><?php echo e($key->created_at); ?></td>
                                                <td class="text-center">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                                <?php if(Sentinel::hasAccess('borrowers.update')): ?>
                                                                    <li><a href="<?php echo e(url('order/'.$key->id.'/cancel')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.cancel')); ?> </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('order/'.$key->id.'/pending')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.pending')); ?> </a>
                                                                    </li>
                                                                    <li><a href="<?php echo e(url('order/'.$key->id.'/done')); ?>"
                                                                           class="delete">
                                                                            <?php echo e(trans('general.done')); ?> </a>
                                                                    </li>
                                                                <?php endif; ?>
                                                                <?php if(Sentinel::hasAccess('borrowers.delete')): ?>
                                                                    <li><a href="<?php echo e(url('order/'.$key->id.'/delete')); ?>"
                                                                           class="delete"> <?php echo e(trans('general.delete')); ?>

                                                                        </a>
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
                            <div class="tab-pane " id="bank_accounts">
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-condensed table-hover data-table">
                                        <thead>
                                        <tr>
                                            <th><?php echo e(trans_choice('general.bank',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.account',1)); ?> <?php echo e(trans_choice('general.name',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.account',1)); ?> <?php echo e(trans_choice('general.number',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.agency_number',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.cpf_number',1)); ?></th>
                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $user->bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php if(!empty($key->withdrawal_method)): ?>
                                                        <?php echo e($key->withdrawal_method->name); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($key->account_name); ?></td>
                                                <td>
                                                    <?php echo e($key->account_number); ?>

                                                    <?php if($key->default_account==1): ?>
                                                        <span class="label label-success" data-toggle="tooltip"
                                                              title="Default"><i
                                                                    class="fa fa-check"></i> </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($key->agency_number); ?></td>
                                                <td><?php echo e($key->cpf_number); ?></td>
                                                <td>
                                                    <?php if($key->active==1): ?>
                                                        <span class="label label-success"><?php echo e(trans_choice('general.active',1)); ?></span>
                                                    <?php endif; ?>
                                                    <?php if($key->active==0): ?>
                                                        <span class="label label-warning"><?php echo e(trans_choice('general.inactive',1)); ?></span>
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
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
    <script>
        $('.data-table').DataTable({
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
                },
                "columnDefs": [
                    {"orderable": false, "targets": 0}
                ]
            },
            responsive: true,
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>