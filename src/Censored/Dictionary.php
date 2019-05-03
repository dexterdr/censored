<?php

namespace Censored;

/**
 * Language related tools.
 *
 * @package Carbon
 */
class Dictionary
{
    /**
     * @var array
     */
    protected static $availableLanguages;

    /**
     * @var array
     */
    private $languages;

    /**
     * @var array
     */
    private $words;

    public function __construct(array $languages = ['en'])
    {
        $this->setLanguages($languages);
    }

    /**
     * Get array of currently used languages.
     *
     * @return array
     */
    public function getLanguages(): array
    {
        return $this->languages;
    }

    /**
     * Set new list of languages.
     *
     * @param array $languages
     */
    public function setLanguages(array $languages): void
    {
        $this->languages = array_intersect($languages, array_keys(static::getAvailableLanguages()));
        $this->loadLanguages();
    }

    /**
     * Get array of all available languages.
     *
     * @return array
     */
    public static function getAvailableLanguages(): array
    {
        if (!static::$availableLanguages) {
            static::$availableLanguages = include __DIR__ . '/languages.php';
        }

        return static::$availableLanguages;
    }

    /**
     * Load dictionaries for all current languages.
     */
    private function loadLanguages(): void
    {
        $this->words = [];

        foreach ($this->languages as $language) {
            $fileName = __DIR__ . '/Lang/' . $language . '.php';
            if (file_exists($fileName)) {
                /** @noinspection PhpIncludeInspection */
                $words = include $fileName;

                if (is_array($words)) {
                    $this->words = array_merge($this->words, $words);
                }
            }
        }
    }

    /**
     * Get all prohibited words for specified languages.
     *
     * @return array
     */
    public function getWords(): array
    {
        return $this->words;
    }
}
