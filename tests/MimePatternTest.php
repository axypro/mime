<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\mime\tests;

use PHPUnit\Framework\TestCase;
use axy\mime\MimePattern;

/**
 * coversDefaultClass \axy\mime\MimePattern
 */
class MimePatternTest extends TestCase
{
    /**
     * covers ::getPattern
     * @dataProvider providerGetPattern
     * @param string $input
     * @param string $expected
     */
    public function testGetPattern(string $input, string $expected): void
    {
        $pattern = new MimePattern($input);
        $this->assertSame($expected, $pattern->getPattern());
    }

    /**
     * @return array
     */
    public function providerGetPattern(): array
    {
        return [
            'single' => [
                'image/png',
                'image/png',
            ],
            'case' => [
                'Image/PNG',
                'image/png',
            ],
            'list' => [
                'IMAGE/PNG, video/* , audio, image/jpg',
                'image/png,video/*,audio/*,image/jpg',
            ],
            'list_all' => [
                'IMAGE/PNG, video/* , audio, image/jpg, */*',
                '*/*',
            ],
            'list_*' => [
                'IMAGE/PNG, video/* , audio, image/jpg, *',
                '*/*',
            ],
        ];
    }

    /**
     * covers ::build
     */
    public function testBuild()
    {
        $string = 'Image/*';
        $pattern = MimePattern::build($string);
        $this->assertInstanceOf(MimePattern::class, $pattern);
        $this->assertSame('image/*', $pattern->getPattern());
        $this->assertSame($pattern, MimePattern::build($pattern));
        $this->expectException(\LogicException::class);
        MimePattern::build($this);
    }
}
