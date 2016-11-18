<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 6/30/2015
 * Time: 8:56 AM
 */
?>


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Manage Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Manage Images</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-7">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Users List</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>View</th>
                            <th>Uri</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($this->data['images'] as $key=>$link){ ?>
                            <tr>
                                <td><?php echo ++$this->data['sn']; ?></td>
                                <td><img style="max-width: 250px;" src="<?php echo $link ?>" class="img-thumbnail img-rounded"/> </td>
                                <td><input type="text" value="<?php echo $link ?>"> </td>
                                <td>
                                    <a href="<?php echo OpenSms::getActionUrl('deleteImage', 'cms', 'cms', [0 => $key])?>"
                                       class="btn btn-warning">Delete</a>
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
                    <h3 class="box-title">New Image</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <form role="form" action="<?php echo OpenSms::getActionUrl('addImage')?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" class="form-control" name="key" placeholder="Image key">
                        </div>
                        <div class="form-group">
                            <label for="username">Image</label>
                            <input type="file" class="form-control" required
                                   name="image" placeholder="Select an image">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Add Image</button>
                    </div>
                </form>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->