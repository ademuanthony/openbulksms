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
        Groups
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Groups</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-8">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">My Groups</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">

                        <?php foreach ($this->data['groups'] as $group) {?>
                            <li class="item">
                                <div class="product-img">
                                    <?php echo (++$this->date['sn'])?>
                                </div>
                                <div class="product-info">
                                    <a href="<?php echo OpenSms::getActionUrl('detail', '*', 'group', ['parameter1'=>$group->Id])?>"
                                       class="ui-shadow ui-btn ui-corner-all"><?php echo $group->Name?></a>
                                    <a href="<?php echo OpenSms::getActionUrl('delete', '*', 'group', ['parameter1'=>$group->Id])?>"
                                       class="ui-shadow ui-btn ui-corner-all"><i class="fa fa-times"></i></a>
                        <span class="product-description">
                          <?php echo $group->Description?>
                        </span>
                                </div>
                            </li><!-- /.item -->

                        <?php }
                        ?>



                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->


        <div class="col-md-4">

            <div class="box box-info">
                <form action="<?php echo OpenSms::getActionUrl('Add', '*')?>" method="post">
                <div class="box-header">
                    <i class="fa fa-plus-square"></i>
                    <h3 class="box-title">New Group</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    </div><!-- /. tools -->
                </div>
                <div class="box-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="Name" placeholder="Group Name"/>
                        </div>
                        <div>
                            <textarea name="Description" class="form-control" placeholder="Description" style="width: 100%; height: 125px;
                        font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                </div>
                <div class="box-footer clearfix">
                    <button style="color: #ffffff" class="pull-right btn btn-default btn-success">Save <i class="fa fa-save"></i></button>
                </div>

                </form>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->