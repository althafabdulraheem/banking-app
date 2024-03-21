<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function register_submit(Request $request)
    {
        $request->validate(['email'=>'required|unique:users,email|email',
                            'name'=>'required',
                            'password'=>'required']);
        
        $data=$request->except('_token');
        $insert=User::create($data);
        if($insert)
        {
            auth()->login($insert);
            return redirect('/home');
        }
        else{
            return redirect()->back()->withError('something went wrong');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate(['email'=>'required|exists:users,email',
        'password'=>'required']);
        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('/home');
        }
        else{
           
            return redirect()->back()->withError('Invalid user credentials');

        }

    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
