<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

  
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  
    use AuthenticatesUsers;
  
    /**
     * Where to redirect users after login.
     *
     * @var string '/admin-dashboard';
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
    public function login(Request $request)
    {   
        $remember_me = $request->has('remember') ? true : false;
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user_cred = $request->only('email', 'password');

        $user_cred['status'] = 1;
        $user_cred['email_verified'] = 1;
     
        // if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
        if (Auth::attempt($user_cred, $remember_me)) {
            $request->session()->regenerate();
            $user = Auth::user();

            Session::put('user_id', $user->id);
            Session::put('user_fname', $user->fname);

            // return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
            // return redirect()->intended('dashboard')->withSuccess('Great! You have logged in successfully.');
            return redirect()->intended('dashboard');
        } else {

            return redirect()->route('login')
                ->with('error','You have entered an invalid email or password');
        }
          
    }

    // public function logout(Request $request)
    // {
    //     $userId =Session::get('userId');;
    //     $userData = array(
    //         'user_id'     =>$userId,
    //         'log_type'     =>"Logged Out",
    //         'msg'     =>"Successfully Logged Out",
    //         'created_at'   => date('Y-m-d H:i:s'),
    //   );
    //   DB::table('logs')->insert($userData);
    //     auth()->guard('web')->logout();
    //     \Session::flush();

    //     // return redirect()->route('login')->with('success', 'you are successfully logged out.');
    //     return redirect('login')->with('success', 'you are successfully logged out.');
    // }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('login')->with('success', 'you are successfully logged out.');
    }
}
