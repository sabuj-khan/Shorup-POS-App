<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function productPage(Request $request){
        return view('pages.dashboard.product-page');
    }


    public function productListAction(Request $request){
        try{
            $userId = $request->header('id');

            $data = Product::where('user_id', '=', $userId)->get();

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


    public function productCreateAction(Request $request){
        try{
            $userId = $request->header('id');
            $catId = $request->input('category_id');
            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');

            $img = $request->file('img');
            $time = time();
            $fileName = $img->getClientOriginalName();
            $imageName = "{$userId}-{$time}-{$fileName}";
            $image_url = "uploads/{$imageName}";

            // File Upload
            $img->move(public_path('uploads'), $imageName);

            // Product create
            $data = Product::create([
                'user_id' => $userId,
                'category_id' =>$catId,
                'name' => $name,
                'price' => $price,
                'unit' => $unit,
                'img' => $image_url
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'The product has been created successfully',
                'data' => $data
            ], 201);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to create product'
            ], 401);
        }
    }

    public function productUpdateAction(Request $request){
        try{
            $userId = $request->header('id');
            $productId = $request->input('id');
            $catId = $request->input('category_id');
            $name = $request->input('name');
            $price = $request->input('price');
            $unit = $request->input('unit');

            if($request->hasFile('img')){
                $img = $request->file('img');
                $time = time();
                $fileName = $img->getClientOriginalName();
                $imageName = "{$userId}-{$time}-{$fileName}";
                $image_url = "uploads/{$imageName}";

                // File Upload
                $img->move(public_path('uploads'), $imageName);

                 // Delete File
                 $filePath = $request->input('file_path');
                 File::delete($filePath);

                 // Update product 
                 Product::where('id', '=', $productId)->where('user_id', '=', $userId)->update([
                    'category_id' =>$catId,
                    'name' => $name,
                    'price' => $price,
                    'unit' => $unit,
                    'img' => $image_url
                 ]);

                 return response()->json([
                    'status' => 'success',
                    'message' => 'The product has been updated successfully'
                ]);


            }else{
                Product::where('id', '=', $productId)->where('user_id', '=', $userId)->update([
                    'category_id' =>$catId,
                    'name' => $name,
                    'price' => $price,
                    'unit' => $unit
                 ]);

                 return response()->json([
                    'status' => 'success',
                    'message' => 'The product has been updated successfully'
                ]);
            }

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'The request fail to update product'
            ]);
        }
    }


    public function productDeleteAction(Request $request){
        try{
            $userId = $request->header('id');
            $productId = $request->input('id');

            $filePath = $request->input('file_path');
            File::delete($filePath);

            Product::where('id', '=', $productId)->where('user_id', '=', $userId)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'The product has been deleted successfully'
            ]);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to delete product'
            ]);
        }
    }


    public function productByIdAction(Request $request){
        try{
            $userId = $request->header('id');
            $productId = $request->input('id');

            $data = Product::where('id', '=', $productId)->where('user_id', '=', $userId)->first();

            return response()->json([
                'status' => 'success',
                'data' => $data
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail !'
            ]);
        }
    }









}
