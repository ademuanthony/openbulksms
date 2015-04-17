<?php
/**
 * Created by PhpStorm.
 * User: Tony
 * Date: 4/8/2015
 * Time: 12:11 PM
 */

class Sent extends OpenSms_Abstract_Module_Controller {
    public function index($_page = 0){

        $user =  $this->checkLogin();

        //########==paging==########//
        $rec_limit = 50;
        $count = OpenSms::callModelStaticMethod('OpenSms_Model_BulkSms', 'GetBulkSMSCount', [0 =>$user->LoginId]);
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
                $link .= '<li><a href="'.OpenSms::getActionUrl('index', 'sent', 'sms', [0 => ($i + 1)]).'">Page '.($i + 1).'</a></li>';
            }
        }
        $link .= '</ul>';

        $this->data['link'] = $link;

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


        $this->data['bulkSmsList'] = OpenSms::callModelStaticMethod('OpenSms_Model_BulkSms', 'GetBulkSMS', [0 =>$user->LoginId, 1 => $offset, 2 => $rec_limit]);
        $this->data['pageTitle'] = 'Sent Messages | '.OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->data['user'] = $user;

        $this->renderTemplate();
    }

    public function Detail($id){
        $this->data['user'] =  $this->checkLogin();
        $this->data['bulkSms'] = $this->loadModel('OpenSms_Model_BulkSms', [0 => $id]);

        $this->renderTemplate();
    }
} 