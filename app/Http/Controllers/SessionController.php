<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\SessionRequest;
use App\Session;
use App\Reponse;
use App\User_sessions;
use App\Formateur;
use App\Salle;
// use App\Participant;
use App\User;
use App\Cour; 
use App\Http\Requests;
use Carbon\Carbon; 
use Mail;

class SessionController extends Controller
{
    public function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

    public function index(Request $request){
        $per_page = $selected = 10;
        if( isset($request->per_page) && $request->per_page != "all" ){
            $per_page = $request->per_page;
            $selected = $per_page;
        }else if(isset($request->per_page) && $request->per_page == "all"){
            $per_page = 500;
            $selected = "all";
        }
        $sessions = Session::orderBy('id', 'desc')->paginate($per_page);
        return view('sessions.index', [
            'results'   =>$sessions,
            'selected'  =>$selected,
        ]);
    }

    public function create(){
        ob_start();
        $cours = Cour::all();
        $formateurs = Formateur::all();
        $salles = Salle::all();
        $participants = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'collaborateur');
        })->get();
        echo view('sessions.create', [
            'cours'=> $cours,
            'formateurs'=> $formateurs,
            'salles'=> $salles,
            'participants'=> $participants,
        ]);
        $content = ob_get_clean();
        return ['title' => 'Ajouter une session', 'content' => $content];
    }

    public function store(Request $request){
        $start = Carbon::createFromFormat('d/m/Y H:i', $request->start);
        $end = Carbon::createFromFormat('d/m/Y H:i', $request->end);
        $id = $request->input('id', false);
        $rules = [
            'nom'            => 'required',
            'cour'           => 'required',
            'formateur'      => 'required',
            'lieu'           => 'required',
            'start'          => 'required | date_format:"d/m/Y H:i"|before:end',
            'end'            => 'required | date_format:"d/m/Y H:i"',
            'methode'        => 'required',
            'statut'         => 'required',
            'salle'          => 'required',
        ];

        $salle_occupee = Session::where('salle_id', $request->salle)
        ->where(function ($query) use ($start, $end) {
            $query->where(function ($q) use ($start, $end) {
                $q->where('start', '>=', $start)
                   ->where('start', '<', $end);
            })->orWhere(function ($q) use ($start, $end) {
                $q->where('start', '<=', $start)
                   ->where('end', '>', $end);
            })->orWhere(function ($q) use ($start, $end) {
                $q->where('end', '>', $start)
                   ->where('end', '<=', $end);
            })->orWhere(function ($q) use ($start, $end) {
                $q->where('start', '>=', $start)
                   ->where('end', '<=', $end);
            });
        })->count();

        $formateur_occupe = Session::where('formateur_id', $request->formateur)
        ->where(function ($query) use ($start, $end) {
            $query->where(function ($q) use ($start, $end) {
                $q->where('start', '>=', $start)
                   ->where('start', '<', $end);
            })->orWhere(function ($q) use ($start, $end) {
                $q->where('start', '<=', $start)
                   ->where('end', '>', $end);
            })->orWhere(function ($q) use ($start, $end) {
                $q->where('end', '>', $start)
                   ->where('end', '<=', $end);
            })->orWhere(function ($q) use ($start, $end) {
                $q->where('start', '>=', $start)
                   ->where('end', '<=', $end);
            });
        })->count();

        if($id) {
            $validator = Validator::make($request->all(), $rules);
            $messages = $validator->errors();
            $salle_occupee = Session::where('salle_id', $request->salle)->where('id', '<>', $id)
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    $q->where('start', '>=', $start)
                       ->where('start', '<', $end);
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '<=', $start)
                       ->where('end', '>', $end);
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('end', '>', $start)
                       ->where('end', '<=', $end);
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '>=', $start)
                       ->where('end', '<=', $end);
                });
            })->count();

            $formateur_occupe = Session::where('formateur_id', $request->formateur)->where('id', '<>', $id)
            ->where(function ($query) use ($start, $end) {
                $query->where(function ($q) use ($start, $end) {
                    $q->where('start', '>=', $start)
                       ->where('start', '<', $end);
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '<=', $start)
                       ->where('end', '>', $end);
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('end', '>', $start)
                       ->where('end', '<=', $end);
                })->orWhere(function ($q) use ($start, $end) {
                    $q->where('start', '>=', $start)
                       ->where('end', '<=', $end);
                });
            })->count();
            if($salle_occupee>0) {
                $messages->add('salle', 'La salle est reservée pour ces horaires!');
            }
            if($formateur_occupe>0) {
                $messages->add('formateur', 'Le formateur affecté n\'est pas disponible pour ces dates!');
            }
            $now = Carbon::now()->format('Y-m-d H:i');
            if($request->statut == "Terminé" && $end > $now){
                $messages->add('horraire', 'La session ne peut être terminée sauf si la date fin est depassée !');
            }

            $prevus = [];
            $presents = [];
            $p_prevus = User_sessions::where(['session_id'=> $id, 'prevu'=>1])->get();
            $p_presents = User_sessions::where(['session_id'=> $id, 'present'=>1])->groupBy('user_id')->get();
            foreach ($p_prevus as $p) {
                $prevus[] = $p->user_id;
            }
            foreach ($p_presents as $p) {
                $presents[] = $p->user_id;
            }

            if(count($messages)>0){
                return ["status" => "danger", "message" => $messages];
            }else{
                $session = Session::find($id);
                $session->nom=$request->input('nom');
                $session->description=$request->input('description');
                $session->start=Carbon::createFromFormat('d/m/Y H:i', $request->start);
                $session->end=Carbon::createFromFormat('d/m/Y H:i', $request->end);
                $session->lieu=$request->input('lieu');
                $session->methode=$request->input('methode');
                $session->cour_id=$request->input('cour');
                $session->salle_id=$request->input('salle');
                $session->formateur_id=$request->input('formateur');
                $session->statut=$request->input('statut');
                $session->save();

                $session_id = $session->id;
                $participants=array();
                $sp_ids = [];
                $participants= $request->participants;
                $sess_par= $session->participants;
                foreach ($sess_par as $s_p) {
                    $sp_ids[] = $s_p->id;
                }
                //dd($sp_ids);
                if($participants){
                    foreach ($participants as $par) {
                        if(!in_array($par, $prevus) and !in_array($par, $sp_ids)){
                            $sess_participants= new User_sessions();
                            $sess_participants->session_id = $session_id;
                            $sess_participants->user_id = $par;
                            $sess_participants->prevu = 0;
                            $sess_participants->present = 1;
                            $sess_participants->save();
                            $p = User::find($par);
                            $password = $this->rand_string(8);
                            $p->password = bcrypt($password);
                            $p->save();
                            $sent = Mail::send('emails.register_session', 
                                [
                                    'session' => $session->nom, 
                                    'participant'=>$p->name, 
                                    'email'=>$p->email, 
                                    'civilite'=>$p->civilitev, 
                                    'password'=> $password,
                                    'start'=> $session->start,
                                    'end'=> $session->end,
                                    'cours'=> $session->cour->titre,
                                    'lieu'=> $session->lieu,
                                ]
                                , function ($m) use($p, $session){
                                    $m->to($p->email, $p->name)
                                    ->subject("Confirmation d'inscription à la session: ".$session->cour->titre);
                            });  
                        }else{
                            \DB::table('session_user')
                            ->where(['session_id' => $session_id,'user_id' =>$par])
                            ->update(['present'=>1]);
                        }
                    }
                }
                if(!empty($presents) && !empty($request->participants)){
                    $nouveau_presents=array_diff($presents, $request->participants); 
                    foreach ($nouveau_presents as $nv) {
                        \DB::table('session_user')
                        ->where(['session_id' => $session_id,'user_id' =>$nv])
                        ->update(['present'=>0]);
                    }
                }
                if($session->save()) {
                    return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
                } else {
                    return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
                }
            }
        }else{
            $validator = Validator::make($request->all(), $rules);
            $messages = $validator->errors();


            $now = Carbon::now()->format('Y-m-d h:i');

            if($salle_occupee>0) {
                $messages->add('salle', 'La salle est reservée pour ces horaires!');
            }
            if($formateur_occupe>0) {
                $messages->add('formateur', 'Le formateur affecté n\'est pas disponible pour ces dates!');
            }
            if($request->statut == "Terminé" && $request->end > $now) {
                $messages->add('horraire', 'La session ne peut être terminée sauf si la date fin est depassée !');
            }
            if(count($messages)>0){ 
                return ["status" => "danger", "message" => $messages];
            }else{
                $session = new Session();
                $session->nom=$request->input('nom');
                $session->description=$request->input('description');
                $session->start=Carbon::createFromFormat('d/m/Y H:i', $request->start);
                $session->end=Carbon::createFromFormat('d/m/Y H:i', $request->end);
                $session->lieu=$request->input('lieu');
                $session->methode=$request->input('methode');
                $session->cour_id=$request->input('cour');
                $session->salle_id=$request->input('salle');
                $session->formateur_id=$request->input('formateur');
                $session->statut=$request->input('statut');
                $session->save();

                $session_id = $session->id;
                $participants=array();
                $participants= $request->participants;
                if($participants){
                    foreach ($participants as $par) {
                        $sess_participants= new User_sessions();
                        $sess_participants->session_id = $session_id;
                        $sess_participants->user_id = $par;
                        $sess_participants->prevu = 1;
                        $sess_participants->present = 1;
                        $sess_participants->save();
                        $p = User::find($par);
                        $password = $this->rand_string(8);
                        $p->password = bcrypt($password);
                        $p->save();
                        $sent = Mail::send('emails.register_session', 
                            [
                                'session' => $session->nom, 
                                'civilite'=>$p->civilite, 
                                'participant'=>$p->name, 
                                'email'=>$p->email, 
                                'password'=> $password,
                                'start'=> $session->start,
                                'end'=> $session->end,
                                'cours'=> $session->cour->titre,
                                'lieu'=> $session->lieu,
                            ]
                            , function ($m) use($p, $session){
                                $m->to($p->email, $p->name)->subject("Confirmation d'inscription à la session ".$session->nom);
                        });
                    }
                }

                if($session->save()) {
                    return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
                } else {
                    return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
                }
            }
        }

    }

    public function show($id){
        ob_start();
        $s = Session::find($id);
        $p_presents = \DB::table('session_user')
            ->join('sessions', 'sessions.id', '=', 'session_user.session_id')
            ->join('users', 'users.id', '=', 'session_user.user_id')
            ->select('users.*')
            ->where('sessions.id','=', $id)
            ->where('session_user.present','=',1)
            ->get();

        echo view('sessions.show', ['s' => $s, 'p_presents' => $p_presents]);
        $content = ob_get_clean();
        return ['title' => 'Détails de la session', 'content' => $content];
    }

    public function edit($id){
        ob_start();
        $cours = Cour::all();
        $formateurs = Formateur::all();
        $salles = Salle::all();
        $participants = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'collaborateur');
        })->get();
        $session = Session::find($id);

        $prevus = [];
        $presents = [];
        $p_prevus = User_sessions::where(['session_id'=> $id, 'prevu'=>1])->get();
        $p_presents = User_sessions::where(['session_id'=> $id, 'present'=>1])->get();
        //dd($p_presents);
        foreach ($p_prevus as $p) {
            $prevus[] = $p->user_id;
        }
        foreach ($p_presents as $p) {
            $presents[] = $p->user_id;
        }

        echo view('sessions.edit', [
            'cours'=> $cours,
            'formateurs'=> $formateurs,
            'salles'=> $salles,
            'participants'=> $participants,
            's'=> $session,
            'prevus_ids'=> $prevus,
            'present_ids'=> $presents,
        ]);
        $content = ob_get_clean();
        return ['title' => 'Modifier la session', 'content' => $content];
    }

    // public function update(SessionRequest $request, $id){
    //     $start = Carbon::createFromFormat('d/m/Y H:i', $request->start);
    //     $end = Carbon::createFromFormat('d/m/Y H:i', $request->end);
    //     $validator = Validator::make($request->all(), [
    //         'nom'            => 'required',
    //         'cour'           => 'required',
    //         'formateur'      => 'required',
    //         'lieu'           => 'required',
    //         'methode'        => 'required',
    //         'statut'         => 'required',
    //         'salle'          => 'required',
    //     ]);
    //     $messages = $validator->errors();
        
    //     $now = Carbon::now()->format('Y-m-d h:i');
    //     if($request->statut == "Terminé" && $request->end > $now){
    //         $messages->add('horraire', 'La session ne peut être terminée sauf si la date fin est depassée !');
    //     }

    //     $prevus = [];
    //     $presents = [];
    //     $p_prevus = User_sessions::where(['session_id'=> $id, 'prevu'=>1])->get();
    //     $p_presents = User_sessions::where(['session_id'=> $id, 'present'=>1])->groupBy('user_id')->get();
    //     foreach ($p_prevus as $p) {
    //         $prevus[] = $p->user_id;
    //     }
    //     foreach ($p_presents as $p) {
    //         $presents[] = $p->user_id;
    //     }

    //     if(count($messages)>0){
    //         return redirect('sessions/'.$id.'/edit')->withErrors($messages)->withInput();
    //     }else{
    //         $session = Session::find($id);
    //         $session->nom=$request->input('nom');
    //         $session->description=$request->input('description');
    //         $session->start=Carbon::createFromFormat('d/m/Y H:i', $request->start);
    //         $session->end=Carbon::createFromFormat('d/m/Y H:i', $request->end);
    //         $session->lieu=$request->input('lieu');
    //         $session->methode=$request->input('methode');
    //         $session->cour_id=$request->input('cour');
    //         $session->salle_id=$request->input('salle');
    //         $session->formateur_id=$request->input('formateur');
    //         $session->statut=$request->input('statut');
    //         $session->save();

    //         $session_id = $session->id;
    //         $participants=array();
    //         $participants= $request->participants;
    //         $sess_par= $session->participants;
    //         foreach ($sess_par as $s_p) {
    //             $sp_ids[] = $s_p->id;
    //         }
    //         //dd($sp_ids);
    //         if($participants){
    //             foreach ($participants as $par) {
    //                 if(!in_array($par, $prevus) and !in_array($par, $sp_ids)){
    //                     $sess_participants= new User_sessions();
    //                     $sess_participants->session_id = $session_id;
    //                     $sess_participants->user_id = $par;
    //                     $sess_participants->prevu = 0;
    //                     $sess_participants->present = 1;
    //                     $sess_participants->save();  
    //                 }else{
    //                     \DB::table('session_user')
    //                     ->where(['session_id' => $session_id,'user_id' =>$par])
    //                     ->update(['present'=>1]);
    //                 }
    //             }
    //         }
    //         if(!empty($presents) && !empty($request->participants)){
    //             $nouveau_presents=array_diff($presents, $request->participants); 
    //             foreach ($nouveau_presents as $nv) {
    //                 \DB::table('session_user')
    //                 ->where(['session_id' => $session_id,'user_id' =>$nv])
    //                 ->update(['present'=>0]);
    //             }
    //         }
    //         return redirect('sessions');
    //     }
    // }

    public function destroy($id){
        $session = Session::find($id);
        if($session->budgets){
            foreach($session->budgets as $budget){
                $budget->delete();
            }  
        }
        if($session->evaluations){
            foreach($session->evaluations as $evaluation){
                foreach ($evaluation->questions as $question) {
                    $reponses = Reponse::where(['question_id' => $question->id])->get();
                    foreach ($reponses as $reponse) {
                        $reponse->delete();          
                    }
                    $question->delete();
                }
                $evaluation->delete();
            }  
        }
        $session->participants()->detach();
        $session->delete();
        return redirect('sessions');
    }

    public function filterSessions(Request $request){
        if(!empty($request->start)){
            $start = Carbon::createFromFormat('d/m/Y H:i', $request->start);
        }
        if(!empty($request->end)){
            $end = Carbon::createFromFormat('d/m/Y H:i', $request->end);
        }
        $criteres = [];
        $sessions = Session::paginate(10);
        if ( !empty($start) ) {
            $sessions = Session::where('start', '>=', $start)->paginate(10);
        } 
        if( !empty($end) ){
            $sessions = Session::where('end', '<=', $end)->paginate(10);
        }
        if( !empty($start) and !empty($end)){
            $sessions = Session::whereBetween('start', [$start, $end])->paginate(10);
        }
        if( !empty($request->statut) ){
            $sessions = Session::where(['statut' => $request->statut])->paginate(10);
        }
        if ( !empty($start) and !empty($request->statut) ) {
            $sessions = Session::where('start', '>=', $start)->where(['statut' => $request->statut])->paginate(10);
        }
        if ( !empty($end) and !empty($request->statut) ) {
            $sessions = Session::where('start', '<=', $end)->where(['statut' => $request->statut])->paginate(10);
        }
        if( !empty($start) and !empty($end) and !empty($request->statut) ){
            $sessions = Session::where(['statut' => $request->statut])->whereBetween('start', [$start, $end])->paginate(10);
        }
        
        $selected= $request->statut;
        $selected_start = $request->start;
        $selected_end = $request->end;
        //$sessions = Session::where($criteres)->paginate(10);
        //dd($sessions);
        return view('sessions.index', compact('selected','sessions','selected_start', 'selected_end'));
    }


}
