<?php

class App_Xml_XmlServices {

    private $nickToId = "http://xml.heroesofnewerth.com/xml_requester.php?f=nick2id&opt=nick&nick[]=";
    private $matchStat = "http://xml.heroesofnewerth.com/xml_requester.php?f=match_stats&opt=mid&mid[]=";

    public function getIdFromNickname($nickname){
        $parser = simplexml_load_file($this->nickToId.$nickname);
        return (string)$parser->accounts->account_id;
    }

    public function getMatchStats($gameId){
        $parser = simplexml_load_file($this->matchStat.$gameId);
        $base = $parser->stats->match;
        $match = $base->match_stats;
        $summ = $base->summ;
        $time = 0;
        $game_result['player_stats'] = array();
        $game_result['game_stats'] = array();
        foreach ($summ->stat  as $sstat) {
            if($sstat['name'] == 'time_played'){
                $game_result['game_stats']['time_played'] = (string)$sstat;
                $time = (string)$sstat;
            }
            if($sstat['name'] == 'name')
                $game_result['game_stats']['server_location'] = (string)$sstat;
            if($sstat['name'] == 'mname')
                $game_result['game_stats']['match_name'] = (string)$sstat;
            if($sstat['name'] == 'mdt')
                $game_result['game_stats']['date'] = (string)$sstat;

        }
        foreach ($match->ms  as $ms) {
            $id = $ms['aid'];
            $game_result['player_stats']['pid_'.$id] = array();
            $game_result['player_stats']['pid_'.$id]['hero'] = (string)$ms['cli_name'];
            foreach($ms->stat as $stat){
                if($stat['name'] == 'herokills')
                    $game_result['player_stats']['pid_'.$id]['herokills'] = (string)$stat;
                if($stat['name'] == 'deaths')
                    $game_result['player_stats']['pid_'.$id]['deaths'] = (string)$stat;
                if($stat['name'] == 'herokills')
                    $game_result['player_stats']['pid_'.$id]['heroassists'] = (string)$stat;
                if($stat['name'] == 'hero_id')
                    $game_result['player_stats']['pid_'.$id]['hero_img'] = (string)$stat;
                if($stat['name'] == 'teamcreepkills')
                    $game_result['player_stats']['pid_'.$id]['creep_kill'] = (string)$stat;
                if($stat['name'] == 'denies')
                    $game_result['player_stats']['pid_'.$id]['creep_denie'] = (string)$stat;
                if($stat['name'] == 'actions'){
                    $game_result['player_stats']['pid_'.$id]['apm'] = (int)($stat/($time/60));
                }
                if($stat['name'] == 'gold'){
                    $game_result['player_stats']['pid_'.$id]['gpm'] = (int)($stat/($time/60));
                }
                if($stat['name'] == 'exp'){
                    $game_result['player_stats']['pid_'.$id]['xpm'] = (int)($stat/($time/60));
                }
                if($stat['name'] == 'level')
                    $game_result['player_stats']['pid_'.$id]['level'] = (string)$stat;
                if($stat['name'] == 'position')
                    $game_result['player_stats']['pid_'.$id]['position'] = (string)$stat;
            }
        }
        return $game_result;
    }
}
?>
