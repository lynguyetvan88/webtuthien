<?php

class Admin_Model_Side {
     function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
       
        
        
        
    }
    function __destruct() {
        $this->db=NULL;
    }
    public function list_side()
    {
       
    
         try {
            
               $query="SELECT * FROM `side` where type like '0'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
    
    public function list_partners()
    {
       
    
         try {
            
               $query="SELECT * FROM `side` where type like '1'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
     public function list_side_1($id)
    {
       
        try {
            
               $query="SELECT * FROM side where id like '$id'";
       
                //$stml=$this->db->fetchAssoc($query);
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function insert_side($images, $title, $description, $link, $position,$type=0)
	{
        
		$data=array(
		'images'  =>$images,
		'title'   =>$title,
		'description' =>$description,
                'link' =>$link,
                'position' =>$position,
                'type' =>$type,    
               
		);
                $this->db->insert('side', $data);
		
                
                
	}
        public function update_side($images, $title, $description, $link, $position,$id)
	{
                $data=array(
		'images'  =>$images,
		'title'   =>$title,
		'description' =>$description,
                'link' =>$link,
                'position' =>$position,
                 'type' =>0,   
		);
                $this->db->update('side', $data, 'id='.$id);
                
	}
        
         public function delete_support($id)
	{
        
       
          
         
                  $this->db->delete('side',  'id='.$id);
	}
}
?>
