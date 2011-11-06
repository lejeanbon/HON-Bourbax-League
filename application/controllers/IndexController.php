<?php

class IndexController extends App_Controller_Hon{

    public function indexAction(){
        $registrations = $this->lecture->getAllRegistration();
        $form = new Application_Form_InscriptionMatchForm();
        $this->view->registrations = $registrations;
        $this->view->form = $form;
        if ($this->_request->isPost()){
            $formData = $this->_request->getPost();
            if ($form->isValid($formData)) {
                //Process d'inscription
                //1 account d'un user par game
            }
        }
        $message=file_get_contents('http://replays.heroesofnewerth.com/player_pop.php?mid=65206064&aid=786740');
        preg_match_all('/<img[^>]+>/i',$message, $matches);
        $items = array();
        foreach($matches[0] as $m){
            if(preg_match("/item_icon/i", $m))
                $items[] = $m;
        }
        var_dump($items);
    }

    public function desinscriptionAction(){
        $this->_redirect('index');
    }
    
}

