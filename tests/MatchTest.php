<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\mime\tests;

use PHPUnit\Framework\TestCase;
use axy\mime\MimeType;
use axy\mime\MimePattern;
use axy\mime\MimeMatch;

class MatchTest extends TestCase
{
    /**
     * covers MimeMatch::match
     * covers MimeType::match
     * covers MimeType::__invoke
     * covers MimePattern::match
     * covers MimePattern::__invoke
     * @dataProvider providerMatch
     * @param string $type
     * @param string $pattern
     * @param bool $expected
     */
    public function testMatch($type, $pattern, $expected)
    {
        $oType = new MimeType($type);
        $oPattern = new MimePattern($pattern);
        $this->assertSame($expected, MimeMatch::match($type, $pattern));
        $this->assertSame($expected, MimeMatch::match($oType, $pattern));
        $this->assertSame($expected, MimeMatch::match($type, $oPattern));
        $this->assertSame($expected, MimeMatch::match($oType, $oPattern));
        $this->assertSame($expected, $oType->match($pattern));
        $this->assertSame($expected, $oType->match($oPattern));
        $this->assertSame($expected, $oType($pattern));
        $this->assertSame($expected, $oType($oPattern));
        $this->assertSame($expected, $oPattern->match($type));
        $this->assertSame($expected, $oPattern->match($oType));
        $this->assertSame($expected, $oPattern($type));
        $this->assertSame($expected, $oPattern($oType));
    }

    /**
     * @return array
     */
    public function providerMatch()
    {
        return [
            'equal' => [
                'image/png',
                'image/png',
                true,
            ],
            'case' => [
                'image/PNG',
                'IMAGE/png',
                true,
            ],
            'image/*' => [
                'image/png',
                'IMAGE/*',
                true,
            ],
            'seq' => [
                'image/png',
                'image/jpeg, image/png, image/bmp',
                true,
            ],
            'other' => [
                'image/png',
                'audio/png',
                false,
            ],
            '*/*' => [
                'image/png',
                '*/*',
                true,
            ],
            '*' => [
                'image/png',
                '*',
                true,
            ],
            'no' => [
                'image/png',
                'image/jpeg, image/bmp',
                false,
            ],
        ];
    }

    /**
     * @expectedException \LogicException
     */
    public function testTypeWrongType()
    {
        /** @noinspection PhpParamsInspection */
        MimeMatch::match([], '*/*');
    }

    /**
     * @expectedException \LogicException
     */
    public function testPatternWrongType()
    {
        /** @noinspection PhpParamsInspection */
        MimeMatch::match('image/png', []);
    }
}
