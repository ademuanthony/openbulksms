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
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Pages', 'CMS')?>"><i class="fa fa-dashboard"></i> Pages</a></li>
        <li class="active">New Page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

<div class="row">
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-header">
            <h3>Compose New Page</h3>
        </div>

        <div class="box-body">
            <form role="form" method="post" action="<?php echo OpenSms::getActionUrl('add')?>">
                <fieldset class="fancy">

                    <div class="form-group">
                        <label for="sender">Permalink</label>
                        <input type="text" class="form-control" name="permalink" id="permalink" value="" maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="sender">Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="" maxlength="100">
                    </div>

                    <div class="form-group">
                        <label for="sender">Layout</label>
                        <input type="text" class="form-control" name="layout" id="layout" value="">
                    </div>

                    <div class="form-group">
                        <label for="message">Description:</label>
                        <textarea class="form-control" name="description" id="content" style="width:100%" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="message">Content:</label>
                        <textarea class="form-control ckeditor" name="body" id="content" style="width:100%" rows="5"></textarea>
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