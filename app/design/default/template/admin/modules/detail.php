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
        Manage Modules
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Modules', 'Admin')?>">Modules</a></li>
        <li class="active">Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <form method="post"action="<?php echo OpenSms::getActionUrl('Update'); ?>">
        <input type="hidden" name="name" value="<?php echo $this->data['module']->name ?>">

        <div class="row">
            <div class="col-md-4 col-md-offset-8">

                <div class="box box-default">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary btn-lg"
                                       value="<?php echo OpenSms::OPEN_OPTION_YES == $this->data['module']->enabled ? 'Disable': 'Enable' ?>" name="Disable"/>
                            </div>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-danger btn-lg" value="Save Changes" name="Save"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">


                <!-- general information -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">General Information</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <td style="width: 100px;"><strong>Name: </strong></td>
                                <td><?php echo $this->data['module']->name; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100px;"><strong>Label: </strong></td>
                                <td><?php echo $this->data['module']->label; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100px;"><strong>Company: </strong></td>
                                <td><?php echo $this->data['module']->company; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100px;"><strong>version: </strong></td>
                                <td><?php echo $this->data['module']->version; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100px;"><strong>License: </strong></td>
                                <td><?php echo $this->data['module']->license; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100px;"><strong>Path: </strong></td>
                                <td><?php echo $this->data['module']->path; ?></td>
                            </tr>
                            <tr>
                                <td style="width: 100px;"><strong>Enabled: </strong></td>
                                <td><?php echo $this->data['module']->enabled; ?></td>
                            </tr>
                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->


            </div><!-- /.col -->

            <div class="col-md-8">


                <?php if(count($this->data['module']->payments) > 0){ ?>
                <!-- payments -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Payment Methods</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Label</th>
                                <th>Key</th>
                                <th>Order Status</th>
                                <th>Sort Order</th>
                                <th>Enabled</th>
                            </tr>
                            </thead>
                            <?php $sn = 0; foreach($this->data['module']->payments as $p){ ?>
                                <tr>
                                    <td><?php echo ++$sn; ?></td>
                                    <td><?php echo $p->label; ?></td>
                                    <td><?php echo $p->key; ?></td>
                                    <td>
                                        <?php OpenSms_Helper_Html::SelectFor($p->key.'[order_status]',
                                            [OpenSms::OPEN_TRANSACTION_STATUS_PENDING,
                                                OpenSms::OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT,
                                                OpenSms::OPEN_TRANSACTION_STATUS_PROCESSING,
                                                OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED],
                                            $p->order_status, null, null, ['class'=>'form-control']); ?>
                                    </td>
                                    <td><?php OpenSms_Helper_Html::TextEditorFor($p->key.'[sort_order]', $p->sort_order, ['class'=>'form-control']) ?></td>
                                    <td><?php OpenSms_Helper_Html::SelectFor($p->key.'[enabled]',
                                            [OpenSms::OPEN_OPTION_YES, OpenSms::OPEN_OPTION_NO],
                                            $p->enable, null, null, ['class'=>'form-control']); ?></td>
                                </tr>

                            <?php } ?>

                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <?php } ?>


                <?php if(count($this->data['module']->fields) > 0){ ?>
                <!-- field -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Fields</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="min-width: 40px;">#</th>
                                <th  style="min-width: 100px;">Label</th>
                                <th  style="min-width: 100px;">Key</th>
                                <th  style="min-width: 80px;">Data Type</th>
                                <th  style="min-width: 40px;">Sort Order</th>
                                <th  style="min-width: 100px;">Value</th>
                            </tr>
                            </thead>
                            <?php $sn = 0; foreach($this->data['module']->fields as $p){ ?>
                                <tr>
                                    <td><?php echo ++$sn; ?></td>
                                    <td><?php echo $p->label; ?></td>
                                    <td><?php echo $p->key; ?></td>
                                    <td><?php echo $p->type; ?></td>
                                    <td><?php OpenSms_Helper_Html::TextEditorFor($p->key.'[sort_order]', $p->sort_order, ['class'=>'form-control']) ?></td>
                                    <td><?php OpenSms_Helper_Html::TextEditorFor($p->key.'[value]', $p->value, ['class'=>'form-control']) ?></td>
                                </tr>

                            <?php } ?>

                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->

                <?php } ?>

            </div><!-- /.col -->


        </div><!-- /.row -->

        <?php if(count($this->data['module']->routes) > 0){ ?>
        <div class="row">
            <div class="col-md-12">

                <!-- routes -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Routes</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>URI</th>
                                <th>File Path</th>
                                <th>Controller</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <?php $sn = 0; foreach($this->data['module']->routes as $r){ ?>
                                <tr>
                                    <td><?php echo ++$sn; ?></td>
                                    <td><?php echo $r->uri; ?></td>
                                    <td><?php echo $r->filePath; ?></td>
                                    <td><?php echo $r->controller; ?></td>
                                    <td><?php echo $r->action; ?></td>
                                </tr>

                            <?php } ?>

                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
        <?php }?>

        <?php if(count($this->data['module']->modelRegistry) > 0){ ?>
        <div class="row">
            <div class="col-md-12">

                <!-- routes -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Model Registry</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Key</th>
                                <th>Class Name</th>
                                <th>File Path</th>
                            </tr>
                            </thead>
                            <?php $sn = 0; foreach($this->data['module']->modelRegistry as $r){ ?>
                                <tr>
                                    <td><?php echo ++$sn; ?></td>
                                    <td><?php echo $r->key; ?></td>
                                    <td><?php echo $r->className; ?></td>
                                    <td><?php echo $r->filePath; ?></td>
                                </tr>

                            <?php } ?>

                        </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

        <?php }?>

    </form>

</section><!-- /.content -->