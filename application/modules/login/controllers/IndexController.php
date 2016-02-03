<?php

class Login_IndexController extends Zend_Controller_Action{
   
   public function indexAction()
    { 
        # If we're already logged in, just redirect
        if(Zend_Auth::getInstance()->hasIdentity())
        {
           
            $this->_redirect('index/index');
        }

        $request = $this->getRequest();
        $loginForm = $this->getLoginForm();

        $errorMessage = "";

        if($request->isPost())
        {
            if($loginForm->isValid($request->getPost()))
            {

                $authAdapter = $this->getAuthAdapter();

                # get the username and password from the form
                $username = $loginForm->getValue('username');
                $password = $loginForm->getValue('password');

                # pass to the adapter the submitted username and password
                $authAdapter->setIdentity($username)
                            ->setCredential($password);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                # is the user a valid one?
                if($result->isValid())
                {
                    # all info about this user from the login table
                    # ommit only the password, we don't need that
                    $userInfo = $authAdapter->getResultRowObject(null, 'password');

                    # the default storage is a session with namespace Zend_Auth
                    $authStorage = $auth->getStorage();
                    $authStorage->write($userInfo);

                    $this->_redirect('index/index');
                }
                else
                {
                    $errorMessage = "Wrong username or password provided. Please try again.";
                }
            }
        }
        $this->view->errorMessage = $errorMessage;
        $this->view->loginForm = $loginForm;
    }
    
    public function loginAction()
	{
       
     //  $this->_helper->layout()->disableLayout(); 
    //$this->_helper->viewRenderer->setNoRender(true);
    
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
                // $authAdapter->setCredential(md5($paswd));
	        $authAdapter->setCredential(sha1(salt.$paswd));
                
	        //6. Kiem tra trang thai cua user neu status = 1 moi duoc login
	        $select = $authAdapter->getDbSelect();
	        $select->where('status = 1');
	
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
	        if ($flag == true) {
	            $this->_redirect('/admin/index');
	        }
	    }
            //$this->_helper->viewRenderer->setNoRender(FALSE);
	}

    public function logoutAction()
    {
        # clear everything - session is cleared also!
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('login/index');
    }

    /**
     * Gets the adapter for authentication against a database table
     *
     * @return object
     */
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
}
?>
