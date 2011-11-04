<?php

class Application_Form_AccountForm extends Zend_Form{

    public function init(){
        $accountName = new Zend_Form_Element_Text('name');
        $accountName->setLabel('Nom du compte HON')
                    ->setRequired(true)
                    ->addFilter('StripTags')
                    ->addFilter('StringTrim')
                    ->addValidator('NotEmpty');
        $submit = new Zend_Form_Element_Submit('Ajouter');

        $this->addElements( array ( $accountName, $submit));
    }
}
?>
