<?php

namespace PayPal\Test\Api;

use PayPal\Api\WebhookEvent;
use PHPUnit\Framework\TestCase;

/**
 * Class WebhookEvent
 *
 * @package PayPal\Test\Api
 */
class WebhookEventTest extends TestCase
{
    /**
     * Gets Json String of Object WebhookEvent
     * @return string
     */
    public static function getJson()
    {
        return '{"id":"TestSample","create_time":"TestSample","resource_type":"TestSample","event_version":"TestSample","event_type":"TestSample","summary":"TestSample","resource":"TestSampleObject","status":"TestSample","transmissions":"TestSampleObject","links":' .LinksTest::getJson() . '}';
    }

    /**
     * Gets Object Instance with Json data filled in
     * @return WebhookEvent
     */
    public static function getObject()
    {
        return new WebhookEvent(self::getJson());
    }


    /**
     * Tests for Serialization and Deserialization Issues
     * @return WebhookEvent
     */
    public function testSerializationDeserialization()
    {
        $obj = new WebhookEvent(self::getJson());
        $this->assertNotNull($obj);
        $this->assertNotNull($obj->getId());
        $this->assertNotNull($obj->getCreateTime());
        $this->assertNotNull($obj->getResourceType());
        $this->assertNotNull($obj->getEventVersion());
        $this->assertNotNull($obj->getEventType());
        $this->assertNotNull($obj->getSummary());
        $this->assertNotNull($obj->getResource());
        $this->assertNotNull($obj->getLinks());
        $this->assertEquals(self::getJson(), $obj->toJson());
        return $obj;
    }

    /**
     * @depends testSerializationDeserialization
     * @param WebhookEvent $obj
     */
    public function testGetters($obj)
    {
        $this->assertEquals("TestSample", $obj->getId());
        $this->assertEquals("TestSample", $obj->getCreateTime());
        $this->assertEquals("TestSample", $obj->getResourceType());
        $this->assertEquals("TestSample", $obj->getEventVersion());
        $this->assertEquals("TestSample", $obj->getEventType());
        $this->assertEquals("TestSample", $obj->getSummary());
        $this->assertEquals("TestSampleObject", $obj->getResource());
        $this->assertEquals(LinksTest::getObject(), $obj->getLinks());
    }

    /**
     * @dataProvider mockProvider
     * @param WebhookEvent $obj
     */
    public function testGet($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall->expects($this->any())
            ->method('execute')
            ->willReturn(WebhookEventTest::getJson());

        $result = $obj->get("eventId", $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }
    /**
     * @dataProvider mockProvider
     * @param WebhookEvent $obj
     */
    public function testResend($obj, $mockApiContext)
    {
        self::markTestSkipped('Skipped');

        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall->expects($this->any())
            ->method('execute')
            ->willReturn(self::getJson());
        $eventResend = self::getObject();

        $result = $obj->resend($eventResend, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }
    /**
     * @dataProvider mockProvider
     * @param WebhookEvent $obj
     */
    public function testList($obj, $mockApiContext)
    {
        $mockPPRestCall = $this->getMockBuilder('\PayPal\Transport\PayPalRestCall')
            ->disableOriginalConstructor()
            ->getMock();

        $mockPPRestCall->expects($this->any())
            ->method('execute')
            ->willReturn(WebhookEventListTest::getJson());
        $params = array();

        $result = $obj->all($params, $mockApiContext, $mockPPRestCall);
        $this->assertNotNull($result);
    }

    public function mockProvider()
    {
        $obj = self::getObject();
        $mockApiContext = $this->getMockBuilder('ApiContext')
                    ->disableOriginalConstructor()
                    ->getMock();
        return array(
            array($obj, $mockApiContext),
            array($obj, null)
        );
    }
}
