<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 15/09/2015
 * Time: 23:12
 */
?>

<h1>Dashboard</h1>

<a class="ui-btn" href="<?php echo OpenSms::getActionUrl("index", "recharge", "account") ?>">
    <i class="fa fa-money"></i>
    <span>Buy Unit</span>
</a>
<a class="ui-btn" href="<?php echo OpenSms::getActionUrl("index", "compose", "sms") ?>">
    <i class="fa fa-edit"></i>
    <span>Send SMS</span>
</a>

<!--
<a class="ui-btn" href="<?php echo OpenSms::getActionUrl("index", "sent", "sms") ?>">
    <i class="fa fa-history"></i>
    <span>SMS History</span>
</a>
-->

<a class="ui-btn" href="<?php echo OpenSms::getActionUrl("index", "group", "group") ?>">
    <i class="fa fa-users"></i>
    <span>Groups</span>
</a>