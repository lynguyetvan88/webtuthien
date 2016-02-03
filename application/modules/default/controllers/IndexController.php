<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        $baseurl = $this->_request->getbaseurl();
        //$this->view->headTitle('hello');
        //$this->view->headScript()->appendFile($baseurl.'/jquery.js');
        $this->view->headLink()->appendStylesheet($baseurl . '/css/validationEngine.jquery.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/template/images/MyStyles.css');
        $this->view->headLink()->appendStylesheet($baseurl . '/template/images/styles.css');
    }

    function indexAction() {

        $page = new Default_Model_Page();
        //var_dump($page->add_page_home()); die;
        $this->view->list = $page->add_page_home();
    }

    function contactAction() {
        $muser = new Default_Model_System();
        $conten = $muser->list_system();
        $this->view->book = $conten;

        $captcha = new Zend_Captcha_Image();
        $vi = new Zend_View();
        $base = $vi->baseUrl();
        if (!$this->_request->isPost()) {
            $captcha->setTimeout('300')
                    ->setWordLen('4')
                    ->setHeight('50')
                    ->setWidth('200')
                    ->setImgDir(APPLICATION_PATH . '/../captcha/images/')
                    ->setImgUrl($base . '/captcha/images/')
                    ->setFont(APPLICATION_PATH . '/../font/UTM-Avo.ttf');
            $captcha->generate();
            $this->view->captcha = $captcha->render($this->view);
            $this->view->captchaID = $captcha->getId();
            // Dua chuoi Captcha vao session
            $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captcha->getId());
            $captchaSession->word = $captcha->getWord();
        } else {

            $captchaID = $this->_request->captcha_id;

            $captchaSession = new Zend_Session_Namespace('Zend_Form_Captcha_' . $captchaID);
            $captchaIterator = $captchaSession->getIterator();
            $captchaWord = $captchaIterator['word'];

            if ($this->_request->captcha == $captchaWord) {

                $this->view->purifier = Zend_Registry::get('purifier');
                $conf = HTMLPurifier_Config::createDefault();
                $purifier = new HTMLPurifier($conf);
                $fullname = $purifier->purify($this->_request->getParam('fullname'));
                $address = $purifier->purify($this->_request->getParam('address'));
                $phone = $purifier->purify($this->_request->getParam('phone'));
                $email = $purifier->purify($this->_request->getParam('email'));
                $content = $purifier->purify($this->_request->getParam('content'));
                $title = $purifier->purify($this->_request->getParam('title'));
                $emaillh = $conten[0]['email'];

                $tinnhan = "
			Họ tên : $fullname <br>
			Email : $email<br>
			Địa chỉ : $address<br>
			Điện thoại : $phone<br>
			
			Nội dung : $content<br>";

                require('ham/class.phpmailer.php');
                require('ham/class.pop3.php'); // nạp thư viện
                $mail = new PHPMailer(); // khởi tạo đối tượng
                $mail->IsSMTP(); // gọi class smtp để đăng nhập
                $mail->CharSet = "utf-8"; // bảng mã unicode
                //Đăng nhập Gmail
                $mail->SMTPAuth = true; // Đăng nhập
                $mail->SMTPSecure = "ssl"; // Giao thức SSL
                $mail->Host = "smtp.gmail.com"; // SMTP của GMAIL
                $mail->Port = 465; // cổng SMTP
                // Phải chỉnh sửa lại
                $mail->Username = "dadichvu.88@gmail.com"; // GMAIL username
                $mail->Password = "itwebsite"; // GMAIL password
                $mail->Subject='Thông tin liên hệ';
                $mail->AddAddress("$emaillh"); //email người nhận
                $mail->AddBcc("lynguyetvan88@gmail.com");
                // Chuẩn bị gửi thư nào
                $mail->FromName = mb_convert_encoding($fullname, "UTF-8", "auto");
               // tên người gửi
                $mail->From = "$email"; // mail người gửi
                
                $mail->IsHTML(true); //Bật HTML không thích thì false
                // Nội dung lá thư
                $mail->Body = "$tinnhan";

                // Gửi email

                if ($mail->Send()) {
                    // Gửi không được, đưa ra thông báo lỗi
                    $muser->contact($fullname, $address, $phone, $email, $title, $content);
                    thongbao("Cảm ơn bạn đã liên hệ cho chúng tôi");
                    trangtruoc();
                } else {

                    echo "Không gửi được ";
                    echo "Lỗi: " . $mail->ErrorInfo;
                }
            } else {
                thongbao('Bạn nhập sai chuỗi Captcha');
                trang_truoc();
            }
            $this->_helper->viewRenderer->setNoRender();
            $mask = APPLICATION_PATH . "/../captcha/images/*.png";
            array_map("unlink", glob($mask));
        }
    }

    public function partnerAction() {
        $sys = new Default_Model_Page();
        $this->view->list = $sys->list_cus();
    }

    function pageAction() {

        echo 9878786;
    }

    public function sendmailAction() {

        $sys = new Default_Model_System();
        $list = $sys->list_system();
        $content = $list[0]['content_email'];

        $list_mail = $sys->list_mail();
        foreach ($list_mail as $val) {
            $mail_list = $val['mail'];
            $mail = new Zend_Mail('utf-8');
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->setBodyHtml($content, 'utf-8');
            $mail->setFrom("rongbienhanquocgiare@gmail.com", "Rong biển hàn quốc giá sỉ");
            // $mail->addBcc("support@toursystem.biz", 'Support Southern Breeze ');
            // $mail->addBcc("sales@toursystem.biz", 'Sales Southern Breeze ');
            $mail->addTo("$mail_list", "Customer");
            $mail->addBcc("lpanhly@gmail.com", 'Ly Le');
            //$mail->addBcc("lptruonghung@gmail.com", 'Truong Van Hung');
            $mail->setSubject("Rong biển hàn quốc giá rẻ ");
            //$mail->send();
            $mail->send();
        }
        //  var_dump($demo);
        die;
    }

}

?>
