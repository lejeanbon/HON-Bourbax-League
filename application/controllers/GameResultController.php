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
        //$this->view->match_stats = $parser->stats->match->match_stats;
        
    }
}

