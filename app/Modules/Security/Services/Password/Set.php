<?php 

namespace App\Modules\Security\Services\Password;

use App\Modules\Security\Services\Password\Validation;


Class Set extends Validation{

    /**
     * Validated password from the configurated table
     *
     * @param string $password
     * @return array
     */
	public function isValid($password){
        
        $error = false;$data = [];$msg = 'Password Validated';
        if ( !$this->minMaxPassword($password) ){
            $error = true;
            $data[] = "Invalid Password Length. Minimum is {$this->getMinLength()} and maximumun with {$this->getMaxLength()} characters.";
        }
        if ( !$this->hasEplchars($password) ){
            $error = true;
            $data[] = "The password must have a special character(s) e.g. {$this->getEplchars()}.";
        }

        if ( $this->isCharRepeted($password) ){
            $error = true;
            $data[] = "Password character repetition must not greater than to {$this->getMaxCharacterRepetition()} repeated characters";
        }

        if ( !$this->isDigitMandatory($password) ){
            $error = true;
            $data[] = "The password must contain at least a number";
        }

        if ( !$this->isUcaseMandatory($password) ){
            $error = true;
            $data[] = "The password must contain at least 1 capital letter";
        }

        if ( !$this->isLcaseMandatory($password) ){
            $error = true;
            $data[] = "The password must contain at least 1 small letter";
        }

        if ( !$this->hasSequenceValues($password) ){
            $error = true;
            $data[] = "Password not have sequence values from 0-9 or a-z";
        }
        return ['error'=>$error,'message'=> !$error ? $msg : $data];
    }
}