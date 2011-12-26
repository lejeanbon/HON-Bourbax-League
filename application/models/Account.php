<?php

class Application_Model_Account{

    private $id;
    private $name;
    private $aid;
    private $elo;
    private $user;
    private $kill;
    private $death;
    private $assist;
    private $victory;
    private $defeat;

    public function  __construct($id, $name, $aid, $elo, $userId, $kill, $death, $assist, $victory, $defeat) {
        $this->id = $id;
        $this->name = $name;
        $this->aid = $aid;
        $this->elo = $elo;
        $this->user = $userId;
        $this->kill = $kill;
        $this->death = $death;
        $this->assist = $assist;
        $this->victory = $victory;
        $this->defeat = $defeat;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getAid(){
        return $this->aid;
    }

    public function getElo(){
        return $this->elo;
    }

    public function getUser(){
        return $this->user;
    }

    public function getKill(){
        return $this->kill;
    }

    public function getDeath(){
        return $this->death;
    }

    public function getAssist(){
        return $this->assist;
    }

    public function getVictory(){
        return $this->victory;
    }

    public function setVictory($nb){
        $this->victory = $nb;
    }

    public function getDefeat(){
        return $this->defeat;
    }

    public function setDefeat($nb){
        $this->defeat = $nb;
    }

    public function addElo($elo){
        $this->elo += $elo;
    }

    public function addVictory(){
        $this->victory++;
    }

    public function addDefeat(){
        $this->defeat++;
    }

    public function addKill($kill){
        $this->kill += $kill;
    }

    public function addDeath($death){
        $this->death += $death;
    }

    public function addAssist($assist){
        $this->assist += $assist;
    }
}

