<?php

class AuthController extends App_Controller_Hon
{

    protected function _process($values)
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['email']);
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        return false;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
        $this->_helper->redirector('index', 'index'); // back to login page
    }

     public function authAction()
   {
      $this->_response->appendBody('authentification required','auth');
   }

   public function aclAction()
   {
   	$this->_response->appendBody($this->_request->getParam('role fourni') . " n'est pas autorisé à accéder à cette ressource",'auth');
   }

   public function passAction(){
       $form = new Application_Form_PassForm();
       $this->view->form = $form;
       if ($this->_request->isPost() && $this->_request->getPost('Envoyer')) {
            $formData = $this->_request->getPost();
            if($form->isValid($formData)){
                $email = $form->getValue('email');
                $newPass = App_Generate::pass();
                $utilisateur = $this->lecture->getUtilisateurByEmail($email);
                if(!$utilisateur)
                    $this->view->erreur = "Cet email ne correspond à aucun compte";
                else{
                    $utilisateur->setPass(md5($newPass));
                    $this->ecriture->saveUtilisateur($utilisateur);
                    var_dump($newPass);
                    var_dump($utilisateur->getPass());
                }
            }
        }
   }

   public function inscriptionAction(){
       $form = new Application_Form_InscriptionForm();
       $this->view->form = $form;
       if ($this->_request->isPost() && $this->_request->getPost('Inscription')) {
            $formData = $this->_request->getPost();
            if($form->isValid($formData)){
                $email = $form->getValue('email');
                $pass = md5($form->getValue('password'));
                $this->ecriture->saveUtilisateur(
                        new Application_Model_Utilisateur(null, null, $pass,
                                                          'user', $email, 0,
                                                          null, null, null,
                                                          null, null, null, null)
                        );
                $this->view->inscriptionOk = "Merci de vous être inscrit, 
                    vous devez activer votre compte par mail pour pouvoir vous identifier";
            }
        }
   }
}

