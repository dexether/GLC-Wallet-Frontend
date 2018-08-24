<ul class="media-list media-list-linked media-list-bordered wallet_data" id="media-act">

        <li class="media <?php echo e(Request::path() == 'wallets/aed' ? 'active' : ''); ?>">
            
        
            <a href="<?php echo e(url('wallets/aed')); ?>" class="media-link">
                <div class="media-left">
                    <?php if(empty($usd->logo)): ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(245, 195, 61)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM19.644,15.576 C19.404,15.169 19.080,14.852 18.670,14.625 C18.387,14.464 17.977,14.315 17.443,14.181 C17.942,14.014 18.342,13.802 18.647,13.546 C18.950,13.289 19.182,12.994 19.345,12.660 C19.506,12.325 19.587,11.972 19.587,11.599 C19.587,11.087 19.434,10.617 19.130,10.188 C18.824,9.759 18.388,9.430 17.821,9.201 C17.492,9.068 17.083,8.978 16.612,8.922 L16.612,7.001 L15.013,7.001 L15.013,8.857 L13.986,8.857 L13.986,7.001 L12.387,7.001 L12.387,8.857 L8.994,8.857 L8.994,10.419 L9.444,10.419 C9.743,10.419 9.947,10.446 10.054,10.500 C10.160,10.553 10.235,10.627 10.279,10.718 C10.323,10.810 10.344,11.023 10.344,11.357 L10.344,17.651 C10.344,17.980 10.322,18.192 10.279,18.286 C10.235,18.381 10.161,18.453 10.054,18.504 C9.947,18.555 9.743,18.582 9.444,18.582 L8.994,18.582 L8.994,20.143 L12.387,20.143 L12.387,21.998 L13.985,21.998 L13.985,20.143 L14.978,20.143 C14.989,20.143 15.001,20.143 15.013,20.143 L15.013,21.998 L16.611,21.998 L16.611,20.051 C17.127,19.985 17.561,19.884 17.907,19.746 C18.574,19.482 19.092,19.098 19.456,18.593 C19.821,18.089 20.004,17.537 20.004,16.938 C20.004,16.438 19.884,15.983 19.644,15.576 ZM15.893,18.205 C15.574,18.294 15.173,18.339 14.689,18.339 L13.855,18.339 C13.577,18.339 13.408,18.324 13.345,18.295 C13.282,18.265 13.238,18.213 13.210,18.137 C13.187,18.077 13.174,17.877 13.168,17.530 L13.168,15.087 L14.646,15.087 C15.294,15.087 15.777,15.147 16.092,15.265 C16.408,15.383 16.645,15.559 16.803,15.791 C16.961,16.024 17.040,16.307 17.040,16.641 C17.041,17.034 16.929,17.371 16.706,17.651 C16.483,17.931 16.212,18.116 15.893,18.205 ZM15.874,13.267 C15.561,13.376 15.076,13.430 14.421,13.430 L13.169,13.430 L13.169,10.678 L14.421,10.678 C15.153,10.678 15.660,10.722 15.944,10.811 C16.228,10.900 16.444,11.051 16.595,11.260 C16.744,11.471 16.820,11.724 16.820,12.022 C16.820,12.307 16.741,12.559 16.582,12.778 C16.424,12.997 16.188,13.160 15.874,13.267 Z"/>
                          </svg>
                    <?php else: ?>
                       <img src="<?php echo e(url('assets/themes/limitless/images/aed-1.png')); ?>">
                    <?php endif; ?>
                </div>
                <div class="media-body">

                    <h2><?php echo e($usd->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>

                    
                    
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>: <?php echo e(@round(\App\Models\WalletAddress::where('coin','aed')->where("user_id",Sentinel::getUser()->id)->first()->balance)); ?></span>
                    
                </div>
            </a>
            <div class="act_btns">

                        
                        <a href="<?php echo e(url('wallets/aed/deposit')); ?>" class="btn btn-default send_rec"><i class="fa fa-paper-plane" aria-hidden="true"></i> Deposit</a>
                        
                        <a href="<?php echo e(url('wallets/aed/withdraw')); ?>" class="btn btn-default send_rec"><i class="fa fa-qrcode" aria-hidden="true"></i> Withdraw</a>
                    </div>
        </li>



        <?php if($btc->active==1): ?>

        <li class="media <?php echo e(Request::path() == 'wallets/btc' ? 'active' : ''); ?>">
            <a href="<?php echo e(url('wallets/btc')); ?>" class="media-link" >
                <div class="media-left">
                    <?php if(empty($btc->logo)): ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(245, 195, 61)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM19.644,15.576 C19.404,15.169 19.080,14.852 18.670,14.625 C18.387,14.464 17.977,14.315 17.443,14.181 C17.942,14.014 18.342,13.802 18.647,13.546 C18.950,13.289 19.182,12.994 19.345,12.660 C19.506,12.325 19.587,11.972 19.587,11.599 C19.587,11.087 19.434,10.617 19.130,10.188 C18.824,9.759 18.388,9.430 17.821,9.201 C17.492,9.068 17.083,8.978 16.612,8.922 L16.612,7.001 L15.013,7.001 L15.013,8.857 L13.986,8.857 L13.986,7.001 L12.387,7.001 L12.387,8.857 L8.994,8.857 L8.994,10.419 L9.444,10.419 C9.743,10.419 9.947,10.446 10.054,10.500 C10.160,10.553 10.235,10.627 10.279,10.718 C10.323,10.810 10.344,11.023 10.344,11.357 L10.344,17.651 C10.344,17.980 10.322,18.192 10.279,18.286 C10.235,18.381 10.161,18.453 10.054,18.504 C9.947,18.555 9.743,18.582 9.444,18.582 L8.994,18.582 L8.994,20.143 L12.387,20.143 L12.387,21.998 L13.985,21.998 L13.985,20.143 L14.978,20.143 C14.989,20.143 15.001,20.143 15.013,20.143 L15.013,21.998 L16.611,21.998 L16.611,20.051 C17.127,19.985 17.561,19.884 17.907,19.746 C18.574,19.482 19.092,19.098 19.456,18.593 C19.821,18.089 20.004,17.537 20.004,16.938 C20.004,16.438 19.884,15.983 19.644,15.576 ZM15.893,18.205 C15.574,18.294 15.173,18.339 14.689,18.339 L13.855,18.339 C13.577,18.339 13.408,18.324 13.345,18.295 C13.282,18.265 13.238,18.213 13.210,18.137 C13.187,18.077 13.174,17.877 13.168,17.530 L13.168,15.087 L14.646,15.087 C15.294,15.087 15.777,15.147 16.092,15.265 C16.408,15.383 16.645,15.559 16.803,15.791 C16.961,16.024 17.040,16.307 17.040,16.641 C17.041,17.034 16.929,17.371 16.706,17.651 C16.483,17.931 16.212,18.116 15.893,18.205 ZM15.874,13.267 C15.561,13.376 15.076,13.430 14.421,13.430 L13.169,13.430 L13.169,10.678 L14.421,10.678 C15.153,10.678 15.660,10.722 15.944,10.811 C16.228,10.900 16.444,11.051 16.595,11.260 C16.744,11.471 16.820,11.724 16.820,12.022 C16.820,12.307 16.741,12.559 16.582,12.778 C16.424,12.997 16.188,13.160 15.874,13.267 Z"/>
                          </svg>
                    <?php else: ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(245, 195, 61)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM19.644,15.576 C19.404,15.169 19.080,14.852 18.670,14.625 C18.387,14.464 17.977,14.315 17.443,14.181 C17.942,14.014 18.342,13.802 18.647,13.546 C18.950,13.289 19.182,12.994 19.345,12.660 C19.506,12.325 19.587,11.972 19.587,11.599 C19.587,11.087 19.434,10.617 19.130,10.188 C18.824,9.759 18.388,9.430 17.821,9.201 C17.492,9.068 17.083,8.978 16.612,8.922 L16.612,7.001 L15.013,7.001 L15.013,8.857 L13.986,8.857 L13.986,7.001 L12.387,7.001 L12.387,8.857 L8.994,8.857 L8.994,10.419 L9.444,10.419 C9.743,10.419 9.947,10.446 10.054,10.500 C10.160,10.553 10.235,10.627 10.279,10.718 C10.323,10.810 10.344,11.023 10.344,11.357 L10.344,17.651 C10.344,17.980 10.322,18.192 10.279,18.286 C10.235,18.381 10.161,18.453 10.054,18.504 C9.947,18.555 9.743,18.582 9.444,18.582 L8.994,18.582 L8.994,20.143 L12.387,20.143 L12.387,21.998 L13.985,21.998 L13.985,20.143 L14.978,20.143 C14.989,20.143 15.001,20.143 15.013,20.143 L15.013,21.998 L16.611,21.998 L16.611,20.051 C17.127,19.985 17.561,19.884 17.907,19.746 C18.574,19.482 19.092,19.098 19.456,18.593 C19.821,18.089 20.004,17.537 20.004,16.938 C20.004,16.438 19.884,15.983 19.644,15.576 ZM15.893,18.205 C15.574,18.294 15.173,18.339 14.689,18.339 L13.855,18.339 C13.577,18.339 13.408,18.324 13.345,18.295 C13.282,18.265 13.238,18.213 13.210,18.137 C13.187,18.077 13.174,17.877 13.168,17.530 L13.168,15.087 L14.646,15.087 C15.294,15.087 15.777,15.147 16.092,15.265 C16.408,15.383 16.645,15.559 16.803,15.791 C16.961,16.024 17.040,16.307 17.040,16.641 C17.041,17.034 16.929,17.371 16.706,17.651 C16.483,17.931 16.212,18.116 15.893,18.205 ZM15.874,13.267 C15.561,13.376 15.076,13.430 14.421,13.430 L13.169,13.430 L13.169,10.678 L14.421,10.678 C15.153,10.678 15.660,10.722 15.944,10.811 C16.228,10.900 16.444,11.051 16.595,11.260 C16.744,11.471 16.820,11.724 16.820,12.022 C16.820,12.307 16.741,12.559 16.582,12.778 C16.424,12.997 16.188,13.160 15.874,13.267 Z"/>
                          </svg>
                    <?php endif; ?>
                </div>
                <!--<div class="media-body">-->

                <!--    <h2><?php echo e($btc->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>-->

                <!--    <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>-->
                <!--        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$btc->id),$btc->decimals)); ?></span>-->
                <!--    <span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>-->
                <!--        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$btc->id),$btc->decimals)); ?></span>-->
                <!--</div>-->
                
                <div class="media-body">

                    <h2><?php echo e($btc->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>

                    <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>

                        : <?php echo e(number_format(Sentinel::getUser()->bitcoin_balance,8)); ?></span>
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>

                        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$btc->id),$btc->decimals)); ?></span>
                        
                        
                </div>
                
                
            </a>
            <div class="act_btns">
                        <a href="<?php echo e(url('wallets/btc/send')); ?>" class="btn btn-default send_rec"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</a>
                        <!--<a  class="btn btn-default send_rec" data-toggle="modal" data-target="#myModalbtc"><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>-->
                        <a href="<?php echo e(url('wallets/btc')); ?>" class="btn btn-default send_rec" ><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>
                    </div>
        </li>

        <?php endif; ?>
    <!-- <?php if($dogecoin->active==1): ?>
        <li class="media <?php echo e(Request::path() == 'wallet/dogecoin' ? 'active' : ''); ?>">
            <a href="<?php echo e(url('wallet/dogecoin')); ?>" class="media-link">
                <div class="media-left">
                    <?php if(empty($dogecoin->logo)): ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(245, 195, 61)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM19.644,15.576 C19.404,15.169 19.080,14.852 18.670,14.625 C18.387,14.464 17.977,14.315 17.443,14.181 C17.942,14.014 18.342,13.802 18.647,13.546 C18.950,13.289 19.182,12.994 19.345,12.660 C19.506,12.325 19.587,11.972 19.587,11.599 C19.587,11.087 19.434,10.617 19.130,10.188 C18.824,9.759 18.388,9.430 17.821,9.201 C17.492,9.068 17.083,8.978 16.612,8.922 L16.612,7.001 L15.013,7.001 L15.013,8.857 L13.986,8.857 L13.986,7.001 L12.387,7.001 L12.387,8.857 L8.994,8.857 L8.994,10.419 L9.444,10.419 C9.743,10.419 9.947,10.446 10.054,10.500 C10.160,10.553 10.235,10.627 10.279,10.718 C10.323,10.810 10.344,11.023 10.344,11.357 L10.344,17.651 C10.344,17.980 10.322,18.192 10.279,18.286 C10.235,18.381 10.161,18.453 10.054,18.504 C9.947,18.555 9.743,18.582 9.444,18.582 L8.994,18.582 L8.994,20.143 L12.387,20.143 L12.387,21.998 L13.985,21.998 L13.985,20.143 L14.978,20.143 C14.989,20.143 15.001,20.143 15.013,20.143 L15.013,21.998 L16.611,21.998 L16.611,20.051 C17.127,19.985 17.561,19.884 17.907,19.746 C18.574,19.482 19.092,19.098 19.456,18.593 C19.821,18.089 20.004,17.537 20.004,16.938 C20.004,16.438 19.884,15.983 19.644,15.576 ZM15.893,18.205 C15.574,18.294 15.173,18.339 14.689,18.339 L13.855,18.339 C13.577,18.339 13.408,18.324 13.345,18.295 C13.282,18.265 13.238,18.213 13.210,18.137 C13.187,18.077 13.174,17.877 13.168,17.530 L13.168,15.087 L14.646,15.087 C15.294,15.087 15.777,15.147 16.092,15.265 C16.408,15.383 16.645,15.559 16.803,15.791 C16.961,16.024 17.040,16.307 17.040,16.641 C17.041,17.034 16.929,17.371 16.706,17.651 C16.483,17.931 16.212,18.116 15.893,18.205 ZM15.874,13.267 C15.561,13.376 15.076,13.430 14.421,13.430 L13.169,13.430 L13.169,10.678 L14.421,10.678 C15.153,10.678 15.660,10.722 15.944,10.811 C16.228,10.900 16.444,11.051 16.595,11.260 C16.744,11.471 16.820,11.724 16.820,12.022 C16.820,12.307 16.741,12.559 16.582,12.778 C16.424,12.997 16.188,13.160 15.874,13.267 Z"/>
                          </svg>
                    <?php else: ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(245, 195, 61)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM19.644,15.576 C19.404,15.169 19.080,14.852 18.670,14.625 C18.387,14.464 17.977,14.315 17.443,14.181 C17.942,14.014 18.342,13.802 18.647,13.546 C18.950,13.289 19.182,12.994 19.345,12.660 C19.506,12.325 19.587,11.972 19.587,11.599 C19.587,11.087 19.434,10.617 19.130,10.188 C18.824,9.759 18.388,9.430 17.821,9.201 C17.492,9.068 17.083,8.978 16.612,8.922 L16.612,7.001 L15.013,7.001 L15.013,8.857 L13.986,8.857 L13.986,7.001 L12.387,7.001 L12.387,8.857 L8.994,8.857 L8.994,10.419 L9.444,10.419 C9.743,10.419 9.947,10.446 10.054,10.500 C10.160,10.553 10.235,10.627 10.279,10.718 C10.323,10.810 10.344,11.023 10.344,11.357 L10.344,17.651 C10.344,17.980 10.322,18.192 10.279,18.286 C10.235,18.381 10.161,18.453 10.054,18.504 C9.947,18.555 9.743,18.582 9.444,18.582 L8.994,18.582 L8.994,20.143 L12.387,20.143 L12.387,21.998 L13.985,21.998 L13.985,20.143 L14.978,20.143 C14.989,20.143 15.001,20.143 15.013,20.143 L15.013,21.998 L16.611,21.998 L16.611,20.051 C17.127,19.985 17.561,19.884 17.907,19.746 C18.574,19.482 19.092,19.098 19.456,18.593 C19.821,18.089 20.004,17.537 20.004,16.938 C20.004,16.438 19.884,15.983 19.644,15.576 ZM15.893,18.205 C15.574,18.294 15.173,18.339 14.689,18.339 L13.855,18.339 C13.577,18.339 13.408,18.324 13.345,18.295 C13.282,18.265 13.238,18.213 13.210,18.137 C13.187,18.077 13.174,17.877 13.168,17.530 L13.168,15.087 L14.646,15.087 C15.294,15.087 15.777,15.147 16.092,15.265 C16.408,15.383 16.645,15.559 16.803,15.791 C16.961,16.024 17.040,16.307 17.040,16.641 C17.041,17.034 16.929,17.371 16.706,17.651 C16.483,17.931 16.212,18.116 15.893,18.205 ZM15.874,13.267 C15.561,13.376 15.076,13.430 14.421,13.430 L13.169,13.430 L13.169,10.678 L14.421,10.678 C15.153,10.678 15.660,10.722 15.944,10.811 C16.228,10.900 16.444,11.051 16.595,11.260 C16.744,11.471 16.820,11.724 16.820,12.022 C16.820,12.307 16.741,12.559 16.582,12.778 C16.424,12.997 16.188,13.160 15.874,13.267 Z"/>
                          </svg>
                    <?php endif; ?>
                </div>
                <div class="media-body">

                    <h2><?php echo e($dogecoin->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>

                    <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>

                        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$dogecoin->id),$dogecoin->decimals)); ?></span>
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>

                        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$dogecoin->id),$dogecoin->decimals)); ?></span>
                </div>
            </a>
            <div class="act_btns">
                        <a href="javescript:void();" class="send_rec"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</a>
                        <a href="javescript:void();" class="send_rec"><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>
                    </div>
        </li>
    <?php endif; ?> -->
    <?php if($ltc->active==1): ?>
        <li class="media <?php echo e(Request::path() == 'wallets/ltc' ? 'active' : ''); ?>">
            <a href="<?php echo e(url('wallets/ltc')); ?>" class="media-link">
                <div class="media-left">
                    <?php if(empty($ltc->logo)): ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(64, 192, 224)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM13.041,18.776 L13.958,14.906 C14.024,14.604 14.261,14.370 14.560,14.311 L17.532,13.748 L17.532,12.254 L15.591,12.620 C15.341,12.669 15.083,12.586 14.907,12.399 C14.730,12.213 14.660,11.949 14.718,11.698 L16.065,5.999 L12.334,5.999 L10.498,13.138 C10.426,13.426 10.193,13.644 9.904,13.694 L7.000,14.250 L7.000,15.751 L8.805,15.408 C9.058,15.358 9.317,15.445 9.490,15.637 C9.663,15.828 9.731,16.094 9.671,16.346 L8.211,21.999 L20.240,21.999 L21.000,19.713 L13.770,19.713 C13.539,19.714 13.320,19.607 13.176,19.424 C13.036,19.240 12.986,19.001 13.041,18.776 Z"/>
                          </svg>
                    <?php else: ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(64, 192, 224)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM13.041,18.776 L13.958,14.906 C14.024,14.604 14.261,14.370 14.560,14.311 L17.532,13.748 L17.532,12.254 L15.591,12.620 C15.341,12.669 15.083,12.586 14.907,12.399 C14.730,12.213 14.660,11.949 14.718,11.698 L16.065,5.999 L12.334,5.999 L10.498,13.138 C10.426,13.426 10.193,13.644 9.904,13.694 L7.000,14.250 L7.000,15.751 L8.805,15.408 C9.058,15.358 9.317,15.445 9.490,15.637 C9.663,15.828 9.731,16.094 9.671,16.346 L8.211,21.999 L20.240,21.999 L21.000,19.713 L13.770,19.713 C13.539,19.714 13.320,19.607 13.176,19.424 C13.036,19.240 12.986,19.001 13.041,18.776 Z"/>
                          </svg>
                    <?php endif; ?>
                </div>
                <div class="media-body">

                    <h2><?php echo e($ltc->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>

                    <!--<span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>-->
                    <!--    : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$ltc->id),$ltc->decimals)); ?></span>-->
                    <!--<span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>-->
                    <!--    : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$ltc->id),$ltc->decimals)); ?></span>-->
                    
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>

                        : <?php echo e(number_format(Sentinel::getUser()->litecoin_balance,8)); ?></span>
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>

                        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$btc->id),$btc->decimals)); ?></span>
                </div>
            </a>
            <div class="act_btns">
                        <a href="<?php echo e(url('wallets/ltc/send')); ?>" class="send_rec"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</a>
                        <!--<a href="javescript:void();" class="send_rec" data-toggle="modal" data-target="#myModalltc"><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>-->
                        <a href="<?php echo e(url('wallets/ltc')); ?>" class="send_rec" ><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>
                    </div>
        </li>
    <?php endif; ?>
    <?php if($eth->active==1): ?>
        <li class="media <?php echo e(Request::path() == 'wallets/eth' ? 'active' : ''); ?>">
            <a href="<?php echo e(url('wallets/eth')); ?>" class="media-link">
                <div class="media-left">
                    <?php if(empty($eth->logo)): ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(96, 142, 179)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM9.087,16.043 L13.531,22.753 C13.633,22.907 13.810,23.000 14.000,23.000 C14.190,23.000 14.367,22.907 14.469,22.753 L18.913,16.043 C19.047,15.841 19.024,15.580 18.857,15.403 C18.691,15.226 18.422,15.177 18.198,15.282 L14.000,17.263 L9.802,15.282 C9.578,15.176 9.309,15.226 9.143,15.403 C8.976,15.580 8.953,15.841 9.087,16.043 ZM18.988,13.161 C18.986,13.143 18.983,13.125 18.980,13.107 C18.966,13.055 18.944,13.005 18.914,12.959 L18.913,12.957 L14.469,6.247 C14.462,6.236 14.448,6.232 14.439,6.221 C14.340,6.083 14.176,6.000 14.000,6.000 C13.824,6.000 13.660,6.083 13.561,6.221 C13.552,6.232 13.538,6.236 13.531,6.247 L9.087,12.957 L9.086,12.959 C9.056,13.005 9.034,13.055 9.020,13.107 C9.014,13.152 9.007,13.197 9.000,13.242 C9.000,13.250 9.004,13.257 9.004,13.266 C9.010,13.319 9.021,13.371 9.038,13.422 C9.045,13.442 9.054,13.461 9.064,13.479 C9.080,13.510 9.100,13.539 9.122,13.566 C9.130,13.576 9.134,13.587 9.143,13.597 C9.148,13.603 9.156,13.605 9.161,13.611 C9.188,13.636 9.218,13.659 9.250,13.679 C9.265,13.690 9.281,13.700 9.298,13.710 C9.302,13.712 9.305,13.716 9.310,13.718 L13.754,15.815 C13.909,15.888 14.091,15.888 14.246,15.815 L18.690,13.718 C18.747,13.690 18.798,13.653 18.842,13.608 C18.846,13.603 18.853,13.601 18.857,13.597 C18.866,13.587 18.870,13.576 18.878,13.566 C18.900,13.539 18.920,13.510 18.936,13.479 C18.946,13.461 18.955,13.442 18.962,13.423 C18.979,13.372 18.991,13.319 18.996,13.266 C18.997,13.258 19.000,13.250 19.000,13.242 C18.998,13.214 18.994,13.187 18.988,13.161 Z"/>
                          </svg>
                    <?php else: ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(96, 142, 179)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM9.087,16.043 L13.531,22.753 C13.633,22.907 13.810,23.000 14.000,23.000 C14.190,23.000 14.367,22.907 14.469,22.753 L18.913,16.043 C19.047,15.841 19.024,15.580 18.857,15.403 C18.691,15.226 18.422,15.177 18.198,15.282 L14.000,17.263 L9.802,15.282 C9.578,15.176 9.309,15.226 9.143,15.403 C8.976,15.580 8.953,15.841 9.087,16.043 ZM18.988,13.161 C18.986,13.143 18.983,13.125 18.980,13.107 C18.966,13.055 18.944,13.005 18.914,12.959 L18.913,12.957 L14.469,6.247 C14.462,6.236 14.448,6.232 14.439,6.221 C14.340,6.083 14.176,6.000 14.000,6.000 C13.824,6.000 13.660,6.083 13.561,6.221 C13.552,6.232 13.538,6.236 13.531,6.247 L9.087,12.957 L9.086,12.959 C9.056,13.005 9.034,13.055 9.020,13.107 C9.014,13.152 9.007,13.197 9.000,13.242 C9.000,13.250 9.004,13.257 9.004,13.266 C9.010,13.319 9.021,13.371 9.038,13.422 C9.045,13.442 9.054,13.461 9.064,13.479 C9.080,13.510 9.100,13.539 9.122,13.566 C9.130,13.576 9.134,13.587 9.143,13.597 C9.148,13.603 9.156,13.605 9.161,13.611 C9.188,13.636 9.218,13.659 9.250,13.679 C9.265,13.690 9.281,13.700 9.298,13.710 C9.302,13.712 9.305,13.716 9.310,13.718 L13.754,15.815 C13.909,15.888 14.091,15.888 14.246,15.815 L18.690,13.718 C18.747,13.690 18.798,13.653 18.842,13.608 C18.846,13.603 18.853,13.601 18.857,13.597 C18.866,13.587 18.870,13.576 18.878,13.566 C18.900,13.539 18.920,13.510 18.936,13.479 C18.946,13.461 18.955,13.442 18.962,13.423 C18.979,13.372 18.991,13.319 18.996,13.266 C18.997,13.258 19.000,13.250 19.000,13.242 C18.998,13.214 18.994,13.187 18.988,13.161 Z"/>
                          </svg>
                    <?php endif; ?>
                </div>
                <div class="media-body">

                    <h2><?php echo e($eth->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>

                    <!--<span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>-->
                    <!--    : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$eth->id),$eth->decimals)); ?></span>-->
                    <!--<span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>-->
                    <!--    : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$eth->id),$eth->decimals)); ?></span>-->
                    
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>

                        : <?php echo e(number_format(Sentinel::getUser()->ethereum_balance,8)); ?></span>
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>

                        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$btc->id),$btc->decimals)); ?></span>
                </div>
            </a>
            <div class="act_btns">
                        <a href="<?php echo e(url('wallets/eth/send')); ?>" class="send_rec"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</a>
                        <!--<a href="javescript:void();" class="send_rec" data-toggle="modal" data-target="#myModaleth"><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>-->
                        <a href="<?php echo e(url('wallets/eth')); ?>" class="send_rec"><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>
                    </div>
        </li>
    <?php endif; ?>
    <?php if($xrp->active==1): ?>
        <li class="media  <?php echo e(Request::path() == 'wallets/xrp' ? 'active' : ''); ?>">
            <a href="<?php echo e(url('wallets/xrp')); ?>" class="media-link">
                <div class="media-left">
                    <?php if(empty($xrp->logo)): ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(64, 147, 224)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM15.954,13.752 C15.954,13.752 15.976,12.752 17.237,12.643 C17.284,12.645 17.328,12.656 17.375,12.656 C19.343,12.656 20.937,11.166 20.937,9.328 C20.937,7.490 19.343,6.000 17.375,6.000 C15.407,6.000 13.812,7.490 13.812,9.328 C13.812,10.021 14.040,10.663 14.427,11.196 L14.427,11.209 C14.427,11.209 14.611,12.505 13.830,12.760 C13.830,12.760 12.667,13.618 11.705,12.450 L11.703,12.548 C11.119,11.467 9.932,10.719 8.547,10.719 C6.588,10.719 5.000,12.202 5.000,14.031 C5.000,15.861 6.588,17.344 8.547,17.344 C9.686,17.344 10.688,16.834 11.336,16.055 L11.307,16.171 C11.307,16.171 11.357,16.066 11.456,15.919 C11.472,15.898 11.488,15.879 11.503,15.857 C11.827,15.404 12.556,14.663 13.697,15.116 C13.697,15.116 14.827,15.579 14.496,16.839 C14.125,17.365 13.906,17.994 13.906,18.672 C13.906,20.510 15.494,22.000 17.453,22.000 C19.412,22.000 21.000,20.510 21.000,18.672 C21.000,16.834 19.412,15.344 17.453,15.344 C17.374,15.344 17.299,15.361 17.221,15.366 C17.218,15.365 17.218,15.365 17.216,15.364 C17.216,15.364 15.660,15.022 15.954,13.752 Z"/>
                          </svg>
                    <?php else: ?>
                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="28px" height="28px" class="img-circle img-xs">
                            <path fill-rule="evenodd"  fill="rgb(64, 147, 224)" d="M14.000,28.000 C6.268,28.000 -0.000,21.732 -0.000,14.000 C-0.000,6.268 6.268,-0.000 14.000,-0.000 C21.732,-0.000 28.000,6.268 28.000,14.000 C28.000,21.732 21.732,28.000 14.000,28.000 ZM15.954,13.752 C15.954,13.752 15.976,12.752 17.237,12.643 C17.284,12.645 17.328,12.656 17.375,12.656 C19.343,12.656 20.937,11.166 20.937,9.328 C20.937,7.490 19.343,6.000 17.375,6.000 C15.407,6.000 13.812,7.490 13.812,9.328 C13.812,10.021 14.040,10.663 14.427,11.196 L14.427,11.209 C14.427,11.209 14.611,12.505 13.830,12.760 C13.830,12.760 12.667,13.618 11.705,12.450 L11.703,12.548 C11.119,11.467 9.932,10.719 8.547,10.719 C6.588,10.719 5.000,12.202 5.000,14.031 C5.000,15.861 6.588,17.344 8.547,17.344 C9.686,17.344 10.688,16.834 11.336,16.055 L11.307,16.171 C11.307,16.171 11.357,16.066 11.456,15.919 C11.472,15.898 11.488,15.879 11.503,15.857 C11.827,15.404 12.556,14.663 13.697,15.116 C13.697,15.116 14.827,15.579 14.496,16.839 C14.125,17.365 13.906,17.994 13.906,18.672 C13.906,20.510 15.494,22.000 17.453,22.000 C19.412,22.000 21.000,20.510 21.000,18.672 C21.000,16.834 19.412,15.344 17.453,15.344 C17.374,15.344 17.299,15.361 17.221,15.366 C17.218,15.365 17.218,15.365 17.216,15.364 C17.216,15.364 15.660,15.022 15.954,13.752 Z"/>
                          </svg>
                    <?php endif; ?>
                </div>
                <div class="media-body">

                    <h2><?php echo e($xrp->name); ?> <?php echo e(trans_choice('general.wallet',1)); ?></h2>

                    <!--<span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>-->
                    <!--    : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_balance(Sentinel::getUser()->id,$xrp->id),$xrp->decimals)); ?></span>-->
                    <!--<span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>-->
                    <!--    : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$xrp->id),$xrp->decimals)); ?></span>-->
                      <span class="display-block text-bold"><?php echo e(trans_choice('general.balance',1)); ?>

                        : <?php echo e(number_format(Sentinel::getUser()->ripple_balance,8)); ?></span>
                    <span class="display-block text-bold"><?php echo e(trans_choice('general.locked',1)); ?>

                        : <?php echo e(round(\App\Helpers\GeneralHelper::user_currency_locked_balance(Sentinel::getUser()->id,$btc->id),$btc->decimals)); ?></span>
                </div>
            </a>
            <div class="act_btns">
                        <a href="<?php echo e(url('wallets/xrp/send')); ?>" class="send_rec"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</a>
                        <!--<a href="javescript:void();" class="send_rec" data-toggle="modal" data-target="#myModalxrp"><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>-->
                        <a href="<?php echo e(url('wallets/xrp')); ?>" class="send_rec" ><i class="fa fa-qrcode" aria-hidden="true"></i> Receive</a>
                    </div>
        </li>
    <?php endif; ?>
</ul>





