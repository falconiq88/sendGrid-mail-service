<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserController extends Controller
{
    //
    public static function store(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|boolean',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:11',
            'governote' => 'required|string|max:100',
            'description'=>'required|string'
        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors());
        }
        else {

            $user = new User([
                'id'=>Str::uuid(),
                'fullname' => $request->fullname,
                'email' => $request->email,
                'password' =>Hash::make($request->password),
                'role' => $request->role,
                'city' => $request->city,
                'governote' => $request->governote,
                'PhoneNumber' => $request->phone,
                'description' => $request->description,
            ]);
            $user->save();

        }
        return response()->json("user has been Registered",200);
    }

    public static function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',

        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors());
        } else {
//            //check email
//            $user=User::where('email',$request['email'])->first();
//            //check password
//            if(!$user || !Hash::check($request['password'],$user->password)){
//                return response()->json(['message'=>'enter valid credintals']);
//            }
//
//                $token=$user->createToken('myapptoken')->plainTextToken;
//                return response()->json([
//                    'data'=>[
//                        'user'=>$user,
//                        'access_token'=>$token,
//                        'expires_at'=>Carbon::parse($token->token->expires_at)->toDateTimeString()
//                    ]
//                ]);

            $credintals=request(['email','password']);
            if(!Auth::attempt($credintals)){
                return response()->json(['message'=> 'enter a valid email or password']);
            }
            else{
                $user=$request->user();
                $tokenResult=$user->createToken('Personal Access Token');
                $token=$tokenResult->token;
                $token->expires_at=Carbon::now()->addWeeks(1);
                $token->save();


                return response()->json([
                    'data'=>[
                        'user'=>Auth::user(),
                        'access_token'=>'Bearer ' . $tokenResult->accessToken,
                        'expires_at'=>Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
                    ]
                ]);
            }





        }
    }
}
