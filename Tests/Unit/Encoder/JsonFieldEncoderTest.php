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

use Site\UtilityBundle\Encoder\JsonFieldEncoder;

/**
 * Unit test for JsonFieldEncoder
 *
 * @author  Yan Barreta
 * @version dated: March 3, 2011 10:07:15
 */
class JsonFieldEncoderTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setup()
	{
		$this->sut = new JsonFieldEncoder();
	}

	/**
     * @covers Site\UtilityBundle\Encoder\JsonFieldEncoder::encode
     */
	public function testEncodeNoDefaultArrayAllowAllKeys()
	{
		$inputArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'dirty' => 'Dirty Field'
		);

		$this->assertEquals(json_encode($inputArray), $this->sut->encode($inputArray));
	}

	/**
     * @covers Site\UtilityBundle\Encoder\JsonFieldEncoder::encode
     */
	public function testEncodeWithDefaultArrayAllowAllKeys()
	{
		$defaultArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'field3' => 'Field 3'
		);

		$inputArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'dirty' => 'Dirty Field'
		);

		$actualArray = array_merge($defaultArray, $inputArray);

		$this->assertEquals(json_encode($actualArray), $this->sut->encode($inputArray, $defaultArray));
	}

	/**
     * @covers Site\UtilityBundle\Encoder\JsonFieldEncoder::encode
     */
	public function testEncodeWithDefaultArrayRestrictKeys()
	{
		$defaultArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'field3' => 'Field 3'
		);

		$inputArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'dirty' => 'Dirty Field'
		);

		$allowedKeys = array(
			'field1',
			'field2',
			'field3'
		);

		$actualArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'field3' => 'Field 3'
		);

		$this->assertEquals(json_encode($actualArray), $this->sut->encode($inputArray, $defaultArray, $allowedKeys));
	}

	/**
     * @covers Site\UtilityBundle\Encoder\JsonFieldEncoder::decode
     */
	public function testDecodeReturnsNullIfStringIsInvalid()
	{
		$json = '{status: "test"}';

		$this->assertEquals(null, $this->sut->decode($json));
	}

	/**
     * @covers Site\UtilityBundle\Encoder\JsonFieldEncoder::decode
     */
	public function testDecodeReturnsCorrectlyDecodedArray()
	{
		$actualArray = array(
			'field1' => 'Field 1',
			'field2' => 'Field 2',
			'field3' => 'Field 3'
		);

		$diff = array_diff($actualArray, $this->sut->decode(json_encode($actualArray)));
		$this->assertTrue(!count($diff));
	}

}