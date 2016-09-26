<?php
namespace App\Modules\Security\Services\Access;
use DB;
class Accounts
{
    public function treeData()
    {
        $tree[] =
        [
            'text' => 'Groups',
            'children' =>  $this->loadGroups(),
        ];
        $tree[] =
        [
            'text' => 'Users',
            'children' =>  $this->LoadAccounts(),
        ];
        return $tree;
    }
    
    public function LoadAccounts()
    {
        $data = userJoins()->select(['UserID','UserName','DeptID','Department'])->where('Blocked','0')->get();
        // $data = DB::select("select user_id,name,department_id,department from vwusers where is_block=0");
        $tree = array();
        $children = array();
        $container = array();
        $parent = array();
        $i = 0;
        foreach ($data as $row) {
            $children[] =
            [
                'text' => $row->UserID.' - '."<sysaccount>".$row->UserName."</sysaccount><id class='account hide'>{$row->UserID}</id>",
                'icon' => 'fa fa-user font-green',
            ];
        
        }
       
        return $children;
    }

    public function loadGroups()
    {
        $data = DB::select("select GroupID,GroupName from kt_group");
        $tree = array();
        $children = array();
        $container = array();
        $i = 0;
        foreach ($data as $row) {
            $parent[] =
            [
                'text' => "<sysaccount>".$row->GroupName."</sysaccount><id class='group hide'>{$row->GroupID}</id>",
                'icon' => 'fa fa-file font-green',
            ];
        }
        return $parent;
    }
}
