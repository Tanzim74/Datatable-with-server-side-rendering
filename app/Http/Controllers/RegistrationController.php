<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\User;
class RegistrationController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'phone' => ['required'],
            'password' => ['required'],
            'confirm_password' => ['required'],
            'qualification' => ['required']
            ]);

            if($request->password != $request->confirm_password){

                throw ValidationException::withMessages([
                    'password' => ['The provided passwords donot match'] 
                ]);
            }
            else{

                try {
  
                    /*------------------------------------------
                    --------------------------------------------
                    Start DB Transaction
                    --------------------------------------------
                    --------------------------------------------*/
                    DB::beginTransaction();

                    $user_id = DB::table('users')->insertGetId([

                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        
                    ]);
    
                    $education = DB::table('education')->insert([
                        'user_id' => $user_id,
                        'qualification' => $request->qualification
                    ]);

                    $user = User::where('id',$user_id)->first();

                    /*------------------------------------------
                    --------------------------------------------
                    Commit Transaction to Save Data to Database
                    --------------------------------------------
                    --------------------------------------------*/
                    DB::commit();

                    return $user->createToken('Auth Token')->accessToken;
                      
                } catch (Exception $e) {
          
                    /*------------------------------------------
                    --------------------------------------------
                    Rollback Database Entry
                    --------------------------------------------
                    --------------------------------------------*/
                    DB::rollback();
                    throw $e;
                }


             
                
            }
    

    }
}
