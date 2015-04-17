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
        Dashboard
        <small><?php echo $this->data['user']->Name?></small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="row">
    <div class="col-md-12">


        <!-- GROUP LIST -->
        <div class="box box-danger">

            <form method="post"
                  action="<?php echo OpenSms::getActionUrl('update', 'users', 'admin', [0 => $this->data['curUser']->LoginId])?>">
                <div class="box-header with-border">
                    <h3 class="box-title">User Detail</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->


                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input value="<?php echo !empty($this->data['user']->Name)?$this->data['user']->Name:''; ?>"
                                       readonly  type="text" class="form-control" id="name" name="Name" placeholder="Your fullname">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input value="<?php echo !empty($this->data['user']->LoginId)?$this->data['user']->LoginId:''; ?>"
                                       type="text" class="form-control" id="LoginId" readonly
                                       name="LoginId" placeholder="Enter you desired username">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" required id="password"
                                       name="Password" placeholder="Enter your password">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input value="<?php echo !empty($this->data['user']->EmailId)?$this->data['user']->EmailId:''; ?>"
                                       readonly type="email" class="form-control" id="email" name="EmailId"
                                       required placeholder="Enter a valid Email Address">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xs-12">

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input value="<?php echo !empty($this->data['user']->MobileNo)?$this->data['user']->MobileNo:''; ?>"
                                       readonly  type="text" class="form-control" id="number" name="MobileNo"
                                       required placeholder="Enter your phone number">
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input value="<?php echo !empty($this->data['user']->Address)?$this->data['user']->Address:''; ?>"
                                       readonly type="text" class="form-control" id="address" name="Address"
                                       required placeholder="Enter your address">
                            </div>
                        </div>
                    </div>

                </div><!-- /.box-body -->


                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <button name="resetPassword" style="color: #ffffff" class="pull-right btn btn-default btn-success">Update <i class="fa fa-save"></i></button>
                </div>

            </form>
        </div><!-- /.box -->

    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-8">

        <!-- GROUP LIST -->
        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Transactions</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php if(count($this->data['user']->GetTransactions()) < 1){?>
                    <p class="text-danger">No record found</p>
                <?php } else { ?>

                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-left">Date</th>
                            <th class="text-left">Amount</th>
                            <th class="text-left">Units</th>
                            <th class="text-left">Payment Method</th>
                            <th class="text-left">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($this->data['transactions'] as $tran){?>
                            <tr>
                                <td><?php echo $tran->Date;?></td>
                                <td><?php echo $tran->Amount;?></td>
                                <td><?php echo $tran->Unit;?></td>
                                <td><?php echo $tran->PaymentMethod;?></td>
                                <td><?php echo $tran->Status;?></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>

                <?php } ?>
            </div>

        </div><!-- /.box -->

    </div><!-- /.col -->

    <div class="col-md-4">

        <div class="box box-danger">
            <div class="box-header">
                <h3>Unit Balance</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm btn-danger" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div><!-- /. tools -->
            </div>
            <div class="box-body">
                <p><?php echo $this->data['user']->Balance; ?></p>
            </div>
        </div>

        <div class="box box-primary">
            <form action="<?php echo OpenSms::getActionUrl('add', 'transactions')?>" method="post">
                <div class="box-header">
                    <i class="fa fa-plus-square"></i>
                    <h3 class="box-title">New Transaction</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-sm btn-danger" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div><!-- /. tools -->
                </div>

                <div class="box-body">
                    <input type="hidden" name="returnUrl"
                           value="<?php echo OpenSms::getActionUrl('Manage', 'User', 'Admin', [0 => $this->data['curUser']->LoginId])?>">
                    <input type="hidden" name="LoginId" value="<?php echo $this->data['user']->LoginId; ?>">

                    <div class="form-group">
                        <label for="TranAmount">Amount</label>
                        <input type="text" class="form-control" id="TranAmount" name="Amount" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="TranAmount">Unit</label>
                        <input type="number" class="form-control" id="TranAmount" name="Unit" placeholder="Unit">
                    </div>
                    <div class="form-group">
                        <label for="TransType">Payment Method</label>
                        <?php OpenSms_Helper_Html::SelectFor('PaymentMethod',
                            $this->data['payments'], null, 'key', 'label',
                            ['class'=>'form-control']); ?>
                    </div>
                </div>

                <div class="box-footer clearfix">
                    <button style="color: #ffffff" name="AddTransaction" class="pull-right btn btn-default btn-success">Add Transaction <i class="fa fa-plus-square"></i></button>
                </div>

            </form>
        </div>


    </div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->