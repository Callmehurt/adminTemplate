<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;


class RegisterController extends Controller
{
    public function index(){
        return view('admin.pages.register');
    }

    public function register(Request $request){
        try{
            $this->validate($request, [
                'fullname' => ['required', 'max:100'],
                'email' => ['required'],
                'password' => ['required'],
            ]);

            $register = User::create([
                'name' => $request->input('fullname'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            $register->attachRole('admin');
            if($register){
                return back()->with('success', 'User Created Successfully');
            }else{
                return back()->with('error', 'Something went wrong. Please try again!');
            }
        }catch (Exception $exception){
            session()->flash('error','EXCEPTION'.$exception->getMessage());
            return back();
        }

    }
}
