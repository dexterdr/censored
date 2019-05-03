# Сensored

[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-44CC11.svg?longCache=true&style=flat-square)](https://github.com/phpstan/phpstan)

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

