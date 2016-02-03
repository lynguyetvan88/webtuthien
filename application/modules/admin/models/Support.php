<?php

class Admin_Model_Support  {
     function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
       
        
        
        
    }
    function __destruct() {
        $this->db=NULL;
    }
    public function list_support()
    {
       
    
         try {
            
               $query="SELECT * FROM `support`";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
     public function list_support_1($id)
    {
       
        try {
            
               $query="SELECT * FROM support where id like '$id'";
       
                //$stml=$this->db->fetchAssoc($query);
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function insert_support($nickname, $loai_nick, $name, $hotline, $position, $active)
	{
        
		$data=array(
		'nickname'  =>$nickname,
		'loai_nick'   =>$loai_nick,
		'name' =>$name,
                'hotline' =>$hotline,
                'position' =>$position,
                'active' =>$active,
		);
                $this->db->insert('support', $data);
		
                
                
	}
        public function update_support($nickname, $loai_nick, $name, $hotline, $position, $active,$id)
	{
                $data=array(
		'nickname'  =>$nickname,
		'loai_nick'   =>$loai_nick,
		'name' =>$name,
                'hotline' =>$hotline,
                'position' =>$position,
                'active' =>$active,
		);
                $this->db->update('support', $data, 'id='.$id);
                
	}
        
         public function delete_support($id)
	{
        
       
          
         
                  $this->db->delete('support',  'id='.$id);
	}
         public function update_user_active( $status,$id)
	{
                $data=array(
		
                'active' =>$status,
               
		);
                $this->db->update('support', $data, 'id='.$id);
                
	}
}
?>
