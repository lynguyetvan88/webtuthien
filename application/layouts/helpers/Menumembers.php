<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Menumembers extends Zend_View_Helper_Abstract
{
    public $view;
    public $_db;
    function __construct() {
        $this->_db=Zend_Registry::get('connectDB');  
    }

    public function  menumembers()
    {
        
         $this->menu_doc();
         $this->suppor_online();

    }
    function menu_doc() 
    {
        $vi=new Zend_View();
        $base=$vi->baseurl();
        
echo "<div class=\"title\">
<div style=\"padding-top:10px;\" align=\"center\">Quảng lý đăng tin</div>
</div>

<div class=\"menu_doc\" id=\"menu_doc\">
	  <ul>";
			
	echo "<li><a href=\"$base/dang-tin.html\">Đăng tin </a></li>";
        echo "<li><a href=\"$base/thanh-vien.html\">Tin đã đăng</a></li>";
        echo "<li><a href=\"javascript:void(0)\">Tin hết hạn</a></li>";
        echo "<li><a href=\"javascript:void(0)\">Tin chờ duyệt</a></li>";
			
       echo "</ul>
	</div>";
       
       
   echo "<div class=\"title\">
<div style=\"padding-top:10px;\" align=\"center\">Quảng lý cá nhân</div>
</div>

<div class=\"menu_doc\" id=\"menu_doc\">
	  <ul>";
			
	$link=new Default_Model_User();
        $link->linkuser();
	 echo "<li><a href=\"javascript:void(0)\">Đổi password</a></li>";		
       echo "</ul>
	</div>";
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


    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}

