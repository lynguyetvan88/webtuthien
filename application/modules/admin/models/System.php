<?php

class Admin_Model_System  {

    
   protected $_name = 'user';
    protected $db; 
    public  $title,$dis,$key, $banner, $footer;


    function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
       
        
        
        
    }
    function __destruct() {
        $this->db=NULL;
    }
    
    
    public function add_User($name,$password,$fullname)
	{
        
		$data=array(
		'name'  =>$name,
		'password'   =>$password,
		'fullname' =>$fullname,
		);
                $this->db->insert('user', $data);
		
                
                
	}
        
        public function update_System($data)
	{
            try {
                
                $this->db->update('system', $data, 'id=1');
                                
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }

            
                
	}
        
        
        public function update_contact($email,$content)
	{
        
		$data=array(
		'email'  =>$email,
		'content'   =>$content,
		
		);
                $this->db->update('system', $data, 'id=1');
                
	}
   
   
    
    public function select_System()
    {
    
         try {
            
               $query="SELECT * FROM `system` where id like '1'";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
    public function list_contact()
    {
       
        
        
         try {
            
               $query="SELECT * FROM `contact`";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }




       
    }
    
    public function delete_contact($id)
	{
        
       
          
         
                  $this->db->delete('contact',  'id='.$id);
	}
     public function list_ordercontact()
    {
       
        
        
         try {
            
               $query="SELECT * FROM `order`";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }




       
    }

}