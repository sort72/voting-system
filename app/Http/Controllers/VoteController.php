<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\ElectionCandidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $new_vote=new Vote();
        $new_vote->user_id=$request->input('user_id');
        $new_vote->election_candidate_id=$request->input('election_candidate_id');
        $new_vote->save();


        /*$hechos=1;
        $votesof=Vote::all()->where('user_id','=',$request->input('user_id'));
        foreach($votesof as $vote)
            {
            $electionCandidate=ElectionCandidate::findOrFail($vote->election_candidate_id);
            if($electionCandidate)
            }



        $election=Election::findOrFail($electionCandidate->election_id);*/

        return response()->json(["response"=>$new_vote], 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }
}
