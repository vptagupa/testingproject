<?php 

namespace App\Modules\Security\Models\Password;
use illuminate\Database\Eloquent\Model;

class Password extends Model
{
    
    protected $table='password_config';
    protected $primaryKey ='index_id';

    protected $fillable  = array(
            'name',
            'value',
            'datatype'
        );

    public $timestamps = false;

    public function isEmailPassword(){
        return $this->find('16')->value;
    }

    public function getExpiryCheck(){
        return $this->find('13')->value;
    }
    
    public function getDefaultPassword(){
        return  $this->find('12')->value;
    }
    
    public function getExpiryDate(){
        $now = new \DateTime();
        $now->add(new \DateInterval('P'.$this->getExpiryDays().'D'));
        return $now->format('Y-m-d');
    }

    public function getExpiryDays(){
        return $this->find('10')->value;
    }

    public function getExpiryDaysStatus(){
       return $this->find('15')->value;
    }

    public function getMaxInvalidEntry(){
        return $this->find('14')->value;
    }
    
    public function getMinLength(){
        return $this->find('9')->value;
    }
    
    public function getMaxLength(){
        return $this->find('8')->value;
    }
    
    public function getLowercaseStatus(){
        return $this->find('7')->value;
    }
    
    public function getUppercaseStatus(){
        return $this->find('6')->value;
    }
    
    public function getSplcharStatus(){
        return $this->find('1')->value;
    }
    
    public function getDigitsStatus(){
        return $this->find('5')->value;
    }
    
    public function getPwdHistory(){
        return $this->find('11')->value;
    }
    
    public function getCharacterRepetitionStatus(){
        return $this->find('3')->value;
    }
    
    public function getMaxCharacterRepetition(){
        return $this->find('4')->value;
    }
    
    public function getSplChars(){
        return $this->find('2')->value;
    }
    
    public function updateConfig($id, $val){
        $query = "UPDATE aml_password SET Value = '" . $val . "' WHERE ConfigID = " . $id;
        return $this->db->query($query);
    }
    
}