<?php
class Zend_View_Helper_Menuadmin extends Zend_View_Helper_Abstract
{
    public $view;
    public function  menuadmin()
    {
        $this->view->baseurl();
       
        $tring="<div>menu admin tai day</div>";
        return $tring;
    }
    
    
    
     
    public function setView(Zend_View_Interface $view) {
        $this->view=$view;
       
    }
}
?>
