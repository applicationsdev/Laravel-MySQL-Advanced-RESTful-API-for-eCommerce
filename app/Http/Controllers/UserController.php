<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

// To simplify development & testing of current version,
// this controller is not using all of the User fields
// (these unused fields are set to nullable in the User migration file)
        
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
            ->json(['data' => $users]);
        
        //json() method automatically sets the Content-Type header to application/json
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'nullable|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:100',
            'photo' => 'nullable|max:300',
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
                ->json(['data' => $user]);
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
        if (!$user = User::find($id)) {
            
            return response('Not Found', 404);
            
        } else {
            return response('OK', 200)
                ->json(['data' => $user]);
        }
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
        if (!$user = User::find($id)) {
            
            return response('Not Found', 404);
            
        } else {
            // Validation rules
            $rules = [
                'name' => 'nullable|max:50',
                'email' => 'nullable|email|unique:users',
                'password' => 'nullable|min:8|max:100',
                'photo' => 'nullable|max:300',
            ];
            
            if (!$this->validate($request, $rules)) {
                
                return response('Bad Request', 400);
                
            } else {
                
                if ($request->has('name')) {
                    $user->name = $request->name;
                }
                
                if ($request->has('email')) {
                    $user->email = $request->email;
                }
                
                if ($request->has('password')) {
                    $user->password = bcrypt($request->password);
                }
                
                if ($request->has('photo')) {
                    $user->photo = $request->photo;
                }
                
                $user->save();
                
                return response('OK', 200)
                    ->json(['data' => $user]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = User::find($id)) {
            
            return response('Not Found', 404);
            
        } else {
            
            $user->delete();
            
            return response('OK', 200);
        }
    }
}
