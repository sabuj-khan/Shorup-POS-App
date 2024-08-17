<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerPage(Request $request){
        return view('pages.dashboard.customer-page');
    }

    public function customerListAction(Request $request){
        try{
            $userId = $request->header('id');

            $data = Customer::where('user_id', '=', $userId)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Request is successfully done',
                'data' => $data
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail',
            ]);
        }

    }

    public function customerCreateAction(Request $request){
        try{
            $userId = $request->header('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            Customer::create([
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "user_id" => $userId,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer has been created successfully',
            ], 201);


        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to create customer',
            ]);
    }
    }


    public function customerUpdateAction(Request $request){
        try{
            $userId = $request->header('id');
            $customerId = $request->input('id');
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');

            Customer::where('id', '=', $customerId)->where('user_id', '=', $userId)->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer has been updated successfully',
            ], 201);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to create customer',
            ]);
        }
    }


    public function customerDeleteAction(Request $request){
        try{
            $userId = $request->header('id');
            $customerId = $request->input('id');

            Customer::where('id', '=', $customerId)->where('user_id', '=', $userId)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Customer has been delete successfully',
            ], 201);
            
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to delete customer',
            ], 401);
        }
    }


    public function customerByIdAction(Request $request){
        try{
            $userId = $request->header('id');
            $customerId = $request->input('id');

            $data = Customer::where('id', '=', $customerId)->where('user_id', '=', $userId)->first();

            return response()->json([
                'status' => 'success',
                'message' => 'Request is successfully done',
                'data' => $data
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to show perticuler customer',
            ]);
        }
    }











}
