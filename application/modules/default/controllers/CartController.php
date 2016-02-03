<?php

class CartController extends Zend_Controller_Action{
    
    //Mang tham so nhan duoc o moi Action
	protected $_arrParam;
	
	//Duong dan cua Controller
	protected $_currentController;
	
	//Duong dan cua Action chinh
	protected $_actionMain;
	
	
	protected $_namespace;
    
    public function init() {
        //Mang tham so nhan duoc o moi Action
		$this->_arrParam = $this->_request->getParams();
       $baseurl=$this->_request->getbaseurl();
      
		
		
                
        $this->view->headLink()->appendStylesheet($baseurl.'/css/validationEngine.jquery.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/MyStyles.css');
        $this->view->headLink()->appendStylesheet($baseurl.'/template/images/styles.css');
     
    }

  
    
      function  indexAction()
    {
                //Zend_Session::namespaceUnset('cart');
                $yourCart = new Zend_Session_Namespace('cart');
		//$yourCart->count= ham_1($yourCart->count);
		$ssInfo = $yourCart->getIterator();
		
		$filter = new Zend_Filter_Digits();
		$id = $filter->filter($this->_arrParam['id']);
			
		if(count($yourCart->cart) == 0){
			
			$cart[$id] = 1;
			$yourCart->cart = $cart;
		}else{
			//echo '<br>Trong gio hang da co san pham';
			$tmp = $ssInfo['cart'];
			if(array_key_exists($id,$tmp) == true){
				$tmp[$id] = $tmp[$id] + 1;
			}else{
				$tmp[$id] = 1;
			}
			
			 $yourCart->cart = $tmp;
                        
			
		}
                
                $base= new Zend_View();
                $link= $base->baseUrl();
                $url=$link."/shoppingcart";
               chuyen_trang($url);
		
      
        
    }
     function  cartAction()
    {
        
       
                $yourCart = new Zend_Session_Namespace('cart');
		
		if($this->_request->isPost()){
			$itemProduct = $this->_arrParam['itemProduct'];
			
			if(count($itemProduct)>0)
				foreach($itemProduct as $key => $val){
					if($val == 0 ){
						unset($itemProduct[$key]);
				}
			}
			
			$yourCart->cart = $itemProduct;
		}
		
		//echo count ($yourCart->cart);
		
		$ssInfo = $yourCart->getIterator();
		//var_dump($ssInfo);
		$tblProduct = new Default_Model_Cart();
		$this->_arrParam['cart'] = $ssInfo['cart'];
		if (count($this->_arrParam['cart'])>0){
		$this->view->Items = $tblProduct->listcart($this->_arrParam);
		$this->view->cart =  $ssInfo['cart'];
                
                
                
                
                // thanh toan
                $muser= new Default_Model_System();
        $conten=$muser->list_system();
        $this->view->book=$conten;
        
        
        
      } else 
          { //echo "Bạn chưa mua hàng";
      
      }	
        
    }
    
   
    
