<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{
    public function index()
    {
       
        $users= User::paginate(15);
        return view('admin.manage_users',compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // session()->flash('success', 'Su');
        return back()->with('success','User successfully Trashed');
    }

    public function trashedUser()
    {
        $trashed = User::onlyTrashed()->paginate(15);
        return view('admin.trashedUser',compact('trashed'));
    }
    
    public function permanentDelete($id)
    {
      $user =  User::onlyTrashed()->find($id);
      $user->forceDelete();
      return back()->with('success','User permanently deleted');
    }


    public function restoreUser($id)
    {
        User::onlyTrashed()->find($id)->restore();
        return back()->with('success','User restored successfully');

    }

    //directing to edit page
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.editUser',compact('user'));
    }

    //updating user
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request,[
            'name'=>'required',
            'username'=>'required',
            'email'=>'required | email|unique:users,id,' .$id,
           
        ]);

        $user->name = $request->name;
        $user->username=$request->username;
        $user->email=$request->email;
       
        if($request->password !== null){
            $user->password=bcrypt($request->password);
        }
       
        $user->save();
     

        return back()->with('success','User updated');
    }

    public function referralLog()
    {
        $users = User::whereNotNull('referrer_id')->with('referrer')->paginate(15);
        return view('admin.allReferralLog', compact('users'));
        
    }
    public function userReferralLog($id) 
    {
        $users = User::where('referrer_id',$id)->with('referrer')->paginate(15);
        return view('admin.userReferralLog',compact('users'));
    }


    public function userLogin(Request $request)
    {
       
        $user = User::where('id',$request->id)->first();
        
        if($request->id<0 && !$user){
            return back()->with('error','Invalid Id');
                
        }
        else
        {
            $this->validate($request,[
                'id'=>'required|numeric'
            ]);
              
          Auth::loginUsingId($request->id);
          return redirect()->route('home')->with('success','Logged in');
        }
        
    }
}
