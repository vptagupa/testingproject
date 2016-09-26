<?php
namespace App\Modules\Security\Services;
use App\Modules\Security\Services\Users\Validation;
use App\Modules\Security\Services\Users\Repository;
use App\Modules\Security\Models\Users\User as UserModel;
use App\Modules\Security\Services\Password\Set as SetPswd;
use Request;
use Mail;
use Sys;
use DB;

Class UserServiceProvider {

	/**
     * initialize construct
     *
     * @return void
     */
	public function __construct()
	{	
		$this->user = new UserModel;
		$this->valid = new Validation;
		$this->pswd = new SetPswd;
		$this->repo = new Repository;
	}

	/**
     *  create new user account
     *
     * @return array
     */
	public function store()
	{	
		$response = ['error' => true];
		if (!$this->valid->save(Request::all())->fails()) {
			$this->user->create(
					assertCreated(
							$this->repo->getPostSave()
						)
				);
			return success(['message'=>'Successfully Created new Account!']);
		}

		return error(['message'=>getErrorMessages($this->valid->save(Request::all())->errors()->getMessages())]);
	}

	/**
     *  update user account
     *
     * @return array
     */
	public function update($id)
	{	
		$response = ['error' => true];
		if (!$this->valid->update(Request::all())->fails()) {
			$this->user
					->where('id',$id)
					->update(
						assertModified(
							$this->repo->getPostUpdate()
						)
					);
			return success(['message'=>'Successfully Updated Account!']);
		}

		return error(['message'=>getErrorMessages($this->valid->update(Request::all())->errors()->getMessages())]);
	}

	/**
     *  delete  user account
     *
     * @var key
     * @return array
     */
	public function delete($id)
	{	
		if ($id) {
			if ($this->user->where('id',$id)->delete()) {
				return success(['message'=>'Successfully deleted user Account!']);
			}
		}
		return error(['message'=>'Failed to delete user!']);
	}

	/**
     *  edit  user Data
     *
     * @return array
     */
	public function edit($id)
	{
		return
			$this->user
				->select([
						'id',
						'user_id',
						'gender',
						'email',
						'mobile_no',
						'tel_no',
						'first_name',
						'last_name',
						'middle_name',
						'g.name as group',
						DB::raw("concat(last_name,',',first_name,' ',middle_name) as name")
					])
				->leftJoin('user_group as g','g.index_id','=','group_id')
				->where('id',$id)
				->first();
	}

	/**
     *  Get all Users Data
     *
     * @return array
     */
	public function getData()
	{
		return
			$this->user
				->select([
						'id',
						'user_id',
						'gender',
						'email',
						'mobile_no',
						'tel_no',
						'last_login',
						'g.name as group',
						DB::raw("concat(last_name,',',first_name,' ',middle_name) as name")
					])
				->leftJoin('user_group as g','g.index_id','=','group_id')
				->get();
	}

	/**
     *  Get all User Roles
     *
     * @return array
     */
	public function getRoles() 
	{
		return 
			\App\Modules\Setup\Models\Group::select(['index_id as id','name as role'])->get();
	}

	/**
     *  Get all User Level
     *
     * @return array
     */
	public function getLevels() 
	{
		return 
			\App\Modules\Setup\Models\Level::select(['index_id as id','name as level'])->get();
	}

	/**
     *  Get all User Positions
     *
     * @return array
     */
	public function getPositions() 
	{
		return 
			\App\Modules\Setup\Models\Position::select(['index_id as id','name as position'])->get();
	}

	/**
     *  Get all Departments
     *
     * @return array
     */
	public function getDepartments() 
	{
		return 
			\App\Modules\Setup\Models\Department::select(['index_id as id','name as department'])->get();
	}


}	
?>