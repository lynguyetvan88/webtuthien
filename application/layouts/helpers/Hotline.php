<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Hotline extends Zend_View_Helper_Abstract
{
    public $view;
    public function  hotline()
    {
       $url= new Zend_View();
       $url=$url->baseUrl();
       $page = new Default_Model_Page();
       $hot = $page->page_3(9);
       $down = $page->page_3(13);
       echo " <div class=\"heed\"> ";
       foreach ($hot as $val){
             echo   "<div class=\"heed_1\">$val[content]</div>  ";
                }
      echo   " <div class=\"heed_2\">";
       foreach ($down as $val){
      echo"      <div class=\"heed_2_1\" >$val[content]  </div>";
       } 
       echo "<div class=\"heed_2_2\" >
                <a href=\"javascript:void(0)\">  <img src=\"$url/template/images/face_03.jpg\" ></a>
                <a href=\"javascript:void(0)\">   <img src=\"$url/template/images/g+_03.jpg\" > </a>
                <a href=\"javascript:void(0)\">   <img src=\"$url/template/images/tw_03.jpg\" > </a>
                <a href=\"javascript:void(0)\">   <img src=\"$url/template/images/youtube_03.jpg\" > </a>
                <a href=\"javascript:void(0)\">   <img src=\"$url/template/images/zing_03.jpg\" > </a>
            </div>
        </div>
    </div> "; 
        
       
    }
    
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}


