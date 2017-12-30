<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\mime\tests;

use axy\mime\MimePattern;

/**
 * coversDefaultClass \axy\mime\MimePattern
 */
class MimePatternTest extends \PHPUnit_Framework_TestCase
{
    /**
     * covers ::getPattern
     */
    public function testGetPattern()
    {
        $pattern = new MimePattern('IMAGE/PNG, video/* , audio, image/jpg');
        $expected = 'image/png,video/*,audio/*,image/jpg';
        $this->assertSame($expected, $pattern->getPattern());
        $pattern2 = new MimePattern('IMAGE/PNG, video/* , audio, image/jpg, */*');
        $this->assertSame('*/*', $pattern2->getPattern());
        $pattern3 = new MimePattern('IMAGE/PNG, video/* , audio, image/jpg, *');
        $this->assertSame('*/*', $pattern3->getPattern());
    }
}
