<?php
//adding core engine files
require_once('app/code/opensms/helper/constant.php');
require_once('app/code/opensms/helper/StringMethods.php');
require_once('app/code/opensms/helper/db.php');
require_once('app/code/opensms/helper/html.php');
require_once('app/code/opensms/helper/Mobile_Detect.php');
require_once('app/code/opensms/model/system/base.php');


require_once('app/code/opensms/abstract/module/base.php');
require_once('app/code/opensms/abstract/module/controller.php');

class OpenSms{
    //constant
    const DESIGN_PATH = 'app/design/';
    const NO_IMAGE = 'app/skin/system/no_image.png';
    const SETTINGS_FILE_PATH = 'app/code/opensms/settings.xml';

    const CURRENT_THEME_KEY = 'opensms_current_theme';//theme is saved in the option table with this key


    //general
    const VERSION = 'open_sms_version';
    const SITE_NAME = 'site_name';
    const SITE_HOME_KEYWORD = 'site_home_keyword';
    const SITE_HOME_DESCRIPTION = 'site_home_description';
    const SITE_URL = 'site_url';
    const INSTALLATION_STATUS = 'installation_status';

    //database
    const DB_TYPE = 'opensms_db_type';
    const DB_HOST = 'opensms_db_host';
    const DB_NAME = 'opensms_db_name';
    const DB_TABLE_PREFIX = 'opensms_table_prefix';//prefix will be saved in the settings file with this key
    const DB_USERNAME = 'opensms_username';
    const DB_PASSWORD = 'opensms_password';

    //form method
    const FORM_POST_METHOD = 'post';
    const FORM_GET_METHOD = 'get';

    //session keys
    const LAST_TRANSACTION = 'last_transaction';

    //membership
    const OPEN_ROLE_ADMIN = 'enekpani';
    const OPEN_ROLE_USER = 'user';

    //transaction
    const OPEN_TRANSACTION_TYPE_CREDIT = 'CREDIT';
    const OPEN_TRANSACTION_TYPE_DEBIT = 'DEBIT';

    public static function getTransactionTypeArray(){
        return array(self::OPEN_TRANSACTION_TYPE_CREDIT, self::OPEN_TRANSACTION_TYPE_DEBIT);
    }

    const OPEN_TRANSACTION_STATUS_PENDING = 'Pending';
    const OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT = 'Awaiting Payment';
    const OPEN_TRANSACTION_STATUS_NOTIFICATION_SENT = 'Notification Sent';
    const OPEN_TRANSACTION_STATUS_PROCESSING = 'Processing';
    const OPEN_TRANSACTION_STATUS_COMPLETED = 'Completed';

    public static function getTransactionStatusArray(){
        return array(self::OPEN_TRANSACTION_STATUS_PENDING, self::OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT,
            self::OPEN_TRANSACTION_STATUS_NOTIFICATION_SENT,
            self::OPEN_TRANSACTION_STATUS_PROCESSING, self::OPEN_TRANSACTION_STATUS_COMPLETED);
    }

    //true if in dev
    const DEVELOPMENT = true;

    //SMS
    const OPEN_UNITS_PER_SMS = 'unit_per_sms';
    const OPEN_PRICE_PER_UNIT = 'price_per_unit';

    //options
    const OPEN_OPTION_YES = 'Yes';
    const OPEN_OPTION_NO = 'No';

    /** @var null The module */
    private static $module = null;

    private static $currentRoute;

    public static function setCurrentRoute(OpenSms_Model_System_Route $route){
        self::$currentRoute = $route;
    }
    public function getCurrentRoute(){
        return self::$currentRoute;
    }

    private static $isAdminPage = false;

    //static members
    public static function getCurrentModule()
    {
        return self::$module;
    }

    public static function setCurrentModule($module){
        self::$module = $module;
    }

    public static function isCurrentModule($module_name)
    {
        return strtolower(self::$module->name) == strtolower($module_name);
    }

    public static function getIsAdminPage(){
        return self::$isAdminPage;
    }

    public static function getDocumentRoot(){
        //return $_SERVER['DOCUMENT_ROOT'].'/opensms/';//demo
        return $_SERVER['DOCUMENT_ROOT'].'/';//live
    }

