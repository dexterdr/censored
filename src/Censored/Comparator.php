<?php

namespace Censored;

/**
 * Text related tools (static).
 *
 * @package Censored
 */
class Comparator
{
    /**
     * Trim punctuation, split text and get unique lowercase words.
     *
     * @param string $text
     * @param bool $lowercase
     * @return array
     */
    public static function tokenize(string $text, $lowercase = true): array
    {
        if ($lowercase) {
            $text = mb_strtolower($text);
        }

        $withoutPunctuation = preg_replace("/[\p{P}]+/", '', $text);

        if ($withoutPunctuation === null) {
            return [];
        }

        return array_unique(array_filter(explode(' ', $withoutPunctuation)));
    }

    /**
     * Search words inside given text.
     *
     * @param string $text
     * @param array $words
     * @param bool $strict
     * @param bool $ignoreCase
     * @return array
     */
    public static function search(string $text, array $words, $strict = true, $ignoreCase = true)
    {
        $tokenized = static::tokenize($text, $ignoreCase);

        return static::compare($tokenized, $words, $strict);
    }

    /**
     * Computes the intersection of two arrays.
     *
     * @param array $haystack
     * @param array $needles
     * @param bool $strict
     * @return array
     */
    public static function compare(array $haystack, array $needles, $strict = true): array
    {
        if ($strict) {
            return array_unique(array_intersect($haystack, $needles));
        } else {
            $result = [];

            foreach ($haystack as $word) {
                foreach ($needles as $needle) {
                    if (mb_strpos($word, $needle) !== false) {
                        $result[] = $word;
                        break;
                    }
                }
            }

            return array_unique($result);
        }
    }
}
