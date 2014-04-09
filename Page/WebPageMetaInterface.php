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
 * Interface for composing a web page meta data
 *
 * @author  Yan Barreta
 */
interface WebPageMetaInterface
{

	/**
	 * Composes url for webpage
	 *
	 * @param Array @params
	 */
    public function composeUrl($params = array());

    /**
	 * Composes meta data for webpage
	 *
	 * @param Array @params
	 */
    public function composeMetaData($params = array());
}
