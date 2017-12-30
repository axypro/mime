<?php
/**
 * Mime-type matching
 *
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 * @license https://raw.github.com/axypro/mime/master/LICENSE MIT
 * @link https://github.com/axypro/mime repository
 * @link https://packagist.org/packages/axy/mime composer package
 * @uses PHP5.4+
 */

namespace axy\mime;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    throw new \LogicException('Please: composer install');
}

require_once(__DIR__.'/vendor/autoload.php');
