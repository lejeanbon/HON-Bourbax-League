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

    public function getInscriptionGame(){
        $games = $this->fetchAll(array('gid is null'));
        $row = $games->current();
        return new Application_Model_Game($row->id, $row->gid, $row->name, $row->status);
    }

    public function getGameEnCours(Application_Model_Account $account){
        $select = $this->_db->select()
             ->from(array('g' => 'game'), array('name', 'id AS game_id', 'gid', 'status'))
             ->join(array('r' => 'registration'), 'g.id = r.game')
             ->where('r.account = ?', $account->getId())
             ->where('g.status = ?', '1');
        $stmt = $this->_db->query($select);
        $result = $stmt->fetchAll();
        if(empty ($result))
            return null;
        $row = $result[0];
        return new Application_Model_Game($row['game_id'], $row['gid'], $row['name'], $row['status']);
    }

    public function save(Application_Model_Game $game){
        $data = array(
                    'id'   => $game->getId(),
                    'name' => $game->getName(),
                    'gid'  => $game->getGid(),
                    'status'  => $game->getStatus()
                );
        if (null === ($id = $game->getId())) {
            unset($data['id']);
            return $this->insert($data);
        }
        else {
            $this->update($data, array('id = ?' => $id));
        }
    }

}

