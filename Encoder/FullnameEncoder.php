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
* Handles encoding and decoding of people's names
*
* @author  Yan Barreta
* @version dated: Jun 16, 2011 3:44:16
*/
class FullnameEncoder
{

    const FIRST_NAME_FIRST = 1;
    const LAST_NAME_FIRST = 2;

    const MIDDLE_INITIAL = 1;
    const MIDDLE_NAME = 2;
    
    /**
     * Given the person's first, last and middle name, encode to correct full name format
     *
     * @param String $firstName
     * @param String $lastName
     * @param String $middleName <optional>
     * @param String $format <optional; FIRST_NAME_FIRST>
     * @param String $middleNameFormat <optional; MIDDLE_NAME>
     * @return String
     */
    public function encode($firstName, $lastName, $middleName="", $format=self::FIRST_NAME_FIRST, $middleNameFormat=self::MIDDLE_NAME)
    {
        if ($middleNameFormat == self::MIDDLE_INITIAL && !empty($middleName)) {
            $middleName = sprintf("%s.", $middleName[0]);
        }

        if ($format == self::LAST_NAME_FIRST) {
            $fullName = sprintf("%s, %s %s", $lastName, $firstName, $middleName);
        }

        if ($format == self::FIRST_NAME_FIRST) {
            preg_match_all('/([\w\s]+)((?:Sr\.|Jr\.|III|IV|V))$/i', $firstName, $match);
            
            if (isset($match[2][0])) {
                $lastName = sprintf("%s %s", $lastName, $match[2][0]);
                $firstName = trim($match[1][0]);
            }

            $fullName = sprintf("%s %s %s", $firstName, $middleName, $lastName);
        }

        return trim(preg_replace('/\s+/', ' ', $fullName));
    }

    /**
     * @todo this is going to be tricky
     */
    public function decode($fullname)
    {}
}
