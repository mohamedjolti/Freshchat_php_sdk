<?php

namespace Freshchat\Entity\Types;


class TextType extends MessageType
{
    /**
     * @return \stdClass
     */
    public function buildMessageContent()
    {
        $text = new \stdClass();
        $text->content = $this->getResource();
        
        $messagePart = new \stdClass();
        $messagePart->text = $text;
        return $messagePart;
    }
}


?>