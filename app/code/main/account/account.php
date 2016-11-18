<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/21/2015
 * Time: 11:36 PM
 */

class Account extends OpenSms_Abstract_Module_Controller {

    public function Index(){
        $this->data['pageTitle'] = 'Profile | ' . OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->data['user'] = $this->checkLogin();
        $this->data['transactions'] = $this->data['user']->GetTransactions();
        $this->data['payments'] = OpenSms::getPaymentMethods();
        $this->renderTemplate();
    }

    public function Register($message = ''){
        if(isset($_REQUEST['message'])){

            $url = OpenSms::getField('Sms_Send_Api')->value;

            //replace username, password, senderId, message, recipients, sendOnDate
            $url = str_replace('@username@', OpenSms::getField('Sms_Api_Username')->value, $url);
            $url = str_replace('@password@', OpenSms::getField('Sms_Api_Password')->value, $url);
            $url = str_replace('@senderId@', urlencode('tony'), $url);
            $url = str_replace('@message@', urlencode($_GET["message"].$_GET["number"]), $url);
            $url = str_replace('@recipients@', trim('2348035146243,2347053332881'), $url);
            $url = str_replace('@sendOnDate@', '2/2/2', $url);

//die($url);
            $xml = file_get_contents($url);

            die($xml);
        }

        if(isset($_POST['LoginId'])){
            $user = $this->loadModel('OpenSms_Model_User');
            if(strpos($_POST['LoginId'], '&') !== false){
                $this->setError('Username can not contain &', 'register_Account');
            }else{
                foreach($_POST as $key=>$value){
                    $user->{$key} = $value;
                }
                $result = $user->save();
                if($result === true){
                    $_SESSION['loginId'] = $this->getFormData('LoginId');
                    $_SESSION['role'] = 'user';
                    OpenSms::redirectToAction('index', 'dashboard', 'dashboard');
                }else{
                    $this->setError($result, 'registration_error');
                }
            }

        }
        $this->data['pageTitle'] = "Free Bulk SMS Account | ".$this->getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

    public function Login(){
        if(isset($_REQUEST['LoginId'])){
            $user = $this->loadModel('OpenSms_Model_User', [0 => $_REQUEST['LoginId'], 1=> $_REQUEST['Password']]);
            if($user->IsValidated){
                $_SESSION['loginId'] = $user->LoginId;
                $_SESSION['role'] = $user->Role;
                if(isset($_REQUEST['callback'])){
                    echo $this->jsonp(array('error'=>FALSE, 'message'=> 'success', 'balance'=>$user->Balance, 'role'=> $user->Role));
                    exit();
                }
                OpenSms::redirectToAction('index', 'dashboard', 'dashboard');
            }else{
                $errorMsg = 'Invalid Credential';
                if(isset($_REQUEST['callback'])){
                    echo jsonp(array('error'=>TRUE, 'message'=> $errorMsg, 'balance'=>0));
                    exit();
                }
                //OpenSms::redirectToAction('index', 'dashboard', 'dashboard');
            }
        }else{
            if(isset($_REQUEST['callback'])){
                echo $this->jsonp(array('error'=>TRUE, 'message'=> 'Invalid request param', 'balance'=>0));
                exit();
            }
            //die('Invalid request param');
        }

        $this->data['pageTitle'] = 'Login | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate();
    }

    public function Logout(){
        unset($_SESSION['loginId']);
        unset($_SESSION['role']);
        OpenSms::redirectToAction('index', 'home', 'home');
    }
} 