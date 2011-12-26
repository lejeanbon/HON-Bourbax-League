<?php

class Application_Model_GameResult{

    private $id;
    private $game;
    private $account;
    private $result;
    private $leave;
    private $name;
    private $kill;
    private $death;
    private $assist;
    private $ckill;
    private $cdeny;
    private $gpm;
    private $apm;
    private $xpm;
    private $level;
    private $item1;
    private $item2;
    private $item3;
    private $item4;
    private $item5;
    private $item6;
    private $position;

    public function  __construct($id, $game, $account, $result, $leave, $name,
                                 $kill, $death, $assist, $ckill, $cdeny, $gpm,
                                 $apm, $xpm, $level, $item1, $item2, $item3, $item4,
                                 $item5, $item6, $position) {
        $this->id = $id;
        $this->game = $game;
        $this->account = $account;
        $this->result = $result;
        $this->leave = $leave;
        $this->name = $name;
        $this->kill = $kill;
        $this->death = $death;
        $this->assist = $assist;
        $this->ckill = $ckill;
        $this->cdeny = $cdeny;
        $this->gpm = $gpm;
        $this->apm = $apm;
        $this->xpm = $xpm;
        $this->level = $level;
        $this->item1 = $item1;
        $this->item2 = $item2;
        $this->item3 = $item3;
        $this->item4 = $item4;
        $this->item5 = $item5;
        $this->item6 = $item6;
        $this->position = $position;
    }

    public function getResult(){
        return $this->result;
    }

    public function getId(){
        return $this->id;
    }

    public function getGame(){
        return $this->game;
    }

    public function getAccount(){
        return $this->account;
    }

    public function getLeave(){
        return $this->leave;
    }

    public function getGameStat(){
        $xml = new App_Xml_XmlServices();
        $game = $this->getGame();
        $gameStat = $xml->getMatchStats($game['gid']);
        return $gameStat;
    }

    public function getName(){
        return $this->name;
    }

    public function getKill(){
        return $this->kill;
    }

    public function getDeath(){
        return $this->death;
    }

    public function getAssists(){
        return $this->assist;
    }

    public function getCKill(){
        return $this->ckill;
    }

    public function getCDeny(){
        return $this->cdeny;
    }

    public function getGPM(){
        return $this->gpm;
    }

    public function getAPM(){
        return $this->apm;
    }

    public function getXPM(){
        return $this->xpm;
    }

    public function getLevel(){
        return $this->level;
    }

    public function getItem1(){
        return $this->item1;
    }

    public function getItem2(){
        return $this->item2;
    }

    public function getItem3(){
        return $this->item3;
    }

    public function getItem4(){
        return $this->item4;
    }

    public function getItem5(){
        return $this->item5;
    }

    public function getItem6(){
        return $this->item6;
    }

    public function getPosition(){
        return $this->position;
    }

    /*public function process(){
        //var_dump($this->game_result);
        $match = $this->base->match_stats;
        $summ = $this->base->summ;
        $this->game_result['player_stats'] = array();
        $this->game_result['game_stats'] = array();
        foreach ($summ->stat  as $sstat) {
            if($sstat['name'] == 'time_played'){
                $this->game_result['game_stats']['time_played'] = (string)$sstat;
                $this->time = (string)$sstat;
            }
            if($sstat['name'] == 'name')
                $this->game_result['game_stats']['server_location'] = (string)$sstat;
            if($sstat['name'] == 'mname')
                $this->game_result['game_stats']['match_name'] = (string)$sstat;
            if($sstat['name'] == 'mdt')
                $this->game_result['game_stats']['date'] = (string)$sstat;

        }
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
                if($stat['name'] == 'actions'){
                    $this->game_result['player_stats']['pid_'.$id]['apm'] = (int)($stat/($this->time/60));
                }
                if($stat['name'] == 'gold'){
                    $this->game_result['player_stats']['pid_'.$id]['gpm'] = (int)($stat/($this->time/60));
                }
                if($stat['name'] == 'exp'){
                    $this->game_result['player_stats']['pid_'.$id]['xpm'] = (int)($stat/($this->time/60));
                }
                if($stat['name'] == 'level')
                    $this->game_result['player_stats']['pid_'.$id]['level'] = (string)$stat;
                if($stat['name'] == 'position')
                    $this->game_result['player_stats']['pid_'.$id]['position'] = (string)$stat;
            }
        }
    }

    public function getStatsGame(){
        return $this->game_result["game_stats"];
    }

    public function getStatsPlayers(){
        return $this->game_result["player_stats"];
    }*/

}