    public static function getBaseUrl(){
        //"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //return "http://$_SERVER[HTTP_HOST]/opensms/";//demo
        return "http://$_SERVER[HTTP_HOST]/"; //live
    }

    public static function getCurrentUrl(){
        return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    //settings

    private static $systemSettings = array();
    public static function getSystemSetting($key){
        if(!file_exists(self::SETTINGS_FILE_PATH)) return '';
        if(isset(self::$systemSettings[$key])) return (string)self::$systemSettings[$key];
        //load and set
        self::loadSystemSettings();
        return (string)self::$systemSettings[$key];
    }

    public static function  loadSystemSettings(){
        $xml=simplexml_load_file(self::SETTINGS_FILE_PATH);

        foreach($xml as $key=>$value){
            self::$systemSettings[$key] = $value;
        }
    }

    //theme
    public static function getCurrentTheme(){
        return new OpenSms_Model_System_Theme(self::getSystemSetting(OpenSms::CURRENT_THEME_KEY));
    }

    private static $tablePrefix;
    public static function getTablePrefix(){
        if(self::$tablePrefix != NULL) return self::$tablePrefix;
        self::$tablePrefix = self::getSystemSetting(self::DB_TABLE_PREFIX);
        return self::$tablePrefix;
    }

    public static function getTableName($name){
        return self::getTablePrefix().$name;
    }

    private static $modelRegistry = array();
    public static function loadModelRegistry()
    {
        self::$modelRegistry = array();
        $xml=simplexml_load_file('app/code/opensms/model/registry.xml');

        //var_dump($xml);die();
        foreach($xml->model as $modelMeta){
            $model_meta = new OpenSms_Model_System_ModelMeta((string)$modelMeta->key,
                (string)$modelMeta->class_name, (string)$modelMeta->file_path);
            self::$modelRegistry[$model_meta->key] = $model_meta;
        }

    }

    public static function getModelRegistry(){
        if(!count(self::$modelRegistry))
            self::loadModelRegistry();
        return self::$modelRegistry;
    }

    private function getModelMeta($model_name){
        try {
            $model_meta = null;
            if (isset(self::$module->modelRegistry[$model_name]))
                $model_meta = self::$module->modelRegistry[$model_name];
            else {
                $reg = self::getModelRegistry();
                if(!isset($reg[$model_name]))
                    die('Error in getting Model Meta: ' . $model_name . '. Model not registered');
                $model_meta = $reg[$model_name];
            }

            if(!class_exists('OpenSms_Model_Abstract_ModelBase'))
                require_once('app/code/opensms/model/abstract/modelBase.php');
            if(!class_exists($model_meta->className))
                require_once($model_meta->filePath);

            return $model_meta;
        } catch (Exception $e) {
            die('Error in getting Model Meta: ' . $model_name);
        }
    }

    public static function loadModel($model_name, array $param = null)
    {
        try {
            $model_meta = self::getModelMeta($model_name);

            return $param == null? new $model_meta->className() : new $model_meta->className($param);
        } catch (Exception $e) {
            if(self::DEVELOPMENT) print_r($e);
            die('<br/>Error in loading Model: ' . $model_name);
        }
    }

    public static function callModelStaticMethod($model_name, $method, array $param = null){
        $model_meta = self::getModelMeta($model_name);
        try{
            if(!isset($param[0]))
                return call_user_func($model_meta->className.'::'. $method);
            elseif(!isset($param[1]))
                return call_user_func($model_meta->className.'::'. $method, $param[0]);
            elseif(!isset($param[2]))
                return call_user_func($model_meta->className.'::'. $method, $param[0], $param[1]);
            else
                return call_user_func($model_meta->className.'::'. $method, $param[0], $param[1], $param[2]);

        }catch (ErrorException $ex){
            die($ex->getMessage());
        }
    }

    //payment methods
    public static function getPaymentMethod($_key, $loadController = false){
        return OpenSms_Model_System_Payment::getPaymentMethod($_key, $loadController);
    }

    public static function getPaymentMethods(){
        return OpenSms_Model_System_Payment::getPaymentMethods();
    }

    //module fields
    public static function getField($key){
        return OpenSms_Model_System_Module::getField($key);
    }

    //url encoding and decoding
    public static function urlEncode($string) {
        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, $string);
    }
    public static function urlDecode($string) {
        $replacements  = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
        return str_replace($entities, $replacements, $string);
    }
    //redirect
    public static function redirect($url){
        header('Location: '.$url);
        exit();
    }

