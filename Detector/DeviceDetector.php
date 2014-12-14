<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Detector;

use Symfony\Component\HttpFoundation\Request;

/**
* Detects device from where the request comes from
*
* @author  Yan Barreta
* @version dated: Dec 1, 2014 4:56:36
*/
class DeviceDetector
{

    private $request;

    private $treatTabletAsMobile = false;

    private $mobileUserAgentsIdentfiers = array(
        'iphone', 'phone', 'mobile', 'opera mini'  
    );

    private $tabletUserAgentsIdentfiers = array(
        'ipad', 'nexus 10', 'pad'  
    );

    public function __construct(Request $request, $treatTabletAsMobile=true)
    {
        $this->setRequest($request);
        $this->setTabletAsMobile($treatTabletAsMobile);
    }

    /**
     * Set request
     *
     * @param Request
     */    
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Retrieves device user agent
     *
     * @return String
     */
    public function getUserAgent()
    {
        return $this->request->headers->get('user-agent');   
    }

    /**
     * Set rule to whether treat tablets as mobile
     *
     * @param boolean
     */    
    public function setTabletAsMobile($treatTabletAsMobile)
    {
        $this->treatTabletAsMobile = $treatTabletAsMobile;
    }

    /**
     * Returns true if tablets are to be treated as mobile
     *
     * @return Request
     */
    public function treatTabletAsMobile()
    {
        return $this->treatTabletAsMobile;
    }

    /**
     * Get all mobile user agents
     *
     * @return Request
     */
    public function getMobileUserAgents()
    {
        if ($this->treatTabletAsMobile()) {
            $regex = array_merge(
                $this->mobileUserAgentsIdentfiers, $this->tabletUserAgentsIdentfiers
            );

            return $regex;
        }

        return $this->mobileUserAgentsIdentfiers;
    }

    /**
     * Get all tablet user agents
     *
     * @return Request
     */
    public function getTabletUserAgents()
    {
        if ($this->treatTabletAsMobile()) {
            return array();
        }

        return $this->tabletUserAgentsIdentfiers;
    }
    
    /**
     * Detects device type. Defaults to 'desktop' if user agent is not found
     *
     * @return String
     */
    public function detect()
    {
        $userAgent = $this->getUserAgent();

        $mobileRegex = $this->getMobileUserAgents();
        if (preg_match('/('.implode('|', $mobileRegex).')/i', $userAgent)) {
            return 'mobile';
        }

        if (!$this->treatTabletAsMobile()) {
            $tabletRegex = $this->getTabletUserAgents();
            if (preg_match('/('.implode('|', $tabletRegex).')/i', $userAgent)) {
                return 'tablet';
            }
        }

        // treat all other unidentified user agents as dektop
        return 'desktop';
    }
}
