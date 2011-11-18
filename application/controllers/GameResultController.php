<?php

class GameResultController extends App_Controller_Hon
{

    public function init()
    {
        
    }

    public function indexAction()
    {
        $gameId = $this->_request->getParam('game');
        $game = $this->lecture->getGameById($gameId);
        $xml = new App_Xml_XmlServices();
        $gameStat = $xml->getMatchStatsWithItems($game->getGid());
        $this->view->game_id = $gameStat['game_stats']['id'];
        $this->view->players_stats = $gameStat['player_stats'];
        
    }
}

