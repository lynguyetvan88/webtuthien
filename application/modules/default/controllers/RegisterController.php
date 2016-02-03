<?php

class RegisterController extends Zend_Controller_Action{
    
    public function init() {
       $baseurl=$this->_request->getbaseurl();
      
       
        $this->view->headScript()->appendFile($baseurl.'/jquery.js');
        $this->view->headLink()->appendStylesheet($baseurl.'/css/validationEngine.jquery.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/MyStyles.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/styles.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/juizDropDownMenu.css');
         $this->view->headLink()->appendStylesheet($baseurl.'/template/images/menu_doc.css');
          
        
        $this->view->headScript()->appendFile($baseurl.'/js/jquery-1.8.2.min.js');
      
    }
 function  indexAction()
    {
         $captcha = new Zend_Captcha_Image();
        $vi=new Zend_View();
        $base=$vi->baseurl();
       if(!$this->_request->isPost()){
           $captcha->setTimeout('300')               
                 ->setWordLen('4')
                 ->setHeight('50')        
                 ->setWidth('320')   
                 ->setImgDir(APPLICATION_PATH . '/../public_html/captcha/images/')
                 ->setImgUrl($base.'/captcha/images/')
                 ->setFont(APPLICATION_PATH .'/../public_html/font/AHGBold.ttf'); 
         
          $captcha->generate(); 
          $this->view->captcha = $captcha->render($this->view);  
          $this->view->captchaID = $captcha->getId();
            // Dua chuoi Captcha vao session
          $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha->getId());
          $captchaSession->word = $captcha->getWord();
          
      }else{
                  
         $captchaID = $this->_request->captcha_id; 
         
         $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captchaID);
         $captchaIterator = $captchaSession->getIterator();
         $captchaWord = $captchaIterator['word'];

