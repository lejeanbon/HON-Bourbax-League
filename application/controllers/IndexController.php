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
            $this->view->gameEnCours = $this->lecture->getGameEnCours($this->lecture->getAccountById($session->account));
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

    public function gamefinishedAction(){
        $game = $this->lecture->getGameById($this->_request->getParam('g'));
        if($game->getStatus() == '1'){
            $xml = new App_Xml_XmlServices();
            $stats = $xml->getMatchStatsWithItems($game->getGid());
            if(!is_null($stats)){
                $game->setStatus('2');//Partie terminée
                $this->ecriture->saveGame($game);
                foreach($stats['player_stats'] as $id => $stat){
                    $account = $this->lecture->getAccountByAid(str_replace("pid_", "", $id));
                    $gameRes = new Application_Model_GameResult(null, $game, $account, $stat['win'], '$leave',
                            '$name', $stat['herokills'], $stat['deaths'], $stat['heroassists'], $stat['creep_kill'],
                            $stat['creep_denie'], $stat['gpm'], $stat['apm'], $stat['xpm'], $stat['level'], '$item1',
                            '$item2', '$item3', '$item4', '$item5', '$item6', $stat['position']);
                    $this->ecriture->saveGameResult($gameRes);
                    if($stat['win'] == '1'){
                        $account->addVictory();
                        $account->addElo(5);
                    }
                    else{
                        $account->addDefeat();
                        $account->addElo(-5);
                    }
                    $account->addKill($stat['herokills']);
                    $account->addDeath($stat['deaths']);
                    $account->addAssist($stat['heroassists']);
                    $this->ecriture->saveAccount($account);
                }
                $this->_redirect('index', array('registrationMess' => 'Partie enregistrée, classement mis à jour'));
            }
            else
                $this->_redirect('index', array('registrationMess' => 'Numéro de partie inconnue'));
        }
        else
            $this->_redirect('index', array('registrationMess' => 'Partie déjà cloturée'));
    }
    
}

