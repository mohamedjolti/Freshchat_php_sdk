<?php
namespace Freshchat\Controller;

use Freshchat\Entity\Conversation;
use Freshchat\Entity\Factory\MessageResponseFactory;
use Freshchat\Entity\Types\ImageMessageType;
use Freshchat\Entity\Types\TextMessageType;
use Symfony\Component\HttpFoundation\Request;

class WebhookController
{
    /**
     * @param Request $request
     */
    public function handleMessageNotification($request)
    {
        $messageResponseFactory = new MessageResponseFactory($request);
        $messageResponse = $messageResponseFactory->getMessage();
        $defaultActorId = "7d995a36-5b2e-41b5-96f3-ba641d6abf64";

        if ($messageResponse->isUserMessage()) {
            $conversation = new Conversation();
            $conversation->setId($messageResponse->getConversationId());
        
            $textMessage = new TextMessageType();
            $textMessage->setActorId($defaultActorId);
            $simpleTextMessage = "thank you for your message '".$messageResponse->getResource() ."'";
            $textMessage->setResource($simpleTextMessage);

            $conversation->sendMessage($textMessage);

            $imageMessage = new ImageMessageType();
            $imageMessage->setActorId($defaultActorId);
            $url =  "https://upload.wikimedia.org/wikipedia/en/thumb/e/e3/2022_FIFA_World_Cup.svg/1200px-2022_FIFA_World_Cup.svg.png";
            $imageMessage->setResource($url);

            $conversation->sendMessage($imageMessage);
        
        
        }
    }
}

?>