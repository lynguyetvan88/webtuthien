<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Menuright extends Zend_View_Helper_Abstract
{
    public $view;
    public $_db;
    function __construct() {
        $this->_db=Zend_Registry::get('connectDB');  
    }

    public function  menuright()
    {
        $this->tab_1();
        $this->suppor_online();
        $this->tab_2();
        
         $this->video();
         $this->news();

    }
    function video() 
    {
       	
       
               $video= new Default_Model_Menuright();
               $video->qc_right();
       

            
        
    }
     function news() 
    {
        
          
         echo "<div class=\"title\">
                <div style=\"padding-top:10px;\" align=\"center\">Facebook</div>
                </div>";
         echo "<div class=\"hotro\">";
         echo "<iframe src=\"//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FDangTinMienPhiToanQuoc&amp;width=218&amp;height=290&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=true&amp;header=true&amp;appId=229387117136475\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:218px; height:290px;\" allowTransparency=\"true\"></iframe>";
         
         echo "</div>";
         echo "<div class='clear'></div>";
        echo "<div class=\"title\">
                <div style=\"padding-top:10px;\" align=\"center\">Tin Tức</div>
                </div>";
         echo "<div class=\"hotro\">";
               $video= new Default_Model_Menuright();
               $video->news();
         echo "</div>";
          echo "<div class='clear'></div>";
            
        
    }
    function xacdinh_menu_con_doc($id)
    {       $cnDB= Zend_Registry::get('connectDB'); 
            $query="select * from menu where parent_id='$id'";
            $stml= $cnDB->prepare($query);
            $stml->execute();
            $result=$stml->rowCount();
           // echo $result;
            if($result!=0){return "co";}else{return "khong";}
    }
    function dequy_menu_doc($id)
    {
            $cnDB1= Zend_Registry::get('connectDB'); 
            $tv="select * from menu where parent_id='$id' order by id";
             $stml1= $cnDB1->prepare($tv);
            $stml1->execute();

             while ($result1=$stml1->fetch(PDO::FETCH_ASSOC)) {
                    $id=$result1['id'];
                    $ten=$result1['title'];
                     $url=khongdau($ten);
                    $link_menu="san-pham-$url-$id.html";
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
    function suppor_online ()
    {
       echo" <div class=\"title2\">
        <div style=\"padding-top:10px;\" align=\"center\">HỖ TRỢ TRỰC TUYẾN</div>
        </div>
        <div class=\"hotro\">";
  
            $cndb=$this->_db;
	     $tv="select * from support  order by id";
             $stml= $cndb->prepare($tv);
	    $stml->execute();
	
	  	while ($tv_2=$stml->fetch(PDO::FETCH_ASSOC)) 
		{
		    

			$tendaidien=$tv_2['name'];
			$ten_nick="$tv_2[nickname]";
			$dt="$tv_2[hotline]";
			
			
			
            echo "<div style=\"padding-right:10px; padding-top:10px; padding-left:5px;  \" align=\"center\"> <a href=\"ymsgr:sendim?$ten_nick\">
                <img src=\"http://opi.yahoo.com/online?u=$ten_nick&m=g&t=2&l=us\"  height=\"23\" border=\"0\" width=\"107\"  align=\"absmiddle\">
                 </a>
                <br /> <strong>$tendaidien</strong> 
                <br /> <strong>$dt</strong> 
                </div>";
 } 

echo"<div style=\"clear:both; height:5px;\"></div>
</div>";



  }

  function tab_1 ()
  {
      $vie= new Zend_View();
        $base= $vie->baseurl();
        $page = new Default_Model_Page();
      echo "
        

<link rel=\"stylesheet\" type=\"text/css\" href=\"$base/template/css/tabcontent.css\" />

<script type=\"text/javascript\" src=\"$base/template/js/tabcontent.js\"></script>
<ul id=\"countrytabs\" class=\"shadetabs\">
<li><a href=\"#\" rel=\"country1\" class=\"selected\">Tin xem nhiều</a></li>
<li><a href=\"#\" rel=\"country2\">Tin Vip Nhất </a></li>

</ul>

<div style=\"border:1px solid gray; width:218px; margin-bottom: 1em; \">

<div id=\"country1\" class=\"tabcontent\">";
  $page->views_n();
echo"</div>";

echo"<div id=\"country2\" class=\"tabcontent\">";
$page->top_vip();
echo"</div>



</div>





<script type=\"text/javascript\">

var countries=new ddtabcontent(\"countrytabs\")
countries.setpersist(true)
countries.setselectedClassTarget(\"link\") 
countries.init()

</script>";
      
      
      
      
  }

  
  function tab_2 ()
  {
       $page = new Default_Model_Page();
      $vie= new Zend_View();
        $base= $vie->baseurl();
      echo "
        


<ul id=\"countrytabs1\" class=\"shadetabs\">
<li><a href=\"#\" rel=\"country3\" class=\"selected\">Tin Hot Nhất</a></li>
<li><a href=\"#\" rel=\"country4\">Tin Khuyến Mãi </a></li>

</ul>

<div style=\"border:1px solid gray; width:218px; margin-bottom: 1em; \">

<div id=\"country3\" class=\"tabcontent\">";
 $page->top_hot();
echo"</div>

<div id=\"country4\" class=\"tabcontent\">";
 $page->top_km();
echo"</div>



</div>

<script type=\"text/javascript\">

var countries=new ddtabcontent(\"countrytabs1\")
countries.setpersist(true)
countries.setselectedClassTarget(\"link\") 
countries.init()

</script>";
      
      
      
      
      
  }
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}

