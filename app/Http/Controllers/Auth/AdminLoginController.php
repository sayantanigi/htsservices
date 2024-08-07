<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Redirect;

class AdminLoginController extends Controller
{
    protected $table = 'admins';
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('admin.signin', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) { //echo "HERE"; die;
            $data =  DB::table('admins')->where('email', $request->email)->get()[0];

            Session::put('userEmail', $data->email);
            Session::put('adminId', $data->id);

            return redirect()->route('admin-dashboard');
        }
        //$errors = new MessageBag(['loginerror' => ['Email and/or password invalid.']]);
        //return Redirect::back()->withErrors($errors)->withInput($request->only('email', 'remember'));
        //return back()->withInput($request->only('email', 'remember'));
        // $errors = new MessageBag(['loginerror' => ['Username & password mismatch.']]);

        return redirect()->route('admin')
                ->with('error','Username & password mismatch.');
    }
}
