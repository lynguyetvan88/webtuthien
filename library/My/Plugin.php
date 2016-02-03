<?php


class My_Controller_Plugin extends Zend_Controller_Plugin_Abstract
{
    protected $_auth;
    protected $_acl;
    
    public function routeStartup(Zend_Controller_Request_Abstract $request) {
        parent::routeStartup($request);
    }
    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        $moduleName=($request->getModuleName());
        
            Zend_Layout::startMvc();
            $layout = Zend_Layout::getMvcInstance();
            switch ($moduleName) {
            case 'admin': {
                $layout->setLayoutPath(APPLICATION_PATH.'/layouts/scripts/'.$moduleName);
                $layout->setLayout('admin');
                break; 
            }
            
            case 'login': {
                $layout->setLayoutPath(APPLICATION_PATH.'/layouts/scripts/'.$moduleName);
                $layout->setLayout('login');
                break; 
            }
           
            default: {
                $layout->setLayoutPath(APPLICATION_PATH.'/layouts/scripts/default');
                $layout->setLayout('layout');
                break;
            }
            }
           
            

        $frontController=  Zend_Controller_Front::getInstance();
        $frontController->setBaseUrl('http://dangtintoanquoc.com/');
        
        $view=  Zend_Layout::getMvcInstance()->getView();
        $view->addHelperPath(APPLICATION_PATH."/layouts/helpers");
		 $wew=new Zend_View();
       $wew->baseUrl();
    }
    function preDispatch(Zend_Controller_Request_Abstract $request) {
       
        
              $auth = Zend_Auth::getInstance();
              
      if($auth->hasIdentity()){
         $info = $auth->getIdentity();
         $level = $info->group_name;
          // luu cookie
        $value=$info->username;
        setcookie("test", $value, time()+3600);
        // doc cookie
        $test = $this->_request->getCookie('test');
        
            
//        if($test == FALSE){
//            $auth = Zend_Auth::getInstance();
//	    $auth->clearIdentity();
//            $vew=new Zend_View();
//           $ct= $vew->baseurl('/login/index/login');
//           chuyen_trang($ct);
//            }
         $role = "";
         switch($level){
            case 1: $role = "seller"; break;
            case 2: $role = "user"; break;
            case 3: $role = "amo"; break;
            default :$role = "admin"; break;
         }
        
      }
 else {
      $role='';    
      }

        $acl= new Zend_Acl();
       // khai bao cac  nhom phan quyen
        $acl->addRole(new Zend_Acl_Role('amo'))
         ->addRole(new Zend_Acl_Role('user'),'amo')
         ->addRole(new Zend_Acl_Role('seller'),'user')
         ->addRole(new Zend_Acl_Role('admin'));
        
       //Khai bao cac resource (News - blog -production
        
     $acl->add(new Zend_Acl_Resource('login:index'));
     
   
        
     $acl->add(new Zend_Acl_Resource('default',NULL));
     $acl->add(new Zend_Acl_Resource('default:index'), 'default');
      $acl->add(new Zend_Acl_Resource('default:register'), 'default');
     $acl->add(new Zend_Acl_Resource('default:error'), 'default');
     $acl->add(new Zend_Acl_Resource('default:page'), 'default');
     $acl->add(new Zend_Acl_Resource('default:product'), 'default');
      
      $acl->add(new Zend_Acl_Resource('error'));
      $acl->add(new Zend_Acl_Resource('error:error'), 'error');
        
     $acl->add(new Zend_Acl_Resource('admin'));
     $acl->add(new Zend_Acl_Resource('admin:index'), 'admin');
     $acl->add(new Zend_Acl_Resource('admin:link'), 'admin');
     $acl->add(new Zend_Acl_Resource('admin:page'), 'admin');
     $acl->add(new Zend_Acl_Resource('admin:product'), 'admin');
     $acl->add(new Zend_Acl_Resource('admin:side'), 'admin');
     $acl->add(new Zend_Acl_Resource('admin:support'), 'admin');
     $acl->add(new Zend_Acl_Resource('admin:user'), 'admin');
      //khai bao danh sach cac action ma nhom co quyen truy cap
    
      
    $acl->allow("amo", "login:index",null );
    $acl->allow("amo", "default",null );
    $acl->allow('amo', "admin:index", "index");
    $acl->deny('amo', "admin", NULL);
    $acl->allow("user", "admin",null );
     $acl->deny('user', "admin:user", null);
    $acl->deny('user', "admin:product", 
            array( 
                    'listcategory',
                    'listmenu',
                    'listproducts',
  
              )
            );
    
   $acl->deny('user', "admin:page", 
            array( 
                    'listpage',
                    'listpages',
 
              )
); 
     
       $acl->allow("seller", "admin",null );
       $acl->deny('user', "admin:user", null);
       $acl->allow('admin',NULL,NULL);
      
      $module = $request->getModuleName();
      $controller = $request->getControllerName();
      $action=$request->getActionName();
     //$_pg=$acl->isAllowed($role,$module.':'.$controller,$action);
    if($role!='')
    {
        if (!$acl->isAllowed($role,$module.':'.$controller,$action)){
            thongbao('Bạn ko có quyền truy cập vào modules này');
            $view= new Zend_View();
            $bse=$view->baseUrl();
           chuyen_trang($bse);
            //var_dump($ada);
        
      }
    }

      

    }
    
    
}