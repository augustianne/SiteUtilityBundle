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

use \DateTime;

use Site\UtilityBundle\Twig\Extension\DateAndTimeExtension;

/**
 * Unit test for DateAndTimeExtension
 *
 * @author  Yan Barreta
 * @version dated: March 3, 2011 10:07:15
 */
class DateAndTimeExtensionTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setup()
	{
		$this->sut = new DateAndTimeExtension();
	}

	public function getDateTimes()
	{
		return array(
			array(new DateTime('+ 1 years'), '1 year'),
			array(new DateTime('+ 2 years'), '2 years'),
			array(new DateTime('+ 1 months'), '1 month'),
			array(new DateTime('+ 2 months'), '2 months'),
			array(new DateTime('+ 1 weeks'), '1 week'),
			array(new DateTime('+ 2 weeks'), '2 weeks'),
			array(new DateTime('+ 1 days'), '1 day'),
			array(new DateTime('+ 2 days'), '2 days'),
			array(new DateTime('+ 1 hours'), '1 hour'),
			array(new DateTime('+ 2 hours'), '2 hours'),
			array(new DateTime('+ 1 minutes'), '1 minute'),
			array(new DateTime('+ 2 minutes'), '2 minutes'),
			array(new DateTime('+ 1 seconds'), '1 second'),
			array(new DateTime('+ 2 seconds'), '2 seconds')
		);
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\EnglishGrammarExtension::toPossessive
     * @dataProvider getDateTimes
     */
	public function testCountdown($date, $result)
	{
		$this->assertEquals($result, $this->sut->countdown($date));
	}

}