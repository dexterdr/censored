<?php

namespace Censored;

/**
 * Simple library for censorship.
 */
class Censored
{
    function __construct()
    {
        # code
    }

    /**
     * Check text for vocabulary acceptability.
     *
     * @param string $text
     * @return bool
     */
    public function isAcceptable(string $text): bool
    {
        return empty($text) ? true : false;
    }

    /**
     * Censorship of the text.
     *
     * @param string $text
     * @return string
     */
    public function censor(string $text): string
    {
        return $text;
    }

    /**
     * Get prohibited words count.
     *
     * @param string $text
     * @return int
     */
    public function getProhibitedWordsCount(string $text): int
    {
        return empty($text) ? 0 : -1;
    }
}
