<?php
/**
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 */

declare(strict_types=1);

namespace axy\mime;

/**
 * Mime type wrapper
 */
class MimeType
{
    public const APPLICATION = 'application';
    public const AUDIO = 'audio';
    public const EXAMPLE = 'example';
    public const IMAGE = 'image';
    public const MESSAGE = 'message';
    public const MODEL = 'model';
    public const MULTIPART = 'multipart';
    public const TEXT = 'text';
    public const VIDEO = 'video';

    /**
     * The constructor
     *
     * @param string $mime
     */
    public function __construct(string $mime)
    {
        $mime = explode('/', strtolower($mime), 2);
        $this->type = trim($mime[0]);
        $this->subtype = isset($mime[1]) ? trim($mime[1]) : '';
    }

    /**
     * @param string|MimePattern $pattern
     * @return bool
     */
    public function match($pattern): bool
    {
        return MimeMatch::match($this, $pattern);
    }

    /**
     * @param string|MimePattern $pattern
     * @return bool
     */
    public function __invoke($pattern): bool
    {
        return $this->match($pattern);
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->type.'/'.$this->subtype;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getMimeType();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSubtype(): string
    {
        return $this->subtype;
    }

    /**
     * @param string $type
     * @return bool
     */
    public function isType(string $type): bool
    {
        return (strtolower($type) === $this->type);
    }

    /**
     * Builds a mime type instance
     *
     * @param string|MimeType $type
     * @return MimeType
     * @throws \LogicException
     */
    public static function build($type): MimeType
    {
        if (is_string($type)) {
            return new self($type);
        }
        if (!($type instanceof self)) {
            throw new \LogicException('Mime type must be an instance of MimeType or a string');
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
