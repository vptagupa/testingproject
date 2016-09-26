<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Users\User as UserModel;
use App\Modules\Security\Services\UserServiceProvider;
use App\Modules\Security\Services\Password\Validation;
use App\Modules\Security\Services\Users\Profile;
use Auth;
use Request;
use Response;
use Permission;

class EmailBlast extends Controller {
	private $media =
    [
    	'Title'     => 'Email Blast',
        'Description' => 'Manage',
        'js'		=> ['Security/user/user','Security/user/user_index','Security/profile/profile'],
		'init'		=> ['USER.init()','Profile.init()','FN.multipleSelect()','FN.dataTable()'],
		'plugin_js'	=> ['bootbox/bootbox.min',
						'select2/select2.min',
                        'bootstrap-datepicker/js/bootstrap-datepicker',
                        'select2/select2.min',
                        'jquery-multi-select/js/jquery.multi-select',
                        'bootstrap-select/bootstrap-select.min',
                        'datatables/media/js/jquery.dataTables.min',
			            'datatables/extensions/TableTools/js/dataTables.tableTools.min',
			            'datatables/extensions/Scroller/js/dataTables.scroller.min',
			            'datatables/plugins/bootstrap/dataTables.bootstrap',
			            'bootstrap-fileinput/bootstrap-fileinput'
                        ],
        'plugin_css'   => [
        	'bootstrap-select/bootstrap-select.min','select2/select2','jquery-multi-select/css/multi-select',
        	'bootstrap-fileinput/bootstrap-fileinput'
       	],
    ];

    private $url = 
    [
        'form' => '.form_user',
        'page'  => 'security/email-blast/'
    ];

    public $views = 'Security.Views.users.';

	function index()
	{
		$this->initializer();
		if ($this->permission->has('read')) {
			SystemLog("Setup","User","logout","view");
			return view('layout',array('content'=>view($this->views.'index',$this->init())->render(),'url'=>$this->url,'media'=>$this->media));
		}
		return view(config('app.403'));
	}

	function init($key=null)
	{
		return array(
			'users'			=> $this->model->getUser(),
			'data'			=> $key == null ? array() : $this->model->getUser($key),
		);
	}

	function event()
	{
		$response = 'No Event Selected';
		if (Request::ajax())
		{
			$this->initializer();
			$response = ['error'=>true,'message'=>'Permission Denied!'];
			switch(Request::get('event'))
			{
				case 'getForm':
					$response = view($this->views.'sub.user',['views'=>$this->views]);
					break;
				case 'save':
					if ($this->permission->has('add')) {
						$validation = $this->services->isValid(Request::all());
						if ($validation['error']) {
							$response = Response::json($validation);
						} else {
							$data = $this->model->create($this->services->postSave(Request::all()));
							$response = ['error'=>false,'message'=>'Successfully Save!','id'=>encode($data->ID)];
						}
					} 
					break;
				case 'update':
					if ($this->permission->has('edit')) {
						$validation = $this->services->isValid(Request::all(),'update');
						if ($validation['error']) {
							$response = Response::json($validation);
						} else {
							$data = $this->services->postUpdate(Request::all());
							unset($data['username'],$data['upassword'],$data['cpassword']);
							$this->model->where('id',decode(Request::get('id')))->update($data);
							$response = ['error'=>false,'message'=>'Successfully Update!'];
						}
					}
					break;
				case 'delete':
						if ($this->permission->has('delete')) {
							$ids = json_decode('['.Request::get('ids').']',true);
							foreach($ids as $id)
							{
								 $this->model->destroy(decode($id['id']));
							}
							$response = ['error'=> false,'message'=>'Successfully Deleted'];
						}
					break;
				case 'block':
						if ($this->permission->has('block')) {
							$ids = json_decode('['.Request::get('ids').']',true);
							foreach($ids as $id)
							{
								$status = $this->model->where('id',decode($id['id']))->update(['is_block'=>1]);
							}
							$response = ['error'=> false,'message'=>'Successfully Block User/s'];
						}
					break;
				case 'edit':
						$response = view($this->views.'sub.user',[
								'data'=>$this->model->getUser(decode(Request::get('id'))),
								'views' => $this->views
							]);
					break;
				case 'checkUsername':
						$response = ['isExist'=>$this->model->where('UserID',Request::get('id'))->count()];
					break;
				case 'updateAvatar':
					return $this->profile->updateAvatar(decode(Request::get('id')));
				break;
				case 'updatePassword':
					return $this->profile->updateAccount(decode(Request::get('id')),Request::get('ConfirmPassword'));
				break;
			}
		}
		return $response;
	}

	function logout()
	{
		SystemLog("Setup","User","logout","logout",getUserName());
		Auth::logout();
		return redirect()->intended('auth/login');
	}

	private function initializer()
	{
		$this->services = new UserServiceProvider;
		$this->model = new UserModel;
		$this->pswd = new Validation;
		$this->profile = new Profile;
		$this->permission = new Permission('users');
	}

}