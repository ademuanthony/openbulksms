<div class="modal fade" id="priceListWindow" tabindex="-1" role="dialog" aria-labelledby="PriceListWindow" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Price List</h4>
              </div>
              <div class="modal-body">    
                  <p>Here is our unbeatable price list</p>    
                  <p>It's just <b>1.5 naira</b> per SMS unit and <em>1.5 unit</em> per SMS to all Network</p>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>

<div class="modal fade" id="buyWindow" tabindex="-1" role="dialog" aria-labelledby="buyWindow" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Price List</h4>
              </div>
              <div class="modal-body">    
                  <p>To buy SMS Units, make yor payment into the following account</p>   
                  <table class="table table-hover">
                        <tr class="success">
                            <td>Bank: </td>
                            <td><b>ECOBANK</b> </td>
                        </tr>
                        <tr class="warning">
                            <td>ACCOUNT NAME: </td>
                            <td><b>ITODO ABRAHAM AGADA</b> </td>
                        </tr>
                        <tr class="danger">
                            <td>ACCOUNT NUMBER: </td>
                            <td><b>2621154011</b> </td>
                        </tr>
                  </table> 

                  <hr/>
                  <p>Or</p>
                  <hr/>
                  <table class="table table-hover">
                        <tr class="success">
                            <td>Bank: </td>
                            <td><b>ACCESS BANK</b> </td>
                        </tr>
                        <tr class="warning">
                            <td>ACCOUNT NAME: </td>
                            <td><b>ITODO ABRAHAM AGADA</b> </td>
                        </tr>
                        <tr class="danger">
                            <td>ACCOUNT NUMBER: </td>
                            <td><b>0058949140</b> </td>
                        </tr>
                  </table>
                  <p>After your payment, send the following details to <b>07031586141</b></p>  
                  <ul>
                    <li>Amount Deposited,</li>
                      <li>Depositor's Name,</li>
                      <li>Teller number and</li>
                      <li><b>Your username</b></li>
                  </ul>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>

<div class="modal fade" id="loadUnit" tabindex="-1" role="dialog" aria-labelledby="loadUnit" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="<?php echo URL; ?>dashboard/loadCard">                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Load SMS Unit</h4>
                  </div>
                  <div class="modal-body">    
                      <p>Please enter the pin and the serial number of your card. Your account will be credited instantly</p>   
                 
                      <div class="form-group">
                        <label for="serialNumber">Serial Number</label>
                        <input type="text" class="form-control" id="serialNumber " required 
                          name="serialNumber" placeholder="Enter the serial number">
                      </div>
                       <div class="form-group">
                        <label for="pin">PIN</label>
                        <input type="password" class="form-control" required id="pin" name="pin" placeholder="Enter your PIN">
                      </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>
                    <button  class="btn btn-primary" type="submit" name="loadCard">Load</button>
                  </div>

                </form>
            </div>
          </div>
        </div>

<div class="modal fade" id="groupHelp" tabindex="-1" role="dialog" aria-labelledby="groupHelp" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <form method="post">                
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Creating Group</h4>
                  </div>
                  <div class="modal-body">    
                       <p>Follow the steps as bellow; <br />
                          Make sure your phones numbers are save in excel and backdated to MS excel  office 97-2003. 
                           Each number must be in its own line. </p>
                        <ol>
                          <li>Create a Group by clicking on  Groups  then add group</li>
                          <li>Add the group name and description  e.g Group name:WAEC, Description: EXAMS then add</li>
                          <li>Once the group is created go to <strong>VIEW DETAIL</strong> under the group you have  created and click</li>
                          <li>You have option to either <strong>DELETE GROUP</strong> or <strong>ADD NUMBERS</strong> click on add numbers</li>
                          <li>You can <strong>add numbers</strong> or <strong>upload file</strong>.  
                              If  you have your numbers in MS excel 97-2003  click <strong>upload files</strong>, 
                              then <strong>browse</strong> it and click on <strong>add numbers</strong></li>
                          <li>Once you have done that you can then  to back to compose SMS at the top left corner</li>
                          <li>There are three options, if you want  to send a single SMS to few persons enter numbers or</li>
                          <li>Select the second option to view  your group and click on the group you want to send bulksms to. </li>
                          <li> Type in the Sender's IDs (Maximum is 11  Characters), and the message maximum characters for each page is 160 words <br />
                          </li>
                        </ol>
                        <p>Review the price list<br />
                          To buy SMS Units, make yor payment  into the following account</p>
                        


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" type="reset" data-dismiss="modal">Close</button>
                  </div>

                </form>
            </div>
          </div>
        </div>