<?php
//adding core engine files
require_once('app/code/opensms/helper/constant.php');
require_once('app/code/opensms/helper/StringMethods.php');
require_once('app/code/opensms/helper/db.php');
require_once('app/code/opensms/helper/html.php');
require_once('app/code/opensms/model/system/base.php');


require_once('app/code/opensms/abstract/module/base.php');
require_once('app/code/opensms/abstract/module/controller.php');

class OpenSms{
    //constant
    const DESIGN_PATH = 'app/design/';
    const NO_IMAGE = 'app/skin/system/no_image.png';
    const SETTINGS_FILE_PATH = 'app/code/opensms/settings.xml';

    const CURRENT_THEME = 'opensms_current_theme';//theme is saved in the option table with this key


    //general
    const VERSION = 'open_sms_version';
    const SITE_NAME = 'site_name';
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
        return [self::OPEN_TRANSACTION_TYPE_CREDIT, self::OPEN_TRANSACTION_TYPE_DEBIT];
    }

    const OPEN_TRANSACTION_STATUS_PENDING = 'Pending';
    const OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT = 'Awaiting Payment';
    const OPEN_TRANSACTION_STATUS_NOTIFICATION_SENT = 'Notification Sent';
    const OPEN_TRANSACTION_STATUS_PROCESSING = 'Processing';
    const OPEN_TRANSACTION_STATUS_COMPLETED = 'Completed';

    public static function getTransactionStatusArray(){
        return [self::OPEN_TRANSACTION_STATUS_PENDING, self::OPEN_TRANSACTION_STATUS_AWAITING_PAYMENT,
            self::OPEN_TRANSACTION_STATUS_NOTIFICATION_SENT,
            self::OPEN_TRANSACTION_STATUS_PROCESSING, self::OPEN_TRANSACTION_STATUS_COMPLETED];
    }

    //SMS
    const OPEN_UNITS_PER_SMS = 'unit_per_sms';
    const OPEN_PRICE_PER_UNIT = 'price_per_unit';

    //options
    const OPEN_OPTION_YES = 'Yes';
    const OPEN_OPTION_NO = 'No';

    public static function getDocumentRoot(){
        return $_SERVER['DOCUMENT_ROOT'].'/';
    }

    /** @var null The module */
    private static $module = null;

    private static $currentRoute;

    public function getCurrentRoute(){
        return self::$currentRoute;
    }

    private static $isAdminPage = false;

    //static members
    public static function getCurrentModule()
    {
        return self::$module;
    }


    public static function isCurrentModule($module_name)
    {
        return strtolower(self::$module->name) == strtolower($module_name);
    }

    public static function getIsAdminPage(){
        return self::$isAdminPage;
    }


    public static function getBaseUrl(){
        //"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return "http://$_SERVER[HTTP_HOST]/";// 'http://www.openbulksms.com/';//this will be gotten from server variable in production
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
                if(!isset(self::getModelRegistry()[$model_name]))
                    die('Error in getting Model Meta: ' . $model_name . '. Model not registered');
                $model_meta = self::getModelRegistry()[$model_name];
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
            die('Error in loading Model: ' . $model_name);
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
            if (isset($param[0])) $param['parameter1'] = $param[0];
            if (isset($param[2])) $param['parameter2'] = $param[1];
            if (isset($param[3])) $param['parameter3'] = $param[2];

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

    public static function pageNotFound(){
        self::redirectToAction('index', 'notfound', 'error');
    }

    //membership
    private static $currentUser = null;
    public static function getCurrentUser(){
        if(isset($_REQUEST['callback'])){
            $user = self::loadModel('OpenSms_Model_User', [0 => $_REQUEST['LoginId'], 1=> $_REQUEST['Password']]);
            return $user->IsValidated? $user : null;
        }
        if(empty($_SESSION) || !isset($_SESSION['loginId'])) return null;
        if(self::$currentUser != null) return self::$currentUser;
        self::$currentUser = self::checkLogin();//to be changed so as to return null
        return self::$currentUser;
    }

    //get user from the session variable or the request loginId and password or from the token
    //if role is specified check if the use is in the role
    public static function checkLogin($role = ''){
        if(isset($_SESSION['loginId'])) {
            $user = self::loadModel('OpenSms_Model_User', [0 => $_SESSION['loginId']]);
        }elseif(isset($_REQUEST['callback'])){
            $user = self::loadModel('OpenSms_Model_User', [0 => $_REQUEST['LoginId'], 1=> $_REQUEST['Password']]);
            if(!$user->IsValidated){
                echo jsonp(array('error'=>TRUE, 'message'=> 'Invalid Credential'));
                exit();
            }
        }else{
            $token = self::loadModel('OpenSms_Model_Login');
            if($token->Validated()){
                $user = self::loadModel('OpenSms_Model_User', [0 => $token->LoginId]);

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
            $user = self::loadModel('OpenSms_Model_User', [0 => $_REQUEST['LoginId'], 1=> $_REQUEST['Password']]);
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
            self::pageNotFound();
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
        $_GET['q'] = isset($_GET['q'])?$_GET['q']:'home';
        if (isset($_GET['q'])) {
            // split URL
            $url = rtrim($_GET['q'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url_path = $url;
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
                self::pageNotFound();
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

           // var_dump($current_route);die();
            if(!isset($current_route)){
                self::pageNotFound();
            }

            self::$currentRoute = $current_route;

            $this->url_controllerFilePath = $current_route->filePath;
            $this->url_controller = $current_route->controller;
            $this->url_action = $current_route->action;

            $this->url_parameter_1 = (isset($url[$param_start_index]) ? $url[$param_start_index] : null);
            $this->url_parameter_2 = (isset($url[$param_start_index + 1]) ? $url[$param_start_index + 1] : null);
            $this->url_parameter_3 = (isset($url[$param_start_index + 2]) ? $url[$param_start_index + 2] : null);
        }
    }
}

