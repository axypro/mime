<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\mime\tests;

use PHPUnit\Framework\TestCase;
use axy\mime\MimeType;

/**
 * coversDefaultClass \axy\mime\MimeType
 */
class MimeTypeTest extends TestCase
{
    /**
     * covers ::getMimeType
     */
    public function testGetMimeType(): void
    {
        $type = new MimeType('Image/PNG');
        $this->assertSame('image/png', $type->getMimeType());
    }

    public function testStr(): void
    {
        $type = new MimeType('Image/PNG');
        $this->assertSame('image/png', ''.$type->getMimeType());
    }

    /**
     * covers ::getType
     */
    public function testGetType(): void
    {
        $type = new MimeType('Image/PNG');
        $this->assertSame('image', $type->getType());
    }

    /**
     * covers ::getSubtype
     */
    public function testGetSubtype(): void
    {
        $type = new MimeType('Image/PNG');
        $this->assertSame('png', $type->getSubtype());
    }

    /**
     * covers ::isType
     */
    public function testIsType(): void
    {
        $type = new MimeType('Image/PNG');
        $this->assertTrue($type->isType('image'));
        $this->assertTrue($type->isType('Image'));
        $this->assertTrue($type->isType(MimeType::IMAGE));
        $this->assertFalse($type->isType(MimeType::APPLICATION));
        $this->assertFalse($type->isType('unknown'));
    }

    /**
     * covers ::build
     */
    public function testBuild()
    {
        $string = 'Image/PNG';
        $pattern = MimeType::build($string);
        $this->assertInstanceOf(MimeType::class, $pattern);
        $this->assertSame('image/png', $pattern->getMimeType());
        $this->assertSame($pattern, MimeType::build($pattern));
        $this->expectException(\LogicException::class);
        MimeType::build($this);
    }
}