    public static function redirectToLocal($uri){
        self::redirect(self::getBaseUrl().$uri);
    }

    public static function getActionUrl($action, $controller = '', $module = '', array $param = null, array $queryString = null)
    {
        $uri = self::getBaseUrl();
        if(empty($module))
            $module = self::$module->name;
        $uri .= strtolower($module).'/';

        if($controller != '*') {
            if (empty($controller) && strtolower($module) == strtolower(OpenSms::$module->name))
                $controller = self::getCurrentRoute()->controller;

            if (strtolower($controller) != strtolower($module))
                $uri .= strtolower($controller) . '/';
        }

        $uri .= (strtolower($action) == 'index' && empty($param['parameter1']))?'': strtolower($action);

        if($param != null) {
            if (isset($param[0])) $param['parameter1'] = self::urlEncode($param[0]);
            if (isset($param[2])) $param['parameter2'] = self::urlEncode($param[1]);
            if (isset($param[3])) $param['parameter3'] = self::urlEncode($param[2]);


            if (isset($param['parameter1']))
                $uri .= '/' . $param['parameter1'];
            if (isset($param['parameter2']))
                $uri .= '/' . $param['parameter2'];
            if (isset($param['parameter3']))
                $uri .= '/' . $param['parameter3'];
        }

        if($queryString != null){
            $uri .= '?';
            foreach($queryString as $key=>$value) {
                $uri .= $key . '=' . $value . '&';
                $qExist = true;
            }
            $uri = isset($qExist)?substr($uri, 0, strlen($uri) - 1):$uri;
        }

        return $uri;
    }

    public static function getPermaUrl($permalink){
        return self::getBaseUrl().$permalink;
    }

    /*
     * make a new request to an action in a specific controller for the specified module.
     * the $routeInfo takes action, controller, module, parameter1, parameter2, and parameter13
     * to build the uri
     */
    public static function redirectToAction($action, $controller = '', $module = '', array $param = null, $error_code = 0){
        self::redirect(self::getActionUrl($action, $controller, $module, $param));
    }

    public static function splitUriString($uri){
        $urlParts = explode('/', $uri);
        $result = array();
        if(isset($urlParts[2])){
            $result[0] = $urlParts[2];
            $result[1] = $urlParts[1];
            $result[2] = $urlParts[0];
        }
        elseif(isset($urlParts[1])){
            $result[0] = $urlParts[1];
            $result[1] = $urlParts[0];
            $result[2] = self::getCurrentModule()->name;
        }
        else{
            $result[0] = $urlParts[0];
            $result[1] = self::getCurrentRoute()->contoller;
            $result[2] = self::getCurrentModule()->name;
        }
        return $result;
    }

    public static function pageNotFound($url){
        self::runAction('before_page_not_found', [0 => $url]);
        self::redirectToAction('index', 'notfound', 'error');
    }

    //membership
    private static $currentUser = null;
    public static function getCurrentUser(){
        if(isset($_REQUEST['callback'])){
            $user = self::loadModel('OpenSms_Model_User', array(0=>$_REQUEST['LoginId'], 1=>$_REQUEST['Password']));
            return $user->IsValidated? $user : null;
        }
        if(empty($_SESSION) || !isset($_SESSION['loginId'])) return null;
        if(self::$currentUser != null) return self::$currentUser;
        self::$currentUser = self::checkLogin();//to be changed so as to return null
        return self::$currentUser;
    }

