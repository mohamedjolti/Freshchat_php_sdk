<?php

namespace Freshchat\Entity\Factory;

use Freshchat\Entity\Message;
use Symfony\Component\HttpFoundation\Request;

class MessageResponseFactory
{
    private Message $message;
    
    public function __construct()
    {
        $this->build();
    }
    /**
     *  @return void
     */
    public function build()
    {
        $request = Request::createFromGlobals();
        $requestArray =(object) json_decode($request->getContent());
        $requestMessage = $requestArray->data->message;
        $messageObject = new Message();
        $messageObject->setActorType($requestMessage->actor_type);
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