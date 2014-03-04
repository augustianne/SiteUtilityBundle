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
 * Handles slug encoding/decoding
 *
 * @author  Yan Barreta
*/
class SlugEncoder
{
    
    /**
     * Encode text to be more url friendly
     *
     * @param String $text - text to be encoded
     * @param String $prefix [optional] - text to prepend the slug after creation
     * @param String $postfix [optional] - text to append to the slug after creation
     * @return String - slug, a url friendly string
     */
    public function encode($text, $prefix = '', $postfix = '')
    {
        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        if (function_exists('mb_strtolower')) {
            $text = mb_strtolower($text);
        } else {
            $text = strtolower($text);
        }

        // remove accents resulting from OSX's iconv
        $text = str_replace(array('\'', '`', '^'), '', $text);

        // replace non letter or digits with separator
        $text = preg_replace('/[^\\pL\\d]+/u', '-', $text);

        // trim
        $text = trim($text, '-');

        if (empty($text)) {
            return null;
        }

        return $prefix.$text.$postfix;
    }

    public function decode()
    {}
    

}