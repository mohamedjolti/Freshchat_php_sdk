
# Project Features
Create a PHP SDK to interact with Freshchat API 

## Documentation
The project is based on the documentation described in 
https://developers.freshchat.com/api

## Installation
first install composer dependencies 
```
composer install 
```
secondly copy .env.example file to .env and change the property API_TOKEN
with you Freshchat api token 






## Example usage
let assume you want to send a message  when a user send a message
to your Bot, the WebhookController is an example of a controller to handle 
freshchat message notification (webhooks)
1.First we have to get the message from the incoming request sent by freshchat server , the class
MessageResponseFactory can be used to build a message instance from a request
```
$messageResponseFactory = new MessageResponseFactory($request->getContent());
/**
* message webhook sent by Freshchat server
* @var Message
*/
$messageResponse = $messageResponseFactory->getMessage();
```
the variable messageResponse contains all the message properties.

2.Create new Conversation and set the id to the id of the messageResponse Conversation so
 our message will be send just to the user that contact us.

```
$conversation = new Conversation();
$conversation->setId($messageResponse->getConversationId());
```

3. Create a new Message , each message has an actor (agent) Id described in Freshchat documentation ,
in this example we will get our agents and set the first agent as the agent of our
message  
getting first agent :
```
$agents = new Agent();
$agentsFromApi = $agents->getAgents();

$agentFactory = new AgentFactory();

/**
* @var array<Agent>
*/
 $agents = $agentFactory->build($agentsFromApi);

$defaultActorId = $agents[0]->getId();
``` 
creating new Message and setting the Agent

```
$message = new Message();
$message->setActorId($defaultActorId);
```
4. Adding Message parts ,message parts has diffrent types text, images ,buttons.in
this specific example we will add two parts a text and a image 

```
$imageType = new ImageType();
$imageType->setResource($image_url);

$textType = new TextType();
$textType->setResource("Hi sir ,welcome to the World Cup");

$message->addMultipleParts([$imageType, $textType]);
```
5.Send the message , before sending the message you can check first if the incoming
message is a UserMessage , we don't want to send a message if another agent send message (in this case)

```
if ($messageResponse->isUserMessage()) {
  $conversation->sendMessage($message);
}
```

## New Features
- Add integration testing for sending a message , getting agents  
- Add other supported Freshchat message Types buttons
- Add api call to get all messages of a conversation (can be used to handle chatbot workflow)


