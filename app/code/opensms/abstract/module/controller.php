<?php
class OpenSms_Abstract_Module_Controller extends OpenSms_Abstract_Module_Base{
    
    public $db = null;

    private $layout = NULL;

    protected function printData($key){
        echo $this->data[$key];
    }

    protected function getFormData($key, $method = '', $throw = false){
        if(empty($method)) {
            if (isset($_REQUEST[$key])) {
                return $_REQUEST[$key];
            } elseif ($throw) return $_REQUEST[$key];
        }else{
            if(strtolower($method) == 'get'){
                if(isset($_GET[$key])) return $_GET[$key];
                elseif($throw) return $_GET[$key];
            }elseif(strtolower($method) == 'post')
            {
                if(isset($_POST[$key])) return $_POST[$key];
                elseif($throw) return $_POST[$key];
            }
        }
        return '';
    }
   /*
   html
   */
   protected function getThemeName(){
       if(OpenSms::getCurrentRoute()->controller == 'install') return 'default';
       return $this->data['currentTheme']->key;
   }

    protected function getLayoutFileKey(){
        return null;
    }

   private function getLayout(){
       if($this->layout != NULL) return $this->layout;
       $_key = $this->getLayoutFileKey();
       if(empty($_key)) {
           $trace = debug_backtrace();
           $caller = $trace[3];//call traces through (3)action=>(2)renderLayout=>(1)getTemplate=>(0)getLayout
           if (isset($caller['class']))
               $_key = $caller['class'] . '_';
           $_key .= $caller['function'];

           //layout name is in the format module_controller_action
           //$_key has the value controller_action
           //use module with the key to get the layout file
           /*
            * layout resolution checks for the specified file in the current theme.
            * if not found; use the main layout in the current theme,
            * if not found; use the specified layout in the default theme,
            * if not found use the main layout in the default theme
           */
       }

       $filename = $this->module->name.'/'.$_key.'.xml';


       $fileFullName = 'app/design/'.$this->getThemeName().'/layout/'.$filename;
       if(!file_exists($fileFullName)){
           $fileFullName = 'app/design/'.$this->getThemeName().'/layout/main.xml';
           if(!file_exists($fileFullName)){
               $fileFullName = 'app/design/default/layout/'.$filename;
               if(!file_exists($fileFullName)){
                   $fileFullName = 'app/design/default/layout/main.xml';
               }
           }
       }

       $this->layout = simplexml_load_file($fileFullName);

       //print_r($this->layout);die();
       return $this->layout;
   }

   //will be called in the template to add files
   protected function getTemplatePath($block_name){
       /*
        * search the template folder of the current theme for requested template file
        * if not found use the default
        * else return the requested
        * If the request is mobile then return mobile template
        * if is mobile
        * ** if them mobile exists get it
        * ** else if theme main exists get
        * ** else if default mobile exists get
        * ** get desktop main
        */

       /*
       $detector = new Mobile_Detect();
       if($detector->isMobile()){
           $sFileName = OpenSms::DESIGN_PATH.$this->getThemeName().'/template/mobile/'.(string)$this->getLayout()->{$block_name}['template'];
           if(file_exists($sFileName)) return $sFileName;
           $sFileName = OpenSms::DESIGN_PATH.$this->getThemeName().'/template/'.(string)$this->getLayout()->{$block_name}['template'];
           if(file_exists($sFileName)) return $sFileName;
           $sFileName = OpenSms::DESIGN_PATH.'default'.'/template/mobile/'.(string)$this->getLayout()->{$block_name}['template'];
           if(file_exists($sFileName)) return $sFileName;
           $sFileName = OpenSms::DESIGN_PATH.'default'.'/template/'.(string)$this->getLayout()->{$block_name}['template'];
           if(file_exists($sFileName)) return $sFileName;
       }
       */

       $sFileName = OpenSms::DESIGN_PATH.$this->getThemeName().'/template/'.(string)$this->getLayout()->{$block_name}['template'];
       if(!file_exists($sFileName))
           $sFileName = OpenSms::DESIGN_PATH.'default'.'/template/'.(string)$this->getLayout()->{$block_name}['template'];
       return $sFileName;
   }

