<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:update_users'])->only(['edit','update']);
        $this->middleware(['permission:delete_users'])->only('destroy');
        $this->middleware(['permission:create_users'])->only(['create','store']);
        
    }
    
    public function index(Request $request)
    {
        $users=User::whereHasRole('admin')->when($request->search,function ($query)use ($request){
            return $query->where('first_name','like','%'.$request->search.'%')
            ->orWhere('last_name','like','%'.$request->search.'%');
        })->latest()->paginate(2);
        
        return view('dashboard.users.index',compact('users'));
    }

    
    public function create()
    {
        return view('dashboard.users.create');
    }

    
    public function store(Request $request)
    {
        
        $formField=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed|min:6',
            'permissions'=>'required|min:1',

        ]);

        $formField['password']=bcrypt($formField['password']);

        $image=$request->file('image');
        $image_name='';
        if($image){
            $image_name=$image->hashName();
            $image->storeAs('user_images',$image_name,'public_upload');
        }
        else{
            $image_name='default.png';
        }
        
        
        $formField['image']=$image_name;
        //dd($formField);
        $user=User::create($formField);
        //dd($user);
        $user->addRole('admin');
        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.users.index')->with('success',__('site.created_successfully'));


    }

    
    public function show(User $user)
    {
        //
    }

    
    public function edit(User $user)
    {
        return view('dashboard.users.edit',['user'=>$user]);
    }

    
    public function update(Request $request, User $user)
    {
        $formField=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required','email',Rule::unique('users')->ignore($user->id)],
            'permissions'=>'required|min:1',

        ]);

        //dd($formField);

        $image=$request->file('image');
        $image_name='';
        if($image){
            Storage::disk('public_upload')->delete('user_images/'.$user->image);
            $image_name=$image->hashName();
            $image->storeAs('user_images',$image_name,'public_upload');
            $formField['image']=$image_name;
        }
        
        
        
        //dd($formField);
        $user->update($formField);
        //dd($user);
       
        $user->syncPermissions($request->permissions);

        return redirect()->route('dashboard.users.index')->with('success',__('site.updated_successfully'));

    }

    
    public function destroy(User $user)
    {
        if($user->image!='default.png')
        {
            Storage::disk('public_upload')->delete('user_images/'.$user->image);
        }
        $user->delete();
     
        return redirect()->route('dashboard.users.index')->with('success', __('site.deleted_successfully'));
    }
}
