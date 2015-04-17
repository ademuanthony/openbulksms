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
        Transactions
        <small>Manage</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index')?>">Transaction</a></li>
        <li class="active">Manage</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">


            <div class="box box-primary">
                <form action="<?php echo OpenSms::getActionUrl('add', 'transactions')?>" method="post">
                    <div class="box-header">
                        <i class="fa fa-plus-square"></i>
                        <h3 class="box-title">New Transaction</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
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
                                <option value="<?php echo OpenSms::OPEN_TRANSACTION_TYPE_DEBIT?>">Credit</option>
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
                                $this->data['payments'], '', 'key', 'label',
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