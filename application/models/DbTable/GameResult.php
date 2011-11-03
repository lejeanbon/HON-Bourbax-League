<?php

class Application_Model_DbTable_GameResult extends Zend_Db_Table_Abstract
{

    protected $_name = 'game_result';

    public function getByAccount(Application_Model_Account $account){
        $result = $this->fetchAll(array('account = ?' => $account->getId()));
        $entries   = array();
        foreach ($result as $row) {
            $entry = new Application_Model_Account($row->id,
                                                   $row->game,
                                                   $row->account,
                                                   $row->result,
                                                   $row->leave
                    );
            $entries[] = $entry;
        }
        return $entries;
    }
}

