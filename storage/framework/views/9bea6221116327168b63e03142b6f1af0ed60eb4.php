<li class="<?php if(Request::is('dashboard')): ?> active <?php endif; ?>">
    <a href="<?php echo e(url('dashboard')); ?>">
        <i class="fa fa-dashboard"></i> <span><?php echo e(trans_choice('general.dashboard',1)); ?></span>
    </a>
</li>
<?php if(Sentinel::hasAccess('currencies')): ?>
    <li class="<?php if(Request::is('trade_currency/*')): ?> active <?php endif; ?>">
        <a href="<?php echo e(url('trade_currency/data')); ?>">
            <i class="fa fa-dollar"></i> <span> <?php echo e(trans_choice('general.currency',2)); ?></span>
        </a>
    </li>
<?php endif; ?>
<?php if(Sentinel::hasAccess('repayments')): ?>
    <li class="<?php if(Request::is('order/*')): ?> active <?php endif; ?>">
        <a href="<?php echo e(url('order/data')); ?>">
            <i class="fa fa-exchange"></i> <span> <?php echo e(trans_choice('general.order',2)); ?></span>
        </a>
    </li>
<?php endif; ?>

<li class="dropdown
    <?php if(Request::is('deposit/*')): ?> active <?php endif; ?>
<?php if(Request::is('withdrawal/*')): ?> active <?php endif; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-money"></i> <span><?php echo e(trans_choice('general.transaction',2)); ?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        <?php if(Sentinel::hasAccess('deposits.view')): ?>
            <li><a href="<?php echo e(url('deposit/data')); ?>"><i
                            class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.deposit',2)); ?>

                </a></li>
        <?php endif; ?>
        <?php if(Sentinel::hasAccess('withdrawals.view')): ?>
            
            <li><a href="<?php echo e(url('withdrawals/data')); ?>"><i class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.withdrawal',2)); ?></a></li>
        <?php endif; ?>

    </ul>
</li>
<li class="dropdown
    <?php if(Request::is('deposit/*')): ?> active <?php endif; ?>
<?php if(Request::is('withdrawal/*')): ?> active <?php endif; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-money"></i> <span><?php echo e(trans_choice('general.gateway',2)); ?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        <?php if(Sentinel::hasAccess('deposits.view')): ?>
            <li><a href="<?php echo e(url('payment_gateway/data')); ?>"><i
                            class="fa fa-circle-o"></i><?php echo e(trans_choice('general.payment',1)); ?> <?php echo e(trans_choice('general.gateway',2)); ?>

                </a></li>
        <?php endif; ?>
        <?php if(Sentinel::hasAccess('withdrawals.view')): ?>
            <li><a href="<?php echo e(url('withdrawal_method/data')); ?>"><i
                            class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.withdrawal',1)); ?> <?php echo e(trans_choice('general.method',2)); ?>

                </a></li>
        <?php endif; ?>
    </ul>
</li>

<li class="dropdown <?php if(Request::is('exchange/*')): ?> active <?php endif; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-exchange"></i> <span>Exchange</span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        
            <li><a href="<?php echo e(url('exchange/buy')); ?>"><i class="fa fa-circle-o"></i>Buy History</a></li>
            <li><a href="<?php echo e(url('exchange/sell')); ?>"><i class="fa fa-circle-o"></i>Sell History</a></li>
            <li><a href="<?php echo e(url('exchange/balance')); ?>"><i class="fa fa-circle-o"></i>My Balance</a></li>


          <!--  <?php if(Sentinel::hasAccess('deposits.view')): ?>
            <li><a href="<?php echo e(url('payment_gateway/data')); ?>"><i class="fa fa-circle-o"></i><?php echo e(trans_choice('general.payment',1)); ?> <?php echo e(trans_choice('general.gateway',2)); ?>

                </a></li>
        <?php endif; ?>

        <?php if(Sentinel::hasAccess('withdrawals.view')): ?>
            <li><a href="<?php echo e(url('withdrawal_method/data')); ?>"><i
                            class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.withdrawal',1)); ?> <?php echo e(trans_choice('general.method',2)); ?>

                </a></li>
        <?php endif; ?> -->
    </ul>
</li>


