<?php

class AjaxController extends Zend_Controller_Action
{
     public function sendmailAction()
        {
            $this->_helper->layout->disablelayout(true);
            $this->_helper->viewRender->setNoRender(true);
            $sys = new Default_Model_System();
            $list = $sys->list_system();
            $content = $list[0]['content_email'];
            
             $date=date("d-m-Y");
            $mail = new Zend_Mail('utf-8');
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->setBodyHtml($content, 'utf-8');
            $mail->setFrom("dangtintoanquoc@gmail.com", "Khách hàng rong biển");
           // $mail->addBcc("support@toursystem.biz", 'Support Southern Breeze ');
           // $mail->addBcc("sales@toursystem.biz", 'Sales Southern Breeze ');
            $mail->addTo("lynguyetvan88@gmail.com", "Form contact rong biển");
            $mail->addBcc("lpanhly@gmail.com", 'Ly Le');
            //$mail->addBcc("lptruonghung@gmail.com", 'Truong Van Hung');
            $mail->setSubject("Khách hàng rong biển ($date)");
            $mail->send();
            
          
            exit;
        }
}
