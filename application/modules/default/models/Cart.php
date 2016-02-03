<?php

class Default_Model_Cart  {

    
    function __construct() {
        $this->db=  Zend_Registry::get('connectDB');      
      
    }
    function __destruct() {
        $this->db=NULL;
    }

 
    
    
    public function addcart()
	{
        $session = new Zend_Session_Namespace('shopcart');
        $id=Zend_Controller_Front::getInstance()->getRequest()->getParam('id');
       
        //$session->cart=$cart;
        
        if(isset($session->cart[$id]))
        {
                $qty = $cart[$id] + 1;
        }
        else
        {
                $qty=1;
        }
       // var_dump($session->cart) ; exit;
        $cart[$id]=$qty;
        $base= new Zend_View();
        $link= $base->baseUrl();
        $url=$link."/shoppingcart";
        chuyen_trang($url);
        exit();
	
	}
        
         public function page_2()
	{
         $view=new Zend_View();
        $base=$view->baseUrl();
	 $query="SELECT * FROM add_page where active like '1' order by position ASC limit 1,5 ";
         $stml= $this->db->prepare($query);
         $stml->execute();
         while ($result=$stml->fetch(PDO::FETCH_ASSOC)){
         $id=$result['id'];
         $title=$result['title'];
         $url=  khongdau($title);
         
         echo "<li><a href=\"$base/pages/$url-$id.html\">".$result['title']."</a></li>";
         }
	}
        
          public function listcart($arrParam)
	{
              
//			echo '<pre>';
//			print_r($arrParam['cart']['71']);
//			echo '</pre>';
      //  var_dump(count($arrParam['cart']));      
             if(count($arrParam['cart'])>0){
                $i = 1;
                foreach ($arrParam['cart'] as $k => $v){if($k){$i=2;} }
                      
                }
                else {
                      // echo "Bạn chưa mua hàng";      return ;
                       
                      }
               
                if($i == 2)
                {
                     foreach ($arrParam['cart'] as $key => $val){$item[]=$key; }
                      $ids=implode(",",$item); 

                $query="SELECT * FROM products where id in ($ids) order by position ASC, id DESC";
              
               $stml=$this->db->fetchAll($query); 
               
               return $stml;
				

                }
                else {
                                        echo "Bạn chưa mua hàng";}
                        
		
        }
        
        public function cart_order($arrParam)
	{
              $view=new Zend_View();
              $base=$view->baseUrl();
//			echo '<pre>';
//			print_r($arrParam['cart']['71']);
//			echo '</pre>';
        //var_dump(count($arrParam['cart']));
              
             if(count($arrParam)>0){
                $i = 1;
                foreach ($arrParam as $k => $v){if($k){$i=2;} }
                      
               
               
                if($i == 2)
                {
                    $sl=0;
                     foreach ($arrParam as $key => $val){$item[]=$key; $demo[]=$val;}
                      $ids=implode(",",$item); 
                       for($i=0;$i<count($arrParam);$i++){
                     $id=$item[$i];
                     $sl=$demo[$i]; 
                     
                } 

                 $ids=implode(",",$item); 
                      
                      echo"
 <div style=\"margin-bottom:3px\"><font> Tổng số: <span class=\"so_luong\" > $sl</span> sản phẩm</font></div>
			
			<a href=\"$base/shoppingcart\" ><img style=\"margin-bottom:5px;\"  src=\"$base/template/images/sua-gio-hang.jpg\" align=\"texttop\" /></a>


";

                $query="SELECT * FROM products where id in ($ids) order by position ASC, id DESC";
              
               $stml=$this->db->fetchAll($query); 
               
               return $stml;
				

                }
                else {
                        }
                   } else {
                       
                   }      
		
        }
        
        public function order($arrParam)
	{
              
//			echo '<pre>';
//			print_r($arrParam['cart']['71']);
//			echo '</pre>';
        //var_dump(count($arrParam['cart']));
            
             if(count($arrParam['cart'])>0){
                $i = 1;
                foreach ($arrParam['cart'] as $k => $v){if($k){$i=2;} }
                      
                }
               
                if($i == 2)
                {
                     foreach ($arrParam['cart'] as $key => $val){$item[]=$key; }
                      $ids=implode(",",$item); 

                $query="SELECT * FROM products where id in ($ids) order by position ASC, id DESC";
              
               $stml=$this->db->fetchAll($query); 
               
               return $stml;
				

                }
                else {
                                        echo "Bạn chưa mua hàng";                                        return;}
                        
		
        }
        
        
        
        public function insert_order($address ,$email ,$phone ,$coment ,$member ,$fullname ,$buy)
	{
            
                                        
                 $data=array(
		'address'  =>$address,
		'email'   =>$email,
		'phone' =>$phone,
                'coment' =>$coment,
                'member' =>$member,
                'fullname' =>$fullname,   
                 'date' => time(),
                'buy' =>$buy,
               
		);
                $this->db->insert('order', $data);
                        
		
        }
        
        
}