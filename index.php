<?php
/**
 * Mime-type matching
 *
 * @package axy\mime
 * @author Oleg Grigoriev <go.vasac@gmail.com>
 * @license https://raw.github.com/axypro/mime/master/LICENSE MIT
 * @link https://github.com/axypro/mime repository
 * @link https://packagist.org/packages/axy/mime composer package
 * @uses PHP7.1+
 */

declare(strict_types=1);

namespace axy\mime;

if (!is_file(__DIR__.'/vendor/autoload.php')) {
    trigger_error(__NAMESPACE__.': "composer install", please', E_USER_ERROR);
}

require_once __DIR__.'/vendor/autoload.php';
