<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 3/20/2015
 * Time: 2:12 PM
 */

class NotFound extends OpenSms_Abstract_Module_Controller {
    public function Index(){
        die('Resource not found');
    }
} 