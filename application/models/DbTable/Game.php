<?php

class Application_Model_DbTable_Game extends Zend_Db_Table_Abstract{

    protected $_name = 'game';
    protected $_primary = 'id';

    public function getById($id){
        $result = $this->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        return new Application_Model_Game($row->id, $row->gid, $row->name, $row->status);
    }

}

