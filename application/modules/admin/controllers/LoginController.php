<?php

/**
 * Description of LoginController
 *
 * @author robert
 */
class Admin_LoginController extends Zend_Controller_Action
{
    public function indexAction()
    {
        # If we're already logged in, just redirect
       
        var_dump(  $this->view->purifier = Zend_Registry::get('purifier'));
        
        $baseurl=$this->_request->getbaseUrl();
      
        $this->view->headLink()->appendStylesheet($baseurl.'/hinh/chung.css');
        $this->view->headScript()->appendFile($baseurl.'/jquery.js');
        
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
                
               $conf=  HTMLPurifier_Config::createDefault();
               $purifier = new HTMLPurifier($conf);
                $user=$purifier ->purify("<script></script>");
                var_dump($user); exit;
                # get the username and password from the form
                $username = $purifier->purify($loginForm->getValue('username'));
                $password = $purifier->purify($loginForm->getValue('password'));               
                $password = $purifier->purify((salt.$password));
                
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
