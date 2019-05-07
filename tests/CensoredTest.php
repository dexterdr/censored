<?php

namespace Tests;

use Censored\Censored;
use PHPUnit\Framework\TestCase;

final class CensoredTest extends TestCase
{
    /**
     * @var \Censored\Censored
     */
    private $censored;

    /**
     * @var string
     */
    private $bad = 'I will kill you and fuck your body, dumbshit motherfucker! not_fuck_exact';

    /**
     * @var string
     */
    private $good = 'Any type may be returned, including arrays and objects.';

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->censored = new Censored();
    }

    /**
     * Check text for vocabulary acceptability.
     */
    public function testIsAcceptable(): void
    {
        $this->censored->setExactMatch(true);
        $this->assertFalse($this->censored->isAcceptable($this->bad));
        $this->assertTrue($this->censored->isAcceptable($this->good));
    }

    /**
     * Check text for vocabulary acceptability.
     */
    public function testIsAcceptableMultiline(): void
    {
        $this->censored->setExactMatch(true);
        $this->assertFalse($this->censored->isAcceptable("test\r\nfuck"));
    }

    /**
     * Censorship of the text.
     */
    public function testCensor(): void
    {
        $this->censored->setExactMatch(true);
        $this->assertNotEquals($this->bad, $this->censored->censor($this->bad));
        $this->assertEquals($this->good, $this->censored->censor($this->good));
    }

    /**
     * Counting prohibited words in text.
     */
    public function testGetProhibitedWordsCount(): void
    {
        $this->censored->setExactMatch(true);
        // fuck, dumbshit, motherfucker
        $this->assertEquals(3, $this->censored->getProhibitedWordsCount($this->bad));
        $this->assertEquals(0, $this->censored->getProhibitedWordsCount($this->good));
    }

    /**
     * Counting prohibited words in text (not exact match).
     */
    public function testGetProhibitedWordsCountNotExact(): void
    {
        $this->censored->setExactMatch(false);
        // fuck, dumbshit, motherfucker, not_fuck_exact
        $this->assertEquals(4, $this->censored->getProhibitedWordsCount($this->bad));
        $this->assertEquals(0, $this->censored->getProhibitedWordsCount($this->good));
    }

    /**
     * Counting prohibited words in text (two languages at the same time).
     */
    public function testGetProhibitedWordsCountInternational(): void
    {
        $this->censored->setLanguages(['en', 'ru']);
        $this->assertEquals(2, $this->censored->getProhibitedWordsCount('fuck ебать'));
        $this->censored->setLanguages(['en']);
    }
}
