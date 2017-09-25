<?php

namespace RomanAPI;

class IntegerConversion implements IntegerConversionInterface
{

  /**
   * Convert the given number in the url to Roman Numeral.
   *
   * @param   $integer  
   * @return  $result
   */
  public function toRomanNumerals($integer)
  {
    $romanDefaults = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1);
    $result = '';
    while($integer > 0)
    {
      foreach($romanDefaults as $romanNumeral=>$arabic)
      {
        if($integer >= $arabic)
        {
            $integer -= $arabic;
            $result .= $romanNumeral;
            break;
        }
      }
    }
    return $result;
  }

 /**
   * Check whether the given number in the url is valid.
   *
   * @param   $integer  
   * @return  true or false.
   */
 public function isValid($integer)
 {
 		$integer = intval($integer);
 		if ($integer > 0 && $integer < 4000) {
 			return true;
 		}

 		return false;
  }
}