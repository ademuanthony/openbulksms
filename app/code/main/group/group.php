<?php
/**
 * Created by Ademu Anthony.
 * User: Tony
 * Date: 3/30/2015
 * Time: 6:14 PM
 */

class Group extends OpenSms_Abstract_Module_Controller{
    public function Index(){
        $this->data['pageTitle'] = "Groups -> ".OpenSms::getSystemSetting(OpenSms::SITE_NAME);

        $user =  $this->checkLogin();

        $this->data['user'] = $user;
        $this->data['groups'] = $user->GetGroups();
        $this->data['sn'] = 0;

        if(isset($_REQUEST['callback'])){
            echo OpenSms::jSonp(array('error'=>FALSE, 'message'=> 'success', 'groups'=>$this->data['groups'],
                'count'=> sizeof($this->data['groups']) ), $_REQUEST['callback']);
            exit();
        }

        $this->renderTemplate('body');
    }

    public function add(){
        $user =  $this->checkLogin();

        if(isset($_REQUEST['Name'])){
            $g = $this->loadModel('OpenSms_Model_Group');
            $g->Name = $this->getFormData('Name');
            $g->Description = $this->getFormData('Description');
            $g->LoginId = $user->LoginId;
            $notification = $g->Save();
            $error_code = $notification == 'Group Added'?1:0;
        }else{
            $notification = 'Invalid request parameter';
            $error_code = 1;
        }

        if(isset($_REQUEST['callback'])){
            echo OpenSms::jSonp(array('error'=>$error_code != 0, 'message'=> $notification), $_REQUEST['callback']);
            exit();
        }

        if($error_code) $this->setNotification($notification, 'add_group');
        else $this->setError($notification, 'add_group');

        OpenSms::redirectToAction('Index');
    }

    public function detail($groupId, $_page = 0){
        $user = $this->checkLogin();
        $group = $this->loadModel('OpenSms_Model_Group', [0 => $groupId]);


        if($group->GroupExits == TRUE){

            //########==paging==########//
            $rec_limit = 100;
            $count = $group->GetContactCount();
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
                            ['parameter1' => $groupId, 'parameter2'=>($i + 1)]).'">Page '.($i + 1).'</a></li>';
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


            if($rec_limit == 0)
                $contacts = $group->GetContacts();
            else
                $contacts = $group->GetContacts($offset, $rec_limit);

            $this->data['user'] = $user;
            $this->data['group'] = $group;
            $this->data['contacts'] = $contacts;
            $_page = $_page == 0? 1: $_page;
            $this->data['sn'] = ($_page - 1) * $rec_limit;
            $this->data['link'] = $link;

            if(isset($_REQUEST['callback'])){
                OpenSms::jSonp(array('error'=>false, 'group'=>$group, 'contacts' =>$contacts), $_REQUEST['callback']);
                exit;
            }

        }
        else {
            if(isset($_REQUEST['callback'])){
                OpenSms::jSonp(array('error'=>true, 'message'=>'Group not found'), $_REQUEST['callback']);
                exit;
            }
            $this->setError('Group not found', 'group_detail');
            OpenSms::redirectToAction('Index');
        }

