<?php
/**
 * Created by PhpStorm.
 * User: Ademu
 * Date: 11/20/2015
 * Time: 11:16 AM
 */
class Gallery extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['pageTitle'] = 'Gallery';
        $this->data['images'] = OpenSms::getGalleryImages();
        $this->renderTemplate();
    }
}