<?php

namespace App\Notifications;
use App\Notifications\Models\Inbox;
use App\Notifications\Models\Conversation;
use App\Notifications\Models\To;
use Request;
use Image;
use DB;

class Services {
	/**
	 * initialize construct
	 * @return void
	*/
	public function __construct() {
		$this->initializer();
	}
	/**
	 * get Notifications
	 * @return objects
	*/
	public function getUserNofifications() {
		return
		DB::table($this->inbox->table.' as i')
			->leftJoin($this->convo->table.' as c',
					'c.InboxID','=','i.InboxID'
				)
			->leftJoin($this->to->table.' as to',
					'to.InboxID','=','i.InboxID'
				)
			->leftJoin(userTable().' as u',
					'u.ID','=','i.UserIDFrom'
				);
	}

	/**
	 * update User Status to read
	 * @param Integer inbox
	 * @param Integer ToID
	 * @return Boolean
	*/
	public function setRead($InboxID,$ToID)
	{
		return $this->to
					->where('InboxID',$InboxID)
					->where('ToID',$ToID)
					->update([
							'IsRead' => '1'
						]);
	}
	/**
	 * create notification to send to
	 * @param Integer UserFrom
	 * @param Integer/Array UserTo
	 * @param String Subject
	 * @param String Content default empty
	 * @return Boolean
	*/
	public function createNotification($UserFrom, $UserTo, $Subject = '', $Content = '')
	{
		return $this->create($UserFrom, $UserTo, $Subject, $Content);
	}
	/**
	 * create message to send to
	 * @param Integer UserFrom
	 * @param Integer/Array UserTo
	 * @param String Subject
	 * @param String Content default empty
	 * @return Boolean
	*/
	public function createMessage($UserFrom, $UserTo, $Subject = '', $Content = '')
	{
		return $this->create($UserFrom, $UserTo, $Subject, $Content,2);
	}
	/**
	 * create inbox
	 * @param Integer UserFrom
	 * @param Integer/Array UserTo
	 * @param String Subject
	 * @param String Content default empty
	 * @param Integer Type default 1 as notification
	 * @return Boolean
	*/
	private function create($UserFrom, $UserTo, $Subject = '', $Content = '',$Type = '1')
	{
		$InboxDate = systemDate();
		$InboxBy = getUserID();

		$inbox = [
				'InboxTypeID' => $Type,
				'UserIDFrom' => $UserFrom,
				'Subject' => $Subject,
				'Content' => $Content,
				'InboxDate' => $InboxDate,
				'InboxBy' => $InboxBy
			];

		$inbox = $this->inbox->create($inbox);

	
		if ($inbox->ID) {

			//loop each user to insert
			if (is_array($UserTo)) {
				foreach($UserTo as $user) {
					$this->to
						->create([
								'InboxID' => $inbox->ID,
								'UserIDTo' => $user,
								'IsRead' => '0',
							]);
				}

				return true;
			} 
			
			//insert user
			$this->to
				->create([
						'InboxID' => $inbox->ID,
						'UserIDTo' => $UserTo,
						'IsRead' => '0',
					]);

			return true;
		}

		return false;
	}
	/**
	 * initialize objects instance
	 * @return void
	*/
	private function initializer()
	{
		$this->inbox = new Inbox;
		$this->convo = new Conversation;
		$this->to = new To;
	}
}
