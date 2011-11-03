<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap{

    protected function _initAutoload(){
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
        'namespace' => '',
        'basePath' => APPLICATION_PATH));
        return $moduleLoader;
    }

    protected function _initSession(){
        $session = new Zend_Session_Namespace('sdis35', true);
        return $session;
    }

    protected function _initDb(){
        $config = new Zend_Config($this->getOptions());
        // Mise en place de la BDD
        $oDb = Zend_Db::factory($config->resources->db);
        $oDb->query('SET NAMES UTF8');
        // on définit notre objet de base de données par défaut
        Zend_Db_Table::setDefaultAdapter($oDb);
    }

    protected function _initView(){
        // Initialisons la vue
        $view = new Zend_View();
        Zend_Layout::startMvc();
        $view->doctype('XHTML1_STRICT');
        $view->headTitle('HON - Bourbax League');
        // Ajoutons là au ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);
        // Retourner la vue pour qu'elle puisse être stockée par le bootstrap
        return $view;
    }

    protected  function  _initViewHelpers(){
        $this->bootstrap('layout');
    }

    protected function _initMyActionHelpers(){
        $this->bootstrap('frontController');
        $login = Zend_Controller_Action_HelperBroker::getStaticHelper('Login');
        Zend_Controller_Action_HelperBroker::addHelper($login);
    }

}

