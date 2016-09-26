<?php
	/**
     *  get error message
     *
     * @param array/string $errors
     * @return string
     */
	function getErrorMessages($errors)
	{
		$li="";
		$message='';
		if ( count($errors) > 1 )
		{
			foreach($errors as $row)
			{
				foreach($row as $key => $message)
				{
					$li.="<li>{$message}</li>";
				}
				
			}
			$message="<ul>{$li}</ul>";
		}
		else
		{
			foreach($errors as $key => $msg) { $message=$msg[0]; }
		}
		
		return $message;
	}

	/**
     *  get Model MEssage
     *
     * @param array $errors, string $message default null
     * @return array
     */
	function getModelMessage($error,$message=null)
	{
		$message=$message ? $message : '';
		
		if ( !$error )
		{
			return [ 'error' => $error,'message' => $message ];
		}

		return [ 'error' => $error,'message' => $message ];
	}

	/**
     *  get Action Message
     *
     * @param string $error, string $message default empty, string $action default save
     * @return string
     */
	function getActionMessage($error,$message='',$action='save')
	{
		switch (strtolower($action) ) {
			case 'delete':
				$action="Deleted!";
				break;
			case 'update':
				$action="Update!";
				break;
			default:
				$action="Save!";
				break;
		}
		if ( $error == false || $error == 0 || $error == '' )
		{
			$message = "Successfully ".$action;
		}
		else
		{
			$message =  ( $message == '' ) ? 'Could not '.($action == 'Deleted!' ? 'Delete' : $action) :  $message;
		}
		return $message;
	}

	/**
     *  check if field exist in an object
     *
     * @param string $field, integer $key, array $objects
     * @return boolean
     */
	function InObject($field,$key,$objects)
	{
		foreach($objects as $row)
		{

			if ( $row->$field == $key )
			{
				return true;
			}
		}
		return false;
	}

	/**
     *  check field value if equal to given $data
     *
     * @param array $data, string $field, string $valuem bollea $loop default true
     * @var boolean
     */
	function IsEqualTo($data,$field,$value,$loop = true)
	{
		if ( $loop )
		{
			foreach($data as $row)
			{
				if ( (is_object($data)) && (isset($row->$field) && ($row->$field == $value)) )
				{
					return true;
				}
				elseif ( (is_array($data)) && (isset($row[$field]) && $row[$field] == $value) )
				{
					return true;
				}
			}
		}
		else
		{
			if ( (is_object($data)) && (isset($data->$field) && ($data->$field == $value)) )
			{
				return true;
			}
			elseif ( (is_array($data)) && (isset($data[$field]) && $data[$field] == $value) )
			{
				return true;
			}
		}
		
		return false;
	}

	/**
     *  trimmed single qoute character to empty
     *
     * @param string $value
     * @return string
     */
	function trimmed($value)
	{  
	   $result = str_replace(array("'"),"",trim($value));
       $result = utf8_decode(utf8_encode($result));
		return $result;
	}

	/**
     *  cut down string from a given length add more as extension
     *
     * @param string $value, integer $length default 500, string $more default empty
     * @var string
     */
	function trimLength($value,$length = 500,$more = '')
	{
		$ret = substr($value,0,$length);
		return strlen($value) <= $length ? $ret : $ret.$more;
	}

	/**
     *  cut down string from a given length
     *
     * @param string $value, integer $length default 500, string $more default empty
     * @var string
     */
	function trimStr($value,$length = 30)
	{
		$str = '';$c = 1;
		for($i = 0;$i<strlen($value);$i++) {
			if ($c == $length) {
				$str.= substr($value,$i,1).'<br>';
				$c = 0;
			} else {
				$str.= substr($value,$i,1);
			}
			$c++;
		}
		return $str;
	}

	/**
     *  remove comma in the given value
     *
     * @param string $value
     * @return decimal
     */
	function decimal($value)
	{
		return str_replace(array(","),"",trim($value));
	}

	/**
     *  get array field value
     *
     * @param array $source, string $field, bollean $isTrimmed default false
     * @var string
     */
	function getObjectValue($source,$field,$isTrimmed = false)
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

	/**
     * get array field value, return $return if $field not exist or empty
     *
     * @param array $source, string $field, string $return
     * @return string
     */
	function getObjectValueWithReturn($source,$field,$return)
	{	
		if ( is_object($source) )
		{
			if( isset($source->$field) && $source->$field != '')
			{
				return $source->$field;
			}
		}
		elseif ( is_array($source) )
		{
			if( isset($source[$field]) && $source[$field] != '')
			{
				return $source[$field]; 
			}
		}
		
		return $return;
	}

	/**
     * get first letter of every word
     *
     * @param string $words
     * @return string
     */
	function getFirstLetter($words,$length = 1)
	{
		$words=explode(' ',$words);
		$letters='';
		foreach($words as $word)
		{
			$letters.=strtoupper(substr($word,0,$length));
		}

		return $letters;
	}

	/**
     *  convert array values to different format of every word
     *
     * @param array $data, character $formatTo default '-', character $fieldFormat default '_'
     * @return array
     */
	function convertArrayTo($data,$formatTo = '-',$fieldFormat = '_')
	{
		$ret = array();
		$cformat = '';
		foreach($data as $field)
		{
			switch (strtoupper($formatTo)) {
				case 'UCFIRST':
					$format   = explode($fieldFormat,$field);
					$cformat  = $field;
					if ( count($format) > 1 )
					{
						$cformat = '';
						foreach($format as $f){
							$cformat.=ucfirst(strtolower($f));
						} 
					}
					$ret[] = $cformat;
					break;
				default:
					$ret[] = str_replace($fieldFormat, $formatTo, $field);
					break;
			}
		}
		return $ret;
	}

	/**
     *  convert string to different format of every word
     *
     * @param string $string, character $formatTo default '-', character $fieldFormat default '_'
     * @return string
     */
	function convertStrTo($string,$formatTo = '-',$fieldFormat = '_')
	{
		$ret = '';
		$cformat = '';
		
		switch (strtoupper($formatTo)) {
			case 'UCFIRST':
				$format   = explode($fieldFormat,$string);
				$cformat  = $string;
				if ( count($format) > 1 )
				{
					$cformat = '';
					foreach($format as $f){
						$cformat.=ucfirst(strtolower($f));
					} 
				}
				$ret = $cformat;
				break;
			default:
				$ret = str_replace($fieldFormat, $formatTo, $string);
				break;
		}
		return $ret;
	}

	/**
     *  get controller name
     *
     * @return string
     */
	function getControllerName()
	{
		$url = config('app.host_type').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$split = explode('/',str_replace(url().'/', '', $url));
		return isset($split[count($split)-1]) ? $split[count($split)-1] : '';
	}

	/**
     *  get url segment
     *
     * @return string
     */
	function getUrlSegment()
	{
		$url = config('app.host_type').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$split = explode('/',str_replace(url().'/', '', $url));
		$segment = '';
		foreach($split as $key => $value){
			$segment.= $value.'/';
		}
		return substr($segment,0,-1);
	}

	/**
     *  encode string to base64
     *
     * @param string $value
     * @return encoded string
     */
	function encode($value)
	{
		return base64_encode($value);
	}

	/**
     * decode string to base64
     *
     * @param string $value
     * @return string
     */
	function decode($value)
	{
		return base64_decode($value);
	}

	/**
     * get Session field
     *
     * @param string $key
     * @return string
     */
	function getSessionData($key)
	{
		return Session::get($key);
	}

	/**
     * set session key value
     *
     * @param string $key,string $data
     * @var session
     */
	function putSessionData($key,$data)
	{
		return Session::put($key,$data);
	}

	/**
     *  get file size
     *
     * @param number $bytes
     * @return string
     */
	function filesize_formatted($bytes)
	{
	    if ($bytes >= 1073741824) {
	        return number_format($bytes / 1073741824, 2) . ' GB';
	    } elseif ($bytes >= 1048576) {
	        return number_format($bytes / 1048576, 2) . ' MB';
	    } elseif ($bytes >= 1024) {
	        return number_format($bytes / 1024, 2) . ' KB';
	    } elseif ($bytes > 1) {
	        return $bytes . ' bytes';
	    } elseif ($bytes == 1) {
	        return '1 byte';
	    } else {
	        return '0 bytes';
	    }
	}

	/**
     *  print error in array and html pre format
     *
     * @param string $input
     * @return string
     */
  	function error_print($input) {
     	echo '<pre>';
      	print_r($input);
     	echo "</pre>";
  	}

  	/**
     *  remove non-numeric character
     *
     * @param string $value
     * @return number
     */
  	function numberonly($value) {
  		return preg_replace("/['\"\' '\aA-zZ]/", '', $value);
  	}

  	/**
     * remove number in a string
     *
     * @param string $value
     * @return string
     */
  	function stringonly($value) {
  		return preg_replace("/(['\"\])([0-9])/", '', $value);
  	}

  	/**
     *  convert every word first letter to upper case
     *
     * @param string $words
     * @return string
     */
  	function ucFirstWord($words) {
  		$w = explode(' ',$words);$string = '';
  		for($i = 0;$i<count($w);$i++) {
  			$string .= ucfirst(strtolower($w[$i]));
		}
		return $string;
  	}

  	/**
     * get file info such as size,file type, file extension, filename and file
     *
     * @param file $file, bollean $isArray default false, integer $index default 0
     * @return array
     */
  	function getFileInfo($file,$isArray = false,$index = 0)
  	{	
  		set_time_limit(0);
        ini_set('memory_limit', '-1');
        
  		if ($isArray) {
  			$attachment = $file['tmp_name'][$index];
			$file = $file['name'][$index];
  		} else {
  			$attachment = $file['tmp_name'];
			$file = $file['name'];
  		}
  		
  		$data = [
  			'FileName' => $file,
  			'FileExtension' => pathinfo($file, PATHINFO_EXTENSION),
  			'Attachment' => $attachment,
  			'FileType' => mime_content_type($attachment),
  			'FileSize' => filesize($attachment)
  		];

  		set_time_limit(0);
        ini_set('memory_limit', '128M');
        return $data;
  	}

  	/**
     * insert created info field
     *
     * @param array $data
     * @return array
     */
  	function assertCreated($data,$date = '')
	{		
		$data['created_date'] = !empty($date) ? $date : systemDate();
		$data['created_by'] = '';//getUserID();

		return $data;
	}

	/**
     * insert modified info field
     *
     * @param array $data
     * @return array
     */
	function assertModified($data)
	{		
		$data['modified_date'] = systemDate();
		$data['modified_by'] = '';//getUserID();

		return $data;
	}

	/**
     * insert deleted info field
     *
     * @param array $data
     * @return array
     */
	function assertDeleted($data)
	{		
		$data['deleted_date'] = systemDate();
		$data['deleted_by'] = getUserID();

		return $data;
	}

	/**
     * insert field
     *
     * @param array/string $data
     * @return array
     */
	function assertFields($fields,$data)
	{		
		if (is_array($fields)) {
			$data = array_merge($fields,$data);
			return $data;
		}

		return $data;
	}

	/**
     * check if field exist in data array
     *
     * @param string param by ref $field, array $data
     * @return boolean
     */
	function hasRef(&$ref,$data) 
	{
		if (getObjectValue($data,$ref)) {
			$ref = getObjectValue($data,$ref);
			return true;
		}
		return false;
	}

	/**
     * get data array in index 0
     *
     * @param array $data
     * @return array
     */
	function getRawData($data)
	{
		if (isset($data[0])) {
			return $data[0];
		}
		return $data;
	}

	/**
     *  set date to different format
     *
	 * @param date/dateTime $date, string $givenFormatDate, string $toDateFormat
     * @return date/dateTime
     */
  	function setDateFormat($date,$givenFormatDate,$toDateFormat) 
  	{
  		switch (strtolower($givenFormatDate)) {
  			case 'mm/dd/yyyy':
  					$date = explode(' ',$date)[0];
  					switch ($toDateFormat) {
  						case 'mm/dd/yyyy':
  							$date = $date;
  							break;
  						case 'yyyy-mm-dd':
  							$date = explode('/',$date);
  							$date = getObjectValue($date,2).'-'.getObjectValue($date,0).'-'.getObjectValue($date,1);
  							break;
  						default:
  							break;
  					}
  				break;
  			case 'yyyy-mm-dd':
  					$date = explode(' ',$date)[0];
  					switch (strtolower($toDateFormat)) {
  						case 'mm/dd/yyyy':
  							$date = explode('-',$date);
  							$date = getObjectValue($date,1).'/'.getObjectValue($date,2).'/'.getObjectValue($date,0);
  							break;
  						default:
  							break;
  					}
  				break;
  			default:
  				break;
  		}
  		if ($date == '//' || $date == '01/01/1900') {
  			return '';
  		}
  		return $date;
  	}

  	/**
     * convert date to system date
     *
     * @param date/dateTime $date, string $givenFormat
     * @return date
     */
	function toSystemDateTime($date,$givenFormat = 'mm/dd/yyyy')
	{
		return setDateFormat($date,$givenFormat,'yyyy-mm-dd');
	}

	/**
     *  convert date to front end/display system date
     *
     * @param date/dateTime $date, string $givenFormat
     * @return date
     */
	function toSystemFrontDateTime($date,$givenFormat = 'yyyy-mm-dd')
	{
		return setDateFormat($date,$givenFormat,'mm/dd/yyyy');
	}

	/**
     * convert to database date format
     *
     * @param dateTime $date
     * @return dateTime
     */
	function toDBDate($date) 
	{
		return DB::raw("STR_TO_DATE('".$date."','%Y-%m-%d %h:%i %p')");
	}

	/**
     * decode Json
     * parameter by reference
     * @param json $data
     * @return array
     */
	function jsonToArray(&$data) 
	{
		return $data = json_decode('['.$data.']',true);
	}

	/**
     * convert array to string represenation
     * parameter by reference
     * @param aray $data
     * @return string
     */
	function arrayToStr(&$data) 
	{
		$str = '';
		foreach($data as $row) {
			$str.= $row.',';
		}

		return substr($str,0,-1);
	}

	/**
     * convert array to string represenation
     * parameter by reference
     * @param aray $data
     * @return string
     */
	function strToArray(&$data) 
	{
		return explode(',',$data);
	}

	/**
     * Put To File
     * parameter by reference
     * @param aray $data
     * @return string
     */
	function toStorage($path,$file) 
	{
		Storage::disk('local')->put($path,file_get_contents($file));
	}

	/**
     * Get File in the storage
     * parameter by reference
     * @param string $path
     * @return string
     */
	function getFileStorage($path) 
	{	
		return
		Storage::disk('local')->get($path);
	}


	/**
     * Create and Put File
     * @param string $file
     * @param string $path
     * @return string
     */
	function putStorage($path,$contents) 
	{
		Storage::disk('local')->put($path,$contents);
	}

	/**
     * remove array field/index
     * parameter by reference
     * @param aray $data, $fields
     * @return string
     */
	function unsetFields($fields,$data) 
	{
		if (is_array($fields)) {
			foreach($fields as $k => $f) {
				unset($data[$f]);
			}
			return $data;
		}

		unset($data[$fields]);
		return $data;
	}

	/**
     * add days
     * @param $date, $days,$format
     * @return date
     */
	function addDateDays($date,$days,$format) 
  	{
  		$now = new \DateTime($date);
  		$now->add(new \DateInterval('P'.$days.'D'));
  		return $now->format($format);
  	}

  	/**
     * Set Date
     * @param $date,$format
     * @return date
     */
  	function setDate($date,$format) 
  	{
  		$now = new \DateTime($date);
  		return $now->format($format);
  	}

  	/**
     * Get Difference between two dates
     * @param $dateFrom datetime,$dateTo datetime
     * @return intenger
     */
  	
  	function DateDiff($dateFrom,$dateTo) 
  	{
  		return 
  		date_diff(
            date_create($dateFrom),
            date_create($dateTo)
        )
        ->format('%R%a'); 
  	}


  	/**
     * Get Age
     * @param $BirthDate date
     * @return intenger
     */
  	function getAge($BirthDate) 
  	{
  		return 
  		floor((time() - strtotime($BirthDate)) / 31556926);

  	}
?>