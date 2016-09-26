<?php namespace App\Libraries;

use COM;

Class CrystalReport
	{
		public $path 		= '';
		public $extension	= 'pdf';
		public $filename 	= '';
		public $TempFile 	= 'output';
		
		protected $file 	= '';

		public $hasLogo 	= false;
		public $LogoPath 	= '';

		public $query 		= '';
		public $SubReport 	= array();

		private $host;
		private $server;
		private $database;
		private $user;
		private $password;

		private $CrystalApp;
		private $DBCon;
		private $ConnectionStr;

		protected function path()
		{
			return base_path().'\public\assets\system\reports\\'.$this->filename;
		}
		public function generate()
		{
			$this->PDFfile 	= str_replace('rpt',$this->extension,$this->path());
			$this->file 	= $this->path();
			$this->TempFile = $this->TempFile.'.'.$this->extension;
			$this->host 	= env('DB_HOST');
			$this->database = env('DB_DATABASE');
			$this->user 	= env('DB_USERNAME');
			$this->password = env('DB_PASSWORD');

			$this->execute();
			return ['file'=>$this->PDFfile,'filename'=>$this->filename];
		}

		private function execute()
		{
			$this->openConnection();

			ini_set('max_execution_time', 3600); //300 seconds = 5 minutes

			$Recordset  	= new COM ("ADODB.Recordset")  or die ("Error on load ADODB Recordset");
            $CrystalReport 	= $this->CrystalApp->OpenReport($this->file, 1);
            $Recordset->Open($this->query,$this->DBCon,3,1,1);
            $CrystalReport->Database->SetDataSource($Recordset->DataSource);


            if ( count($this->SubReport) > 0 )
            {
            	foreach($this->SubReport as $key => $report)
            	{
            		$RecordsetSub  = new COM ("ADODB.Recordset")  or die ("Error on load ADODB Recordset");

		            if ( isset($report['file']) ) { $CrystalReportSub  = $CrystalReport->OpenSubReport($report['file']); }

		            $RecordsetSub->Open($report['query'],$this->DBCon,3,1,1);

		            $CrystalReportSub->Database->SetDataSource($RecordsetSub->DataSource);
            	}
            }


            $CrystalReport->EnableParameterPrompting = False;
            $CrystalReport->DiscardSavedData;
           
            $CrystalReport->ExportOptions->DestinationType=1; // Export to File
            $CrystalReport->ExportOptions->FormatType= 31;  // 31 referring to the pdf type
            $CrystalReport->ExportOptions->DiskFileName=$this->PDFfile;
            $CrystalReport->Export(false);

           
           if ( count($this->SubReport) > 0 )
           {
           	$RecordsetSub->Close();
           }
            
            $CrystalReportSub = null;

            $Recordset->Close();
            $this->DBCon->Close();
            $CrystalReport = null;
            $this->CrystalApp = null;
           
		}

		private function openConnection()
		{
			$this->CrystalApp  		= new COM ("CrystalRuntime.Application.9") or die ("Error on load Crystal Report");
          	$this->DBCon 			= new COM ("ADODB.Connection") or die ("Error on load ADODB Connection");
			$this->ConnectionStr	= "Provider=MSDASQL;Driver={MySQL ODBC 5.3 ANSI Driver};Server=localhost;
									   Database=".$this->database.";User=".$this->user.";Password=".$this->password.";Option=3;";
            $this->DBCon->Open($this->ConnectionStr);
		}
	}


?>