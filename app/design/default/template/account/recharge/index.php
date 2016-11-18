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
        Account
        <small>Login</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('index') ?>"><i class="fa fa-dashboard"></i> Account</a></li>
        <li class="active">Recharge</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <form action="<?php echo OpenSms::getActionUrl('save')?>" method="post">
                    <div class="box-header">
                        <i class="fa fa-plus-square"></i>
                        <h3 class="box-title">Buy Unit</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /. tools -->
                    </div>

                    <div class="box-body">
                        <input type="hidden" name="returnUrl"
                               value="<?php echo OpenSms::getActionUrl('Manage', 'Users', 'Admin', [0 => $this->data['user']->LoginId])?>">
                        <input type="hidden" name="LoginId" value="<?php echo $this->data['user']->LoginId; ?>">

                        <div class="form-group">
                            <label for="TranAmount">Amount</label>
                            <input type="text" class="form-control TranAmount" name="Amount" placeholder="Amount">
                        </div>
                        <div class="form-group">
                            <label for="TranAmount">Unit</label>
                            <input type="text" class="form-control TranUnit" name="Unit" placeholder="Unit">
                        </div>
                        <div class="form-group">
                            <label for="TransType">Payment Method</label>
                            <?php OpenSms_Helper_Html::SelectFor('PaymentMethod',
                                $this->data['payments'], '', 'key', 'label',
                                ['class'=>'form-control']); ?>
                        </div>
                    </div>

                    <div class="box-footer clearfix">
                        <button style="color: #ffffff" name="proceed" class="pull-right btn btn-default btn-success">Proceed <i class="fa fa-plus-square"></i></button>
                    </div>

                </form>

            </div><!-- /.box -->


        </div><!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Recharge Your Account</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <p>Points to note</p>
                    <ol>
                        <li>One SMS is <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS) ?> Unit</li>
                        <li>One UNIT is <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_PRICE_PER_UNIT) ?> Naira</li>
                        <li>To send 1000 SMS; <br/>
                            buy 1000 X <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS) ?>
                            = <?php echo (1000 * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS)) ?> UNITS <br/>
                            For <?php echo (1000 * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS). ' X ' .
                                OpenSms::getSystemSetting(OpenSms::OPEN_PRICE_PER_UNIT)); ?>
                            = <?php echo ((1000 * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS) *
                                OpenSms::getSystemSetting(OpenSms::OPEN_PRICE_PER_UNIT))) ?> Naira
                        </li>
                    </ol>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
    </div>

</section><!-- /.content -->

<!-- global js variable --->
<script>
    var UNITS_PER_SMS = <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS) ?>;
    var PRICE_PER_UNIT = <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_PRICE_PER_UNIT) ?>;
</script>