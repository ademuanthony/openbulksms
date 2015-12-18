<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/1/2015
 * Time: 7:48 AM
 */
?>

<header id="header">
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-4">
                    <div class="top-number"><p><i class="fa fa-phone-square"></i>  +234 803 313 9486</p></div>
                </div>
                <div class="col-sm-6 col-xs-8">
                    <div class="social">
                        <ul class="social-share">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--/.container-->
    </div><!--/.top-bar-->

    <nav class="navbar navbar-inverse" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo OpenSms::getActionUrl('index', 'home', 'home') ?>">
                    CLAP Nigeria
                    <!--
                    <img src="<?php //echo $this->getImage('logo-mini');?>" alt="logo">
                    -->
                </a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="<?php echo OpenSms::isCurrentModule('home') ? ' active':'';?>"><a href="<?php echo OpenSms::getActionUrl('index', 'home', 'home') ?>">Home</a></li>
                    <li class="<?php echo OpenSms::isCurrentModule('donate') ? ' active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', '*', 'donate')?>">Donate</a></li>
                    <li class="<?php echo OpenSms::isCurrentModule('about') ? ' active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', '*', 'about')?>">About Us</a></li>
                    <li class="<?php echo OpenSms::isCurrentModule('contact') ? ' active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', '*', 'contact') ?>">Contact</a>
                    </li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->

</header><!--/header-->