<?php

class App_Facade_Lecture {

    private static $instance;
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

    public static function getInstance(){
        if ( !isset(self::$instance) ) {
            self::$instance = new App_Facade_Lecture();
        }
        return self::$instance;
    }

    public function getUserByName($name){
       return $this->dbUser->getByName($name);
    }

    public function getUserById($id){
        return $this->dbUser->getById($id);
    }

    public function getAccountsByUser(Application_Model_User $user){
        return $this->dbAccount->getAllByUser($user);
    }

    public function getGamesByAccount(Application_Model_Account $account){
        return $this->dbGameResult->getByAccount($account);
    }

    public function getGameById($id){
        return $this->dbGame->getById($id);
    }

    public function getAccountsByElo(){
        return $this->dbAccount->getAccountsByElo();
    }

    public function getVictoryByAccount(Application_Model_Account $account){
        return $this->dbGameResult->getVictoryByAccount($account);
    }

    public function getDefeatByAccount(Application_Model_Account $account){
        return $this->dbGameResult->getDefeatByAccount($account);
    }

    public function getAllRegistration(){
        $registrations = $this->dbRegistration->getAll();
        $return = array();
        foreach ($registrations as $reg){
            $reg->setAccount($this->dbAccount->getById($reg->getAccount()));
            $reg->setGame($this->dbGame->getById($reg->getGame()));
            $return[] = $reg;
        }
        return $return;
    }

    public function isUserRegisted(Application_Model_User $user){
        return $this->dbRegistration->isUserRegisted($user);
    }

    public function getInscriptionGame(){
        return $this->dbGame->getInscriptionGame();
    }
    
}

?>