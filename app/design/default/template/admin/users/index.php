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
        Manage Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Manage Users</li>
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>Phone Number</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach($this->data['users'] as $u){ ?>
                                <tr>
                                    <td><?php echo ++$this->data['sn']; ?></td>
                                    <td><?php echo $u->Name; ?></td>
                                    <td><?php echo $u->LoginId; ?></td>
                                    <td><?php echo $u->MobileNo; ?></td>
                                    <td>
                                        <a href="<?php echo OpenSms::getActionUrl('manage', 'users', 'admin', [0 => $u->LoginId])?>" class="btn btn-info">Manage</a> |
                                        <a href="<?php echo OpenSms::getActionUrl('delete', 'users', 'admin', [0 => $u->LoginId])?>" class="btn btn-warning">Delete</a>
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
                    <h3 class="box-title">New User</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <form role="form" action="<?php echo OpenSms::getActionUrl('add')?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="Name" placeholder="Your fullname">
                        </div>
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
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="EmailId"
                                   required placeholder="Enter a valid Email Address">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="number" name="MobileNo"
                                   required placeholder="Enter your phone number">
                        </div>


                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="Address"
                                   required placeholder="Enter your address">
                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </div>
                </form>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->