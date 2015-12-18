<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/3/2015
 * Time: 9:22 AM
 */
?>


<section id="about-us">
<div class="container">
<div class="center wow fadeInDown">
    <h2>About CLAP</h2>
    <p class="lead">Ojo ki afo ene dabu we ko mi ma? Ojo ki afo ene dabu we ko mi ma? Ojo ki afo ene dabu we ko mi ma?
        <br> Ojo ki afo ene dabu we ko mi ma?</p>
</div>

<!-- about us slider -->
<div id="about-slider">
    <div id="carousel-slider" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators visible-xs">
            <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-slider" data-slide-to="1"></li>
            <li data-target="#carousel-slider" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
            <div class="item active">
                <img src="<?php echo $this->getImage('slider_one') ?>" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?php echo $this->getImage('slider_one') ?>" class="img-responsive" alt="">
            </div>
            <div class="item">
                <img src="<?php echo $this->getImage('slider_one') ?>" class="img-responsive" alt="">
            </div>
        </div>

        <a class="left carousel-control hidden-xs" href="#carousel-slider" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>

        <a class=" right carousel-control hidden-xs"href="#carousel-slider" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div> <!--/#carousel-slider-->
</div><!--/#about-slider-->



<!-- our-team -->
<div class="team">
    <div class="center wow fadeInDown">
        <h2>Who is Who is CLAP</h2>
        <p class="lead">CLAP as an organisation is blessed with highly talented and enthusiastic individuals. <br>
            The leadership of CLAP is built on willingness to serve</p>
    </div>


    <div class="row">

        <div class="col-sm-6 col-md-4">
            <div class="media services-wrap wow fadeInDown">
                <div class="pull-left">
                    <img class="img-responsive" src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/services/services1.png">
                </div>
                <div class="media-body">
                    <h3 class="media-heading">Founder</h3>
                    <p>Mr Somebody, Someboy</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="media services-wrap wow fadeInDown">
                <div class="pull-left">
                    <img class="img-responsive" src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/services/services2.png">
                </div>
                <div class="media-body">
                    <h3 class="media-heading">President</h3>
                    <p>Mr Albert Enemali </p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="media services-wrap wow fadeInDown">
                <div class="pull-left">
                    <img class="img-responsive" src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/services/services3.png">
                </div>
                <div class="media-body">
                    <h3 class="media-heading">Secretary</h3>
                    <p>Dr Akotakada Lile. The Kai kai of one place</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="media services-wrap wow fadeInDown">
                <div class="pull-left">
                    <img class="img-responsive" src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/services/services4.png">
                </div>
                <div class="media-body">
                    <h3 class="media-heading">Anoter Leader</h3>
                    <p>Another Name</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="media services-wrap wow fadeInDown">
                <div class="pull-left">
                    <img class="img-responsive" src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/services/services5.png">
                </div>
                <div class="media-body">
                    <h3 class="media-heading">Another Leader</h3>
                    <p>Another Name</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="media services-wrap wow fadeInDown">
                <div class="pull-left">
                    <img class="img-responsive" src="<?php echo OpenSms::getBaseUrl()?>app/design/clap/assets/images/services/services6.png">
                </div>
                <div class="media-body">
                    <h3 class="media-heading">Another Leader</h3>
                    <p>His Name</p>
                </div>
            </div>
        </div>
    </div><!--/.row-->
</div><!--section-->
</div><!--/.container-->
</section><!--/about-us-->