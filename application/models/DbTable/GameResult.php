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

    public function getAverageStat(Application_Model_Account $account){
        $req = $this->_db->select()->from($this->_name, array('SUM(xpm) AS xpm', 
                                                              'SUM(gpm) AS gpm',
                                                              'SUM(apm) AS apm',
                                                              'SUM(cdeny) AS cdeny',
                                                              'SUM(ckill) AS ckill',
                                                              'SUM(`kill`) AS kill',
                                                              'SUM(death) AS death',
                                                              'SUM(assist) AS assist'))
                                   ->where('account =' . $account->getId());
        $stmt = $this->_db->query($req);
        $tmp = $stmt->fetchAll();
        return $tmp[0];
    }

    public function getByAccount(Application_Model_Account $account){
        $result = $this->fetchAll(array('account = ?' => $account->getId()));
        $entries   = array();
        foreach ($result as $row) {
            $entry = new Application_Model_GameResult($row->id,
                                                      $row->findParentRow('Application_Model_DbTable_Game', 'Game'),
                                                      $row->findParentRow('Application_Model_DbTable_Account', 'Account'),
                                                      $row->result, $row->leave, $row->name,
                                                      $row->kill, $row->death, $row->assist, $row->ckill,
                                                      $row->cdeny, $row->gpm, $row->apm, $row->xpm, $row->level,
                                                      $row->item1, $row->item2, $row->item3, $row->item4, $row->item5,
                                                      $row->item6, $row->position);
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

    public function save(Application_Model_GameResult $gameResult){
        $data = array(
                    'id'   => $gameResult->getId(),
                    'game' => $gameResult->getGame()->getId(),
                    'account'  => $gameResult->getAccount()->getId(),
                    'result'  => $gameResult->getResult(),
                    'leave' => $gameResult->getLeave(),
                    'name' => $gameResult->getName(),
                    'kill' => $gameResult->getKill(),
                    'death' => $gameResult->getDeath(),
                    'assist' => $gameResult->getAssists(),
                    'ckill' => $gameResult->getCKill(),
                    'cdeny' => $gameResult->getCDeny(),
                    'gpm' => $gameResult->getGPM(),
                    'apm' => $gameResult->getAPM(),
                    'xpm' => $gameResult->getXPM(),
                    'level' => $gameResult->getLevel(),
                    'item1' => $gameResult->getItem1(),
                    'item2' => $gameResult->getItem2(),
                    'item3' => $gameResult->getItem3(),
                    'item4' => $gameResult->getItem4(),
                    'item5' => $gameResult->getItem5(),
                    'item6' => $gameResult->getItem6(),
                    'position' => $gameResult->getPosition()
                );

        if (null === ($id = $gameResult->getId())) {
            unset($data['id']);
            return $this->insert($data);
        }
        else {
            $this->update($data, array('id = ?' => $id));
        }
    }
}

