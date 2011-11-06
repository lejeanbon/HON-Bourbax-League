<?php

class Zend_View_Helper_AccountList extends Zend_View_Helper_Abstract{

    public function accountList(Application_Model_User $user){
        return App_Facade_Lecture::getInstance()->getAccountsByUser($user);
    }
}
?>
