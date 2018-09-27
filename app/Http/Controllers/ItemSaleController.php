<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale;
use App\SaleDetail;
use App\Item;

class ItemSaleController extends Controller
{
    


    public function saleItems(Request $request)
    {

    	$lst = Sale::orderBy('id','desc')->first();
    	$s_invoice = 10000;
    	if($lst!= null)
    	{
    		$s_invoice= $lst->sale_invoice;

    	}

        $sale = new Sale();
    	$sale->net_total_price = $request->net_total_price;
    	$sale->total_expense = $request->otherExpense;
    	$sale->paid_price = $request->paid_price;
    	$sale->sale_invoice = $s_invoice;
    	if($request->total_discount == null)
    	$sale->total_discount = 0;
        else
    	$sale->total_discount = $request->total_discount;
    	$sale->issueDate = $request->issueDate;
    	$sale->Customer_id = $request->Customer_id;
        $sale->save();



       if(isset($request->item_id))
        foreach ($request->item_id as $key => $value) {

            $item = Item::findorfail($request->item_id[$key]);
            $item->quantity = $item->quantity - $request->quantity[$key];
            $item->save();
        	$s_d = new SaleDetail();
        	$s_d->sale_id = $sale->id;
        	$s_d->price = $request->price[$key];
        	$s_d->item_id = $request->item_id[$key];
        	$s_d->qty = $request->quantity[$key];
        	$s_d->qty_discount = $request->qty_discount[$key];
        	$s_d->save();
        }

    	return redirect(url('/'));
    }


   public  function saleList(Request $request)
     {

     	return view('sale.saleList');
     }
   public function SaleDetail($id)
     {
     	$sale =Sale::findorfail($id);
     	return view('sale.SaleDetail',compact('sale'));
     }

     public function createReport()
     {
        return view('report.createReport');
     }

      public function showReportForm(Request $request)
      {
        return $request->startDate;        
        return view('report.showReport');
      }

     
}
