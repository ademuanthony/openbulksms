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
        New Pages
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index', '*', 'CMS')?>"><i class="fa fa-dashboard"></i> Content</a></li>
        <li class="active">New Page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3>Compose Content</h3>
                </div>

                <div class="box-body">
                    <form role="form" method="post" action="<?php echo OpenSms::getActionUrl('save')?>">
                        <fieldset class="fancy">

                            <div class="form-group">
                                <label for="sender">Key</label>
                                <?php OpenSms_Helper_Html::TextEditorFor('key', $this->data['content']->Key,
                                    ['maxlength' => '100', 'class' => 'form-control']);?>
                            </div>

                            <div class="form-group">
                                <label for="sender">Type</label>
                                <?php OpenSms_Helper_Html::TextEditorFor('type', $this->data['content']->Type,
                                    ['maxlength' => '100', 'class' => 'form-control']);?>
                            </div>

                            <div class="form-group">
                                <label for="sender">Host</label>
                                <?php OpenSms_Helper_Html::TextEditorFor('host', $this->data['content']->Host,
                                    ['maxlength' => '100', 'class' => 'form-control']);?>
                            </div>

                            <div class="form-group">
                                <label for="message">Content:</label>
                                <?php
                                $ckeditor = $this->data['content']->Type == OpenSms::VIEW_TYPE_HTML? 'ckeditor':'';
                                OpenSms_Helper_Html::TextAreaFor('body', $this->data['content']->Body,
                                    ['class' => 'form-control '.$ckeditor, 'id' => 'body', 'style' => 'width:100%;min-height:250px', 'row' => 5])?>
                            </div>
                            <br/>
                            <button class="btn btn-primary" name="saveChange" type="submit" value="Send">Save Changes</button>
                            <button class="btn btn-default" name="reset" type="reset" value="Reset">Reset</button>
                        </fieldset>
                    </form>
                </div>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->