<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return response()->json(['data' => $usuarios], 200);
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

        $rule = [
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:6| confirmed'
        ];

        $this->validate($request, $rule);
        $campos = $request->all();
        $campos['password'] = Hash::make($request->password);
        $campo['verified'] = User::USUARIO_NO_VERIFICADO;
        $campos['verification_token'] = User::generarVerificationToken();
        $campos['admin'] = User::USUARIO_REGULAR; 
        $usuario = User::create($campos);
        
        return response()->json(['data'=> $usuario], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return response()->json(['data' => $usuario], 200);
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
        $user = User::findOrFail($id);
        $rule = [
            'email' => 'email| unique:users, email'. $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in'.User::USUARIO_ADMINISTRADOR . ',' . User::USUARIO_REGULAR,
        ];

        $this->validate($request, $rule);
        if($request->has('name'))
        {
            $user->name = $request->name;
        }
        if($request->has('email') && $user->email != $request->email)
        {
            $user->verified = User::USUARIO_NO_VERIFICADO;
            $user->verification_tonken = User::generarVerificationToken();
            $user->email = $request->email;
        }

        if($request->has('password'))
        {
            $user->password = Hash::make($request->password);
        }

        if($request->has('admin'))
        {
            if(!$user->esVerificado())
            {
                return response()->json([
                    'error' => 'Unicamente los Usuarios verificado pueden cambiar el Rol',
                    'code' => 409
                ], 409);
            }

            $user->admin = $request->admin;
        }

        if(!$user->isDirty())
        {
            return response()->json(['error' => 'Se debe especificar al menos un valor diferente para actualizar',
                'code' => 422], 422);
        }

        $user->save();

        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        

        $user->delete();

        return response()->json(['data' => $user], 200); 
    }
}
