<?php

class ProductController extends Zend_Controller_Action{
    
    public function init() {
       $baseurl=$this->_request->getbaseurl();
       
       
        $this->view->headScript()->appendFile($baseurl.'/jquery.js');
        $this->view->headLink()->appendStylesheet($baseurl.'/css/validationEngine.jquery.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/MyStyles.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/styles.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/juizDropDownMenu.css');
         $this->view->headLink()->appendStylesheet($baseurl.'/template/images/menu_doc.css');
          
        
        $this->view->headScript()->appendFile($baseurl.'/js/jquery-1.8.2.min.js');
        $this->view->headScript()->appendFile($baseurl.'/js/languages/jquery.validationEngine-en.js');
        $this->view->headScript()->appendFile($baseurl.'/js/jquery.validationEngine.js');
        $this->view->headScript()->appendFile($baseurl.'/template/js/juizDropDownMenu-1.5.min.js');
        $this->view->headScript()->appendFile($baseurl.'/template/images/menu_doc.js');
    }
 function  indexAction()
    {
         
         $muser= new Default_Model_Page();
         $id=  $this->_request->getUserParam('id');
           $paginator = Zend_Paginator::factory($muser->list_Products_left($id));
                 //Số user trên một trang
               	$paginator->setItemCountPerPage(20);
                
                //Số trang được hiện ra để click
		$paginator->setPageRange(5);
                
                //Lấy trang hiện tại
		$currentPage = $this->_request->getParam('page',1);
 		$paginator->setCurrentPageNumber($currentPage);
                
                //Truyền dữ liệu ra view
		$this->view->book=$paginator;
               
                $title =$muser->title_menu($id);
                $this->view->books=$title;
                
                $this->view->id =$id;
               
                 $pr = new Default_Model_Product;
                 $mlist= $pr->list_menu();
                 $mlist=  $this->_format_showlist($mlist);
        
       // var_dump($pe);
       $this->view->list_menu=$mlist;
       
      
    }
    function  categoryAction()
    {
         
         $muser= new Default_Model_Page();
         $id=  $this->_request->getUserParam('id');
           $paginator = Zend_Paginator::factory($muser->list_Products_category($id));
                 //Số user trên một trang
               	$paginator->setItemCountPerPage(20);
                
                //Số trang được hiện ra để click
		$paginator->setPageRange(5);
                
                //Lấy trang hiện tại
		$currentPage = $this->_request->getParam('page',1);
 		$paginator->setCurrentPageNumber($currentPage);
                
                //Truyền dữ liệu ra view
		$this->view->book=$paginator;
                
                $title =$muser->list_Products_title_c($id);
                $this->view->books=$title;
       
      
    }
    function  searchAction()
    {
         $this->_helper->layout->disableLayout();
         //echo 1334; die;
                $muser= new Default_Model_Page();
                
                $this->view->purifier = Zend_Registry::get('purifier');
                $conf=  HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($conf);
                $title = $purifier->purify($this->_request->getParam('title'));
                          
              
                $paginator = Zend_Paginator::factory($muser->search_2($title));
                 //Số user trên một trang
               	$paginator->setItemCountPerPage(15);
                
                //Số trang được hiện ra để click
		$paginator->setPageRange(5);
                
                //Lấy trang hiện tại
		$currentPage = $this->_request->getParam('page',1);
 		$paginator->setCurrentPageNumber($currentPage);
                
                //Truyền dữ liệu ra view
		$this->view->book=$paginator;
                
                
                
               // $title =$muser->list_Products_title($id);
               // $this->view->books=$title;
       
      
    }
    
    
    
    function  detailproductAction()
    { 
        $muser= new Default_Model_Page();
         $id=  $this->_request->getParam('id');
     
     
       
        $pro= $muser->list_detail_products($id);
        
        
        $this->view->book=$pro;
        
        $new=$muser->list_Products_New($id);
        $this->view->bookk=$new;
       // Zend_Registry::getInstance();
      //  echo  $value = Zend_Registry::get('memberss');
      
         $new=$muser->list_page_tab();
        $this->view->tab=$new;
        
        $pr = new Default_Model_Product;
        
                 $pr = new Default_Model_Product;
                  $mlist= $pr->list_menu();
                    $mlist=  $this->_format_showlist($mlist);
        
       // var_dump($pe);
       $this->view->list_menu=$mlist;
    }
    function  productAction()
    {
         
         $muser= new Default_Model_Page();
         $id=  $this->_request->getUserParam('id');
           $paginator = Zend_Paginator::factory($muser->list_Products_());
                 //Số user trên một trang
               	$paginator->setItemCountPerPage(12);
                
                //Số trang được hiện ra để click
		$paginator->setPageRange(5);
                
                //Lấy trang hiện tại
		$currentPage = $this->_request->getParam('page',1);
 		$paginator->setCurrentPageNumber($currentPage);
                
                //Truyền dữ liệu ra view
		$this->view->book=$paginator;
                
                $title =$muser->list_Products_title($id);
                $this->view->books=$title;
                
                  $pr = new Default_Model_Product;
        
                    $mlist= $pr->list_menu();
                    if(!empty($mlist))
                        foreach ($mlist as $index=>$val){
                            $mlist[$index]['product']=$pr->list_products_home($val['id']);
                        }
                    //$mlist=  $this->_format_showlist($mlist);
//                    echo "<pre>";
//                        print_r($mlist);
//                    echo "</pre>";
//                   die;
                   $this->view->list=$mlist;
       
      
    }
    private function _format_showlist($mlist) {
         $pr = new Default_Model_Product;
        if (!empty($mlist)) {
            for ($i = 0; $i < count($mlist); $i++) {
                $mfile = $pr->list_menu($mlist[$i]['id']);
                $mlist[$i]['menu'] = $mfile;
                   if (!empty($mlist[$i]['menu'])) {
                        for ($j = 0; $j < count($mfile); $j++) {
                        $mfile1 = $pr->list_menu($mfile[$j]['id']);
                        $mlist[$i]['menu'][$j]['menu'] = $mfile1;   
                        
                        if (!empty($mfile1)) {
                                for ($k = 0; $k < count($mfile1); $k++) {
                                $mfile2 = $pr->list_menu($mfile1[$k]['id']);
                                $mlist[$i]['menu'][$j]['menu'][$k]['menu'] = $mfile2;               
                                }
                            }
                        
                        
                        
                        }
                   }
            }
        }
        return $mlist;
    }
    
}
?>
