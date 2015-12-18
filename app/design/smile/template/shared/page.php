<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 7/10/2015
 * Time: 8:51 PM
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title>Global Smile Dental Clinic - <?php echo $this->data['pageTitle'] ?></title>
    <!--REQUIRED STYLE SHEETS-->
    <?php $this->renderStyle();?>
    <?php $this->renderSpecialView(OpenSms::VIEW_POSITION_TOP);?>

    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="https://maps.googleapis.com/maps/api/js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->renderSpecialView(OpenSms::VIEW_POSITION_BODY);?>

<!-- MAIN CONTAINER -->
<div class="container-fluid">
    <!-- NAVBAR SECTION -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo OpenSms::getActionUrl('index', 'Home', 'Home') ?>" >
                    Global Smile <i class="fa fa-plus"></i></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li ><a data-toggle="modal" data-target="#mAbout" href="#mHome"> ABOUT</a></li>
                    <li><a data-toggle="modal" data-target="#mService" href="#mService">SERVICES</a></li>
                    <li><a data-toggle="modal" data-target="#mContact" href="#myModal">CONTACT</a></li>
                    <li><a data-toggle="modal" data-target="#mContact" href="#myModal">HEALTH TALK</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END NAVBAR SECTION -->

    <div class="container">
        <?php $this->renderTemplate('content');?>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        </div>
    </div>

</div>
<!-- MAIN CONTAINER END -->
<div class="modal fade" id="mAbout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel1"> <i class="fa fa-plus"></i> ABOUT US </h4>
            </div>
            <div class="modal-body">
                <div class="mian-popup-body" >
                    <h1> <span class="fa fa-flask "></span> WHO WE ARE ?</h1>
                    <div class="row">
                        <p>
                            We are nigerian based Oral Health Care service providers.
                            Registered with the cooperate affairs commission and licensed by the Health and Human  Services Secretariat
                            of the Federal Capital territory Administration.

                        </p>
                        <p>
                            We are moved with the passion to deliver world class oral health care services
                        </p>

                        <p>This is purely a setup that is not bais by any professional rivalry but binded with a team spirit.<br/>
                        It is a setup that will not go on incessant strike but makes itself available to serve his teaming patients
                            24/7 with her team of
                            highly trained and dedicated professionals in every aspect of dentistry.
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary back-btn" data-dismiss="modal">CLOSE ME</button>
            </div>
        </div>
    </div>
</div>
<!--/. ABOUT MODAL POPUP DIV-->
<div class="modal fade" id="mService" tabindex="-1" role="dialog" aria-labelledby="mService1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="mService1"> <i class="fa fa-plus"></i> OUR SERVICES </h4>
            </div>
            <div class="modal-body">
                <div class="mian-popup-body">
                    <h1> <span class="fa fa-thumbs-o-up "></span> WHAT WE OFFER ?</h1>

                    <ul>
                        <li>General Dental Practice</li>
                        <li>Community Visit</li>
                        <li>Surgical Procedure</li>
                        <li>Tooth Conservation</li>
                        <li>Ultrasonic Tooth cleaning & polishing</li>
                        <li>Restorative appliances</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary back-btn" data-dismiss="modal">CLOSE ME</button>
            </div>
        </div>
    </div>
</div>
<!--/. SERVICES MODAL POPUP DIV-->
<div class="modal fade" id="mContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"> <i class="fa fa-plus"></i> CONTACT US</h4>
            </div>
            <div class="modal-body">
                <div class="mian-popup-body">
                    <h1> <span class="fa fa-book "></span> REACH US</h1>
                    <div class="row">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Pellentesque volutpat, diam in accumsan scelerisque.

                        </p>
                        <h3> <span class="fa fa-cog fa-spin "></span> Our Location</h3>
                        <p>
                            123 UA, Newyork Street, 2078. <br />
                            Call: +42-78-0090-00.

                        </p>
                        <br/><br/>
                        <div >
                            <div id="map-canvas"></div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2999841.293321206!2d-75.80920404999999!3d42.75594204999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew+York!5e0!3m2!1sen!2s!4v1395313088825" class="mymap" ></iframe>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary back-btn" data-dismiss="modal">CLOSE ME</button>
            </div>
        </div>
    </div>
</div>
<!--/. CONTACT MODAL POPUP DIV-->

<?php $this->renderScript('footer');?>
<?php $this->renderSpecialView(OpenSms::VIEW_POSITION_FOOTER);?>

</body>
</html>
