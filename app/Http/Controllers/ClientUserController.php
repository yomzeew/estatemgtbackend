<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clientModel;
use App\Models\forgotclientModel;
use App\Mail\ForgotMailtemp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class ClientUserController extends Controller
{
    public function insertclient(Request $request){
        try {
            $datavalidator = $request->validate([
                'mobileno' => 'required|numeric|unique:clienttable',
                'email' => 'required|unique:clienttable',
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
         'nextofkindetails'=>$request->input('nextofkindetails'),
         
     ];
     $tenant=clientModel::create($combineddata);
     return response()->json(['message'=>'Successful','data'=>$tenant],200);
     }
     public function selectuser(Request $request){
         $value=$request->input('value');
         $datauser = clientModel::where('email', $value)->orWhere('mobileno', $value)->first();
         if($datauser){
             return response()->json(['message'=>true,'data'=>$datauser],201);
 
         }
         else{
             return response()->json(['message'=>false],203);
 
         }
        
 
 
     }
     public function selectclient(Request $request){
        $value=$request->input('value');
        $datauser = clientModel::where('email', $value)->orWhere('mobileno', $value)->first();
        if($datauser){
            return response()->json(['message'=>true,'data'=>$datauser],201);

        }
        else{
            return response()->json(['message'=>false],203);

        }
       


    }
     public function loginclient(Request $request){
         $value=$request->input('value');
         $passcode=$request->input('passcode');
         if (!$value) {
             return response()->json(['message' => 'Email or Mobile Number is required'], 400);
         }
         $datauser = clientModel::where('email', $value)->orWhere('mobileno', $value)->first();
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
     public function updateclient(Request $request,$mobileno){
         $record=clientModel::where('mobileno',$mobileno)->first();
         if(!$record){
             return response()->json(['message'=>'Record not found'],404);
         }
         $record->update($request->all());
         return response()->json(['message' => 'Record updated successfully', 'data' => $record], 200);
 
     }
     public function selectallclient(){
         $record=clientModel::all();
         if (!$record){
             return response()->json(['message'=>'Record not found'],404);
 
         }
         return response()->json(['message' => 'all data dispaly', 'data' => $record], 200);
     }
     public function deleteclient($id){
         $user=clientModel::find($id);
         if (!$user){
             return response()->json(['message'=>'Record not found'],404);
 
         }
         $user->delete();
         return response()->json(['message' => 'User deleted successfully'], 200);
 
 
     }
     public function forgotpassclient(Request $request){
         $email=$request->input('email');
         $checkemail=clientModel::where('email',$email)->first();
       
         if(!$checkemail){
             return response()->json(['message' => 'Email not Found'], 404);
 
         }
         
     try{
         $random=mt_rand(0000,9999);
         $data = ['rand' => $random]; 
         $inputdata=['email'=>$email,'otp'=>Hash::make($random)];
         $checkexist=forgotclientModel::where('email',$email)->first();
         Mail::to($email)->send(new ForgotMailtemp($data));

     
     if ($checkexist){
         $checkexist->update($inputdata);
     }
     else{
         $resultdata=forgotclientModel::create($inputdata);
 
     }
     
     return response()->json(['message'=>'email Sent'],203);
 } catch (\Exception $e) {
     // Log the error or handle it appropriately
     \Log::error($e);
     return response()->json(['message' => 'Failed to send email'], 500);
 }
 
     }
 public function verifyotpclient(Request $request){
     $otp=$request->input('otp');
     $email=$request->input('email');
     $dataopt=forgotclientModel::where('email',$email)->first();
     $gethashpass=$dataopt->otp;
     //verify otp
     if($dataopt && Hash::check($otp,$gethashpass)){
         return response().json(['message'=>'verify'],201);
     }
     else{
         return response().json(['message'=>'not verify'],203);
     }
 
 }
 public function updatepassclient(Request $request){
     $email=$request->input('email');
     $passcode=Hash::make($request->input('passcode'));
     $getdata=clientModel::where('email',$email)->first();
     $updatedata=['passcode'=>$passcode];
     $updatepass=$getdata->update($updatedata);
     if ($updatepass){
         return response().json(['message'=>'Password Change'],201); 
     }
 
 }
    
}
