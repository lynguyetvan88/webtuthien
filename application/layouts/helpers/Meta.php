<?php

// Zend_View_Helper co dinh
class Zend_View_Helper_Meta extends Zend_View_Helper_Abstract
{
    public $view;
    public function  meta()
    {
        $meta= new Default_Model_System();
        $meta->meta();
       
       
    }
    
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}


