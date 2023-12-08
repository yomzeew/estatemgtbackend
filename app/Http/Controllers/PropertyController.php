<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\propertyModel;

class PropertyController extends Controller
{
    public function insertproperty(Request $request){
        $this->validate($request, [
            'client_id' => 'required|integer|exists:clienttable,id',
            'client_name' => 'required|string|max:255',
            'property_address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rent_fees' => 'required|numeric',
            'agent_fees' => 'required|numeric',
            'agreement' => 'nullable|string',
            'images' => 'nullable|string', // Assuming it's a base64-encoded string
        ]);
        $data=propertyModel::create($request->all());
        if ($data){
            return response()->json(['message' => 'successfully', 'data' => $data], 201);
        }
        else{
            return response()->json(['message' => 'Not Successfully', 'data' => $data], 203);

        }

    }
    public function selectproperty(){
        $data=propertyModel::all();
        if($data){
            return response()->json (['message'=>'Successfull','data'=>$data],203);
        }
        else{
            return response()->json(['message'=>'Not Successfull']);
        }

    }
    public function deleteproperty($id){
        $user=propertyModel::find($id);
        if (!$user){
            return response()->json(['message'=>'Record not found'],404);

        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
        
    }
    public function updateproperty(Request $request,$id){
        $data=propertyModel::find($id);
        $this->validate($request, [
            'client_id' => 'required|integer|exists:clienttable,id',
            'client_name' => 'required|string|max:255',
            'property_address' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'rent_fees' => 'required|numeric',
            'agent_fees' => 'required|numeric',
            'agreement' => 'nullable|string',
            'images' => 'nullable|string', // Assuming it's a base64-encoded string
        ]);
        if (!$data){
            return response()->json(['message'=>'Record not found'],404);

        }
        $data->update($request->all());
        return response()->json(['message' => 'Property updated successfully'], 200);
        
    }


    
}
