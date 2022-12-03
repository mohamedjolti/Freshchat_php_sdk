<?php
require 'vendor/autoload.php';

use Freshchat\Controller\WebhookController;
use Freshchat\Entity\Agent;
use Freshchat\Entity\Factory\AgentFactory;
use Symfony\Component\HttpFoundation\Request;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// handle the notification sent by Freshchat server 
$request = Request::createFromGlobals();
$webhookController = new WebhookController();
$webhookController->handleMessageNotification($request);


