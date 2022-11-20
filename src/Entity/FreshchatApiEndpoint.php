<?php

namespace Freshchat\Entity;

/**
 * FreshchatApiEndpoint a class to return diffrent Freschat API endpoints
 */
class FreshchatApiEndpoint
{

    public const API_URL      =  "https://api.freshchat.com/v2";
    public const CONVERSATION =  "conversations";
    public const MESSAGES     =  "messages";
    public const AGENTS       =  "agents";

    /**
     * getConversationCreation
     *
     * @return string
     */
    public static function getConversationCreation()
    {
        return FreshchatApiEndpoint::API_URL . "/" . FreshchatApiEndpoint::CONVERSATION;
    }

    /**
     * get Conversation Retreive endpoint 
     *
     * @param  string $conversation_id
     * @return string
     */
    public static function getConversationRetreive(string $conversation_id)
    {
        return FreshchatApiEndpoint::API_URL . "/" . FreshchatApiEndpoint::CONVERSATION . "/" . $conversation_id;
    }

    /**
     * get Conversation Send Message endpoint
     *
     * @param  string $conversation_id
     * @return string
     */
    public static function getConversationSendMessage(string $conversation_id)
    {
        return FreshchatApiEndpoint::API_URL . "/" . FreshchatApiEndpoint::CONVERSATION . "/" . $conversation_id . "/" . FreshchatApiEndpoint::MESSAGES;
    }

    public static function createHeader()
    {
        $headers = [
            "Content-Type:application/json",
            "Authorization:Bearer ".$_ENV["API_TOKEN"]
         ];
         return $headers;
    }
}
