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
        Groups
        <small><?php echo $this->data['group']->Name?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index')?>"><i class="fa fa-group"></i> Group</a></li>
        <li class="active">Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">


            <!-- GROUP LIST -->
            <div class="box box-danger">

                <form action="<?php echo OpenSms::getActionUrl('update', '*', 'group', ['parameter1' => $this->data['group']->Id])?>" method="post">
                    <div class="box-header with-border">
                        <h3 class="box-title">Group Detail</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <input value="<?php echo $this->data['group']->Name; ?>" type="text" class="form-control" name="Name" placeholder="Group Name"/>
                        </div>
                        <div>
                            <textarea name="Description" class="form-control" placeholder="Description" >
                                <?php echo $this->data['group']->Description; ?>
                            </textarea>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <button style="color: #ffffff" class="pull-right btn btn-default btn-success">Update <i class="fa fa-save"></i></button>
                    </div>

                </form>
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-md-8">

            <!-- GROUP LIST -->
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Contacts</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php if(count($this->data['contacts']) < 1){?>
                    <p class="text-danger">No record found</p>
                    <?php } else { ?>

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-left">S/No</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Number</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($this->data['contacts'] as $contact){?>
                                <tr>
                                    <td><?php echo (++$this->data['sn'])?></td>
                                    <td><?php echo $contact->Name;?></td>
                                    <td><?php echo $contact->Number;?></td>
                                    <td>
                                        <a href="<?php echo OpenSms::getActionUrl('DeleteContact', '*', 'group',
                                            ['parameter1' => $this->data['group']->Id, 'parameter2' => $contact->Id])?>"
                                           class="btn btn-warning">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>

                        <tfoot>
                        <?php echo $this->data['link'] ?>
                        </tfoot>
                    </table>

                    <?php } ?>
                </div>

            </div><!-- /.box -->

        </div><!-- /.col -->

        <div class="col-md-4">

            <div class="box box-primary">
                <form enctype="multipart/form-data" action="<?php echo OpenSms::getActionUrl('addContact', '*', 'group', ['parameter1' => $this->data['group']->Id])?>" method="post">
                    <div class="box-header">
                        <i class="fa fa-plus-square"></i>
                        <h3 class="box-title">Add Contacts</h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-info btn-sm btn-danger" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div><!-- /. tools -->
                    </div>

                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#enterNumbers" role="tab" data-toggle="tab">Enter Numbers</a></li>
                            <li><a href="#uploadNumbers" role="tab" data-toggle="tab">Upload File</a></li>
                        </ul>


                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="enterNumbers">
                                <div class="form-group">
                                    <textarea placeholder="Enter one number per line"
                                              class="form-control" name="contacts" id="contacts" style="width:96%" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="tab-pane" id="uploadNumbers">
                                <div class="form-group">
                                    <input class="form-control" type="file" id="uFile" name="uFile">
                                    <p class="help-block">Upload a text file with one number per line or an excel 97 to 2003 (xls) file</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer clearfix">
                        <button style="color: #ffffff" class="pull-right btn btn-default btn-success">Add Numbers <i class="fa fa-plus-square"></i></button>
                    </div>

                </form>
            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->