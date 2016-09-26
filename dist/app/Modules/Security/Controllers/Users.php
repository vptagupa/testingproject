<?php namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Services\UserServiceProvider as Services;
use Auth;
use Illuminate\Http\Request;
use Response;
use Permission;

class Users extends Controller {

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