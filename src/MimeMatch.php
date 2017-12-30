<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\mime;

class MimeMatch
{
    /**
     * Checks if a mime type matches a pattern
     *
     * @param string|MimeType $type
     * @param string|MimePattern $pattern
     * @return bool
     */
    public static function match($type, $pattern): bool
    {
        return MimePattern::build($pattern)->match($type);
    }
}
