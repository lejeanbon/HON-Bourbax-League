<?php

class App_Controller_Hon extends Zend_Controller_Action{
    /**
     *
     * @var App_Facade_Lecture $lecture
     */
    public $lecture;

    /**
     *
     * @var App_Facade_Ecriture $ecriture
     */
    public $ecriture;

    public $xmlServices;

    public function preDispatch(){
        $this->lecture = new App_Facade_Lecture();
        $this->ecriture = new App_Facade_Ecriture();
        $this->xmlServices = new App_Xml_XmlServices();
    }
}
?>
