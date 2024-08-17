<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\InvoiceProduct;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    
    public function salePageAction(Request $request){
        return view('pages.dashboard.sale-page');
    }

    public function invoicePageAction(Request $request){
        return view('pages.dashboard.invoice-page');
    }

    public function invoiceListAction(Request $request){
        try{
            $userId = $request->header('id');

            $data = Invoice::where('user_id', '=', $userId)->with('customer')->get();

            return response()->json([
                'status' => 'success',
                'data'   => $data
            ]);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message'   => 'Request fail'
            ]);
        }
    }

    public function invoiceCreateAction(Request $request){
        DB::beginTransaction();

        try{
            $userId      = $request->header('id');
            $total       = $request->input('total');
            $discount    = $request->input('discount');
            $vat         = $request->input('vat');
            $payable     = $request->input('payable');
            $customer_id = $request->input('customer_id');

            $invoice = Invoice::create([
                'total'         => $total,
                'discount'      => $discount,
                'vat'           => $vat,
                'payable'       => $payable,
                'user_id'       => $userId,
                'customer_id'   => $customer_id
            ]);

            $invoiceID = $invoice->id;

            $products = $request->input('products');

            foreach($products as $singleProduct){
                InvoiceProduct::create([
                    'invoice_id' => $invoiceID,
                    'user_id'    => $userId,
                    'product_id' => $singleProduct['product_id'],
                    'qty'        => $singleProduct['qty'],
                    'sale_price' => $singleProduct['sale_price']
                ]);
            }

            DB::commit();
            return response()->json([
                'status'    =>'success',
                'message'   =>'Request success to create new invoice'
            ], 201);

        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'    =>'fail',
                'message'   =>'Request fail',
                'error'     =>$e->getMessage()
            ], 401);
            
        }
    }


    public function invoiceDetailsAction(Request $request){
       try{
            $userId      = $request->header('id');
            $customer_id = $request->input('customer_id');
            $invoice_id  = $request->input('invoice_id');

            $customers       = Customer::where('user_id', '=', $userId)->where('id', '=', $customer_id)->first();
            $invoices        = Invoice::where('user_id', '=', $userId)->where('id', '=', $invoice_id)->first();

            $invoiveProducts = InvoiceProduct::where('user_id', '=', $userId)->where('invoice_id', '=', $invoice_id)->with('product')->get();

            return array(
                'customers'           => $customers,
                'invoices'            => $invoices,
                'invoiceProducts'     => $invoiveProducts,
            );
       }
       catch(Exception $e){
            return response()->json([
                'status'    => 'success',
                'message'   => 'Request fail'
            ]);
       }
        

    }

    public function invoiceDeleteAction(Request $request){
        DB::beginTransaction();
        try{
            $userId = $request->header('id');
            $invoiceId = $request->input('invoice_id');

            InvoiceProduct::where('user_id', '=', $userId)->where('invoice_id', '=', $invoiceId)->delete();

            Invoice::where('user_id', '=', $userId)->where('id', '=', $invoiceId)->delete();

            DB::commit();

            return response()->json([
                'status'=>'success',
                'message'=>'Request success to delete invoice'
            ]);

        }
        catch(Exception $e){
            DB::rollBack();
            return response()->json([
                'status'=>'fail',
                'message'=>'Request fail !',
                'error' => $e->getMessage()
            ]);
        }

    }





}
