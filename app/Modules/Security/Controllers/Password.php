<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Password\Password as PasswordModel;
use App\Modules\Security\Services\UserServiceProvider;
use Auth;
use Request;
use Response;
use Permission;

class Password extends Controller {
	private $media =
    [
    	'Title'     => 'Password',
        'Description' => 'Config',
        'js'		=> ['Security/password'],
		'init'		=> ['Password.init()','FN.multipleSelect()'],
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
			            'bootstrap-switch/js/bootstrap-switch.min'
                        ],
        'plugin_css'   => [
        	'bootstrap-select/bootstrap-select.min','select2/select2','jquery-multi-select/css/multi-select',
        	'bootstrap-switch/css/bootstrap-switch.min'
        ],
    ];

    private $url = 
    [
        'form' => '.form_user',
        'page'  => 'security/password/'
    ];

    public $views = 'Security.Views.password.';

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
			'views' => $this->views,
			'data' => $this->model->get()
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
				case 'save':
					if ($this->permission->has('edit')) {
						$this->model->where('index_id',decode(Request::get('key')))
							->update(['value'=>Request::get('value')]);
					} 
					$response = successSave();
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
		$this->model = new PasswordModel;
		$this->permission = new Permission('pswd-config');
	}

}