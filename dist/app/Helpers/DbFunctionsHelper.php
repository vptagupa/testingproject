<?php

    function get_institutions($key = null)
    {
        $tbl = 'kt_hei';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('HeiID',$key)->get();
	}
    
    function get_campus($key = null)
    {
        $tbl = 'kt_campus';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('CampusID',$key)->get();
	}
    
    function get_campusbyhei($heid = null){
        $tbl = 'kt_campus';
		return $heid == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('MainCampusID',$heid)->get();
    }
    
    function get_nominations($key = null)
    {
        $tbl = 'vw_nominations';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('HeiID',$key)->get();
	}
    
    function get_nationality($key = null)
    {
        $tbl = 'kt_nationality';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('IndexID',$key)->get();
	}
    
    function get_civilstatus($key = null)
    {
        $tbl = 'kt_civilstatus';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('CivilStatusID',$key)->get();
	}
    
    function get_religion($key = null)
    {
        $tbl = 'kt_religions';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('ReligionID',$key)->get();
	}
    
    function get_programs($key = null)
    {
        $tbl = 'kt_programs';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('ProgramID',$key)->get();
	}
    
    function get_majors($key = null)
    {
        $tbl = 'kt_majors';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('MajorID',$key)->get();
	}
    
    function get_subjectclass($key = null)
    {
        $tbl = 'kt_subject_class';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('IndexID',$key)->get();
	}
    
    function get_subjects($key = null)
    {
        $tbl = 'kt_subjects';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('SubjectID',$key)->get();
	}
    
    function get_scholartype($key = null)
    {
        $tbl = 'kt_scholarship_type';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('IndexID',$key)->get();
	}
    
    function get_degreetype($key = null)
    {
        $tbl = 'kt_degree_type';
		return $key == null ? DB::table($tbl)->get() :  DB::table($tbl)->where('IndexID',$key)->get();
	}
    
    function get_semester($id){
        $semester = array(
            '1' => 'FIRST SEMESTER',
            '2' => 'SECOND SEMESTER',
            '3' => 'THIRD SEMESTER',
            '4' => 'SUMMER 1',
            '5' => 'SUMMER 2',
            '6' => 'SUMMER 3',
            
        );
        return $semester[$id];
    }
    
      function get_totalscholars_schotype($hei = 0,$scho = 0 ){
        $res = 0 ;
        if($hei != 0 ){                    
            $tbl = 'kt_hei_scholars';
            $res = DB::table($tbl)
                    ->where('HeiID', $hei)
                    ->where('SchoType', $scho)
                    ->count('*');
        }        
		return $res; 
    }
    
    function get_totalscholars_degreetype($hei = 0,$degree = 0 ){
        $res = 0 ;
        if($hei != 0 && $degree != 0  ){                    
            $tbl = 'kt_hei_scholars';
            $res = DB::table($tbl)
                    ->where('HeiID', $hei)
                    ->where('TypeID', $degree)
                    ->count('*');
        }        
		return $res; 
    }
    
    function get_totalscholars_gender($hei = 0,$gender = '' ){
        $res = 0 ;
        if($hei != 0 && $gender != ''  ){                    
            $tbl = 'kt_hei_scholars';
            $res = DB::table($tbl)
                    ->where('HeiID', $hei)
                    ->where('Gender', $gender)
                    ->count('*');
        }        
		return $res; 
    }
    
    function get_scholars_programs($hei = 0 ){
        $res = array() ;
        if($hei != 0 ){                    
            $tbl = 'kt_hei_scholars';
            $res = DB::table($tbl)
                    ->select('AcademicProgram', DB::raw('COUNT(*) as total'))
                    ->where('HeiID', $hei)
                    ->groupBy('AcademicProgram')
                    ->get();
        }        
		return $res; 
    }
    
  
    
?>