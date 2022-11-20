<?php
namespace Freshchat\Entity\Types;

use Freshchat\Entity\Message;

class ImageMessageType extends Message
{
    public function createMessageObject()
    {
        $parentObject = parent::createMessageObject();

        $image = new \stdClass();
        $image->url = $this->resource;
        
        $message_parts = new \stdClass();
        $message_parts->image = $image;
        $parentObject->message_parts = [ $message_parts ];
      
        return $parentObject;
    }
}
