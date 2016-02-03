<?php

class Admin_Model_User {
     function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
       
        
        
        
    }
    function __destruct() {
        $this->db=NULL;
    }
    public function list_user()
    {
       
    
         try {
            
               $query="SELECT * FROM `users` where id <> 1";
       
              return  $stml=$this->db->fetchAssoc($query);
             
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }


    }
    public function list_user_1($id)
    {
       
        try {
            
               $query="SELECT * FROM users where id like '$id'";
       
                //$stml=$this->db->fetchAssoc($query);
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function list_user_2($username)
    {
       
        try {
            
               $query="SELECT * FROM users where username like '$username'";
       
                //$stml=$this->db->fetchAssoc($query);
              // return  $stml=$this->db->fetchAssoc($query);
               $test=  $this->db->fetchRow($query);
               if($test<>0){
                                    return 1;  }
                else {      return 2;}
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    public function insert_user($username, $password, $email, $full_name, $status, $group_name)
	{
        
		$data=array(
		'username'  =>$username,
		'password'   =>$password,
		'email' =>$email,
                'full_name' =>$full_name,
                'status' =>$status,
                'group_name' =>$group_name,
		);
                $this->db->insert('users', $data);
		
                
                
	}
        public function update_user($username, $password, $email, $full_name, $status, $group_name,$id)
	{
            //echo $password; die;
                $data=array(
		'username'  =>$username,
		'password'   =>$password,
		'email' =>$email,
                'full_name' =>$full_name,
                'status' =>$status,
                'group_name' =>$group_name,
		);
                $this->db->update('users', $data, 'id='.$id);
                
	}
         public function update_user_active( $status,$id)
	{
                $data=array(
		
                'status' =>$status,
               
		);
                $this->db->update('users', $data, 'id='.$id);
                
	}
         public function delete_user($id)
	{
        
                $query="SELECT * FROM users where id = $id and group_name not like ''";
                    $test=  $this->db->fetchRow($query);
                    if(empty($test)){
                               $this->db->delete('users',  'id='.$id);  
                               }      
                else {echo 2; }
         
                 
	}
}
?>
