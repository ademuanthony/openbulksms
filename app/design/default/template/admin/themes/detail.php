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
            Manage Theme
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Themes', 'Admin')?>">Themes</a></li>
            <li class="active">Detail</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <form method="post"action="<?php echo OpenSms::getActionUrl('Update'); ?>">
            <input type="hidden" name="key" value="<?php echo $this->data['theme']->key ?>">

            <div class="row">
                <div class="col-md-4 col-md-offset-8">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-primary btn-lg"
                                           value="activate" name="Activate"/>
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
                                    <td><?php echo $this->data['theme']->name; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px;"><strong>Key: </strong></td>
                                    <td><?php echo $this->data['theme']->key; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px;"><strong>Author: </strong></td>
                                    <td><?php echo $this->data['theme']->author; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px;"><strong>Version: </strong></td>
                                    <td><?php echo $this->data['theme']->version; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px;"><strong>Email: </strong></td>
                                    <td><?php echo $this->data['theme']->email; ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 100px;"><strong>Url: </strong></td>
                                    <td><?php echo $this->data['theme']->url; ?></td>
                                </tr>
                            </table>

                        </div><!-- /.box-body -->
                    </div><!-- /.box -->


                </div><!-- /.col -->

                <div class="col-md-8">
                    <img style="margin-bottom: 10px;" alt="No Screen shot"
                         src="<?php echo !empty($this->data['theme']->screenShot) ? $this->data['theme']->screenShot :
                             OpenSms::getBaseUrl().OpenSms::NO_IMAGE ?>" class="image img-responsive"/>

                    <?php if(count($this->data['theme']->fields) > 0){ ?>
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
                                        <th  style="min-width: 40px;">Readonly</th>
                                        <th  style="min-width: 100px;">Value</th>
                                    </tr>
                                    </thead>
                                    <?php $sn = 0; foreach($this->data['theme']->fields as $p){ ?>
                                        <tr>
                                            <td><?php echo ++$sn; ?></td>
                                            <td><?php echo $p->label; ?></td>
                                            <td><?php echo $p->key; ?></td>
                                            <td><?php echo $p->type; ?></td>
                                            <td><?php echo $p->readonly; ?></td>
                                            <td><?php OpenSms_Helper_Html::TextEditorFor($p->key.'[value]', $p->value, ['class'=>'form-control']) ?></td>
                                        </tr>

                                    <?php } ?>

                                </table>

                            </div><!-- /.box-body -->
                        </div><!-- /.box -->

                    <?php } ?>

                </div><!-- /.col -->


            </div><!-- /.row -->



        </form>

    </section><!-- /.content --><?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/9/2015
 * Time: 8:38 AM
 */ 