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
        Voucher
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Admin')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Voucher</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-7">


            <!-- GROUP LIST -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Voucher</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <?php if(!empty($this->data['cards']) && count($this->data['cards']) > 0){?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Serial Number</th>
                                <th>PIN</th>
                                <th>Worth</th>
                            </tr>
                            </thead>

                            <?php $sn = 1; foreach($this->data['cards'] as $card){
                                $noRecord = FALSE;
                                echo '<tr>
                            <td>'.$sn++.'</td>
                            <td>'.$card->SerialNumber.'</td>
                            <td>'.$card->Pin.'</td>
                            <td>'.$card->Unit.'</td>
                    </tr>';
                            }?>

                        </table>
                    <?php }?>


                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->


        <div class="col-md-5">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Vouchers</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box box-body">
                    <form method="post" action="<?php echo OpenSms::getActionUrl('Index'); ?>">
                        <div class="form-group">
                            <label for="no">Number</label>
                            <input type="text" class="form-control" id="no" required
                                   name="no" placeholder="How many card do you want">
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" required id="unit" name="unit" placeholder="Enter the unit per card">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Generate" class="btn btn-primary" />
                        </div>
                    </form>

                </div>

            </div>


        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->