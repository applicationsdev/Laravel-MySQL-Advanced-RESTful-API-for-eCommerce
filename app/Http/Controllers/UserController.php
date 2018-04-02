<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
        
        return response('OK', 200)
            ->json(['data' => $users])
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // To simplify development & testing of the current version,
        // this controller is not using all of the User fields
        // (unused fields are set to nullable in the User migration)
        
        // Validation rules
        $rules = [
            'name' => 'max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:100',
            'photo' => 'max:300',
        ];
        
        if (!$this->validate($request, $rules)) {
            
            return response('Bad Request', 400);
            
        } else {
            $data = [];
            
            if ($request->has('name')) {
                $data['name'] = $request->name;
            }
            
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password); //hash the password before store it to DB
            
            if ($request->has('photo')) {
                $data['photo'] = $request->photo;
            }
            
            $user = User::create($data);
            
            return response('Created', 201)
                ->json(['data' => $user])
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
