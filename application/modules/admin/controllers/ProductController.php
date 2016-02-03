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
class Admin_ProductController extends Zend_Controller_Action {

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

    function addcategoryAction() {
        $system = new Admin_Model_Category();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));

            $system->add_category($title);
        }
    }

    function adddistrictAction() {
        $system = new Admin_Model_Category();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $category = $purifier->purify($this->_request->getParam('category'));
            $position = $purifier->purify($this->_request->getParam('position'));

            $system->add_district($category, $position);
        }
    }

    function listcategoryAction() {

        $muser = new Admin_Model_Category();
        $paginator = Zend_Paginator::factory($muser->list_category());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;
    }

    function listdistrictAction() {

        $muser = new Admin_Model_Category();
        $paginator = Zend_Paginator::factory($muser->list_district());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;
    }

    function editcategoryAction() {
        $system = new Admin_Model_Category();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));

            $id = $this->_request->getParam('id');
            $system->update_category($title, $id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_Page_1($id);
        $this->view->books = $edit;
    }

    function editdistrictAction() {
        $system = new Admin_Model_Category();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $category = $purifier->purify($this->_request->getParam('category'));
            $position = $purifier->purify($this->_request->getParam('position'));

            $id = $this->_request->getParam('id');
            $system->update_district($category, $position, $id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_Page_2($id);
        $this->view->books = $edit;
    }

    function deletecategoryAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $del = new Admin_Model_Category();
        $id = $this->_request->getParam('id');
        $del->delete_category($id);
        trang_truoc();
    }

    function deletedistrictAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $del = new Admin_Model_Category();
        $id = $this->_request->getParam('id');
        $del->delete_district($id);
        trang_truoc();
    }

    function deletepagesAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $del = new Admin_Model_Page();
        $id = $this->_request->getParam('id');
        $del->delete_Pages($id);
        trang_truoc();
    }