   protected function renderTemplate($block_name = 'body', $required = true){
       if($block_name == 'body') OpenSms::runAction(OpenSms::BEFORE_RENDER_ACTION);

       $file_name = strtolower($this->getTemplatePath($block_name));
       if(!$required && (!file_exists($file_name) || is_dir($file_name))) return;
       require_once $file_name;
   }

    protected function getCurrentUri(){
        return OpenSms::getActionUrl(OpenSms::getCurrentRoute()->action);
    }

    protected function isCurrentUri($action, $controller = '', $module = ''){
        return OpenSms::getActionUrl($action, $controller, $module) == $this->getCurrentUri();
    }

    protected function jsonp(array $param){

    }

    protected function renderStyle($block_name = 'head'){
        $scripts = null;

        $scriptElements = $this->getLayout()->{$block_name}->xpath('//addStyle');
        if(!isset($scriptElements) || !is_array($scriptElements)) return $scripts;

        foreach($scriptElements as $script){
            $sFileName = OpenSms::DESIGN_PATH.$this->getThemeName().'/assets/'.(string)$script['href'];
            if(!file_exists($sFileName)){
                $fileName = OpenSms::DESIGN_PATH . 'default' . '/assets/' . (string)$script['href'];
                if (file_exists($fileName)) $sFileName = $fileName;
            }
            $scripts[] = $sFileName;
        }

        //var_dump($scripts); die();
        if(is_array($scripts)) {
            foreach ($scripts as $sFile) {
                echo html_entity_decode("<link href='".OpenSms::getBaseUrl().$sFile."' rel='stylesheet'/>");
            }
        }else {
            echo html_entity_decode("<link href='".OpenSms::getBaseUrl().$scripts."' rel='stylesheet'/>");
        }

    }

    protected function renderScript($block_name = 'head'){
        $scripts = null;

        $scriptElements = $this->getLayout()->{$block_name}->xpath('//addScript');
        if(!isset($scriptElements) || !is_array($scriptElements)) return $scripts;

        foreach($scriptElements as $script){
            $sFileName = OpenSms::DESIGN_PATH.$this->getThemeName().'/assets/'.(string)$script['src'];
            if(!file_exists($sFileName)){
                $fileName = OpenSms::DESIGN_PATH . 'default' . '/assets/' . (string)$script['src'];
                if (file_exists($fileName)) $sFileName = $fileName;
            }
            $scripts[] = $sFileName;
        }

        //var_dump($scripts); die();
        if(is_array($scripts)) {
            foreach ($scripts as $sFile) {
                echo html_entity_decode("<script src='".OpenSms::getBaseUrl().$sFile."' type='text/javascript'></script>");
            }
        }else {
            echo html_entity_decode("<script src='".OpenSms::getBaseUrl().$scripts."' type='text/javascript'></script>");
        }
    }

    protected function registerView($key, $content, $type, $position, $isFile = true){
        OpenSms::registerView($key, $content, $type, $position, $isFile);
    }

    protected function renderSpecialView($position){
        $views = OpenSms::getViews($position);
        foreach($views as $view){
            switch($view->type){
                case OpenSms::VIEW_TYPE_STYLE:
                    echo html_entity_decode("<link href='".OpenSms::getBaseUrl().OpenSms::DESIGN_PATH.
                        $view->content."' rel='stylesheet'/>");
                    break;
                case OpenSms::VIEW_TYPE_SCRIPT:
                    echo html_entity_decode("<script src='".OpenSms::getBaseUrl().OpenSms::DESIGN_PATH.
                        $view->content."' type='text/javascript'></script>");
                    break;
                case OpenSms::VIEW_TYPE_HTML:
                case OpenSms::VIEW_TYPE_RAW:
                    if($view->isFile) require_once(OpenSms::DESIGN_PATH.$view->content);
                    else echo (($view->type==OpenSms::VIEW_TYPE_HTML)?html_entity_decode($view->content):$view->content);
                    break;
            }
        }
    }

