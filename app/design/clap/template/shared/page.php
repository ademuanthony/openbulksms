<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/1/2015
 * Time: 7:56 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $this->data['pageTitle'] ?></title>

    <!-- core CSS -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/css/main.css" rel="stylesheet">
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/html5shiv.js"></script>
    <script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/ico/apple-touch-icon-57-precomposed.png">


    <?php $this->renderSpecialView(OpenSms::VIEW_POSITION_TOP);?>
</head><!--/head-->

<body class="homepage">

<?php $this->renderSpecialView(OpenSms::VIEW_POSITION_BODY);?>
<?php $this->renderTemplate('header');?>


<?php $this->renderTemplate('globalNotification', false);?>
<?php $this->renderTemplate('content');?>



<?php $this->renderTemplate('bottom');?>

<?php $this->renderTemplate('footer');?>





<script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/jquery.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/bootstrap.min.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/jquery.isotope.min.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/main.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/js/wow.min.js"></script>

<?php $this->renderSpecialView(OpenSms::VIEW_POSITION_FOOTER);?>

</body>
</html>