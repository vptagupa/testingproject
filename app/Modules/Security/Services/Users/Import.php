<?php
namespace App\Modules\Security\Services\Users;

use App\Libraries\PHPExcel\PHPExcel\PHPExcel_IOFactory;
use App\Modules\Institution\Models\Institution;
use App\Modules\Security\Models\Users\User;
use Sys;
use DB;

Class Import {

    
    public $hasHeader = true;

    public $is_overwrite = false;

    public $UploadTo;

    private $importDate;

    private $importBy;

    private $duration = 0;

    public function __construct()
    {
    	$this->initializer();
    }

	public function go($file)
    {   
        set_time_limit(0);
        ini_set('memory_limit', '-1');
       
        $this->duration = microtime(true);

        $this->importDate = date('Y-m-d H:m:s');

        $this->importBy = getUserID();

        $objReader = PHPExcel_IOFactory::createReader(PHPExcel_IOFactory::identify($file));

        $spreadsheetInfo = $objReader->listWorksheetInfo($file);
        
        $sheet_header = array();

        $objReader->setLoadSheetsOnly(0);

        //$objReader->setInputEncoding("ISO-8859-1");

        $objPHPExcel = $objReader->load($file);

        $objReader->setReadDataOnly(true);

        $excelData = array();

        $index = 0;

        $return_count = 0;

        $i = 0;


        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

            foreach ($worksheet->getRowIterator() as $row) {

                $cellIterator = $row->getCellIterator();

                $cellIterator->setIterateOnlyExistingCells(false);

                $CellIndex = 0;

                foreach ($cellIterator as $cell) {
                    if (!is_null($cell)) {
                        $excelData[$index][$CellIndex++] = $cell->getCalculatedValue();
                    }
                }

                $_filter_empty_row = array_filter($excelData[$index]);

                if(count($_filter_empty_row) > 0){
                	if ($index > 0) {
                		// $this->saveAccFile($excelData[$index],$objReader);
                	}
                }
                $index++;
            }
        }
    }

    public function saveAccFile($data, $object)
    {   
        ob_start();
        $file = fopen('php://output',"w"); 
        $cells = [];
        foreach($data as $cols) {
           $cells[] = $cols;
        }

         // fputcsv($file,
         //       $cells
         //    );
        // print_r($cells);
        
        // $object->save(app_path().'angel/accounting.xlsx');

    }

    /*
        UPLOADED LIST
        R3_HEI CREDENTIALS_08052016 (SUCS)
        03075
        95f58be45f

        04006
        141a5d20bb
    */
    protected function importRegionHEIS($data)
    {   
        $this->pswd = new \App\Modules\Security\Services\Password\Set;
        if (isset($data[2]) && trim($data[2]) != '') {
            $model = DB::table('kt_users');
            $uic = $data[1];
            if (empty($uic)) {
                $uic = substr(str_shuffle(md5(date('mdhis'))),0,7);
            }
            
            if ($model->where('UserID',$uic)->count() <= 0) {
                $pswd = substr(str_shuffle(md5($uic)),0,10);
                $user = [
                        'UserID' => $uic,
                        'UserName' => $data[2],
                        'password' => bcrypt($pswd),
                        'OtherName' => $pswd,
                        'GroupID' => Sys::$InstitutionGroupID,
                        'IsTempUser' => 1,
                        'UII' => $uic,
                        'RegionCode' => $data[0],
                        'PwdExpiryDate' => $this->pswd->getExpiryDate()
                    ];
                $model->insert($user);

                // print_r($user);
            }
        }
    }

    protected function insertHEI($data)
    {   
        $fo = true;
        $selfUII = date('Ymdhms');
        //insert HEI first
        $data = [
            'code' => $data[0],
            'name' => $data[3],   
        ];

        DB::table('kt_hei_code')
            ->insert($data);
    }

    protected function insertRegion($data)
    {   
        $fo = true;
        $selfUII = date('Ymdhms');
        //insert HEI first
        $data = [
            'ID' => $data[0],
            'Code' => $data[1],
            'Region' => $data[2],   
        ];

        DB::table('kt_region')
            ->insert($data);
    }

    protected function insertDHEI($data)
    {   
        $fo = true;
        $selfUII = date('Ymdhms');
        //insert HEI first
        $hei = [
            'UII' => $data[7],
            'School' =>  $data[2],
            'Region' =>  $data[1],
            'RegionID' =>  $this->getRegionID($data[1]),
            'MajorDiscipline' =>  $data[3],
            'Program'  =>  $data[4],
            'DegreeLevel'  =>  $data[5],
            'DeliveryType'  =>  $data[6],
            'ProgramClusterCode'  =>  $data[8],
            'ProgramNo' =>  $data[9],
            'UniqueProgramCode' =>  $data[10],
        ];

        DB::table('kt_dhei_approved')
            ->insert($hei);
    }

    private function getRegionID($region){
        $region = trim(strtolower($region));

        if ($region == '5') {
            $region = 4;
        }

        elseif ($region == '6') {
            $region = 7;
        }

        elseif ($region == '7') {
            $region = 8;
        }

        elseif ($region == '8') {
            $region = 9;
        }

        elseif ($region == '9') {
            $region = 10;
        }


        elseif ($region == '10') {
            $region = 18;
        }

        elseif ($region == '11') {
            $region = 12;
        }

        elseif ($region == '12') {
            $region = 13;
        }

        elseif ($region == '12') {
            $region = 13;
        }

        elseif ($region == '4a') {
            $region = 4;
        }

        elseif ($region == '4b') {
            $region = 5;
        }

        elseif ($region == 'car') {
            $region = 16;
        }

        elseif ($region == 'caraga') {
            $region = 14;
        }

        elseif ($region == 'ncr') {
            $region = 17;
        }

        elseif ($region == 'nir') {
            $region = 15;
        }

        return $region;
    }

   


    protected function insert($data)
    {	
    	$fo = true;
    	$selfUII = date('Ymdhms');
    	//insert HEI first
    	$hei = [
    		'UII' => ($data[1] && $data[1] != '' & $data[1] != '0' && $data[1] != null) ? $data[1] : $selfUII,
			'Code'  => ($data[1] && $data[1] != '' && $data[1] != '0' && $data[1] != null) ? : $selfUII,
			'Name'  => $data[2],
			'IsMain' => 1,			
			'Email' => $this->getEmail($data[5]),
			'Mobile' => '',
			'TelNo' => $data[6],
			'ContactPerson' => $data[3],
			'Designation' => $data[4],
			'Alemail' => $this->getAlEmail($data[5]),
    	];

    	//check if the HEI is existing then update else insert
    	if ($this->hei->where('UII',$hei['UII'])->count() > 0) {
    		//update
    		$this->hei
    			->where('UII',$data[1])
    			->update(
    				assertModified($hei)
    			);

    		$fo = false;

    		$HeiID = $this->hei->select('HeiID')->where('UII',$data[1])->pluck('HeiID');

    	} else {
    		//insert
    		$HeiID = $this->hei->create($hei)->HeiID;
    	}

		$user = [
			'UserID' => $HeiID,
			'UserName' => $hei['ContactPerson'],
			'Email' => $hei['Email'],
			'Alemail' => $hei['Alemail'],
			'GroupID' => Sys::$InstitutionGroupID,
			'InstitutionID' => $HeiID,
		];

		//check if user already existing then update else insert
		if ($this->user->where('Email',$hei['Email'])->count() <= 0) {
			//insert
			$this->user->create($user);
		} else {
			//update
			$this->user
				->where('UserID',$HeiID)
				->update($user);
		}
    }

    //get alternate emails
    private function getAlEmail($email)
    {
    	$email = explode(';', $email);

    	$emails = '';

    	foreach($email as $key => $e) {
    		if ($key > 0) {
    			$emails .= $e.';';
    		}
    	}

    	return $emails;
    }

    //get main email
    private function getEmail($email)
    {
    	return explode(';', $email)[0];
    }

    //has alternate email?
    private function hasAlEmail($email) {
    	$email = explode(';', $email);
    	return count($email) > 1 ? true : false; 
    }

    private function initializer()
    {
    	$this->hei = new Institution;
    	$this->user = new User;
    }
}
?>