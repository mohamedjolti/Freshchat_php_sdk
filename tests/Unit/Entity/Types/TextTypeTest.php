<?php

use Freshchat\Entity\Types\MessageType;
use Freshchat\Entity\Types\TextType;
use PHPUnit\Framework\TestCase;

class TextTypeTest extends TestCase
{

    public function testResourceCanBeSet():MessageType
    {
        $textType = new TextType();
        $textType->setResource("Hi");

        $this->assertSame("Hi", $textType->getResource());

        return $textType;
    }

    public function testResourceIsNull():void
    {
        $textType = new TextType();

        $this->assertSame("", $textType->getResource());
    }

    /**
     * @depends testResourceCanBeSet
     */
    public function testBuildMessageObjectIs($textType):void
    {   
        $textStd = $textType->buildMessageContent();

        //check if is an anstance of stdClass
        $this->assertInstanceOf(\stdClass::class, $textStd);

        //check if the proporty text is also a text type
        $this->assertInstanceOf(\stdClass::class, $textStd->text);

        //check if content proporty is eqaul to text type resource
        $this->assertSame("Hi", $textStd->text->content);
    }

    public function resourceProvider():array
    {
        return [
              ['Hi'],
              ['new Message'],
              ['%hello dude à 90'],
        ];
    }
}

?>