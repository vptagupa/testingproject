<?php 
namespace App\Modules\Setup\Controllers;
use App\Http\Controllers\Controller;
use App\Modules\Setup\Services\ComplimentaryServiceProvider as Services;
use App\Modules\Setup\Models\Complimentary as ComplimentaryModel;
use App\Modules\Setup\Models\ComplimentaryItems;
use App\Modules\Products\Models\Products as ProductModel;
use Request;
use Response;
use Permission;
use DB;

class Complimentary extends Controller {
	private $media =
		[
			'Title'=> 'Complimentary',
			'Description'=> 'Manage',
			'js'		=> ['Setup/Complimentary'],
			'init'		=> ['CMP.init()','FN.multipleSelect()'],
			'plugin_js'	=> [
							'bootbox/bootbox.min',
							'select2/select2.min',
							'jquery-multi-select/js/jquery.multi-select',
			                'bootstrap-select/bootstrap-select.min',
	                        'datatables/media/js/jquery.dataTables.min',
				            'datatables/extensions/TableTools/js/dataTables.tableTools.min',
				            'datatables/extensions/Scroller/js/dataTables.scroller.min',
				            'datatables/plugins/bootstrap/dataTables.bootstrap'
						],
			'plugin_css' => [
				'bootstrap-select/bootstrap-select.min',
				'select2/select2',
				'jquery-multi-select/css/multi-select',
			]
		];

	private $url = [ 'page' => 'setup/hotel/complimentary/','form'=> '.form_crud' ];

	public $views = 'Setup.Views.Complimentary.';

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
							if ($this->services->save($this->model,$this->items)) {
								$response = ['error'=>false,'message'=>'Successfully Save!','table'=> $this->refreshTable()];
							} else {
								$response = ['error'=>true,'message'=>'There was an error while saving!'];
							}
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
				case 'removeProduct':
					if ($this->permission->has('delete-product')) {
						$this->items
							->where('index_id',decode(Request::get('key')))
							->update(['is_deleted'=>1]);
						$response = ['error'=> false,'message'=>'Successfully Deleted'];
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
				case 'getProducts':
						$response = $this->product->select([
									'name','index_id as id',
									DB::raw('(select price from products_price pprice where product_id=products.index_id order by pprice.index_id desc limit 1 ) as price')
								])->where('category_id',decode(Request::get('key')))->get();
				break;
				case 'showProducts':
					$response = ['error'=>false,
									'products'=> view($this->views.'tables.table')->render(),
									'form'=> view($this->views.'forms.form')->render()
								];
					break;
				case 'show':
				$response = ['error'=>false,
								'data'=> view($this->views.'tables.complimentary')->render(),
								'form'=> view($this->views.'forms.form')->render()
							];
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
		$this->model = new ComplimentaryModel;
		$this->items = new ComplimentaryItems;
		$this->product = new ProductModel;
		$this->permission = new Permission('complimentary');
	}
}