    function  orderAction()
    {
        
       
                $yourCart = new Zend_Session_Namespace('cart');
		
		if($this->_request->isPost()){
			$itemProduct = $this->_arrParam['itemProduct'];
			
			if(count($itemProduct)>0)
				foreach($itemProduct as $key => $val){
					if($val == 0 ){
						unset($itemProduct[$key]);
				}
			}
			
			$yourCart->cart = $itemProduct;
		}
		
		//echo count ($yourCart->cart);
		
		$ssInfo = $yourCart->getIterator();
		//var_dump($ssInfo);
		$tblProduct = new Default_Model_Cart();
		$this->_arrParam['cart'] = $ssInfo['cart'];
		if (count($this->_arrParam['cart'])>0){
		$this->view->Items = $tblProduct->listcart($this->_arrParam);
		$this->view->cart =  $ssInfo['cart'];
                
                $buy="";
                foreach ($ssInfo['cart'] as $key => $val){
                    $item[]=$key; $demo[]=$val; 
                   //  echo $key;
                   //  echo $val;                    
                    }
                
                for($i=0;$i<count($ssInfo['cart']);$i++){
                    $id=$item[$i];
                    $sl=$demo[$i];
                     $buy=$buy."$id"."___"."$sl"."______";
                }
                 $buy=substr($buy,0,-6);
                // thanh toan
                $muser= new Default_Model_Cart();
       
        
        $captcha = new Zend_Captcha_Image();
        $vi=new Zend_View();
        $base=$vi->baseurl();
       if(!$this->_request->isPost()){
           $captcha->setTimeout('300')               
                 ->setWordLen('4')
                 ->setHeight('50')        
                 ->setWidth('320')   
                 ->setImgDir(APPLICATION_PATH . '/../public_html/captcha/images/')
                 ->setImgUrl($base.'/captcha/images/')
                 ->setFont(APPLICATION_PATH .'/../public_html/font/UTM-Avo.ttf'); 
         
          $captcha->generate(); 
          $this->view->captcha = $captcha->render($this->view);  
          $this->view->captchaID = $captcha->getId();
            // Dua chuoi Captcha vao session
          $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha->getId());
          $captchaSession->word = $captcha->getWord();
          
      }else{
                  
         $captchaID = $this->_request->captcha_id; 
         
         $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captchaID);
         $captchaIterator = $captchaSession->getIterator();
         $captchaWord = $captchaIterator['word'];
         
         if($this->_request->captcha == $captchaWord){
            $session = new Zend_Session_Namespace('identity');
             $username =$session->username;
            
            $this->view->purifier = Zend_Registry::get('purifier');
            $conf=  HTMLPurifier_Config::createDefault();
            $purifier = new HTMLPurifier($conf);
            $fullname = $purifier->purify($this->_request->getParam('fullname'));
            $address= $purifier->purify($this->_request->getParam('address'));
            $phone = $purifier->purify($this->_request->getParam('phone'));
            $email = $purifier->purify($this->_request->getParam('email'));
            $coment = $purifier->purify($this->_request->getParam('coment'));
            $title = $purifier->purify($this->_request->getParam('title'));
            $emaillh = "lynguyetvan88@gmail.com";
            
            $tinnhan="
			Họ tên : $fullname <br>
			Email : $email<br>
			Địa chỉ : $address<br>
			Điện thoại : $phone<br>
			
			Nội dung : $coment<br>";
            
            $to      = $emaillh;
            $subject = $title;
            $message = $tinnhan;
            $headers = 'Content-type: text/html;charset=utf-8';
	    mail($to, $subject, $message, $headers);
            
            	 // Thiết lập SMTP Server
					require('ham/class.phpmailer.php'); 
                                        require('ham/class.pop3.php');// nạp thư viện
					$mailer = new PHPMailer(); // khởi tạo đối tượng
					$mailer->IsSMTP(); // gọi class smtp để đăng nhập
					$mailer->CharSet="utf-8"; // bảng mã unicode
					
					//Đăng nhập Gmail
					$mailer->SMTPAuth = true; // Đăng nhập
					$mailer->SMTPSecure = "ssl"; // Giao thức SSL
					$mailer->Host = "smtp.gmail.com"; // SMTP của GMAIL
					$mailer->Port = 465; // cổng SMTP
					
					// Phải chỉnh sửa lại
					$mailer->Username = "dadichvu.88@gmail.com"; // GMAIL username
					$mailer->Password = "itwebsite"; // GMAIL password
					$mailer->AddAddress("$emaillh",'Recipient Name'); //email người nhận
					 
					// Chuẩn bị gửi thư nào
					$mailer->FromName = "$fullname"; // tên người gửi
					$mailer->From = "$email"; // mail người gửi
					$mailer->Subject = "$base";
					$mailer->IsHTML(true); //Bật HTML không thích thì false
					 
					// Nội dung lá thư
					$mailer->Body = "$tinnhan";
					 
					// Gửi email
					 
					if(!$mailer->Send())
					{
					// Gửi không được, đưa ra thông báo lỗi
				
					echo "Không gửi được ";
					echo "Lỗi: " . $mailer->ErrorInfo;
					}
					else
					{
					 
					$muser->insert_order($address, $email, $phone, $coment, $username, $fullname, $buy);
                                        Zend_Session::namespaceUnset('cart');
                                        thongbao("Cảm ơn bạn đã liên hệ cho chúng tôi");                                        
                                        chuyen_trang($base);
					 
					}
			
            
        }
        else{
             thongbao('Bạn nhập sai chuỗi Captcha');
             trang_truoc();
         }
          $this->_helper->viewRenderer->setNoRender();
        $mask = APPLICATION_PATH."/../public_html/captcha/images/*.png"; 
        array_map("unlink",glob($mask)); 
      } 
        
      } else 
          { //echo "Bạn chưa mua hàng";
      
      }	
        
    }
   
}
?>
