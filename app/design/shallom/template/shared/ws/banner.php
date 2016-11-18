
<div class="header">
            <div class="row banner">
                <div class="col-md-7 col-md-offset-1">
                    <div class="banner-caption">
                        <h1>You are most Welcome to <?php echo OpenSms::getSystemSetting(OpenSms::SITE_NAME);?></h1>
                        <p>Where connecting with your freinds,families and <br/>business associates and loved ones <br/> is 'super-duper' easy!!</p>
                    </div>
                </div>  
                <div class="col-md-4">

                </div> 
            </div>
                <div class="navbar navbar-inverse" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" style="color: rgba(255, 255, 255, 2); font-family:Tahoma, Geneva, sans-serif; text-shadow: 1px 1px 1px #960, 3px 3px 5px cyan;
                           font-size: 40px; cursor: pointer;"><?php echo OpenSms::getSystemSetting(OpenSms::SITE_NAME);?></a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right list">
                            <li><a href="<?php echo URL; ?>" style="color: rgba(255, 255, 255, 2);">HOME</a></li>
                            <li><a href="#pricing" data-toggle="modal" data-target="#priceListWindow" style="color: rgba(255, 255, 255, 2);">PRICING</a></li>
                            <li><a href="#buy" data-toggle="modal" data-target="#buyWindow" style="color: rgba(255, 255, 255, 2);">BUY CREDIT</a></li>
                            <li><a href="#" style="color: rgba(255, 255, 255, 2);">ABOUT</a></li>
                            <li><a href="#" style="color: rgba(255, 255, 255, 2);">HELP</a></li>
                            
                             <?php if(!isset($_SESSION['loginId'])){?>
                            <li><a href="#registration" data-toggle="modal" data-target="#registrationWindow" style="color: rgba(255, 255, 255, 2);">REGISTER</a></li>
                            <li><a href="#login" data-target="#loginWindow" data-toggle="modal" style="color: rgba(255, 255, 255, 2);">LOGIN</a></li>    
                             <?php }else{?>  
                            <li><a href="<?php echo OpenSms::getActionUrl('index', 'dashboard', 'dashboard'); ?>" style="color: rgba(255, 255, 255, 2);">MY ACCOUNT</a></li>
                            <li><a href="<?php echo OpenSms::getActionUrl('logout', 'account', 'account'); ?>" style="color: rgba(255, 255, 255, 2);">LOGOUT</a></li>
                            <?php }?> 
                        </ul>
                    </div>
                </div>
        </div>


                <?php
                if(isset($_GET['notification']) || isset($notification)){
                    if(isset($_GET['notification'])){
                        $notification = $_GET['notification'];
                    }
                    ?>

                <script type="text/javascript">
                    $(window).load(function(){
                        $('#notification').modal('show');
                    });
                </script>

                    <?php if(isset($_GET['error_code']) && $_GET['error_code'] == 1){
                        ?>
                <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="notification" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Notification</h4>
                      </div>
                      <div class="modal-body">    
                          <p class="text-danger"> <?php echo $notification;?></p>   
                          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>

                      </div>
                    </div>
                  </div>
                </div>
            <?php
                    }else{
                        ?>

                <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="notification" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Notification</h4>
                      </div>
                      <div class="modal-body">    
                          <p class="text-success"> <?php echo $notification;?></p>   
                          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>

                      </div>
                    </div>
                  </div>
                </div>
            <?php
                    }
                }
            ?>
