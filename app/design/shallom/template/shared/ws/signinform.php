<div class="modal fade" id="loginWindow" tabindex="-1" role="dialog" aria-labelledby="LoginWindow" aria-hidden="true">
            <form action="<?php echo OpenSms::getActionUrl('login', 'account', 'account'); ?>" method="post"  role="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Account Login</h4>
              </div>
              <div class="modal-body">                
                  <div class="form-group">
                    <label for="loginId">Username</label>
                    <input type="text" class="form-control" id="loginId" required 
                      name="loginId" placeholder="Enter your username">
                  </div>
                   <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" required id="password" name="password" placeholder="Enter your password">
                  </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit" name="login">Login</button>
              </div>
            </div>
          </div>
             </form>
        </div>