//    them trang moi


    function addpagesAction() {

        $muser = new Admin_Model_Page();
        $paginator = Zend_Paginator::factory($muser->option_page());
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(10);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;

        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $menu = $purifier->purify($this->_request->getParam('menu'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $description = $purifier->purify($this->_request->getParam('description'));
            $home = $purifier->purify($this->_request->getParam('home'));

            $upload = new Zend_File_Transfer_Adapter_Http();
            $images = $upload->getFilename();
            $images = basename($images);

            $random_digit = rand(00000, 99999);
            $img = $random_digit . $images;
            $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $random_digit . $images, 'overwrite' => false));
            $upload->addFilter($filterRename);
            $upload->receive();

            $position = $purifier->purify($this->_request->getParam('position'));
            $active = $purifier->purify($this->_request->getParam('active'));

            $content = $purifier->purify($this->_request->getParam('content'));

            $add = new Admin_Model_Page();
            $add->insert_page($menu, $title, $dis, $key, $description, $img, $position, $active, $content, $home);
        }
    }

    function listpagesAction() {

        $muser = new Admin_Model_Page();
        $paginator = Zend_Paginator::factory($muser->list_Pages());
        //Số user trên một trang
        $paginator->setItemCountPerPage(10);

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
        $paginator->setItemCountPerPage(10);
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
            $content = $purifier->purify($this->_request->getParam('content'));
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
                $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $random_digit . $images, 'overwrite' => false));
                $upload->addFilter($filterRename);
                $upload->receive();
                $images123 = $img;
            }
            $id = $this->_request->getParam('id');
            $system->update_Pages($menu, $title, $dis, $key, $description, $images123, $position, $active, $content, $home, $id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_Pages_1($id);
        $this->view->books = $edit;
    }

    function addmenuAction() {
        $system = new Admin_Model_Category();
        $menu = $system->option_menu();
        $this->view->books = $menu;

        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));
            $position = $purifier->purify($this->_request->getParam('position'));

            $parent_id = $purifier->purify($this->_request->getParam('parent_id'));
            $category_id = $purifier->purify($this->_request->getParam('category_id'));
            $thuocloai = $purifier->purify($this->_request->getParam('cat_page'));
            $content = $purifier->purify($this->_request->getParam('content'));
            $active = $purifier->purify($this->_request->getParam('active'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $dis = $purifier->purify($this->_request->getParam('dis'));

            $system->insert_menu($title, $position, $parent_id, $category_id, $thuocloai, $content, $active, $key, $dis);
        }
    }

    function listmenuAction() {

        $muser = new Admin_Model_Category();
        $paginator = Zend_Paginator::factory($muser->list_menu());
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;


        $system = new Admin_Model_Category();
//                $paginator1 = Zend_Paginator::factory($system->option_menu());
//               	$paginator1->setItemCountPerPage(10);		
//		$paginator1->setPageRange(5);
//		$currentPage1 = $this->_request->getParam('page',1);
// 		$paginator1->setCurrentPageNumber($currentPage1);
        $test = $system->option_menu();
        $this->view->bookss = $test;




        $this->view->idmenu = $this->_request->getParam('idmenu');
    }

    function deletemenuAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $del = new Admin_Model_Category();
        $id = $this->_request->getParam('id');
        $del->delete_menu($id);
        trang_truoc();
    }

    function editmenuAction() {


        $system = new Admin_Model_Category();

        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $title = $purifier->purify($this->_request->getParam('title'));

            $position = $purifier->purify($this->_request->getParam('position'));
            // $parent_id = $purifier->purify($this->_request->getParam('parent_id'));
            $thuocloai = $purifier->purify($this->_request->getParam('thuocloai'));
            $content = $purifier->purify($this->_request->getParam('content'));
            $active = $purifier->purify($this->_request->getParam('active'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $category_id = $purifier->purify($this->_request->getParam('category_id'));
            $id = $this->_request->getParam('id');
            $system->update_menu($title, $position, $thuocloai, $content, $active, $key, $dis, $category_id, $id);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_menu_1($id);
        $this->view->books = $edit;

        $menu = $system->option_menu();
        $this->view->bookss = $menu;

        $this->view->booksss = $id;
    }

    function addproductsAction() {

        $muser = new Admin_Model_Page();
        $paginator = Zend_Paginator::factory($muser->option_page());
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(10);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;

        $system = new Admin_Model_Category();
        $menu = $system->option_menu();
        $this->view->bookss = $menu;


        $district = $system->option_dictrict();
        $this->view->bokk = $district;

        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $menu_id = $purifier->purify($this->_request->getParam('parent_id'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $dis = $purifier->purify($this->_request->getParam('dis'));
            $key = $purifier->purify($this->_request->getParam('key'));
            $description = $purifier->purify($this->_request->getParam('description'));
            $home = $purifier->purify($this->_request->getParam('home'));

            $upload = new Zend_File_Transfer();

            // $images=$upload->addValidator('IsImage', false, array('application/gif'));
            $images = $upload->addValidator('Extension', false, 'jpg,png,gif');
            // if($images==true){ thongbao('Không đúng định dạng hình ảnh');   return;}
            $images = $upload->getFilename();
            $images = basename($images);

            $url = khongdau($title);
            $random_digit = rand(00000, 99999);
            $img = $url . "-" . $random_digit . $images;
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

            $content = $purifier->purify($this->_request->getParam('content'));
            $price = $purifier->purify($this->_request->getParam('price'));


            $state = $purifier->purify($this->_request->getParam('state'));
            $sales = $purifier->purify($this->_request->getParam('sales'));
            $code = $purifier->purify($this->_request->getParam('code'));
            $members = $purifier->purify($this->_request->getParam('members'));
            $dictrict_id = $purifier->purify($this->_request->getParam('dictrict_id'));
            $type = $purifier->purify($this->_request->getParam('type'));
            $category_id = $purifier->purify($this->_request->getParam('category_id'));
             $price_root = $purifier->purify($this->_request->getParam('price_root'));

            $add = new Admin_Model_Products();
            $add->insert_products($title, $description, $img, $content, $menu_id, $price, $state, $sales, $dis, $key, $position, $active, $home, $code, $members, $dictrict_id, $type, $category_id, $price_root);
        }
        $this->view->idmenu = $this->_request->getParam('idmenu');
    }

    function listproductsAction() {

        $muser = new Admin_Model_Products();


        if ($this->_request->isPost()) {
            $title = $this->_request->getParam('title');
            $category_id = $this->_request->getParam('category_id');
            $parent_id = $this->_request->getParam('parent_id');
            if ($category_id == "") {
                $paginator1 = Zend_Paginator::factory($muser->list_products_2($title));
            } else if ($category_id != "") {
                $paginator1 = Zend_Paginator::factory($muser->list_products_3($title, $category_id, $parent_id));
            }
            //Số user trên một trang
            $paginator1->setItemCountPerPage(15);

            //Số trang được hiện ra để click
            $paginator1->setPageRange(5);

            //Lấy trang hiện tại
            $currentPage1 = $this->_request->getParam('page', 1);
            $paginator1->setCurrentPageNumber($currentPage1);

            //Truyền dữ liệu ra view
            $this->view->books = $paginator1;
        } else {

            $paginator = Zend_Paginator::factory($muser->list_products());
            //Số user trên một trang
            $paginator->setItemCountPerPage(15);

            //Số trang được hiện ra để click
            $paginator->setPageRange(5);

            //Lấy trang hiện tại
            $currentPage = $this->_request->getParam('page', 1);
            $paginator->setCurrentPageNumber($currentPage);

            //Truyền dữ liệu ra view
            $this->view->books = $paginator;


            $system = new Admin_Model_Category();
            $menu = $system->option_menu();
            $this->view->bookss = $menu;
        }
    }

    function deleteproductsAction() {
        $del = new Admin_Model_Products();
        $id = $this->_request->getParam('id');
        $menu = $del->list_products_1($id);
        $this->view->bookss = $menu;
    }

    function editproductsAction() {
        $system = new Admin_Model_Products();


        if ($this->_request->isPost()) {
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf = HTMLPurifier_Config::createDefault();
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
            $code = $purifier->purify($this->_request->getParam('code'));

            $members = $purifier->purify($this->_request->getParam('members'));
            $dictrict_id = $purifier->purify($this->_request->getParam('dictrict_id'));
            $type = $purifier->purify($this->_request->getParam('type'));
            $category_id = $purifier->purify($this->_request->getParam('category_id'));
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
                $filterRename = new Zend_Filter_File_Rename(array('target' => 'Upload/' . $random_digit . $images, 'overwrite' => false));
                $upload->addFilter($filterRename);
                $upload->receive();
                $img_1_2 = APPLICATION_PATH . "/../Upload/$img";
                $img_2 = time() . ".png";
                $img_2_2 = APPLICATION_PATH . "/../Upload/$img_2";
                rename($img_1_2, $img_2_2);

                $images123 = $img_2;
            }
            $price_root = $purifier->purify($this->_request->getParam('price_root'));
            $id = $this->_request->getParam('id');
            $system->update_products($title, $description, $images123, $content, $menu_id, $price, $state, $sales, $dis, $key, $position, $active, $home, $code, $members, $dictrict_id, $type, $category_id, $id, $price_root);
        }
        $id = $this->_request->getParam('id');
        $edit = $system->list_products_1($id);
        $this->view->books = $edit;


        $this->view->id = $this->_request->getParam('id');
        $this->view->menu_id = $this->_request->getParam('menu_id');

        $dt = new Admin_Model_Category();
        $district = $dt->option_dictrict();
        $this->view->bokk = $district;

        $menu = $dt->option_menu();
        $this->view->bookss = $menu;

        $mn = $dt->list_menu_1($this->_request->getParam('menu_id'));
        $this->view->book_s = $mn;
    }

    function menuAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $id = $this->_request->getParam('id');
        $mn = new Admin_Model_Products();
        $mn->hop_option($id);






//    echo "<select name=\"product\">";
//   
//    $cnDB= Zend_Registry::get('connectDB'); 
//	  
//	  $query="SELECT * FROM menu where category_id like '$id' order by position ASC ";
//         $stml= $cnDB->prepare($query);
//         $stml->execute();
//         while ($result=$stml->fetch(PDO::FETCH_ASSOC)){
//         $id=$result['id'];
//         $title=$result['title'];
//			// echo "obj.options[obj.options.length] = new Option('$title','$id');\n";	
//                         echo "<option value=\"$id\">$title</option> ";
//		}
//     
//   
//              
//                echo "</select>"; 
//                
    }

    public function listorderAction() {


        $muser = new Admin_Model_System();
        $paginator = Zend_Paginator::factory($muser->list_ordercontact());
        $paginator->setItemCountPerPage(15);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->books = $paginator;
    }

    function deleteorderAction() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        $del = new Admin_Model_Category();
        $id = $this->_request->getParam('id');
        $del->delete_order($id);
        trang_truoc();
    }

    function useractiveAction() {

        $del = new Admin_Model_Products();
        $id = $this->_request->getParam('id');
        $active = $this->_request->getParam('active');
        $del->update_user_active($active, $id);
    }

    function menuactiveAction() {

        $del = new Admin_Model_Products();
        $id = $this->_request->getParam('id');
        $active = $this->_request->getParam('active');
        $del->update_menu_active($active, $id);
    }

}

?>
