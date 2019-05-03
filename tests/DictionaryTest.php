<?php

namespace Tests;

use Censored\Dictionary;
use PHPUnit\Framework\TestCase;

final class DictionaryTest extends TestCase
{
    /**
     * Get array of all available languages.
     */
    public function testGetAvailableLanguages(): void
    {
        $this->assertArrayHasKey('en', Dictionary::getAvailableLanguages());
    }

    /**
     * Create a new dictionary and check language setup.
     */
    public function testSetupLanguages(): void
    {
        $dictionary = new Dictionary();

        $this->assertEquals(['en'], $dictionary->getLanguages());
        $this->assertContains('fuck', $dictionary->getWords());
    }
}
