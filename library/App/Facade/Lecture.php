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

    /**
     *
     * @param String $name
     * @return Application_Model_User
     */
    public function getUserByName($name){
       return $this->dbUser->getByName($name);
    }

    /**
     *
     * @param int $id
     * @return Application_Model_User
     */
    public function getUserById($id){
        return $this->dbUser->getById($id);
    }

    /**
     *
     * @param Application_Model_User $user
     * @return Application_Model_Account
     */
    public function getAccountsByUser(Application_Model_User $user){
        return $this->dbAccount->getAllByUser($user);
    }

    /**
     *
     * @param int $id
     * @return Application_Model_Account
     */
    public function getAccountById($id){
        return $this->dbAccount->getById($id);
    }

    /**
     *
     * @param Application_Model_Account $account
     * @return Application_Model_GameResult
     */
    public function getGamesByAccount(Application_Model_Account $account){
        return $this->dbGameResult->getByAccount($account);
    }

    /**
     *
     * @param int $id
     * @return Application_Model_Game
     */
    public function getGameById($id){
        return $this->dbGame->getById($id);
    }

    /**
     * Liste des accounts tries par elo
     * @return array Application_Model_Account
     */
    public function getAccountsByElo(){
        return $this->dbAccount->getAccountsByElo();
    }

    /**
     * Cherche un compte selon son aid HON
     * @param int $aid
     */
    public function getAccountByAid($aid){
        return $this->dbAccount->getAccountByAid($aid);
    }

    /**
     * Nombre de victoire par account
     * @param Application_Model_Account $account
     * @return int
     */
    public function getVictoryByAccount(Application_Model_Account $account){
        return $this->dbGameResult->getVictoryByAccount($account);
    }

    /**
     * Nombre de defaite par account
     * @param Application_Model_Account $account
     * @return int
     */
    public function getDefeatByAccount(Application_Model_Account $account){
        return $this->dbGameResult->getDefeatByAccount($account);
    }

    /**
     * Recupere les personnes enregistrees pour faire une partie
     * @return array Application_Model_Registration
     */
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

    /**
     * Vérifie si un utilisateur est deja enregistre pour une game
     * @param Application_Model_User $user
     * @return boolean
     */
    public function isUserRegisted(Application_Model_User $user){
        return $this->dbRegistration->isUserRegisted($user);
    }

    /**
     * Cherche une partie pour s'inscrire
     * @return Application_Model_Game
     */
    public function getInscriptionGame(){
        return $this->dbGame->getInscriptionGame();
    }

    /**
     * Retourne les games en cours de l'account (normalement une ^^)
     * @param Application_Model_Account $account
     */
    public function getGameEnCours(Application_Model_Account $account){
        return $this->dbGame->getGameEnCours($account);
    }

    /**
     * Fourni les stats moyenne d'un compte
     * @param Application_Model_Account $account
     */
    public function getAverageStats(Application_Model_Account $account){
        return $this->dbGameResult->getAverageStat($account);
    }
    
}

?>