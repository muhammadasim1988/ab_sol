<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserInterests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
class RegisterController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name'=> 'required|string|max:100',
            'last_name'=> 'required|string|max:100',
            'address'=> 'required|string|max:150',
            'dob'=> 'required|date|before_or_equal:'.\Carbon\Carbon::now()->subYears(12)->format('m/d/Y'),
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'interest' => 'required|array|distinct',
            'interest.*' => 'distinct|exists:interest,id',
        ],[
            "interest.distinct"=>"Duplicate interest value",
        ]);

        if($validator->fails()){
            return response()->json(['status'=>1,'error' => $validator->errors()], 200);
        }

        DB::beginTransaction();
        try{

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'dob' => $request->dob,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            // insert bulk user interest
            if($request->interest)
            {
                $userInterest = array();
                foreach($request->interest as $interest)
                {
                     $userInterest[]= array('user_id'=>$user->id,'interest_id'=>$interest,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'));
                }
                UserInterests::insert($userInterest);
            }
             DB::commit();
             $token = $user->createToken('API Access Token')->accessToken;
             return response()->json(['status'=>0,'success'=>'User has been registerd successfully'], 200);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['status'=>1,'error'=>$e->getMessage()], 500);
        }



    }
}