    public static function jSonp($data, $callback = 'callback'){
        return $callback.'('. json_encode($data).')';
    }
    //get user from the session variable or the request loginId and password or from the token
    //if role is specified check if the use is in the role
    public static function checkLogin($role = ''){
        if(isset($_SESSION['loginId'])) {
            $user = self::loadModel('OpenSms_Model_User', array(0 => $_SESSION['loginId']));
        }elseif(isset($_REQUEST['callback'])){
            if(empty($_REQUEST['loginId'])|| empty($_REQUEST['password'])){
                echo self::jSonp(array('error'=>TRUE, 'message'=> 'Username and password is required'));
                exit();
            }
            $user = self::loadModel('OpenSms_Model_User', array(0 => $_REQUEST['loginId'], 1=> $_REQUEST['password']));
            if(!$user->IsValidated){
                echo self::jSonp(array('error'=>TRUE, 'message'=> 'Invalid Credential'));
                exit();
            }
        }else{
            $token = self::loadModel('OpenSms_Model_Login');
            if($token->Validated()){
                $user = self::loadModel('OpenSms_Model_User', array(0 => $token->LoginId));

            }
        }

        if(isset($user)){
            $_SESSION['loginId'] = $user->LoginId;
            $_SESSION['role'] = $user->Role;
        }else{
            self::setError('Please login to continue', 'checkLogin_OpenSms');
            OpenSms::redirectToAction('login', 'account', 'account');
        }

        if(!empty($role)){
            if($user->Role != $role){
                self::setError('Access denied. You must be an admin to perform that operation', 'checkLogin_OpenSms');
                OpenSms::redirectToAction('login', 'account', 'admin');
            }
        }
        return $user;
    }

    //message
    public static function setError($message, $key)
    {
        if(!isset($_SESSION['error']))
            $_SESSION['error'] = array();
        $_SESSION['error'][$key] = $message;
    }

    public static function setNotification($message, $key){
        if(!isset($_SESSION['notification']))
            $_SESSION['notification'] = array();
        $_SESSION['notification'][$key] = $message;
    }

    public static function requestIsAuthenticated(){
        if(isset($_SESSION['loginId']))
            return TRUE;

        if(isset($_REQUEST['callback'])){
            $user = self::loadModel('OpenSms_Model_User', array(0 => $_REQUEST['LoginId'], 1=> $_REQUEST['Password']));
            return $user->IsValidated;
        }

        if(isset($_COOKIE['passToken'])){
            $token  = self::loadModel('OpenSms_Model_Login');
            return $token->Validated();
        }

        return FALSE;
    }

    public static function isUserInRole($role){
        return self::getCurrentUser()->Role == $role;
    }


    //rendering views, script and styles from action
    const VIEW_POSITION_TOP = 'top';
    const VIEW_POSITION_BODY = 'body';
    const VIEW_POSITION_FOOTER = 'footer';

    const VIEW_TYPE_RAW = 'raw';
    const VIEW_TYPE_HTML = 'html';
    const VIEW_TYPE_STYLE = 'style';
    const VIEW_TYPE_SCRIPT = 'script';

    static $viewCollection = array();
    public static function registerView($key, $content, $type, $position, $isFile = true){
        $view = new OpenSms_Model_System_View($key, $content, $type, $isFile, $position);
        self::$viewCollection[$key] = $view;
    }

    public static function getViews($position){
        $views = array();
        foreach(self::$viewCollection as $v){
            if($v->position == $position)
                $views[] = $v;
        }
        return $views;
    }


    //actions
    const BEFORE_RENDER_ACTION = 'before_render';
    public static function runAction($key, array $params = []){
        foreach (OpenSms_Model_System_Action::getAll() as $action) {
            if($action->key == $key){
                try{
                    if(!class_exists($action->class)) require_once('app/code/'.$action->fileName);
                    call_user_func($action->class.'::'. $action->method, $params);
                }catch (ErrorException $ex){
                    die('Error while calling action: '.$action->toString(). $ex->getMessage());
                }
            }
        }

    }

    //cms
    //when a request is made for a content. try getting it from the db via the content model. If not found
    //load from file(if not already loaded) and try getting again
    private static $contentLoaded = false;
    private static function loadContent($key){
        $content = self::loadModel("OpenSms_Model_Content", array(0 => $key));
        if(self::$contentLoaded) return $content;
        $theme = self::getCurrentTheme();
        if($theme->cms)
        foreach ($theme->cms->content as $c) {
            $con = self::loadModel("OpenSms_Model_Content");
            $con->Key = (string)$c->key;
            $con->Type = (string)$c->type;
            $con->Host = (string)$c->host;
            $con->Body = (string)$c->body;
            $con->Save();
            if($con->Key == $key) $content = $con;
        }
        self::$contentLoaded = true;
        return $content;
    }

    public static function getContent($key){
        $content = self::loadModel("OpenSms_Model_Content", array(0=>$key));
        if(!isset($content->Id)) $content = self::loadContent($key);
        return $content;
    }


