<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        $user->name=$newName==null? $user->name:$newName;
        $user->role=$newRol==null? $user->role:$newRol;
        $user->photo=$newPhoto==null? $user->photo:$newPhoto;
        $user->password=$newPassword==null? $user->password:$newPassword;
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
