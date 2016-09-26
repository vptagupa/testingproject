<?php
namespace App\Modules\Security\Services\Logs;
use App\Modules\Security\Models\Auditrails as AuditrailsModel;
use DB;
use Request;
use Response;

Class Datatable {

	public function __construct()
	{
		$this->model = new AuditrailsModel;
	}

	public function filter()
	{

		$model = DB::table($this->model->table.' as t');
		$hasParam = false;
		$columns = array(
			't.module',
			't.controller',
			't.action',
			't.parameter',
			't.message',
			't.browser',
			't.device',
			't.ip_address',
			't.created_date',
			'u.UserName as name',
		);

		$model = $model->select($columns)->leftJoin(userTable().' as u','u.ID','=','t.created_by');

		if (Request::get('module')) {
			$model->where('module','like','%'.trim(Request::get('module')).'%');
			$hasParam = true;
		}

		if (Request::get('page')) {
			$model->where('controller','like','%'.trim(Request::get('page')).'%');
			$hasParam = true;
		}

		if (Request::get('action') && !is_array(Request::get('action'))) {
			$model->where('action','like','%'.trim(Request::get('action')).'%');
			$hasParam = true;
		}

		if (Request::get('parameter')) {
			$model->where('parameter','like','%'.trim(Request::get('parameter')).'%');
			$hasParam = true;
		}

		if (Request::get('message')) {
			$model->where('message','like','%'.trim(Request::get('message')).'%');
			$hasParam = true;
		}

		if (Request::get('browser')) {
			$model->where('browser','like','%'.trim(Request::get('browser')).'%');
			$hasParam = true;
		}

		if (Request::get('device')) {
			$model->where('device','like','%'.trim(Request::get('device')).'%');
			$hasParam = true;
		}

		if (Request::get('ip_address')) {
			$model->where('ip_address','like','%'.trim(Request::get('ip_address')).'%');
			$hasParam = true;
		}

		if (Request::get('log_date_from') && Request::get('log_date_to')) {
			$model->where('t.created_date','>=',toSystemDateTime(Request::get('log_date_from')));
			$model->where('t.created_date','<=',toSystemDateTime(Request::get('log_date_to')));
			$hasParam = true;
		}

		if (Request::get('log_by')) {
			$model->where('u.UserName','like','%'.Request::get('log_by').'%');
			$hasParam = true;
		}
		
		if (!isUserLoginAdmin()) {
			$model->where('created_by',getUserID());
		}

		$iTotalRecords = $this->model->count();
		$iDisplayLength = intval($_REQUEST['length']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
		$iDisplayStart = intval($_REQUEST['start']);
		$sEcho = intval($_REQUEST['draw']);
		  
		$records = array();
		$records["data"] = array(); 

		$end = $iDisplayStart + $iDisplayLength;
		$end = !$hasParam ? $end > $iTotalRecords ? $iTotalRecords : ($end == $iTotalRecords) ? 0 : $end : 0;
		$data = $model->skip($end)->take($iDisplayLength)->get();

		foreach($data as $row) {
			$browser = json_decode($row->browser,true);
			$records['data'][] = [
				// $row->module,
				// $row->controller,
				$row->action,
				// trimStr($row->parameter),
				$row->message,
				$browser['name'],
				$row->device,
				$row->ip_address,
				$row->created_date,
				$row->name,
				''
			];
		}
		
		if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
		    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
		    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
		 }
		$records["draw"] = $sEcho;
		$records["recordsTotal"] = $iTotalRecords;
		$records["recordsFiltered"] = $iTotalRecords;

		return $records;
	}
}	
?>