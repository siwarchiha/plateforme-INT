<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

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

    public function login(Request $request)
    {
        
        if(empty($request->email) || empty($request->password)){

            return response()->json(['error'=>'Email ou mot de passe ne peut pas etre vide!']);
        }          
        $user = User::where('email', $request->email)->first();        
        
        if(!$user){

            return response()->json(['error'=>'E-mail non enregistré, veuillez vous inscrire']);
        }
        // if(!$request->recaptcha){

        //     return response()->json(['error'=>'Veuillez compléter le recaptcha de google']);
        // }
        if(!\Hash::check($request->password, $user->password)){
            return response()->json(['error'=>'Email ou mot de passe ne correspondent pas','data'=>$user]);
        }
        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return response()->json(['success'=>'Connexion réussie','data' => $user]);
            
             
        }
        return response()->json(['error', 'Oops! Quelque chose s est mal passé !']);

    }

    public function logout(Request $request)
    {    
       Auth::logout();
       return redirect('/login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
