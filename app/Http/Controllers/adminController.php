<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Hash;
use App\Models\FormSave;
use App\Models\FormHistoric;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Operateur;
use App\Models\Parametre;


use App\Rules\MatchOldPassword;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard');
    }
    public function profile()
    {
        $operateurs = Operateur::all();

        return view('pages.profile', compact('operateurs'));
    }
    
    public function userUpdate(Request $request, $id)
    {
       
        $admin = User::find($id);
        $requestData = $request->all();
        $requestData['password'] = \Hash::make($request->password);
        if($request->operateur_id != "0"){
            $requestData['operateur_id'] = (int)$request->nom_operateur;
        }elseif($request->operateur_id ){
            $requestData['operateur_id'] = (int)$request->nom_operateur;
        }
        $admin->update($requestData);
   
        // send mail 

        //$this->sendMailModif($request->name,$request->email,$request->password);
        
        return redirect()->route('profile')
                         ->with('success','Admin modifié avec succée!!');
        //return back();
    }
    public function admin()
    {
        return view('pages.admin');
    }
    // Send mail function 
    public function sendMailModif($username,$login, $mdp){

        $to = array($login);
        
        $sujet = 'Votre nouveau login et/ou votre mot de passe';
        
        $message = 'rien';

        $template = '<p>Cher/Chère '.$username.'</p> Vous êtes maintenant inscrit sur le portail d\'INTT. <br> Votre login est : '.$login.' <br> Votre mot de passe est : '.$mdp.' <br><br> Cordialement, <br> INTT';

        $data = array(
            'name' => $username,
            'email' => $login,
            'password' => $mdp
        );

        $mm = str_replace("{{name}}", $login, $template);
        $msg = str_replace("{{message}}", $message, $mm);
    
            \Mail::send(['html' => 'emails.example'], ['data' => $data], function ($message) use ($msg, $to, $sujet) {
                $message->from('noreply@elitecom.com.tn','INTT')->to($to)
                    ->subject($sujet);
                    // ->setBody($msg, 'text/html');
            });
            // emails.example  => resource/views/emails/example.blade.php 
            // Mail::send(['html' => 'emails.example'], [], function($message){
            //     message->from('fromMail'); // It's a must
            //     $message->to('myemail@gmail.com');
            //     $message->subject('Testing');
            // });
    }
    public function findAdmin($id)
    {
        $admin = User::find($id);
        //dd($admin);
        //return response()->json($admin);
        return view('pages.editAdmin', compact('admin'));

    }
    public function findOperateur($id)
    {
        $operateur = Operateur::find($id);
        //dd($admin);
        //return response()->json($admin);
        return view('pages.editOperateur', compact('operateur'));

    }
    public function adminUpdate(Request $request, $id)
    {
       
        $admin = User::find($id);
        $requestData = $request->all();
        $requestData['password'] = \Hash::make($request->password);
        if($request->operateur_id != "0"){
            $requestData['operateur_id'] = (int)$request->nom_operateur;
        }elseif($request->operateur_id ){
            $requestData['operateur_id'] = (int)$request->nom_operateur;
        }
        $admin->update($requestData);
   
        // checked
        $this->sendMailModif($request->name,$request->email,$request->password);
        
        return redirect()->route('admin')
                         ->with('success','Admin modifié avec succée!!');
        //return back();
    }
    public function operateurUpdate(Request $request, $id)
    {
       
        $operateur = Operateur::find($id);
        $requestData = $request->all();
        //$requestData['nom_operateur'] = $request->nom_operateur;

        // $dbop = Operateur::where('nom_operateur', $request->nom_operateur)->first();
     
        // if($dbop){
        //     return response()->json(['error'=>'Opérateur déjà enregistré.']);
        // }else{
           
        // }
        $operateur->update($requestData);
        
   
        // checked
       // $this->sendMailModif($request->name,$request->email,$request->password);
        
        return redirect()->route('operateur')
                         ->with('success','Opérateur modifié avec succée!!');
        //return back();
    }
    public function getUsers(Request $request)
    {
        $operateurs = Operateur::latest()->get();

        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nom_operateur', function($row){
                    $nomOp = Operateur::where('id',(int)$row->operateur_id)
                                        ->value('nom_operateur');
                    if($nomOp !="0"){
                        return $nomOp;
                    }else{
                        return "ADMIN";
                    }
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="edit btn btn-success btn-sm" href="admin/find/'.$row->id.'" id="editButton" data-admin="'.$row->id.'">Edit</a> 
                                  <a href="admin/delete/'.$row->id.'" onclick="return confirm(`Êtes-vous sûr de supprimer cet enregistrement ?`)" class="delete btn btn-danger btn-sm">Delete</a>
                                  <script>
                                        function editForm(event){
                                        event.preventDefault();
                                        console.log(event.target);
                                        $(".btnAdd").hide();
                                        $(".btnEdit").show();
                                        var data = event.target.getAttribute("data-admin");
                                        console.log(data);
                                        $.ajax({
                                            url:`/admin/find/${data}`,
                                            type:"GET",
                                            success: function(data){
                                                if(data){

                                                    var name = $("#name");
                                                    var email = $("#email");
                                                    var password = $("#password");
                                                    var role = $("#role");
                                                    var nom_operateur = $("#nom_operateur");
                                                   // var test = $(`input[name="test"]:checked`).val();

                                                    var form = $("#adminForm");

                                                    form.attr("action",`/admin/update/${data.id}`);

                                                    name.val(data.name);
                                                    email.val(data.email);
                                                    password.val(data.password);
                                                    role.val(data.role);
                                                    nom_operateur.val(data.nom_operateur);

                                                }
                                            }
                                        });
                                        $("#addContactModal").modal("hide");
                                            $("#editContactModal").modal("show");

                                    }
                                    </script>
                                  
                                  ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin', compact('operateurs'));
    }
    
    public function getOperateurs(Request $request)
    {
        $operateurs = Operateur::latest()->get();

        if ($request->ajax()) {
            $data = Operateur::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="operateur/find/'.$row->id.'" class="edit btn btn-success btn-sm" id="editButton" data-admin="'.$row->id.'">Éditer</a> <a href="/operateur/delete/'.$row->id.'" onclick="return confirm(`Êtes-vous sûr de supprimer cet enregistrement ?`)" class="delete btn btn-danger btn-sm">Supprimer</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.operateur', compact('opearteurs'));
    }
    public function operateur()
    {
        return view('pages.operateur');
    }
    public function Parametres()
    {
        
        $parametres = Parametre::latest()->get()->first();
        //$parametre = Parametre::find($id);

        return view('pages.parametre',compact('parametres'));

}

    public function uploadImage($image, $dir)
    {
        $image_name = $image->getClientOriginalName(); 
        $new_name = time().\Str::random().$image_name;
        $image->move($dir, $new_name);
        return $new_name;
    }
    public function parametreUpdate(Request $request, $id)
    {
        $parametres = Parametre::latest()->get()->first();
        //$parametre = Parametre::find($id);

        $image = $parametres->logo;
        if ($request->logo) {
            $dir = "storage/parametre/";
            $image =  $this->uploadImage($request->logo, $dir);
            $parametres->logo = $image;
            $parametres->save();
        }
        
        $requestData = $request->all();
        
        $requestData['logo'] =  $image;
       
   
        $parametres->update($requestData);
        $parametres->save();

        return view('pages.parametre',compact('parametres'));
    }
    public function operateurDelete($id){
        $operateur= Operateur::find($id);
        $operateur->delete();
        return back();
        //return response()->json(['success'=>'Opérateur supprimé avec succée!']);
    }
    public function adminDelete($id){
        $user= User::find($id);
        $user->delete();
        return back();
        //return response()->json(['success'=>'User supprimé avec succée!']);
    }
    public function operateurCreate(Request $request)
    {
        if(!$request->nom_operateur){ 
            return response()->json(['error'=>'Nom operateur doit être remplis avant de soumettre le formulaire']);
        }
        $dboperateur = Operateur::where('nom_operateur', $request->nom_operateur)->first();
     
        if($dboperateur){
            return response()->json(['error'=>'Opérateur déjà enregistré.']);
        }else{

        $requestData = $request->all();
   
        Operateur::create($requestData);
        }
        return response()->json(['success'=>'Opérateur enregisté dans la bd avec succée']);

    }
    
    public function adminCreate(Request $request)
    {
        // $requestData = $request->all();
   
        // User::create($requestData);

        if(!$request->name){
            return response()->json(['error'=>'Champs name ne peut pas etre vide']);
        }elseif (!$request->email) {
        return response()->json(['error'=>'Champs email ne peut pas etre vide']);
        }
        elseif (!$request->role) {
            return response()->json(['error'=>'Champs role ne peut pas etre vide']);
        }

        if($request->role =='1' ||  $request->role =='2'){
            $admin= new User;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->role = $request->role;
            $admin->operateur_id = 0;
            $admin->save();
            return response()->json(['success'=>'User enregisté dans la bd avec succé']);
        }else{
            //User::create($request->all());
            $admin= new User;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->role = $request->role;
            $admin->operateur_id = $request->operateur;
            $admin->save();
            return response()->json(['success'=>'User enregisté dans la bd avec succé']);
        }
       
    }
    public function passwordView()
    {
        return view('pages.profile');
    } 
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        //dd('Password change successfully.');
        $active_class ="active";
        return view('pages.profile',compact('active_class'));
    }



    public function FormCreate(Request $request)
    {
        if (!$request->name) {
            if(!$request->visibility) {
                if(!$request->id_fiche)
                {
                    if (!$request->rows )
                    {
                    return response()->json(['ErrorName'=>'Champs name ne peut pas etre vide','ErrorVisibility'=>'Champs visibility ne peut pas etre vide','ErrorFiche'=>'Champs fiche ne peut pas etre vide','ErrorForm'=>'Le formulaire ne peut pas etre vide']);
                    }
                
                    else
                    {
                        return response()->json(['ErrorName'=>'Champs name ne peut pas etre vide','ErrorVisibility'=>'Champs visibility ne peut pas etre vide','ErrorFiche'=>'Champs fiche ne peut pas etre vide']);

                    }
                }
                else{
                    return response()->json(['ErrorName'=>'Champs name ne peut pas etre vide','ErrorVisibility'=>'Champs visibility ne peut pas etre vide']);

                    }
            }
            else
            {
                return response()->json(['ErrorName'=>'Champs name ne peut pas etre vide']);
            }
        }
         elseif (!$request->visibility){
            if (!$request->id_fiche){
                if (!$request->rows ){
                
                return response()->json(['ErrorVisibility'=>'Champs visibility ne peut pas etre vide','ErrorFiche'=>'Champs fiche ne peut pas etre vide','ErrorForm'=>'Le formulaire ne peut pas etre vide']);
                }
                else 
                {
                    return response()->json(['ErrorVisibility'=>'Champs visibility ne peut pas etre vide','ErrorFiche'=>'Champs fiche ne peut pas etre vide']);

                }
            }
            else{
                return response()->json(['ErrorVisibility'=>'Champs visibility ne peut pas etre vide']);

            }
          }


            elseif (!$request->id_fiche)
            {
                if (!$request->rows ){
                return response()->json(['ErrorFiche'=>'Champs fiche ne peut pas etre vide','ErrorForm'=>'Le formulaire ne peut pas etre vide']);
                }
                else{
                    return response()->json(['ErrorFiche'=>'Champs fiche ne peut pas etre vide']);
                }
            }
            elseif (!$request->rows )
            {
                return response()->json(['ErrorForm'=>'Le formulaire ne peut pas etre vide']);

            }
          
        $requestData = $request->all();
        FormSave::create($requestData);
        return response()->json(['success'=>'Form enregisté dans la bd avec succée']);
       
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getForm()
    {
     //return FormSave::where('user_id', '=', $this->user_id)->get();

     
    }

    public function show($id)
    {
        // $form=FormSave::find($id);
        // return view('formbuilder.my_submissions.show',compact('form'));
       // $submission=DB::table('form_saves')->where('id_fiche','=', $id)->get();
       $submission=DB::table('form_saves')->find($id);
       //$submission=DB::table('form_historics')->find($form->id);
        return view('formbuilder.my_submissions.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $submission=DB::table('form_saves')->find($id);
        $fiches=DB::table('fiches')->get();
        return view('formbuilder.my_submissions.edit', compact('submission','fiches','id'));

    }

    public function historic($id)
    {
        //
        $submissions=DB::table('form_historics')->where('id_form', $id)->get();
        return view('formbuilder.my_submissions.showHistoric', compact('submissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function FormUpdate(Request $request)
    {
        $requestData = $request->all();
        FormHistoric::create($requestData);
        return response()->json(['success'=>'Form Historic enregisté dans la bd avec succée']);
    }

    
}