    protected function renderContent($key, array $htmlAttributes = array()){
        $content = OpenSms::getContent($key);
        if($content->Key){
            $attributes = "";
            $class_added = false;
            //$content->Host = $content->Type == OpenSms::VIEW_TYPE_HTML? 'div': $content->Host;
            $edit_class = $content->Type == OpenSms::VIEW_TYPE_HTML? 'editable':'raw_editable';

            foreach($htmlAttributes as $att=>$value){
                if(strtolower(trim($att)) == 'class')
                { $value .= " $edit_class"; $class_added = true;}

                $attributes .= "$att='$value' ";
            }
            if(!$class_added){
                $attributes .= " class='$edit_class'";
            }
            $html = "<$content->Host $attributes data-cms='content' data-cms-type='$content->Type' data-cms-key='$content->Key' data-cms-id='$content->Id'>
                    $content->Body</$content->Host>";
            echo ($html);
        }
    }

    protected function getImage($key){
        return OpenSms::getImage($key);
    }

   protected function filter($filterName, $content = ''){
       throw new ErrorException();
   }

   protected function redirect($url){
       OpenSms::redirect($url);
   }

    protected function redirectToAction($action, $controller = '', $module = '', array $routeParam = null){
        OpenSms::redirectToAction($action, $controller, $module, $routeParam);
    }

    protected function setError($message, $key)
    {
        OpenSms::setError($message, $key);
    }

    protected function setNotification($message, $key){
        OpenSms::setNotification($message, $key);
    }

    protected function printError(){
        throw new ErrorException();
    }

    public $securedPage;

    public function getCurrentUser(){
        return OpenSms::getCurrentUser();
    }

    protected function requestIsAuthenticated(){
        return OpenSms::requestIsAuthenticated();
    }

    public function checkLogin($role = ''){
        $user = OpenSms::checkLogin($role);
        $this->data['user'] = $user;
        return $user;
    }

    protected function isUserInRole($role){
        return OpenSms::isUserInRole($role);
    }

    //image upload
    public function uploadImage($fileKey, $rootFolder, &$img_name){

        require('app/code/opensms/helper/ImageEditor.php');

        //reads the name of the file the user submitted for uploading

		$image=$_FILES[$fileKey]['name'];

		//if it is not empty

		if ($image) 

		{

		    //get the original name of the file from the clients machine

			    $filename = stripslashes($_FILES[$fileKey]['name']);

		    //get the extension of the file in a lower case format

			    $extension = $this->getExtension($filename);

			    $extension = strtolower($extension);

	     if (($extension != "jpg") && ($extension != "jpeg") && ($extension !=

	     "png") && ($extension != "gif")) 

			    {

			    //print error message

				    $erro_msg = 'Unaccepted format! Please upload .jpg, .jpeg, .gif or .png format';

				    $errors=1;

			    }

			    else

			    {
				

	                 $size=filesize($_FILES[$fileKey]['tmp_name']);

	

	                //compare the size with the maxim size we defined and print error if bigger

                    /*
	                if ($size > MAX_SIZE*1024)

	                {

		                $error_msg = 'Image too large! Please upload a smaller image';

		                $errors=1;

	                }
                    */

	

	                
                    $image_name=$img_name.'.'.$extension;

	                $newname= $rootFolder.$image_name;

	                //we verify if the image has been uploaded, and print error instead

	                $copied = copy($_FILES[$fileKey]['tmp_name'], $newname);

                    $img_name = $newname;
	                if (!$copied) 

	                {
		                $image = new SimpleImage();

		                $image->load($newname);
		                //$image->resizeToWidth(217);
		                $image->save($newname);

		                $error_msg = 'Unable to upload image! Please contact the web master';

		                $errors=1;

	                }
	                else
	                {
                        $noError = TRUE;		
	                }
	            }
        }

    }

