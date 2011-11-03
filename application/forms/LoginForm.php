<?php

class Application_Form_LoginForm extends Zend_Form{

    public function init(){

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $pass = new Zend_Form_Element_Password('password');
        $pass->setLabel('Mot de passe')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('Connexion');

        $this->addElements( array ( $username, $pass, $submit));

        $this->setDecorators(array(
                'FormElements',
                'Form'));
        $this->setElementDecorators(array('ViewHelper', 'Label'));
        $submit->setDecorators(array('ViewHelper'));
    }
}

