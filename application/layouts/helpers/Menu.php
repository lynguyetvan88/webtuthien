<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Menu extends Zend_View_Helper_Abstract
{
    public $view;

     public function  menu()
    {
        $view=new Zend_View();
        $base=$view->baseurl();
        
       
        $this->menu_doc();
    }
    
    private function menu_doc() 
    {
        $vie= new Zend_View();
        $base= $vie->baseurl();
        
        $cnDB2= Zend_Registry::get('connectDB'); 
       
            $tv1="select * from  add_page where cat_page=1 and cat_page_id like '' and active=1 and id not in (51,57) order by position ASC, id ASC"; 
             $stml2= $cnDB2->prepare($tv1); 
            $stml2->execute();
          
            
             
	$stt=1;
         echo "
     <link rel=\"stylesheet\" type=\"text/css\" href=\"$base/template/css/style_mn.css\" />
  
 <div class=\"webtmtbar webtmtnav\">
      <div class=\"webtmtnav-outer\">
        
    <ul class=\"webtmthmenu\">";
          echo " <li style='width:27px'> <a href=\"$base\" style='margin-left:-7px;'> <img src=\"$base/template/images/images/home_03.jpg\"  /> </a></li>";
	 while ($tv_21=$stml2->fetch(PDO::FETCH_ASSOC)) { 
            
	 $dm=$tv_21['id'];

			$danhmuc=$tv_21['title'];
			$url_tt= khongdau($danhmuc);
                       
			  echo " <li> <a href=\"$base/pages/$url_tt-$dm.html\"> $danhmuc </a>";
		
     
                          echo "<ul class=\"\">";
				
                                $tv11="select * from add_page where cat_page_id like '$dm' and  active=1 order by position asc, id ASC";
                                $stml21= $cnDB2->prepare($tv11);
                                $stml21->execute();
                                                                
				while ($tv_2=$stml21->fetch(PDO::FETCH_ASSOC)) 
				{
                                    //var_dump($tv_2);exit;
					$id=$tv_2['id'];
					$ten=$tv_2['title'];
					 $url=  khongdau($ten);
					$link_menu="$base/pages/$url-$id.html";
					echo "<li>";
						echo "<a href=\"$link_menu\" title=\"$ten\">"; 
							echo $tv_2['title'];
						echo "</a>";
						$xacdinh_menu_con_doc=  $this->xacdinh_menu_con_doc($id);
						if($xacdinh_menu_con_doc=="co")
						{
							echo "<ul>";
                                                        $this->dequy_menu_doc($id);
							echo "</ul>";
						}
						else
						{
						}
					echo "</li>";
				}
                                
                                echo "</ul>";
                                
            	  echo" </li>";
     
	
                                
                    
        
                $stt++;} 

                  echo " <li> <a href=\"$base/lien-he.html\" target=\"_blank\"> Liên hệ </a></li>";
                 echo"  </ul>";
                 echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\" name=\"tt_mh\" id=\"tt_mh\"  class=\"form-horizontal\">
   
    <input type=\"text\" name=\"key\" id='key' style='border-radius:0px' />
    <input type=\"image\" src=\"$base/template/images/ico_search_03.png\" id='search'/>
</form>";
              echo"  
      </div>
    </div>";

        
    }
   private function xacdinh_menu_con_doc($id)
    {       $cnDB= Zend_Registry::get('connectDB'); 
            $query="select * from add_page where  cat_page_id='$id' and active=1 order by position asc";
            $stml= $cnDB->prepare($query);
            $stml->execute();
            $result=$stml->rowCount();
           // echo $result;
            if($result!=0){return "co";}else{return "khong";}
    }
   private function dequy_menu_doc($id)
    {
            $vie= new Zend_View();
        $base= $vie->baseurl();
            $cnDB1= Zend_Registry::get('connectDB'); 
            $tv="select * from add_page where cat_page_id='$id' and active=1 order by position ASC";
             $stml1= $cnDB1->prepare($tv);
            $stml1->execute();

             while ($result1=$stml1->fetch(PDO::FETCH_ASSOC)) {
                    $id=$result1['id'];
                    $ten=$result1['title'];
                     $url=khongdau($ten);
                    $link_menu="$base/pages/$url-$id.html";
                    echo "<li>";
                            echo "<a href=\"$link_menu\">";
                                    echo $result1['title'];
                            echo "</a>";
                            $xacdinh_menu_con_doc=  $this->xacdinh_menu_con_doc($id);
                            if($xacdinh_menu_con_doc=="co")
                            {
                                    echo "<ul>";
                                    $this->dequy_menu_doc($id);
                                    echo "</ul>";
                            }
                            else
                            {
                            }
                    echo "</li>";
            }
    }
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}

