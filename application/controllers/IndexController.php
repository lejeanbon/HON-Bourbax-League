<?php

class IndexController extends App_Controller_Hon{

    public function indexAction(){
        if( Zend_Auth::getInstance()->hasIdentity()){
            $registrations = $this->lecture->getAllRegistration();
            $form = new Application_Form_InscriptionMatchForm();
            $session = Zend_Registry::get('Session');
            $user = $this->lecture->getUserById(Zend_Auth::getInstance()->getIdentity()->id);
            $accounts = $this->lecture->getAccountsByUser($this->lecture->getUserById($user->getId()));
            if(is_null($session->account))
                $session->account = $accounts[0]->getId();
            $this->view->registrations = $registrations;
            $this->view->form = $form;
            if ($this->_request->isPost()){
                $formData = $this->_request->getPost();
                if ($form->isValid($formData) && isset($formData['Participer'])) {
                    if(!$this->lecture->isUserRegisted($user)){
                        $session = Zend_Registry::get('Session');
                        $game = $this->lecture->getInscriptionGame();
                        $this->ecriture->saveRegistration(new Application_Model_Registration(null, $game->getId(), $session->account, $user->getId()));
                        $this->_redirect('index');
                    }
                     else
                        $this->view->registrationError = "Un de vos accounts est déjà inscrit";
                }
            }
        }
    }

    public function desinscriptionAction(){
        $this->ecriture->deleteRegistration($this->_request->getParam('reg'));
        $this->_redirect('index', array('registrationMess' => 'Inscription supprimée'));
    }
    
}

