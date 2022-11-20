<?php

namespace Freshchat\Entity;

use Freshchat\Http\Curl;


class Conversation
{

    private Curl $curl;
    private string $id;

    public function __construct(?string $id)
    {
        $this->curl = new Curl();
        $this->id   = $id;
    }

    public function createConversation()
    {
        /**
         * @var string
         */
        $CREATE_CONVERSATION = FreshchatApiEndpoint::getConversationCreation();
        $headers = FreshchatApiEndpoint::createHeader();

        return $this->curl->post($CREATE_CONVERSATION, [], $headers);
    }

    public function sendMessage(Message $message)
    {
        $MESSAGE_ENDPOINT = FreshchatApiEndpoint::getConversationSendMessage($this->id);
        $messageObject = $message->createMessageObject();
        return $this->curl->post($MESSAGE_ENDPOINT, $messageObject, FreshchatApiEndpoint::createHeader(), true);
    }
}
