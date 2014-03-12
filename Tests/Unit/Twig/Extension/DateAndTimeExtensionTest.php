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

	public function getDateTimesWithPeriod()
	{
		return array(
			array(new DateTime('+ 1 years'), 'y', '1'),
			array(new DateTime('+ 2 years'), 'y', '2'),
			array(new DateTime('+ 1 months'), 'm', '1'),
			array(new DateTime('+ 2 months'), 'm', '2'),
			array(new DateTime('+ 1 days'), 'd', '1'),
			array(new DateTime('+ 2 days'), 'd', '2'),
			array(new DateTime('+ 5 days'), 'd', '5'),
			array(new DateTime('+ 1 hours'), 'h', '1'),
			array(new DateTime('+ 2 hours'), 'h', '2'),
			array(new DateTime('+ 1 minutes'), 'i', '1'),
			array(new DateTime('+ 2 minutes'), 'i', '2'),
			array(new DateTime('+ 1 seconds'), 's', '1'),
			array(new DateTime('+ 2 seconds'), 's', '2'),
			array(new DateTime('+ 2 seconds'), 'w', null)
		);
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\DateAndTimeExtension::countdown
     * @dataProvider getDateTimes
     */
	public function testCountdown($date, $result)
	{
		$this->assertEquals($result, $this->sut->countdown($date));
	}

	/**
     * @covers Site\UtilityBundle\Twig\Extension\DateAndTimeExtension::countdown
     * @dataProvider getDateTimesWithPeriod
     */
	public function testCountdownWherePeriodIsPassed($date, $period, $result)
	{
		$this->assertEquals($result, $this->sut->countdown($date, $period));
	}

}