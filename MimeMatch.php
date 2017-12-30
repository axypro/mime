<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\mime;

class MimeMatch
{
    /**
     * Checks if a type matching to a pattern
     *
     * @param string|MimeType $type
     * @param string|MimePattern $pattern
     * @return bool
     * @throws \LogicException
     */
    public static function match($type, $pattern)
    {
        return MimePattern::build($pattern)->match($type);
    }
}
