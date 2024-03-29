<?php

class App_Facade_Ecriture {

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
            self::$instance = new App_Facade_Ecriture();
        }
        return self::$instance;
    }

    public function saveAccount(Application_Model_Account $account){
        $this->dbAccount->save($account);
    }

    public function deleteRegistration($id){
        $this->dbRegistration->del($id);
    }

    public function saveRegistration(Application_Model_Registration $registration){
        $this->dbRegistration->save($registration);
    }

    public function saveGame(Application_Model_Game $game){
        $this->dbGame->save($game);
    }

    public function saveGameResult(Application_Model_GameResult $gameResult){
        $this->dbGameResult->save($gameResult);
    }

}
?>
