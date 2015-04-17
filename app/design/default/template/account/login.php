<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/20/2015
 * Time: 3:34 PM
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Account
        <small>Login</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/install"><i class="fa fa-dashboard"></i> Account</a></li>
        <li class="active">Login</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Login to your account</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo OpenSms::getActionUrl('login')?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="LoginId" required
                                   name="LoginId" placeholder="Enter you desired username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" required id="password"
                                   name="Password" placeholder="Enter your password">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Welcome To <?php echo OpenSms::getSystemSetting(OpenSms::SITE_NAME);?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>You are some seconds away from enjoying the best bulk sms service in Nigeria.<br/>
                        <b>Enjoy!</b></p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>

</section><!-- /.content -->