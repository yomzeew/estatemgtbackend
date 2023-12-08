<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propertytotenants;
use App\Models\TenantUser;

class Propertytotenant extends Controller
{
    public function insertrent (Request $request){
        $this->validate($request,[
            'tenant_id' => 'required|integer|exists:tenanttable,id',
            'property_id' => 'required|integer|exists:propertytable,id',
            'property_address' => 'required|string|max:255',
            'rent_fees' => 'required|numeric',
            'agent_fees' => 'required|numeric',
            'agreement' => 'nullable|string',
            'total_fees'=> 'nullable|string',
            'payment_date'=>'nullable|date',
            'payment_status'=>'nullable|string'
            

        ]);
        //insert into database
        $data=Propertytotenants::create($request->all());
        if ($data){
            return response()->json(['message' => 'successfully', 'data' => $data], 201);
        }
        else{
            return response()->json(['message' => 'Not Successfully', 'data' => $data], 203);

        }


        

    }
    public function selectrent (Request $request){
        $value=$request->input('value');
        $data=TenantUser::where('email',$value)->orWhere('mobileno',$value)->first();
        $id=$data->id;
        $data=Propertytotenants::where('tenant_id',$id);
        if ($data){
            return response()->json(['message' => 'successfully', 'data' => $data], 201);
        }
        else{
            return response()->json(['message' => 'Not Successfully', 'data' => $data], 203);

        }




    }
    public function deleterent ($id){
      $data=Propertytotenants::find($id);

        if (!$data){
            return response()->json(['message' => 'Not Successfully',], 203);
        }
        else{
            $data->delete();
            return response()->json(['message' => 'delete record successfully'], 201);
            

        }




    }
        public function selectallrent (){
            $data=Propertytotenants::all();
        if ($data){
            return response()->json(['message' => 'successfully', 'data' => $data], 201);
        }
        else{
            return response()->json(['message' => 'Not Successfully', 'data' => $data], 203);

        }




    }
    public function updaterent(Request $request, $id)
    {
        $data = Propertytotenants::find($id);
    
        if (!$data) {
            return response()->json(['message' => 'Record not found'], 404);
        }
    
        $paymentStatus = $request->input('payment_status');
        if($paymentStatus==='paid'){
            $date = now()->format('Y-m-d');
        }
        $data->update(['payment_status' => $paymentStatus, 'payment_date'=>$date,]);
    
        if ($data->wasChanged()) {
            return response()->json(['message' => 'Successfully updated'], 201);
        } else {
            return response()->json(['message' => 'No changes made or update not successful'], 203);
        }
    }
    //
}
