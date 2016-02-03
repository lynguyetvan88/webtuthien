<?php

class Admin_IndexController extends Zend_Controller_Action {

    public function init() {





        $baseurl = $this->_request->getbaseUrl();

        $title_admin = power;
        $this->view->headTitle("$title_admin");
        $this->view->headLink()->appendStylesheet($baseurl . '/css/css.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/simpletree.css');

        $this->view->headLink()->appendStylesheet($baseurl . '/hinh/chung.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/tutorial.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/uniform.default.css');


        //  admin moi
        $this->view->headLink()->appendStylesheet($baseurl . '/css/bootstrap-responsive.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/bootstrap-cerulean.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/charisma-app.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/jquery-ui-1.8.21.custom.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/fullcalendar.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/fullcalendar.print.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/chosen.css');

        $this->view->headLink()->appendStylesheet($baseurl . '/css/colorbox.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/jquery.cleditor.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/jquery.noty.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/noty_theme_default.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/elfinder.min.css');

        $this->view->headLink()->appendStylesheet($baseurl . '/css/elfinder.theme.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/jquery.iphone.toggle.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/opa-icons.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/uploadify.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/basic.css');

        $this->view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/simpletreemenu.js');
        $this->view->headScript()->appendFile($baseurl . '/fckeditor/fckeditor.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery-1.2.3.pack.js');
        $this->view->headScript()->appendFile($baseurl . '/js/runonload.js');
        $this->view->headScript()->appendFile($baseurl . '/js/tutorial.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.uniform.js');
        //$this->view->headScript()->appendFile($baseurl.'/js/form.js');
        // admin moi
        $this->view->headScript()->appendFile($baseurl . '/js/jquery-1.7.2.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery-ui-1.8.21.custom.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-transition.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-alert.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-modal.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-dropdown.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-scrollspy.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-tab.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-popover.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-button.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-collapse.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-carousel.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-typeahead.js');
        $this->view->headScript()->appendFile($baseurl . '/js/bootstrap-tour.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.cookie.js');
        $this->view->headScript()->appendFile($baseurl . '/js/fullcalendar.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.dataTables.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/excanvas.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.flot.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.flot.pie.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.flot.stack.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.flot.resize.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.chosen.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.uniform.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.colorbox.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.cleditor.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.noty.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.elfinder.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.raty.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.iphone.toggle.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.autogrow-textarea.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.uploadify-3.1.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery.history.js');
        $this->view->headScript()->appendFile($baseurl . '/js/charisma.js');


        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            if ($this->_request->getActionName() != 'login') {
                $this->_redirect('/login/index/login');
            }
        } else {
            $infoUser = $auth->getIdentity();
            $this->view->fullName = $infoUser->full_name;
            $this->view->username = $infoUser->username;
        }
    }

    public function indexAction() {
        
    }

    public function preDispatch() {

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            if ($this->_request->getActionName() != 'login') {
                $this->_redirect('/login/index/login');
            }
        }
    }

    public function loginAction() {

        $this->view->purifier = Zend_Registry::get('purifier');
        $conf = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($conf);
        if ($this->_request->isPost()) {

            //1.Goi ket noi voi Zend Db
            $db = Zend_Registry::get('connectDB');
            //$db = Zend_Db::factory($dbOption['adapter'],$dbOption['params']);
            //2. Khoi tao Zend Autho
            $auth = Zend_Auth::getInstance();

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
                $ss = new Zend_Session_Namespace('login');
                Zend_Registry::set('ly77', $ss);
                echo $ss->username = $this->_getParam('username');
                echo 'ere';
                $this->_redirect('/admin/index');
            }
        }
        //$this->_helper->viewRenderer->setNoRender(FALSE);
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_redirect('/login/index/login');
    }

    public function cauhinhAction() {
        $system = new Admin_Model_System();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $banner = stripslashes(($this->_request->getParam('banner')));
            $footer = stripslashes(($this->_request->getParam('footer')));
            $data = array(
                'title' => $title,
                'dis' => $dis,
                'key' => $key,
                'banner' => $banner,
                'email' => $purifier->purify($this->_request->getParam('email')),
                'company_name' => $purifier->purify($this->_request->getParam('company_name')),
                'address' => $purifier->purify($this->_request->getParam('address')),
                'phone' => $purifier->purify($this->_request->getParam('phone')),
                'fax' => $purifier->purify($this->_request->getParam('fax')),
                'hotline' => $purifier->purify($this->_request->getParam('hotline')),
                'zalo' => $purifier->purify($this->_request->getParam('zalo')),
                 'footer' => $footer,
            );
            $system->update_System($data);
        }
        $edit = $system->select_System();


        $this->view->books = $edit;
    }

    public function contactAction() {
        $system = new Admin_Model_System();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);

            $email = $purifier->purify($this->_request->getParam('email'));
            $content = (($this->_request->getParam('content')));

            $system->update_contact($email, $content);
        }
        $edit = $system->select_System();


        $this->view->books = $edit;
    }

    public function listcontactAction() {


        $muser = new Admin_Model_System();
        $paginator = Zend_Paginator::factory($muser->list_contact());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;
    }

    function deletecontactAction() {

        $del = new Admin_Model_System();
        $id = $this->_request->getParam('id');
        $del->delete_contact($id);
        trang_truoc();
    }

}
