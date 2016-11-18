<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 15/09/2015
 * Time: 22:18
 */
?>

<h1>Account Login</h1>

<form action="<?php echo OpenSms::getActionUrl('login')?>" method="post">
    <div data-demo-html="true">
        <label for="text-basic">User name:</label>
        <input name="LoginId" type="text" id="loginId" value="">
    </div>
    <div data-demo-html="true">
        <label for="text-basic">User name:</label>
        <input name="Password" type="password" id="password" value="">
    </div>

    <div data-html-demo="true">
        <button class="ui-shadow ui-btn ui-corner-all" type="submit">Login</button>
    </div>
</form>

<p>Don't an account? <a href="<?php echo OpenSms::getActionUrl("register") ?>">Register</a> </p>


<!-- /demo-html -->
