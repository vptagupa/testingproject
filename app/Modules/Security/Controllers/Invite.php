<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Users\User as UserModel;
use App\Modules\Security\Models\Users\InviteLog;
use Auth;
use Request;
use Response;
use Mail;
use sysAuth;
use Sys;

class Invite extends Controller {


	public function index()
	{
		$isValid = $this->validateRequest();
		if ($isValid == 1) {
			return  view('auth.invite');
		}
		return view('errors.invalid_request',['error'=>$isValid]);
	}

	public function create() {

		$this->initializer();

		$response = ['error' => true,'message' => 'Invalid Request.'];

		//check if the request is valid/expired/invalid
		if ($this->validateRequest() == '1') {

			$userID = $this->getUserID();

			$isValidUsername = $this->isValidUsername(Request::get('username'));

			//check if the username is valid and not existed
			if ($isValidUsername['error']) {
				return $isValidUsername ;
			}
			
			//require the two request password must be the same
			if (Request::get('password') == Request::get('rpassword')) {

				//check if the user request exist
				if ($this->model->where('ID',$userID)->count() > 0) {
					//check if the user is already activated
					if ($this->model->where('ID',$userID)->where('IsActivated','1')->count() > 0) {
						return [
								'error' => true,
								'message' => 'This Account is already activated'
							];
					}

					//check if the password is system valid
					$sysAuth = $this->sysAuth->isValid(Request::get('password'));

					if (!$sysAuth['error']) {

						if (Auth::check()) {
							Auth::logout();
						}

						//set necessary datas
						$data = [
							'UserID' => Request::get('username'),
							'UserName' => Request::get('FirstName').' '. Request::get('MiddleName').' '.Request::get('LastName'),
							'GroupID' => Sys::$scholarGroupID,
							'RegionID' => decode(Request::get('region')),
							'MobileNo' => Request::get('mobile'),
							'TelNo' => Request::get('telno'),
							'password' => bcrypt(Request::get('password')),
							'PwdExpiryDate' => $this->sysAuth->getExpiryDate(),
							'IsActivated' => 1,
							'ActivatedDate' => systemDate()
						];

						//create/update account
						$this->model->where('ID',$userID)
							->update($data);

						//log this transaction
						SystemLog(
							'Security','Invite','create',
							'register',Request::all(),
							'Invited Registered',
							$userID
						);

						$data['email'] = $this->geteKey();
						$data['opassword'] = Request::get('password');

						//email account
						Mail::send('emails.account_details', $data, function ($message) use ($data) {
							$message->from('mailtesterx@gmail.com',Sys::$title);
				        	$message->to(trim(getObjectValue($data,'email')))->subject('CHED K to 12 Transition Program Account.');
						});

						//log this invitation
						$this->invited(Request::get('username'));

						//send acknowlowdgement of receipt of the other email address that does not activated the link
						$Alemail = $data['email'].';'.$this->getAlEmail();
						$Alemail = explode(';',$Alemail);						

						if (!$this->geteKey()) return;

						foreach($Alemail as $email) {

							$email = trim($email);
							
							if (!$email || $email == '' || $email == '0') continue;

							if ($email != $this->geteKey()) {

								$data['email'] = $email;

								//email acknowledgement
								Mail::send('emails.invitation_acknowledgment', $data, function ($message) use ($data) {
									$message->from('mailtesterx@gmail.com',Sys::$title);
						        	$message->to(getObjectValue($data,'email'))->subject('CHED K to 12 Transition Program Invitation.');
								});
							}
						}

						return [
								'error'=>false,
								'message'=>'Successfully Registered. Please check your email for the account information. Wait for the page to redirect you to login page.'
							];
					}
					return $sysAuth;
				}

			}		

			$response = ['error' => false,'message' => 'Successfully Reset Password.'];
		}
		return $response;
	}

	public function isValidUsername($username)
	{
		if (userModel()->where('UserID',$username)->count() > 0) {
			return ['error'=>true,'message'=>'The Username has already been taken.!'];
		}

		return ['error'=>false,'message'=>'Valid!'];
	}

	protected function validateRequest()
	{	
		if (!isValidToken(Request::get('token'))) {
			return "Invalid Reset!";
		}

		// $date = substr(decodeToken(Request::get('token')),-10);

		// if($this->isExpiredToken($date)) {
		// 	return "This link is already expired!";
		// } 

		$this->initializer();
		if ($this->IsActivated($this->getUserID())) {
			return 'This Account is already activated';
		}

		return true;
	}

	protected function getUserID() 
	{
		$userID = decodeToken(Request::get('token'));

		return substr($userID, 0,strlen($userID) - 10);
	}

	protected function geteKey() 
	{
		return decodeToken(decode(Request::get('ekey')));
	}

	protected function getAlEmail() 
	{
		return userModel()->select('Alemail')->where('ID',$this->getUserID())->pluck('Alemail');
	}


	protected function isExpiredToken($date) {
		$status = date_diff(
            date_create(date('Y-m-d')),
            date_create($date)
        )
        ->format('%R%a'); 
        return ((int)$status >= 1) ? false : true;
	}

	protected function invited($UserID = '')
	{
		if (!$UserID) return;

		$this->log->where('UserID',$UserID)
			->update([
				'ActivatedDte' => systemDate(),
				'Status' => 1
			]);
	}

	protected function IsActivated($UserID)
	{
		return $this->model->where(['ID' => $UserID,'IsActivated' => '1'])->count() > 0 ? true : false;
	}

	private function initializer()
	{
		$this->model = new UserModel;
		$this->sysAuth = new sysAuth;
		$this->log = new InviteLog;
	}

}