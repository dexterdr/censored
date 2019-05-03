<?php

namespace Censored;

/**
 * Simple library for censorship.
 */
class Censored
{
    /**
     * @var \Censored\Dictionary
     */
    private $dictionary;

    /**
     * @var bool
     */
    private $exactMatch;

    public function __construct(array $languages = ['en'], $exactMatch = true)
    {
        $this->dictionary = new Dictionary($languages);
        $this->exactMatch = $exactMatch;
    }

    /**
     * Get array of currently used languages.
     *
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->dictionary->getLanguages();
    }

    /**
     * Set new list of languages.
     *
     * @param array $languages
     */
    public function setLanguages(array $languages): void
    {
        $this->dictionary->setLanguages($languages);
    }

    /**
     * Get "exact match" option value.
     *
     * @return bool
     */
    public function isExactMatch(): bool
    {
        return $this->exactMatch;
    }

    /**
     * Set "exact match" match option value.
     *
     * @param bool $exactMatch
     */
    public function setExactMatch(bool $exactMatch): void
    {
        $this->exactMatch = $exactMatch;
    }

    /**
     * Check text for vocabulary acceptability.
     *
     * @param string $text
     * @return bool
     */
    public function isAcceptable(string $text): bool
    {
        return ($this->getProhibitedWordsCount($text) == 0) ? true : false;
    }

    /**
     * Censorship of the text (partially ignore $exactMatch flag).
     *
     * @param string $text
     * @return string
     */
    public function censor(string $text): string
    {
        $prohibited = Comparator::search($text, $this->dictionary->getWords(), $this->exactMatch);

        if (empty($prohibited)) {
            return $text;
        }

        usort($prohibited, function ($a, $b) {
            return mb_strlen($b) - mb_strlen($a);
        });

        return str_replace($prohibited, '***', $text);
    }

    /**
     * Get prohibited words count.
     *
     * @param string $text
     * @return int
     */
    public function getProhibitedWordsCount(string $text): int
    {
        return count(Comparator::search($text, $this->dictionary->getWords(), $this->exactMatch));
    }
}
