<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Tests\Unit\Detector;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;
use Site\UtilityBundle\Detector\DeviceDetector;

/**
 * Unit test for DeviceDetector
 *
 * @author  Yan Barreta
 * @version dated: March 3, 2011 10:07:15
 */
class DeviceDetectorTest extends \PHPUnit_Framework_TestCase
{

	private $sut;

	public function setSut($request, $treatTabletAsMobile)
	{
		$this->sut = new DeviceDetector($request, $treatTabletAsMobile);
	}

	public function getUserAgents()
	{
		return array(
			array(
				'desktop', true, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36'
			),
			// MyPhone
			array(
				'mobile', true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				'mobile', true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				'mobile', true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			// Cherry Mobile
			array(
				'mobile', true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				'mobile', true, 'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'
			),
			array(
				'mobile', true, 'Mozilla/5.0 (Linux; Android 4.1.2; Flare2X Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Mobile Safari/537.36'
			),
			array(
				'mobile', true, 'OneBrowser/4.2.0/Adr(Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Mobile Safari/533.1'
			),
			array(
				'mobile', true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				'tablet', false, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			)
			// 
		);
	}

	public function isMobileProvider()
	{
		return array(
			array(
				false, true, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36'
			),
			// MyPhone
			array(
				true, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				true, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				true, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			// Cherry Mobile
			array(
				true, true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				true, true, 'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'
			),
			array(
				true, true, 'Mozilla/5.0 (Linux; Android 4.1.2; Flare2X Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Mobile Safari/537.36'
			),
			array(
				true, true, 'OneBrowser/4.2.0/Adr(Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Mobile Safari/533.1'
			),
			array(
				true, true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				false, false, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			),
			array(
				true, true, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			)
			// 
		);
	}

	public function isTabletProvider()
	{
		return array(
			array(
				false, true, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36'
			),
			// MyPhone
			array(
				false, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				false, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				false, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			// Cherry Mobile
			array(
				false, true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				false, true, 'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'
			),
			array(
				false, true, 'Mozilla/5.0 (Linux; Android 4.1.2; Flare2X Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Mobile Safari/537.36'
			),
			array(
				false, true, 'OneBrowser/4.2.0/Adr(Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Mobile Safari/533.1'
			),
			array(
				false, true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				true, false, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			),
			array(
				false, true, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			)
			// 
		);
	}

	public function isDesktopProvider()
	{
		return array(
			array(
				true, true, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36'
			),
			// MyPhone
			array(
				false, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				false, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			array(
				false, true, 'Mozilla/5.0 (0; U; Compatible; MSIE 10.0; Windows Phone OS 8.1; Trident/7.0; rv:11.0; IEMobile/11.0; ARM; Touch; MyPhone; A1-A© Macintosh; U; Intel Mac OS X10_9_1; U; X11; U; Linux x86_64; en=ID) MyWebkit/537.36+; U; (KHTML, like Gecko; U;) Chrome/33.0.17'
			),
			// Cherry Mobile
			array(
				false, true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				false, true, 'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30'
			),
			array(
				false, true, 'Mozilla/5.0 (Linux; Android 4.1.2; Flare2X Build/JZO54K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.82 Mobile Safari/537.36'
			),
			array(
				false, true, 'OneBrowser/4.2.0/Adr(Linux; U; Android 4.1.2; en-us; Flare2X Build/JZO54K) AppleWebKit/533.1 (KHTML, like Gecko) Mobile Safari/533.1'
			),
			array(
				false, true, 'Opera/9.80 (Android; Opera Mini/7.5.31657/31.1475; U; en) Presto/2.8.119 Version/11.10'
			),
			array(
				false, false, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			),
			array(
				false, true, 'Mozilla/5.0 (Linux; Android 4.3; Nexus 10 Build/JWR66Y) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.72 Safari/537.36'
			)
			// 
		);
	}

	/**
     * @covers Site\UtilityBundle\Detector\DeviceDetector::detect
     * @dataProvider getUserAgents
     */
	public function testDetect($type, $treatTabletAsMobile, $userAgent)
	{
		$headerBag = new HeaderBag();
		$headerBag->set('user-agent', $userAgent);

		$request = new Request();
		$request->headers = $headerBag;

		$this->setSut($request, $treatTabletAsMobile);
		$this->assertEquals($type, $this->sut->detect());
	}

	/**
     * @covers Site\UtilityBundle\Detector\DeviceDetector::isMobile
     * @dataProvider isMobileProvider
     */
	public function testIsMobile($type, $treatTabletAsMobile, $userAgent)
	{
		$headerBag = new HeaderBag();
		$headerBag->set('user-agent', $userAgent);

		$request = new Request();
		$request->headers = $headerBag;

		$this->setSut($request, $treatTabletAsMobile);
		$this->assertEquals($type, $this->sut->isMobile());
	}

	/**
     * @covers Site\UtilityBundle\Detector\DeviceDetector::detect
     * @dataProvider isTabletProvider
     */
	public function testIsTablet($type, $treatTabletAsMobile, $userAgent)
	{
		$headerBag = new HeaderBag();
		$headerBag->set('user-agent', $userAgent);

		$request = new Request();
		$request->headers = $headerBag;

		$this->setSut($request, $treatTabletAsMobile);
		$this->assertEquals($type, $this->sut->isTablet());
	}

	/**
     * @covers Site\UtilityBundle\Detector\DeviceDetector::detect
     * @dataProvider isDesktopProvider
     */
	public function testIsDesktop($type, $treatTabletAsMobile, $userAgent)
	{
		$headerBag = new HeaderBag();
		$headerBag->set('user-agent', $userAgent);

		$request = new Request();
		$request->headers = $headerBag;

		$this->setSut($request, $treatTabletAsMobile);
		$this->assertEquals($type, $this->sut->isDesktop());
	}

}