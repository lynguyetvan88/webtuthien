<?php

class Default_Model_User {

    private $_pdo; 
    function __construct() {
//        $conf = Zend_Registry::get('conf');
//         //print_r($conf);
//        //$dsn='mysql:host=localhost;dbname=zendfw';
//        $dsn=$conf['sql'].':host='.$conf['host'].';'.$conf['dbname'];
//        $options=array(
//            PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES UTF8'
//        );
//        $this->_pdo= new PDO($dsn,$conf['username'],$conf['password'], $options);
//        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//        echo '<br>';
//        echo print_r($this->_pdo);
//        echo '<br>';
       
        
    }
    public function addUser($params){
        try {
        $sql='Insert Into user(id,name,password,fullname) Values (:p_id,:p_name,:p_pass,:p_fullname)';
        $stmt=$this->_pdo->prepare($sql);
        $stmt->bindParam('p_id',$params['id'], PDO::PARAM_STR);
        $stmt->bindParam('p_name',$params['name'], PDO::PARAM_STR);
        $stmt->bindParam('p_pass',$params['password'], PDO::PARAM_STR);
        $stmt->bindParam('p_fullname',$params['fullname'], PDO::PARAM_STR);
        $stmt->execute();
            
        } catch (Exception $exc) {
            echo 'error';
        }

       
        
        
        
        /* đóng kết nối
         $this->_pdo=null;
        */
    }   
    public function select(){
        
        $sql_select='select * from user';
        $stmt=$this->_pdo->prepare($sql_select);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        echo '<br>';
        print_r($result);
        echo '<br>';
    }
    

}