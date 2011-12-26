<?php

class Application_Model_DbTable_Registration extends Zend_Db_Table_Abstract{

    protected $_name = 'registration';
    protected $_primary = 'id';

    public function getAll(){
        $select = $this->_db->select()
             ->from(array('g' => 'game'))
             ->join(array('r' => 'registration'), 'g.id = r.game', array('id AS r_id', 'game', 'account', 'user'))
             ->where('g.status = ?', '0');
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        $entries   = array();
        foreach ($result as $row) {
            $entry = new Application_Model_Registration($row['r_id'], $row['game'], $row['account'], $row['user']);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function deleteAll(){
        //delete all entries
        $this->delete('1 = 1');
    }

    public function del($id){
        $this->delete('id = '.$id);
    }

    public function save(Application_Model_Registration $registration){
        $data = array(
                    'id'   => $registration->getId(),
                    'game' => $registration->getGame(),
                    'account'  => $registration->getAccount(),
                    'user'  => $registration->getUser()
                );
        if (null === ($id = $registration->getId())) {
            unset($data['id']);
            return $this->insert($data);
        }
        else {
            $this->update($data, array('id = ?' => $id));
        }
    }

    public function isUserRegisted(Application_Model_User $user){
        $result = $this->fetchAll(array('user = ?' => $user->getId()));
        if (0 == count($result))
            return false;
        return true;
    }

}

