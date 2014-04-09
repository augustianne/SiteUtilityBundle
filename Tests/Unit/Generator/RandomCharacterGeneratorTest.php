<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Tests\Unit\Generator;

use Site\UtilityBundle\Generator\RandomCharacterGenerator;

/**
 * Unit test for RandomCharacterGenerator
 *
 * @author  Yan Barreta
 * @version dated: March 29,2014 12:39:26
 */
class RandomCharacterGeneratorTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setup()
	{
		$this->sut = new RandomCharacterGenerator();
	}

	public function getInput()
	{
		return array(
			array(7, RandomCharacterGenerator::ALPHA_NUMERIC),
			array(10, RandomCharacterGenerator::ALPHA_NUMERIC),
			array(5, RandomCharacterGenerator::ALPHA_NUMERIC)
		);
	}

	public function getInputLowerCase()
	{
		return array(
			array(7, RandomCharacterGenerator::ALPHA_NUMERIC_LOWERCASE),
			array(10, RandomCharacterGenerator::ALPHA_NUMERIC_LOWERCASE),
			array(5, RandomCharacterGenerator::ALPHA_NUMERIC_LOWERCASE)
		);
	}

	public function getInputUpperCase()
	{
		return array(
			array(7, RandomCharacterGenerator::ALPHA_NUMERIC_UPPERCASE),
			array(10, RandomCharacterGenerator::ALPHA_NUMERIC_UPPERCASE),
			array(5, RandomCharacterGenerator::ALPHA_NUMERIC_UPPERCASE)
		);
	}

	/**
     * @covers Site\UtilityBundle\Generator\RandomCharacterGenerator::generate
     * @dataProvider getInput
     */
	public function testGenerateAlphanumeric($length, $type)
	{
		$randomString = $this->sut->generate($length, $type);
		
		$this->assertEquals($length, strlen($randomString));
		$this->assertTrue(ctype_alnum($randomString));
	}

	/**
     * @covers Site\UtilityBundle\Generator\RandomCharacterGenerator::generate
     * @dataProvider getInputLowerCase
     */
	public function testGenerateAlphanumericLowerCase($length, $type)
	{
		$randomString = $this->sut->generate($length, $type);
		
		$this->assertEquals(strtolower($randomString), $randomString);
		$this->assertEquals($length, strlen($randomString));
		$this->assertTrue(ctype_alnum($randomString));
	}

	/**
     * @covers Site\UtilityBundle\Generator\RandomCharacterGenerator::generate
     * @dataProvider getInputUpperCase
     */
	public function testGenerateAlphanumericUpperCase($length, $type)
	{
		$randomString = $this->sut->generate($length, $type);
		
		$this->assertEquals(strtoupper($randomString), $randomString);
		$this->assertEquals($length, strlen($randomString));
		$this->assertTrue(ctype_alnum($randomString));
	}
}