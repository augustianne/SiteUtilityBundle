<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Encoder;

/**
* Handles encoding/decoding of twitter url/handle
*
* @author  Yan Barreta
* @version dated: March 3, 2011 10:07:15
*/
class TwitterHandleEncoder
{

    /**
     * Given a twitter handle, this will return the full twitter url
     *
     * @param String $twitterHandle
     * @return String
     */
    public function encode($twitterHandle)
    {
        $pattern = '/^((https|http)?:\/\/(www\.)?twitter\.com\/)/';
        
        if (preg_match($pattern, $twitterHandle)) {
            return $twitterHandle;
        }
        
        $pattern = '/^((www\.)?twitter\.com\/)/';
        if (preg_match($pattern, $twitterHandle)) {
            return 'http://'.$twitterHandle;
        }
        
        return 'http://twitter.com/'.$twitterHandle;
    }

    /**
     * Given a full twitter url, this function will return the corresponding twitter handle
     *
     * @param String $url
     * @return String
     */
    public function decode($url)
    {
        $twitterHandler = $url;
        $pattern = '/^(((https|http)?:\/\/(www\.)?twitter\.com\/)|((www\.)?twitter\.com\/))/';
        if (preg_match($pattern, $twitterHandler)) {
            $twitterHandler = preg_replace($pattern, '', $twitterHandler);
        }
        
        return $twitterHandler;
    }
}
