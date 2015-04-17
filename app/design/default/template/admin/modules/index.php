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
        <li class="active">Manage Modules</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-7">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Modules List</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Version</th>
                            <th>Licence</th>
                            <th>Path</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 0;
                        foreach($this->data['modules'] as $m){ ?>
                            <tr>
                                <td><?php echo ++$sn; ?></td>
                                <td><?php echo $m->name; ?></td>
                                <td><?php echo $m->version; ?></td>
                                <td><?php echo $m->license; ?></td>
                                <td><?php echo $m->path; ?></td>
                                <td>
                                    <a href="<?php echo OpenSms::getActionUrl('detail', 'modules', 'admin', [0 => strtolower($m->name)])?>"
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
                    <h3 class="box-title">New Module</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <form enctype="multipart/form-data" role="form" action="<?php echo OpenSms::getActionUrl('add')?>" method="post">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="name">Module File</label>
                            <input type="file" class="form-control" id="file" name="zip_file" placeholder="Module File Path">
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