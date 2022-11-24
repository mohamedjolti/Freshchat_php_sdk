<?php
namespace Freshchat\Entity;

use Freshchat\Entity\Types\MessageType;

class Message
{
	private string $actorType = "agent";
	private string $actorId;
	private string $messageType = "normal";
	protected string $resource;

	private string $conversationId;
	private string $userId;


	private array $messageParts = [];

	public function __construct()
	{

	}

	/**
	 * createFreschatObject { "actor_type": "user", "actor_id": "54e59ba2-92f6-492d-bb1f-29743f1a22a8", "message_type": "normal", "message_parts": [ { "text": { "content": "USER MESSAGE - from postman" } } ] }
	 *
	 * @return \StdClass
	 */
	public function createMessageObject()
	{
		$messageObject = new \stdClass();
		$messageObject->actor_type = $this->actorType;
		$messageObject->actor_id = $this->actorId;
		$messageObject->message_type = $this->messageType;
		$messageObject->message_parts = $this->messageParts;

		return $messageObject;
	}

	/**
	 * getActorType
	 *
	 * @return string
	 */
	public function getActorType()
	{
		return $this->actorType;
	}





	/**
	 * setActorType
	 *
	 * @param  string $actorType
	 * @return void
	 */
	public function setActorType(string $actorType)
	{
		$this->actorType = $actorType;

	}


	/**
	 * @return string
	 */
	public function getResource(): string
	{
		return $this->resource;
	}

	/**
	 * @param string $resource 
	 * @return self
	 */
	public function setResource(string $resource): self
	{
		$this->resource = $resource;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessageType(): string
	{
		return $this->messageType;
	}

	/**
	 * @param string $messageType 
	 * @return self
	 */
	public function setMessageType(string $messageType): self
	{
		$this->messageType = $messageType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getActorId(): string
	{
		return $this->actorId;
	}

	/**
	 * @param string $actorId 
	 * @return self
	 */
	public function setActorId(string $actorId): self
	{
		$this->actorId = $actorId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getConversationId(): string
	{
		return $this->conversationId;
	}

	/**
	 * @param string $conversationId 
	 * @return self
	 */
	public function setConversationId(string $conversationId): self
	{
		$this->conversationId = $conversationId;
		return $this;
	}

	/**
	 * @return \bool
	 */
	public function isUserMessage(): bool
	{
		return $this->getActorType() === FreshchatApi::USER_ACTOR;
	}

	/**
	 * @return string
	 */
	public function getUserId(): string
	{
		return $this->userId;
	}

	/**
	 * @param string $userId 
	 * @return self
	 */
	public function setUserId(string $userId): self
	{
		$this->userId = $userId;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getMessageParts(): array
	{
		return $this->messageParts;
	}

	/**
	 * @param array $messageParts 
	 * @return self
	 */
	public function setMessageParts(array $messageParts): self
	{
		$this->messageParts = $messageParts;
		return $this;
	}

	/**
	 * the message_parts array can contain mutiple parts of diffrent types
	 * 
	 *  @param MessageType $type
	 */
	public function addMessagePart($type)
	{
		/**
		 * @var \stdClass
		 */
		$messageTypeToStdClass = $type->buildMessageContent();
		array_push($this->messageParts, $messageTypeToStdClass);
	}

	/**
	 * @param array<MessageType> $messageParts
	 * @return self
	 */
	public function addMultipleParts(array $messageParts):self
	{
		foreach($messageParts as $messagePart)
		{
			$this->addMessagePart($messagePart);
		}
		
		return $this;
	}
}