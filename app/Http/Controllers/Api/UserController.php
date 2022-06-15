<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    use ApiResponseTrait;
        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'mobile' => 'required|numeric',
                'password' => 'required'

            ]);

            $errors = [];
            $errorStr = '';
            $errorArr = [];

            foreach ($validator->errors()->toArray() as $key => $error) {

                $errors[$key] = $error[0];
                $errorStr .= $error[0] ;
                array_push($errorArr , $error[0] );

                return $this->apiResponse(null , false , $errorStr );

            }


            $user = User::create([
                'name' => $request->name ,
                'email' => $request->email ,
                'mobile' => $request->mobile ,
                'password' => $request->password ,
                'email_verified_at'=>now(),
                'remember_token'=>Str::random(10),



            ]);



            $token = $user->createToken('token-name')->plainTextToken;
            $response = [

            'user' => new UserResource($user) ,

            'token' => $token
            ];

            return $this->apiResponse($response , true , 'user created suessfully');


        }

        public function update(Request $request , $id)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100',
                'mobile' => 'required|numeric',
                'password' => 'required'

            ]);

            $errors = [];
            $errorStr = '';
            $errorArr = [];

            foreach ($validator->errors()->toArray() as $key => $error) {

                $errors[$key] = $error[0];
                $errorStr .= $error[0] ;
                array_push($errorArr , $error[0] );

                return $this->apiResponse(null , false , $errorStr );

            }

            $user = User::where('id' , $id)->first();
            if($user){
                $user->update([
                    'name' => $request->name ,
                    'email' => $request->email ,
                    'mobile' => $request->mobile ,
                    'password' => $request->password ,
                    'email_verified_at'=>now(),
                    'remember_token'=>Str::random(10),
                ]);

                $token = $user->createToken('token-name')->plainTextToken;
                $response = [
                    'user' => new UserResource($user) ,
                    'token' => $token
                ];
                return $this->apiResponse($response , true , 'user updated suessfully');
            }else{
                return $this->apiResponse(null , false , 'not found');
            }




        }



        public function login(Request $request)
        {
                // validation
                $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|max:100|exists:users,email',
                    'password' => 'required'
                ]);



                $is_complete = false;

                $response = [
                    'is_complete' => $is_complete
                ];

                $errors = [];
                $errorStr = '';
                $errorArr = [];

                foreach ($validator->errors()->toArray() as $key => $error) {

                      $errors[$key] = $error[0];
                      $errorStr .= $error[0] ;
                      array_push($errorArr , $error[0] );

                      return $this->apiResponse($response , false , $errorStr );

                }





                $user = User::where(['email' => $request->email , 'password' =>$request->password])->first();

                $token = $user->createToken('token-name')->plainTextToken;






                $is_complete = User::where('email' , $request->email)->select('is_complete')->first();


                if($user){

                    $response =[
                        'is_complete' => $is_complete = true,
                        'user' => new UserResource($user) ,
                        'token' => $token

                    ];

                 
                return $this->apiResponse($response , true , 'The code and phone number are the same');

                }else{
                    return $this->apiResponse(null , false , 'you must register');
                }

        }

        public function logout(Request $request) {

            $token =  $request->user()->tokens()->delete();
            return $this->apiResponse('' , true , 'user has logout successfully'  );
        }


}
