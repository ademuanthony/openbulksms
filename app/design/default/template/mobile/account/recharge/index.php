<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 17/09/2015
 * Time: 13:40
 */
?>
<h1>Buy Unit</h1>

<form action="<?php echo OpenSms::getActionUrl('save')?>" method="post">

    <input type="hidden" name="returnUrl"
           value="<?php echo OpenSms::getActionUrl('Manage', 'Users', 'Admin', [0 => $this->data['user']->LoginId])?>">
    <input type="hidden" name="LoginId" value="<?php echo $this->data['user']->LoginId; ?>">

    <div class="form-group">
        <label for="TranAmount">Amount</label>
        <input type="text" class="form-control TranAmount" name="Amount" placeholder="Amount">
    </div>
    <div data-demo-html="true">
        <label for="TranAmount">Unit</label>
        <input type="text" class="form-control TranUnit" name="Unit" placeholder="Unit">
    </div>
    <div data-demo-html="true">
        <label for="TransType">Payment Method</label>
        <?php OpenSms_Helper_Html::SelectFor('PaymentMethod',
            $this->data['payments'], '', 'key', 'label',
            ['class'=>'form-control']); ?>
    </div>

    <div data-demo-html="true">
        <button name="proceed" class="pull-right btn btn-default btn-success">Proceed</button>
    </div>

</form>

<hr/>
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

<script>
    var UNITS_PER_SMS = <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS) ?>;
    var PRICE_PER_UNIT = <?php echo OpenSms::getSystemSetting(OpenSms::OPEN_PRICE_PER_UNIT) ?>;
</script>