<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Sildeshow extends Zend_View_Helper_Abstract
{
    public $view;
    public function  sildeshow()
    {
        $side=new Default_Model_Page();
        $side->page_sildeshow();
       
    }
    
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}


