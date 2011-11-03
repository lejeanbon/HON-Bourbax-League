<?php

class App_Facade_Lecture {

    private $dbUser;
    private $dbAccount;
    private $dbGame;
    private $dbGameResult;
    private $dbReporting;
    private $dbRegistration;

    public function __construct() {
        $this->dbUser = new Application_Model_DbTable_User();
        $this->dbAccount = new Application_Model_DbTable_Account();
        $this->dbGame = new Application_Model_DbTable_Game();
        $this->dbGameResult = new Application_Model_DbTable_GameResult();
        $this->dbReporting = new Application_Model_DbTable_Reporting();
        $this->dbRegistration = new Application_Model_DbTable_Registration();
    }
    
}

?>