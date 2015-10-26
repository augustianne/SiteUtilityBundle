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

use \Exception;

use Site\UtilityBundle\Page\WebPageMetaType;

/**
 * Object representation of a meta data
 *
 * @author  Yan Barreta
 */
abstract class WebPageMetaData
{
    private $metaData = array();
    private $metaPropertyData = array();

    public function __construct($metaData = array(), $metaPropertyData = array())
    {
        foreach ($metaData as $iMetaType => $value) {
            $this->setMetaData($iMetaType, $value);
        }
        
        foreach ($metaPropertyData as $iMetaPropertyType => $value) {
            $this->setMetaPropertyData($iMetaPropertyType, $value);
        }
    }

    public function setMetaData($metaType, $value)
    {
        //check if valid
        if (!WebPageMetaType::isValidMetaType($metaType)) {
            throw new Exception('Invalid meta type: '.$metaType);
        }
        $this->metaData[$metaType] = $value;
    }

    public function getMetaData($metaType)
    {
        if (!WebPageMetaType::isValidMetaType($metaType)) {
            throw new Exception('Invalid meta type: '.$metaType);
        }
        if (isset($this->metaData[$metaType])) {
            return $this->metaData[$metaType];
        }
        
        return null;
    }

    public function getAllMetaData()
    {
        return $this->metaData;
    }
    
    public function setMetaPropertyData($metaPropertyType, $value)
    {
        //check if valid
        if (!WebPageMetaType::isValidMetaPropertyType($metaPropertyType)) {
            throw new Exception('Invalid meta property type: '.$metaPropertyType);
        }
        
        $this->metaPropertyData[$metaPropertyType] = $value;
    }
    
    public function getMetaPropertyData($metaPropertyType)
    {
        if (!WebPageMetaType::isValidMetaType($metaPropertyType)) {
            throw new Exception('Invalid meta property type: '.$metaPropertyType);
        }
        if (isset($this->metaPropertyData[$metaPropertyType])) {
            return $this->metaPropertyData[$metaPropertyType];
        }
        return null;
    }
    
    public function getAllMetaPropertyData()
    {
        return $this->metaPropertyData;
    }

    abstract public function setDefaultMetaData();

    abstract public function setDefaultMetaPropertyData();
}
