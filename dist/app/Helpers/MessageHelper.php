<?php
	
	 /**
     * get Permission Denied
     *
     * @return string
     */
	function permissionDenied() {
		return  ['error'=>true,'message'=>'Permission Denied!'];
	}

	 /**
     * get No Event Selected
     *
     * @return string
     */
	function noEvent() {
		return ['error'=>true,'message'=>'No Event Selected'];
	}

	/**
     * set Success response
     *
     * @return string
     */
	function success($data = []) {
		return array_merge(['error' => false],$data);
	}

	/**
     * set Error response
     *
     * @return string
     */
	function error($data = []) {
		return array_merge(['error' => true],$data);
	}

	/**
     * get Success Save
     *
     * @return string
     */
	function successSave($data = []) {
		$msg = ['error'=>false,'message'=>'<b>Success!</b>. Saved!'];
		if (count($data) > 0) {
			$msg  = array_merge($msg,$data);
		}
		return $msg;
	}

	/**
     * get Error save
     *
     * @return string
     */
	function errorSave() {
		return ['error'=>true,'message'=>'There was an error while saving.'];
	}

	/**
     * get Success Deleted
     *
     * @return string
     */
	function successDelete() {
		return ['error'=>false,'message'=>'Successfully deleted record.'];
	}

	/**
     * get Error Deleted
     *
     * @return string
     */
	function errorDelete() {
		return ['error'=>true,'message'=>'Could not delete record.'];
	}

	/**
     * get Success Confirmed
     *
     * @return string
     */
	function successConfirm() {
		return ['error'=>false,'message'=>'<b>Success!</b> Confirmed account!. <br> You can now proceed to login.'];
	}

	/**
     * get Already Confirm Code
     *
     * @return string
     */
	function alreadyConfirmCode() {
		return ['error'=>true,'message'=>'This code is already confirmed!'];
	}

	/**
     * get Error Code Confirmation
     *
     * @return string
     */
	function errorConfirm() {
		return ['error'=>true,'message'=>'Invalid code.'];
	}

?>