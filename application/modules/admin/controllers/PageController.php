<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PageController
 *
 * @author user
 */
class Admin_PageController extends Zend_Controller_Action {

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
        //  $this->view->headScript()->appendFile($baseurl.'/js/jquery.uniform.js');
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

    function indexAction() {
        $system = new Admin_Model_Page();



        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));
            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));
            $cat_page = $purifier->purify($this->_request->getParam('cat_page'));
            $cat_page_id = $purifier->purify($this->_request->getParam('cat_page_id'));
            $content = stripslashes($this->_request->getParam('content'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));

            $system->add_Page($title, $cat_page, $position, $active, $content, $cat_page_id, $key, $dis);
        }
    }

    function listpageAction() {

        $muser = new Admin_Model_Page();
        $paginator = Zend_Paginator::factory($muser->list_Page());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;
        $this->view->idmenu = $this->_request->getParam('idmenu');
    }

    function editpageAction() {
        $system = new Admin_Model_Page();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));
            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));
            $cat_page = $purifier->purify($this->_request->getParam('cat_page'));
            $content = stripslashes($this->_request->getParam('content'));
            $id = $this->_request->getParam('id');
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $cat_page_id = $purifier->purify($this->_request->getParam('cat_page_id'));
            $system->update_Page($title, $cat_page, $position, $active, $content, $id, $key, $dis, $cat_page_id);
            $this->_redirect('/admin/page/editpage/id/'.$id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_Page_1($id);
        $this->view->books = $edit;
        $this->view->cat_page_id = $edit[0]['cat_page_id'];
    }

    function deletepageAction() {

        $del = new Admin_Model_Page();
        $id = $this->_request->getParam('id');
        $del->delete_Page($id);
        trang_truoc();
    }

    function deletepagesAction() {

        $del = new Admin_Model_Page();
        $id = $this->_request->getParam('id');
        $menu = $del->list_Pages_1($id);
        $this->view->bookss = $menu;
    }

//    them trang moi


    function addpagesAction() {

        $muser = new Admin_Model_Page();
        $paginator = Zend_Paginator::factory($muser->option_page());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(10);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;

        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $menu = $purifier->purify($this->_request->getParam('cat_page_id'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $description = $purifier->purify($this->_request->getParam('description'));
            $home = $purifier->purify($this->_request->getParam('home'));

            $upload = new Zend_File_Transfer_Adapter_Http();
            $images = $upload->getFilename();
            $images = basename($images);

            $url = khongdau($title);
            $random_digit = rand(00000, 99999);
            $img = time() . $url . "-" . $images;
            $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $img, 'overwrite' => false,));
            $upload->addFilter($filterRename);
            $upload->receive();
            $img_1_2 = APPLICATION_PATH . "/../Upload/$img";
            $img_2 = time() . ".png";
            $img_2_2 = APPLICATION_PATH . "/../Upload/$img_2";
            rename($img_1_2, $img_2_2);
            $img = $img_2;
            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));

            $content = stripslashes($this->_request->getParam('content'));
            $address = $purifier->purify($this->_request->getParam('address'));
            $add = new Admin_Model_Page();
            $add->insert_page($menu, $title, $dis, $key, $description, $img, $position, $active, $content, $home, $address);
        }
    }

    function listpagesAction() {

        $muser = new Admin_Model_Page();
        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $cat_page_id = $purifier->purify($this->_request->getParam('cat_page_id'));
            $title = $purifier->purify($this->_request->getParam('title'));
            if (!empty($cat_page_id) && empty($title)) {
                $data = " where menu=$cat_page_id";
                $paginator = Zend_Paginator::factory($muser->list_Pages($data));
            }
            if (empty($cat_page_id) && !empty($title)) {
                $data = " where title like '%$title%'";
                $paginator = Zend_Paginator::factory($muser->list_Pages($data));
            }
            if (!empty($cat_page_id) && !empty($title)) {
                $data = " where title like '%$title%' and menu=$cat_page_id";
                $paginator = Zend_Paginator::factory($muser->list_Pages($data));
            }
        } else {
            $paginator = Zend_Paginator::factory($muser->list_Pages());
        }

        //Số user trên một trang
        $paginator->setItemCountPerPage(15);

        //Số trang được hiện ra để click
        $paginator->setPageRange(5);

        //Lấy trang hiện tại
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);

        //Truyền dữ liệu ra view
        $this->view->books = $paginator;
    }

    function editpagesAction() {
        $system = new Admin_Model_Page();

        $paginator = Zend_Paginator::factory($system->option_page());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(10);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->bookss = $paginator;
        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $menu = $purifier->purify($this->_request->getParam('menu'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $description = $purifier->purify($this->_request->getParam('description'));
            $position = $purifier->purify($this->_request->getParam('position'));

            $active = $purifier->purify($this->_request->getParam('active'));
            $home = $purifier->purify($this->_request->getParam('home'));
            $address = $purifier->purify($this->_request->getParam('address'));
            $content = stripslashes($this->_request->getParam('content'));
            $img = $purifier->purify($this->_request->getParam('images'));
            $test = $_FILES['images']['name'];
            if ($test == '') {
                $images123 = $purifier->purify($this->_request->getParam('images_hiden'));
            } else {

                $upload = new Zend_File_Transfer_Adapter_Http();
                $images = $upload->getFilename();
                $images = basename($images);

                $random_digit = rand(00000, 99999);
                $img = $random_digit . $images;
                $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $img, 'overwrite' => false));
                $upload->addFilter($filterRename);
                $upload->receive();
                $img_1_2 = APPLICATION_PATH . "/../Upload/$img";
                $img_2 = time() . ".png";
                $img_2_2 = APPLICATION_PATH . "/../Upload/$img_2";
                rename($img_1_2, $img_2_2);
                $images123 = $img_2;
            }
            $id = $this->_request->getParam('id');
            $system->update_Pages($menu, $title, $dis, $key, $description, $images123, $position, $active, $content, $home, $address, $id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_Pages_1($id);
        $this->view->books = $edit;
        $this->view->id = $id;
    }

    function useractiveAction() {

        $del = new Admin_Model_Page();
        $id = $this->_request->getParam('id');
        $active = $this->_request->getParam('active');
        $del->update_user_active($active, $id);
    }

    function pagesactiveAction() {

        $del = new Admin_Model_Page();
        $id = $this->_request->getParam('id');
        $active = $this->_request->getParam('active');
        $del->update_pages_active($active, $id);
    }

}

?>
