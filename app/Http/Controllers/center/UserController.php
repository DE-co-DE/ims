<?php namespace App\Http\Controllers\center;

use App\Http\Requests;
use App\Helpers\Perm;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Batch;
use App\Course;
use App\User;
use App\CourseBatch;
use DB;
use Validator;
use Redirect;
class UserController extends Controller {
	
	/*
	@Index page
	*/	
	public function index()
	{
		if (Auth()->check() && Perm::check("View Courses") || Perm::check("Add Courses") || Perm::check("Edit Courses") || Perm::check("Delete Courses"))
		{
			if(Perm::check("View Courses"))
			{
				$res = User::orderBy("id",'DESC')->get();
			}
			else
			{
				$res = [];
			}
			
			return View('center.users.index')->with('res',$res);
			
		}
		else
		{
			return Redirect::to('login#Login')->with('loginError', 'Please Login ! For Access This Page');
		}
	}
	
	/*
	@Add new page
	*/	
	public function add()
	{
		if (Auth()->check() && Perm::check("Add Courses"))
		{						
		
			$perms=DB::table("permissions")->get();
			return View('center.users.add')->with('perms',$perms);			
		}
		else
		{
			return Redirect::to('login#Login')->with('loginError', 'Please Login ! For Access This Page');
		}
	}
	
	/*
	@Add new page.Save data in DB
	*/	
	public function _add(Request $Request)
	{
		if (Auth()->check() && Perm::check("Add Courses"))
		{						
			//Validation
			 $validator = Validator::make($Request->all(), [
				
				'name' 		   => 'required|max:50',				
				'username'  => 'required|max:50',
				'password'  => 'required|max:50',	
				'permissions'  => 'required|max:50',
							
			]);
			
			if($validator->fails())
			{
				return redirect('center/users/add')->withErrors($validator)->withInput();
			}
			else
			{
				$data = new User;
				$data->person_name 		= $Request->get('name');
				$data->user_name	= $Request->get('username');
				$data->email 			= $Request->get('email');
				$data->mobile	= $Request->get('mobile');
				$data->status 		= $Request->get('status');
				$data->password 		= bcrypt($Request->get('password'));
				$data->shw_password 	= $Request->get('password');
				$data->perm 	= json_encode($Request->get('permissions'));
				$data->save();

				
				
				//capture user activity
				$this->activity("Add New User - ".$Request->get('name'));
				
				return Redirect::to('center/users')->with('message', 'Saved Successfully');
			}				
		}
		else
		{
			return Redirect::to('login#Login')->with('loginError', 'Please Login ! For Access This Page');
		}
	}
	
	/*
	@Edit Page
	*/	
	public function edit($id)
	{
		if (Auth()->check() && Perm::check("Edit Courses"))
		{						
			$res = User::find($id);
			
			$perms=DB::table("permissions")->get();

							
			return View('center.users.edit')->with(compact('res','perms'));						
		}
		else
		{
			return Redirect::to('login#Login')->with('loginError', 'Please Login ! For Access This Page');
		}
	}
	
	/*
	@edit page, Save data in DB
	*/	
	public function _edit(Request $Request,$id)
	{
		if (Auth()->check() && Perm::check("Edit Courses") )
		{						
								
			//Validation
		
			$validator = Validator::make($Request->all(), [
				
				'name' 		   => 'required|max:50',				
				'username'  => 'required|max:50',
				'password'  => 'required|max:50',
							
			]);
			if($validator->fails())
			{
				return redirect('center/users/edit/'.$id)->withErrors($validator)->withInput();
			}
			else
			{
				$data = User::find($id);
				$data->person_name 		= $Request->get('name');
				$data->user_name	= $Request->get('username');
				$data->email 			= $Request->get('email');
				$data->mobile	= $Request->get('mobile');
				$data->status 		= $Request->get('status');
				$data->password 		= bcrypt($Request->get('password'));
				$data->shw_password 	= $Request->get('password');
				$data->perm 	= json_encode($Request->get('permissions'));
				$data->save();

			
				
				//capture user activity
				$this->activity("Update User - ".$Request->get('name'));
				
				return Redirect::to('center/users')->with('message', 'Saved Successfully');
			}				
		}
		else
		{
			return Redirect::to('login#Login')->with('loginError', 'Please Login ! For Access This Page');
		}
	}

	/*
	@Delete Page
	*/	
	public function delete($id)
	{
		if (Auth()->check() && Perm::check("Delete Courses"))
		{						
			
		
			$user=User::find($id);
			$this->activity("Delete User - ".$user->person_name);

			User::where('id',$id)->delete();

			
			return Redirect::to('center/users')->with('message', 'Deleted Successfully');
							
		}
		else
		{
			return Redirect::to('login#Login')->with('loginError', 'Please Login ! For Access This Page');
		}
	}
	

}