<li class="dropdown
    <?php if(Request::is('communication/*')): ?> active <?php endif; ?>
<?php if(Request::is('setting/*')): ?> active <?php endif; ?>
<?php if(Request::is('offline_wallet*')): ?> active <?php endif; ?>
<?php if(Request::is('announcement*')): ?> active <?php endif; ?>
<?php if(Request::is('audit_trail/*')): ?> active <?php endif; ?>
<?php if(Request::is('user/*')): ?> active <?php endif; ?>">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-money"></i> <span><?php echo e(trans_choice('general.utility',2)); ?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        <?php if(Sentinel::hasAccess('communication')): ?>
            <li class="dropdown-submenu <?php if(Request::is('communication/*')): ?> active <?php endif; ?>
            <?php if(Request::is('sms_gateway/*')): ?> active <?php endif; ?>
                    ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i> <span><?php echo e(trans_choice('general.communication',2)); ?> </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="<?php echo e(url('communication/email')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.email',1)); ?>

                        </a></li>
                    <li><a href="<?php echo e(url('communication/sms')); ?>"><i
                                    class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.sms',2)); ?>

                        </a></li>
                    <?php if(Sentinel::hasAccess('settings')): ?>
                        <li><a href="<?php echo e(url('sms_gateway/data')); ?>"><i
                                        class="fa fa-circle-o"></i> <?php echo e(trans_choice('general.manage',2)); ?> <?php echo e(trans_choice('general.sms',1)); ?> <?php echo e(trans_choice('general.gateway',2)); ?>

                            </a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if(Sentinel::hasAccess('users')): ?>
            <li class="dropdown-submenu <?php if(Request::is('user/*')): ?> active <?php endif; ?>">
                <a href="<?php echo e(url('user/data')); ?>" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-users"></i> <span><?php echo e(trans_choice('general.user',2)); ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <?php if(Sentinel::hasAccess('users.view')): ?>
                        <li><a href="<?php echo e(url('user/data')); ?>">
                                <i class="fa fa-circle-o"></i>
                                <span><?php echo e(trans_choice('general.view',2)); ?> <?php echo e(trans_choice('general.user',2)); ?></span>
                            </a></li>
                    <?php endif; ?>
                    <?php if(Sentinel::hasAccess('users.roles')): ?>
                        <li><a href="<?php echo e(url('user/role/data')); ?>"><i
                                        class="fa fa-circle-o"></i><?php echo e(trans_choice('general.manage',2)); ?> <?php echo e(trans_choice('general.role',2)); ?>

                            </a></li>
                    <?php endif; ?>
                    <?php if(Sentinel::hasAccess('users.create')): ?>
                        <li><a href="<?php echo e(url('user/create')); ?>"><i
                                        class="fa fa-circle-o"></i><?php echo e(trans_choice('general.add',2)); ?> <?php echo e(trans_choice('general.user',2)); ?>

                            </a></li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>
        <?php if(Sentinel::hasAccess('audit_trail')): ?>
            <li class="<?php if(Request::is('audit_trail/*')): ?> active <?php endif; ?>">
                <a href="<?php echo e(url('audit_trail/data')); ?>">
                    <i class="fa fa-area-chart"></i> <span><?php echo e(trans_choice('general.audit_trail',2)); ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if(Sentinel::hasAccess('settings')): ?>
            <li class="<?php if(Request::is('offline_wallet*')): ?> active <?php endif; ?>">
                <a href="<?php echo e(url('offline_wallet/data')); ?>">
                    <i class="fa fa-google-wallet"></i>
                    <span><?php echo e(trans_choice('general.offline',1)); ?> <?php echo e(trans_choice('general.wallet',2)); ?></span>
                </a>
            </li>
            <li class="<?php if(Request::is('announcement*')): ?> active <?php endif; ?>">
                <a href="<?php echo e(url('announcement')); ?>">
                    <i class="fa fa-bullhorn"></i> <span><?php echo e(trans_choice('general.announcement',1)); ?></span>
                </a>
            </li>
            <li class="<?php if(Request::is('setting/*')): ?> active <?php endif; ?>">
                <a href="<?php echo e(url('setting/data')); ?>">
                    <i class="fa fa-cog"></i> <span><?php echo e(trans_choice('general.setting',2)); ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</li>



