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
 * A class that holds valid meta types to be added to a page
 *
 * @author  Yan Barreta
 */
class WebPageMetaType
{

    const META_TITLE = 'title';
    const META_DESCRIPTION = 'description';
    
    const OG_META_PROPERTY_SITE_NAME = 'og:site_name';
    const OG_META_PROPERTY_TITLE = 'og:title';
    const OG_META_PROPERTY_DESCRIPTION = 'og:description';
    const OG_META_PROPERTY_IMAGE = 'og:image';
    const OG_META_PROPERTY_URL = 'og:url';

    private static $validMetaTypes = array(
        self::META_TITLE,
        self::META_DESCRIPTION,
    );
    
    private static $validMetaPropertyTypes = array(
        self::OG_META_PROPERTY_TITLE,
        self::OG_META_PROPERTY_DESCRIPTION,
        self::OG_META_PROPERTY_SITE_NAME,
        self::OG_META_PROPERTY_IMAGE,
        self::OG_META_PROPERTY_URL,
    );

    /**
     * Checks if a meta type is valid
     *
     * @param String meta type
     **/
    public static function isValidMetaType($metaType)
    {
        return in_array($metaType, self::$validMetaTypes);
    }
    
    /**
     * Checks if a meta property is valid
     *
     * @param String meta property type
     **/
    public static function isValidMetaPropertyType($metaPropertyType)
    {
        return in_array($metaPropertyType, self::$validMetaPropertyTypes);
    }
}
