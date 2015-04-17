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


            <table class="table">
                <thead>
                <tr>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($this->data['bulkSmsList'] as $b){?>
                    <tr>
                        <td><?php echo $b->Sender; ?></td>
                        <td><?php echo $b->Message; ?></td>
                        <td><?php echo $b->DateCreated; ?></td>
                        <td><?php echo $b->Status; ?></td>
                        <td><a href="<?php echo OpenSms::getActionUrl('detail', 'sent', 'sms', [0 => $b->Id])?>">View Detail</a></td>
                    </tr>
                <?php }?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" style="text-align: center;"><?php echo $this->data['link'];?></td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>


</div><!-- /.col -->
</div><!-- /.row -->

</section><!-- /.content -->