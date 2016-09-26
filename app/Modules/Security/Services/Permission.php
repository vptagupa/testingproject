<?php
namespace App\Modules\Security\Services;
use DB;
use App\Modules\Security\Models\Access\Access;
class Permission
{   
    /**
     *  init page
     *
     * @var public string
     */
    public $page;

    /**
     *  init page
     *
     * @var private string
     */
    private $actions;

    /**
     *  initialize contruct
     *
     * @var string
     */
    public function __construct($page)
    {
        $this->page = $page;
        $this->setPermission();
    }

    /**
     * check property access if exists
     *
     * @param $action string
     * @return boolean
     */

    public function has($action)
    {
        return (property_exists($this,$action)) ? $this->$action : false;
    }

    /**
     * set and load permission access
     *
     * @property
     */
    private function setPermission()
    {
        foreach($this->getAccess() as $action)
        {
            $this->setActions($action);
        }
    }

    /**
     *  get Access
     *
     * @return array
     */
    private function getAccess()
    {
        return $this->actions = DB::select("call spPermission('".getUserName()."','".$this->page."')");
    }

    /**
     *  set action
     *
     * @param $actions string
     * @return string
     */
    private function setActions($actions)
    {
        $action = $actions->slug;
        $this->$action = $actions->slug;
    }

    /**
     *  initialize variable
     *
     * @var Class
     */
    private function initializer()
    {
        $this->access = new Access;
    }
}
