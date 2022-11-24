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
        
        /**
         * message webhook sent by Freshchat server
         * @var Message
         */
        $messageResponse = $messageResponseFactory->getMessage();

        $defaultActorId = "7d995a36-5b2e-41b5-96f3-ba641d6abf64";

        if ($messageResponse->isUserMessage()) {
            $conversation = new Conversation();
            $conversation->setId($messageResponse->getConversationId());

            $message = new Message();
            $message->setActorId($defaultActorId);
            $url = "https://upload.wikimedia.org/wikipedia/en/thumb/e/e3/2022_FIFA_World_Cup.svg/1200px-2022_FIFA_World_Cup.svg.png";

            $imageType = new ImageType();
            $imageType->setResource($url);

            $textType = new TextType();
            $textType->setResource("Hi sir ,welcome to the World Cup");

            $message->addMultipleParts([$imageType , $textType]);
            $conversation->sendMessage($message);
        }
    }
}

?>