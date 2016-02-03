<?php

class Default_Model_User  {

    
    protected $db; 
   
   
    
    function __construct() {
        
          $this->db=  Zend_Registry::get('connectDB');      
        
    }
    function __destruct() {
        $this->db=NULL;
    }


    
    public function add_User($username,$password,$email,$full_name, $status, $group_name, $phone, $birth, $sex, $address)
	{
        
        
		$data=array(
		'username'  =>$username,
		'password'   =>$password,
		'full_name' =>$full_name,
                'email' =>$email,
                'status' =>$status,
                'group_name' =>$group_name,
                'phone' =>$phone,
                'birth' =>$birth,
                'sex' =>$sex,
                'address' =>$address,
		);
                $this->db->insert('users', $data);
		
                
                
	}
        
       
   
    
    public function select_user()
    {
        
        // hien danh sach
        $sql = "SELECT * FROM `user` order by id asc";
        $stml= $this->db->prepare($sql);
        $stml->execute();
        
       while( $result=$stml->fetch(PDO::FETCH_ASSOC))
       {
        echo '<br>';
       echo $result['name'];
        echo '<br>';
        echo $result['password'];
         echo '<br>';
        echo $result['fullname'];
       }
    }
    
     public function insert_contact($hoten, $diachi, $dt, $email, $noidung)
	{
        
		$data=array(
		'hoten'  =>$hoten,
		'diachi'   =>$diachi,
		'dt' =>$dt,
                'email' =>$email,
                'fax' =>'',
                 'tieude' => '',
                 'noidung' =>$noidung,
                 'hinhanh' =>'',
		);
                $this->db->insert('lienhe', $data);
                
            
	}
        
          public function active_login()
    {
              $session = new Zend_Session_Namespace('identity');
        $username =$session->username;
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
      public function list_products_member()
    {
       
        try {
             $session = new Zend_Session_Namespace('identity');
             $username =$session->username;
            
               $query="SELECT * FROM products where members like '%$username%'";
       
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
     public function list_products_title($title)
    {
       
        try {
             $session = new Zend_Session_Namespace('identity');
             $username =$session->username;
            
               $query="SELECT * FROM products where members like '%$username%' and title like '%$title%'";
       
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
    
    public function linkuser()
	{
         $view=new Zend_View();
         $base=$view->baseurl();
         $session = new Zend_Session_Namespace('identity');
             $username =$session->username;
	 $query="SELECT * FROM users where username like '$username' ";
         $stml= $this->db->prepare($query);
         $stml->execute();
         while ($result=$stml->fetch(PDO::FETCH_ASSOC)){
         $id=$result['id'];
         echo "<li><a href=\"$base/user/user-$id.html\">Sửa thông tin cá nhân</a></li>";
         }
	}
     public function update_Users($full_name,$email,$phone,$birth,$sex,$address,$id)
	{
       
		$data=array(
		'full_name'  =>$full_name,
		'email'   =>$email,
		'phone' =>$phone,
                'birth'   =>$birth,
		'sex' =>$sex,
                'address' =>$address,
		);
                $this->db->update('users', $data, 'id='.$id);
		
                
                
	}
         public function list_users($id)
    {
       
        try {
             
               $query="SELECT * FROM users where id like '$id' ";
       
               return  $stml=$this->db->fetchAssoc($query);
           
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

       

       
    }
 
}