    private function getExtension($str) {

			 $i = strrpos($str,".");

			 if (!$i) { return ""; }

			 $l = strlen($str) - $i;

			 $ext = substr($str,$i+1,$l);

			 return $ext;

	 }

    protected function sendSmsAlert(OpenSms_Model_Transaction $transaction){
        $user = $this->loadModel('OpenSms_Model_User', array(0 => $transaction->LoginId));

        if($transaction->Type == OpenSms::OPEN_TRANSACTION_TYPE_DEBIT){
            $message = "Hello $transaction->LoginId. $transaction->Unit SMS units have been removed from your account for the clearing of your dept. Thanks for your patronage";
        }else{
            $message = "Hello $transaction->LoginId. You have correctly bought #$transaction->Amount SMS." .
                " Your account have been credited with $transaction->Unit SMS units. Your account balance is $user->Balance. Thanks for your patronage";
        }

        $this->sendMessage("OpenBulkSMS", $message, $user->MobileNo, $user->LoginId);
        $this->sendEmail('Open Bulk SMS Alert', $user->EmailId, $message, 'invoice@openbulksms.com');
    }

    //sending sms
    protected function sendMessage($sender, $message, $recepients, $loginId = '', $sendOnDate = '2/2/2'){

         if(empty($loginId)){
            $loginId = $_SESSION['loginId'];
         }

         $user = $this->loadModel('OpenSms_Model_User', array(0 => $loginId));

         //senitizing number
         $recepients = str_replace(' ', '', trim($recepients));//take out spcae
         $recepients = str_replace(PHP_EOL, '', trim($recepients));//take out new lines
         $recepients = str_replace('+', '', $recepients);
         if(substr($recepients, 0, 1) == '0')
             $recepients = '234'.substr($recepients, 1);

        $recepients = str_replace(',0', ',234', $recepients);

        $senNumbers = '';
        foreach (explode(',', $recepients) as $num) {
            if(empty($num)) continue;
            if(substr($num, 0, 1) != '2')
                $num = '234'.$num;
            $senNumbers .= $num.',';
        }

        $recepients = $senNumbers;

        //take away the 1st and last comma
         if(substr($recepients, 0, 1) == ',')
             $recepients = ''.substr($recepients, 1);

         if(substr($recepients, strlen($recepients) - 1, 1) == ',')
             $recepients = ''.substr($recepients, 0, strlen($recepients) - 1);


         //balance check
         $len = strlen($message);
         $lenPerSMS = $len < 160? 160:153;

         $msgNo = $len < $lenPerSMS? 1: ($len - $len % $lenPerSMS)/$lenPerSMS;
         $msgNo  = ($len > $lenPerSMS && $len % $lenPerSMS != 0)? $msgNo + 1: $msgNo;



         $notification = '';
         $hasError = FALSE;

         $count = ceil(count(explode(',', $recepients)) * $msgNo);

         $avu = ($user->Balance * 1);
         $unitsNeeded = ($count * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS));


