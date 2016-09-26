<?php 
namespace App\Modules\Setup\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Setup\Services\NationalityServiceProvider as Services;
use App\Modules\Setup\Models\Nationality as NationalityModel;
use Request;
use Response;
use Permission;

class Nationality extends Controller {
	private $media =
		[
			'Title'=> 'Nationality',
			'Description'=> 'Manage',
			'js'		=> ['crud'],
			'init'		=> ['CRUD.init()','FN.dataTable()'],
			'plugin_js'	=> [
							'bootbox/bootbox.min',
							'bootstrap-select/bootstrap-select.min',
	                        'datatables/media/js/jquery.dataTables.min',
				            'datatables/extensions/TableTools/js/dataTables.tableTools.min',
				            'datatables/extensions/Scroller/js/dataTables.scroller.min',
				            'datatables/plugins/bootstrap/dataTables.bootstrap'
						]
		];

	private $url = [ 'page' => 'setup/nationality/','form'=> '.form_crud' ];

	public $views = 'Setup.Views.Nationality.';

 	function index()
 	{
 		$this->initializer();
        if ($this->permission->has('read')) {
            return view('layout',array('content'=>view($this->views.'index',$this->init())->with(['views'=>$this->views]),'url'=>$this->url,'media'=>$this->media));
        }
        return view(config('app.403'));
 	}

 	function event()
	{
		$response = ['error'=>true,'message'=>'No Event Selected'];
		if (Request::ajax())
		{
			$this->initializer();
			$response = ['error'=>true,'message'=>'Permission Denied!'];
			switch(Request::get('event'))
			{
				case 'save':
					if ($this->permission->has('add')) {
						$validation = $this->services->isValid(Request::all());
						if ($validation['error']) {
							$response = Response::json($validation);
						} else {
							$data = $this->services->post(Request::all());
							$data['created_date'] = systemDate();
							$data['created_by'] = getUserName();
							$this->model->create($data);
							$response = ['error'=>false,'message'=>'Successfully Save!','table'=> $this->refreshTable()];
						}
					}
					break;
				case 'update':
					if ($this->permission->has('edit')) {
						$validation = $this->services->isValid(Request::all());
						if ($validation['error']) {
							$response = Response::json($validation);
						} else {
							$data = $this->services->post(Request::all());
							$data['modified_date'] = systemDate();
							$data['modified_by'] = getUserName();
							$this->model->where('index_id',decode(Request::get('id')))->update($data);
							$response = ['error'=>false,'message'=>'Successfully Update!','table'=> $this->refreshTable()];
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
						$response = ['error'=> false,'message'=>'Successfully Deleted','table'=> $this->refreshTable()];
					}
					break;
				case 'acOrdc':
					if ($this->permission->has('activate/deactivate')) {
						$ids = json_decode('['.Request::get('ids').']',true);
						foreach($ids as $id)
						{
							 $this->model->where('index_id',decode($id['id']))->update(['is_inactive'=>$id['status']]);
						}
						$response = ['error'=> false,'message'=>'Successfully update status','table'=> $this->refreshTable()];
					}
					break;
				case 'edit':
						$response = view($this->views.'forms.form',['data'=>$this->model->find(decode(Request::get('id')))]);
					break;
			}
		}
		return $response;
	}

	private function init($key = null) 
	{
		$this->initializer();
		return array(
			'table' => $key == null ?  $this->model->all() : array()
		);
	}

	private function refreshTable()
	{
		return view($this->views.'tables.table',['table'=>$this->model->all()])->render();
	}

	private function initializer()
	{
		$this->services = new Services;
		$this->model = new NationalityModel;
		$this->permission = new Permission('nationality');
	}
}