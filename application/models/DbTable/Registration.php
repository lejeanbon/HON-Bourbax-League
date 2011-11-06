<?php

class Application_Model_DbTable_Registration extends Zend_Db_Table_Abstract{

    protected $_name = 'registration';
    protected $_primary = 'id';

    public function getAll(){
        $result = $this->fetchAll();
        $entries   = array();
        foreach ($result as $row) {
            $entry = new Application_Model_Registration($row->id, $row->game, $row->account);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function deleteAll(){
        //delete all entries
        $this->delete('1 = 1');
    }

}

