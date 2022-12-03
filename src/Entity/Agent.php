<?php
namespace Freshchat\Entity;

use Freshchat\Entity\FreshchatApi;
use Freshchat\Http\Curl;

class Agent
{
    private string $id;
    private string $roleId;

    private string $firstName;

    private string $lastName;

    private Curl $curl;

    
    public function __construct()
    {
        $this->curl = new Curl();
    }

	/**
	 * @return string
	 */
	public function getId(): string {
		return $this->id;
	}
	
	/**
	 * @param string $id 
	 * @return self
	 */
	public function setId(string $id): self {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRoleId(): string {
		return $this->roleId;
	}
	
	/**
	 * @param string $roleId 
	 * @return self
	 */
	public function setRoleId(string $roleId): self {
		$this->roleId = $roleId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string {
		return $this->firstName;
	}
	
	/**
	 * @param string $firstName 
	 * @return self
	 */
	public function setFirstName(string $firstName): self {
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string {
		return $this->lastName;
	}
	
	/**
	 * @param string $lastName 
	 * @return self
	 */
	public function setLastName(string $lastName): self {
		$this->lastName = $lastName;
		return $this;
	}

    public  function getAgents()
    {
		/**
		 * @var string
		 */
        $AGENT_ENDPOINT = FreshchatApi::getAgents();

        return $this->curl->get($AGENT_ENDPOINT , FreshchatApi::createHeader());
    }
}


?>