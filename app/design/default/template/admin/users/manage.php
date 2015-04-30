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
        Users
        <small><?php echo $this->data['curUser']->Name?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index')?>"><i class="fa fa-group"></i> User</a></li>
        <li class="active">Detail</li>
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
                                    <input value="<?php echo !empty($this->data['curUser']->Name)?$this->data['curUser']->Name:''; ?>"
                                           readonly  type="text" class="form-control" id="name" name="Name" placeholder="Your fullname">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input value="<?php echo !empty($this->data['curUser']->LoginId)?$this->data['curUser']->LoginId:''; ?>"
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
                                    <input value="<?php echo !empty($this->data['curUser']->EmailId)?$this->data['curUser']->EmailId:''; ?>"
                                          readonly type="email" class="form-control" id="email" name="EmailId"
                                           required placeholder="Enter a valid Email Address">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xs-12">

                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input value="<?php echo !empty($this->data['curUser']->MobileNo)?$this->data['curUser']->MobileNo:''; ?>"
                                           readonly  type="text" class="form-control" id="number" name="MobileNo"
                                           required placeholder="Enter your phone number">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input value="<?php echo !empty($this->data['curUser']->Address)?$this->data['curUser']->Address:''; ?>"
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
                    <?php if(count($this->data['transactions']) < 1){?>
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
                                <th></th>
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
                                    <td>
                                        <a href="<?php echo OpenSms::getActionUrl('Delete', 'Transactions', 'Admin',
                                            ['parameter1' => $tran->Id], ['returnUrl' =>
                                                urlencode(OpenSms::getActionUrl('Manage', 'Users', 'Admin', [0=>$this->data['curUser']->LoginId]))])?>"
                                           class="btn btn-warning">Delete</a>
                                    </td>
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
                    <p><?php echo $this->data['curUser']->Balance; ?></p>
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
                               value="<?php echo OpenSms::getActionUrl('Manage', 'Users', 'Admin', [0 => $this->data['curUser']->LoginId])?>">
                        <input type="hidden" name="LoginId" value="<?php echo $this->data['curUser']->LoginId; ?>">

                        <div class="form-group">
                            <label for="TranAmount">Amount</label>
                            <input type="text" class="form-control" id="TranAmount" name="Amount" placeholder="Amount">
                        </div>
                        <div class="form-group">
                            <label for="TranAmount">Unit</label>
                            <input type="number" class="form-control" id="TranAmount" name="Unit" placeholder="Unit">
                        </div>
                        <div class="form-group">
                            <label for="TransType">Type</label>
                            <select class="form-control" name="Type">
                                <option></option>
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_TYPE_CREDIT?>">Credit</option>
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_TYPE_DEBIT?>">Debit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="TransType">Status</label>
                            <select class="form-control" name="Status">
                                <option></option>
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_STATUS_PENDING?>"><?php echo OpenSms::OPEN_TRANSACTION_STATUS_PENDING?></option>
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT?>"><?php echo OpenSms::OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT?></option>
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_STATUS_PROCESSING?>"><?php echo OpenSms::OPEN_TRANSACTION_STATUS_PROCESSING?></option>
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED?>"><?php echo OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED?></option>
                            </select>
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