<?php

class App_Xml_XmlServices {

    private $nickToId = "http://xml.heroesofnewerth.com/xml_requester.php?f=nick2id&opt=nick&nick[]=";

    public function getIdFromNickname($nickname){
        $parser = simplexml_load_file($this->nickToId.$nickname);
        return (string)$parser->accounts->account_id;
    }
}
?>
