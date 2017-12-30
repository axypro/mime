<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

namespace axy\mime;

class MimeType
{
    const APPLICATION = 'application';
    const AUDIO = 'audio';
    const EXAMPLE = 'example';
    const IMAGE = 'image';
    const MESSAGE = 'message';
    const MODEL = 'model';
    const MULTIPART = 'multipart';
    const TEXT = 'text';
    const VIDEO = 'video';

    /**
     * @param string $type
     */
    public function __construct($type)
    {
        $type = explode('/', strtolower($type), 2);
        $this->type = $type[0];
        $this->subtype = isset($type[1]) ? $type[1] : '';
    }

    /**
     * @param string|MimePattern $pattern
     * @return bool
     */
    public function __invoke($pattern)
    {
        return $this->match($pattern);
    }

    /**
     * @param string|MimePattern $pattern
     * @return bool
     * @throws \LogicException
     */
    public function match($pattern)
    {
        return MimeMatch::match($this, $pattern);
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->type.'/'.$this->subtype;
    }

    /**
     * @param string $type
     * @return bool
     */
    public function isType($type)
    {
        return ($this->type === $type);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSubtype()
    {
        return $this->subtype;
    }

    /**
     * @param string|MimeType $type
     * @return MimeType
     * @throws \LogicException
     */
    public static function build($type)
    {
        if (is_string($type)) {
            return new self($type);
        }
        if (!($type instanceof self)) {
            throw new \LogicException('MimeType must be an instance of MimeType or string');
        }
        return $type;
    }

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $subtype;
}
