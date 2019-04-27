<?php

namespace Tests;

use Censored\Censored;
use PHPUnit\Framework\TestCase;

final class CensoredTest extends TestCase
{
    public function testConstructor()
    {
        $censor = new Censored();
        $this->assertTrue(true);
    }
}
