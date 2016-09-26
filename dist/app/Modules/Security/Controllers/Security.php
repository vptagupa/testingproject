<?php
namespace App\Modules\Security\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Security\Services\Access\Access;
use App\Modules\Security\Services\Access\Accounts;
use App\Modules\Security\Models\Access\Access as UserAccess;
use App\Modules\Security\Models\Access\Actions;
use Response;
use Request;
use Permission;

class Security extends Controller
{
    private $media =
    [
        'Title'         => 'Privileges',
        'Description'   => 'General Settings',
        'js'            => ['Security/access','Security/tree','Security/security'],
        'init'         => ['SECURITY.init()'],
        'plugin_js'        => [
                            'jstree/dist/jstree.min','bootbox/bootbox.min',
                            'bootstrap-select/bootstrap-select.min',
                       ],
        'plugin_css'       => ['jstree/dist/themes/default/style.min','bootstrap-select/bootstrap-select.min'],
    ];

    private $url = 
    [
        'form' => 'form',
        'page'  => 'security/access/'
    ];

    public function index()
    {
        $this->initializer();
        if ($this->permission->has('read')) {
            return view('layout',array('content'=>view('Security.Views.access.index')->render(),'url'=>$this->url,'media'=>$this->media));
        }
        return view(config('app.403'));
    }

    public function actions()
    {
        $response = 'No Event Selected';
        if (Request::ajax())
        {
            $this->initializer();
            $response = ['error'=>true,'message'=>'Permission Denied!'];
            switch(Request::get('event'))
            {
                case 'save':
                    if ($this->permission->has('add')) {
                        $data['page_id'] = Request::get('page');
                        $data['name'] = Request::get('action');
                        $data['slug'] = str_replace([' ','_'],'-',strtolower(str_replace("'","",Request::get('action'))));
                        $data['sort'] = $this->actions->where('page_id',Request::get('page'))->count()+1;
                        $response = Response::json(['error'=>false,'message'=>'Succesfully Save','action_id'=> $this->actions->create($data)->action_id]);
                    }
                    break;
                case 'update':
                    if ($this->permission->has('edit')) {
                        $data['name'] = Request::get('action');
                        $response = Response::json(['error'=>false,'message'=>'Succesfully Update','action_id'=>$this->actions->where('action_id',Request::get('action_id'))->update($data)]);
                    }
                    break;
                case 'autoSaveAction':
                     $data = [
                        'link_id' => Request::get('account'),
                        'page_id' => Request::get('page'),
                        'action_id' => Request::get('action')
                    ];
                    if ($this->isAccountGroup()) {
                        $data['link_type'] = 'group';
                        if ($this->UserAccess->where($data)->count() <= 0) {
                            $response = $this->UserAccess->insert($data);
                        }
                    } else {
                        $data['link_type'] = 'account';
                        if ($this->UserAccess->where($data)->count() <= 0) {
                            $response = $this->UserAccess->insert($data);
                        }
                    }
                    $response = $response ? successSave() : errorSave();
                break;
                case 'autoUncheckAction':
                    if ($this->isAccountGroup()) {
                        $response = $this->UserAccess->where([
                            'link_type' => 'group',
                            'link_id' => Request::get('account'),
                            'page_id' => Request::get('page'),
                            'action_id' => Request::get('action')
                        ])->delete();
                    } else {
                        $response = $this->UserAccess->where([
                            'link_type' => 'account',
                            'link_id' => Request::get('account'),
                            'page_id' => Request::get('page'),
                            'action_id' => Request::get('action')
                        ])->delete();
                    }
                    $response = $response ? successSave() : errorSave();
                break;
            }
            return $response;
        }   
        return $response;
    }

    public function access()
    {
        $response = 'No Event Selected';
        if (Request::ajax())
        {
            $this->initializer();
            switch(Request::get('event'))
            {
                case 'getGroupAccess':
                    $this->access->AccountAccess('getGroupAccess',trimmed(Request::get('id'),true));
                    $response =  Response::json($this->access->treeData());
                    break;
                case 'getUserAccess':
                    $this->access->AccountAccess('getUserAccess',trimmed(Request::get('id'),true));
                    $response = Response::json($this->access->treeData());
                    break;
                case 'save':
                    $response = ['error'=>true,'message'=>'Permission Denied!'];
                    if ($this->permission->has('add')) {
                        $ids = [];
                        $access = json_decode('['.Request::get('access').']',true);
                        foreach($access as $action)
                        {
                            $data = array(
                                'link_type' => Request::get('account_type'),
                                'link_id' => Request::get('account'),
                                'page_id' => $action['page'],
                                'action_id' => $action['action']
                            );

                            $id = $this->UserAccess->select('index_id')->where($data)->get();
                            $ids[]  = (count($id)<=0) ? $this->UserAccess->create($data)->index_id : $id[0]->index_id;
                        }
                        $this->UserAccess->whereNotIn('index_id',$ids)->where(['link_id'=>Request::get('account'),'link_type'=>Request::get('account_type')])->delete();
                        $response = Response::json(['error'=>false,'message'=>'Succesfully save!']);
                    }
                    break;
            }
        }   
        return $response;
    }

    public function accounts()
    {   
        $response = 'No Event Selected';
        if (Request::ajax())
        {
            $this->initializer();
            switch(Request::get('event'))
            {
                case 'loadAccounts':
                    $response = Response::json($this->accounts->treeData());;
                    break;
                case 'loadAccess':
                    $response = Response::json($this->access->treeData());
                    break;
            }
        }   
        return $response;
    }

    private function isAccountGroup() 
    {
        if (strtolower(Request::get('account_type')) == 'group') {
            return true;
        }
        return false;
    }

    private function initializer()
    {
        $this->access = new Access;
        $this->UserAccess = new UserAccess;
        $this->accounts = new Accounts;
        $this->actions = new Actions;
        $this->permission = new Permission('users');
    }
}
