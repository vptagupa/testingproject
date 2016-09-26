<?php
namespace App\Security\Services;
use App\Security\Services\AccessData;
use DB;
class MainMenu
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
     *  init construct accessData Class
     *
     * @var Class
     */
    public function __construct()
    {
        $this->accessData = new AccessData;
    }

    /**
     * get method access in access data Class
     *
     * @param string $method, number $key
     * @var class
     */
    public function AccountAccess($method,$key)
    {
        return $this->access = $this->accessData->$method($key);
    }

    /**
     * get data in a tree jquery plugin
     *
     * @var array
     */
    public function treeData()
    {
        foreach($this->accessData->getModules() as $module)
        {
            $pages = $this->getPages($module->module_id);
            $parent[] =
            [
                'text' => ucfirst($module->name)."<id class='module page hide'>{$module->module_id}</id>",
                'children' => count($pages) > 0 ? $pages : $this->setActions($module->module_id),
            ];
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
                if (isset($this->subPages[$page->page_id]) && $page->parent_page_id == '')
                {
                    $children[] = 
                    [
                        'text' => ucfirst($page->name)."<id class='page hide'>{$page->page_id}</id>",
                        'children' => $this->getSubPage($key,$page->page_id)
                    ];
                }
            }
            if ($page->parent_page_id == '' && !$page->is_node) 
            {
                $children[] =
                [
                    'text' => ucfirst($page->name)."<id class='page hide'>{$page->page_id}</id>",
                    'icon' => 'fa fa-file font-green',
                    'children' => $this->setActions($page->page_id)
                ];
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
                $children[] =
                [
                    'text' => ucfirst($page['name'])."<id class='page hide'>{$page['page_id']}</id>",
                    'icon' => 'fa fa-file font-green',
                    'children' => $this->setActions($page['page_id'])
                ];
            }            
        }
        return $children;
    }

    /**
     *  set all sub pages until
     *
     * @param integer $module_id, string $page, integer $page_id
     * @return array
     */
    private function setSubPagesUntil($module_id,$page,$page_id)
    {
        $children = [];
        if (count($this->accessData->getSubPages($module_id,$page_id)) > 0 )
        {
            $sub_children = $this->getSubPagesUntil($module_id);
           
            if (count($sub_children) > 0)
            {
                $children[] =
                [
                    'text' => ucfirst($page)."<id class='page hide'>{$page_id}</id>",
                    'icon' => 'fa fa-file font-green',
                    'children' => $sub_children
                ];
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
    private function getSubPagesUntil($module_id)
    {
        $sub_children = [];
        foreach($this->accessData->subPages as $sub)
        {
            if ( $sub->is_node )
            {
                $sub_children = $this->setSubPagesUntil($module_id,$sub->name,$sub->page_id);
            } else {
                $sub_children[] =
                [
                    'text' => ucfirst($sub->name)."<id class='page hide'>{$sub->page_id}</id>",
                    'icon' => 'fa fa-file font-green',
                    'children' => $this->setActions($sub->page_id)
                ];
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
            $actions[] = 
            [
                'text' => "<sysaction>".ucfirst($action['name'])."</sysaction><id class='action hide'>{$action['id']}</id>",
                'icon' => 'fa fa-gear',
                'state' => ['selected' => $this->setActionSelect($action['id'],$page_id)],
            ];
        }
        $actions[] = 
            [
                'text' => '<a href="javascrit:;" class="action_add_new">Add New</a>',
                'icon' => 'fa fa-gear',
                'state' => ['disabled'=>true],
            ];
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
}
