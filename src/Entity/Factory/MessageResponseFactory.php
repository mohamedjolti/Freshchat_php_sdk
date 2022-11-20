<?php

namespace Freshchat\Entity\Factory;

use Freshchat\Entity\Message;

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
    public function build($request)
    {
        $requestArray   =   (object)json_decode($request->getContent());
        $requestMessage = $requestArray->data->message;

        $messageObject = new Message();
        $messageObject->setActorType($requestMessage->actor_type);
        $messageObject->setConversationId($requestMessage->conversation_id);
        $messageObject->setActorId($requestMessage->actor_id);
        $messageObject->setUserId($requestMessage->user_id);
        $messageObject->setResource($requestMessage->message_parts[0]->text->content);

        $this->setMessage($messageObject);
    }



	/**
	 * @return Message
	 */
	public function getMessage(): Message {
		return $this->message;
	}
	
	/**
	 * @param Message $message 
	 * @return self
	 */
	public function setMessage(Message $message): self {
		$this->message = $message;
		return $this;
	}
}