<?php

use Freshchat\Entity\Types\MessageType;
use Freshchat\Entity\Types\ImageType;
use PHPUnit\Framework\TestCase;

class ImageTypeTest extends TestCase
{

    public function testResourceCanBeSet():MessageType
    {
        $imageType = new ImageType();
        $imageType->setResource("imageUrl");

        $this->assertSame("imageUrl", $imageType->getResource());

        return $imageType;
    }

    public function testResourceIsNull():void
    {
        $imageType = new ImageType();

        $this->assertSame("", $imageType->getResource());
    }

    /**
     * @depends testResourceCanBeSet
     */
    public function testBuildMessageObjectIs($imageType):void
    {   
        $imageStd = $imageType->buildMessageContent();

        //check if is an anstance of stdClass
        $this->assertInstanceOf(\stdClass::class, $imageStd);

        //check if the proporty Image is also a Image type
        $this->assertInstanceOf(\stdClass::class, $imageStd->image);

        //check if url proporty is eqaul to Image type resource
        $this->assertSame('imageUrl', $imageStd->image->url);
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