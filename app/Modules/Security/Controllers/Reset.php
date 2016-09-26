<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Users\User as UserModel;
use Auth;
use Request;
use Response;
use Mail;
use sysAuth;
use Sys;

class Reset extends Controller {


	public function index()
	{
		$isValid = $this->validateRequest();
		if ($isValid == 1) {
			return  view('auth.reset');
		}
		return view('errors.invalid_request',['error'=>$isValid]);
	}

	public function reset()
	{
		$this->initializer();
		$response = ['error' => true,'message' => 'Could not reset password.'];

		if ($this->isValidToken()) {
			$userID = $this->getUserID();
			if (Request::get('cpswd') == Request::get('npswd')) {
				if ($this->model->where('UserID',$userID)->count() > 0) {
					$sysAuth = $this->sysAuth->isValid(Request::get('npswd'));
					if (!$sysAuth['error']) {

						$expiredDate = $this->sysAuth->getExpiryDate();

						$this->model->where('UserID',$userID)
						->update([
							'password' => bcrypt(Request::get('npswd')),
							'PwdExpiryDate' => $expiredDate
						]);

						$post['UserID'] = $userID;
						$post['opassword'] = Request::get('npswd');
						$post['PwdExpiryDate'] = $expiredDate;

						//send email
						$this->sendEmailResetAccountInfo($post);

						SystemLog(
							'Security','Reset','reset',
							'reset',Request::all(),
							'Reset password',
							$userID
						);

						return [
								'error'=>false,
								'message'=>'Successfully reset password. Check your email for the account information. Please Wait for the page to redirect you to login page.'
							];
					}
					return $sysAuth;
				}
			}			
			$response = ['error' => false,'message' => 'Successfully Reset Password.'];
		}

		return $response;
	}

	public function pchangePswd() {
		return $this->changePswd();
	}

	public function changePswd()
	{	
		$url = 'changePswd?token='.Request::get('token');
		if (!$this->isValidToken()) {
			return 'Invalid token!';
		}
		if (strtolower(Request::get('p')) == 'a') {
			return view('auth.changePswdExpiration');
		}
		$this->initializer();
		$response = ['error' => true,'message' => 'New Password did not matched!'];
		$userID = decodeToken(Request::get('token'));
		if (Request::get('cpswd') == Request::get('npswd')) {
			if ($this->model->where('UserID',$userID)->count() > 0) {
				$credentials = ['UserID'=>$userID,'password'=>Request::get('curpswd')];
				if (Auth::attempt($credentials,false)) {
					if (Request::get('curpswd') != Request::get('cpswd')) {
						$sysAuth = $this->sysAuth->isValid(Request::get('npswd'));
						if (!$sysAuth['error']) {
							updateLoginDate();
							$this->model->where('UserID',$userID)
							->update([
								'password' => bcrypt(Request::get('npswd')),
								'PwdExpiryDate' => $this->sysAuth->getExpiryDate()
							]);
							SystemLog(
								'Security','Reset','pswdChangeForExpiration',
								'changePswd',Request::all(),
								'Change password due to pswd expiration'
							);
							return 
								redirect($url.'&p=a')
									->withErrors([
										'error'=>false,
										'message'=>'Successfully change password. Wait for the page to redirect you to home page.'
									]);
						}
						$response = $sysAuth;
					} else {
						$response = ['error' => true,'message' => 'Please do not repeat your current password.'];
					}
				} else {
					$response = ['error' => true,'message' => 'Invalid Old Password.'];
				}
			}
		}
		return redirect($url.'&p=a')->withErrors($response);
	}

	public function sendEmailReset()
	{
		$this->initializer();
		$email = trimmed(Request::get('email'));
		$post['email'] = $email;
		$post['token'] = encodeToken(getUserIDByEmail($email).addDateDays(date('Y-m-d'),1,'Y-m-d'));
		$post['UserName'] = $this->model->select('UserName')->where('UserID',getUserIDByEmail($email))->pluck('UserName');
		$response = ['error' => true,'message' => 'Could not find email address.'];
		if ($this->model->where('Email',$email)->count() > 0) {
			ini_set('max_execution_time', 3600);
			Mail::send('emails.reset', $post, function ($message) use ($post) {
				$message->from('mailtesterx@gmail.com',Sys::$title);
	        	$message->to(trim(getObjectValue($post,'email')))->subject('Reset password');
			});
			$response = ['error' => false,'message' => 'Please check your email for the reset details.'];
		}
		return $response;
	}

	public function sendEmailResetAccountInfo($post)
	{
		$this->initializer();
		$email =  getUserEmailByUserID($this->getUserID());
		$post['email'] = $email;
		$post['UserName'] = $this->model->select('UserName')->where('UserID',$this->getUserID())->pluck('UserName');
		$response = ['error' => true,'message' => 'Could not find email address.'];
		if ($this->model->where('Email',$email)->count() > 0) {
			ini_set('max_execution_time', 3600);
			Mail::send('emails.account_reset_info', $post, function ($message) use ($post) {
				$message->from('mailtesterx@gmail.com',Sys::$title);
	        	$message->to(trim(getObjectValue($post,'email')))->subject(Sys::$title.' Account');
			});
		}
	}

	protected function validateRequest()
	{
		if (!$this->isValidToken()) {
			return "Invalid Reset!";
		}

		$date = substr(decodeToken(Request::get('token')),-10);

		if($this->isExpiredToken($date)) {
			return "This link is already expired!";
		} 

		return true;
	}

	protected function getUserID()
	{
		$userID = decodeToken(Request::get('token'));
		return substr($userID, 0,strlen($userID) - 10);
	}

	
	protected function isValidToken()
	{
		if (Request::get('token')) {
			if (count(explode('|',base64_decode(Request::get('token')))) > 1) {
				return true;
			}
		}
		return false;
	}

	protected function isExpiredToken($date) {
		$status = date_diff(
            date_create(date('Y-m-d')),
            date_create($date)
        )
        ->format('%R%a'); 
        return ((int)$status >= 1) ? false : true;
	}

	private function initializer()
	{
		$this->model = new UserModel;
		$this->sysAuth = new sysAuth;
	}

}