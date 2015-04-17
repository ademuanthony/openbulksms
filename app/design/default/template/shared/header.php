<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/21/2015
 * Time: 11:02 PM
 */
?>

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo OpenSms::getSystemSetting(OpenSms::SITE_NAME)?> </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.html">HOME</a></li>
                <li><a data-toggle="modal" data-target="#priceModal" href="#priceModal">PRICING</a></li>
                <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
            </ul>
        </div><!--/.nav-collapse  -->
    </div>
</div>