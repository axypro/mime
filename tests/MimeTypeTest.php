<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\mime\tests;

use axy\mime\MimeType;

/**
 * coversDefaultClass \axy\mime\MimeType
 */
class MimeTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getMimeType
     */
    public function testGetMimeType()
    {
        $type = new MimeType('IMAGE/PNG');
        $this->assertSame('image/png', $type->getMimeType());
    }

    /**
     * covers ::getType
     */
    public function testGetType()
    {
        $type = new MimeType('IMAGE/PNG');
        $this->assertSame('image', $type->getType());
    }

    /**
     * covers getSubtype
     */
    public function testGetSubtype()
    {
        $type = new MimeType('IMAGE/PNG');
        $this->assertSame('png', $type->getSubtype());
    }

    /**
     * covers ::isType
     */
    public function testIsType()
    {
        $type = new MimeType('IMAGE/PNG');
        $this->assertTrue($type->isType(MimeType::IMAGE));
        $this->assertFalse($type->isType(MimeType::VIDEO));
    }
}
