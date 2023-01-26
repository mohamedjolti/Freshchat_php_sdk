<?php

use Freshchat\Entity\Agent;
use Freshchat\Entity\Factory\MessageResponseFactory;
use Freshchat\Entity\Message;
use Freshchat\Entity\Types\MessageType;
use Freshchat\Entity\Types\TextType;
use PHPUnit\Framework\TestCase;

class MessageResponseFactoryTest extends TestCase
{

    public function test_build_message()
    {
        // 1.Arrange
        $DATA = new \stdClass;
        $DATA->data = new \stdClass;
        $MESSAGE = new \stdClass;
        $MESSAGE->actor_id = 'A12344';
        $MESSAGE->conversation_id = 'CONV123445';
        $MESSAGE->actor_type = 'user';
        $MESSAGE->user_id = 'u1234';
        $text = new \stdClass;
        $text->text = new \stdClass;
        $text->text->content = 'Hi Bot';
        $image = new \stdClass;
        $image->image = new \stdClass;
        $image->image->url = 'url';
        $MESSAGE->message_parts = [$text, $image];

        $DATA->data->message = $MESSAGE;
        $message_json = json_encode($DATA);
        // 2.Act
        $messageResponse = new MessageResponseFactory($message_json);
        $message = $messageResponse->getMessage();

        // 3.Assertions
        $this->assertInstanceOf(Message::class, $message);
        $this->assertInstanceOf(TextType::class, $message->getMessageParts()[0]);
        $this->assertSame('A12344', $message->getActorId());
        $this->assertSame('CONV123445', $message->getConversationId());
        $this->assertSame(2, count($message->getMessageParts()));
        $this->assertSame("Hi Bot", $message->getMessageParts()[0]->getResource());
   
    }

}

?>