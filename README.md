# axy\mime

Mime-type matching.

[![Latest Stable Version](https://img.shields.io/packagist/v/axy/mime.svg?style=flat-square)](https://packagist.org/packages/axy/mime)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://img.shields.io/travis/axypro/mime/master.svg?style=flat-square)](https://travis-ci.org/axypro/mime)
[![Coverage Status](https://coveralls.io/repos/axypro/mime/badge.svg?branch=master&service=github)](https://coveralls.io/github/axypro/mime?branch=master)
[![License](https://poser.pugx.org/axy/mime/license)](LICENSE)

* The library does not require any dependencies.
* Install: `composer require axy/mime`.
* License: [MIT](LICENSE).

For PHP 5.4+ support see branch `php54` in this repo or version 0.x of the composer package.

### Documentation

Mime-type has the follow format: `type/subtype`.
For example: `image/png`.
It is can be case-insensitive: `Image/PNG`.

Pattern can be in the follow formats:

* `image/png`
* `image/png,image/jpeg, image/gif` - a list of allowed types (comma-separated)
* `image/*` - all subtype of a type
* `image/*,text/plain` - a list contains a mask 

#### Matching

```php
use axy\mime\MimeType;

$type = 'image/png';
$pattern = 'image/*';

MimeType::match($type, $pattern); // TRUE
```

Type and pattern can be strings or MimeType and MimePattern instances.

#### `MimeType` class

```php
use axy\mime\MimeType;

$type = new MimeType('Image/PNG');

echo $type->getMimeType(); // image/png
echo $type->getType(); // image
echo $type->getSubtype(); // png
echo $type->isType('image'); // TRUE
echo $type->isType(MimeType::AUDIO); // FALSE
```

The class has the constants list for common types: 
`APPLICATION`, `AUDIO`, `EXAMPLE`, `IMAGE`, `MESSAGE`, `MODEL`, `MULTIPART`, `TEXT` and `VIDEO`.

Matching:

```php
$type = new MimeType('image/png');

$type->match('image/jpeg'); // FALSE
$type->match('image/*); // TRUE

$type('image/png'); // __invoke()

$type($instanceOfMimePattern); // see MimePattern
```

#### `MimePattern` class

```php
use axy\mime\MimePattern;

$pattern = new MimePattern('IMAGE/*');

$pattern->getPattern(); // image/*

$pattern->match('image/png'); // TRUE
$pattern('image/jpeg'); // __invoke
$pattern($instanceOfMimeType);
```
