<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/1/2015
 * Time: 7:56 AM
 */
?>

<section id="main-slider" class="no-margin">
    <div class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
            <li data-target="#main-slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">

            <div class="item active" style="background-image: url(<?php echo $this->getImage('Educational-Support');?>)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content round-blue">
                                <h1 class="animation animated-item-1">Who we are</h1>
                                <h2 class="animation animated-item-2">Ata wa ki de fu ojale. Ojima ina choduwe ile onu we ki le wa ka ch....</h2>
                                <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="<?php echo OpenSms::getImage('Educational-Support')?>" class="img-responsive">
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

            <div class="item" style="background-image: url(<?php echo $this->getImage('Geographical-Coverage')?>)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content round-blue">
                                <h1 class="animation animated-item-1">Where we are</h1>
                                <h2 class="animation animated-item-2">ewu ki re uwe edo ile yi alu ku ma ch'efojale. D'ujewu ki ba wa jo inwi ni nwu wa</h2>
                                <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="<?php OpenSms::getImage('img1')?>" class="img-responsive">
                            </div>
                        </div>

                    </div>
                </div>
            </div><!--/.item-->

            <div class="item" style="background-image: url(<?php echo $this->getImage('PHC-Strengthening')?>)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content round-blue">
                                <h1 class="animation animated-item-1">What we do</h1>
                                <h2 class="animation animated-item-2">ke che wa ogafara kw'efu adure wa alu ka che nwa bo ki duwa re le...</h2>
                                <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                            </div>
                        </div>
                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="<?php echo OpenSms::getImage('img3')?>" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section><!--/#main-slider-->

<section id="feature">
    <div class="container">
        <div class="center wow fadeInDown editable">
            <h2>Our Life Touching Services</h2>
            <p class="lead">Healthy life for every one is what we want. We have put lot's of commitment into this by <br>
                creating lot's of life saving services to help achieve this</p>
        </div>

        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-bullhorn"></i>
                        <h2>Primary Healthcare provision</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-comments"></i>
                        <h2>Combating HIV/AIDS</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-cloud-download"></i>
                        <h2>Promotion of Maternal, Child and Adolescent Rights</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-leaf"></i>
                        <h2>Poverty Alleviation</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-cogs"></i>
                        <h2>Youth Leadership Development</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-heart"></i>
                        <h2>Consultancy Services</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="feature-wrap">
                        <i class="fa fa-heart"></i>
                        <h2>Community Development</h2>
                        <h3>Ojo ki'afo, ene da bu we ef'ile ki de? U we tu ma le cha ka</h3>
                    </div>
                </div><!--/.col-md-4-->
            </div><!--/.services-->
        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#feature-->

<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Touched by CLAP</h2>
            <p class="lead">CLAP have touched lives in so many ways in form of Academic support, Economic empowerment
                <br>Health eduction and seminars, ect</p>
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <img class="img-responsive" src="<?php echo $this->getImage('PHC-Strengthening')?>" alt="">
                    <div class="overlay">
                        <div class="recent-work-inner">
                            <h3><a href="#">Programme One</a> </h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority</p>
                            <a class="preview" href="<?php echo $this->getImage('PHC-Strengthening')?>" rel="prettyPhoto"><i class="fa fa-eye"></i> View</a>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div><!--/.container-->
</section><!--/#recent-works-->

<section id="services" class="service-item">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>Who is Who is CLAP</h2>
            <p class="lead">CLAP as an organisation is blessed with highly talented and enthusiastic individuals. <br>
                The leadership of CLAP is built on willingness to serve</p>
        </div>

        <div class="row">

            <div class="col-sm-6 col-md-4">
                <div class="media services-wrap wow fadeInDown">
                    <div class="pull-left">
                        <img class="img-responsive" src="<?php echo OpenSms::getImage('services1')?>">
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
                        <img class="img-responsive" src="<?php echo OpenSms::getImage('services2')?>">
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
                        <img class="img-responsive" src="<?php echo OpenSms::getImage('services3')?>">
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
                        <img class="img-responsive" src="<?php echo OpenSms::getImage('services4')?>">
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
    </div><!--/.container-->
</section><!--/#services-->

<section id="conatcat-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="pull-left">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="media-body">
                        <h2>Have a question?</h2>
                        <p>Our team is always available to attend to you. You can give a call anytime any day +2348033139486</p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.container-->
</section><!--/#conatcat-info-->