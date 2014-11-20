<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Tests\Encoder;

use Site\UtilityBundle\Encoder\SlugEncoder;

/**
 * Unit test for SlugEncoder
 *
 * @author  Yan Barreta
 * @version dated: March 4, 2011 10:07:15
 */
class SlugEncoderTest extends \PHPUnit_Framework_TestCase
{

    private $sut;

    public function setup()
    {
        $this->sut = new SlugEncoder();
    }

    /**
     * @covers Site\UtilityBundle\Encoder\SlugEncoder::encode
     */
    public function testEncodeSimpleStrings()
    {
        $this->assertEquals('this-is-a-string', $this->sut->encode('this is a string'));
        $this->assertEquals('this-is-a-string-2', $this->sut->encode('this is a string 2'));
    }

    /**
     * @covers Site\UtilityBundle\Encoder\SlugEncoder::encode
     */
    public function testEncodeUntrimmedStrings()
    {
        $this->assertEquals('this-is-a-string', $this->sut->encode(' this is a string '), 'Slugify is unable to handle strings that starts or ends with a space.');
    }

    /**
     * @covers Site\UtilityBundle\Encoder\SlugEncoder::encode
     */
    public function testEncodeMultiCasedStrings()
    {
        $this->assertEquals('this-is-a-string', $this->sut->encode('This Is A String'), 'Slugify is unable to handle strings that is multi case.');
    }
    
    /**
     * @covers Site\UtilityBundle\Encoder\SlugEncoder::encode
     */
    public function testEncodeStringsWithConsecutiveSpaces()
    {
        $this->assertEquals('this-is-a-string', $this->sut->encode('This  is  a  string'), 'Slugify is unable to handle strings with consecutive spaces.');
    }
    
    /**
     * @covers Site\UtilityBundle\Encoder\SlugEncoder::encode
     */
    public function testEncodeStringsWithNonAlphaNumericCharacters()
    {
        $this->assertEquals('this-is-a-string', $this->sut->encode('this-is a-string'), 'Slugify is unable to handle strings with dashes.');
        $this->assertEquals('this-is-a-string', $this->sut->encode('this#$@is/\a-!.%^()_+=~`string'), 'Slugify is unable to handle strings with non alpha numeric characters.');
    }
    
    /**
     * @covers Site\UtilityBundle\Encoder\SlugEncoder::encode
     */
    public function testEncodeStringsWithInvisibleCharacters()
    {
        $this->assertEquals('this-is-a-string', $this->sut->encode("\t\tthis \nis\r\n a \nstring\n\t\r"), 'Slugify is unable to handle strings with dashes.');
    }
    
    public function testEncodeStringsWithExcludedWords()
    {
        $excludedWords = array( "a", "an", "as", "at", "but", "by", "for", "from", "is", "in", "of", "on", "onto", "per", "since", "than", "that", "the", "this", "to", "via", "with");
        $testString = "this is a string with excluded words including ".implode(', ',$excludedWords);

        $this->assertEquals('string-excluded-words-including', $this->sut->encode($testString, '', '', $excludedWords) , 'Slugify is unable to handle strings with a set of excluded words.');
    }
}