<?php

class Application_Model_Registration {

    private $id;
    private $game;
    private $account;

    public function __construct($id, $game, $account){
        $this->id = $id;
        $this->game = $game;
        $this->account = $account;
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

    public function setId($id){
        $this->id = $id;
    }

    public function setGame($game){
        $this->game = $game;
    }

    public function setAccount($account){
        $this->account = $account;
    }
}
?>
