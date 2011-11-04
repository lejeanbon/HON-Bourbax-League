<?php

class Application_Model_DbTable_GameResult extends Zend_Db_Table_Abstract
{

    protected $_name = 'game_result';
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'Game' => array(
            'columns' => array('game'),
            'refTableClass' => 'Application_Model_DbTable_Game',
            'refColumns' => array('id')
        ),
        'Account' => array(
            'columns' => array('account'),
            'refTableClass' => 'Application_Model_DbTable_Account',
            'refColumns' => array('id')
        )
    );

    public function getByAccount(Application_Model_Account $account){
        $result = $this->fetchAll(array('account = ?' => $account->getId()));
        $entries   = array();
        foreach ($result as $row) {
            $entry = new Application_Model_GameResult($row->id,
                                                      $row->findParentRow('Application_Model_DbTable_Game', 'Game'),
                                                      $row->findParentRow('Application_Model_DbTable_Account', 'Account'),
                                                      $row->result,
                                                      $row->leave);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function getVictoryByAccount(Application_Model_Account $account){
        return $this->fetchAll(array('result = ?' => '1', 'account = ?' => $account->getId()))->count();
    }

    public function getDefeatByAccount(Application_Model_Account $account){
        return $this->fetchAll(array('result = ?' => '0', 'account = ?' => $account->getId()))->count();
    }
}

