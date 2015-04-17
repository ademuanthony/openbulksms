<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/2/2015
 * Time: 11:45 AM
 */

class Transactions extends  OpenSms_Abstract_Module_Controller{

    public  function Index($_page = 0){
        $this->data['user'] = $this->checkLogin();

        //########==paging==########//
        $rec_limit = 25;
        $count = $this->callModelStaticMethod('OpenSms_Model_Transaction', 'Count');
        $no = ($count/$rec_limit);


        if($count%$rec_limit == 0)
        {
            $no -= 1;
        }
        $link = '<ul class="pagination">';
        for($i = 0; $i <= $no ; $i++)
        {
            if($i == ($_page - 1) || ($i == 0 && $_page == 0))
            {
                $link .= '<li class="active"><a href="#">Page '.($i + 1).'</a></li>';
            }
            else
            {
                $link .= '<li><a href="'.OpenSms::getActionUrl('index', 'transactions', 'admin',
                        ['parameter1'=>($i + 1)]).'">Page '.($i + 1).'</a></li>';
            }
        }
        $link .= '</ul>';

        if($_page != 0)
        {
            $page = stripslashes($_page) - 1;
            $offset = $page * $rec_limit;
        }
        else
        {
            $page = 0;
            $offset = 0;
        }
        $this->data['transactions'] = $this->callModelStaticMethod('OpenSms_Model_Transaction', 'GetRange', [0=>$offset, 1=>$rec_limit]);

        $this->data['link'] = $link;
        $this->data['sn'] = $offset;
        //\paging

        $this->data['pageTitle'] = 'Transactions | ' . OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

    public function Add(){
        $this->data['user'] = $this->checkLogin();
        if(isset($_POST['Amount'])){
            $tran = $this->loadModel('OpenSms_Model_Transaction');
            foreach($_POST as $key=>$value)
                $tran->{$key} = $value;

            $result = ($tran->Status == OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED)? $tran->Commit():$tran->Save();

            if($result != true){
                $this->setError($result, 'add_transaction');
                if(!empty($_REQUEST['returnUrl'])) {
                    OpenSms::redirect($_REQUEST['returnUrl']);
                }
            }else{
                if(empty($_REQUEST['returnUrl'])) OpenSms::redirectToAction('Index');
                OpenSms::redirect($_REQUEST['returnUrl']);
            }

        }

        $this->data['payments'] = OpenSms::getPaymentMethods();
        $this->data['pageTitle'] = 'New Transaction';
        $this->renderTemplate();
    }

    public function Manage($id){
        $this->data['user'] = $this->checkLogin();
        $this->data['transaction'] = OpenSms::loadModel('OpenSms_Model_Transaction', [0 => $id]);
        $this->data['pageTitle'] = 'Manage Transaction';
        $this->data['returnUrl'] = isset($_REQUEST['returnUrl'])?$_REQUEST['returnUrl']:'';

        $this->data['payments'] = OpenSms::getPaymentMethods();
        $this->data['pageTitle'] = 'Manage Transaction | ' . OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

    public function Update(){
        $this->checkLogin();
        if(isset($_POST['Amount'])){
            $tran = $this->loadModel('OpenSms_Model_Transaction', [0 => $_REQUEST['Id']]);
            if($tran->Committed){
                $this->setError('You cannot make changes to an already committed transaction', 'transactions_update');
                if(empty($_REQUEST['returnUrl'])) OpenSms::redirectToAction('Index');
                OpenSms::redirect($_REQUEST['returnUrl']);
            }
            foreach($_POST as $key=>$value)
                $tran->{$key} = $value;

            $result = ($tran->Status == OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED)? $tran->Commit():$tran->Save();

            if($result != true){
                $this->setError($result, 'add_transaction');
                if(!empty($_REQUEST['returnUrl'])) {
                    OpenSms::redirect($_REQUEST['returnUrl']);
                }else OpenSms::redirectToAction('Index');
            }else{
                $this->setNotification($tran->Status == OpenSms::OPEN_TRANSACTION_STATUS_COMPLETED?'Transaction saved and committed'
                :'Transaction saved', 'add_transaction');
                if(empty($_REQUEST['returnUrl'])) OpenSms::redirectToAction('Index');
                OpenSms::redirect($_REQUEST['returnUrl']);
            }

        }
    }

    public function Delete($id){
        $this->checkLogin();
        $returnUrl = isset($_REQUEST['returnUrl'])? $_REQUEST['returnUrl'] :'';
        $tran = OpenSms::loadModel('OpenSms_Model_Transaction', [0 => $id]);
        if(!isset($tran->LoginId)) return 'Invalid transaction Id';
        $result = $tran->Delete();
        if(!$result) $this->setError($result, 'delete_transaction');
        if(empty($returnUrl)) OpenSms::redirectToAction('Index');
        OpenSms::redirect($returnUrl);
    }
}