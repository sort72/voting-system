<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\User;
use App\Models\ElectionCandidate;
use App\Models\Vote;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexa(Request $request)
    {
        $new_vote=new Vote();
        $today=new DateTime();
        $election=Election::where('start_date',$today->format('Y-m-d'))->first();
        $new_vote->user_id=intval($request->input('user_id'));
        $candidate=$request->input('candidate_id');
        $new_vote->id_election=$election->id;
        $election_candidate=ElectionCandidate::where('election_id',$election->id)->where('candidate_id',$candidate['id'])->first();
        $new_vote->election_candidate_id=$election_candidate->id;
        $vote = Vote::where('user_id',$request->input('user_id'))->where('id_election',$election->id)->first();
        
        if(is_null($vote))
        {
            $new_vote->save();
            return response()->json(["response"=>$new_vote], 200);
        }
        else
        {
            return response()->json(["response"=>'Ya votó'], 200);
        }

    }

    public function auth(Request $request)
    {
        $user = User::where('email',$request->input('email'))->first();
        if($user)
        {
            $password = Crypt::decrypt($user->password);
            if($password == $request->input('password'))
            {
                return response()->json(["id"=>$user->id], 200);
            }
            return response()->json(["response"=>'No corresponde a nuestras credenciales'], 404);
        }
        else
        {
            return response()->json(["response"=>'No corresponde a nuestras credenciales'], 404);
        }

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
