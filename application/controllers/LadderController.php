<?php

class LadderController extends App_Controller_Hon{

    public function indexAction(){
         $accounts = $this->lecture->getAccountsByElo();
         $tmp = array();
         foreach($accounts as $account){
             $account->setVictory($this->lecture->getVictoryByAccount($account));
             $account->setDefeat($this->lecture->getDefeatByAccount($account));
             $tmp[] = $account;
         }
         $this->view->accounts = $tmp;
    }


}

