<?php

class Default_Model_Menuright  {
     function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
      
    }
    function __destruct() {
        $this->db=NULL;
    }
    public function qc_right()
    {
       
         try {
            
              $query="SELECT * FROM `add_page` where id like '18' ";
               
              $stml= $this->db->prepare($query);
              $stml->execute();
              $result=$stml->fetch(PDO::FETCH_ASSOC);
              echo $result['content'];
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
    public function keyword()
    {
       echo" <div class=\"title2\">
        <div style=\"padding-top:10px;\" align=\"center\">Từ khóa quan tâm</div>
        </div>
        <div class=\"hotro\">";
         try {
            
              $query="SELECT * FROM `add_page` where id like '19' ";
               
              $stml= $this->db->prepare($query);
              $stml->execute();
              $result=$stml->fetch(PDO::FETCH_ASSOC);
              echo $result['content'];
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

        echo"<div style=\"clear:both; height:5px;\"></div>
</div>";
    }
     public function news()
    {
         $view=new Zend_View();
         $base=$view->baseurl();
       
        try {
            
               $query="SELECT * FROM page where menu like '12' ORDER BY id DESC limit 0,4";
       
              $stml= $this->db->prepare($query);
              $stml->execute();
              while($result=$stml->fetch(PDO::FETCH_ASSOC))
                  {
                    $id=$result['id'];
                    $title=$result['title'];
                    $url=  khongdau($title);
                    $date=$result['date'];
                    $menu=$result['menu'];
                      $images=$result['images'];
                    $link="$base/trang/$url-$id-$menu.html";
                     echo "<div class='clear_10'></div>";
                     echo "<a href=\"$url/pages/tin-tuc-12.html\" title=\"$ten\">  <img src=\"$base/Upload/$images\"> </a>";
                    echo "<a href=\"$link\"> <h5>  $title </h5></a>";
                    echo "<span>$date <span>";
                    echo "<div class='clear'></div>";
                    echo "<div class='clear_border'></div>";
                  }
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function insert_link($title,$link)
	{
		$data=array(
		'title'  =>$title,
		'link'   =>$link,
		
		);
                $this->db->insert('link_web', $data);
		
                
                
	}
        public function update_link($title,$link,$id)
	{
                $data=array(
		'title'  =>$title,
		'link'   =>$link,
		);
                $this->db->update('link_web', $data, 'id='.$id);
                
	}
        
         public function delete_link($id)
	{
        
                  $this->db->delete('link_web',  'id='.$id);
	}
        
        public function qc_left()
    {
       
         try {
            
              $query="SELECT * FROM `add_page` where id like '18' ";
               
              $stml= $this->db->prepare($query);
              $stml->execute();
              $result=$stml->fetch(PDO::FETCH_ASSOC);
              echo $result['content'];
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
}
?>
