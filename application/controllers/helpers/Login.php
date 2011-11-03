<?php

class Application_Controller_Helper_Login extends Zend_Controller_Action_Helper_Abstract
{
    public function preDispatch()
    {
        $view = $this->getActionController()->view;
        $form = new Application_Form_LoginForm();
        
        $request = $this->getActionController()->getRequest();
        if($request->isPost() && $request->getPost('Connexion')) {
            if($form->isValid($request->getPost())) {     
                $data = $form->getValues();
                $adapter = $this->_getAuthAdapter();
                $adapter->setIdentity($data['username']);
                $adapter->setCredential($data['password']);
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($adapter);
                if ($result->isValid()) {
                    
                    $user = $adapter->getResultRowObject();
                    $auth->getStorage()->write($user);
                    $view->loginForm = $form;
                    return true;
                }
                
                $view->loginForm = $form;
                return false;

            }
        }
        $view->loginForm = $form;
    }

    protected function _getAuthAdapter() {

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('user')
            ->setIdentityColumn('username')
            ->setCredentialColumn('password')
            ->setCredentialTreatment('MD5(?)');

        return $authAdapter;
    }
}
