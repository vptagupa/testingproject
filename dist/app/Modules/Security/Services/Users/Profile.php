<?php
namespace App\Modules\Security\Services\Users;

use App\Modules\Security\Services\UserServiceProvider as Services;
use Request;
use Auth;
use sysAuth;
use Storage;

Class Profile {

	public function __construct()
	{
		$this->services = new Services;
		$this->sysAuth = new sysAuth;
	}

	public function updateAvatar($userID)
	{
		it("logs Module,Controller,Method,Action,Param,Msg", function() use ($userID) {

			if (isset($_FILES['photo'])) {

				$file = getFileInfo($_FILES['photo']);
				$FileName = $userID.'.'.$file['FileExtension'];
					
				$OldPhoto = userModel()
					->select('Photo')
					->where('ID',$userID)
					->pluck('Photo');

				userModel()
					->where('ID',$userID)
					->update([
						'Photo' => $FileName
					]);

				toStorage(
					AppConfig()->userPhotoPath.$FileName,
					$file['Attachment']
				);

				if (!empty($OldPhoto)) {
					if (Storage::exists(AppConfig()->userPhotoPath.$OldPhoto)) {
						Storage::delete(AppConfig()->userPhotoPath.$OldPhoto);
					}
				}
			}

			SystemLog('Security','Profile','event','updateAvatar','Photo',successSave());
		});
		return successSave();
	}

	public function updateAccount($userID,$password)
	{
		$credentials = ['ID'=>$userID,'password'=>Request::get('CurrentPassword')];
		
		$sysAuth = $this->sysAuth->isValid($password);
		if (!$sysAuth['error']) {
			it("logs Module,Controller,Method,Action,Param,Msg", function() use($userID) {
				userModel()->where('ID',$userID)
				->update(
					$this->services->postPassword(Request::all())
				);
				SystemLog('Security','Profile','event','updatePassword',Request::all(),'Updated password');
			});
			return successSave();
		}
		return $sysAuth;
	}
}
?>