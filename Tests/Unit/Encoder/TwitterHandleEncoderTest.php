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

use Site\UtilityBundle\Encoder\TwitterHandleEncoder;

/**
 * Unit test for TwitterHandleEncoder
 *
 * @author  Yan Barreta
 * @version dated: March 3, 2011 10:07:15
 */
class TwitterHandleEncoderTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setup()
	{
		$this->sut = new TwitterHandleEncoder();
	}

	/**
     * @covers Site\UtilityBundle\Encoder\TwitterHandleEncoder::encode
     */
	public function testEncode()
	{
		$this->assertEquals('http://twitter.com/augustianne', $this->sut->encode('augustianne'));
	}

	/**
     * @covers Site\UtilityBundle\Encoder\TwitterHandleEncoder::decode
     */
	public function testDecode()
	{
		$this->assertEquals('augustianne', $this->sut->decode('http://twitter.com/augustianne'));
	}
}