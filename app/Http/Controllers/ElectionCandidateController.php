<?php

namespace App\Http\Controllers;

use App\Models\ElectionCandidate;

use Exception;
use Illuminate\Http\Request;

class Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates_election = ElectionCandidate::all();
        return response()->json(['candidates' => $candidates_election], 200);
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
            $new_candidate_election=new ElectionCandidate();
            $new_candidate_election->election_id=$request->input('election_id');
            $new_candidate_election->candidate_id=$request->input('candidate_id');
            $new_candidate_election->save();
            return response()->json(["resp"=>"Creado exitosamente"], 200);}
        catch(Exception $e)
            {return response()->json(["resp"=>"Error, no se encuentra el candidato o la elección"], 404);}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ElectionCandidate  $electionCandidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{$candidates_election=ElectionCandidate::findOrFail($id);
            return response()->json($candidates_election,200);}
        catch(Exception $e)
            {return response()->json(["Error"=>"No existe el lanzamiento"],404);}
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ElectionCandidate  $electionCandidate
     * @return \Illuminate\Http\Response
     */
    public function edit(ElectionCandidate $electionCandidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ElectionCandidate  $electionCandidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ElectionCandidate $electionCandidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ElectionCandidate  $electionCandidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ElectionCandidate $electionCandidate)
    {
        //
    }
}
