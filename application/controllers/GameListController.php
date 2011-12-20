<?php

class GameListController extends App_Controller_Hon{

    public function indexAction(){
        $auth = Zend_Auth::getInstance();
        $user = $this->lecture->getUserByName($auth->getIdentity()->username);
        $accounts = $this->lecture->getAccountsByUser($user);
        $games = array();
        $gamesID = array();
        foreach ($accounts as $account) {
            $myGames = $this->lecture->getGamesByAccount($account);
            foreach ($myGames as $g){
                $gam = $g->getGame();
                $gamesID[] = $gam['gid'];
            }
                //$games[] = $g;
        }
        $xml = new App_Xml_XmlServices();
        $xml->getMatchsStats($gamesID);
        //$this->view->games = $games;
    }


}

