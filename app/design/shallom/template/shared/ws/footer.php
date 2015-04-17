<div class="footer">
                    <div class="row">
                        <img src="<?php echo OpenSms::getBaseUrl().OpenSms::DESIGN_PATH ?>shallom/assets/img/Footer.png" alt="Footer" class="footer-image"/>
                    </div>
                    <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-center">
                            <li><a href="<?php echo OpenSms::getActionUrl('index', 'home', 'home') ?>">HOME</a></li>
                            <li><a href="pricing" data-toggle="modal" data-target="#priceListWindow">PRICING</a></li>
                            <li><a href="#buy" data-toggle="modal" data-target="#buyWindow">BUY CREDIT</a></li>
                            <li><a href="#">ABOUT</a></li>
                            <li><a href="#">HELP</a></li>
                            <?php if(!isset($_SESSION['loginId'])){?>
                            <li><a href="#registration" data-toggle="modal" data-target="#registrationWindow">REGISTER</a></li>
                            <li><a href="#login" data-target="#loginWindow" data-toggle="modal">LOGIN</a></li>    
                             <?php }else{?>  
                            <li><a href="<?php echo OpenSms::getActionUrl('index', 'dashboard', 'dashboard'); ?>">MY ACCOUNT</a></li>
                            <li><a href="<?php echo OpenSms::getActionUrl('logout', 'account', 'account'); ?>">LOGOUT</a></li>
                            <?php }?> 
                        </ul>
                    </div>
                </div>
                </div>