         if($this->_request->captcha == $captchaWord){
            $system= new Default_Model_User();
            
            $exist= new Admin_Model_User();
            $user=$this->_request->getParam('username');
            
            $pass1=$this->_request->getParam('password');
            
            $pass2=$this->_request->getParam('re_password');
            $ex=$exist->list_user_2($user);
           if ($ex==2)
            {
                if($pass1==$pass2)
                    {
                        $this->view->purifier = Zend_Registry::get('purifier');
                        $conf=  HTMLPurifier_Config::createDefault();
                        $purifier = new HTMLPurifier($conf);
                        $username = $purifier->purify($this->_request->getParam('username'));
                        $password = $purifier->purify(md5($this->_request->getParam('password')));
                        $email = $purifier->purify($this->_request->getParam('email'));
                        $full_name= $purifier->purify($this->_request->getParam('full_name'));
                        $phone = $purifier->purify($this->_request->getParam('phone'));
                        $birth = $purifier->purify($this->_request->getParam('birth'));
                        $sex = $purifier->purify($this->_request->getParam('sex'));
                        $address = $purifier->purify($this->_request->getParam('address'));
                        $system->add_User($username, $password, $email, $full_name, 0, 3, $phone, $birth, $sex, $address);
                        thongbao('Chúc mừng bạn đã đăng ký thành công');
                        chuyen_trang($base);
                    }
            }
        else {thongbao("User này đã tồn tại");trang_truoc();}
         
         }else{
           
             thongbao('Ban nhap sai chuoi Captcha');
             //trangtruoc();
         }
        $this->_helper->viewRenderer->setNoRender();
        $mask = APPLICATION_PATH."/../public_html/captcha/images/*.png"; 
        array_map("unlink",glob($mask)); 

      }
        
    }
     function  membersAction()
    {
          $muser= new Default_Model_User();
                
                
                 if ($this->_request->isPost()) 
                {
                  $this->view->purifier = Zend_Registry::get('purifier');
                $conf=  HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($conf);     
                  $title=  $purifier->purify($this->_request->getParam('title'));
                
                $paginator = Zend_Paginator::factory($muser->list_products_title($title));
                 //Số user trên một trang
               	$paginator->setItemCountPerPage(15);
                
                //Số trang được hiện ra để click
		$paginator->setPageRange(5);
                
                //Lấy trang hiện tại
		$currentPage = $this->_request->getParam('page',1);
 		$paginator->setCurrentPageNumber($currentPage);
                
                //Truyền dữ liệu ra view
		$this->view->books=$paginator;
                
              
                }
                 else { 
                       // $list=$muser->list_products_member();
                        $paginator = Zend_Paginator::factory($muser->list_products_member());
                        //Số user trên một trang
                	$paginator->setItemCountPerPage(15);
                
                        //Số trang được hiện ra để click
                        $paginator->setPageRange(5);
                
                        //Lấy trang hiện tại
                        $currentPage = $this->_request->getParam('page',1);
                        $paginator->setCurrentPageNumber($currentPage);
                
                        //Truyền dữ liệu ra view
                        $this->view->books=$paginator;
                        
                        
                        $system= new Admin_Model_Category();
                        $menu= $system->option_menu();
                        $this->view->bookss=$menu;
                 }
                 
                
                            
    }
    function  postingAction()
    {
          $captcha = new Zend_Captcha_Image();
        $vi=new Zend_View();
        $base=$vi->baseurl();
        
        $muser= new Admin_Model_Page();
        $paginator = Zend_Paginator::factory($muser->option_page());
        $paginator->setItemCountPerPage(10);		
        $paginator->setPageRange(10);
        $currentPage = $this->_request->getParam('page',1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books=$paginator;

        $system=new Admin_Model_Category();
         $menu= $system->option_menu();
        $this->view->bookss=$menu;


        $district= $system->option_dictrict();
        $this->view->bokk=$district;


       if(!$this->_request->isPost()){
           $captcha->setTimeout('300')               
                 ->setWordLen('4')
                 ->setHeight('60')        
                 ->setWidth('320')   
                 ->setImgDir(APPLICATION_PATH . '/../public_html/captcha/images/')
                 ->setImgUrl($base.'/captcha/images/')
                 ->setFont(APPLICATION_PATH .'/../public_html/font/AHGBold.ttf')
                  ->setFontSize(24);
                 
         
          $captcha->generate(); 
          $this->view->captcha = $captcha->render($this->view);  
          $this->view->captchaID = $captcha->getId();
            // Dua chuoi Captcha vao session
          $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha->getId());
          $captchaSession->word = $captcha->getWord();
          
      }else{
                  
         $captchaID = $this->_request->captcha_id; 
         
         $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captchaID);
         $captchaIterator = $captchaSession->getIterator();
         $captchaWord = $captchaIterator['word'];

         if($this->_request->captcha == $captchaWord){ 
              

       
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf=  HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
              $content = $purifier->purify($this->_request->getParam('content'));
            $menu_id = $purifier->purify($this->_request->getParam('parent_id'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $description = $purifier->purify($this->_request->getParam('description'));
           // $home = $purifier->purify($this->_request->getParam('home'));
            
            $upload = new Zend_File_Transfer();
            $images= $upload->addValidator('Extension', false, 'jpg,png,gif');
            //print_r($images, FALSE) ;
            $images = $upload->getFilename();
            $images = basename($images);
           
           $url=  khongdau($title);
             $random_digit=rand(00000,99999);
             if(basename($images))
             {
                 
             $img=$url."-".$random_digit.$images;
             $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $img, 'overwrite' => false, ));
             $upload->addFilter($filterRename);
             if(! $upload->receive()){                
                 thongbao("Vui lòng nhập đúng định dạng hình ảnh");
                 trang_truoc();                                  
                 return;}
             $upload->receive();
             
             } 
            else {$img=="no-img.png";}
           // $position = $purifier->purify($this->_request->getParam('position'));
          //  $active = $purifier->purify($this->_request->getParam('active'));
            
          
            $price = $purifier->purify($this->_request->getParam('price'));
            
            
             $state = $purifier->purify($this->_request->getParam('state'));
             $sales = $purifier->purify($this->_request->getParam('sales'));
             $made_in = $purifier->purify($this->_request->getParam('made_in'));
             //$members = $purifier->purify($this->_request->getParam('members'));
              $session = new Zend_Session_Namespace('identity');
              $members =$session->username;
             $dictrict_id = $purifier->purify($this->_request->getParam('dictrict_id'));
           //  $type = $purifier->purify($this->_request->getParam('type'));
            
            $add= new Admin_Model_Products();
            $add->insert_products($title, $description, $img, $content, $menu_id, $price, $state, $sales, $dis, $key, "", 1, 2, $made_in,$members,$dictrict_id,1);
            
            thongbao("Chúc mừng $members, bạn đã đăng tin thành công");
            chuyen_trang($base."/thanh-vien.html");
             
            
         
         }else{
             thongbao('Ban nhap sai chuoi Captcha');
             trang_truoc();
         }
        $this->_helper->viewRenderer->setNoRender();
        $mask = APPLICATION_PATH."/../public_html/captcha/images/*.png"; 
        array_map("unlink",glob($mask)); 

      }
    }
      function  logoutAction()
    {
          $vi=new Zend_View();
        $base=$vi->baseurl();
           Zend_Session::namespaceUnset('identity');
           chuyentrang($base);
    }
     function  loginAction()
    {
        
         $this->view->purifier = Zend_Registry::get('purifier');
              $conf=  HTMLPurifier_Config::createDefault();
               $purifier = new HTMLPurifier($conf);
	    if ($this->_request->isPost()) {
	
	        //1.Goi ket noi voi Zend Db
	        $db = Zend_Registry::get('connectDB');
	        //$db = Zend_Db::factory($dbOption['adapter'],$dbOption['params']);
	        //2. Khoi tao Zend Autho
	        $auth = Zend_Auth::getInstance ();
	
	        //3. Khai bao bang va 2 cot se su dung so sanh trong qua tronh login
	        $authAdapter = new Zend_Auth_Adapter_DbTable($db);
	        $authAdapter->setTableName('users')
	                ->setIdentityColumn('username')
	                ->setCredentialColumn('password');
	
	        //4. Lay gia tri duoc gui qua tu FORM
                $uname = $purifier->purify($this->_request->getParam('username'));
                $paswd = $purifier->purify($this->_request->getParam('password'));
                
	       // $uname = $this->_request->getParam('username');
	       // $paswd = $this->_request->getParam('password');
	
	        //5. Dua vao so sanh voi du lieu khai bao o muc 3
	        $authAdapter->setIdentity($uname);
	        $authAdapter->setCredential(md5($paswd));
	
	        //6. Kiem tra trang thai cua user neu status = 1 moi duoc login
	        $select = $authAdapter->getDbSelect();
	       // $select->where('status = 1');
	
	        //7. Lay ket qua truy van
	        $result = $auth->authenticate($authAdapter);
	        $flag = false;
	        if ($result->isValid()) {
	            //8. Lay nhung du lieu can thiet trong bang users neu login thanh cong				
	            $data = $authAdapter->getResultRowObject(null, array('password'));
	
	            //9. Luu  nhung du lieu cua member vao session
	            $auth->getStorage()->write($data);
	            $flag = true;
	        }
                 $session = new Zend_Session_Namespace('identity');
	        if ($flag == true) {
	           // $this->_redirect('/admin/index');
                   
                    $session->username = $uname;
                    
                  // echo "thanh cong";
	        }
                else {
                       Zend_Session::namespaceUnset('identity');
                     //   echo "khong thanh cong";
                     }
	    }
            //$this->_helper->viewRenderer->setNoRender(FALSE);
    }
    
     protected function getAuthAdapter()
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('login')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('MD5(?)');
                    
        return $authAdapter;
    }

    /**
     * Create and return the login form
     *
     * @return object
     */
    protected function getLoginForm()
    {
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:')
                ->setRequired(true);

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('login');
        $submit->setLabel('Login');

        $loginForm = new Zend_Form();
        $loginForm->setAction($this->_request->getBaseUrl().'/login/index/')
                ->setMethod('post')
                ->addElement($username)
                ->addElement($password)
                ->addElement($submit);

        return $loginForm;
    }
    
     function menuAction()
    {
          $this->_helper->layout()->disableLayout(); 
    $this->_helper->viewRenderer->setNoRender(true);
        $id=$this->_request->getParam('id');
        $mn=new Admin_Model_Products();
        $mn->hop_option($id);
     
            
             
    }
    function updateproductsAction()
    {
        $system= new Admin_Model_Products();
           
                
        if ($this->_request->isPost()) 
        {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf=  HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $menu_id = $purifier->purify($this->_request->getParam('parent_id'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $description = $purifier->purify($this->_request->getParam('description'));
            $home = $purifier->purify($this->_request->getParam('home'));
            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));
            
            $content = $purifier->purify($this->_request->getParam('content'));
            
            $price = $purifier->purify($this->_request->getParam('price'));
            
            
             $state = $purifier->purify($this->_request->getParam('state'));
              $sales = $purifier->purify($this->_request->getParam('sales'));
               $made_in = $purifier->purify($this->_request->getParam('made_in'));
               
               
                $session = new Zend_Session_Namespace('identity');
              $members =$session->username;
              
               $dictrict_id = $purifier->purify($this->_request->getParam('dictrict_id'));
               $type = $purifier->purify($this->_request->getParam('type'));
               
              $img= $purifier->purify($this->_request->getParam('images'));
              $test=$_FILES['images']['name'];
              if ($test=='') {
                  $images123=$purifier->purify($this->_request->getParam('images_hiden'));
              }
            else {
                
            $upload = new Zend_File_Transfer_Adapter_Http();
            $images = $upload->getFilename();
            $images = basename($images);
        
             $random_digit=rand(00000,99999);
             $img=$random_digit.$images;
             $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $random_digit.$images, 'overwrite' => false));
             $upload->addFilter($filterRename);
             $upload->receive();
             $images123=$img;   
                }
            $id=  $this->_request->getParam('id');
            
            $system->update_products_mm($title, $description, $images123, $content, $menu_id, $price, $state, $sales, $dis, $key, "", 1, 2, $made_in,$members,$dictrict_id,1, $id);
            
            }
        $id=  $this->_request->getParam('id');
        $edit= $system->list_products_1($id);       
        $this->view->books=$edit;
       
        
         $this->view->id=  $this->_request->getParam('id');
         $this->view->menu_id=  $this->_request->getParam('menu_id');
         
         $dt= new Admin_Model_Category();
         $district= $dt->option_dictrict();
         $this->view->bokk=$district;
         
          $menu= $dt->option_menu();
          $this->view->bookss=$menu;
          
          $mn= $dt->list_menu_1($this->_request->getParam('menu_id'));
          $this->view->book_s=$mn;
                              
    }
    
       function updateusersAction()
    
        { 
           $id=  $this->_request->getParam('id');
            $system=new Default_Model_User();
       if ($this->_request->isPost()) 
        {
          
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf=  HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $email = $purifier->purify($this->_request->getParam('email'));
            $full_name = $purifier->purify($this->_request->getParam('full_name'));
            $phone = $purifier->purify($this->_request->getParam('phone'));
            $birth = $purifier->purify($this->_request->getParam('birth'));
            $sex = $purifier->purify($this->_request->getParam('sex'));
            $address = $purifier->purify($this->_request->getParam('address'));
           $id=  $this->_request->getParam('id');
           
            $system->update_Users($full_name, $email, $phone, $birth, $sex, $address, $id);
            
         }
         $users=$system->list_users($id);
         $this->view->user=$users;
            
    }
    
   
     function updatedateAction()
    {
          $this->_helper->layout()->disableLayout(); 
    $this->_helper->viewRenderer->setNoRender(true);
        $del= new Admin_Model_Products();
        $id=  $this->_request->getParam('id');
        $del->update_date($id);
        thongbao('Tin của bạn đã được làm mới');
        trang_truoc();
    }
   
   
}
?>
