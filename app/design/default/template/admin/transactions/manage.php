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
            <form action="<?php echo OpenSms::getActionUrl('update', 'transactions')?>" method="post">
                <input type="hidden" name="Id" value="<?php echo $this->data['transaction']->Id; ?>">
                <div class="box-header">
                    <i class="fa fa-plus-square"></i>
                    <h3 class="box-title">Manage Transaction</h3>
                    <!-- tools box -->
                    <div class="pull-right box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /. tools -->
                </div>

                <div class="box-body">
                    <input type="hidden" name="returnUrl"
                           value="<?php echo OpenSms::getActionUrl('Manage', 'Transactions', 'Admin',
                               [0 => $this->data['transaction']->Id]) ?>">
                    <input type="hidden" name="LoginId" value="<?php echo $this->data['transaction']->LoginId; ?>">

                    <div class="form-group">
                        <label for="TranAmount">Amount</label>
                        <input type="text" readonly value="<?php echo $this->data['transaction']->Amount?>" class="form-control" id="TranAmount" name="Amount" placeholder="Amount">
                    </div>
                    <div class="form-group">
                        <label for="TranAmount">Unit</label>
                        <input type="text" readonly value="<?php echo $this->data['transaction']->Unit?>" class="form-control" id="TranAmount" name="Unit" placeholder="Unit">
                    </div>
                    <div class="form-group">
                        <label for="TranAmount">Type</label>
                        <input type="text" readonly value="<?php echo $this->data['transaction']->Type?>"
                               class="form-control" name="Type" placeholder="Unit">
                    </div>
                    <div class="form-group">
                        <label for="TransType">Status</label>

                        <?php OpenSms_Helper_Html::SelectFor('Status',
                            OpenSms::getTransactionStatusArray(), $this->data['transaction']->Status, null, null,
                            ['class'=>'form-control']); ?>

                    </div>
                    <div class="form-group">
                        <label for="TransType">Payment Method</label>
                        <?php OpenSms_Helper_Html::SelectFor('PaymentMethod',
                            $this->data['payments'], $this->data['transaction']->PaymentMethod, 'key', 'label',
                            ['class'=>'form-control']); ?>
                    </div>
                </div>

                <div class="box-footer clearfix">
                    <button style="color: #ffffff" name="AddTransaction" class="pull-right btn btn-default btn-success">Save Changes <i class="fa fa-save"></i></button>
                </div>

            </form>
        </div>

    </div><!-- /.col -->
</div><!-- /.row -->


</section><!-- /.content -->