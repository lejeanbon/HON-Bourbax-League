<?php

class ProfilController extends App_Controller_Hon{

    public function indexAction(){
        $id = $this->_request->getParam('id');
        if(!is_null($id))
            $account = $this->lecture->getAccountById($id);
        else
            $account = $this->lecture->getAccountById(Zend_Registry::get('Session')->account);
        $this->view->stats = $this->lecture->getAverageStats($account);
        $this->view->account = $account;
    }
}
?>
