<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TenantUser;
use App\Models\ForgotpassModel;
use App\Mail\ForgotMailtemp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class TenantUserController extends Controller
{
    public function insertuser(Request $request){
        try {
            $datavalidator = $request->validate([
                'mobileno' => 'required|numeric|unique:tenanttable',
                'email' => 'required|unique:tenanttable',
                'passcode' => 'required|numeric',
            ]);
        
            // Continue with the logic if validation passes
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation failed
            $errors = $e->validator->errors()->getMessages();
            // Handle the validation errors, perhaps return a response with the errors
            return response()->json(['message' =>'Already Exist'], 203);
        }
     $combineddata=[
         'firstname'=>$request->input('firstname'),
         'lastname'=>$request->input('lastname'),
         'address'=>$request->input('address'),
         'state'=>$request->input('state'),
         'lga'=>$request->input('lga'), 
         'mobileno'=>$request->input('mobileno'),
         'altmobileno'=>$request->input('altmobileno'),
         'email'=>$request->input('email'),
         'passcode'=>Hash::make($request->input('passcode')),
         'occupation'=>$request->input('occupation'),
         'status'=>$request->input('email'),
         'nextofkindetails'=>$request->input('nextofkindetails'),
         
     ];
     $tenant=TenantUser::create($combineddata);
     return response()->json(['message'=>'Successful','data'=>$tenant],200);
     }
     public function selectuser(Request $request){
         $value=$request->input('value');
         $datauser = TenantUser::where('email', $value)->orWhere('mobileno', $value)->first();
         if($datauser){
             return response()->json(['message'=>true,'data'=>$datauser],201);
 
         }
         else{
             return response()->json(['message'=>false],203);
 
         }
        
 
 
     }
     public function loginuser(Request $request){
         $value=$request->input('value');
         $passcode=$request->input('passcode');
         if (!$value) {
             return response()->json(['message' => 'Email or Mobile Number is required'], 400);
         }
         $datauser = TenantUser::where('email', $value)->orWhere('mobileno', $value)->first();
         if(!$datauser){
             return response()->json(['message'=>false],203);
 
         }
         $passcodehash=$datauser->passcode;
         // check the passcode
         if ($datauser && Hash::check($passcode,$passcodehash)){
             return response()->json(['message'=>true],201);
         }
         else{
             return response()->json(['message'=>'fail to access'],201);
 
         }
     }
     public function updateuser(Request $request,$mobileno){
         $record=TenantUser::where('mobileno',$mobileno)->first();
         if(!$record){
             return response()->json(['message'=>'Record not found'],404);
         }
         $record->update($request->all());
         return response()->json(['message' => 'Record updated successfully', 'data' => $record], 200);
 
     }
     public function selectall(){
         $record=TenantUser::all();
         if (!$record){
             return response()->json(['message'=>'Record not found'],404);
 
         }
         return response()->json(['message' => 'all data dispaly', 'data' => $record], 200);
     }
     public function deleteuser($id){
         $user=TenantUser::find($id);
         if (!$user){
             return response()->json(['message'=>'Record not found'],404);
 
         }
         $user->delete();
         return response()->json(['message' => 'User deleted successfully'], 200);
 
 
     }
     public function forgotpasscode(Request $request){
         $email=$request->input('email');
         $checkemail=TenantUser::where('email',$email)->first();
       
         if(!$checkemail){
             return response()->json(['message' => 'Email not Found'], 404);
 
         }
         
     try{
         $random=mt_rand(0000,9999);
         $data = ['rand' => $random]; 
         $inputdata=['email'=>$email,'otp'=>Hash::make($random)];
         $checkexist=ForgotpassModel::where('email',$email)->first();
         Mail::to($email)->send(new ForgotMailtemp($data));

     
     if ($checkexist){
         $checkexist->update($inputdata);
     }
     else{
         $resultdata=ForgotpassModel::create($inputdata);
 
     }
     
     return response()->json(['message'=>'email Sent'],203);
 } catch (\Exception $e) {
     // Log the error or handle it appropriately
     \Log::error($e);
     return response()->json(['message' => 'Failed to send email'], 500);
 }
 
     }
 public function verifyotp(Request $request){
     $otp=$request->input('otp');
     $email=$request->input('email');
     $dataopt=ForgotpassModel::where('email',$email)->first();
     $gethashpass=$dataopt->otp;
     //verify otp
     if($dataopt && Hash::check($otp,$gethashpass)){
         return response().json(['message'=>'verify'],201);
     }
     else{
         return response().json(['message'=>'not verify'],203);
     }
 
 }
 public function updatepass(Request $request){
     $email=$request->input('email');
     $passcode=Hash::make($request->input('passcode'));
     $getdata=TenantUser::where('email',$email)->first();
     $updatedata=['passcode'=>$passcode];
     $updatepass=$getdata->update($updatedata);
     if ($updatepass){
         return response().json(['message'=>'Password Change'],201); 
     }
 
 }
     
     //
 }
