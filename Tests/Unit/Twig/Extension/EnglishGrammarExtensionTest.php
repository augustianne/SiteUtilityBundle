<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Tests\Unit\Twig\Extension;

use Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension;

/**
 * Unit test for EnglishGrammarExtension
 *
 * @author  Yan Barreta
 * @version dated: March 3, 2011 10:07:15
 */
class EnglishGrammarExtensionTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setup()
	{
		$this->sut = new EnglishGrammarExtension();
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::toPossessive
     */
	public function testToPossessiveReturnsApostropheIfStringEndsInS()
	{
		$this->assertEquals("carcass'", $this->sut->toPossessive("carcass"));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::toPossessive
     */
	public function testToPossessiveReturnsApostropheSIfStringDoesNotEndInS()
	{
		$this->assertEquals("manager's", $this->sut->toPossessive("manager"));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounAppendEsIfStringEndsInS()
	{
		$this->assertEquals("class", $this->sut->quantifyNoun("class"));
		$this->assertEquals("classes", $this->sut->quantifyNoun("class", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounAppendEsIfStringEndsInCh()
	{
		$this->assertEquals("church", $this->sut->quantifyNoun("church"));
		$this->assertEquals("churches", $this->sut->quantifyNoun("church", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounAppendEsIfStringEndsInX()
	{
		$this->assertEquals("box", $this->sut->quantifyNoun("box"));
		$this->assertEquals("boxes", $this->sut->quantifyNoun("box", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounAppendEsIfStringEndsInSh()
	{
		$this->assertEquals("crush", $this->sut->quantifyNoun("crush"));
		$this->assertEquals("crushes", $this->sut->quantifyNoun("crush", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounChangeYToIAndAddEsIfStringEndsInY()
	{
		$this->assertEquals("bully", $this->sut->quantifyNoun("bully"));
		$this->assertEquals("bullies", $this->sut->quantifyNoun("bully", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounChangeToEsIfStringEndsInIs()
	{
		$this->assertEquals("thesis", $this->sut->quantifyNoun("thesis"));
		$this->assertEquals("theses", $this->sut->quantifyNoun("thesis", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounAddZesIfStringEndsInZ()
	{
		$this->assertEquals("quiz", $this->sut->quantifyNoun("quiz"));
		$this->assertEquals("quizzes", $this->sut->quantifyNoun("quiz", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounAddSIfStringDoesNotNeedSpecialPluralization()
	{
		$this->assertEquals("dog", $this->sut->quantifyNoun("dog"));
		$this->assertEquals("dogs", $this->sut->quantifyNoun("dog", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     */
	public function testQuantifyNounUseAlternatePlural()
	{
		$this->assertEquals("man", $this->sut->quantifyNoun("man"));
		$this->assertEquals("men", $this->sut->quantifyNoun("man", 2, 'men'));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralAppendEsIfStringEndsInS()
	{
		$this->assertEquals("1 class", $this->sut->formatPlural("class"));
		$this->assertEquals("2 classes", $this->sut->formatPlural("class", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralAppendEsIfStringEndsInCh()
	{
		$this->assertEquals("1 church", $this->sut->formatPlural("church"));
		$this->assertEquals("2 churches", $this->sut->formatPlural("church", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralAppendEsIfStringEndsInX()
	{
		$this->assertEquals("1 box", $this->sut->formatPlural("box"));
		$this->assertEquals("2 boxes", $this->sut->formatPlural("box", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralAppendEsIfStringEndsInSh()
	{
		$this->assertEquals("1 crush", $this->sut->formatPlural("crush"));
		$this->assertEquals("2 crushes", $this->sut->formatPlural("crush", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralChangeYToIAndAddEsIfStringEndsInY()
	{
		$this->assertEquals("1 bully", $this->sut->formatPlural("bully"));
		$this->assertEquals("2 bullies", $this->sut->formatPlural("bully", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralChangeToEsIfStringEndsInIs()
	{
		$this->assertEquals("1 thesis", $this->sut->formatPlural("thesis"));
		$this->assertEquals("2 theses", $this->sut->formatPlural("thesis", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralAddZesIfStringEndsInZ()
	{
		$this->assertEquals("1 quiz", $this->sut->formatPlural("quiz"));
		$this->assertEquals("2 quizzes", $this->sut->formatPlural("quiz", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralAddSIfStringDoesNotNeedSpecialPluralization()
	{
		$this->assertEquals("1 dog", $this->sut->formatPlural("dog"));
		$this->assertEquals("2 dogs", $this->sut->formatPlural("dog", 2));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralUseAlternatePlural()
	{
		$this->assertEquals("1 man", $this->sut->formatPlural("man"));
		$this->assertEquals("2 men", $this->sut->formatPlural("man", 2, 'men'));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     */
	public function testFormatPluralUseEmptySubIfEmpty()
	{
		$this->assertEquals("No men", $this->sut->formatPlural("man", 0, 'men', 'No men'));
		$this->assertEquals("1 man", $this->sut->formatPlural("man", 1, 'men', 'No men'));
		$this->assertEquals("2 men", $this->sut->formatPlural("man", 2, 'men', 'No men'));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::verbTense
     */
	public function testVerbTenseAddDIfWordEndsInE()
	{
		$this->assertEquals("removed", $this->sut->verbTense("remove"));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::verbTense
     */
	public function testVerbTenseChangeYToIAndAddEdIfWordEndsInY()
	{
		$this->assertEquals("partied", $this->sut->verbTense("party"));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::verbTense
     */
	public function testVerbTenseAddEdIsAConsonantExceptD()
	{
		$this->assertEquals("blinded", $this->sut->verbTense("blind"));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::verbTense
     */
	public function testVerbTenseReturnUnchangedIfCompareDateIsGreaterThanTodaysDate()
	{
		$this->assertEquals("blind", $this->sut->verbTense("blind", date('Y-m-d H:i:s', strtotime('+1 day'))));
	}

}