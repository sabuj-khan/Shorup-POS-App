<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{
    public function categoryPageShow(Request $request){
        return view('pages.dashboard.category-page');
    }


    public function categoryListShow(Request $request){
        try{
            $userId = $request->header('id');

            $data = Category::where('user_id', '=', $userId)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Request successfully done',
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

    public function categoryCreateAction(Request $request){
        Try{
            $name = $request->input('name');
            $userId = $request->header('id');

            $data = Category::create([
                'name' => $name,
                'user_id' => $userId,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category has been created successfully',
                'data' => $data 
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to create category'
            ]);
        }
    } 

    public function categoryUpdateAction(Request $request){
        try{
            $userId = $request->header('id');
            $cxategoryId = $request->input('id');
            $name = $request->input('name');

            Category::where('id', '=', $cxategoryId)->where('user_id', '=', $userId)->update([
                'name' => $name
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category has been updated successfully'
            ], 201);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to create category'
            ]);
        }
    } 

    public function categoryDeleteAction(Request $request){
        try{
            $userId = $request->header('id');
            $cxategoryId = $request->input('id');

            Category::where('id', '=', $cxategoryId)->where('user_id', '=', $userId)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Category has been deleted successfully'
            ]);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail to delete category'
            ]);
        }
    } 


    public function categoryByIdAction(Request $request){
        try{
            $userId = $request->header('id');
            $cxategoryId = $request->input('id');

            $data = Category::where('id', '=', $cxategoryId)->where('user_id', '=', $userId)->first();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Request Successfully done',
                'data' => $data
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message' => 'Request fail'
            ]);
        }
    }

    



}
