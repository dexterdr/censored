<?php

namespace Tests;

use Censored\Censored;
use PHPUnit\Framework\TestCase;

final class CensoredTest extends TestCase
{
    /**
     * @var \Censored\Censored
     */
    private $censor;

    /**
     * @var string
     */
    private $bad = 'I will kill you and fuck your body, dumbshit motherfucker!';

    /**
     * @var string
     */
    private $good = 'Any type may be returned, including arrays and objects.';

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->censor = new Censored();
    }

    /**
     * Check text for vocabulary acceptability.
     */
    public function testIsAcceptable()
    {
        $this->assertFalse($this->censor->isAcceptable($this->bad));
    }

    /**
     * Censorship of the text.
     */
    public function testCensor()
    {
        $this->assertEquals($this->good, $this->censor->censor($this->good));
    }

    /**
     * Counting prohibited words in text.
     */
    public function testGetProhibitedWordsCount()
    {
        $this->assertEquals(0, $this->censor->getProhibitedWordsCount(''));
    }
}
