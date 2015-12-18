<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 6/30/2015
 * Time: 8:35 AM
 */

class Cms extends OpenSms_Abstract_Module_Controller{
    public function index(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = "CMS - Pages";
        $this->renderTemplate();
    }

    public function addPage(){

    }

    public function deletePage($permaLink){

    }

    public function save(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        if(isset($_POST['key'])){
            $cms = $this->loadModel("OpenSms_Model_Content", [0=>$_POST['key']]);
            if(!$cms->Id > 0){
                $this->setError("No content found with the key '".$_POST['key']."'", 'cms_save');
                OpenSms::redirectToAction('index');
            }
            $cms->Body =  urldecode($_POST['body']);
            if($cms->Save()){
                if(isset($_POST['returnUrl'])) $this->redirect($_POST['returnUrl']);
                OpenSms::redirectToAction('index');
            }
            $this->setError('Error in saving changes', 'cms_save');
            OpenSms::redirectToAction('index');
        }
    }

    public function images(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = "CMS-Images";
        $this->data['images'] = OpenSms::getImages();
        //merge all
        foreach ($this->data['images'][OpenSms::CURRENT_THEME_KEY] as $key=>$image) {
            $this->data['images'][$key] = $image;
        }
        unset($this->data['images'][OpenSms::CURRENT_THEME_KEY]);

        $this->data['sn'] = 0;
        $this->renderTemplate();
    }

    public function addImage(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        if(isset($_FILES['image'])){
            $this->uploadImage('image', 'app/skin/assets/images/', $_POST['key']);
            $this->setNotification('Image uploaded', 'addImage_cms');
        }else $this->setError('No image selected', 'addImage_cms');
        if(isset($_POST['returnUrl'])) $this->redirect($_POST['returnUrl']);

        $this->redirectToAction('images');
    }

    public function deleteImage()
    {
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

    }
} 