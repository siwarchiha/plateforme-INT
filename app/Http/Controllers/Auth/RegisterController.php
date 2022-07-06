<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function sendMail($username,$login, $mdp)
    {

        $to = array($login);
        //Make a Data Array
        $data = array(
            'name' => $username,
            'email' => $login,
            'password' => $mdp
        );
        $sujet = 'Votre login et votre mot de passe';
      
        $message = 'rien';
    
        $template = '<p>Cher/Chère '.$username.',</p> Vous êtes maintenant inscrit sur le portail d\'INTT. <br> Votre login est : '.$login.'<br> Votre mot de passe est : '.$mdp.' <br><br> Cordialement, <br> INTT';
        
        $mm = str_replace("{{name}}", $login, $template);
        $msg = str_replace("{{message}}", $message, $mm);
    
            \Mail::send(['html' => 'emails.example'], ['data' => $data], function ($message) use ($msg, $to, $sujet) {
                $message->from('noreply@elitecom.com.tn','INTT')->to($to)
                    ->subject($sujet);
                 //   ->setBody($msg, 'text/html');
            });
    }
    public function register(Request $request)
    {   
        if(!$request->name || !$request->email || !$request->role){ 
            return response()->json(['error'=>'Tous les champs doivent être remplis avant de soumettre le formulaire']);
        }
        $dbuser = User::where('email', $request->email)->first();
     
        if($dbuser){
            return response()->json(['error'=>'E-mail déjà enregistré.']);
        }else{
           // return response()->json(['error'=>$request->all()]);
        
            $admin= new User;
            $admin->name = $request->name;
            $admin->email = $request->email;
            //$admin->password = \Hash::make($request->password);
            $admin->password = null;
            $admin->role = $request->role;
            $admin->operateur_id = (int)$request->nom_operateur;
            $admin->save();

           $this->sendMail($request->name,$request->email,$request->password);
     

        return response()->json(['success'=>'Inscription réussi']);
        }

    }
}
