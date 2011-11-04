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

    public function  __construct($id, $name, $aid, $elo, $userId, $kill, $death, $assist) {
        $this->id = $id;
        $this->name = $name;
        $this->aid = $aid;
        $this->elo = $elo;
        $this->user = $userId;
        $this->kill = $kill;
        $this->death = $death;
        $this->assist = $assist;
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
}

