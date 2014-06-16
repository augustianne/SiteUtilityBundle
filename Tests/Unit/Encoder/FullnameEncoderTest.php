<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Tests\Unit\Encoder;

use Site\UtilityBundle\Encoder\FullnameEncoder;

/**
 * Unit test for FullnameEncoder
 *
 * @author  Yan Barreta
 * @version dated: March 3, 2011 10:07:15
 */
class FullnameEncoderTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setup()
	{
		$this->sut = new FullnameEncoder();
	}

	public function encodeInputMiddleName()
	{
		return array(
			array(
				'Augustianne Laurenne Llevado Barreta', 'Augustianne Laurenne', 'Barreta', 'Llevado', FullnameEncoder::FIRST_NAME_FIRST, FullnameEncoder::MIDDLE_NAME
			),
			array(
				'Reynaldo Eraya Castellano III', 'Reynaldo III', 'Castellano', 'Eraya', FullnameEncoder::FIRST_NAME_FIRST, FullnameEncoder::MIDDLE_NAME
			),
			array(
				'Dominique Aguilos', 'Dominique', 'Aguilos', '', FullnameEncoder::FIRST_NAME_FIRST, FullnameEncoder::MIDDLE_NAME
			),
			array(
				'Barreta, Augustianne Laurenne Llevado', 'Augustianne Laurenne', 'Barreta', 'Llevado', FullnameEncoder::LAST_NAME_FIRST, FullnameEncoder::MIDDLE_NAME
			),
			array(
				'Castellano, Reynaldo III Eraya', 'Reynaldo III', 'Castellano', 'Eraya', FullnameEncoder::LAST_NAME_FIRST, FullnameEncoder::MIDDLE_NAME
			),
			array(
				'Aguilos, Dominique', 'Dominique', 'Aguilos', '', FullnameEncoder::LAST_NAME_FIRST, FullnameEncoder::MIDDLE_NAME
			),
		);
	}

	public function encodeInputMiddleInitial()
	{
		return array(
			array(
				'Augustianne Laurenne L. Barreta', 'Augustianne Laurenne', 'Barreta', 'Llevado', FullnameEncoder::FIRST_NAME_FIRST, FullnameEncoder::MIDDLE_INITIAL
			),
			array(
				'Reynaldo E. Castellano III', 'Reynaldo III', 'Castellano', 'Eraya', FullnameEncoder::FIRST_NAME_FIRST, FullnameEncoder::MIDDLE_INITIAL
			),
			array(
				'Dominique Aguilos', 'Dominique', 'Aguilos', '', FullnameEncoder::FIRST_NAME_FIRST, FullnameEncoder::MIDDLE_INITIAL
			),
			array(
				'Barreta, Augustianne Laurenne L.', 'Augustianne Laurenne', 'Barreta', 'Llevado', FullnameEncoder::LAST_NAME_FIRST, FullnameEncoder::MIDDLE_INITIAL
			),
			array(
				'Castellano, Reynaldo III E.', 'Reynaldo III', 'Castellano', 'Eraya', FullnameEncoder::LAST_NAME_FIRST, FullnameEncoder::MIDDLE_INITIAL
			),
			array(
				'Aguilos, Dominique', 'Dominique', 'Aguilos', '', FullnameEncoder::LAST_NAME_FIRST, FullnameEncoder::MIDDLE_INITIAL
			),
		);
	}


	/**
     * @covers Site\UtilityBundle\Encoder\Fullname::encode
     * @dataProvider encodeInputMiddleName
     */
	public function testEncodeMiddleName($expected, $firstName, $lastName, $middleName, $format, $middleNameFormat)
	{
		$actual = $this->sut->encode($firstName, $lastName, $middleName, $format, $middleNameFormat);
		
		$this->assertEquals($expected, $actual);
	}

	/**
     * @covers Site\UtilityBundle\Encoder\Fullname::encode
     * @dataProvider encodeInputMiddleInitial
     */
	public function testEncodeMiddleInitial($expected, $firstName, $lastName, $middleName, $format, $middleNameFormat)
	{
		$actual = $this->sut->encode($firstName, $lastName, $middleName, $format, $middleNameFormat);
		
		$this->assertEquals($expected, $actual);
	}


}