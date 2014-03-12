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

	public function toPossessiveProvider()
	{
		return array(
			array("carcass", "carcass'"),
			array("manager", "manager's"),
			array("Birch", "Birch's"),
			array("Sanchez", "Sanchez's"),
			array("Williams", "Williams'")
		);
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::toPossessive
     * @dataProvider toPossessiveProvider
     */
	public function testToPossessive($noun, $result)
	{
		$this->assertEquals($result, $this->sut->toPossessive($noun));
	}

	public function quantifyNounProvider()
	{
		return array(
			array("class", "classes", null),
			array("glass", "glasses", null),
			array("church", "churches", null),
			array("box", "boxes", null),
			array("crush", "crushes", null),
			array("bush", "bushes", null),
			array("bully", "bullies", null),
			array("country", "countries", null),
			array("baby", "babies", null),
			array("body", "bodies", null),
			array("memory", "memories", null),
			array("sky", "skies", null),
			array("day", "days", null),
			array("boy", "boys", null),
			array("journey", "journeys", null),
			array("key", "keys", null),
			array("tray", "trays", null),
			array("thesis", "theses", null),
			array("parenthesis", "parentheses", null),
			array("quiz", "quizzes", null),
			array("dog", "dogs", null),
			array("cat", "cats", null),
			array("man", "men", "men")
		);
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::quantifyNoun
     * @dataProvider quantifyNounProvider
     */
	public function testQuantifyNoun($noun, $plural, $alternate)
	{
		$this->assertEquals($noun, $this->sut->quantifyNoun($noun));
		$this->assertEquals($plural, $this->sut->quantifyNoun($noun, 2, $alternate));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::formatPlural
     * @dataProvider quantifyNounProvider
     */
	public function testFormatPlural($noun, $plural, $alternate)
	{
		$this->assertEquals("1 $noun", $this->sut->formatPlural($noun));
		$this->assertEquals("2 $plural", $this->sut->formatPlural($noun, 2, $alternate));
		$this->assertEquals("No $plural", $this->sut->formatPlural($noun, 0, $alternate, "No $plural"));
	}

	public function verbTenseProvider()
	{
		return array(
			array("remove", "remove", date('Y-m-d H:i:s', strtotime('+1 day'))),
			array("remove", "removed", date('Y-m-d H:i:s', strtotime('-1 day'))),
			array("party", "partied", false),
			array("deny", "denied", date('Y-m-d H:i:s', strtotime('-3 day'))),
			array("blind", "blind", date('Y-m-d H:i:s', strtotime('+1 day')))
		);
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::verbTense
     * @dataProvider verbTenseProvider
     */
	public function testVerbTense($verb, $result, $date)
	{
		$this->assertEquals($result, $this->sut->verbTense($verb, $date));
	}

}