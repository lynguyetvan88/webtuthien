<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{
    protected function _initSession(){ 
    Zend_Session::start(); 
}  
    protected function _getMyConfig(){
        $conf=new Zend_Config_Ini(APPLICATION_PATH."/configs/config.ini","db");
        $conf=$conf->toArray();
      
        Zend_Registry::set('conf', $conf);
        
        
//        $filename=APPLICATION_PATH.'/configs/config.ini';
//        $config= new Zend_Config_Ini($filename);
//        $config = $config->toArray();
//        $configdb=$config['db'];
//        $adapter=$configdb['adapter'];
//        $params=$configdb[$adapter]['params'];
//        $db=  Zend_Db::factory($adapter,$params);
    }
    
    protected function _initDb() {

    $dbOption = $this->getOption('resources');
    $dbOption = $dbOption['db'];

    // Setup database
    $db = Zend_Db::factory($dbOption['adapter'], $dbOption['params']);

    $db->setFetchMode(Zend_Db::FETCH_ASSOC);
    $db->query("SET NAMES 'utf8'");
    $db->query("SET CHARACTER SET 'utf8'");

    Zend_Registry::set('connectDB', $db);

    //Khi thiet lap che do nay model moi co the su dung duoc
    Zend_Db_Table::setDefaultAdapter($db);

    // Return it, so that it can be stored by the bootstrap
    return $db;
}
    protected function _setAutoload(){
        Zend_Loader_Autoloader::getInstance()->registerNamespace('My_');
        //Zend_Loader_Autoloader::getInstance()->setFallbackAutoloader(TRUE);
    }

    public function run() {
        // khoi tao session
        $session = new Zend_Session_Namespace('lyle');
        Zend_Registry::set('session', $session);
        // session->ke
        
        
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->registerPlugin(new My_Controller_Plugin);
        $this->_initDb();
        $this->_getMyConfig();
        $this->_initCachemanager();
        $this->_setAutoload();
        
        
        // mat dinh chay ve module -> default, controoller-> Errorcontroller, action -> errorAction
        $frontController->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(
                array
                    ('module'=>'error',
                    'controller'=>'error', 
                    'action'=>'error',)
                ));
        $this->_initRouter() ;
        $this->_zendlog();
     
        $frontController->dispatch();
    }
    
    private function _initRouter()
    {
      
        
         $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', 'production');
        $router->addConfig($config,'routes');
        
      
        
        
    }
    public function _initFilter(){
     
       
        HTMLPurifier_Bootstrap::registerAutoload();
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Attr.EnableID',true);
        $config->set('HTML.Strict',true);
        Zend_Registry::set('purifier',new HTMLPurifier($config));
    }
    private function  _zendlog ()
    {
        $write= new Zend_Log_Writer_Stream(APPLICATION_PATH.'/log/log.txt');
        
        $format=new Zend_Log_Formatter_Simple('%message%');
        $write->setFormatter($format);
        $log = new Zend_Log($write); 
        $log->info('thong bao', Zend_Log::INFO);
        $log->err('thong bao loi', Zend_Log::ERR);
        
        
        
        
        
//        $write= new Zend_Log_Writer_Stream(APPLICATION_PATH.'/log/log.txt');
//        
//        $log->info('thong bao', Zend_Log::INFO);
//        $log->err('thong bao loi', Zend_Log::ERR);
//       
//        
//         
//         $log = new Zend_Log($write);
    }
    
    protected function _initCachemanager(){
    $cache = Zend_Cache::factory(
        'Core',
        'File',
        array(
            'lifetime' => 3600, // 1h
            'automatic_serialization' => true
        ),
        array('CACHE_DIR' => APPLICATION_PATH.'/cache')
    );
    Zend_Db_Table_Abstract::setDefaultMetadataCache($cache); //cache database table schemata metadata for faster SQL queries
    Zend_Registry::set('Cache', $cache);
    }
    
    protected function _initMail()
    {
        try {
            
            
            $config = array(
                'auth' => 'login',
                'username' => 'dadichvu.88@gmail.com',
                'password' => 'itwebsite',
                'ssl' => 'ssl',
                'timeout' => 30,
                'port' => 465
            );
    
            $mailTransport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
            Zend_Mail::setDefaultTransport($mailTransport);
        } catch (Zend_Exception $e){
            //Do something with exception
        }
    }
    
    
}
?>
