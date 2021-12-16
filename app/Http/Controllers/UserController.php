<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Votes;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Carbon;
use DateTime;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $users = User::all();
        return response()->json(['users' => $users], 200);
    }

    public function ListarVotantes(){
        $sqlVotantes="SELECT * FROM users";
        $votantes=DB::select($sqlVotantes);
        return response()->json(['votants' => $votantes], 200);

    }

    public function VotantesEdad(){
        $sqlVotantes="SELECT * FROM users";
        $votantes=DB::select($sqlVotantes);
        $array=array();
        foreach($votantes as $votante)
        {
            $date_birth=new DateTime($votante->birth_date);
            $date_today=new DateTime();
            $diff=$date_today->diff($date_birth);
            if($diff->y >= 18 && $diff->y <=27)
                {array_push($array,$votante);}
        }
        return response()->json(['votantes entre 18 y 27 anios' => $array], 200);

    }

    public function VotantesPromedio(){
        $sqlVotantes="SELECT * FROM users";
        $votantes=DB::select($sqlVotantes);
        $suma=0;
        $total=0;
        $array=array();
        $date_today=new DateTime();
        foreach($votantes as $votante)
        {
            $date_birth=new DateTime($votante->birth_date);
            $diff=$date_today->diff($date_birth);
            $suma+=$diff->y;
            $total+=1;
        }
        $promedio=$suma/$total;
        foreach($votantes as $votante)
        {
            $date_birth=new DateTime($votante->birth_date);
            $date_today=new DateTime();
            $diff=$date_today->diff($date_birth);
            if($diff->y >= $promedio)
                {array_push($array,$votante);}

        }
        return response()->json(['promedio'=>$promedio,'votantes mayores al promedio' => $array], 200);
    }

    public function BuscarVotos($id){
        $sqlUsuario="SELECT * FROM users WHERE document=".$id;
        $Usuario=DB::select($sqlUsuario);
        $Usuario=$Usuario[0];
        $sqlVotos="SELECT * FROM votes WHERE user_id=".$Usuario->id;
        $Votos=DB::select($sqlVotos);
        $CandidatosFinal=array();
        foreach($Votos as $Voto)
        {
            $sqlCandidato="SELECT * FROM candidates WHERE id=".$Voto->election_candidate_id;
            $Candidato=DB::select($sqlCandidato)[0];
            $sqlCandidatos="SELECT * FROM users WHERE id=".$Candidato->user_id;
            $Candidatos=DB::select($sqlCandidatos);
            array_push($CandidatosFinal,$Candidatos);
        }

        return response()->json(['candidatos_votados'=>$CandidatosFinal], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $new_user=new User();
            $new_user->name=$request->input('name');
            $new_user->email=$request->input('email');
            $new_user->document=$request->input('document');
            $new_user->birth_date=$request->input('birth_date');
            $new_user->photo=$request->input('photo');
            $new_user->password=$request->input('password');
            $new_user->phone_number=$request->input('phone_number');
            $new_user->role='citizen';
            $new_user->save();
            return response()->json(["resp"=>"Creado exitosamente"], 200);}
        catch(Exception $e)
            {return response()->json(["resp"=>"Error, el correo ya esta registrado"], 404);}
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{$user=User::findOrFail($id);
            return response()->json($user,200);}
        catch(Exception $e)
            {return response()->json(["Error"=>"No existe el usuario"],404);}
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request,$id)
    {
        try{
        $user=User::findOrFail($id);
        $newName=$request->input('name');
        $newRol=$request->input('role');
        $newPhoto=$request->input('photo');
        $newPassword=$request->input('password');
        $newPhone=$request->input('phone');
        $newDate=$request->input('Date');
        $user->name=$newName==null? $user->name:$newName;
        $user->role=$newRol==null? $user->role:$newRol;
        $user->photo=$newPhoto==null? $user->photo:$newPhoto;
        $user->password=$newPassword==null? $user->password:$newPassword;
        $user->phone_number=$newPhone==null? $user->phone_number:$newPhone;
        $user->birth_date=$newDate==null? $user->birth_date:$newDate;

        $user->save();
        return response()->json(["response"=>"Usuario actualizado correctamente"],200);}
        catch(Exception $e)
        {return response()->json(["response"=>"No existe el usuario"],500);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user=User::findOrFail($id);
        $user->delete();
        return response()->json(["resp"=>"Eliminado exitosamente"],200);}
        catch(Exception $e)
        { return response()->json(["resp"=>"No existe el usuario"],500);}
    }
}
