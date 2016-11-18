<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 14/09/2015
 * Time: 13:36
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $this->printData('pageTitle');?></title>
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/frontend/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/mobile/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
    <script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/mobile/jquery.min.js"></script>
    <script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/mobile/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>


<div data-role="page" class="jqm-demos" data-quicklinks="true">


    <div data-role="header" class="jqm-header">
        <h2>
            <a href="<?php echo OpenSms::getActionUrl("index", "dashboard", "dashboard")?>" title="dashboard">
                <?php echo OpenSms::getSystemSetting(OpenSms::SITE_NAME) ?>
            </a>
        </h2>
        <a href="<?php echo OpenSms::getActionUrl("index", "dashboard", "dashboard")?>" class="jqm-navmenu-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-bars ui-nodisc-icon ui-alt-icon ui-btn-left">
            Menu</a>
        <a href="<?php echo OpenSms::getActionUrl("logout", "account", "account")?>" class="jqm-search-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-search ui-nodisc-icon ui-alt-icon ui-btn-right">
            Search</a>
    </div><!-- /header -->


    <div role="main" class="ui-content jqm-content">
        <?php $this->renderTemplate('globalNotification');?>
        <?php $this->renderTemplate('content');?>
    </div><!-- /content -->


    <div data-role="footer" data-position="fixed" data-tap-toggle="false" class="jqm-footer">
        <p>Copy 2015 <span class="jqm-version"></span></p>
    </div><!-- /footer -->


</div><!-- /page -->

<?php $this->renderScript('footer');?>
</body>
</html>
