<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Partners extends Zend_View_Helper_Abstract
{
    public $view;
    public function  partners()
    {
        $side=new Default_Model_Page();
        $side->partners();
       
    }
    
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}


