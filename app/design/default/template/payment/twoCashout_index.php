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
        Transaction
        <small>Make Payment</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Dashboard', 'Dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo OpenSms::getActionUrl('Index', 'Transaction', 'Account')?>"><i class="fa fa-dashboard"></i> Transaction</a></li>
        <li class="active">Make Payment</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

        <div class="col-md-7">

            <!-- BANK DETAIL -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Billing Information</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">

                    Please review and enter your billing information below to proceed

                    <form action='https://www.2checkout.com/checkout/purchase' method='post'>
                        <input type='hidden' name='sid' value='<?php echo OpenSms::getField('Payment_2Checkout_Account_Number')->value?>' />
                        <input type='hidden' name='mode' value='2CO' />
                        <input type='hidden' name='li_0_type' value='product' />
                        <input type='hidden' name='li_0_name' value='<?php echo $this->data['product'] ?>' />
                        <input type='hidden' name='li_0_price' value='<?php echo $this->data['price'] ?>' />

                        <div class="form-group">
                            <label for="no">Name on Card</label>
                            <input class="form-control" type='text' name='card_holder_name' value='<?php echo $this->data['user']->Name ?>' />
                        </div>
                        <div class="form-group">
                            <label for="no">Street Address</label>
                            <input class="form-control" type='text' name='street_address' value='<?php echo $this->data['user']->BillingAddress1 ?>' />
                        </div>
                        <div class="form-group">
                            <label for="no">Street Address2</label>
                            <input class="form-control" type='text' name='street_address2' value='<?php echo $this->data['user']->BillingAddress2 ?>' />
                        </div>
                        <div class="form-group">
                            <label for="no">City</label>
                            <input class="form-control" type='text' name='city' value='<?php echo $this->data['user']->BillingCity ?>' />
                        </div>
                        <div class="form-group">
                            <label for="no">State</label>
                            <input class="form-control" type='text' name='state' value='<?php echo $this->data['user']->BillingState ?>' />
                        </div>
                        <div class="form-group">
                            <label for="no">Zip</label>
                            <input class="form-control" type='text' name='zip' class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="no">Country</label>
                            <input class="form-control" type='text' name='country' value='<?php echo $this->data['user']->BillingCountry ?>' />
                        </div>

                        <div class="form-group">
                            <label for="no">Email Address</label>
                            <input class="form-control" type='text' name='email' value='<?php echo $this->data['user']->EmailId ?>' />
                        </div>


                        <div class="form-group">
                            <label for="no">Phone number</label>
                            <input class="form-control" type='text' name='phone' value='<?php echo $this->data['user']->MobileNo ?>' />
                        </div>

                        <input name='submit' type='submit' value='Checkout' class="btn btn-primary"/>
                    </form>



                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->


        <div class="col-md-5">

            <!-- BANK DETAIL -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Transaction Detail</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td style="width: 130px;">Amount: </td>
                            <td>$<?php echo ($this->data['transaction']->Amount/200); ?></td>
                        </tr>
                        <tr>
                            <td>Unit: </td>
                            <td><?php echo $this->data['transaction']->Unit ?></td>
                        </tr>
                        <tr>
                            <td>Type: </td>
                            <td><?php echo $this->data['transaction']->Type ?></td>
                        </tr>
                        <tr>
                            <td>Status: </td>
                            <td><?php echo $this->data['transaction']->Status ?></td>
                        </tr>
                        <tr>
                            <td>Payment Method: </td>
                            <td><?php echo $this->data['transaction']->PaymentMethod ?></td>
                        </tr>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->

</section><!-- /.content -->