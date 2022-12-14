<?php

namespace Freshchat\Entity;

/**
 * FreshchatApi a class to return diffrent Freschat API endpoints
 */
class FreshchatApi
{

    public const API_URL      =  "https://api.freshchat.com/v2";
    public const CONVERSATION =  "conversations";
    public const MESSAGES     =  "messages";
    public const AGENTS       =  "agents";
    public const AGENT_ACTOR  =  "agent";

    public const USER_ACTOR   =   "user";

    /**
     * getConversationCreation
     *
     * @return string
     */
    public static function getConversationCreation()
    {
        return self::API_URL . "/" . self::CONVERSATION;
    }

    /**
     * get Conversation Retreive endpoint 
     *
     * @param  string $conversation_id
     * @return string
     */
    public static function getConversationRetreive(string $conversation_id)
    {
        return self::API_URL . "/" . self::CONVERSATION . "/" . $conversation_id;
    }

    /**
     * get Conversation Send Message endpoint
     *
     * @param  string $conversation_id
     * @return string
     */
    public static function getConversationSendMessage(string $conversation_id)
    {
        return self::API_URL . "/" . self::CONVERSATION . "/" . $conversation_id . "/" . self::MESSAGES;
    }

    public static function createHeader()
    {
        $headers = [
            "Content-Type:application/json",
            "Authorization:Bearer ".$_ENV["API_TOKEN"]
         ];
         return $headers;
    }

    public static function getAgents()
    {
        return self::API_URL. "/" .self::AGENTS;
    }
}
