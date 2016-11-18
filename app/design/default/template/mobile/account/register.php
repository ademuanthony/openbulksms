<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 15/09/2015
 * Time: 22:18
 */
?>

<h1>Register</h1>

<form action="<?php echo OpenSms::getActionUrl('register')?>" method="post">

    <div data-demo-html="true">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="Name" placeholder="Your fullname">
    </div>

    <div data-demo-html="true">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="LoginId" required
               name="LoginId" placeholder="Enter you desired username">
    </div>

    <div data-demo-html="true">
        <label for="password">Password</label>
        <input type="password" class="form-control" required id="password"
               name="Password" placeholder="Enter your password">
    </div>

    <div data-demo-html="true">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="EmailId"
               required placeholder="Enter a valid Email Address">
    </div>

    <div data-demo-html="true">
        <label for="phone">Phone Number</label>
        <input type="text" class="form-control" id="number" name="MobileNo"
               required placeholder="Enter your phone number">
    </div>


    <div data-demo-html="true">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="Address"
               required placeholder="Enter your address">
    </div>


    <div data-demo-html="true">
        <button class="ui-shadow ui-btn ui-corner-all" type="submit">Register</button>
    </div>
</form>

<p>Have an account? <a href="<?php echo OpenSms::getActionUrl("login") ?>">Login</a> </p>
