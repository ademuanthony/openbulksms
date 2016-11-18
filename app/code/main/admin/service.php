<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 10/30/2015
 * Time: 6:13 AM
 */

class Service extends OpenSms_Abstract_Module_Controller{
    public function Index($_page = 0){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = 'Manage Services | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->data['page'] = $_page;


        //########==paging==########//
        $rec_limit = 10;
        $count = $this->callModelStaticMethod('OpenSms_Model_Service', 'Count');
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
            $this->data['services'] = $this->callModelStaticMethod('OpenSms_Model_Service', 'GetAll');
        else
            $this->data['services'] = $this->callModelStaticMethod('OpenSms_Model_Service', 'GetAll', [0=>$offset, 1=>$rec_limit]);

        $this->data['link'] = $link;
        $this->data['sn'] = $offset;

        $this->data['service'] = isset($_SESSION['new_service'])?$_SESSION['new_service']:$this->loadModel('OpenSms_Model_Service');
        unset($_SESSION['new_service']);
        //\paging

        $this->renderTemplate();
    }

    public function Add(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        if(isset($_POST['name'])){
            $service = $this->loadModel('OpenSms_Model_Service');
            $service->Name = $_POST['name'];
            $service->Description = $_POST['description'];
            $service->Price = $_POST['price'];
            $service->Image = str_replace(' ', '-', $_POST['name']);
            $result = $service->Save();
            if($result == 'Service Added'){
                if(isset($_FILES['image'])){
                    $this->uploadImage('image', 'app/skin/assets/images/', $service->Image);
                }
            }else{
                $this->setNotification($result, 'add_service');
                $_SESSION['new_service'] = $service;
            }
            $this->setNotification($result, 'add_service');
            $this->redirectToAction('index');
        }
    }

    public function Manage($id){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $service = $this->loadModel('OpenSms_Model_Service', array(0 => $id));
        $this->data['pageTitle'] = 'Manage Product/Service';

        if(isset($_POST['name'])){
            $service->Name = $_POST['name'];
            $service->Description = $_POST['description'];
            $service->Price = $_POST['price'];
            $oldImage = $service->Image;

            if(isset($_FILES['image'])){
                $service->Image = str_replace(' ', '-', $_POST['name']);
            }
            $result = $service->Save();
            if($result == 'Service Updated'){
                if(isset($_FILES['image'])){
                    $this->uploadImage('image', 'app/skin/assets/images/', $service->Image);
                }
                $this->setNotification($result, 'manage_service');
                $this->redirectToAction('Index');
            }else{
                $service->Image = $oldImage;
            }
            $this->setError($result, 'manage_service');
        }

        $this->data['service'] = $service;
        $this->renderTemplate();
    }

    public function Requests($_page = 1, $status = ''){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = 'Requests';

        //########==paging==########//
        $rec_limit = 100;
        $count = $this->callModelStaticMethod("OpenSms_Model_ServiceRequest", "Count", array(0=>$status));;
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
                $link .= '<li><a href="'.OpenSms::getActionUrl('detail', '*', 'group',
                        ['parameter1' => ($i + 1), 'parameter2'=>$status]).'">Page '.($i + 1).'</a></li>';
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

        //\paging


        $this->data['sn'] = $offset;
        if($rec_limit == 0)
            $this->data['requests'] = $this->callModelStaticMethod("OpenSms_Model_ServiceRequest", "GetAll");
        else
            $this->data['requests'] = $this->callModelStaticMethod("OpenSms_Model_ServiceRequest", "GetAll", array(0=>$status, 1 => $offset, $rec_limit));

        //var_dump($this->data['requests']); die();
        $this->renderTemplate();

    }

    public function Process($id){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['request'] = $this->loadModel('OpenSms_Model_ServiceRequest', array(0 => $id));

        $name = @trim(stripslashes($this->data['request']->Name));
        $email = @trim(stripslashes($this->data['request']->Email));
        $subject = @trim(stripslashes("Multifunction Invoice"));
        $message = @trim(stripslashes($this->data['request']->ServiceName));

        $email_from = $email;
        $email_to = 'invoice@multifuctionsltd.com';//replace with your email

        $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;

        $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

        if($success) {
            $this->setNotification('Notification has been sent to the customer', 'Service_Process');
            $this->data['request']->Status = OpenSms::SERVICE_REQUEST_WAITING_FOR_BANK;
            $this->data['request']->Save();
        }
        else $this->setError('Error in sending mail. Please try again later', 'Service_Process');

        $this->redirectToAction('requests');
    }
} 