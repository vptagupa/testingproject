<?php
namespace App\Modules\Security\Services\Access;
use DB;
class AccessData
{
    private $prefix = '';

    public $module;

    public $pages;

    public $subPages;

    public $actions;

    public $defaultActions;

    public $getAccessPage;

    public $accessType = '';

    public function getGroupAccess($key)
    {
        $access = DB::select("select page_id,action_id from access  where link_type='group' and link_id='".$key."'");
        $actions = [];
        foreach($access as $action)
        {   
            $actions[$action->page_id][] = $action->action_id;
        }
        $this->accessType = 'group';
        return $this->getAccessPage = $actions;
    }

     public function getUserAccess($key)
    {
        $access = DB::select("select page_id,action_id from access  where link_type='account' and link_id='".$key."'");
        $actions = [];
        foreach($access as $action)
        {  
            $actions[$action->page_id][] = $action->action_id;
        }
        $this->accessType = 'account';
        return $this->getAccessPage = $actions;
    }

    public function getModules()
    {
        return $this->modules = DB::select("select module_id,name from ".$this->prefix."modules");
    }

    public function getPages($key)
    {
        return $this->pages = DB::select("select page_id,name,is_node,parent_page_id,module_id from ".$this->prefix."pages where module_id=".$key." order by sort asc");
    }

    public function getSubPages($module_id,$key)
    {
        return $this->subPages = DB::select("select page_id,name,is_node,parent_page_id,module_id from ".$this->prefix."pages where module_id=".$module_id." and parent_page_id=".$key." order by sort asc");
    }

    public function setDefaultPageActions()
    {
        return $this->defaultActions = DB::select("select action_id,name,is_default from ".$this->prefix."page_actions where is_default=1"." order by sort asc");
    }

    public function setPageActions($key)
    {
        return $this->actions = DB::select("select action_id,name from ".$this->prefix."page_actions where is_default <> 1 and page_id=".$key." order by sort asc");
    }

    public function mergeDefaultActions($key)
    {
        $this->setPageActions($key);

        $this->setDefaultPageActions();

        $default = [];
        $actions = [];

        foreach($this->defaultActions as $action)
        {
            $default[] = ['id'=>$action->action_id,'name'=>$action->name];
        }

        foreach($this->actions as $action)
        {
            $actions[] = ['id'=>$action->action_id,'name'=>$action->name];
        }
        return $this->mergeActions = array_merge($default, $actions);
    }

    public function actionState($group_code)
    {
        if ($this->accessType)
        {
            if(strtolower($this->accessType) == 'account')
            {
                if (strtolower($group_code) == 'custom') {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }

    public function treeLeaf($text,$children = array(),$disabled = false,$selected = false,$icon = 'fa fa-file font-green')
    {
        return [
            'text' => $text,
            'icon' => $icon,
            'children' => $children,
            'state' => [ 'disabled' => $disabled,'selected'=>$selected],
        ];
    }

 
}
