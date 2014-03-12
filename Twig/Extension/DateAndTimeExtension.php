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

use \DateTime;
use \Exception;
use \Twig_Extension;

/**
* Handles date and time related data management
*
* @author  Yan Barreta <augustianne.barreta@gmail.com>
* @version dated: February 3, 2011 11:19:26
*/
class DateAndTimeExtension extends Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'countdown' => new \Twig_Function_Method($this, 'countdown')
        );
    }

    /**
     * Calculates time left
     *
     * @param DateTime
     * @param String format of countdown result
     * @return string
     */
    public function countdown(DateTime $timestamp, $period=false)
    {
        $now = new DateTime();
        $diff = $now->diff($timestamp);
        
        if ($period === false) {
            $label = '';

            if ($diff->y > 0) {
                $label =  (1 == $diff->y) ? $diff->y.' year' : $diff->y.' years';
            } elseif ($diff->m > 0) {
                $label = (1 == $diff->m) ? $diff->m.' month' : $diff->m.' months';
            } else {
                $days = $diff->d;
                $weeks = floor($days / 7);
                if ($weeks > 0) {
                    $label = (1 == $weeks) ? $weeks.' week' : $weeks.' weeks';
                }
                elseif ($days > 0) {
                    $label = (1 == $days) ? $days.' day' : $days.' days';
                }
                elseif ($diff->h > 0) {
                    $label = (1 == $diff->h) ? $diff->h.' hour' : $diff->h.' hours';
                }
                elseif ($diff->i > 0) {
                    $label = (1 == $diff->i) ? $diff->i.' minute' : $diff->i.' minutes';
                }
                else {
                    $label = (1 == $diff->s) ? $diff->s.' second' : $diff->s.' seconds';
                }   
            }
        
            return $label;
        }

        try {
            return $diff->$period;
        }
        catch (Exception $e) {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'site_utility_date_and_time_extension';
    }
}