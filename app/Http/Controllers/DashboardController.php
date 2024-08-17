<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardController extends Controller
{

    public function reportPageAction(Request $request){
        return view('pages.dashboard.report-page');
    }
    public function dashboardSummary(Request $request){
        try{
            $userId = $request->header('id');

            $product    = Product::where('user_id', '=', $userId)->count();
            $customer   = Customer::where('user_id', '=', $userId)->count();
            $category   = Category::where('user_id', '=', $userId)->count();
            $invoice    = Invoice::where('user_id', '=', $userId)->count();
            $total      = Invoice::where('user_id', '=', $userId)->sum('total', 1);
            $vat        = Invoice::where('user_id', '=', $userId)->sum('vat', 1);
            $discount   = Invoice::where('user_id', '=', $userId)->sum('discount', 1);
            $payable    = Invoice::where('user_id', '=', $userId)->sum('payable', 1);

            $summary = array(
                'products' => $product,
                'customer' => $customer,
                'category' => $category,
                'invoice'  => $invoice,
                'total'    => $total,
                'vat'      => $vat,
                'discount' => $discount,
                'payable'  => $payable,
            );

            return response()->json([
                'status'  => 'success',
                'summary' => $summary
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status'  => 'fail',
                'message' => 'Request fail'
            ]);
        }
    }


    public function salesReportAction(Request $request){
        try{
            $userId = $request->header('id');
            $fromDate = date('Y-m-d', strtotime($request->FromData));
            $tomDate = date('Y-m-d', strtotime($request->ToData));

            $total    = Invoice::where('user_id', '=', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $tomDate)->sum('total');
            $vat      = Invoice::where('user_id', '=', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $tomDate)->sum('vat');
            $discount = Invoice::where('user_id', '=', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $tomDate)->sum('discount');
            $payable  = Invoice::where('user_id', '=', $userId)->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $tomDate)->sum('payable');
            
            $Customerlist = Invoice::where('user_id', '=', $userId)
            ->whereDate('created_at', '>=', $fromDate)
            ->whereDate('created_at', '<=', $tomDate)
            ->with('customer')->get();

            $allData = array(
                'total'     => $total,
                'vat'       => $vat,
                'discount'  => $discount,
                'payable'   => $payable,
                'customer'  => $Customerlist,
                'fromData'  => $request->FromData,
                'toData'  => $request->ToData,
            );
        
            $pdf = Pdf::loadView('pages.report.sales-report', $allData);

            return $pdf->download('SalesReport.pdf');

           

        
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'fail',
                'message'   => 'Request fail',
                'error'     => $e->getMessage()
            ]);
        }



    }





}
