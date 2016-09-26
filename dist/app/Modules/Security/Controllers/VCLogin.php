<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Users\User;
use Auth;
use Request;

Trait VCLogin {	

	public static function loginUsingVC()
	{	
		$user = new User;
		if($user->where('ConfirmNo',Request::get('Username'))->count() > 0) {
			return true;
		}
		return false;
	}

	public static function isVC() 
	{
		if (strtoupper(self::get()) == 'VC') {
			return true;
		}
		return false;
	}

	public static function getUser()
	{
		return getUserIDByVC(Request::get('Username'));
	}

	protected static function get()
	{
		return $vc = substr(Request::get('Username'),0,2);
	}

	/*copy this code to AuthenticateUsers*/
	protected function AuthenticateUsers()
	{
		//updated for confirmation code login
        if (VCLogin::isVC()) {
            if (VCLogin::loginUsingVC()) {
                if(Auth::loginUsingId(VCLogin::getUser())) {
                    return $this->handleUserWasAuthenticated($request, $throttles);    
                }
            }
        } else {
            $credentials = $this->getCredentials($request);
            if (Auth::attempt($credentials, $request->has('remember'))) {
                return $this->handleUserWasAuthenticated($request, $throttles);
            }
        }
	}
}