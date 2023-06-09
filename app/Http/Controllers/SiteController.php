<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
class SiteController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        if($token){
            return redirect()->route('site.user.dashboard');
        }else{
            return view('login');
        }

    }

    public function processLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $requestBody = array();
        $requestBody['email'] = $request->email;
        $requestBody['password'] = $request->password;
        $url = config('global.API_HOST_URL')."user/login";
        $response = Http::withHeaders(["Accept"=>"application/json","Content-Type"=>"application/json"])->post($url, $requestBody);
        $response = $response->object();
        if($response->status==1){
            return redirect()->back()->withErrors($response->error);
        }else{
            $request->session()->put('user_name', $response->user->name);
            $request->session()->put('token', $response->token);
            return redirect()->route('site.user.dashboard');
        }
    }
    public function userRegister(Request $request)
    {
        $interestList = Interest::all();
        return view('register',compact('interestList'));
    }
    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'first_name'=> 'required',
            'last_name'=> 'required',
            'address'=> 'required',
            'dob'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',
            'password_confirmation'=> 'required',
            'interest' => 'required',
            'interest.*' => 'numeric',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator->errors());
        }
        $interestList = $request->input('interest');
        $interest_list = array();
        foreach($interestList as $list){
            $interest_list[] = $list;
        }
        $requestBody = array();
        $requestBody['name']        = $request->name;
        $requestBody['first_name'] = $request->first_name;
        $requestBody['last_name'] = $request->last_name;
        $requestBody['address'] = $request->address;
        $requestBody['dob'] = $request->dob;
        $requestBody['email'] = $request->email;
        $requestBody['password'] = $request->password;
        $requestBody['password_confirmation'] = $request->password_confirmation;
        $requestBody['interest'] = $interest_list;


        $url = config('global.API_HOST_URL')."user/register";
        $response = Http::withHeaders(["Accept"=>"application/json","Content-Type"=>"application/json"])->post($url, $requestBody);
        $response = $response->object();
        if($response->status==1){
            return redirect()->back()->withErrors($response->error);
        }else{
            return redirect()->back()->with('success', $response->success);
        }
    }
    public function userDashboard(Request $request)
    {
        $token = $request->session()->get('token');
        if($token){
            $url = config('global.API_HOST_URL')."user/details";
            $response = Http::withHeaders(["Accept"=>"application/json","Content-Type"=>"application/json"])->withToken($token)->get($url);
            $response = $response->object();
            if($response->status==0){
                $userInfo = $response->data;
                return view('welcome',compact('userInfo'));
            }else{
                return redirect()->back()->with('success', $response->success);
            }
        }else{
             return redirect()->route('site.user.login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('site.user.login');
    }
}
