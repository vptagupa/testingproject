<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Support\Models\Support;
use Auth;
use Request;
use Response;
use Permission;

class FAQ extends Controller {
	private $media =
    [
    	'Title'     => 'Contact Us',
        'Description' => '',
        'js'		=> ['Support/index'],
		'init'		=> ['Me.init()'],
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
        'form' => '.form_faq',
        'page'  => 'help/faq/'
    ];

    public $views = 'Security.Views.FAQ.';

	function index()
	{
		$this->initializer();		
		SystemLog("Setup","User","logout","view");
		return view('layout',array('content'=>view($this->views.'index',$this->init())->render(),'url'=>$this->url,'media'=>$this->media));
	}

	function init($key=null)
	{
		return array(
			'views' => $this->views
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
					$status = $this->model->insert(
							assertCreated(
								assertFields(
									['HeiID' => getUserInstitutionID()],
									unsetFields(
										'event',
										Request::all()
									)
								)
							)
						);
					
					if ($status) {
						$response = ['error' => false,'message' => 'Successfully Sent FeedBack.']; 
					} else {
						$response = ['error' => true,'message' => 'Could not send FeedBack. Please try again.'];
					}
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
		$this->model = new Support;
	}

}