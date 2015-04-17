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
        Manage Themes
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Manage Themes</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-4">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Current Theme</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body with-border">
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
                <div class="box-footer">
                    <a class="btn btn-primary" href="<?php echo OpenSms::getActionUrl('Detail', 'Themes', 'Admin', [0 => $this->data['theme']->key])?>">Manage Theme</a>
                </div>
            </div><!-- /.box -->
        </div>

        <div class="col-md-8">
            <img style="margin-bottom: 10px;" alt="No Screen shot"
                 src="<?php echo !empty($this->data['theme']->screenShot) ? $this->data['theme']->screenShot :
                OpenSms::getBaseUrl().OpenSms::NO_IMAGE ?>" class="image img-responsive"/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Theme List</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Key</th>
                            <th>Version</th>
                            <th>Author</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 0;
                        foreach($this->data['themes'] as $theme){ ?>
                            <tr>
                                <td>
                                    <img style="margin-bottom: 10px; width: 250px" alt="No Screen shot"
                                         src="<?php echo !empty($theme->screenShot) ? $theme->screenShot :
                                             OpenSms::getBaseUrl().OpenSms::NO_IMAGE ?>" class="image img-responsive"/>
                                   </td>
                                <td><?php echo $theme->name; ?></td>
                                <td><?php echo $theme->key; ?></td>
                                <td><?php echo $theme->version; ?></td>
                                <td><?php echo $theme->author; ?></td>
                                <td>
                                    <a href="<?php echo OpenSms::getActionUrl('detail', 'themes', 'admin', [0 => strtolower($theme->key)])?>"
                                       class="btn btn-info">Manage</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->


        <div class="col-md-5">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">New Theme</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <form enctype="multipart/form-data" role="form" action="<?php echo OpenSms::getActionUrl('add')?>" method="post">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Theme File</label>
                            <input type="file" class="form-control" id="file" name="zip_file" placeholder="Theme File Path">
                        </div>


                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Install</button>
                    </div>
                </form>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->