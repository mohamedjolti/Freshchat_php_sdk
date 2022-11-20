<?php
namespace Freshchat\Entity;

class Message
{
    private string $actorType = "agent";
    private string $actorId;
    private string $messageType =  "normal";
    protected string $resource;
    

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
        $messageObject              = new \stdClass();
        $messageObject->actor_type   = $this->actorType;
        $messageObject->actor_id     = $this->actorId;
        $messageObject->message_type = $this->messageType;
 
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
	public function getResource(): string {
		return $this->resource;
	}
	
	/**
	 * @param string $resource 
	 * @return self
	 */
	public function setResource(string $resource): self {
		$this->resource = $resource;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessageType(): string {
		return $this->messageType;
	}
	
	/**
	 * @param string $messageType 
	 * @return self
	 */
	public function setMessageType(string $messageType): self {
		$this->messageType = $messageType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getActorId(): string {
		return $this->actorId;
	}
	
	/**
	 * @param string $actorId 
	 * @return self
	 */
	public function setActorId(string $actorId): self {
		$this->actorId = $actorId;
		return $this;
	}
}
