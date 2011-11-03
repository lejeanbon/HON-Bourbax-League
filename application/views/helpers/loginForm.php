<?php

class Zend_View_Helper_LoginForm extends Zend_View_Helper_Abstract
{
    public function loginForm(Application_Form_LoginForm $form)
    {
        $html = '';
        if($form->processed) {
            $html .= '<p>Merci de vous être loggué</p>';
        } else {
            $html .= $form->render();
        }
        return $html;
    }
}
