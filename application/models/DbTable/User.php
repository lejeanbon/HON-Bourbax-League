<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';
    protected $_primary = 'id';

    public function getByName($name){
        $result = $this->fetchAll(array('username = ?' => $name));
        return new Application_Model_User($result[0]['id'], $result[0]['username'],
                                          $result[0]['password'], $result[0]['right']);
    }

}

