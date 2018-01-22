<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\User;
use Illuminate\Http\Request;

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
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }


    public function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email', 
            'password' => 'required',
        ]);
        if (Auth::validate(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/login')
                ->withInput($request->only('email', 'remember'))
                ->withErrors('Your account is Inactive or not verified');
        }
        if ($user = User::where('email',$request->email)->where('password',$request->password)->first()){
                Auth::login($user);
                if($user->role == 'dev'){
                    \Session::put('id_user',$user->id_user);
                    \Session::put('nome',$user->name);
                    return redirect('index');
                }elseif($user->role == 'ges'){
                    \Session::put('id_user',$user->id_user);
                    \Session::put('nome',$user->name);
                    return redirect('index');
                }
                
        }
        return redirect('/login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'Incorrect email address or password',
            ]);
    }
}
