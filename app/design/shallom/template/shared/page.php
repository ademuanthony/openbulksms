<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8" />

    <title><?php $this->printData('pageTitle');?></title>


    <?php $this->renderStyle('head');?>
    <?php $this->renderScript('head');?>

</head>
<body>

<?php $this->renderTemplate('banner');?>

<div class="container">
    <?php $this->renderTemplate('content');?>

    <?php $this->renderTemplate('footer');?>
</div>
<!-- Modal -->

<?php
$this->renderTemplate('priceList');
$this->renderTemplate('registrationform');
$this->renderTemplate('signinform');
?>

<?php $this->renderScript('footer');?>
</body>
</html>
