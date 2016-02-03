<?php

class Default_Model_User  {

    
   protected $_name = 'user';
    protected $db; 
    
    function __construct() {
        $filename=APPLICATION_PATH.'/configs/config.ini';
        $config= new Zend_Config_Ini($filename);
        $config = $config->toArray();
        $configdb=$config['db'];
        $adapter=$configdb['adapter'];
        $params=$configdb[$adapter]['params'];
        $this->db=  Zend_Db::factory($adapter,$params);
        $this->db->getConnection();
        $this->db->setFetchMode(Zend_Db::FETCH_OBJ);
       
        
        
        
    }
    function __destruct() {
        $this->db=NULL;
    }

//    public function addUser($params){
//        try {
//        $sql='Insert Into user(id,name,password,fullname) Values (:p_id,:p_name,:p_pass,:p_fullname)';
//        $stmt=$this->_pdo->prepare($sql);
//        $stmt->bindParam('p_id',$params['id'], PDO::PARAM_STR);
//        $stmt->bindParam('p_name',$params['name'], PDO::PARAM_STR);
//        $stmt->bindParam('p_pass',$params['password'], PDO::PARAM_STR);
//        $stmt->bindParam('p_fullname',$params['fullname'], PDO::PARAM_STR);
//        $stmt->execute();
//            
//        } catch (Exception $exc) {
//            echo 'error';
//        }
//
//       
//        
//        
//        
//        /* đóng kết nối
//         $this->_pdo=null;
//        */
//    }   
    
    
    public function add_User($name,$password,$fullname)
	{
        
		$data=array(
		'name'  =>$name,
		'password'   =>$password,
		'fullname' =>$fullname,
		);
                $this->db->insert('user', $data);
		
                
                
	}
        
        public function update_User($name,$password,$fullname,$id)
	{
        
		$data=array(
		'name'  =>$name,
		'password'   =>$password,
		'fullname' =>$fullname,
		);
                $this->db->update('user', $data, 'id='.$id);
		
                
                
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
    

}