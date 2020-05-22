<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
    	$users = User::where('role', '!=', 'admin')->orderBy('name')->paginate(20);
    	return view('backend.user.index')->with('users',$users);
    }

    public function create()
    {
    	return view('backend.user.create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
            'status' => 'required'
    	]);
    	$data = [
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => bcrypt($request->password),
    		'status' => $request->status
    	];
    	User::create($data);
    	request()->session()->flash('success','User successfully added');
    	return redirect()->route('user.index');
    }

    public function edit($id)
    {
    	$user = User::find($id);
    	if(!$user)
    	{
    		request()->session()->flash('error','user not found');
            return redirect()->route('user.index');
    	}
    	return view('backend.user.edit')->with('user', $user);
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
    		'name' => 'required',
    		'email' => 'required',
    		'password' => 'sometimes',
            'status' => ''
    	]);
    	$user = User::find($id);
    	if(!$user)
    	{
    		request()->session()->flash('error','user not found');
            return redirect()->route('user.index');
    	}
    	$password = $user->password;
    	if($request->password)
    	{
    		$password = bcrypt($request->password);
    	}
    	$data = [
    		'name' => $request->name,
    		'email' => $request->email,
    		'password' => $password,
            'status' => $request->status
    	];
    	User::find($id)->update($data);
    	request()->session()->flash('success','User successfully updated');
    	return redirect()->route('user.index');
    }

    public function destroy($id)
    {
    	$user = User::find($id);
        if(!$user)
    	{
    		request()->session()->flash('error','user not found');
            return redirect()->route('user.index');
    	}
        $user->delete();
    	request()->session()->flash('success','User successfully deleted');
        return redirect()->route('user.index');
    }
}
