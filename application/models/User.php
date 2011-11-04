<?php

class Application_Model_User {

    private $id;
    private $username;
    private $password;
    private $right;

    public function  __construct($id, $username, $password, $right) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->right = $right;
    }

    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRight(){
        return $this->right;
    }
}
?>
