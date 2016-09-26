<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Modules\Security\Controllers\Auth\RedirectsUsers;
use Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, RedirectsUsers;

    public function __construct()
    {	
    	if (!Auth::check()) {
    		if (Request::ajax()) {
	    		return [
	    			'login' => false
	    		];
    		} else {
    			return redirect($this->redirectLoginPath());
    		}
    	}
    }
}
