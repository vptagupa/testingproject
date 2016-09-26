<?php
	/**
     * Evaluate if the is login
     *
     * @url redirect url
     */
	function hasAuthenticated() {
	   
        $check = Auth::check();             
		if(!$check) {
		   
    		redirect('auth/login');
            die();
		}
	}

	/**
     * get Login User Expiry Date
     *
     * @return integer
     */
	function getUserExpiryDate() {
		hasAuthenticated();
		return Auth::user()->PwdExpiryDate;
	}

	/**
     * get Login User Full Name
     *
     * @return string
     */
	function getUserFullName() {	
		hasAuthenticated();
		return Auth::user()->UserName;
	}

	/**
     * get Login User Full Name
     *
     * @return string
     */
	function getUserFullName2($key) {	
		return userModel()->where('ID',$key)->select('UserName')->pluck('UserName');
	}

	/**
     * get Login User Name
     *
     * @return string
     */
	function getUserName() {	
		hasAuthenticated();        
		return Auth::user()->usre_id;
	}

	/**
     * get Login User ID
     *
     * @return integer
     */
	function getUserID() {	
		hasAuthenticated();
		return Auth::user()->id;
	}

	/**
     * get Login User Group ID
     *
     * @return integer
     */
	function getUserGroupID() {	
		hasAuthenticated();
		return Auth::user()->group_id;
	}

	/**
     * get Login User Photo
     *
     * @return blob
     */
	function getProfilePic() {
		hasAuthenticated();
		return Auth::user()->photo;
	}

	/**
     * get encoded Login User ID
     *
     * @return bcrypt
     */
	function getHashUserID() {
		hasAuthenticated();
		return md5(Auth::user()->id);
	}

	/**
     * get Login User Email
     *
     * @return string
     */
	function getUserEmail() {
		hasAuthenticated();
		return Auth::user()->email;
	}

	/**
     * get Login User Branch ID
     *
     * @return integer
     */
	function getUserBranchID() {
		hasAuthenticated();
		return;
	}

	/**
     * get Login User Department ID
     *
     * @return integer
     */
	function getUserDepartmentID() {
		hasAuthenticated();
		return Auth::user()->department_id;
	}

	/**
     * get Login User Deparment
     *
     * @return string
     */
	function getUserDepartment() {
		return
		DB::table('department')
			->select('name')
			->where(['id'=>getUserDepartmentID()])
			->limit(1)->pluck('name');
	}

	/**
     * get Login User Group Code
     *
     * @return string
     */
	function getUserGroupCode() {
		return
		DB::table('user_group')
			->select('code')
			->where(['id'=>getUserGroupID()])
			->limit(1)->pluck('code');
	}

	/**
     * get  Group iID
     *
     * @return interger
     */
	function getGroupID($code) {	
		return
		DB::table('user_group')
			->select('id')
			->where(['code'=>$code])
			->limit(1)->pluck('id');
	}

	/**
     * get Login User Group Code via User ID
     *
     * @param string $user
     * @return string
     */
	function getGroupCodeByUserID($user) {
		return
			DB::table(userTable().' as u')
				->select('code')
				->LeftJoin('user_group as g',
					'g.id','=','u.group_id'
				)
				->where('u.id',$user)
				->limit(1)
				->pluck('code');
	}

	/**
     * Is Login User Group Custom?
     *
     * @param string $user
     * @return boolean
     */
	function isUserGroupCustom($user) {
		return (strtolower(getGroupCodeByUserID($user)) == 'custom');
	}

	/**
     * get Login User Position Code
     *
     * @return string
     */
	function getUserPositionCode() {
		return
			DB::table(userTable().' as u')
				->select('PositionCode')
				->LeftJoin('kt_position as p',
					'p.PositionID','=','u.PositionID'
				)
				->where('UserID',getUserName())
				->limit(1)
				->pluck('PositionCode');
	}

	/**
     * get Login User Position
     *
     * @return string
     */
	function getUserPosition() {
		return
			DB::table(userTable().' as u')
				->select('PositionTitle')
				->LeftJoin('kt_position as p',
					'p.PositionID','=','u.PositionID'
				)
				->where('UserID',getUserName())
				->limit(1)
				->pluck('PositionTitle');
	}

	/**
     * determine if the Current Login is administrator account
     *
     * @return boolean
     */
	function isUserLoginAdmin() {
		return (getUserGroupID() == Sys::$administratorID);
	}

	/**
     * Update Last Login Date
     *
     */
	function updateLoginDate() {
		DB::statement("update ".userTable()." set LastLoginDate='".systemDate()."' where UserID='".getUserName()."'");
	}

	/**
     * get Login User ID By Email
     *
     * @return string
     */
	function getUserIDByEmail($email) {
		return userModel()->select('user_id')->where('Email',$email)->pluck('user_id');
	}

	/**
     * get Login Email By User ID
     *
     * @return string
     */
	function getUserEmailByUserID($userid) {
		return userModel()->select('email')->where('user_id',$userid)->pluck('email');
	}

	

?>