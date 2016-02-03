<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SystemController
 *
 * @author user
 */
class Default_SystemController extends Zend_Controller_Action {
    public function init() {
       $baseurl=$this->_request->getbaseurl();
       $this->view->headTitle('hello');
        $this->view->headLink()->appendStylesheet($baseurl.'/css/css.css');
        $this->view->headScript()->appendFile($baseurl.'/jquery.js');
        $this->view->headLink()->appendStylesheet($baseurl.'/css/validationEngine.jquery.css');
        
        $this->view->headScript()->appendFile($baseurl.'/js/jquery-1.8.2.min.js');
        $this->view->headScript()->appendFile($baseurl.'/js/languages/jquery.validationEngine-en.js');
        $this->view->headScript()->appendFile($baseurl.'/js/jquery.validationEngine.js');
    }
     public function bannerAction()
       {
         
             echo 123;
       }
}

?>
