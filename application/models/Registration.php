<?php

class Application_Model_Registration {

    private $id;
    private $game;
    private $account;
    private $user;

    public function __construct($id, $game, $account, $user){
        $this->id = $id;
        $this->game = $game;
        $this->account = $account;
        $this->user = $user;
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

    public function getUser(){
        return $this->user;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setGame($game){
        $this->game = $game;
    }

    public function setAccount($account){
        $this->account = $account;
    }

    public function setUser($user){
        $this->user = $user;
    }
}
?>
