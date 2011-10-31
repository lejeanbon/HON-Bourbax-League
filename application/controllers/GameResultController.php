<?php

class GameResultController extends Zend_Controller_Action
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $gm = new Application_Model_GameResult("66880040");
        $gm->process();
        //echo 'id match : '.$base['mid'];
        $this->view->game_stats = $gm->getStatsGame();
        $this->view->players_stats = $gm->getStatsPlayers();
        
    }
}

