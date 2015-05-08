<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information,please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Generator;

use \Exception;

/**
* Generates random characters
*
* @author  Yan Barreta <augustianne.barreta@gmail.com>
* @version dated: March 29,2014 12:39:26
*/
class RandomCharacterGenerator
{

    const ALPHA_NUMERIC = 1;
    const ALPHA_NUMERIC_LOWERCASE = 2;
    const ALPHA_NUMERIC_UPPERCASE = 3;
    const NUMERIC = 4;
    const ALPHA_LOWERCASE = 5;
    const ALPHA_UPPERCASE = 6;
    
    private $characterSet = array(
        self::ALPHA_NUMERIC => array(
            '0','1','2','3','4','5','6','7','8','9',
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        ),
        self::ALPHA_NUMERIC_UPPERCASE => array(
            '0','1','2','3','4','5','6','7','8','9',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        ),
        self::ALPHA_NUMERIC_LOWERCASE => array(
            '0','1','2','3','4','5','6','7','8','9',
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'
        ),
        self::NUMERIC => array(
            '0','1','2','3','4','5','6','7','8','9'
        ),
        self::ALPHA_LOWERCASE => array(
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'
        ),
        self::ALPHA_UPPERCASE => array(
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
        )
    );

    /**
     * Returns character set by type
     *
     * @param int $type, type of characters 
     * @return array
     */
    public function getCharacterSet($type)
    {
        if (!isset($this->characterSet[$type])) {
            throw new Exception('Character set not supported.');
        }

        return $this->characterSet;
    }

    /**
     * Generates random characters
     *
     * @param int $length, how long will the generated chracters be
     * @param int $type, type of characters to be generated
     * @return string
     */
    public function generate($length, $type=self::ALPHA_NUMERIC)
    {
        $generatedString = array();

        if (!isset($this->characterSet[$type])) {
            throw new Exception('Character set not supported.');
        }

        $characterSet = $this->characterSet[$type];
        $upperLimit = count($characterSet)-1;
        while (count($generatedString) < $length) {
            $generatedString[] = $characterSet[rand(0, $upperLimit)];
        }

        return implode('', $generatedString);
    }
}