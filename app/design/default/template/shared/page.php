<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/19/2015
 * Time: 6:45 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title><?php $this->printData('pageTitle');?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/frontend/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/frontend/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/frontend/css/main.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <?php $this->renderSpecialView(OpenSms::VIEW_POSITION_TOP);?>
</head>

<body>
<?php $this->renderSpecialView(OpenSms::VIEW_POSITION_BODY);?>
<?php $this->renderTemplate('header');?>


<?php $this->renderTemplate('content');?>



<?php $this->renderTemplate('footer');?>


<!-- MODAL FOR CONTACT -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">contact us</h4>
            </div>
            <div class="modal-body">
                <div class="row centered">
                    <p>We are available 24/7, so don't hesitate to contact us.</p>
                    <p>
                        Abuja, Nigeria.<br/>
                        +234 803-514-6243<br/>
                        support@openbulksms.com
                    </p>
                    <div id="mapwrap">
                        <iframe height="300" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://www.google.es/maps?t=m&amp;ie=UTF8&amp;ll=52.752693,22.791016&amp;spn=67.34552,156.972656&amp;z=2&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ok! Got It</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- MODAL FOR PRICE -->
<!-- Modal -->
<div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Price List</h4>
            </div>
            <div class="modal-body">
                <div class="row centered">
                    <p>Its just 1.5 Naira per unit</p>
                    <p>
                        No hidden charges<br/>
                        1 SMS = 1 Unit<br/>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Ok! Got It</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- MODAL FOR LOGIN -->
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">

    <form role="form" action="<?php echo OpenSms::getActionUrl('login' , 'account', 'account')?>" method="post">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Account Login</h4>
            </div>
            <div class="modal-body">
                <div class="row centered">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="LoginId" required
                                   name="LoginId" placeholder="Enter you desired username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" required id="password"
                                   name="Password" placeholder="Enter your password">
                        </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Login</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

<!-- MODAL FOR REGISTER -->
<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog">

        <form role="form" action="<?php echo OpenSms::getActionUrl('register' , 'account', 'account')?>" method="post">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Account Registration</h4>
            </div>
            <div class="modal-body">
                <div class="row centered">

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="Name" placeholder="Your full name">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="LoginId" required
                                       name="LoginId" placeholder="Enter you desired username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" required id="password"
                                       name="Password" placeholder="Enter your password">
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="EmailId"
                                       required placeholder="Enter a valid Email Address">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control" id="number" name="MobileNo"
                                       required placeholder="Enter your phone number">
                            </div>


                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="Address"
                                       required placeholder="Enter your address">
                            </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->

        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php echo OpenSms::getBaseUrl()?>app/design/default/assets/frontend/js/bootstrap.min.js"></script>
</body>
</html>
