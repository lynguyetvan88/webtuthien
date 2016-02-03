<?php

class Page_RenderController extends Zend_Controller_Action{
    
    public function  showAction(){
        $this->_request->getParam('page');
        
        echo $this->_request->getParam('title');
        
    }
}
?>
