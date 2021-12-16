<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sqlPartidos="SELECT p.id,p.name AS partido,u.name AS lider,p.nit,p.address,p.picture,p.phone_number
        FROM parties AS p, users AS u
        WHERE p.admin_id=u.id";
        $parties = DB::select($sqlPartidos);
        return response()->json(['Parties' => $parties], 200);
    }

    public function PartidosOrden()
    {
        $sqlPartidos="SELECT * FROM parties ORDER BY name asc";
        $Partidos=DB::select($sqlPartidos);
        return response()->json(['partidos' => $Partidos], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $new_party=new Party();
            $new_party->name=$request->input('name');
            $new_party->nit=$request->input('nit');
            $new_party->address=$request->input('address');
            $new_party->picture=$request->input('picture');
            $new_party->phone_number=$request->input('phone_number');
            $new_party->admin_id=$request->input('admin_id');
            $new_party->save();
            return response()->json(["response"=>"Partido creado exitosamente"], 200);}
        catch(Exception $e)
            {return response()->json(["response"=>"Error al crear el partido"], 404);}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $party=Party::findOrFail($id);
            return response()->json($party,200);}
        catch(Exception $e){
            return response()->json(["response"=>"No existe el partido"],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit(Party $party)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $party=Party::findOrFail($id);
            $newName=$request->input('name');
            $newaddress=$request->input('address');
            $newPicture=$request->input('picture');
            $newPhone=$request->input('phone_number');
            $newAdmin=$request->input('admin_id');
            $party->name=$newName==null? $party->name:$newName;
            $party->address=$newaddress==null? $party->role:$newaddress;
            $party->picture=$newPicture==null? $party->picture:$newPicture;
            $party->phone_number=$newPhone==null? $party->phone_number:$newPhone;
            $party->id_admin=$newAdmin==null? $party->id_admin:$newAdmin;
            $party->save();
            return response()->json(["response"=>"Partido editado correctamente"],200);}
        catch(Exception $e)
            {return response()->json(["response"=>"Error al crear el partido"],404);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $party=Party::findOrFail($id);
        $party->delete();
        return response()->json(["resp"=>"Eliminado exitosamente"],200);
    }
}
