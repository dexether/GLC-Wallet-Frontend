
<?php $__env->startSection('head'); ?>
    <meta name="csrf_token"  content="<?php echo e(csrf_token()); ?>" />
<?php $__env->startSection('title'); ?>
    <?php echo e(trans_choice('general.setting',2)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <style>
        .hide-section{
            display: none;
        }
    </style>


    <?php if(Sentinel::inRole('client')): ?>

        <section>
            <div class="pageContent stting">
                <div class="container">
                    <div class="pageTitle"><h1>Settings</h1></div>
                    <div class="panel panel-white">

                    </div> <div class="sttng_cntnt">
                        
                        <div class="panel-body">
                            <!--<div   ><ul id="profile_errors" class="alert alert-danger hide-section" ></ul></div>-->
                            <!--<div  ><ul id="profile_success" class="alert alert-success hide-section"></ul></div>-->

                            <?php if(Session::has('flash_notification.message')): ?>
                                <div id="profile_success" class="alert alert-<?php echo e(Session::get('flash_notification.level')); ?>">
                                    <?php echo e(Session::get("flash_notification.message")); ?>

                                </div>
                            <?php endif; ?>

                       
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#profile" data-toggle="tab"><?php echo e(trans('general.profile')); ?></a></li>
                                    <li><a href="#bank_acc" data-toggle="tab">Bank Accounts</a></li>
                                    <li><a href="#veryfy_doc" data-toggle="tab">Verify Documents</a></li>
                                    <li><a href="#security" data-toggle="tab">Security</a></li>
                                    <li><a href="#bankacc" data-toggle="tab">Bank details</a></li>

                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane fade in active" id="profile">
                                        <div class="settingTabContent">
                                            <div class="chnge_prf stng_padd">
                                                <h2>User Profile</h2>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="changeCardMain">

                                                            <?php echo Form::open(array('route' => 'uploadprofile', 'method' => 'POST', 'files' => true, 'id' => 'profile-form')); ?>


                                                            <div class="changeCard">
                                            <span class="circleleftImg">
                                              <?php if(Sentinel::getUser()->profile_pic==''): ?>
                                                    <img src="<?php echo e(asset('assets/themes/limitless/images/user-image.jpg')); ?>" alt="..." class="img-preview">
                                                <?php else: ?>
                                                    <img src="<?php echo e(asset('assets/profile/'.Sentinel::getUser()->profile_pic)); ?>" alt="..." class="img-preview">
                                                <?php endif; ?>
                                            </span>

                                                                <ul>
                                                                    <li>
                                                                        <h2>Change Picture</h2>
                                                                        <h6>Max file size is 20mb.</h6>
                                                                        <p>You can also use gravatar.</p>
                                                                    </li>

                                                                    <li class="cardBtn" id="profile-upload-btn">

                                                                        <div class="act_btns withdrw_btc">
                                                                            <input type="file" name="profile_pic" accept="image/x-png,image/gif,image/jpeg"  onchange="readURL(this,0)"  /><br>
                                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn btn-default btn-xs send_rec btn-file"><span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="16" viewBox="0 0 17 16">
                                                          <defs>
                                                            <style>
                                                              .cls-1 {
                                                                  fill: #92a8c0;
                                                                  fill-rule: evenodd;
                                                              }
                                                            </style>
                                                          </defs>
                                                          <path d="M13.843,16.000 L3.157,16.000 C1.418,16.000 -0.000,14.564 -0.000,12.794 L-0.000,8.222 C-0.000,7.947 0.216,7.727 0.487,7.727 C0.758,7.727 0.974,7.947 0.974,8.222 L0.974,12.794 C0.974,14.014 1.952,15.011 3.157,15.011 L13.843,15.011 C15.044,15.011 16.026,14.018 16.026,12.794 L16.026,8.295 C16.026,8.020 16.242,7.800 16.513,7.800 C16.784,7.800 17.000,8.024 17.000,8.295 L17.000,12.794 C17.000,14.560 15.586,16.000 13.843,16.000 ZM11.595,4.136 C11.473,4.136 11.346,4.085 11.253,3.990 L8.987,1.689 L8.987,11.724 C8.987,11.999 8.770,12.219 8.500,12.219 C8.229,12.219 8.013,11.999 8.013,11.724 L8.013,1.689 L5.747,3.990 C5.560,4.180 5.249,4.180 5.062,3.990 C4.870,3.796 4.870,3.484 5.062,3.290 L8.157,0.146 C8.247,0.051 8.370,-0.000 8.500,-0.000 C8.626,-0.000 8.752,0.055 8.843,0.146 L11.938,3.290 C12.129,3.484 12.129,3.796 11.938,3.990 C11.844,4.089 11.722,4.136 11.595,4.136 Z" class="cls-1"/>
                                                        </svg>
                                                        <a id="uploadprofile" > Upload</span></a></span>
                                                                                <span class="fileinput-filename"></span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="changeCardMain">
                                                            <div class="changeCard">
                                            <span class="circleleftImg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="20" height="20" viewBox="0 0 14 14">
                                                          <path fill="#c1c3c5" d="M9.734,8.531 C9.405,8.531 9.079,8.494 8.760,8.419 L7.773,9.406 L6.562,9.406 L6.562,10.937 L5.031,10.937 L5.031,12.469 L3.500,12.469 L3.500,14.000 L-0.000,14.000 L-0.000,10.820 L5.581,5.240 C5.506,4.921 5.469,4.595 5.469,4.266 C5.469,1.914 7.382,-0.000 9.734,-0.000 C12.086,-0.000 14.000,1.914 14.000,4.266 C14.000,6.618 12.086,8.531 9.734,8.531 ZM9.734,1.094 C7.985,1.094 6.562,2.517 6.562,4.266 C6.562,4.596 6.613,4.922 6.713,5.234 L6.815,5.552 L1.094,11.273 L1.094,12.906 L2.406,12.906 L2.406,11.375 L3.937,11.375 L3.937,9.844 L5.469,9.844 L5.469,8.312 L7.320,8.312 L8.448,7.185 L8.766,7.287 C9.078,7.387 9.404,7.437 9.734,7.437 C11.483,7.437 12.906,6.015 12.906,4.266 C12.906,2.517 11.483,1.094 9.734,1.094 ZM10.500,4.156 C10.017,4.156 9.625,3.764 9.625,3.281 C9.625,2.798 10.017,2.406 10.500,2.406 C10.983,2.406 11.375,2.798 11.375,3.281 C11.375,3.764 10.983,4.156 10.500,4.156 Z" class="cls-1"/>
                                                      </svg></span>

                                                                <ul>
                                                                    <li>
                                                                        <h2>Change Password</h2>
                                                                        <p>Enable 2-factor authentication on the security Page.</p>
                                                                    </li>
                                                                    <li class="cardBtn">
                                                                        <div class="act_btns withdrw_btc">
                                                                            <a class="btn btn-default btn-xs1 send_rec btn-file" id="changepassword"><span>

                                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="14" height="14" viewBox="0 0 14 14">
                                                          <path fill="#c1c3c5" d="M9.734,8.531 C9.405,8.531 9.079,8.494 8.760,8.419 L7.773,9.406 L6.562,9.406 L6.562,10.937 L5.031,10.937 L5.031,12.469 L3.500,12.469 L3.500,14.000 L-0.000,14.000 L-0.000,10.820 L5.581,5.240 C5.506,4.921 5.469,4.595 5.469,4.266 C5.469,1.914 7.382,-0.000 9.734,-0.000 C12.086,-0.000 14.000,1.914 14.000,4.266 C14.000,6.618 12.086,8.531 9.734,8.531 ZM9.734,1.094 C7.985,1.094 6.562,2.517 6.562,4.266 C6.562,4.596 6.613,4.922 6.713,5.234 L6.815,5.552 L1.094,11.273 L1.094,12.906 L2.406,12.906 L2.406,11.375 L3.937,11.375 L3.937,9.844 L5.469,9.844 L5.469,8.312 L7.320,8.312 L8.448,7.185 L8.766,7.287 C9.078,7.387 9.404,7.437 9.734,7.437 C11.483,7.437 12.906,6.015 12.906,4.266 C12.906,2.517 11.483,1.094 9.734,1.094 ZM10.500,4.156 C10.017,4.156 9.625,3.764 9.625,3.281 C9.625,2.798 10.017,2.406 10.500,2.406 C10.983,2.406 11.375,2.798 11.375,3.281 C11.375,3.764 10.983,4.156 10.500,4.156 Z" class="cls-1"/>
                                                      </svg> Change Password</span></a>
                                                                        </div>
                                                                    </li>
                                                                </ul>




                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Change password section start -->

                                        <div class="settingTabContent greyBg hide-section changepassword-form" id="changepassword-form">
                                            <?php echo Form::open(array('route' => 'changepassword', 'method' => 'POST')); ?>

                                            <div class="profileSetMdlSection">
                                                <ul>
                                                    <li>
                                                        <div class="formGroup">
                                                            <label for="old_password">Old Password</label>
                                                            <input id="old_password" type="password" class="form-control cust_fld" placeholder="Old Password" name="old_password" >
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="formGroup">
                                                            <label for="new_password">New Password</label>
                                                            <input id="new_password" type="password" class="form-control cust_fld" placeholder="New Password" name="new_password" >
                                                        </div>
                                                        <div class="form-control-feedback">
                                                            <i class="icon-lock2 text-muted"></i>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="formGroup">
                                                            <label for="confirm_password">Confirm Password</label>
                                                            <input id="confirm_password" type="password" class="form-control cust_fld" placeholder="Confirm Password" name="confirm_password" >
                                                        </div>
                                                        <div class="form-control-feedback">
                                                            <i class="icon-lock2 text-muted"></i>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="formGroup">
                                                            <div class="act_btns withdrw_btc">
                                                                <button type="submit" class="btn btn-default btn-xs send_rec"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
                                                                        <path fill="#92a8c0" d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
                                                                    </svg> Update</button>
                                                            </div>

                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <?php echo Form::close(); ?>

                                        </div>

                                        <!-- Change password section end -->

                                        <?php echo Form::open(array('route' => 'updatedata', 'method' => 'POST', 'files' => true)); ?>

                                        <div class="settingTabContent greyBg">
                                            <div class="profileSetMdlSection">
                                                <ul>
                                                    <li>
                                                        <div class="formGroup">
                                                            <label for="nickName">Nick Name</label>
                                                            <p>This name will be part of your public profile.</p>
                                                            <input id="nickName" type="text" class="form-control cust_fld" placeholder="Name" name="nickName" value="<?php echo e(Sentinel::getUser()->name); ?>">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="formGroup">
                                                            <label for="emailFld">Email</label>
                                                            <input id="emailFld" type="email" class="form-control cust_fld" placeholder="Email" name="email" value="<?php echo e(Sentinel::getUser()->email); ?>">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="formGroup">
                                                            <div class="act_btns withdrw_btc">
                                                                <button type="submit" class="btn btn-default btn-xs send_rec"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
                                                                        <path fill="#92a8c0" d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
                                                                    </svg> Save</button>
                                                            </div>

                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php echo Form::close(); ?>


                                        <?php echo Form::open(array('route' => 'updatepersonal', 'method' => 'POST', 'files' => true, 'id' => 'profile-form')); ?>

                                        <div class="settingTabContent">
                                            <div class="personalDtl">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="titleLeftIcon">
                                                <span class="titleLIcon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="24" height="31" viewBox="0 0 24 31">
                                                          <path fill="#a8beda" d="M20.470,31.000 L3.529,31.000 C1.583,31.000 -0.000,29.370 -0.000,27.367 L-0.000,15.016 C-0.000,13.012 1.583,11.383 3.529,11.383 L5.645,11.383 L5.645,6.404 C5.645,2.873 8.495,-0.000 11.998,-0.000 C15.501,-0.000 18.351,2.873 18.351,6.404 L18.351,11.383 L20.470,11.383 C22.417,11.383 24.000,13.012 24.000,15.016 L24.000,27.367 C24.000,29.370 22.417,31.000 20.470,31.000 ZM15.998,6.404 C15.998,4.208 14.203,2.422 11.998,2.422 C9.792,2.422 7.998,4.208 7.998,6.404 L7.998,11.383 L15.998,11.383 L15.998,6.404 ZM21.647,15.016 C21.647,14.348 21.119,13.805 20.470,13.805 L3.529,13.805 C2.881,13.805 2.353,14.348 2.353,15.016 L2.353,27.367 C2.353,28.035 2.881,28.578 3.529,28.578 L20.470,28.578 C21.119,28.578 21.647,28.035 21.647,27.367 L21.647,15.016 ZM13.174,21.442 L13.174,24.098 C13.174,24.766 12.647,25.309 11.998,25.309 C11.348,25.309 10.821,24.766 10.821,24.098 L10.821,21.440 C10.221,21.041 9.824,20.347 9.824,19.557 C9.824,18.319 10.798,17.316 12.000,17.316 C13.202,17.316 14.176,18.319 14.176,19.557 C14.176,20.349 13.777,21.044 13.174,21.442 Z" class="cls-1"/>
                                                      </svg>
                                                </span>
                                                            <h4>Personal Details</h4>
                                                            <p>Your Personal information is never shown to other users.</p>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="personalDtlForm">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="First Name" name="first_name" value="<?php echo e(Sentinel::getUser()->first_name); ?>" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="Last Name" name="last_name" value="<?php echo e(Sentinel::getUser()->last_name); ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <?php   $day=''; $month = ''; $year=''; ?>
                                                                <?php if(Sentinel::getUser()->dob): ?>
                                                                    <?php

                                                                    $dob = explode("/", Sentinel::getUser()->dob);
                                                                    $day = $dob[0];
                                                                    $month = $dob[1];
                                                                    $year = $dob[2];
                                                                    ?>
                                                                <?php endif; ?>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <div class="customSelect">
                                                                            <select class="form-control cust_fld" name="day">
                                                                                <option selected="" disabled="">Date of Birth</option>
                                                                                <?php for($i=1;$i<=31;$i++): ?>
                                                                                    <option value="<?php echo e($i); ?>" <?php if($i==$day): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="form-group">
                                                                        <div class="customSelect">
                                                                            <select class="form-control cust_fld" name="month">
                                                                                <option selected="" disabled="">MM</option>
                                                                                <?php for($i=1;$i<=12;$i++): ?>
                                                                                    <option value="<?php echo e($i); ?>" <?php if($i==$month): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <div class="customSelect">
                                                                            <select class="form-control cust_fld" name="year">
                                                                                <option selected="" disabled="">YY</option>
                                                                                <?php for($i=1960;$i<=2018;$i++): ?>
                                                                                    <option value="<?php echo e($i); ?>" <?php if($i==$year): ?> selected="selected" <?php endif; ?>><?php echo e($i); ?></option>
                                                                                <?php endfor; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>
                                                            <?php if(Sentinel::getUser()->address): ?>
                                                                <?php

                                                                $address = explode("|", Sentinel::getUser()->address);
                                                                $street = $address[0];
                                                                $street_2 = $address[1];
                                                                $city = $address[2];
                                                                $state = $address[3];
                                                                $postcode = $address[4];

                                                                ?>
                                                            <?php endif; ?>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="Street Address 1" name="street" value="<?php echo e($street); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="Street Address 2" name="street_2" value="<?php echo e($street_2); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="City" name="city" value="<?php echo e($city); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="State" name="state" value="<?php echo e($state); ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control cust_fld" placeholder="Postcode" name="postcode" value="<?php echo e($postcode); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group" id="" >

                                                                        <div class="customSelect">
                                                                            <?php echo Form::select('country_id',$countries,Sentinel::getUser()->country_id,array('class'=>'form-control select cust_fld','required'=>'required','id'=>'country')); ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="act_btns withdrw_btc">
                                                                <button type="submit" class="btn btn-default btn-xs send_rec"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
                                                                        <path fill="#92a8c0" d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
                                                                    </svg> Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo Form::close(); ?>

                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane fade" id="bank_acc">
                                        <div class="settingTabContent">

                                            <div class="tableTopBtnSection">

                                <span class="act_btns normalWdBtn rightBtn">
                                  <a href="<?php echo e(url('user_bank_account/create')); ?>" class="btn btn-default send_rec">
                                    <?php echo e(trans_choice('general.add',1)); ?> <?php echo e(trans_choice('general.account',1)); ?>

                                </a>
                                </span>
                                            </div>

                                            <div class="tableTopBtnSection">

                                <span class="act_btns normalWdBtn leftBtn">
                                  <a href="<?php echo e(url('user_bank_account/data')); ?>" class="btn btn-default send_rec">
                                    List all accounts
                                </a>
                                </span>
                                            </div>

                                        <!--
                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(trans_choice('general.bank',1)); ?></th>
                                        <th><?php echo e(trans_choice('general.account',1)); ?> <?php echo e(trans_choice('general.name',1)); ?></th>
                                        <th><?php echo e(trans_choice('general.account',1)); ?> <?php echo e(trans_choice('general.number',1)); ?></th>
                                        <th><?php echo e(trans_choice('general.agency_number',1)); ?></th>
                                        <th><?php echo e(trans_choice('general.cpf_number',1)); ?></th>
                                        <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                        <th><?php echo e(trans_choice('general.action',1)); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>Bank Transfer</td>
                                            <td>BOA</td>
                                            <td>123</td>
                                            <td>0000000000</td>
                                            <td></td>
                                            <td><span class="label label-success">Active</span></td>
                                            <td align="center">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <i class="icon-menu9"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                                            <li><a href="#" data-toggle="modal" data-target="#editmodel"><i class="fa fa-edit"></i> Edit </a>
                                                            </li>
                                                            <li><a href="javascript:void();" class="delete"><i class="fa fa-trash"></i> Delete
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                            -->
                                        </div>


                                        <!-- Edi Modal -->
                                        <div id="editmodel" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Add Account</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="edit_bank">
                                                            <form class="verify-documents">
                                                                <div class="form-group" id="">
                                                                    <label for="gender" class="control-label">Bank Account</label>
                                                                    <div class="customSelect">
                                                                        <select class="form-control cust_fld" id="gender" name="gender"><option value="male" selected="selected">Bank Transfer</option><option value="female">Other</option></select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="">
                                                                    <label for="account_name" class="control-label">Account Name</label>
                                                                    <input class="form-control cust_fld" required="required" id="acc_name" name="account_name" type="text">
                                                                </div>
                                                                <div class="form-group" id="">
                                                                    <label for="account_num" class="control-label">Account Number</label>
                                                                    <input class="form-control cust_fld" required="required" id="acc_name" name="account_num" type="text">
                                                                </div>
                                                                <div class="form-group" id="">
                                                                    <label for="agg_num" class="control-label">Agency number</label>
                                                                    <input class="form-control cust_fld" required="required" id="acc_name" name="agg_num" type="text">
                                                                </div>
                                                                <div class="form-group" id="">
                                                                    <label for="cpf_num" class="control-label">cpf number</label>
                                                                    <input class="form-control cust_fld" required="required" id="acc_name" name="cpf_num" type="text">
                                                                </div>
                                                                <div class="form-group" id="">
                                                                    <label for="gender" class="control-label">Default</label>
                                                                    <div class="customSelect">
                                                                        <select class="form-control cust_fld" id="gender" name="gender"><option value="male" selected="selected">Yes</option><option value="female">No</option></select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" id="">
                                                                    <label for="gender" class="control-label">Active</label>
                                                                    <div class="customSelect">
                                                                        <select class="form-control cust_fld" id="gender" name="gender"><option value="male" selected="selected">Yes</option><option value="female">No</option></select>
                                                                    </div>
                                                                </div>
                                                                <div class="act_btns withdrw_btc two_fct_sav">
                                                                    <button type="submit" class="btn btn-default btn-xs send_rec"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
                                                                            <path fill="#92a8c0" d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
                                                                        </svg> Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Edi Modal End -->

                                    </div>

                                    <div class="tab-pane fade" id="veryfy_doc">
                                        <div class="settingTabContent">
                                            <h1>Verify Documents</h1>
                                             <?php if(Sentinel::getUser()->documents_verified==1): ?>
                                                <div class="alert bg-success alert-bordered">
                                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                                class="sr-only">Close</span></button>
                                                    <?php echo e(trans('general.documents_verified')); ?>

                                                </div>
                                            <?php elseif(Sentinel::getUser()->dob == ""): ?>
                                                <div class="alert alert-primary alert-bordered">
                                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                                class="sr-only">Close</span></button>
                                                    <?php echo e(trans('general.verify_documents_dob_mag')); ?>

                                                </div>
                                            <?php else: ?>
                                                <div class="alert alert-primary alert-bordered">
                                                    <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                                class="sr-only">Close</span></button>
                                                    <?php echo e(trans('general.verify_documents_msg')); ?>

                                                </div>
                                            <?php endif; ?>


                                            <?php if(Sentinel::getUser()->documents_verified==0): ?>
                                            <?php echo Form::open(array('url' => 'user/verify_documents/check_documents','class'=>'verify-documents',"enctype" => "multipart/form-data")); ?>

                                            <?php endif; ?>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="first_name" class="control-label">First Name</label>
                                                            <input class="form-control cust_fld" required="required" id="first_name" name="first_name" value="Monark" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="last_name" class="control-label">Last Name</label>
                                                            <input class="form-control cust_fld" required="required" id="last_name" name="last_name" value="Modi" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="gender" class="control-label">Gender</label>
                                                            <div class="customSelect">
                                                                <select class="form-control cust_fld" id="gender" name="gender"><option value="male" selected="selected">Male</option><option value="female">Female</option></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="dob" class="control-label">Date of birth</label>
                                                            <?php echo Form::text('dob',Sentinel::getuser()->dob,array('class'=>' cust_fld form-control date-picker','required'=>'required','id'=>'dob')); ?>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group" id="">
                                                            <label for="country_id" class="control-label">Country</label>
                                                            <div class="customSelect">


                                                                    <?php echo Form::select('country_id',$countries,Sentinel::getUser()->country_id,array('class'=>'form-control cust_fld','required'=>'required','id'=>'country')); ?>


                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                            <?php   $street=''; $street_2 = ''; $city=''; $state=''; $postcode = ''; $country=''; ?>
                            <?php if(Sentinel::getUser()->address): ?>
                              <?php
                                $address = explode("|", Sentinel::getUser()->address);
                                $street = $address[0];
                                $street_2 = $address[1];
                                $city = $address[2];
                                $state = $address[3];
                                $postcode = $address[4];
                              ?>
                            <?php endif; ?>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="city" class="control-label">City</label>
                                                            <input  value="<?php echo e($city); ?>" class="form-control cust_fld" required="required" id="city" name="city" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="address" class="control-label">Address</label>
                                                            <input value="<?php echo e($street); ?>" class="form-control cust_fld" required="required" id="address" rows="2" name="address" type="text">
                                                            <input value="<?php echo e($street_2); ?>" class="form-control cust_fld" required="required" id="address" rows="2" name="street_2" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="zip" class="control-label">Zipcode</label>
                                                            <input value="<?php echo e($postcode); ?>" class="form-control cust_fld" id="zip" name="zip" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="id_type" class="control-label">ID Type</label>
                                                            <div class="customSelect">
                                                                <select class="form-control cust_fld" required="required" id="id_type" name="id_type">

                                                                    <option <?php if(Sentinel::getUser()->id_type == 'id_card' ): ?> selected <?php endif; ?> value="id_card">ID Card</option>
                                                                    <option  <?php if(Sentinel::getUser()->id_type == 'passport' ): ?> selected <?php endif; ?>   value="passport">Passport</option>
                                                                    <option <?php if(Sentinel::getUser()->id_type == 'driver_license' ): ?> selected <?php endif; ?>   value="driver_license">Driver License</option></select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">

                                                            <label for="id_number" class="control-label">ID Number   </label>


                                                            <input value="<?php echo e(Sentinel::getUser()->id_number); ?>" class="form-control cust_fld" required="required" id="id_number" name="id_number" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">

                                                            <label for="id_picture" class="control-label">ID Picture</label>


                                                            <?php if(Sentinel::getUser()->id_picture): ?>
                                                               <a target="_blank" href="<?php echo e(URL::asset('uploads/'.Sentinel::getUser()->id_picture)); ?>"><?php echo e(Sentinel::getUser()->id_picture); ?></a>

                                                               <?php endif; ?>

                                                            <div class="customUpload">
                                                                <input class="form-control"   <?php if(!Sentinel::getUser()->id_picture): ?> required="required" <?php endif; ?> id="id_picture" name="id_picture" type="file">
                                                                <span class="form-control cust_fld">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="16" viewBox="0 0 17 16">
                                  <path fill="#92a8c0" d="M13.843,16.000 L3.157,16.000 C1.418,16.000 -0.000,14.564 -0.000,12.794 L-0.000,8.222 C-0.000,7.947 0.216,7.727 0.487,7.727 C0.758,7.727 0.974,7.947 0.974,8.222 L0.974,12.794 C0.974,14.014 1.952,15.011 3.157,15.011 L13.843,15.011 C15.044,15.011 16.026,14.018 16.026,12.794 L16.026,8.295 C16.026,8.020 16.242,7.800 16.513,7.800 C16.784,7.800 17.000,8.024 17.000,8.295 L17.000,12.794 C17.000,14.560 15.586,16.000 13.843,16.000 ZM11.595,4.136 C11.473,4.136 11.346,4.085 11.253,3.990 L8.987,1.689 L8.987,11.724 C8.987,11.999 8.770,12.219 8.500,12.219 C8.229,12.219 8.013,11.999 8.013,11.724 L8.013,1.689 L5.747,3.990 C5.560,4.180 5.249,4.180 5.062,3.990 C4.870,3.796 4.870,3.484 5.062,3.290 L8.157,0.146 C8.247,0.051 8.370,-0.000 8.500,-0.000 C8.626,-0.000 8.752,0.055 8.843,0.146 L11.938,3.290 C12.129,3.484 12.129,3.796 11.938,3.990 C11.844,4.089 11.722,4.136 11.595,4.136 Z" class="cls-1"></path>
                                </svg>
                                Upload</span>
                                                                <label id="id_picture_name"></label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="proof_of_residence_type" class="control-label">Proof of residence type
                                                            </label>

                                                            <div class="customSelect">
                                                                <select class="form-control cust_fld" required="required" id="proof_of_residence_type" name="proof_of_residence_type">

                                                                    <option <?php if(Sentinel::getUser()->proof_of_residence_type == 'utility_bill'): ?> selected <?php endif; ?>   value="utility_bill">Utility bill</option>
                                                                    <option <?php if(Sentinel::getUser()->proof_of_residence_type == 'bank_statement'): ?> selected <?php endif; ?> value="bank_statement">Bank Statement</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group" id="">
                                                            <label for="proof_of_residence_picture" class="control-label">Proof of residence picture</label>
                                                             <?php if(Sentinel::getUser()->proof_of_residence_picture): ?>
                                                             <a  target="_blank" href="<?php echo e(URL::asset('uploads/'.Sentinel::getUser()->proof_of_residence_picture)); ?>"><?php echo e(Sentinel::getUser()->proof_of_residence_picture); ?></a>
                                                            <?php endif; ?>

                                                            <div class="customUpload">
                                                                <input class="form-control"  onchange="updateList()"  <?php if(!Sentinel::getUser()->proof_of_residence_picture): ?> required="required" <?php endif; ?>  id="proof_of_residence_picture" name="proof_of_residence_picture"  onchange="readURL(this);"  type="file">
                                                                <span class="form-control cust_fld">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="17" height="16" viewBox="0 0 17 16">
                                                          <path fill="#92a8c0" d="M13.843,16.000 L3.157,16.000 C1.418,16.000 -0.000,14.564 -0.000,12.794 L-0.000,8.222 C-0.000,7.947 0.216,7.727 0.487,7.727 C0.758,7.727 0.974,7.947 0.974,8.222 L0.974,12.794 C0.974,14.014 1.952,15.011 3.157,15.011 L13.843,15.011 C15.044,15.011 16.026,14.018 16.026,12.794 L16.026,8.295 C16.026,8.020 16.242,7.800 16.513,7.800 C16.784,7.800 17.000,8.024 17.000,8.295 L17.000,12.794 C17.000,14.560 15.586,16.000 13.843,16.000 ZM11.595,4.136 C11.473,4.136 11.346,4.085 11.253,3.990 L8.987,1.689 L8.987,11.724 C8.987,11.999 8.770,12.219 8.500,12.219 C8.229,12.219 8.013,11.999 8.013,11.724 L8.013,1.689 L5.747,3.990 C5.560,4.180 5.249,4.180 5.062,3.990 C4.870,3.796 4.870,3.484 5.062,3.290 L8.157,0.146 C8.247,0.051 8.370,-0.000 8.500,-0.000 C8.626,-0.000 8.752,0.055 8.843,0.146 L11.938,3.290 C12.129,3.484 12.129,3.796 11.938,3.990 C11.844,4.089 11.722,4.136 11.595,4.136 Z" class="cls-1"></path>
                                                        </svg>
                                                                    Upload</span>

                                                            <label id="proof_of_residence_picture_name"></label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                <span class="act_btns normalWdBtn">
                    <?php if(Sentinel::getUser()->documents_verified==0): ?>
                     <button type="submit" class="legitRipple btn btn-default send_rec">Verify</button>
                        <?php else: ?>
                     <button type="button" class="legitRipple btn btn-default send_rec">Verified</button>
                    <?php endif; ?>
                </span>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="security">
                                        <div class="security_sec">
                                            <div class="verify_phone">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="ph_nums">
                                                            <h1>Phone Numbers</h1>
                                                            <ul>
                                                                <li>
                                                                    <span class="phon">+xx xxxxxxxx54</span>
                                                                    </l1>
                                                                <li>
                                                                    <span class="verfy_stats">verified</span>
                                                                    </l1>
                                                                <li>
                                                                    <span class="primry_num">Primary Phone</span>
                                                                    </l1>
                                                            </ul>
                                                            <ul>
                                                                <li>
                                                                    <span class="phon">+xx xxxxxxxx54</span>
                                                                    </l1>
                                                                <li>
                                                                    <span class="not_verfy">Not Verified</span>
                                                                    </l1>
                                                                <li>
                                                                    <span class="secndry_num">Secondery Phone</span>
                                                                    </l1>
                                                            </ul>
                                                            <div class="vrfy_phne">
                                         <span class="act_btns normalWdBtn"><a href="javascript:void();" class="btn btn-default send_rec">
                                            + Verify A Phone
                                         </a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="two_afct_sec">
                                                            <h1>Two-Factor Authentication</h1>
                                                            <div class="two_fact_data">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="two_fact_left">
                                                                            <h2>Your two factor mathodis is: <span>SMS</span></h2>
                                                                            <p>For more security,enable an authenticator app.</p>
                                                                            <button type="button" class="btn btn-success two_auth">Enable Authenticator</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="two_fact_rght">
                                                                            <h6>Reqiure verification code to send:</h6>
                                                                            <form>
                                                                                <label class="cust_rad">Any amount of digital currency - <span class="hglt_txt">Most Secre</span>
                                                                                    <input type="radio" checked="checked" name="verify_way">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                                <label class="cust_rad">Over 1.2000 BTC(21.7806 ETH) per day
                                                                                    <input type="radio" name="verify_way">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                                <label class="cust_rad">Never - <span class="lest_sec">Least Secure</span>
                                                                                    <input type="radio" name="verify_way">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                                <div class="act_btns withdrw_btc two_fct_sav">
                                                                                    <button type="submit" class="btn btn-default btn-xs send_rec"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
                                                                                            <path fill="#92a8c0" d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
                                                                                        </svg> Save</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="bankacc">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h6 class="panel-title"> <?php echo e(trans_choice('general.bank',1)); ?> <?php echo e(trans_choice('general.account',2)); ?></h6>

                                                <div class="heading-elements">
                                                    <a href="<?php echo e(url('user_bank_account/create')); ?>" class="btn btn-info btn-xs">
                                                        <?php echo e(trans_choice('general.add',1)); ?> <?php echo e(trans_choice('general.account',1)); ?>

                                                    </a>
                                                </div>
                                            </div>
                                            <div class="panel-body ">
                                                <div class="table-responsive">
                                                    <table id="data-table" class="table table-striped table-condensed table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo e(trans_choice('general.bank',1)); ?></th>
                                                            <th><?php echo e(trans_choice('general.account',1)); ?> <?php echo e(trans_choice('general.name',1)); ?></th>
                                                            <th><?php echo e(trans_choice('general.account',1)); ?> <?php echo e(trans_choice('general.number',1)); ?></th>
                                                            <th><?php echo e(trans_choice('general.agency_number',1)); ?></th>
                                                            <th><?php echo e(trans_choice('general.cpf_number',1)); ?></th>
                                                            <th><?php echo e(trans_choice('general.status',1)); ?></th>
                                                            <th><?php echo e(trans_choice('general.action',1)); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                                        <span class="label label-success" data-toggle="tooltip" title="Default"><i
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
                                                                <td class="text-center">
                                                                    <ul class="icons-list">
                                                                        <li class="dropdown">
                                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                                <i class="icon-menu9"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">

                                                                                <li><a href="<?php echo e(url('user_bank_account/'.$key->id.'/edit')); ?>"><i
                                                                                                class="fa fa-edit"></i> <?php echo e(trans('general.edit')); ?> </a>
                                                                                </li>
                                                                                <li><a href="<?php echo e(url('user_bank_account/'.$key->id.'/delete')); ?>"
                                                                                       class="delete"><i
                                                                                                class="fa fa-trash"></i> <?php echo e(trans('general.delete')); ?>

                                                                                    </a>
                                                                                </li>
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
                                            <!-- /.panel-body -->
                                        </div>
                                    </div>

                                <!-- <div class="settingSaveBtn">
        <div class="act_btns withdrw_btc">
            <button type="submit" class="btn btn-default btn-xs send_rec">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="13" height="13" viewBox="0 0 13 13">
  <defs>
    <style>
      .cls-1 {
        fill: #92a8c0;
        fill-rule: evenodd;
      }
    </style>
  </defs>
  <path d="M12.658,12.664 C12.453,12.866 12.145,13.000 11.820,13.000 L10.212,13.000 L2.788,13.000 L1.180,13.000 C0.855,13.000 0.564,12.866 0.342,12.664 C0.137,12.463 -0.000,12.161 -0.000,11.842 L-0.000,1.157 C-0.000,0.839 0.137,0.553 0.342,0.335 C0.564,0.134 0.855,-0.000 1.180,-0.000 L2.788,-0.000 L9.801,-0.000 L10.212,-0.000 C10.314,-0.000 10.400,0.033 10.468,0.101 L12.897,2.482 C12.966,2.550 13.000,2.633 13.000,2.734 L13.000,11.859 C13.000,12.178 12.863,12.463 12.658,12.664 ZM3.130,12.312 L9.853,12.312 L9.853,9.192 C9.853,9.142 9.835,9.108 9.801,9.075 C9.767,9.041 9.733,9.024 9.682,9.024 L3.301,9.024 C3.250,9.024 3.216,9.041 3.181,9.075 C3.147,9.108 3.130,9.142 3.130,9.192 L3.130,12.312 ZM9.870,0.755 C9.870,0.738 9.870,0.721 9.853,0.721 C9.835,0.721 9.835,0.704 9.818,0.704 L3.147,0.704 L3.147,4.663 C3.147,4.747 3.181,4.814 3.233,4.864 C3.284,4.915 3.353,4.948 3.438,4.948 L9.579,4.948 C9.664,4.948 9.733,4.915 9.784,4.864 C9.835,4.814 9.870,4.747 9.870,4.663 L9.870,0.755 ZM12.264,2.868 L10.554,1.191 L10.554,4.663 C10.554,4.932 10.434,5.183 10.263,5.351 C10.075,5.535 9.835,5.636 9.562,5.636 L3.438,5.636 C3.164,5.636 2.908,5.519 2.737,5.351 C2.549,5.166 2.446,4.932 2.446,4.663 L2.446,0.704 L1.197,0.704 C1.078,0.704 0.958,0.755 0.872,0.839 C0.787,0.922 0.735,1.040 0.735,1.157 L0.735,11.859 C0.735,11.977 0.787,12.094 0.872,12.178 C0.958,12.262 1.078,12.312 1.197,12.312 L2.429,12.312 L2.429,9.192 C2.429,8.957 2.532,8.739 2.685,8.588 C2.839,8.437 3.062,8.337 3.301,8.337 L9.682,8.337 C9.921,8.337 10.143,8.437 10.297,8.588 C10.451,8.739 10.554,8.957 10.554,9.192 L10.554,12.312 L11.803,12.312 C11.922,12.312 12.042,12.262 12.128,12.178 C12.213,12.094 12.264,11.977 12.264,11.859 L12.264,2.868 ZM9.100,4.412 L7.389,4.412 C7.304,4.412 7.235,4.344 7.235,4.261 L7.235,2.583 C7.235,2.499 7.304,2.432 7.389,2.432 L9.100,2.432 C9.185,2.432 9.254,2.499 9.254,2.583 L9.254,4.261 C9.254,4.344 9.185,4.412 9.100,4.412 ZM4.481,9.628 L8.501,9.628 C8.689,9.628 8.860,9.779 8.860,9.981 C8.860,10.165 8.706,10.333 8.501,10.333 L4.481,10.333 C4.293,10.333 4.122,10.182 4.122,9.981 C4.122,9.796 4.276,9.628 4.481,9.628 ZM4.481,11.004 L8.501,11.004 C8.689,11.004 8.860,11.155 8.860,11.356 C8.860,11.541 8.706,11.708 8.501,11.708 L4.481,11.708 C4.293,11.708 4.122,11.557 4.122,11.356 C4.122,11.172 4.276,11.004 4.481,11.004 Z" class="cls-1"/>
</svg><?php echo e(trans('general.save')); ?></button>
         </div>
     </div>  -->

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.panel-body -->


                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>


        <section>
            <div class="pageContent stting">
                <div class="container">
                    <div class="pageTitle"><h1>Settings</h1></div>
                    <div class="panel panel-white">
                        <?php echo Form::open(array('url' => url('setting/update'), 'method' => 'post', 'name' => 'form','class'=>"form-horizontal","enctype"=>"multipart/form-data")); ?>

                        <div class="panel-heading">
                            <h6 class="panel-title"><?php echo e(trans_choice('general.setting',2)); ?></h6>

                            <div class="heading-elements">
                                <button type="submit" class="btn btn-info"><?php echo e(trans('general.save')); ?></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li><a href="#general" data-toggle="tab"><?php echo e(trans('general.general')); ?></a></li>
                                    <li><a href="#sms" data-toggle="tab"><?php echo e(trans('general.sms')); ?></a></li>
                                    <li><a href="#email_templates"
                                           data-toggle="tab"><?php echo e(trans_choice('general.email',1)); ?> <?php echo e(trans_choice('general.template',2)); ?></a>
                                    </li>
                                    <li><a href="#sms_templates"
                                           data-toggle="tab"><?php echo e(trans_choice('general.sms',1)); ?> <?php echo e(trans_choice('general.template',2)); ?></a>
                                    </li>
                                    <li class="active"><a href="#system" data-toggle="tab"><?php echo e(trans_choice('general.system',1)); ?></a>
                                    </li>
                                    <li><a href="#update" data-toggle="tab"><?php echo e(trans_choice('general.update',2)); ?></a></li>
                                    <li><a href="#exchange" data-toggle="tab"><?php echo e(trans_choice('general.exchange',2)); ?></a></li>
                                </ul>


                                <div class="tab-content">
                                    <div class="tab-pane" id="general">
                                        <div class="form-group">
                                            <?php echo Form::label('company_name',trans('general.company_name'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::text('company_name',\App\Models\Setting::where('setting_key','company_name')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('company_email',trans('general.company_email'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::email('company_email',\App\Models\Setting::where('setting_key','company_email')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('non_reply_email',trans('general.non_reply_email'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::email('non_reply_email',\App\Models\Setting::where('setting_key','non_reply_email')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('company_website',trans('general.company_website'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::text('company_website',\App\Models\Setting::where('setting_key','company_website')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo Form::label('company_address',trans('general.company_address'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::textarea('company_address',\App\Models\Setting::where('setting_key','company_address')->first()->setting_value,array('class'=>'form-control','rows'=>'2')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('company_country',trans('general.country'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::select('company_country',$countries,\App\Models\Setting::where('setting_key','company_country')->first()->setting_value,array('class'=>' select2','placeholder'=>'','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('portal_address',trans('general.portal_address'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::text('portal_address',\App\Models\Setting::where('setting_key','portal_address')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('company_currency',trans('general.currency'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::text('company_currency',\App\Models\Setting::where('setting_key','company_currency')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('currency_symbol',trans('general.currency_symbol'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::text('currency_symbol',\App\Models\Setting::where('setting_key','currency_symbol')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo Form::label('currency_position',trans('general.currency_position'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::select('currency_position',array('left'=>trans('general.left'),'right'=>trans('general.right')),\App\Models\Setting::where('setting_key','currency_position')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo Form::label('company_logo',trans('general.company_logo'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php if(!empty(\App\Models\Setting::where('setting_key','company_logo')->first()->setting_value)): ?>
                                                    <img src="<?php echo e(url(asset('uploads/'.\App\Models\Setting::where('setting_key','company_logo')->first()->setting_value))); ?>"
                                                         class="img-responsive"/>

                                                <?php endif; ?>
                                                <?php echo Form::file('company_logo',array('class'=>'form-control')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-info"><?php echo e(trans('general.save')); ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="sms">
                                        <div class="form-group">
                                            <?php echo Form::label('sms_enabled',trans('general.sms_enabled'),array('class'=>'col-sm-2 control-label')); ?>


                                            <div class="col-sm-10">
                                                <?php echo Form::select('sms_enabled',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','sms_enabled')->first()->setting_value,array('class'=>'form-control','required'=>'required')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('active_sms',trans('general.active_sms'),array('class'=>'col-sm-2 control-label')); ?>

                                            <div class="col-sm-10">
                                                <?php echo Form::select('active_sms',$sms_gateways,\App\Models\Setting::where('setting_key','active_sms')->first()->setting_value,array('class'=>'form-control','placeholder'=>'')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-info"><?php echo e(trans('general.save')); ?></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="email_templates">
                                        <p>Universal tags to use: <span class="label label-info">{name}</span> <span
                                                    class="label label-info">{activationLink}</span> <span class="label label-info">{transactionId}</span>
                                            <span class="label label-info">{amount}</span>
                                        </p>

                                        <div class="form-group">
                                            <?php echo Form::label('password_reset_subject',trans('general.password_reset_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('password_reset_subject',\App\Models\Setting::where('setting_key','password_reset_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('password_reset_template',trans('general.password_reset_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('password_reset_template',\App\Models\Setting::where('setting_key','password_reset_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('new_account_subject',trans('general.new_account_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('new_account_subject',\App\Models\Setting::where('setting_key','new_account_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('new_account_template',trans('general.new_account_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('new_account_template',\App\Models\Setting::where('setting_key','new_account_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('withdrawal_paid_email_subject',trans('general.withdrawal_paid_email_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('withdrawal_paid_email_subject',\App\Models\Setting::where('setting_key','withdrawal_paid_email_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('withdrawal_paid_email_template',trans('general.withdrawal_paid_email_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('withdrawal_paid_email_template',\App\Models\Setting::where('setting_key','withdrawal_paid_email_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('withdrawal_declined_email_subject',trans('general.withdrawal_declined_email_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('withdrawal_declined_email_subject',\App\Models\Setting::where('setting_key','withdrawal_declined_email_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('withdrawal_declined_email_template',trans('general.withdrawal_declined_email_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('withdrawal_declined_email_template',\App\Models\Setting::where('setting_key','withdrawal_declined_email_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('payment_email_subject',trans('general.payment_email_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('payment_email_subject',\App\Models\Setting::where('setting_key','payment_email_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('payment_email_template',trans('general.payment_email_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('payment_email_template',\App\Models\Setting::where('setting_key','payment_email_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('sell_email_subject',trans('general.sell_email_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('sell_email_subject',\App\Models\Setting::where('setting_key','sell_email_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('sell_email_template',trans('general.sell_email_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('sell_email_template',\App\Models\Setting::where('setting_key','sell_email_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('withdrawal_request_email_subject',trans('general.withdrawal_request_email_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('withdrawal_request_email_subject',\App\Models\Setting::where('setting_key','withdrawal_request_email_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('withdrawal_request_email_template',trans('general.withdrawal_request_email_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('withdrawal_request_email_template',\App\Models\Setting::where('setting_key','withdrawal_request_email_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('account_accessed_email_subject',trans('general.account_accessed_email_subject'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('account_accessed_email_subject',\App\Models\Setting::where('setting_key','account_accessed_email_subject')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('account_accessed_email_template',trans('general.account_accessed_email_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('account_accessed_email_template',\App\Models\Setting::where('setting_key','account_accessed_email_template')->first()->setting_value,array('class'=>'form-control tinymce')); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="sms_templates">
                                        <p>Universal tags to use: <span class="label label-info">{name}</span> <span
                                                    class="label label-info">{otp}</span>
                                        </p>



                                        <div class="form-group">
                                            <?php echo Form::label('otp_sms_template',trans('general.otp_sms_template'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('otp_sms_template',\App\Models\Setting::where('setting_key','otp_sms_template')->first()->setting_value,array('class'=>'form-control','rows'=>'4')); ?>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane active" id="system">
                                        <div class="form-group">
                                            <?php echo Form::label('enable_cron',trans('general.cron_enabled'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('enable_cron',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','enable_cron')->first()->setting_value,array('class'=>'form-control')); ?>

                                                <small>Last
                                                    Run:<?php if(!empty(\App\Models\Setting::where('setting_key','cron_last_run')->first()->setting_value)): ?> <?php echo e(\App\Models\Setting::where('setting_key','cron_last_run')->first()->setting_value); ?> <?php else: ?>
                                                        Never <?php endif; ?></small>
                                                <br>
                                                <small>Cron Url: <?php echo e(url('cron')); ?></small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('phone_verify',trans('general.phone_verified'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('phone_verify',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','phone_verify')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('email_verify',trans('general.email_verified'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('email_verify',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','email_verify')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('documents_verify',trans('general.documents_verified'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('documents_verify',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','documents_verify')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('auto_email_activation',trans('general.auto_email_activation'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('auto_email_activation',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','auto_email_activation')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('cancel_withdrawal',trans('general.cancel_withdrawal'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('cancel_withdrawal',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','cancel_withdrawal')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('notify_withdrawal_request',trans('general.notify_withdrawal_request'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('notify_withdrawal_request',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','notify_withdrawal_request')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('notify_exchange_complete',trans('general.notify_exchange_complete'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('notify_exchange_complete',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','notify_exchange_complete')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('wallet_address_limit',trans('general.wallet_address_limit'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('wallet_address_limit',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','wallet_address_limit')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('wallet_address_source',trans('general.wallet_address_source'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('wallet_address_source',array('1'=>trans('general.online'),'0'=>trans('general.offline')),\App\Models\Setting::where('setting_key','wallet_address_source')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo Form::label('account_accessed_notification',trans('general.account_accessed_notification'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('account_accessed_notification',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','account_accessed_notification')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('enable_withdrawal_otp',trans('general.enable_withdrawal_otp'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('enable_withdrawal_otp',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','enable_withdrawal_otp')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('enable_partial_order_fulfilment',trans('general.enable_partial_order_fulfilment'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('enable_partial_order_fulfilment',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','enable_partial_order_fulfilment')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('site_online',trans('general.site_online'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('site_online',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','site_online')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('enable_frontend',trans('general.enable_frontend'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('enable_frontend',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','enable_frontend')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('order_expire_days',trans('general.order_expire_days'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('order_expire_days',\App\Models\Setting::where('setting_key','order_expire_days')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('enable_google_recaptcha',trans('general.enable_google_recaptcha'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::select('enable_google_recaptcha',array('1'=>trans('general.yes'),'0'=>trans('general.no')),\App\Models\Setting::where('setting_key','enable_google_recaptcha')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo Form::label('google_recaptcha_site_key',trans('general.google_recaptcha_site_key'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('google_recaptcha_site_key',\App\Models\Setting::where('setting_key','google_recaptcha_site_key')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('google_recaptcha_secret_key',trans('general.google_recaptcha_secret_key'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::text('google_recaptcha_secret_key',\App\Models\Setting::where('setting_key','google_recaptcha_secret_key')->first()->setting_value,array('class'=>'form-control')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('custom_header_javascript',trans('general.custom_header_javascript'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('custom_header_javascript',\App\Models\Setting::where('setting_key','custom_header_javascript')->first()->setting_value,array('class'=>'form-control','rows'=>'3')); ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php echo Form::label('custom_footer_javascript',trans('general.custom_footer_javascript'),array('class'=>'col-sm-3 control-label')); ?>

                                            <div class="col-sm-9">
                                                <?php echo Form::textarea('custom_footer_javascript',\App\Models\Setting::where('setting_key','custom_footer_javascript')->first()->setting_value,array('class'=>'form-control','rows'=>'3')); ?>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane" id="update">
                                        <div class="form-group">
                                            <div class="col-sm-4 text-right">Local Version:</div>

                                            <div class="col-sm-4">
                                                <span class="label label-primary"><?php echo e(\App\Models\Setting::where('setting_key','system_version')->first()->setting_value); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4 text-right">Server Version:</div>

                                            <div class="col-sm-4">
                                                <button class="btn btn-info btn-sm" type="button" id="checkUpdate">Check Version
                                                </button>
                                                <br>
                                                <span class="label label-primary" id="serverVersion"></span>
                                            </div>
                                        </div>
                                        <div id="updateMessage"></div>
                                    </div>

                                    <div class="tab-pane" id="exchange">
                                        <div class="form-group">

                                            <div class="form-group">
                                                <?php echo Form::label('cex_username',trans('cex_username'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('cex_username',\App\Models\Setting::where('setting_key','cex_username')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo Form::label('cex_api',trans('cex api'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('cex_api',\App\Models\Setting::where('setting_key','cex_api')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo Form::label('cex_secret',trans('cex secret'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('cex_secret',\App\Models\Setting::where('setting_key','cex_secret')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo Form::label('aed_rate',trans('aed rate'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('aed_rate',\App\Models\Setting::where('setting_key','aed_rate')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo Form::label('buy_percentage',trans('buy percentage '),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('buy_percentage',\App\Models\Setting::where('setting_key','buy_percentage')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo Form::label('sell_percentage',trans('sell percentage '),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('sell_percentage',\App\Models\Setting::where('setting_key','sell_percentage')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo Form::label('min_BTC',trans('min BTC'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('min_BTC',\App\Models\Setting::where('setting_key','min_BTC')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo Form::label('min_ETH',trans('min ETH'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('min_ETH',\App\Models\Setting::where('setting_key','min_ETH')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo Form::label('min_XRP',trans('min XRP'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('min_XRP',\App\Models\Setting::where('setting_key','min_XRP')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <?php echo Form::label('min_LTC',trans('min LTC'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('min_LTC',\App\Models\Setting::where('setting_key','min_LTC')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <?php echo Form::label('min_USD',trans('min USD'),array('class'=>'col-sm-3 control-label')); ?>

                                                <div class="col-sm-9">
                                                    <?php echo Form::text('min_USD',\App\Models\Setting::where('setting_key','min_USD')->first()->setting_value,array('class'=>'form-control')); ?>

                                                </div>
                                            </div>



                                        </div>

                                        <div id="updateMessage"></div>
                                    </div>

                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo e(trans('general.save')); ?></button>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- /.box -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer-scripts'); ?>
    <script>
        //   $( ".alert-danger").hide();
        //   $( ".alert-success").hide();
        //hide-show change password form
        $('#changepassword').click(function () {
            $("#changepassword-form").toggle();
        })

        $('#checkUpdate').click(function (e) {
            $.ajax({
                type: 'POST',
                url: '<?php echo e(\App\Models\Setting::where('setting_key','update_url')->first()->setting_value); ?>',
                dataType: 'json',
                success: function (data) {
                    if ("<?php echo \App\Models\Setting::where('setting_key','system_version')->first()->setting_value; ?>}" < data.version) {
                        swal({
                            title: '<?php echo e(trans_choice('general.update_available',1)); ?><br>v' + data.version,
                            html: data.notes,
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<?php echo e(trans_choice('general.download',1)); ?>',
                            cancelButtonText: '<?php echo e(trans_choice('general.cancel',1)); ?>'
                        }).then(function () {
                            //curl function to download update
                            //notify user that update is in progress, do not navigate from page
                            $('#updateMessage').html("<div class='alert alert-warning'><?php echo e(trans_choice('general.do_not_navigate_from_page',1)); ?></div>");
                            window.location = "<?php echo e(url('update/download?url=')); ?>" + data.url;
                        });
                        $('#serverVersion').html(data.version);
                    } else {
                        swal({
                            title: '<?php echo e(trans_choice('general.no_update_available',1)); ?>',
                            text: '<?php echo e(trans_choice('general.system_is_up_to_date',1)); ?>',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '<?php echo e(trans_choice('general.ok',1)); ?>',
                            cancelButtonText: '<?php echo e(trans_choice('general.cancel',1)); ?>'
                        })
                    }
                }
                ,
                error: function (e) {
                    alert("There was an error connecting to the server")
                }
            });
        })
    </script>
    <script type="application/javascript" >
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $('#uploadprofile').click( function(e){
            $( ".alert-danger").hide();
            $( ".alert-success").hide();
            console.log("sdd");
            var formData = new FormData($("#profile-form")[0]);
            formData.append('images', $('input[type=file]')[0].files[0]);
            if($('input[type=file]')[0].files[0])
            {
                $('#profile-upload-btn a').attr('disabled', true);

                $.ajax({
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url:"<?php echo e(route('uploadprofile')); ?>",
                    data: formData,
                    success: function (responseData) {
                        $("#profile_success").html('');
                        $("#profile_success").html('<li>Profile updated successfully.</li><br>' );
                        $( ".alert-success").show();
                        $('#profile-upload-btn a').removeAttr('disabled');
                    },
                    error: function (responseData) {
                        $("#profile_errors").html('');
                        var errors = $.parseJSON(responseData.responseText);
                        var i=1;
                        $.each( errors, function( key, value ) {
                            $("#profile_errors").append('<li>'+ i++ +'.'+ value+'</li><br>' );
                            $( ".alert-danger").show();
                        });
                        var scroll_error = $(".alert.alert-danger").offset().top;
                        $(window).scrollTop(scroll_error-100);
                        $('#profile-upload-btn a').removeAttr('disabled');
                    }
                });
            }
            else{
                $("#profile_errors").html('');
                $("#profile_errors").append('<li>Oops! Profile picture not selected.</li><br>' );
                $( ".alert-danger").show();
            }
        });
    </script>
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
    <script>
        $('#id_picture').change(function() {
            $('#id_picture_name').html(this.files && this.files.length ? this.files[0].name.split('**')[0] : '');

        })
        $('#proof_of_residence_picture').change(function() {
            $('#proof_of_residence_picture_name').html(this.files && this.files.length ? this.files[0].name.split('**')[0] : '');

        })
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>