<?php
namespace Freshchat\Entity\Factory;

use Freshchat\Entity\Agent;

class AgentFactory
{
    /**
     * @param mixed $response
     * @return array<Agent>
     */
    public function build($response):array
    {
        $responseStd = (object) json_decode($response);
        $agents = [];

        /**
         * @var Array<\stdClass>
         */
        $agentsResponse = (object) $responseStd->agents;
        foreach ($agentsResponse as $agentResponse) {
            $agent = new Agent();
            $agent->setFirstName($agentResponse->first_name);
            $agent->setLastName($agentResponse->last_name);
            $agent->setRoleId($agentResponse->role_id);
            $agent->setId($agentResponse->id);

            array_push($agents, $agent);
        }

         return $agents;
    }
}


?>