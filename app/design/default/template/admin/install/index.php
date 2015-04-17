<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 3/20/2015
 * Time: 3:34 PM
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Admin
        <small>Installer</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin/install"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Install</li>
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
            <h3 class="box-title">General Info</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?php echo OpenSms::getActionUrl('save')?>" method="post">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Site Name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value="<?php echo $this->getFormData('site_name', OpenSms::FORM_POST_METHOD)?>" placeholder="Display name of this site">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">URL</label>
                    <input type="text" class="form-control" id="site_url" name="site_url" value="<?php echo $this->getFormData('site_url', OpenSms::FORM_POST_METHOD)?>" placeholder="Site URL">
                </div>

                <!--database-->
                <div class="form-group">
                    <label for="exampleInputEmail1">Database Server</label>
                    <input type="text" class="form-control" id="opensms_db_host" name="opensms_db_host" value="<?php echo $this->getFormData('opensms_db_host', OpenSms::FORM_POST_METHOD)?>" placeholder="Database server address">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Database Name</label>
                    <input type="text" class="form-control" id="opensms_db_name" name="opensms_db_name" value="<?php echo $this->getFormData('opensms_db_name', OpenSms::FORM_POST_METHOD)?>" placeholder="Database name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Database Table Prefix</label>
                    <input type="text" class="form-control" id="opensms_table_prefix" name="opensms_table_prefix" value="<?php echo $this->getFormData('opensms_table_prefix', OpenSms::FORM_POST_METHOD)?>" placeholder="Database table prefix">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Database Username</label>
                    <input type="text" class="form-control" id="opensms_username" name="opensms_username" value="<?php echo $this->getFormData('opensms_username', OpenSms::FORM_POST_METHOD)?>" placeholder="Database username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Database Password</label>
                    <input type="text" class="form-control" id="opensms_password" name="opensms_password" value="<?php echo $this->getFormData('opensms_password', OpenSms::FORM_POST_METHOD)?>" placeholder="Database password">
                </div>

                <hr/>

                <div class="form-group">
                    <label for="exampleInputPassword1">Admin Username</label>
                    <input type="text" class="form-control" id="admin_username" name="admin_username" value="<?php echo $this->getFormData('admin_username', OpenSms::FORM_POST_METHOD)?>" placeholder="Admin username">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Admin Password</label>
                    <input type="text" class="form-control" id="admin_password" name="admin_password" placeholder="Admin password">
                </div>

                <hr/>

                <div class="form-group">
                    <label for="exampleInputPassword1">Units Per SMS</label>
                    <input type="text" class="form-control" id="admin_username" name="<?php echo OpenSms::OPEN_UNITS_PER_SMS?>"
                           value="<?php echo $this->getFormData(OpenSms::OPEN_UNITS_PER_SMS, OpenSms::FORM_POST_METHOD)?>" placeholder="Units per SMS">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Price Per Unit</label>
                    <input type="text" class="form-control" id="admin_username" name="<?php echo OpenSms::OPEN_PRICE_PER_UNIT?>"
                           value="<?php echo $this->getFormData(OpenSms::OPEN_PRICE_PER_UNIT,
                               OpenSms::FORM_POST_METHOD)?>" placeholder="Price Per Units">
                </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Install</button>
            </div>
        </form>
    </div><!-- /.box -->


</div><!--/.col (left) -->
<!-- right column -->
<div class="col-md-6">
    <!-- general form elements disabled -->
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Welcome To OpenSMS</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <p>You are some seconds away from having a complete themeable, extensible, plugable bulk sms site.<br/>
            <b>Enjoy!</b></p>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!--/.col (right) -->
</div>

</section><!-- /.content -->