<div class="modal fade" id="registrationWindow" tabindex="-1" role="dialog" aria-labelledby="RegistrationWindow" aria-hidden="true">
            <form action="<?php echo OpenSms::getActionUrl('register', 'account', 'account'); ?>" method="post"  role="form" name="register">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Creat your new account</h4>
              </div>
              <div class="modal-body">

                  <div class="box-body">
                      <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" id="name" name="Name" placeholder="Your fullname">
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

                  </div><!-- /.box-body -->


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary" type="submit" name="register">Register</button>
              </div>
            </div>
          </div>
             </form>
        </div>
