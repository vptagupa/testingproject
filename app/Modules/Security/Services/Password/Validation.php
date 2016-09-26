<?php 

namespace App\Modules\Security\Services\Password;

use App\Modules\Security\Models\Password\Password;

Class Validation extends Password {

    /**
     *  get Special Characters
     *
     * @return string
     */
    public function getEplchars() {
        return $this->getSplChars();
    }

    /**
     *  get Special Characters Status
     *
     * @return boolean
     */
	public function hasEplchars($password) {
        if ( $this->getSplcharStatus() )
        {
            $pattern = $this->getSplChars();
            return preg_match("/[".$pattern."]/",$password);
        }
        return true;
    }

    /**
     *  get Charatecter repition status
     *
     * @return boolean
     */
    public function isCharRepeted($password){
        if ( $this->getCharacterRepetitionStatus() )
        {
             $pattern = '/(\w)\1{'.$this->getMaxCharacterRepetition().',}/';
             return (preg_match($pattern,$password)  > 0);
        }
        return false;
    }

    /**
     *  get Digit Manadatory status
     *
     * @return boolean
     */
    public function isDigitMandatory($password){
       if ( $this->getDigitsStatus() )
       {
           $pattern = '/[0-9]/';
           return preg_match($pattern,$password);
       }
       return true;
    }

    /**
     *  get Upper case Letter mandatory status
     *
     * @return boolean
     */
    public function isUcaseMandatory($password){
     
        if ( $this->getUppercaseStatus() )
        {
            $pattern = '/[A-Z]/';
            return preg_match($pattern,$password);
        }
        return true;
    }

    /**
     *  get Lower case Letter mandatory status
     *
     * @return boolean
     */
    public function isLcaseMandatory($password){
        if ( $this->getLowercaseStatus()  )
        {
            $pattern = '/[a-z]/';
            return preg_match($pattern,$password);
        }
        return true;
    }

    /**
     *  get sequence values
     *
     * @return boolean
     */
    public function hasSequenceValues($password){
            $pattern = '/[a-z]|[0-9]/';
            return preg_match($pattern,$password);
    }

    /**
     *  get Mimimum and Maximum required status
     *
     * @return boolean
     */
    public function minMaxPassword($password){
          $MaxLength = $this->getMaxLength();
          $MinLength = $this->getMinLength();
          $password = strlen($password);
          if ( $password >= $MinLength && $password <= $MaxLength )
          {
              return true;
          }
          return false;
    }

    /**
     *  get password expiration status
     *
     * @return boolean
     */
    public function isPswdExpired($expiryDate) {
        if ($this->getExpiryDaysStatus()) {
            if (!trim($expiryDate)) {
                return true;
            }
            $status = date_diff(
                        date_create(date('Y-m-d')),
                        date_create($expiryDate)
                    )
                    ->format('%R%a');  
            return ($status > 1) ? false : true;
        }
        return false;
    }
}