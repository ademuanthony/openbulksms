<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/21/2015
 * Time: 8:41 AM
 */
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Admin
        <small>Installer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('index', 'dashboard')?>"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Install</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

        <!-- right column -->
        <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Welcome To OpenSMS</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p><?php $this->printData('message');?>.<br/>
                        <b>Enjoy!</b></p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->

        <?php if($this->data['success']){?>
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Admin Login</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?php echo OpenSms::getActionUrl('login', 'account', 'account')?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" id="username" required="required"
                                   name="username" value="<?php echo $this->getFormData('username', OpenSms::FORM_POST_METHOD)?>"
                                   placeholder="Admin Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" required="required" class="form-control" id="site_url" name="admin_password" placeholder="Admin Password">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Install</button>
                    </div>
                </form>
            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <?php }?>
    </div>

</section><!-- /.content -->