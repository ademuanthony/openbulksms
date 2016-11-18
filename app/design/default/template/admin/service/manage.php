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
        Manage Products/Service
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Service', 'Admin')?>"><i class="fa fa-dashboard"></i> Products/Services</a></li>
        <li class="active"><?php echo $this->data['service']->Name?> </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-5">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Products/Service</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <img  style="margin-bottom: 10px; width: 250px" alt="No Screen shot"
                         src="<?php echo OpenSms::getImage($this->data['service']->Image) ?>" class="image img-responsive"/>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->


        <div class="col-md-7">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Manage Service</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <form enctype="multipart/form-data" role="form" action="<?php echo OpenSms::getActionUrl('manage')?>/<?php echo $this->data['service']->Id ?>" method="post">
                    <div class="box-body">

                        <input type="hidden" name="id" value="<?php echo $this->data['service']->Id?>">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <?php OpenSms_Helper_Html::TextEditorFor('name', $this->data['service']->Name, array('class' => 'form-control'));?>
                        </div>
                        <div class="form-group">
                            <label for="name">Price</label>
                            <?php OpenSms_Helper_Html::TextEditorFor('price', $this->data['service']->Price, array('class' => 'form-control'));?>
                        </div>
                        <div class="form-group">
                            <label for="name">Description</label>
                            <?php OpenSms_Helper_Html::TextAreaFor('description', $this->data['service']->Description, array('class' => 'form-control'));?>
                        </div>

                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" class="form-control" id="image" name="image" placeholder="Image File Path">
                        </div>


                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->