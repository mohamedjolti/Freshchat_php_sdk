<?php
require 'vendor/autoload.php';


use Freshchat\Entity\Conversation;
use Freshchat\Entity\Factory\MessageResponseFactory;
use Freshchat\Entity\Message;
use Freshchat\Entity\Types\TextMessageType;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$messageResponseFactory = new MessageResponseFactory();
$message = $messageResponseFactory->getMessage();

// a simple freschat webhook for now

if ($message->getActorType() == "user") {
    $conversation = new Conversation();
    $conversation->setId("d613a687-1a63-43e1-bde8-60705117c832");

    $message = new TextMessageType();
    $message->setActorId("7d995a36-5b2e-41b5-96f3-ba641d6abf64");
    $message->setActorType("user");
    $message->setResource("Hi sir");

    $conversation->sendMessage($message);

}