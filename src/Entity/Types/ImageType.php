<?php

namespace Freshchat\Entity\Types;


class ImageType extends MessageType
{
    /**
     * @return \stdClass
     */
    public function buildMessageContent()
    {
        $image = new \stdClass();
        $image->url = $this->getResource();

        $messagePart = new \stdClass();
        $messagePart->image = $image;
        return $messagePart;    
    }
}


?>