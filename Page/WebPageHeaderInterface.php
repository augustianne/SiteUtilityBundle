<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Page;

/**
 * Interface for composing a web page header
 *
 * @author  Yan Barreta
 */
interface WebPageHeaderInterface
{
	
	/**
	 * Composes page headers for a webpage
	 * @param Array @params
	 */
    public function composePageHeaders($params = array());
}
