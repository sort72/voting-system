<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Exception;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elections = Election::all();
        return response()->json(['elections' => $elections], 200);
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
            $new_election=new Election();
            $new_election->name=$request->input('name');
            $new_election->description=$request->input('description');
            $new_election->start_date=$request->input('start_date');
            $new_election->end_date=$request->input('end_date');
            $new_election->save();
            return response()->json(["resp"=>"Eleccion creado exitosamente"], 200);}
        catch(Exception $e)
            {return response()->json(["resp"=>"Error al crear la elección"], 404);}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{$election=Election::findOrFail($id);
            return response()->json($election,200);}
        catch(Exception $e)
            {return response()->json(["Error"=>"No existe la elección"],404);}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function edit(Election $election)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $election=Election::findOrFail($id);
            $newName=$request->input('name');
            $newDescription=$request->input('description');
            $newStart=$request->input('start_date');
            $newEnd=$request->input('end_date');
            $election->name=$newName==null? $election->name:$newName;
            $election->role=$newDescription==null? $election->role:$newDescription;
            $election->photo=$newStart==null? $election->photo: $newStart;
            $election->password=$newEnd==null? $election->password:$newEnd;
            $election->save();
            return response()->json(["response"=>"Eleccion actualizada correctamente"],200);}
            catch(Exception $e)
            {return response()->json(["response"=>"No existe la elección"],500);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Election  $election
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $election=Election::findOrFail($id);
        $election->delete();
        return response()->json(["resp"=>"Eliminada exitosamente"],200);}
        catch(Exception $e)
        { return response()->json(["resp"=>"No existe la eleccion"],500);}
    }
}
