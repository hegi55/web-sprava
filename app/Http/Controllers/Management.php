<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\People;
use App\User;
use App\Group;
use App\Http\Requests;

use Auth;
use Illuminate\Validation\Rule;

class Management extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


/* Administrácia MAC Adries */

    public function index($message = "")
    {
        
        //Check if user is validated by administrator, if not return error
        if(Auth::user()->is_valid == false){
            $message = 'Nie ste validovaný užívateľ ! Kontaktujte Administrátora systému pre vašu validáciu. Bez validácie nie je možné vykonávať úpravy.';
            return view('not_valid',compact('message'));
        }else{
            $group = Auth::user()->group_id;

            //Get List of Peoples on group
            $data = People::where('group_id', $group)->get();

            return view('sprava', compact('data','message'));
        }
    }


    public function edit($id)
    {
        $people = People::find($id);
        $group = Auth::user()->group;

        $data = $people;

        if($people->group_id == $group->id){
            $message = "Úprava";
        }else{
            $message = "Nie je možné upraviť !";
        }

        return view('uprava', compact('data'));
    }


    public function delete($id)
    {
        $people = People::find($id);
    
        $group = Auth::user()->group;

        if($people->group_id == $group->id){
            $people->delete();
            $message = "Zmazané !";
        }else{
            $message = "Nezmazané !!!";
        }

        return $this->index($message);
    }

    public function add(Request $request, People $people)
    {

        $this->validate($request, [
            'name' => 'required',
            'doorway' => 'required',
            'note' => 'required',
            'mac' => [
                'required',
                'unique:peoples',
                'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/'
            ]
        ]);

        $people->mac = $request->mac;
        $people->name = $request->name;
        $people->doorway = $request->doorway;
        $people->note = $request->note;
        $people->group_id = Auth::user()->group->id;       

        $people->save();

        $message = "Pridané !";

        return $this->index($message);
    }

     public function store(Request $request)
     {
        $this->validate($request, [
            'name' => 'required',
            'doorway' => 'required',
            'note' => 'required',
            'mac' => [
                'required',
                    Rule::unique('peoples')->ignore($request->id, 'id'),
                'regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/'
            ]
        ]);

        // 'unique:peoples,'.$request->id,

        $people = People::find($request->id);
        $people->mac = $request->mac;
        $people->name = $request->name;
        $people->note = $request->note;
        $people->doorway = $request->doorway;
        $people->group_id = Auth::user()->group->id;

        $people->update();

        $message = "Upravené !";
        return $this->index($message);
    }


/* Administrácia Užívateľov ktorý môžu spravovať užívateľov (pridelovať MAC Adresy do Radiusu) */

    public function admin($message = "")
    {
        $users = User::all();
        $groups = Group::all();

        return view('admin', compact('users', 'groups' ,'message'));
    }   

    public function adminAddGroup(Request $request)
    {

        $this->validate($request, [
            'group_name' => 'required',
            'group_ip' => [
                'required',
                'unique:groups',
                'regex:/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/',
            'group_description' => 'required'
            ]
        ]);

        $group = new Group();
        $group->group_name = $request->group_name;
        $group->group_ip = $request->group_ip;
        $group->group_description = $request->group_description;

        $group->save();

        $message = "Vytvorená nová skupina $group->group_name s IP $group->group_ip. Popis skupiny: $group->group_description .";


        return $this->admin($message);
    }

    public function adminEditGroup($id){
        $group = Group::find($id);
        
        return view('admin_group_detail', compact('group'));    
    }

    public function adminEditGroupUpdate(Request $request){
        $this->validate($request, [
            'group_name' => 'required',
            'group_ip' => [
                'required',
                    Rule::unique('groups')->ignore($request->id, 'id'),
                'regex:/^(?:[0-9]{1,3}\.){3}[0-9]{1,3}$/',
            'group_description' => 'required'
            ]
        ]);

                /*
                    Zlozite:
                    Rule::unique('groups')->ignore($request->id)->where(function ($query) {
                        $query->where('id', 1);
                    }),
                */

        $group = Group::find($request->id);
        $group->group_name = $request->group_name;
        $group->group_ip = $request->group_ip;
        $group->group_description = $request->group_description;

        $group->save();

        $message = "Upravená skupina $group->group_name s IP $group->group_ip. Popis skupiny: $group->group_description .";

        return $this->admin($message);                
    }


    public function adminEditUser($id){
        $user = User::find($id);
        $groups = Group::all();

        return view('admin_user_detail', compact('user','groups'));
    }


    public function adminEditUserUpdate(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'is_valid' => 'required',
            'is_admin' => 'required',
            'group' => 'required'
        ]);

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_valid = $request->is_valid;
        $user->is_admin = $request->is_admin;
        $user->group_id = $request->group;
        $user->save();

        $message = "Užívateľ $user->name upravený !";

        return $this->admin($message);
    }

    public function adminDeleteUser($id){

        $user = User::find($id);

        if($user->is_admin == false){
            $user->delete();

            $message = "Užívatel $user->name bol zmazaný";
        }else{
            $message = "Nemôžem zmazať Admina...";
        }

        return $this->admin($message);
    }

}


