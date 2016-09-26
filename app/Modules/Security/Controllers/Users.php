<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Services\UserServiceProvider as Services;
use Auth;
use Illuminate\Http\Request;
use App\Modules\Security\Controllers\Auth\AuthenticatesUsers;
use Response;
use Permission;

class Users extends Controller {

	use AuthenticatesUsers;

	private $views = 'Security.Views.users.';
	
	public function __construct() 
	{
		$this->initialize();
	}

	/**
     * initialize users content index
     *
     * @return html
     */
	public function index()
	{
		return view($this->views.'index')->render();
	}

	/**
     * get all users
     *
     * @return array
     */
	public function getData()
	{
		return
			success(['masterlist'=>$this->services->getData()]);
	}

	/**
     * get all User Roles
     *
     * @return array
     */
	public function getRoles()
	{
		return
			success(['data'=>$this->services->getRoles()]);
	}

	/**
     * get all User Levels
     *
     * @return array
     */
	public function getlevels()
	{
		return
			success(['data'=>$this->services->getlevels()]);
	}

	/**
     * get all User Positions
     *
     * @return array
     */
	public function getPositions()
	{
		return
			success(['data'=>$this->services->getPositions()]);
	}

	/**
     * get all Departments
     *
     * @return array
     */
	public function getDepartments()
	{
		return
			success(['data'=>$this->services->getDepartments()]);
	}

	/**
     * create new user account
     *
     * @return array
     */
	public function store()
	{
		return
			$this->services->store();
	}

	/**
     * update user account
     *
     * @return array
     */
	public function update($id)
	{
		return
			$this->services->update($id);
	}

	/**
     * delete user account
     *
     * @return array
     */
	public function delete($id)
	{
		return
			$this->services->delete($id);
	}

	/**
     * edit user account
     *
     * @return array
     */
	public function edit($id)
	{
		return
			$this->services->edit($id);
	}

	private function initialize()
	{
		$this->services = new Services;
	}

}