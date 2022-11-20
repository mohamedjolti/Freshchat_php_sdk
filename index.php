<?php
require 'vendor/autoload.php';

use Freshchat\Controller\WebhookController;
use Symfony\Component\HttpFoundation\Request;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$request = Request::createFromGlobals();


$webhookController = new WebhookController();
$webhookController->handleMessageNotification($request);