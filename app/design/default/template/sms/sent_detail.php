<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/20/2015
 * Time: 3:34 PM
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        SMS
        <small>Sent Messages</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Compose')?>">SMS</a> </li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index')?>">Sent Messages</a> </li>
        <li class="active"><i class="fa fa-envelope"></i> Sent Messages</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>SMS Report</h3>
                </div>

                <div class="box-body">


                    <fieldset class="fancy">



                        <div class="form-group">
                            <label for="sender">Sender</label>
                            <input type="text" class="form-control" name="sender" id="sender" value="<?php echo $this->data['bulkSms']->Sender?>" maxlength="11">
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" name="message" id="message"
                                      style="width:96%" rows="5"><?php echo $this->data['bulkSms']->Message?></textarea>
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="message">Recepients:</label>
                            <textarea class="form-control" name="message" id="message"
                                      style="width:96%" rows="5"><?php echo $this->data['bulkSms']->GetRecipients()?></textarea>
                        </div>

                    </fieldset>

                </div>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->