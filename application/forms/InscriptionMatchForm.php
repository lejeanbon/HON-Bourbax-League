<?php

class Application_Form_InscriptionMatchForm extends Zend_Form{

    public function init(){
        $submit = new Zend_Form_Element_Submit("Participer");
        $this->addElement($submit);
        $this->setDecorators(array(
            'FormElements',
            'Form',
            'Errors'
        ));
    }
}
?>
