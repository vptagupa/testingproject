<?php namespace App\Modules\Setup\Services\Config;
use illuminate\Database\Eloquent\Model;
use App\Modules\Setup\Models\ConfigNumber as GenNo;
use DB;

Class Autonumber extends Model {

	public $timestamps = false;

	public $format = 3; // style 1 manual,2 incremental,3 Incremental with Starting number

	public $start_at = 1;

	public $type = '';

	public $whereClause = '';

	public function __construct($type,$where = '')
	{
		$this->type = $type;
		$this->whereClause = $where;
		$this->init();
	}

	protected function init()
	{
		$obj = new GenNo;

		$config = $obj->getSettings($this->type);

		$this->format = isset($config[0]->format) ? $config[0]->format == '' ? 1 : $config[0]->format : 1;
		
		$this->start_at = isset($config[0]->start_at) ? $config[0]->start_at == '' ? 1 : $config[0]->start_at : 1;
	}

	protected function getTotalNumber()
	{
		$total = 1;
		switch(strtoUpper(trim($this->type)))
		{
			case 'STOCK':
				$total = DB::table('stockmaster')->count();
			break;
		}
		return $total;
	}

	protected function getManualNumber()
	{
		return '';
	}

	protected function getAutoIncrementNUmber()
	{
		return $this->getTotalNumber()+1;
	}

	protected function getAutoIncrementWithStartingNumber()
	{
		return ($this->getTotalNumber())+$this->start_at;
	}

	protected function getNumberBySeries()
	{
		return $this->seriesNumber();
	}

	public function getNumber()
	{
		$id = 1;
		switch ($this->format) {
			case 2:
				$id = $this->getAutoIncrementNUmber();
				break;
			case 3:
				$id = $this->getAutoIncrementWithStartingNumber();
				break;
			case 4:
				$id = $this->getNumberBySeries();
				break;
			default:
				$id = $this->getManualNumber();
				break;
		}
		return str_pad($id,10,'0',STR_PAD_LEFT);
	}
}