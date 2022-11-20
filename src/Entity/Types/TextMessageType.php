<?php
namespace Freshchat\Entity\Types;

use Freshchat\Entity\Message;

class TextMessageType extends Message
{
    public function createMessageObject()
    {
        $parentObject = parent::createMessageObject();

        $text = new \stdClass();
        $text->content = $this->resource;
        
        $message_parts = new \stdClass();
        $message_parts->text = $text;
        $parentObject->message_parts = [ $message_parts ];
      
        return $parentObject;
    }
}
