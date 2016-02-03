<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Menupage extends Zend_View_Helper_Abstract
{
    public $view;

     public function  menupage()
    {
        $view=new Zend_View();
        $base=$view->baseurl();
        $session = new Zend_Session_Namespace('identity');
        $username =$session->username;
          echo "
     <link rel=\"stylesheet\" type=\"text/css\" href=\"$base/css/bootstrap-cerulean_1.css\" />";
             echo"   <li><a href=\"$base\">trang chủ</a> </li>
                <li><a href=\"$base/pages/gioi-tieu-6.html\">GIỚI THIỆU</a> </li>
                <li><a href=\"$base/pages/tin-tuc-12.html\">TIN TỨC</a> </li>
                <li><a href=\"$base/pages/gioi-tieu-16.html\">tuyển dụng </a> </li>
                <li><a href=\"$base/pages/gioi-tieu-19.html\">PHẤN PHỐI </a> </li>
                <li><a href=\"$base/lien-he.html\">LIÊN HỆ</a> </li>
                <li class=\"search\">
                    <form action=\"\" enctype='multipart/form-data' >
                        <input type=\"text\" style=\"margin-left: 101px; width: 252px; margin-top: 5px;\" placeholder=\"Nhập thiết bị cần tìm?\">
                        <input type=\"image\" src=\"$base/template/images/bt_07.jpg\" style=\"width: 25px;margin-left: 365px;margin-top: -88px\">
                    </form>
                </li>";
       
          
       
      
          
        
           
	
          
          
    }
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}

