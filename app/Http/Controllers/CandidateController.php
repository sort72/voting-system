<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();
        return response()->json(['candidates' => $candidates], 200);
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
        $new_candidate=new Candidate();
        $new_candidate->user_id=$request->input('candidate_id');
        $new_candidate->party_id=$request->input('party_id');
        //$new_candidate->election_id=$request->input('election_id');
        $new_candidate->save();
        $user=User::findOrFail($request->input('candidate_id'));
        $user->role='candidate';
        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{$candidate=Candidate::findOrFail($id);
            return response()->json($candidate,200);}
        catch(Exception $e)
            {return response()->json(["Error"=>"No existe el candidato"],404);}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $candidate=User::findOrFail($id);
            $newUser=$request->input('user_id');
            $newParty=$request->input('party_id');
            $newElection=$request->input('election_id');
            $candidate->user_id=$newUser==null? $candidate->name:$newUser;
            $candidate->party_id=$newParty==null? $candidate->role:$newParty;
            $candidate->election_id=$newElection==null? $candidate->photo:$newElection;
            $candidate->save();
            return response()->json(["response"=>"Candidato agregado correctamente"],200);}
            catch(Exception $e)
            {return response()->json(["response"=>"No existe el candidato"],500);}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $candidate=Candidate::findOrFail($id);
        $candidate->delete();
        return response()->json(["resp"=>"Eliminado exitosamente"],200);}
        catch(Exception $e)
        { return response()->json(["resp"=>"No existe el candidato"],500);}
    }
}
