<?php

class AccountController extends App_Controller_Hon{

    public function indexAction(){
        $auth = Zend_Auth::getInstance();
        $user = $this->lecture->getUserByName($auth->getIdentity()->username);
        $form = new Application_Form_AccountForm();
        $this->view->accounts = $this->lecture->getAccountsByUser($user);
        $this->view->form = $form;
        if ($this->_request->isPost()){
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                $account = $formData['name'];
                $id = $this->xmlServices->getIdFromNickname($account);
                if($id == "")
                    $form->getElement("name")->addError("Nom de compte inexistant");
                else{
                    $this->ecriture->saveAccount (new Application_Model_Account (null, $account, $id, 1500, $user->getId(), 0, 0, 0));
                   $this->_redirect('account');
                }
            }
        }
    }
}
?>
