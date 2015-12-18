<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 7/13/2015
 * Time: 10:56 PM
 */

class Pages extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);
        $this->data['pageTitle'] = "CMS - Pages";
        $this->data['pages'] = $this->callModelStaticMethod("OpenSms_Model_Page", "GetAll");
        $this->data['sn'] = 0;
        $this->renderTemplate();
    }

    public function Add(){
        $this->data['user'] = $this->checkLogin();

        if(isset($_POST['permalink'])){

            $page = $this->loadModel("OpenSms_Model_Page");
            $page->Title = $_POST['title'];
            $page->Permalink = strtolower(str_replace(' ', '-', trim($_POST['permalink'])));
            $page->Layout = $_POST['layout'];
            $page->Description = $_POST['description'];
            $page->Role = 'page';

            $result = $page->Save();

            if(is_bool($result) && $result == true){
                //save the content
                $key = 'opensms_page_'.$page->Permalink;
                $cms = $this->loadModel("OpenSms_Model_Content");
                $cms->Key = $key;
                $cms->Type = OpenSms::VIEW_TYPE_HTML;
                $cms->Body = $_POST['content'];
                $cms->Host = 'div';
                $cms->Save();
                $this->setNotification("Page added", "page_add");
                $this->redirectToAction('index');
            }else{
                $this->setError($result, 'add_page');
            }
        }

        OpenSms::registerView('cms_ck_editor_js', 'default/assets/plugins/ckeditor/ckeditor.js', OpenSms::VIEW_TYPE_SCRIPT, OpenSms::VIEW_POSITION_TOP);
        $this->data['pageTitle'] = "New Page";
        $this->renderTemplate();
    }

    public function Manage($permalink){
        $this->data['user'] = $this->checkLogin(OpenSms::OPEN_ROLE_ADMIN);

        $page = $this->loadModel('OpenSms_Model_Page', [0=>$permalink]);
        if($page->Id < 1){
            $this->setError("No page found with the permalink: $permalink", "page_manage");
            $this->redirectToAction('index');
        }
        if(isset($_POST['title'])){
            $page->Title = $_POST['title'];
            $page->Layout = $_POST['layout'];
            $page->Description = $_POST['description'];
            $result = $page->Save();
            if($result==true) $this->setNotification('Page saved', 'page_manage');
            else $this->setError('Error in saving page', 'page_manage');
            $this->redirectToAction('index');
        }

        $this->data['page'] = $page;
        $this->data['pageTitle'] = "Manage Page";

        OpenSms::registerView('cms_ck_editor_js', 'default/assets/plugins/ckeditor/ckeditor.js', OpenSms::VIEW_TYPE_SCRIPT, OpenSms::VIEW_POSITION_TOP);

        $this->renderTemplate();
    }

    public function Delete($permalink){
        $this->checkLogin();
        $page = $this->loadModel('OpenSms_Model_Page', [0=>$permalink]);
        if($page->Id > 0) $page->Delete();
        $this->setNotification('Page Deleted', 'page_delete');
        $this->redirectToAction('index');

    }
} 