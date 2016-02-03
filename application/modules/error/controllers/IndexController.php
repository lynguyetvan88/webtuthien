<?php

class IndexController extends Zend_Controller_Action{
    
    public function init() {
       $this->view->headTitle('hello ');
        $this->view->headLink()->appendStylesheet('http://zend/css/css.css');
    }

    public function indexAction(){
       // $db=  Zend_Db::factory('pdo_mysql',array('dbname'=>'zendfw','host'=>'localhost','username'=>'root','password'=>''));
       
        $filename=APPLICATION_PATH.'/configs/config.ini';
        $config= new Zend_Config_Ini($filename);
        $config = $config->toArray();
        $configdb=$config['db'];
        $adapter=$configdb['adapter'];
        $params=$configdb[$adapter]['params'];
        $db=  Zend_Db::factory($adapter,$params);
        
        var_dump($db);
//        $userModel= new Default_Model_User();
//        $userModel->addUser(array('name'=>'abc',
//            'password'=>'123456',
//            'fullname'=>'this is fullname'));
//        $array_pdo= array(
//            'id'=>'10',
//            'name'=>'abc',
//            'password'=>'123456',
//            'fullname'=>'this is fullname',
//        );
//        $userModel->addUser($array_pdo);
//        // $userModel->select();
//        
//        $test= new My_Db_Mysql();
//        $test->test();
        $this->_helper->viewRenderer->setNoRender(true);
    }
   
}
?>
