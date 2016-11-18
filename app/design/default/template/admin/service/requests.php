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
        Manage Products/Service
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Manage Products/Services</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-12">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Products/Service List</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Customer</th>
                            <th>Product/Service</th>
                            <th>Bank</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($this->data['requests'] as $service){ ?>
                            <tr>
                                <td><?php echo (++$this->data['sn'])?></td>
                                <td><?php echo $service->Name.' '.$service->Email. ' '.$service->Phone?>
                                </td>
                                <td><?php echo $service->ServiceName; ?></td>
                                <td><?php echo $service->BranchName; ?></td>
                                <td><?php echo $service->Price; ?></td>
                                <td>
                                    <?php if($service->Status == OpenSms::SERVICE_REQUEST_PENDING){
                                        ?>
                                    <a href="<?php echo OpenSms::getActionUrl('process', 'service', 'admin', [0 => strtolower($service->Id)])?>"
                                       class="btn btn-info">Process</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->

    </div><!-- /.row -->

</section><!-- /.content -->