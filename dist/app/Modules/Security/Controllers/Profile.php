<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Users\User as UserModel;
use App\Modules\Security\Services\UserServiceProvider as Services;
use App\Modules\Security\Services\Users\Profile as ProfileClass;
use Auth;
use Request;
use Response;
use Mail;
use Permission;
use DB;

class Profile extends Controller {

	private $media =
    [
    	'Title' => 'Profile',
        'Description' => 'Manage',
        'BClass' => 'page-container-bg-solid',
        'js' => ['crud','Security/profile/profile'],
        'css' => ['profile'],
		'init' => ['Profile.init()'],
		'plugin_js'	=> [
				'bootbox/bootbox.min','jquery.sparkline.min',
				'bootstrap-fileinput/bootstrap-fileinput'
		],
        'plugin_css' => [
        	'bootstrap-fileinput/bootstrap-fileinput'
        ],
    ];

    private $url = 
    [
        'form' => '.form_user',
        'page'  => 'profile/'
    ];

    public $views = 'Security.Views.profile.';

    public function __construct()
    {
    	$this->initializer();
    }

	public function index()
	{	
		// if ($this->permission->has('read')) {
			return 
				view('layout',array(
						'content' => view($this->views.'main',['views' => $this->views,'tab'=>'main'])->render(),
						'url' => $this->url,
						'media' => $this->media
					)
				);
		// }
		// return view(config('app.403'));
	}

	public function event()
	{
		$response = 'No Event Selected';
		if (Request::ajax())
		{
			$response = permissionDenied();
			switch(Request::get('event'))
			{
				case 'updateProfile':
					if(
						$this->model->where('Email',Request::get('Email'))->where('ID','<>',getUserID())->count() <= 0
					) {
						it("logs Module,Controller,Method,Action,Param,Msg", function() {
							$this->model->where('ID',getUserID())
							->update(
								$this->services->postProfile(Request::all())
							);
							if (isUserLoginPersonnel()) {
								\App\Modules\Personnel\Models\Personnel::where('ID',getUserPersonnelID())
									->update(['Email' => Request::get('Email')]);
							}
							SystemLog('Security','Profile','event','updateProfile',Request::all(),successSave());
						});
						$response = successSave();
					} else {
						$response = ['error'=>true,'message'=>'Email address is already taken.'];
					}
					
				break;
				case 'updateAvatar':
					return $this->profile->updateAvatar(getUserID());
				break;
				case 'updatePassword':
					return $this->profile->updateAccount(getUserID(),Request::get('ConfirmPassword'));
				break;
			}
		}
		return $response;
	}

	public function account()
	{
		// if ($this->permission->has('read')) {
			return 
				view('layout',array(
						'content' => view($this->views.'main',['views' => $this->views,'tab'=>'account'])->render(),
						'url' => $this->url,
						'media' => $this->media
					)
				);
		// }
		// return view(config('app.403'));
	}

	public function help()
	{
		// if ($this->permission->has('read')) {
			return 
				view('layout',array(
						'content' => view($this->views.'main',['views' => $this->views,'tab'=>'help'])->render(),
						'url' => $this->url,
						'media' => $this->media
					)
				);
		// }
		// return view(config('app.403'));
	}

	public function init($key=null)
	{		
		return array(
			'views' => $this->views
		);
	}

	private function initializer()
	{
		$this->model = new UserModel;
		$this->services = new Services;
		$this->auth = new Auth;
		$this->profile = new ProfileClass;
		$this->permission = new Permission('Profile');
	}

}