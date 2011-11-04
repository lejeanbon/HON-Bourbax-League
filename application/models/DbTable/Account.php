<?php

class Application_Model_DbTable_Account extends Zend_Db_Table_Abstract
{

    protected $_name = 'account';
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user'),
            'refTableClass' => 'Application_Model_DbTable_User',
            'refColumns' => array('id')
        )
    );

    public function getAllByUser(Application_Model_User $user){
        $result = $this->fetchAll(array('user = ?' => $user->getId()));
        $entries = array();
        foreach ($result as $row) {
            $entries[] = new Application_Model_Account($row['id'], $row['name'], $row['aid'], $row['elo'], 
                                                       $row['user'], $row['kill'], $row['death'], $row['assist']);
        }
        return $entries;
    }

    public function save(Application_Model_Account $account){
        $data = array(
                    'id'   => $account->getId(),
                    'name' => $account->getName(),
                    'aid'  => $account->getAid(),
                    'elo'  => $account->getElo(),
                    'user' => $account->getUser(),
                    'kill' => $account->getKill(),
                    'death' => $account->getDeath(),
                    'assist' => $account->getAssist()
                );

        if (null === ($id = $account->getId())) {
            unset($data['id']);
            return $this->insert($data);
        }
        else {
            $this->update($data, array('id = ?' => $id));
        }
    }

    public function getAccountsByElo(){
        $result = $this->fetchAll($this->select()->order('elo DESC'));
        $entries = array();
        foreach ($result as $row) {
            $entries[] = new Application_Model_Account($row['id'], $row['name'], $row['aid'], $row['elo'],
                                                       $row['user'], $row['kill'], $row['death'], $row['assist']);
        }
        return $entries; 
    }

}

