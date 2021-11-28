<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Validation\Rule;

use App\Models\Branch;
use App\Models\Project;


use Illuminate\Support\Facades\Mail;

use App\Mail\SendEmployeeInfo;



class EmployeeController extends Controller
{

    public function __construct()
    {
        //CRUD => users permission to access only have function that matched
        //ana kda bamn3 users from url access
        $this->middleware(['permission:read_employees'])->only('index');
        $this->middleware(['permission:create_employees'])->only('create');
        $this->middleware(['permission:update_employees'])->only('edit');
        $this->middleware(['permission:delete_employees'])->only('destroy');
    }

    public function index(Request $request)
    {
        //remove super_admin from search
        $employees=User::whereRoleIs('employee')->when($request->search, function($query) use($request){//why use use($request)? to access request from this outside scope
                return $query->where('firstName','like','%'.$request->search.'%')
                             ->orWhere('lastName','like','%'.$request->search.'%');

          })->latest()->paginate(5);


        return view('dashboard.employees.index',compact('employees'));
    }


    public function create()
    {
        $branches= Branch::all();
        $projects=Project::all();

        return view('dashboard.employees.create',compact('branches','projects'));

    }

    public function store(Request $request)
    {
        //Dump and Die => dd()
        //dd($request->all());
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
             'project_id'=>'required',
             'branch_id'=>'required',
            'email'=>'required|unique:users',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions'=>'required|min:1',

        ]);

        //dd($request->all());

        $request_data=$request->except(['password','password_confirmation','permissions','image']);
        $request_data['password']=bcrypt($request->password);

        if($request->image)
        {
            // create instance
            Image::make($request->image)
                  ->resize(300, null, function ($constraint) {   // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $constraint->aspectRatio();
                   })->save(public_path('uploads/users_images/'.$request->image->hashName()));
            //ready to store image of name after hashName()
            $request_data['image']=$request->image->hashName();
        }

      // dd($request_data);
        $employee=User::create($request_data);

      //  dd($request_data);

        $employee->attachRole('employee');//get this from laratrust_seeders.php


        $employee->syncPermissions($request->permissions);//add this in db link between users and roles


        $data = array(

            'id'=>$employee->id,
            'user_firstName'=>$employee->firstName,
            'user_lastName'=>$employee->lastName,
            'project'=>$employee->project->title,
            'branch'=>$employee->branch->title,
            'email'=>$employee->email,

        );
        
        Mail::to($employee->email)->send(new SendEmployeeInfo($data));
        // try {
        //     Mail::to($employee->email)->send(new SendEmployeeInfo($data));
        // } catch (\Exception $e) {
        //     session()->flash('success', __('site.added_successfully'));
        //     return redirect()->route('dashboard.employees.index');
        // }





        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.employees.index');
    }





    public function edit(User $employee)
    {

        $branches= Branch::all();
        $projects=Project::all();

        return view('dashboard.employees.edit',compact('employee','branches','projects'));

    }

    public function update(Request $request, User $employee)
    {
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'required',
            'project_id'=>'required',
            'branch_id'=>'required',
            'email'=>['required',Rule::unique('users')->ignore($employee->id)],//search on all users m3da user->id da
            'image'=>'image',
            'permissions'=>'required|min:1',
        ]);

        $request_data=$request->except(['permissions','image']);

        if($request->image)
        {
            if($employee->image != 'default.png')
            {
                 //public_uploads that custom added on config/filessystem.php
                 Storage::disk('public_uploads')->delete('/users_images/'.$employee->image);
            }

            // create instance
            Image::make($request->image)
                    ->resize(300, null, function ($constraint) {   // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $constraint->aspectRatio();
                    })->save(public_path('uploads/users_images/'.$request->image->hashName()));
            //ready to store image of name after hashName()
            $request_data['image']=$request->image->hashName();
        }
        $employee->update($request_data);

        $employee->syncPermissions($request->permissions);//add this in db link between users and roles
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.employees.index');
    }


    public function destroy(User $employee)
    {
        if($employee->image != 'default.png')
        {
            //public_uploads that custom added on config/filessystem.php
            Storage::disk('public_uploads')->delete('/users_images/'.$employee->image);
        }
        $employee->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.employees.index');

    }


}
