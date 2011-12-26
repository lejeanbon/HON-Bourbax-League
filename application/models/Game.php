<?php

class Application_Model_Game {

    private $id;
    private $gid;
    private $name;
    private $status;

    public function  __construct($id, $gid, $name, $status) {
        $this->id = $id;
        $this->gid = $gid;
        $this->name = $name;
        $this->status = $status;
    }

    public function getId(){
        return $this->id;
    }

    public function getGid(){
        return $this->gid;
    }

    public function getName(){
        return $this->name;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }
}
?>