    //images
    private static $images = array();
    public static function getImages($fullPart = true){
        if(count(self::$images)) return self::$images;
        $images = array();
        //general
        $dir = 'app/skin/assets/images';
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $names = explode('.', $entry);
                    $name = $names[0];
                    $images[$name] = $fullPart? OpenSms::getBaseUrl().$dir.'/'.$entry : $dir.'/'.$entry;
                }
            }
            closedir($handle);
        }

        //current theme
        $themeName = self::getCurrentTheme()->name;
        $dir = "app/skin/$themeName/assets/images";
        if ($handle = opendir($dir)) {
            $themeImages = array();
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $names = explode('.', $entry);
                    $name = $names[0];
                    $themeImages[$name] = $fullPart? OpenSms::getBaseUrl().$dir.'/'.$entry : $dir.'/'.$entry;
                }
            }
            closedir($handle);
        }

        $images[OpenSms::CURRENT_THEME_KEY] = $themeImages;
        self::$images = $images;
        return self::$images;
    }

    public static function getGalleryImages($fullPart = true){
        //current theme
        $themeName = self::getCurrentTheme()->name;
        $dir = "app/skin/$themeName/assets/images/gallery";
        if ($handle = opendir($dir)) {
            $themeImages = array();
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $names = explode('.', $entry);
                    $name = $names[0];
                    $themeImages[$name] = $fullPart? OpenSms::getBaseUrl().$dir.'/'.$entry : $dir.'/'.$entry;
                }
            }
            closedir($handle);
            return $themeImages;
        }
        return false;
    }

    public static function getImage($key, $fullPart = true){
        $images = self::getImages($fullPart);
        if(isset($images[OpenSms::CURRENT_THEME_KEY][$key])) return $images[OpenSms::CURRENT_THEME_KEY][$key];
        if(isset($images[$key])) return $images[$key];
        return $images['no_images'];
    }

    const CONTACT_MESSAGE_STATUS_NONE  = 0;
    const CONTACT_MESSAGE_STATUS_NEW  = 1;
    const CONTACT_MESSAGE_STATUS_READ  = 2;
    const CONTACT_MESSAGE_STATUS_CLOSED  = 3;

    //instance members
    /** @var null The module_name */
    private $module_name = null;

    /** @var null The controllerFilePath */
    private $url_controllerFilePath = null;

    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameter one */
    private $url_parameter_1 = null;

    /** @var null Parameter two */
    private $url_parameter_2 = null;

    /** @var null Parameter three */
    private $url_parameter_3 = null;

    private $url = null;
    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

        //if not installed and the url is not of install goto install
        if($this->getSystemSetting(self::INSTALLATION_STATUS) != 'installed' && (strtolower($this->url_controller) != 'install')){
            self::redirectToAction('index', 'install', 'admin');
        }
        //var_dump(self::getCurrentModule()); die();
        //$cntr_file = './app/code/'.self::$module->path.'/'.self::$module->name.'/'.$this->url_controller.'.php';
        $cntr_file = './app/code/'.$this->url_controllerFilePath;

        //die($cntr_file);

        if (file_exists($cntr_file)) {

            // if so, then load this file and create this controller
            // example: if controller would be "sms", then this line would translate into: $this->sms = new sms();
            require_once $cntr_file;

            $this->url_controller = new $this->url_controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {
                // call the method and pass the arguments to it
                if (isset($this->url_parameter_3)) {
                    // will translate to something like $this->home->method($param_1, $param_2, $param_3);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                    exit();
                } elseif (isset($this->url_parameter_2)) {
                    // will translate to something like $this->home->method($param_1, $param_2);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                    exit();
                } elseif (isset($this->url_parameter_1)) {
                    // will translate to something like $this->home->method($param_1);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1);
                    exit();
                } else {
                    // if no parameters given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}();
                    exit();
                }
            } elseif(method_exists($this->url_controller, 'index')) {
                // default/fallback: call the index() method of a selected controller
                //header('Location: '.URL.$this->url_controller.'?notification=Page not found&error_code=1');
                //exit();
                $this->url_controller->index();
                exit();
            }
        }
        // invalid URL, so simply show home/index
        if(!empty($this->url_controller)){
            self::pageNotFound($this->url);
        }
        require './app/code/main/home/home.php';
        $home = new Home(self::$module->name);
        $home->index();
        exit();
        
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        //var_dump($_GET); die();
        $_GET['q'] = isset($_GET['q'])?$_GET['q']:'home';
        if (isset($_GET['q'])) {
            // split URL
            $url = rtrim($_GET['q'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $this->url = $url;
            $url = explode('/', $url);

            //flag for admin page
            $is_admin_page = strtolower($url[0]) == 'admin';
            self::$isAdminPage = $is_admin_page;

            // first key in the url is our module name
            $this->module_name = (isset($url[0]) && $url[0] != null ? $url[0] : 'home');

            //get the module
            self::$module = OpenSms_Model_System_Module::getModule($this->module_name);

            //print_r(self::$module);die();

            if(!self::$module->exists) {
                self::pageNotFound($this->url);
            }

            $current_route = null;
            //print_r(self::$module->routes);die();
            //get the selected route(first search for default then a single path 'home' then 'home/index'
            //module :: uri = *
            if(empty($url[1]) && strtolower(self::$module->name) == strtolower($url[0])){
                foreach(self::$module->routes as $route) {
                    if(strtolower((string)$route->uri) == '*')
                    {
                        $current_route = $route;
                        $param_start_index = 1;
                        goto use_route;
                    }
                }
            }
            //module/action :: uri = */action
            if(!empty($url[1]))
                foreach(self::$module->routes as $route) {
                    $route_parts = explode("/", $route->uri);
                    if (empty($route_parts[1])) continue;
                    if ($route_parts[0] == '*' &&  strtolower($route_parts[1]) == strtolower($url[1])) {
                        $current_route = $route;
                        $param_start_index = 2;
                        goto use_route;
                    }
                }

            //module/controller or module/action where module == controller
            foreach(self::$module->routes as $route){
                if(strtolower($url[0]).(!empty($url[1])?'/'.strtolower($url[1]):'') == strtolower((string)$route->uri)){
                    $current_route = $route;
                    $param_start_index = 2;
                }
            }
            //module/controller/action
            foreach(self::$module->routes as $route){
                if(strtolower($url[0]).(!empty($url[1])?'/'.strtolower($url[1]):'').(!empty($url[2])?'/'.strtolower($url[2]):'') == strtolower((string)$route->uri)){
                    $current_route = $route;
                    $param_start_index = 3;
                }
            }

            /*

            foreach(self::$module->routes as $route){
                $module_name_is_controller_name = strtolower(self::$module->name) == strtolower($route->controller);
                if(strtolower((string)$route->uri) == $module_name_is_controller_name ? strtolower($url[1]) : strtolower($url[0])) {
                    $current_route = $route;
                    $param_start_index = $module_name_is_controller_name ? 2 : 1;
                }
            }


            //if(($is_admin_page && isset($url[2]) || (!$is_admin_page && isset($url[1]))))
                foreach(self::$module->routes as $route){
                    $module_name_is_controller_name = strtolower(self::$module->name) == strtolower($route->controller);
                    $route_compare = ($module_name_is_controller_name ? strtolower($url[1]).(!empty($url[2])?'/'.strtolower($url[2]):'') :
                        strtolower($url[0]).(!empty($url[1])?'/'.strtolower($url[1]):''));
                    if(strtolower((string)$route->uri) == $route_compare)
                    {
                        $current_route = $route;
                        $param_start_index = $module_name_is_controller_name ? 3 : 2;
                    }
                }

            */

            use_route:

           //var_dump($current_route);die();
            if(!isset($current_route)){
                //check cms pages and show if exists
                self::pageNotFound($this->url);
            }

            self::$currentRoute = $current_route;

            $this->url_controllerFilePath = $current_route->filePath;
            $this->url_controller = $current_route->controller;
            $this->url_action = $current_route->action;

            $this->url_parameter_1 = (isset($url[$param_start_index]) ? self::urlDecode($url[$param_start_index]) : null);
            $this->url_parameter_2 = (isset($url[$param_start_index + 1]) ? self::urlDecode($url[$param_start_index + 1]) : null);
            $this->url_parameter_3 = (isset($url[$param_start_index + 2]) ? self::urlDecode($url[$param_start_index + 2]) : null);
        }
    }
}
