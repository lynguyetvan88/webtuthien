<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_BaseUrl  extends Zend_View_Helper_Abstract
{
    public $view;
    public function baseUrl() {
$url = Zend_Controller_Front::getInstance();
return $url->getBaseUrl();
}
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}


