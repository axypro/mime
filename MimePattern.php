<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\mime;

class MimePattern
{
    /**
     * @param string $pattern
     */
    public function __construct($pattern)
    {
        $this->types = [];
        foreach (explode(',', $pattern) as $t) {
            $t = trim($t);
            if ($t === '') {
                continue;
            }
            $t = explode('/', strtolower($t), 2);
            if ($t[0] === '*') {
                $this->types = null;
                return;
            }
            $st = (isset($t[1]) && ($t[1] !== '*')) ? $t[1] : true;
            $this->types[] = [$t[0], $st];
        }
    }

    /**
     * @param string|MimeType $type
     * @return bool
     */
    public function match($type)
    {
        $type = MimeType::build($type);
        $t = $type->getType();
        $s = $type->getSubtype();
        if ($this->types === null) {
            return true;
        }
        foreach ($this->types as $pt) {
            if ($t !== $pt[0]) {
                continue;
            }
            if (($pt[1] === true) || ($pt[1] === $s)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string|MimeType $type
     * @return bool
     */
    public function __invoke($type)
    {
        return $this->match($type);
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        if ($this->types === null) {
            return '*/*';
        }
        $result = [];
        foreach ($this->types as $t) {
            $st = ($t[1] === true) ? '*' : $t[1];
            $result[] = $t[0].'/'.$st;
        }
        return implode(',', $result);
    }

    /**
     * @param string|MimePattern $pattern
     * @return MimePattern
     * @throws \LogicException
     */
    public static function build($pattern)
    {
        if (is_string($pattern)) {
            return new self($pattern);
        }
        if (!($pattern instanceof self)) {
            throw new \LogicException('MimePattern must be an instance of MimePattern or string');
        }
        return $pattern;
    }

    /**
     * @var array
     */
    private $types;
}