         if($avu < $unitsNeeded){
             $notification = 'Insufficient SMS unit!';
             $hasError = TRUE;
         }else{
             if($count > 0 && !$hasError){

                 $url = OpenSms::getField('Sms_Send_Api')->value;

                 //replace username, password, senderId, message, recipients, sendOnDate
                 $url = str_replace('@username@', OpenSms::getField('Sms_Api_Username')->value, $url);
                 $url = str_replace('@password@', OpenSms::getField('Sms_Api_Password')->value, $url);
                 $url = str_replace('@senderId@', urlencode($sender), $url);
                 $url = str_replace('@message@', urlencode($message), $url);
                 $url = str_replace('@recipients@', trim($recepients), $url);



                 //die($url);


                 $url = str_replace('@sendOnDate@', $sendOnDate, $url);


                 //die($url.'<br/>');
                 $xml = file_get_contents($url);

                 //var_dump($xml);//die();
                 //<result>True</result>
                 //1701
                 //check if message sent and deduct

                 //var_dump(OpenSms::getField('Sms_Api_Success_Keyword')->value);
                 //var_dump(strpos(strtolower($xml), strtolower(OpenSms::getField('Sms_Api_Success_Keyword')->value))  !==  false);die();

                 if(strpos(strtolower($xml), strtolower(OpenSms::getField('Sms_Api_Success_Keyword')->value)) !== false){
                     $user->Balance -= ($count * OpenSms::getSystemSetting(OpenSms::OPEN_UNITS_PER_SMS));
                     $user->Save();
                     if(isset($_REQUEST['returnDetails']) && $_REQUEST['returnDetails'] == '1'){
                         $notification = $xml;
                     }else{
                         $notification = 'Message Sent';
                     }

                     $hasError = false;

                     $bulksSMS = $this->loadModel('OpenSms_Model_BulkSms');
                     $bulksSMS->LoginId = $user->LoginId;
                     $bulksSMS->Message = $message;
                     $bulksSMS->Sender = $sender;
                     $bulksSMS->Status = 1701;
                     $bulksSMS->Count = $count;
                     $bulksSMS->Save();

                     $messages = array();
                     $nos = explode(',', $recepients);
                     foreach($nos  as $no){
                         if(empty($no)){
                             continue;
                         }
                         $messageObj = $this->loadModel('OpenSms_Model_Message');
                         $messageObj->BulkSMSId = $bulksSMS->Id;
                         $messageObj->Number = $no;
                         $messageObj->Message = $message;
                         $messageObj->Sender = $sender;
                         $messageObj->RefId = -1;
                         $messageObj->Status = 1701;

                         $messages[] = $messageObj;
                     }

                     $bulksSMS->SaveMessages($messages);
                 }else{
                     $notification = "Error! Message not sent";
                 }

             }else{
                 if(!$hasError)
                     $notification = 'Please enter at least one number';
             }
         }

         return array('message'=>$notification, 'status' => $hasError);
     }

    protected function sendEmail($subject, $email, $body, $from, $isHtml = false)
    {
        $email = @trim(stripslashes($email));
        $subject = @trim(stripslashes($subject));


        $email_from = $from;

        $email_to = $email;//replace with your email


        if(!class_exists('PHPMailer')){
            include("app/code/opensms/helper/smtp/class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"
        }
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->IsHtml($isHtml);

        $mail->SMTPAuth = true;

        $mail->Host = 'mail.openbulksms.com';

        $mail->Username = $from;
        $mail->Password = '123@qwe';

        $mail->From = $from;
        $mail->FromName = "Open Bulk SMS";

        $mail->AddAddress($email_to,"Invoice");
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->WordWrap = 50;
        $mail->IsHTML(true);
        $str1= "gmail.com";
        $str2=strtolower($from);
        If(strstr($str2,$str1))
        {
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            if(!$mail->Send()) {
                $notMessage = "Mailer Error: " . $mail->ErrorInfo;
                $success = false;
            }
            else {
                $notMessage = "Message sent";
                $success = true;
            }
        }
        else{
            $mail->Port = 25;
            if(!$mail->Send()) {
                $notMessage = "Mailer Error: " . $mail->ErrorInfo;
                $success = false;
            }
            else {
                $notMessage = "Message sent";
                $success = true;
            }
        }

        return array('message' => $notMessage, 'success' => $success);
    }

    public static function echoContent($name, $includeImage = FALSE){
        $con = Content::GetContentByName($name);
        if($includeImage && !empty($con->ImageSrc))
            echo '<img src="'.$con->ImageSrc.'" style="float:left;" />';
        echo $con->Body;
    }
       
    public function deductAccount($qnt){
        if(!class_exists('OpenSms_Model_Login'))
            $this->loadModel('login');
        $token = new OpenSms_Model_Login();
        if(empty($loginId)){
            $url = API_URL.'api/SAPI/deductAccount?returnDetails=1&loginId='.API_USERNAME.
            '&password='.API_PASSWORD.'&r_token='.$token->Token.'&qnt='.$qnt;
            //die($url);
            $success = file_get_contents($url);
            //die($success);
            return $success;
        }
    }
}












