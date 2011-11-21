<?php

class AjaxController extends App_Controller_Hon{

    public function init(){
        $this->_helper->layout->disableLayout();
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext->addActionContext('items','html')
                    ->addActionContext('account','html')
                    ->initContext();
    }

    public function indexAction(){
        // action body
    }

    public function itemsAction(){
        $playerId = $this->_request->getParam('aid');
        $gameId = $this->_request->getParam('gim');
        $xmlServices = new App_Xml_XmlServices();
        $re = '';
        foreach($xmlServices->getItems($gameId, $playerId) as $element){
             $re = $re.'<img width=40 src="'.$element->src.'" />';
        }
        $this->view->items = $re;
    }

    public function accountAction(){
        $session = Zend_Registry::get('Session');
        $session->account = $this->_request->getParam('a');
    }


}

