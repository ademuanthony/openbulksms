<?php
/**
 * Created by PhpStorm.
 * User: Chinedu
 * Date: 17/09/2015
 * Time: 14:28
 */
?>
<h3>Compose Message <small>(SMS Balance = <?php echo $this->data['user']->Balance;?>)</small></h3>
<form role="form" enctype="multipart/form-data" id="compose_message" method="post"
      action="<?php echo OpenSms::getActionUrl('send')?>">
    <fieldset class="fancy">

        <div data-demo-html="true">
            <label for="sender">Sender</label>
            <input type="text" class="form-control" name="sender" id="sender" value="" maxlength="11">
        </div>

        <div data-demo-html="true">
            <label for="recipient">Numbers:</label>
            <textarea placeholder="Enter one number per line"
                      class="form-control" name="recipient" id="recipient" style="width:100%" rows="5"></textarea>
        </div>

        <div data-demo-html="true">
            <label for="groupid">Group:</label>
            <?php OpenSms_Helper_Html::SelectFor('groupid',
                $this->data['groups'], null, 'Id', 'Name',
                ['class'=>'form-control', 'id' => 'groups']); ?>
        </div>


        <div data-demo-html="true">
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

        <div class="ui-grid-a">
            <div class="ui-block-a">
                <button class="btn btn-primary" name="sendmessage" type="submit" value="Send">Send Message</button>
            </div>
            <div class="ui-block-b">
                <button class="btn btn-default" name="reset" type="reset" value="Reset">Reset</button>
            </div>
        </div>

    </fieldset>
</form>
