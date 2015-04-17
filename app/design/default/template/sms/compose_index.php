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
        <small>Compose</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-envelope"></i> Compose</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3>Compose Message <small>(SMS Balance = <?php echo $this->data['user']->Balance;?>)</small></h3>
            </div>

            <div class="box-body">
                <form role="form" enctype="multipart/form-data" id="compose_message" method="post"
                      action="<?php echo OpenSms::getActionUrl('send')?>">
                    <fieldset class="fancy">

                        <div class="form-group">
                            <label for="sender">Sender</label>
                            <input type="text" class="form-control" name="sender" id="sender" value="" maxlength="11">
                        </div>


                        <label for="recipient">Recepients:</label>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#enterNumbers" role="tab" data-toggle="tab">Enter Numbers</a></li>
                            <li><a href="#selectGroup" role="tab" data-toggle="tab">Select Group</a></li>
                            <li><a href="#uploadNumbers" role="tab" data-toggle="tab">Upload File</a></li>
                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="enterNumbers">
                                <div class="form-group">
                                    <textarea placeholder="Enter one number per line"
                                              class="form-control" name="recipient" id="recipient" style="width:100%" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="tab-pane" id="selectGroup">
                                <div class="form-group">
                                    <p class="help-block">To send to more than one group, hold than the Control Key on your keyboard and click on the group</p>
                                    <?php OpenSms_Helper_Html::SelectFor('groupid',
                                        $this->data['groups'], null, 'Id', 'Name',
                                        ['multiple' => 'multiple', 'class'=>'form-control', 'id' => 'groups', 'size' => '3']); ?>
                                </div>
                            </div>
                            <div class="tab-pane" id="uploadNumbers">
                                <div class="form-group">
                                    <input class="form-control" type="file" id="to_file" name="to_file">
                                    <p class="help-block">Upload a text file with one number per line or an excel 97 to 2003 (xls) file</p>
                                </div>
                            </div>
                        </div>

                        <hr/>

                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" name="message" id="message" style="width:100%" rows="5"></textarea>
                            <p id="messageCount"></p>
                            <script>
                                $("#message").keyup(function () {
                                    var count = $(this).val().length;
                                    var lenPerSMS = count < 160? 160:153;
                                    var remender = count % lenPerSMS;
                                    var messageCount = (count - remender) / lenPerSMS + 1;

                                    $("#messageCount").text('Page: ' + messageCount + ', Characters Left: ' +
                                    (lenPerSMS - remender) + ', Total Characters: ' + count);
                                });
                            </script>
                        </div>

                        <fieldset class="fancy">
                            <legend>Message Options</legend>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="send_later" id="send_later" value="1">
                                    Send Later
                                </label>
                            </div>

                            <div id="datetime" class="form-group">
                                <label for="date">On:</label>
                                <?php

                                $date = new DateTime();
                                $datestring = date_format($date, 'Y/m/d H:i:s');

                                $dateSplitted = explode(' ', $datestring);
                                $datePart = $dateSplitted[0];
                                $timePart = $dateSplitted[1];

                                $datePartSplitted = explode('/', $datePart);
                                $year = $datePartSplitted[0];
                                $month = $datePartSplitted[1];
                                $day = $datePartSplitted[2];

                                $timePartSplitted = explode(':', $timePart);
                                $hour = $timePartSplitted[0];
                                $munite = $timePartSplitted[1];
                                $ssecone = $timePartSplitted[2];




                                ?>
                                <table>
                                    <tr>
                                        <td>
                                            <select class="form-control" name="schedule_year" id="schedule_year">

                                                <?php
                                                for($i = 2013; $i<=2050; $i++)
                                                {
                                                    if($i == $year)
                                                        echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                                    else
                                                        echo '<option value="'.$i.'">'.$i.'</option>';

                                                }
                                                ?>

                                            </select>
                                        </td><td>-</td><td>
                                            <select class="form-control" name="schedule_month" id="schedule_month">
                                                <?php
                                                $mw = array();
                                                $mw[1] = 'January';
                                                $mw[2] = 'February';
                                                $mw[3] = 'March';
                                                $mw[4] = 'April';
                                                $mw[5] = 'May';
                                                $mw[6] = 'June';
                                                $mw[7] = 'July';
                                                $mw[8] = 'August';
                                                $mw[9] = 'September';
                                                $mw[10] = 'October';
                                                $mw[11] = 'November';
                                                $mw[12] = 'December';

                                                for($i = 1; $i <= 12; $i++){
                                                    if($i == ceil($month))
                                                        echo '<option value="'.$i.'" selected="selected">'.$mw[$i].'</option>';
                                                    else
                                                        echo '<option value="'.$i.'">'.$mw[$i].'</option>';
                                                }
                                                ?>

                                            </select></td><td>-</td>
                                        <td>
                                            <select class="form-control" name="schedule_day" id="schedule_day">
                                                <?php
                                                for($i = 1; $i <= 31; $i++){
                                                    if($i == ceil($day))
                                                        echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                                    else
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                ?>

                                            </select></td>
                                        <td>
                                            <select class="form-control" name="schedule_hour" id="schedule_hour">

                                                <?php
                                                for($i = 0; $i <= 23; $i++){
                                                    if($i == ceil($hour))
                                                        echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                                    else
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                ?>
                                            </select></td><td>:</td>
                                        <td>
                                            <select class="form-control" name="schedule_munite" id="schedule_minute">

                                                <?php
                                                for($i = 0; $i <= 59; $i++){
                                                    if($i == ceil($munite))
                                                        echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
                                                    else
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                                ?>


                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </fieldset>
                        <br/>
                        <button class="btn btn-primary" name="sendmessage" type="submit" value="Send">Send Message</button>
                        <button class="btn btn-default" name="reset" type="reset" value="Reset">Reset</button>
                    </fieldset>
                </form>
            </div>
        </div>


    </div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->