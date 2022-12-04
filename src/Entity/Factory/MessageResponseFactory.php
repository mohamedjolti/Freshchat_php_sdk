<?php

namespace Freshchat\Entity\Factory;

use Freshchat\Entity\Message;
use Freshchat\Entity\Types\ImageType;
use Freshchat\Entity\Types\MessageType;
use Freshchat\Entity\Types\TextType;

class MessageResponseFactory
{
    private Message $message;

    public function __construct($request)
    {
        $this->build($request);
    }
    /**
     *  @return void
     */
    public function build($content)
    {
        $requestArray = (object) json_decode($content);
        $requestMessage = $requestArray->data->message;

        $messageObject = new Message();
        $messageObject->setActorType($requestMessage->actor_type);
        $messageObject->setConversationId($requestMessage->conversation_id);
        $messageObject->setActorId($requestMessage->actor_id);
        $messageObject->setUserId($requestMessage->user_id);

       foreach ($requestMessage->message_parts as $part) {
            /**
             * @var MessageType
             */
            $messagePart = $this->buildMessagePart($part);
            $messageObject->addMessagePart($messagePart);
        }
        $this->setMessage($messageObject);
    }



    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }

    /**
     * @param Message $message 
     * @return self
     */
    public function setMessage(Message $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function buildMessagePart(\stdClass $part)
    {
        // handle diffrent message part types 
        if (property_exists($part, "text")) {
            $messagePart = new TextType();
            $messagePart->setResource($part->text->content);
        } else if (property_exists($part, "image")) {
            $messagePart = new ImageType();
            $messagePart->setResource($part->image->url);
        }
        
        return $messagePart;
    }
}