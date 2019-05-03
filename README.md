# Сensored

[![Packagist Version](https://img.shields.io/packagist/v/dexterdr/censored.svg)](https://packagist.org/packages/dexterdr/censored)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg)](https://github.com/phpstan/phpstan)
[![Packagist](https://img.shields.io/packagist/l/dexterdr/censored.svg)](https://github.com/dexterdr/censored/blob/master/LICENSE)

A simple library for searching and removing obscene vocabulary.

Currently there are dictionaries only for English and Russian languages.

```php
use Censored\Censored;

$text = 'String to validate...';
$censored = new Censored();

$censored->isAcceptable($text);  // true
$censored->setLanguages(['en', 'ru']);
$censored->setExactMatch(false);
$censored->getProhibitedWordsCount($text);  // 0
```

## Installation

```
$ composer require dexterdr/censored
```

```json
{
    "require": {
        "dexterdr/censored": "^1.0"
    }
}
```

```php
<?php
require 'vendor/autoload.php';

use Censored\Censored;

$censored = new Censored(['en', 'ru'], false);
```

