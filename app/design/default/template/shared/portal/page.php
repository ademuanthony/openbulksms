<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 3/20/2015
 * Time: 2:02 AM
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php $this->printData('pageTitle');?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php $this->renderStyle();?>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/admin/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/admin/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <?php $this->renderScript('head');?>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue">
<div class="wrapper">

<header class="main-header">
    <?php $this->renderTemplate('header');?>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <?php $this->renderTemplate('sidebar');?>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php $this->renderTemplate('globalNotification');?>
    <?php $this->renderTemplate('content');?>
</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <?php $this->renderTemplate('footer');?>
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>

<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Morris.js charts -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/morris/morris.min.js" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/knob/jquery.knob.js" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/admin/dist/js/app.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes)
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script>
-->
<!-- AdminLTE for demo purposes
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/admin/dist/js/demo.js" type="text/javascript"></script>
-->

<?php $this->renderScript('footer');?>


</body>
</html>