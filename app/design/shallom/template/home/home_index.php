<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 3/21/2015
 * Time: 11:05 PM
 */
?>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h1 class="panel-title" style="text-align: center;">LOGIN PANNEL</h1>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="post" action="<?php echo OpenSms::getActionUrl('login', 'account', 'account') ?>">
                    <strong style="color: #b14444;">Username:</strong>
                    <input type="text" name="LoginId" class="form-control" placeholder="Enter your Username"/>
                    <strong style="color: #b14444;">password:</strong>
                    <input type="password" name="Password" class="form-control" placeholder="Enter your Password"/>
                    <button  class="btn btn-danger pull-right" type="submit" name="login" style="margin: 10px 0 10px 0;">Login</button>
                </form>
                <div>
                    <p style="margin-top: 50px;"><a href="#">Forget password?</a></p>
                    <p><a href="#">Forget Username?</a></p>
                    <p><a href="#registrationWindow" data-toggle="modal" data-target="#registrationWindow">Create an account</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <p>Connecting with your loved ones, families and business associates can't be more easier with
            <?php echo OpenSms::getSystemSetting(OpenSms::SITE_NAME);?>. With our bulk sms service you are
            sure of the cheapest, the fastest, most reliable and most affordable bulk sms service in Nigeria.
            We guarantee you immediate delivery of all your
            text messages.</p>
        <h3 style="color: #d9534f;">Our Bulk sms Service can be Used for;</h3>
        <ul>
            <li>Products Advertisement</li>
            <li>Special season’s greetings</li>
            <li>Political Awareness / Campaign</li>
            <li>Wedding Invitation</li>
            <li>Birthday party</li>
            <li>Result Notification</li>
            <li>Burial Ceremony</li>
            <li>Coronation Ceremony</li>
            <li>Meeting notification</li>
            <li>Launching</li>
            <li>Award winning ceremony</li>
            <li>Interview Notification. Etc</li>
        </ul>
    </div>
    <div class="col-md-3">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h1 class="panel-title" style="text-align: center; font-family:Tahoma, Geneva, sans-serif; font-weight: 800">DON'T HAVE AN ACCOUNT YET?</h1>
            </div>
            <div class="panel-body">
                <a href="#">
                    <img src="<?php echo OpenSms::getBaseUrl().OpenSms::DESIGN_PATH ?>shallom/assets/img/btn-home-register.png" alt="Registration">
                    <h4 style="">To get our amazingly cheap, reliable and fast bulk sms services</h4>
                </a>
            </div>
        </div>
    </div>
</div><!--content-->
