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
        $gameStat = $xml->getMatchStats($game->getGid());
        $this->view->game_stats = $gameStat['game_stats'];
        $this->view->players_stats = $gameStat['player_stats'];
        
    }
}

