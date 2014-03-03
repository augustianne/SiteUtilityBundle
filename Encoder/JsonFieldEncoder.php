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
 * Handles json encoding/decoding of arrays passed
 *
 * @author  Yan Barreta
*/
class JsonFieldEncoder
{

    /**
     * Encode array with valid/allowed values
     *
     * @param Array $inputArray - array to be ecoded to json
     * @param Array $defaultArray - array of default values
     * @param Mixed $allowedKeys - array of allowed keys, keys not in this array will be unset 
     *         and not included when array is encoded to json string. Set to false to allow all keys
     * @return String - json encoded string
     */
    public function encode($inputArray, $defaultArray=array(), $allowedKeys=false)
    {
        $newArray = array_merge($defaultArray, $inputArray);

        $cleanInput = $newArray;
        if (is_array($allowedKeys)) {
            $cleanInput = array_intersect_key($newArray, array_flip($allowedKeys));
        }

        return json_encode($cleanInput);
    }

    /**
     * Decode json string.
     *
     * @param String $json
     * @return Mixed - decoded json string, will return null if string is not properly decoded
     */
    public function decode($json)
    {
        $decodedJson = json_decode($json, true);
        
        return $decodedJson;
    }
}
