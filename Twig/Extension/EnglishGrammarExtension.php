<?php

/*
 * This file is part of SiteUtility.
 *
 * Yan Barreta <augustianne.barreta@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Site\UtilityBundle\Twig\Extension;

use \Exception;
use \Twig_Extension;

/**
* Handles grammatical issues with strings
*
* @author  Yan Barreta <augustianne.barreta@gmail.com>
* @version dated: February 3, 2011 11:19:26
*/
class EnglishGrammarExtension extends Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'to_possessive' => new \Twig_Function_Method($this, 'toPossessive'),
            'quantify_noun' => new \Twig_Function_Method($this, 'quantifyNoun'),
            'format_plural' => new \Twig_Function_Method($this, 'formatPlural'),
            'verb_tense' => new \Twig_Function_Method($this, 'verbTense'),
            'conjunct' => new \Twig_Function_Method($this, 'conjunct')
        );
    }

    /**
     * Retrieves possessive form of the text
     *
     * @param string Text
     * @return string Possessive form of the text
     */
    public function toPossessive($text)
    {
        return "s" == substr($text, -1) ? sprintf("%s'", $text) : sprintf("%s's", $text);
    }

    /**
     * Retrieves singular or plural form of the text
     *
     * @param String $noun - string to be formatted to plural
     * @param int - serves as the basis for the pluralization of a string
     * @param string $alternatePlural (optional) - alternate plural form of the string     
     * @return string Formatted string in singular/plural form
     */
    public function quantifyNoun($noun, $quantity=1, $alternatePlural=null)
    {
        $originalString = $noun;

        if ($quantity > 1) {

            if (!is_null($alternatePlural)) {
                return $alternatePlural;
            }

            // words ending in is change to es
            $noun = preg_replace('/(\w*)(is)$/', '$1es', $noun);
            // add s if word ends in vowel+y
            $noun = preg_replace('/[aeiou]+y$/', '$0s', $noun);
            // change y to i and add es
            $noun = preg_replace('/([b-d,f-h,j-n,p-t,v-z]+)y$/', '$1ies', $noun);
            // words ending in z add zes
            $noun = preg_replace('/(\w*)(z)$/', '$0zes', $noun);

            if ($originalString == $noun) {
                // add es to words ending in s, x, ch, sh
                $noun = preg_replace('/(\w*)(s|ch|x|sh)$/', '$0es', $noun);
            }
        }

        return (
            ("s" == substr($noun, -1) || 1 >= $quantity) 
            ? $noun : sprintf("%ss", $noun)
        );
    }

    /**
     * Formats the phrase in either singular/plural form 
     *
     * @param String $noun - string to be formatted to plural
     * @param int - serves as the basis for the pluralization of a string
     * @param string $emptySub (optional) - alternate word to be used if quantity is 0
     * @param string $alternatePlural (optional) - alternate plural form of the string
     * @return string Formatted phrase in singular/plural form
     */
    public function formatPlural($noun, $quantity=1, $alternatePlural=null, $emptySub=null)
    {
        $qtyText = $quantity;

        if (!is_null($emptySub) && $quantity < 1) {
            $qtyText = $emptySub;
            return $emptySub;
        }

        return sprintf("%s %s", $qtyText, $this->quantifyNoun($noun, $quantity, $alternatePlural));
    }

    /**
     * Retrieves past, present and future tense of a verb
     *
     * @param String $verb
     * @param String - date to be used as basis for verb tense, current date will be used if set to false
     * @return string Formatted string in past/present/future tense
     * @todo check for more rules, ask english teacher hahaha
     */
    public function verbTense($verb, $compareDate=false)
    {
        $originalString = $verb;
        if ($compareDate === false || strtotime($compareDate) < strtotime(date('Y-m-d H:i:s'))) {
            // add d to words ending in e
            $verb = preg_replace('/(\w*)(e)$/', '$0d', $verb);
            // change y to i and add ed
            $verb = preg_replace('/(\w*)y$/', '$1ied', $verb);

            if ($originalString == $verb) {
                // add ed to words ending in consonants
                $verb = preg_replace('/(\w*)([b-z&&[^eiou]]*)$/', '$0ed', $verb);
            }
        }

        return $verb;
    }

    /**
     * Formats words into a grammatically correct conjunction of the given array of words
     *
     * @param String $words - words to concatenate
     * @param String $conjunctive - word used to concatenate last word
     * @return string grammatically formatted conjunction of the input
     */
    public function conjunct($words, $conjunctive=null)
    {
        if (is_null($conjunctive)) {
            $conjunctive = 'and';
        }

        if (!is_array($words)) {
            throw new Exception('Invalid input. Make sure you input an array of words');
        }

        if (count($words) == 1) {
            return array_pop($words);  
        }

        $lastWord = array_pop($words);
        $joinedWords = implode(', ', $words);

        return sprintf("%s %s %s", $joinedWords, $conjunctive, $lastWord);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'site_utility_english_twig_extension';
    }
}