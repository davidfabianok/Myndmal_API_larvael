<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            'success' => true,
            'data' => $user,
        ]);

    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'max:255',
            'email' => 'email|max:255|unique:users',
            'password' => 'string|max:16|min:7',
            'image' => 'string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->messages(),
            ]);
        }

        try {

            $user = User::find($id);
            if ($user == false) {
                return response()->json([
                    'success' => false,
                    'error' => 'El usuario no se encontro',
                ]);
            }

            $name = $request->name;
            $email = $request->email;
            $password = $request->password;

            $user->update(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

            return response()->json([
                'success' => true,
                'message' => 'El usuario se actualizo con exito',
            ]);

        } catch (\Exception $ex) {
            return response()->json([
                'success' => false,
                'error' => $ex->getMessage(),
            ]);
        }
    }

}
