<?php

class Admin_VideoController extends Zend_Controller_Action {

    public function init() {


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

        $baseurl = $this->_request->getbaseurl();

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

        // $this->view->headScript()->appendFile('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
        $this->view->headScript()->appendFile($baseurl . '/js/simpletreemenu.js');
        $this->view->headScript()->appendFile($baseurl . '/fckeditor/fckeditor.js');
        $this->view->headScript()->appendFile($baseurl . '/js/jquery-1.2.3.pack.js');
        $this->view->headScript()->appendFile($baseurl . '/js/runonload.js');
        $this->view->headScript()->appendFile($baseurl . '/js/tutorial.js');
        //$this->view->headScript()->appendFile($baseurl.'/js/jquery.uniform.js');
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
    }

    public function preDispatch() {

        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            if ($this->_request->getActionName() != 'login') {
                $this->_redirect('/login/index/login');
            }
        }
    }

    public function listvideoAction() {

        $muser = new Admin_Model_Video();
        $paginator = Zend_Paginator::factory($muser->list_video());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;
    }

    function addvideoAction() {


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);

            $title = $purifier->purify($this->_request->getParam('title'));
            $link = $purifier->purify($this->_request->getParam('link'));
            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));

            $data = array(
                "title" => $title,
                "link" => $link,
                "position" => $position,
                "active" => $active,
                "create_date" => time(),
            );
            $add = new Admin_Model_Video();
            $add->insert_video($data);
        }
    }

    function editvideoAction() {


        $system = new Admin_Model_Video();

        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));
            $link = $purifier->purify($this->_request->getParam('link'));
            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));

            $data = array(
                "title" => $title,
                "link" => $link,
                "position" => $position,
                "active" => $active,
                "create_date" => time(),
            );
            $id = $this->_request->getParam('id');
            $system->update_video($data, $id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_video($id);
        $this->view->books = $edit;
    }

    function deletevideoAction() {

        $del = new Admin_Model_Video();
        $id = $this->_request->getParam('id');
        $del->delete_support($id);
        die;
    }
     function activeAction() {

        $del = new Admin_Model_Video();
        $id = $this->_request->getParam('id');
        $active = $this->_request->getParam('active');
        if($active==1)
            $active=2;
        else $active=1;  
        $data = array("active"=>$active);
        $del->update_video($data,$id);
        die;
    }

}

?>
