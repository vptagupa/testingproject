<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Models\Auditrails as AuditrailsModel;
use App\Modules\Security\Services\UserServiceProvider;
use App\Modules\Security\Services\Logs\Datatable;
use Auth;
use Request;
use Response;
use Permission;

class AuditTrails extends Controller {
	private $media =
    [
    	'Title'     => 'Audit Trails',
        'Description' => 'Manage',
        'js'		=> ['Security/audtitrails/logs','datatable'],
		'init'		=> ['Logs.init()','FN.datePicker()'],
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
        'page'  => 'security/logs/'
    ];

    public $views = 'Security.Views.audit_trails.';

	public function index()
	{
		$this->initializer();
		// if ($this->permission->has('read')) {
			SystemLog("Setup","User","logout","view");
			return view('layout',array('content'=>view($this->views.'index',$this->init())->render(),'url'=>$this->url,'media'=>$this->media));
		// }
		return view(config('app.403'));
	}

	public function search()
	{	
		$this->initializer();
		return $this->data->filter();
	}

	private function init($key=null)
	{
		return array(
			'views' => $this->views,
			'data' => $this->model->get()
		);
	}

	private function initializer()
	{
		$this->services = new UserServiceProvider;
		$this->model = new AuditrailsModel;
		$this->data = new Datatable;
		$this->permission = new Permission('audit-trails');
	}

}