<?php
/**
* Author: Victor Tagupa Jr.
* Attachment Validation and more
*/
namespace App\Config;

use App\Config\Settings;
/**
 * This extend settings safely using abstact
 *
 */
Class Validation extends Settings implements Validate {
	use AttachmentValidation;

	public function validate($file) {
		return $this->attachment($file);
	}
}

/**
 * interface validate
 *
 * @return function
 */

interface Validate {
	public function validate($file);
}

/**
 * Validate Attachment
 *
 * @param string $file
 * @return array
 */
trait AttachmentValidation {


 	public function attachment($file) 
	{
		$this->errorMessage = [];
		
		if (!isset($file)) {
			$this->isValid = false;
			$this->errorMessage[] = "File don't exist";
			return $this;
		}
		
		$this->isValid = true;

		$this->path = $this->getObjectValue($file,'Attachment');

		$this->ext = strtolower($this->getObjectValue($file,'FileExtension'));

		$this->size = $this->getObjectValue($file,'FileSize');

		$this->filename = $this->getObjectValue($file,'FileName');

		if (!file_exists($this->path)) {
			$this->isValid = true;
			return $this;
		}

		if (!trim($this->ext)) {
			$this->isValid = true;
			$this->errorMessage[] = "Don't have File Extension!";
		}

		if (!trim($this->filename)) {
			$this->isValid = true;
			$this->errorMessage[] = "Don't have Filename!";
		}
		
		if (!empty(getObjectValue($file,'allowed_extenstion'))) {
			$this->self_allowed_extenstion = getObjectValue($file,'allowed_extenstion');
		} else {
			$this->self_allowed_extenstion = $this->allowed_extenstion;
		}

		if (getObjectValue($file,'escape_extension')) {
			$this->escape_extension = getObjectValue($file,'escape_extension');
		}

		if (!$this->escape_extension) {
			if (!in_array($this->ext,$this->self_allowed_extenstion)) {
		  		$this->isValid = false;
		  		$this->errorMessage[] = "File Type is not allowed. Available file types (".arrayToStr($this->self_allowed_extenstion)."). Given is ".$this->ext.' format.';
		  	}
		} else {
			if (!in_array($this->ext,$this->self_allowed_extenstion)) {
		  		$this->isValid = false;
		  		$this->errorMessage[] = "File Type is not allowed. Available file types (".arrayToStr($this->self_allowed_extenstion)."). Given is ".$this->ext.' format.';
		  	}
		}
	  	
	  	if ($this->size > $this->allowed_max_size) {
	  		$this->isValid = false;
	  		$this->errorMessage[] = "File Size exceeded the maximum of ".$this->allowed_max_size.".";
	  	}

	  	if (preg_match("/[".$this->not_allowed_filename_char."]/",$this->filename)) {
	  		$this->isValid = false;
	  		$this->errorMessage[] = "Filename must not include special characters such as". $this->not_allowed_filename_char.".";
	  	}

	  	return $this;
	}	

	public function passed()
	{
		return $this->isValid;
	}

	public function getErrorMessage()
	{
		return $this->errorMessage;
	}

	public function getFileExtension()
	{
		return $this->ext;
	}

	public function getFileName()
	{
		return $this->filename;
	}

	public function getCompleteFile()
	{
		return $this->filename.'.'.$this->ext;
	}

	public function getRealPath()
	{
		return $this->path;
	}

	public function getShuffleFileName($filename) 
	{
		return str_shuffle(md5($filename));
	}

	public function getAllowedExtension()
	{
		return $this->allowed_extenstion;
	}

	/**
     *  get array field value
     *
     * @param array $source, string $field, bollean $isTrimmed default false
     * @var string
     */
	public function getObjectValue($source,$field,$isTrimmed = false)
	{	
		$value = '';
		if ( is_object($source) ) {
			$value =  isset($source->$field) ? $source->$field : '';
		}
		elseif ( is_array($source) ) {
			$value =  isset($source[$field]) ? $source[$field] : '';
		}
		else {
			$value =  isset($source->$field) ? $source->$field : '';
		}
		return $isTrimmed ? trimmed($value) : $value;
	}


}