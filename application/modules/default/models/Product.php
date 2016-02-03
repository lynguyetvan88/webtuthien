<?php

class Default_Model_Product  {

    
    protected $db; 
   
   
    
    function __construct() {
        
          $this->db=  Zend_Registry::get('connectDB');      
        
    }
    function __destruct() {
        $this->db=NULL;
    }


   
       public function list_menu($id="")
    {
       
        try {
             if(!empty($id)){$sql="and parent_id=$id";} else{$sql="and parent_id like ''";}
               $query="SELECT * FROM menu where active =1 $sql order by position ASC, id ASC";
       
               return  $stml=$this->db->fetchAll($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }   
    
     public function list_products_home($menu_id)
    {
//       $arr = $this->list_menu();
//         if (!empty($arr)) {
//            for ($i = 0; $i < count($arr); $i++) {
//                $menu_id = $arr[$i]['id'];
//                $query="SELECT * FROM products where menu_id = $menu_id and active=1 and home=1";
//                $stml[]=$this->db->fetchAll($query);
//            }
//            
//            echo"<pre>";
//            var_dump($stml[0][0]['images']);
//            echo"</pre>";
//      // var_dump($arr[0]['title']);
//            
//      foreach ($stml as  $value) {
//         echo $value['title']; echo "<br>"; 
//      }
//       
//             //  return  $stml=$this->db->fetchAssoc($query);
//           
       $query="SELECT * FROM products where menu_id = $menu_id and active=1 ";
       return  $stml=$this->db->fetchAssoc($query);

       
    
    }
    
    
 
}