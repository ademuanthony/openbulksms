<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 3/20/2015
 * Time: 2:03 AM
 */
?>

<!-- Logo -->
<a href="/admin/install" class="logo"><b>Open</b>SMS</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
</a>
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo OpenSms::getSystemSetting(OpenSms::SITE_URL) .
            ( empty($this->data['user']->Image)?'app/skin/system/user.jpg': $this->data['user']->Image);?>" class="user-image" alt="User Image"/>
        <span class="hidden-xs"><?php echo $this->data['user']->Name; ?></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
            <img src="<?php echo OpenSms::getSystemSetting(OpenSms::SITE_URL) .
                ( empty($this->data['user']->Image)?'app/skin/system/user.jpg': $this->data['user']->Image);?>"
                 class="img-circle" alt="User Image" />
            <p>
                <?php echo $this->data['user']->Name; ?>
                <small>Member since <?php echo $this->data['user']->DateRegistered; ?></small>
            </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="<?php echo OpenSms::getActionUrl('Index', 'Account', 'Account') ?>" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <a href="<?php echo OpenSms::getActionUrl('Logout', 'Account', 'Account')?>" class="btn btn-default btn-flat">Sign out</a>
            </div>
        </li>
    </ul>
</li>

</ul>
</div>
</nav>
