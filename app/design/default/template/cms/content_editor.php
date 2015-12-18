<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 6/29/2015
 * Time: 11:50 PM
 */
?>
<div id="raw_content_editor" class="modal fade">
    <div class="modal-dialog">
        <form role="form" action="<?php echo OpenSms::getActionUrl('save', '*', 'cms')?>" method="post">
            <input type="hidden" id="raw_editor_id" name="id">
            <input type="hidden" id="raw_editor_key" name="key">
            <input type="hidden" value="<?php echo OpenSms::getCurrentUrl(); ?>?action=cms" name="returnUrl">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Content Editor</h4>
            </div>
            <div class="modal-body">
                <textarea id="raw_editor_body" name="body" class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="cms-submitter" style="display: none;">
    <form role="form" action="<?php echo OpenSms::getActionUrl('save', '*', 'cms')?>?action=cms" method="post">
        <input type="hidden" id="html_editor_id" name="id">
        <input type="hidden" id="html_editor_key" name="key">
        <input type="hidden" id="html_editor_body" name="body">
        <input type="hidden" value="<?php echo OpenSms::getCurrentUrl(); ?>" name="returnUrl">
        <button id="html_editor_btn_save" class="btn-lg btn-primary" type="submit">Save Changes</button>
        <button id="html_editor_btn_cancel" class="btn-lg btn-danger" type="button">Cancel</button>
    </form>


</div>