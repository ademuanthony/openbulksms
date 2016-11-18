<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 3/20/2015
 * Time: 2:03 AM
 */
?>

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo OpenSms::getSystemSetting(OpenSms::SITE_URL) .( empty($this->data['user']->Image)?'app/skin/system/user.jpg': $this->data['user']->Image);?>"
                class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p><?php echo $this->data['user']->Name ?></p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <li class="<?php echo $this->isCurrentUri('index', 'dashboard', 'dashboard')? 'active':'' ;?>">
            <a href="<?php echo OpenSms::getActionUrl('index', 'dashboard', 'dashboard')?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <?php echo $this->isCurrentUri('index', 'dashboard', 'dashboard')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

            </a>
        </li>


        <?php if($this->isUserInRole(OpenSms::OPEN_ROLE_ADMIN)) {?>

            <li class="treeview<?php echo OpenSms::isCurrentModule('admin') || OpenSms::isCurrentModule('cms') ? ' active':'';?>">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--
                    <li class="<?php echo $this->isCurrentUri('index', 'dashboard', 'admin') ? 'active':'' ;?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'dashboard', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Control Panel</span>
                            <?php echo $this->isCurrentUri('index', 'dashboard', 'admin') ?
                                '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>
                        </a>
                    </li>
                    -->

                    <li class="<?php echo $this->isCurrentUri('index', 'users', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'users', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Users</span>
                            <?php echo $this->isCurrentUri('index', 'users', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('index', 'voucher', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'voucher', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Voucher</span>
                            <?php echo $this->isCurrentUri('index', 'voucher', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('index', 'transactions', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'transactions', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Transactions</span>
                            <?php echo $this->isCurrentUri('index', 'transactions', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('index', 'settings', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'settings', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Settings</span>
                            <?php echo $this->isCurrentUri('index', 'settings', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>


                    <li class="label">CMS</li>

                    <li class="<?php echo $this->isCurrentUri('index', 'cms', 'cms')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'cms', 'cms')?>">
                            <i class="fa fa-circle-o"></i> <span>Content</span>
                            <?php echo $this->isCurrentUri('index', 'cms', 'cms')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('addContent', 'cms', 'cms')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('addContent', 'cms', 'cms')?>">
                            <i class="fa fa-circle-o"></i> <span>Add Content</span>
                            <?php echo $this->isCurrentUri('addContent', 'cms', 'cms')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('index', 'pages', 'cms')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'pages', 'cms')?>">
                            <i class="fa fa-circle-o"></i> <span>Pages</span>
                            <?php echo $this->isCurrentUri('index', 'pages', 'cms')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('add', 'pages', 'cms')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('add', 'pages', 'cms')?>">
                            <i class="fa fa-circle-o"></i> <span>New Page</span>
                            <?php echo $this->isCurrentUri('add', 'pages', 'cms')?
                                '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>
                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('images', 'cms', 'cms')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('images', 'cms', 'cms')?>">
                            <i class="fa fa-circle-o"></i> <span>Images</span>
                            <?php echo $this->isCurrentUri('images', 'cms', 'cms')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('index', 'modules', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'modules', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Modules</span>
                            <?php echo $this->isCurrentUri('index', 'modules', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>

                    <li class="<?php echo $this->isCurrentUri('index', 'themes', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'themes', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>Theme</span>
                            <?php echo $this->isCurrentUri('index', 'themes', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>
                    <!--
                    <li class="<?php echo $this->isCurrentUri('index', 'cms', 'admin')? 'active':'';?>">
                        <a href="<?php echo OpenSms::getActionUrl('index', 'cms', 'admin')?>">
                            <i class="fa fa-circle-o"></i> <span>CMS</span>
                            <?php echo $this->isCurrentUri('index', 'cms', 'admin')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                        </a>
                    </li>
                    -->
                </ul>
            </li>

        <?php } ?>

        <li class="treeview<?php echo OpenSms::isCurrentModule('sms') ? ' active':'';?>">
            <a href="#">
                <i class="fa fa-envelope"></i> <span>SMS</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class="<?php echo $this->isCurrentUri('index', 'compose', 'sms')? 'active':'';?>">
                    <a href="<?php echo OpenSms::getActionUrl('index', 'compose', 'sms')?>">
                        <i class="fa fa-circle-o"></i> <span>Compose</span>
                        <?php echo $this->isCurrentUri('index', 'compose', 'sms')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                    </a>
                </li>

                <li class="<?php echo $this->isCurrentUri('index', 'sent', 'sms')? 'active':'';?>">
                    <a href="<?php echo OpenSms::getActionUrl('index', 'sent', 'sms')?>">
                        <i class="fa fa-circle-o"></i> <span>Sent</span>
                        <?php echo $this->isCurrentUri('index', 'sent', 'sms')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                    </a>
                </li>
            </ul>
        </li>


        <li class="<?php echo OpenSms::isCurrentModule('group')? 'active':'';?>">
            <a href="<?php echo OpenSms::getActionUrl('index', 'group', 'group')?>">
                <i class="fa fa-users"></i> <span>Group</span>
                <?php echo $this->isCurrentUri('index', 'group', 'group')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

            </a>
        </li>

        <li class="treeview<?php echo OpenSms::isCurrentModule('account') ? ' active':'';?>">
            <a href="#">
                <i class="fa fa-user-md"></i> <span>Account</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                <li class="<?php echo $this->isCurrentUri('index', 'account', 'account')? 'active':'';?>">
                    <a href="<?php echo OpenSms::getActionUrl('index', 'account', 'account')?>">
                        <i class="fa fa-circle-o"></i> <span>Profile</span>
                        <?php echo $this->isCurrentUri('index', 'account', 'account')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                    </a>
                </li>

                <li class="<?php echo $this->isCurrentUri('index', 'recharge', 'account')? 'active':'';?>">
                    <a href="<?php echo OpenSms::getActionUrl('index', 'recharge', 'account')?>">
                        <i class="fa fa-circle-o"></i> <span>Buy Units</span>
                        <?php echo $this->isCurrentUri('index', 'recharge', 'account')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                    </a>
                </li>

                <li class="<?php echo $this->isCurrentUri('index', 'transactions', 'account')? 'active':'';?>">
                    <a href="<?php echo OpenSms::getActionUrl('index', 'transactions', 'account')?>">
                        <i class="fa fa-circle-o"></i> <span>Transactions</span>
                        <?php echo $this->isCurrentUri('index', 'transactions', 'account')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

                    </a>
                </li>
            </ul>
        </li>

        <!--
        <li class="<?php echo OpenSms::isCurrentModule('settings') ? 'active':'';?>">
            <a href="<?php echo OpenSms::getActionUrl('index', 'settings', 'settings')?>">
                <i class="fa fa-cogs"></i> <span>Settings</span>
                <?php echo $this->isCurrentUri('index', 'settings', 'settings')? '<i class="fa fa-arrow-right pull-right"></i>':'' ;?>

            </a>
        </li>
        -->

    </ul>
</section>
<!-- /.sidebar -->