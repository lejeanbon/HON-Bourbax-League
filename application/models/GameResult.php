<?php

class Application_Model_GameResult{

    private $game_result = array();
    private $base;

    public function  __construct($gameId) {
        $parser = simplexml_load_file("http://xml.heroesofnewerth.com/xml_requester.php?f=match_stats&opt=mid&mid[]=".$gameId);
        $this->base = $parser->stats->match;
    }

    public function process(){
        //var_dump($this->game_result);
        $match = $this->base->match_stats;
        $summ = $this->base->summ;
        foreach ($summ->stat  as $sstat) {
            if($sstat['name'] == 'time_played')
                $this->game_result['time_played'] = (string)$sstat;
            if($sstat['name'] == 'name')
                $this->game_result['server_location'] = (string)$sstat;
            if($sstat['name'] == 'mname')
                $this->game_result['match_name'] = (string)$sstat;

        }
        $this->game_result['player_stats'] = array();
        foreach ($match->ms  as $ms) {
            $id = $ms['aid'];
            $this->game_result['player_stats']['pid_'.$id] = array();
            $this->game_result['player_stats']['pid_'.$id]['hero'] = (string)$ms['cli_name'];
            foreach($ms->stat as $stat){
                if($stat['name'] == 'herokills')
                    $this->game_result['player_stats']['pid_'.$id]['herokills'] = (string)$stat;
                if($stat['name'] == 'deaths')
                    $this->game_result['player_stats']['pid_'.$id]['deaths'] = (string)$stat;
                if($stat['name'] == 'herokills')
                    $this->game_result['player_stats']['pid_'.$id]['heroassists'] = (string)$stat;
                if($stat['name'] == 'hero_id')
                    $this->game_result['player_stats']['pid_'.$id]['hero_img'] = (string)$stat;
                if($stat['name'] == 'teamcreepkills')
                    $this->game_result['player_stats']['pid_'.$id]['creep_kill'] = (string)$stat;
                if($stat['name'] == 'denies')
                    $this->game_result['player_stats']['pid_'.$id]['creep_denie'] = (string)$stat;

            }
        }
        var_dump($this->game_result);
    }

}

