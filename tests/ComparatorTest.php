<?php

namespace Tests;

use Censored\Comparator;
use PHPUnit\Framework\TestCase;

final class ComparatorTest extends TestCase
{
    /**
     * Trim punctuation, split text and get unique lowercase words.
     */
    public function testTokenize(): void
    {
        $source = ':Hello#, @is StackOverflow% русский a a help_ful website& 123?* (Yes) !';
        $expected = 'hello, is, stackoverflow, русский, a, helpful, website, 123, yes';

        $this->assertEquals($expected, implode(Comparator::tokenize($source), ', '));
    }

    /**
     * Search words inside given text.
     */
    public function testSearch(): void
    {
        $source = 'Hello, World!';

        $this->assertEqualsCanonicalizing(['World'], Comparator::search($source, ['World'], true, false));
        $this->assertNotEqualsCanonicalizing(['world'], Comparator::search($source, ['World'], true, false));
        $this->assertEqualsCanonicalizing(['hello'], Comparator::search($source, ['hello'], true));
        $this->assertEqualsCanonicalizing(['world'], Comparator::search($source, ['orl'], false));
        $this->assertNotEqualsCanonicalizing(['world'], Comparator::search($source, ['_world_'], false));
    }

    /**
     * Computes the intersection of two arrays (strict).
     */
    public function testCompareStrict(): void
    {
        $haystack = ['bar', 'baz', 'foo', 'foo'];
        $needles = ['foo', 'ba', 'bazz'];

        $this->assertEqualsCanonicalizing(['foo'], Comparator::compare($haystack, $needles, true));
    }

    /**
     * Computes the intersection of two arrays.
     */
    public function testCompare(): void
    {
        $haystack = ['foo', '_bar', 'baz_', 'baz_'];
        $needles = ['fooo', 'bar', 'baz', 'ba'];

        $this->assertEqualsCanonicalizing(['_bar', 'baz_'], Comparator::compare($haystack, $needles, false));
    }
}
