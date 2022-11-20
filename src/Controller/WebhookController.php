<?php
namespace Freshchat\Controller;

use Freshchat\Entity\Conversation;
use Freshchat\Entity\Factory\MessageResponseFactory;
use Freshchat\Entity\Message;
use Freshchat\Entity\Types\ImageType;
use Freshchat\Entity\Types\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * An example of a controller to handle Freschat notification
 */
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
        
            $message = new Message();
            $message->setActorId($defaultActorId);
            $simpleTextMessage = "thank you for your message '".$messageResponse->getResource() ."'";
            $url =  "https://upload.wikimedia.org/wikipedia/en/thumb/e/e3/2022_FIFA_World_Cup.svg/1200px-2022_FIFA_World_Cup.svg.png";

            $textType = new TextType();
            $textType->setResource($simpleTextMessage);

            $imageType = new ImageType();
            $imageType->setResource($url);

            $message->addMessagePart($textType);
            $message->addMessagePart($imageType);

            
            $conversation->sendMessage($message);
        }
    }
}

?>