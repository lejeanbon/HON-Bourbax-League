<?php

class GameListController extends App_Controller_Hon
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        $user = $this->lecture->getUserByName($auth->getIdentity()->username);
        $accounts = $this->lecture->getAccountsByUser($user);
        $games = array();
        foreach ($accounts as $account) {
            $myGames = $this->lecture->getGamesByAccount($account);
            foreach ($myGames as $g) {
                $games[] = $g;
            }
        }
        $this->view->games = $games;
    }


}

