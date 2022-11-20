<?php

namespace Freshchat\Entity\Types;

abstract class MessageType
{

    private string $resource;


    abstract function buildMessageContent();


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
}

?>