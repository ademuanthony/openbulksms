<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 4/1/2015
 * Time: 1:43 PM
 */

class Users extends OpenSms_Abstract_Module_Controller {

    public function Index($_page = 0){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = 'Manage Users | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->data['page'] = $_page;

        //########==paging==########//
        $rec_limit = 10;
        $count = $this->callModelStaticMethod('OpenSms_Model_User', 'Count');
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
                $link .= '<li><a href="'.OpenSms::getActionUrl('index', 'users', 'admin',
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
        if($rec_limit == 0)
            $this->data['users'] = $this->callModelStaticMethod('OpenSms_Model_User', 'GetAllUsers');
        else
            $this->data['users'] = $this->callModelStaticMethod('OpenSms_Model_User', 'GetAllUsers', [0=>$offset, 1=>$rec_limit]);

        $this->data['link'] = $link;
        $this->data['sn'] = $offset;
        //\paging

        $this->renderTemplate();
    }

    public function find(){
        $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        if(isset($_GET['loginId'])){
            $this->redirectToAction('manage', '', '', [0=>urlencode($_GET['loginId'])]);
        }else{
            $this->redirectToAction('index', '', '', ['notification' => 'Invalid request param', 'page' => $_GET['page']]);
        }
        exit();
    }

    public function login(){
        $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        $login_id = urldecode($_GET['uid']);
        $user = $this->loadModel('OpenSms_Model_User', [0 => $login_id]);
        if(!isset($user) || !isset($user->LoginId)){
            $this->setError('No user to show', 'manage_users');
            //$this->data['curUser'] = $this->loadModel('OpenSms_Model_User');
            $this->redirectToAction('index');
        }

        $this->data['user'] =  $user;

        $_SESSION['loginId'] = $user->LoginId;
        $_SESSION['role'] = $user->Role;

        $this->redirectToAction('index', 'account', 'account');
    }

    public function manage(){
        $this->data['user'] =  $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = 'Manage user | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);

        $_loginId = urldecode($_GET['uid']);

        if(!empty($_loginId)){
            $this->data['curUser'] = $this->loadModel('OpenSms_Model_User', [0 => $_loginId]);
        }

        if(!isset($this->data['curUser']) || !isset($this->data['curUser']->LoginId)){
            $this->setError('No user to show', 'manage_users');
            //$this->data['curUser'] = $this->loadModel('OpenSms_Model_User');
            $this->redirectToAction('index');
        }

        $this->data['transactions']  = $this->data['curUser']->GetTransactions();
        $this->data['payments'] = OpenSms::getPaymentMethods();

        $this->renderTemplate();

    }

    public function update(){
        $this->data['user'] =  $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $_loginId = $_GET['uid'];
        //editing
        if(isset($_POST['resetPassword'])){
            $errorMsg = '';
            //validation
            if(trim($_POST['Password']) == '' ){
                $this->setError('Password cannot be empty and password must match', 'users_update');
                $error_code = 1;
            }
            else{
                $user= $this->loadModel('OpenSms_Model_User', [0=>$_loginId]);
                $user->Password = $_POST['Password'];
                $user->Save();

                $this->setNotification('Password Changed', 'users_update');
                $error_code = 0;
            }

        }else{
            $this->setError('Invalid request param', 'users_update');
        }

        OpenSms::redirectToAction('manage', 'users', 'admin', [0=>$_loginId], $error_code);
        //header('Location: '.URL.'users?notification='.$errorMsg.'&error_code='.$error_code);
        //exit();

    }

    public function recharge(){
        $curUser =  $this->checkLogin('enekpani');
        $user = new User($_POST['loginId']);
        //crediting account

        if(isset($_POST['creditaccount'])){
            $errorMsg = '';

            //validation
            if(trim($_POST['qnt']) == '' || $_POST['qnt'] < 1){
                $errorMsg = 'You must specify the quantity and it must not be less than one';
            }


            if($errorMsg == ''){
                if($_POST['transType'] == 'credit'){
                    ////check if admin have enogh
                    //if($curUser->Balance )
                    $user->Balance += $_POST['qnt'];
                    $qnt = abs($_POST['qnt']);
                    //$curUser->Balance -= $_POST['qnt'];
                }
                else{
                    if($user->Balance >= $_POST['qnt']){
                        $user->Balance -= $_POST['qnt'];
                        $qnt = (-abs($_POST['qnt']));
                        //$curUser->Balance += $_POST['qnt'];
                    }else{
                        $errorMsg = $user->Name.' do not have up to '.$_POST['qnt'].' units';
                    }
                }


                if($errorMsg == ''){
                    $success = $this->deductAccount($qnt);
                    if($success){
                        //if($curUser->LoginId != $user->LoginId){
                        //    $curUser->Save();
                        //}
                        $user->Save();
                        $errorMsg = 'Transaction saved';
                    }else{
                        $errorMsg = "Low master account balance";
                    }
                }
            }
        }
        $error_code = $errorMsg == 'Transaction saved'?0:1;
        header('Location: '.URL.'users/manage/'.$_POST['loginId'].'?notification='.$errorMsg.'&error_code='.$error_code);
        exit();
    }

    public function delete(){
        $this->checkLogin('enekpani');

        $loginId = $_GET['uid'];

        //deleting account
        if(!empty($loginId)){
            $user2d = $this->loadModel('OpenSms_Model_User', [0=>$loginId]);
            $user2d->Delete();
            $notification = 'Account Deleted';
        }

        $this->setNotification('user_delete', $notification);
        $this->redirectToAction('index');
        exit();
    }
} 