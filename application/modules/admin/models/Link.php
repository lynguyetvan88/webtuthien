<?php

class Admin_Model_Link  {
     function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
      
    }
    function __destruct() {
        $this->db=NULL;
    }
    public function list_link()
    {
       
         try {
            
              $query="SELECT * FROM `link_web`";
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
     public function list_link_1($id)
    {
       
        try {
            
               $query="SELECT * FROM link_web where id like '$id'";
       
                //$stml=$this->db->fetchAssoc($query);
               return  $stml=$this->db->fetchAssoc($query);
           
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
}
?>
