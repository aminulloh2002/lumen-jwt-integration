<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function register(Request $request)
    {
        //validate
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        //endvalidate

        //user registration
        try{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            
            //mengambil 3 input dari user termasuk password yg belum di hash
            // $input = $request->only('name','email','password');

            if($user->save()){
                return response()->json([
                    'data' => $user,
                    'message' => 'Registered!',
                    'success' => true
                ],201);
            } else{
                return response()->json([
                    'data' => null,
                    'message' => 'Register Fail!',
                    'success' => false
                ],400);
            };
        }catch(Exception $e){
            // return $e->getMessage();
            return response()->json([
                'data' => null,
                'message' => 'error -> '.$e,
                'success' => false
            ],500);
        }

    }
    public function login(Request $request)
    {

        $this->validate($request,[
        // 'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required'
        ]);

        
        if(!$authorized = auth('api')->attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'data' => null,
                'message' => 'Authorization Fail!',
                'success' => false
            ],401);
        } else{
            return $this->respondWithToken($authorized);
        }
    }

}
