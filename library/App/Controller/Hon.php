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

    public function preDispatch(){
        $this->lecture = new App_Facade_Lecture();
        $this->ecriture = new App_Facade_Ecriture();
    }
}
?>