        $this->data['pageTitle'] = "Groups | ".$this->data['group']->Name." -> ".OpenSms::getSystemSetting(OpenSms::SITE_NAME);
        $this->renderTemplate('body');
    }

    public function update($groupId){
        $this->checkLogin();

        if(!isset($_REQUEST['Description'])){
            $this->setError('Invalid request parameters', 'update_group');
            $error_code = 1;
        }else{
            $g = $this->loadModel('OpenSms_Model_Group', [0 => $groupId]);
            $g->Description = $_REQUEST['Description'];
            $g->LoginId = $_SESSION['loginId'];
            $notification_updateGroup = $g->Save();
            $this->setNotification($notification_updateGroup, 'update_group');
        }

        OpenSms::redirectToAction('detail', '*', 'group', ['parameter1' => $groupId]);
    }

    public function delete($groupId){
        $this->checkLogin();

        $g = $this->loadModel('OpenSms_Model_Group', [0 => $groupId]);

        $g->Delete();
        $this->setNotification('Delete succeeded', 'delete_group');

        if(isset($_REQUEST['callback'])){
            echo OpenSms::jSonp(array('error'=>FALSE, 'message'=> 'Group Deleted'), $_REQUEST['callback']);
        }

        OpenSms::redirectToAction('Index');
    }

    public function addContact($groupId){
        $this->checkLogin();

        $group = $this->loadModel('OpenSms_Model_Group', [0 => $groupId]);

        if(!$group->GroupExits){
            $this->setError('Invalid group Id', 'add_number');
            $error_code = 1;
        }else{
            $cons = array();

            if(isset($_REQUEST['contacts'])){
                if(trim($_REQUEST['contacts']) != ''){
                    $contactInput = preg_split('/(\r?\n)+/', trim($_REQUEST['contacts']));

                    foreach($contactInput as $line){
                        $nums = explode(',', $line);
                        foreach($nums as $num){
                            $con = $this->loadModel('OpenSms_Model_Contact');
                            $conSplit = explode('@', $num);
                            if(empty($conSplit[0])) continue;
                            $con->Number = trim($conSplit[0]);
                            $con->Name = isset($conSplit[1])?trim($conSplit[1]): '';
                            $con->GroupId = $groupId;

                            $cons[] = $con;
                        }
                    }
                }

                if(!(empty($_FILES['uFile']['name']))){
                    //uploading a text file
                    //checking file type
                    $allowedTxt =  array('txt','TXT');
                    $allowedXls =  array('xls','XLS');
                    $filename = $_FILES['uFile']['name'];
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);

                    if(in_array($ext,$allowedXls) ) {
                        //excel sheet
                        require_once('app/code/opensms/helper/excel_reader2.php');
                        $data = new Spreadsheet_Excel_Reader($_FILES['uFile']['tmp_name']);
                        for($i=0;$i<count($data->sheets);$i++) // Loop to get all sheets in a file.
                        {
                            if(count($data->sheets[$i]['cells'])>0) // checking sheet not empty
                            {
                                for($j=1;$j<=count($data->sheets[$i]['cells']);$j++) // loop used to get each row of the sheet
                                {
                                    $num = $data->sheets[$i]['cells'][$j][1];

                                    $f = substr($num, 0, 1);

                                    if($f != '0' && $f != '2'){
                                        $num = '0'.$num;
                                    }

                                    $con = $this->loadModel('OpenSms_Model_Contact');
                                    $conSplit = explode('@', $num);
                                    if(empty($conSplit[0])) continue;
                                    $con->Number = trim($conSplit[0]);
                                    $con->Name = isset($conSplit[1])?trim($conSplit[1]): '';
                                    $con->GroupId = $groupId;

                                    $cons[] = $con;
                                }
                            }

                        }

                    }elseif(in_array($ext,$allowedTxt)){
                        $fp = fopen($_FILES['uFile']['tmp_name'], 'rb');
                        while ( ($line = fgets($fp)) !== false) {
                            $nums = explode(',', $line);
                            foreach($nums as $num){
                                if(strlen(trim($num)) > 4){
                                    $f = substr($num, 0, 1);
                                    if($f != '0' && $f != '2'){
                                        $num = '0'.$num;
                                    }
                                    $con = $this->loadModel('OpenSms_Model_Contact');
                                    $conSplit = explode('@', $num);
                                    if(empty($conSplit[0])) continue;
                                    $con->Number = trim($conSplit[0]);
                                    $con->Name = isset($conSplit[1])?trim($conSplit[1]): '';
                                    $con->GroupId = $groupId;

                                    $cons[] = $con;
                                }
                            }


                        }
                    }else{
                        $this->setError('Error! Please upload a text(txt) or excel(xls) file', 'add_number');
                        $error_code = 1;
                    }
                }

                //var_dump($cons); die();

                //add contact to db
                if(count($cons) > 0){
                    $result = $this->callModelStaticMethod('OpenSms_Model_Contact', 'SaveContacts', [0=>$cons]);
                    if($result)$this->setNotification(count($cons).' numbers Added', 'add_number');
                    else $this->setError('Error in adding contacts', 'add_number');
                    $error_code = $result?0:1;
                }else{
                    $this->setError('Please enter at least one number', 'add_number');
                    $error_code = 1;
                }
            }
        }



        if(isset($_REQUEST['callback'])){
            echo jsonp(array('error'=>$error_code == 1,
                'message'=> $error_code == 1?$this->getError('add_number'):$this->getNotification('add_number')));
            exit();

        }

        OpenSms::redirectToAction('detail', '*', 'group', ['parameter1' => $groupId]);
    }

    public function deleteContact($groupId, $contactId){
        $this->checkLogin();

        $c2d = $this->loadModel('OpenSms_Model_Contact', [0 => $contactId]);
        $notification = $c2d->Delete();
        $error_code = $notification == 'One number deleted'?0:1;
        $this->setNotification($notification, 'delete_contact');

        OpenSms::redirectToAction('detail', '*', 'group', ['parameter1' => $groupId]);
    }

    public function getContacts($groupId, $offset, $limit){
        $requestIsAutheticated  = $this->requestIsAutheticated();
        $this->loadModel('user');
        $this->loadModel('_Group');
        $this->loadModel('Contacts');
        $user = new User($_REQUEST['loginId'], $_REQUEST['password']);
        if(!$user->IsValidated){
            echo jsonp(array('error' => TRUE, 'message' => 'Invalid credential', 'count' => 0));
            exit();
        }

        $group = new _Group($groupId);

        if($group->GroupExits == TRUE)
        {
            echo jsonp(array('error' => TRUE, 'message' => 'Group Not Found', 'messages' => $bulkSMSs,
                'contact'=> $contacts, 'count'=>$group->GetContactCount()));
            exit();

        }
        if($limit == 0)
            $contacts = $group->GetContacts();
        else
            $contacts = $group->GetContacts($offset, $limit);

        echo jsonp(array('error' => FALSE, 'message' => 'Succes', 'messages' => $bulkSMSs,
            'contact'=> $contacts, 'count'=>$group->GetContactCount()));
        exit();
    }
} 
