<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 3/21/2015
 * Time: 11:05 PM
 */
?>

<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="row">
                    <div class="col-lg-6">
                        <?php $this->renderContent('home_header_send_price'); ?>
                        <br/>
                        <?php $this->renderContent('home_header_1_unit_1_sms', ['class'=>'text-danger', 'style' => 'color: red !important;']); ?>
                        <br/>
                        <h2>No Hidden charges</h2>
                        <br/><br/>
                        <a class="btn btn-lg btn-danger" data-toggle="modal" data-target="#registerModal" href="#registerModal">
                            Register Now <i class="fa fa-arrow-circle-right"></i> </a> or

                        <a class="btn btn-lg btn-success" data-toggle="modal" data-target="#loginModal" href="#loginModal">
                            Login <i class="fa fa-arrow-circle-right"></i> </a>
                    </div>
                    <div class="col-lg-6">
                        <h4>Open Bulk SMS</h4>
                        <p class="text-center" style="text-align: center !important;">
                            <a data-toggle="modal" data-target="#registerModal" href="#registerModal">
                            <img class="img-responsive" align="middle"
                                 src="<?php echo OpenSms::getBaseUrl() ?>app/skin/system/open_sms_text-2.png"
                                 style="border: 1px red solid"/>
                            </a>
                        </p>

                        <h2>EXPERIENCE A BETTER SMS SERVICE</h2>
                    </div>
                </div>

            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- headerwrap -->




<div id="r">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h4>ENJOY THE CHEAPEST, FASTEST AND MOST RELIABLE BULK SMS SERVICE.</h4>
                <p>We have 100% delivery rate for all network in Nigeria. Our price is the best you can see as you will be
                send message to all network at 1.5 without any hidden charges.</p>
                <p class="text-center"><a class="btn btn-lg btn-primary" data-target="#registerModal" href="#registerModal">
                        Register Now <i class="fa fa-arrow-circle-right"></i> </a></p>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- r wrap -->

<div class="info-box">
    <div class="container">
        <div class="row">
            <?php $this->renderContent('home_index_how_to_send_bulk_sms'); ?>
        </div>
    </div>
</div>

<hr/>
<div class="info-box">
    <div class="container">
        <div class="row" id="freeSMSSite">
            <?php $this->renderContent('home_index_free_bulk_sms_site'); ?>
        </div>
    </div>
</div>