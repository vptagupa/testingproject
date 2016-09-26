<?php
namespace App\Modules\Security\Services\Access;
use App\Modules\Security\Services\Access\AccessData;
use DB;
class Access
{

    /**
     * nodes stored in array
     *
     * @var array
     */
    private $pagesNode = array();

    /**
     *  pages stored in array
     *
     * @var string
     */
    private $pages = array();

    /**
     * sub page stored in array
     *
     * @var array
     */
    private $subPages = array();

    /**
     *  sub pages stored in array
     *
     * @var array
     */
    private $nexSubPages = array();

    /**
     *  access
     *
     * @var array
     */
    private $access = array();

    /**
     *  user key
     *
     * @var string
     */
    private $userKey = '';

    /**
     *  state
     *
     * @var boolean
     */
    private $state = false;

    /**
     *  init construct accessData Class
     *
     * @var Class
     */
    public function __construct()
    {
        $this->accessData = new AccessData;
    }

    /**
     * get data in a tree jquery plugin
     *
     * @var array
     */
    public function treeData()
    {
        $parent = [];
        foreach($this->accessData->getModules() as $module)
        {
            $pages = $this->getPages($module->module_id);
            $parent[] = $this->accessData->treeLeaf(ucfirst($module->name)."<id class='module page hide'>{$module->module_id}</id>",count($pages) > 0 ? $pages : $this->setActions($module->module_id),$this->state);
        }
        return $parent;
    }

    /**
     * get pages
     *
     * @param string $key
     * @return array
     */
    private function getPages($key)
    {
        $children = [];
        $this->setPages($key);
        foreach($this->accessData->getPages($key) as $page)
        {
            if (isset($this->pagesNode[$page->page_id]))
            {
                if (isset($this->subPages[$page->page_id]) && $page->parent_page_id == '' )
                {
                    $children[] = $this->accessData->treeLeaf(ucfirst($page->name)."<id class='page hide'>{$page->page_id}</id>",$this->getSubPage($key,$page->page_id),$this->state);
                }
            }
            if ((!$page->parent_page_id || $page->parent_page_id == '') && !$page->is_node) 
            {
                $children[] = $this->accessData->treeLeaf(ucfirst($page->name)."<id class='page hide'>{$page->page_id}</id>",$this->setActions($page->page_id),$this->state);
            }
        }
        return $children;
    }

    /**
     * get sub ppages
     *
     * @param intenger $module_id, integer $page_id
     * @return array
     */
    private function getSubPage($module_id,$page_id)
    {
        $sub_children = [];
        $children = [];
        foreach($this->subPages[$page_id] as $page)
        {
            $sub_children = $this->setSubPagesUntil($module_id,$page['name'],$page['page_id']);
            if (count($sub_children) > 0 )
            {   
                $children = $sub_children;
            } else {
                $children[] =  $this->accessData->treeLeaf(ucfirst($page['name'])."<id class='page hide'>{$page['page_id']}</id>",$this->setActions($page['page_id']),$this->state);
            }            
        }
        return $children;
    }

    /**
     *  set all sub pages until end
     *
     * @param integer $module_id, string $page, integer $page_id
     * @return array
     */
    private function setSubPagesUntil($module_id,$page,$page_id)
    {
        $children = [];
        if (count($this->accessData->getSubPages($module_id,$page_id)) > 0 )
        {
            $sub_children = $this->getSubPagesUnitl($module_id);
           
            if (count($sub_children) > 0)
            {
                $children[] = $this->accessData->treeLeaf(ucfirst($page)."<id class='page hide'>{$page_id}</id>",$sub_children,$this->state);
            } 
        }
        return $children;
    }

    /**
     * get all sub pages until the end of loop
     *
     * @param integer $module_id
     * @return array
     */
    private function getSubPagesUnitl($module_id)
    {
        $sub_children = [];
        foreach($this->accessData->subPages as $sub)
        {
            if ( $sub->is_node )
            {
                $sub_children = $this->setSubPagesUntil($module_id,$sub->name,$sub->page_id);
            } else {
                $sub_children[] =  $this->accessData->treeLeaf(ucfirst($sub->name)."<id class='page hide'>{$sub->page_id}</id>",$this->setActions($sub->page_id),$this->state);
            }
        }
        return $sub_children;
    }

    /**
     * set Main Page
     *
     * @param integer $key
     * @return array
     */
    private function setPages($key)
    {
        foreach($this->accessData->getPages($key) as $page)
        {
            if ( $page->is_node )
            {
                $this->pagesNode[$page->page_id] = 
                [
                    'text' => ucfirst($page->name),
                    'icon' => 'fa fa-file font-green',
                ];
            }
            
            if ($page->parent_page_id != '')
            {
                $this->subPages[$page->parent_page_id][$page->page_id] = 
                [
                    'name' => ucfirst($page->name),
                    'page_id' => $page->page_id,
                    'is_node' => $page->is_node
                ];
            }
        }
    }

    /**
     * get All actions in a page
     *
     * @param integer $page_id
     * @return array
     */
    private function setActions($page_id)
    {
        $actions = [];

        foreach($this->accessData->mergeDefaultActions($page_id) as $action)
        {
            $actions[] = $this->accessData->treeLeaf("<sysaction>".ucfirst($action['name'])."</sysaction><id class='action hide'>{$action['id']}</id>",array(),$this->state,$this->setActionSelect($action['id'],$page_id),'fa fa-gear');
        }
        $actions[] = $this->accessData->treeLeaf('<a href="javascrit:;" class="action_add_new">Add New</a>',array(),true,false,'fa fa-gear');
        return $actions;
    }

    /**
     *  check if ther is action selected
     *
     * @param string $action, integer $page_id
     * @return boolean
     */
    private function setActionSelect($action,$page_id)
    {
        if (isset($this->accessData->getAccessPage[$page_id]))
        {
            return in_array($action,$this->accessData->getAccessPage[$page_id]) ? true : false;
        }
        return false;
    }

    /**
     *  set action state
     *
     * @param integer
     * @return boolean
     */
    private function setAccessState($key)
    {
        return $this->state = $this->accessData->actionState(getGroupCodeByUserID($key));
    }

    /**
     * get method access in access data Class
     *
     * @param string $method, number $key
     * @var class
     */
    public function AccountAccess($method,$key)
    {   
        $this->access = $this->accessData->$method($key);
        $this->setAccessState($key);

        if ($this->state) 
        {
            $this->access = $this->accessData->getGroupAccess(getUserGroupID($key));
        }

        return $this->access;
    }

}
