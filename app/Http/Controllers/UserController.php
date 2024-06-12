<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\User;
use App\Role;
Use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $roles;

    public function __construct() 
    {
        $this->roles = Role::pluck('role_name', 'id');
    }

    public function index(){

        $roles = $this->roles;

        if(\request()->ajax()){
            $data = User::with(['role_users.roles'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="'.url('users/edit/'.encrypt($row->id)).'" class="edit btn btn-success btn-sm">Edit</a> <a href="'.url('users/delete/'.$row->id).'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->addColumn('roles', function($row){
                    $roles = $row['role_users']['roles']['role_name'];
                    return $roles;
                })
                ->addColumn('email_verified_at', function($row){
                    $roles = $row['email_verified_at'];
                    return $roles;
                })
                ->rawColumns(['action', 'roles', 'email_verified_at'])
                ->make(true);
        }
        return view('users.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $user = User::create([
           'name' => $request['name'],
            'phone_number' => $request['phone_number'],
            'address' => $request['address'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'email_verified_at' => Carbon::now(),
        ]);

        $user->role_users()->create(['role_id' => $request['role']]);
        return redirect()->back()->withSuccess('Account Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $roles= $roles = $this->roles;

        $user = User::find(decrypt($id));
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = User::find($id);
        $user->update($request->all());
        $user->role_users()->update(['role_id' => $request['role']]);
        
        return redirect()->back()->withSuccess('Account Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id){

        $user = User::find($id);
        $user->delete();
        return redirect()->back()->withSuccess('Account Successfully Added!');
    }
}
