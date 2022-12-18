<?php

use Freshchat\Entity\Agent;
use Freshchat\Entity\Factory\AgentFactory;
use PHPUnit\Framework\TestCase;

class AgentFactoryTest extends TestCase
{

    public function test_build_agents()
    {
        // 1.Arrange
        $AGENTS = json_encode(
            [
                "agents" => [
                    [
                        "first_name" => "John",
                        "last_name" => "Doe",
                        "role_id" => "Owner",
                        "id" => "a1234"
                    ],
                    [
                        "first_name" => "John",
                        "last_name" => "Boe",
                        "role_id" => "Developer",
                        "id" => "b1234"
                    ]
                ]
            ]
        );
        // 2.Act
        $agentFactory = new AgentFactory();
        $agentsResponse = $agentFactory->build($AGENTS);

        // 3.Assertions
        $this->assertNotEmpty($agentsResponse);
        $this->assertInstanceOf(Agent::class, $agentsResponse[0]);
        
        $agentZero = $agentsResponse[0];
        $this->assertSame("John", $agentZero->getFirstName());
        $this->assertSame("Doe", $agentZero->getLastName());
        $this->assertSame("Owner", $agentZero->getRoleId());
        $this->assertSame("a1234", $agentZero->getId());
    }

}

?>