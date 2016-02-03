<?php

class PageController extends Zend_Controller_Action {

    public function init() {
        $baseurl = $this->_request->getbaseurl();
        $this->view->headTitle('hello');

        $this->view->headScript()->appendFile($baseurl . '/jquery.js');

        $this->view->headLink()->appendStylesheet($baseurl . '/template/images/MyStyles.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/template/images/styles.css');



        $this->view->headScript()->appendFile($baseurl . '/js/jquery-1.8.2.min.js');
    }

    function indexAction() {
        
    }

    function demoAction() {
        echo 65438685;
    }

    function pageAction() {


        $system = new Default_Model_Page();
        $id = $this->_request->getParam('id');
        $this->view->id = $id;
        $list = $system->page_3($id);
        $this->view->books = $list;


        $list_1 = $system->list_Page_1($id);
        $this->view->bookss = $list_1;

        // $this->view->booksss=($system->list_Page_2($id)); die;
        $paginator = Zend_Paginator::factory($system->list_Page_2($id));
        $paginator->setItemCountPerPage(9);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->booksss = $paginator;
    }
    function videoAction() {
       
        $system = new Default_Model_Page();
        // $this->view->booksss=($system->list_Page_2($id)); die;
        $paginator = Zend_Paginator::factory($system->list_video());
        $paginator->setItemCountPerPage(12);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->list = $paginator; 
        //echo $currentPage; die;
    }
    
    function detailvideoAction() {
       
        $system = new Default_Model_Page();
        $id = $this->_request->getParam('id');
        
        $list = $system->list_video("", $id);
        $this->view->detail = $list;
        
        $list_ = $system->list_video("0,12", "",$id);       
        $this->view->other = $list_;
        //echo $currentPage; die;
    }
    function searchAction() {
        $this->_helper->layout->disableLayout();
        $system = new Default_Model_Page();
        $this->view->purifier = Zend_Registry::get('purifier');
        $conf = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($conf);
        $key = $purifier->purify($this->_request->getParam('key'));

      //  var_dump($system->list_Page_search($key)); die;
        $paginator = Zend_Paginator::factory($system->list_Page_search($key));
        $paginator->setItemCountPerPage(18);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->booksss = $system->list_Page_search($key);
    }

    function pagepriceAction() {


        $system = new Default_Model_Page();
        $id = $this->_request->getParam('id');
        $this->view->id = $id;
        $list = $system->page_3($id);
        $this->view->books = $list;


        $list_1 = $system->list_Page_1($id);
        $this->view->bookss = $list_1;
        $paginator = Zend_Paginator::factory($system->list_Page_2($id));
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->booksss = $paginator;


        $this->view->menu_price = $system->list_menu_price();
    }

    public function detailpageAction() {
        $system = new Default_Model_Page();
        $id = $this->_request->getParam('id');
        $this->view->id = $id;
        $menu = $this->_request->getParam('menu');
        $list = $system->page_3($menu);
        $this->view->books = $list;


        $list_1 = $system->list_Page_1($id);
        $this->view->bookss = $list_1;
        $paginator = Zend_Paginator::factory($system->list_Page_3($id));
        $paginator->setItemCountPerPage(10);
        $paginator->setPageRange(5);
        $currentPage = $this->_request->getParam('page', 1);
        $paginator->setCurrentPageNumber($currentPage);
        $this->view->booksss = $paginator;


        $list_3 = $system->list_Page_4($id, $menu);
        $this->view->bookk = $list_3;


        $new = $system->list_Products_();
        $this->view->tab = $new;
    }

    public function customerAction() {
        $system = new Default_Model_Page();
        $list_3 = $system->list_cus();
        $this->view->list = $list_3;
    }

}

?>
