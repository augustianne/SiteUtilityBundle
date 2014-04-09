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
 * Object representation of a page header
 *
 * @author  Yan Barreta
 */
class WebPageHeader
{
    private $title = null;
    private $headerText = null;

    public function __construct($title, $headerText)
    {
        $this->title = $title;
        $this->headerText = $headerText;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setHeaderText($headerText)
    {
        $this->headerText = $headerText;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getHeaderText()
    {
        return $this->headerText;
    }
}
