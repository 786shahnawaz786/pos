<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Item;
use App\Order;
use App\SaleStock;
use App\ReceivedStock;
use App\Supplier;
use App\Category;
use Illuminate\Support\Facades\DB;
class ItemController extends Controller
{
    

    public function itemsList()
    {
    	return view('items.itemsList');
    }

    public function placeOrder()
{
    	return view('items.itemPurchase');
    }

    function purchaseItem(Request $request)
    {
        $inv =10000;
        $last3 = DB::table('orders')->latest('id')->first();
        if(!is_null($last3))
            $inv = $last3->InvoiceNo+1;



    	$order = new Order();
        $order->supplier_id =$request->supplier;
    	$order->otherExpense =$request->otherExpense;
    	$order->issueDate = $request->issueDate;
    	$order->receiveDate = $request->receiveDate;
    	$order->InvoiceNo =$inv;
    	$order->save();
     

    	$i =0;
    	foreach ($request->item_id as $k) {
    		$item = new Purchase();
    		$item->order_id = $order->id;
            $item->title = $request->title[$i];
    		$item->item_id = $request->item_id[$i];
    		$item->description = $request->description[$i];
    		$item->quantity = $request->quantity[$i];
    		$item->totalPayment = $request->price[$i];
    		$item->expense = $request->otherExp[$i];
    		$item->save();
         	$i++;
    		}
    		return redirect(url('pending-orders'));
    }


    public function savePrintOrder(Request $request)
    {

          $inv =10000;
        $last3 = DB::table('orders')->latest('id')->first();
        if(!is_null($last3))
            $inv = $last3->InvoiceNo+1;



        $order = new Order();
        $order->supplier_id =$request->supplier;
        $order->otherExpense =$request->otherExpense;
        $order->issueDate = $request->issueDate;
        $order->receiveDate = $request->receiveDate;
        $order->InvoiceNo =$inv;
        $order->save();
     

        $i =0;
        foreach ($request->item_id as $k) {
            $item = new Purchase();
            $item->order_id = $order->id;
            $item->title = $request->title[$i];
            $item->item_id = $request->item_id[$i];
            $item->description = $request->description[$i];
            $item->quantity = $request->quantity[$i];
            $item->totalPayment = $request->price[$i];
            $item->expense = $request->otherExp[$i];
            $item->save();
            $i++;
            }
            $data = $request;
        return view('purchaseReport',compact('data'))->with('order',$order);
    }
    public function getItems($id)
    {
        $items = Item::where('category_id',$id)->get();
        echo json_encode($items);
    }

    public function getAjaxItem($id)
    {

        $item = Item::findorfail($id);
        echo json_encode($item);
    }


    public function saveCateAjax(Request $request)
    {

        $c =Category::create($request->all());

        echo $c;

    }

    public function saveProduct(Request $request)
    {

        $item = new Item();
        $item->title=$request->title;
        $item->category_id=$request->category_id;
        $item->description = $request->description;
        $item->quantity= 0;
        $item->price= 0;
        $item->gst= 0;
        $item->save();
        echo json_encode($item);
    }

    public function saleItem()
    {

    	return view('items.itemSale');
    }

    public function saleItems(Request $request)
    {
        return $request;
    }


    public function orderList()
    {

    	return view('order.orderList');     
    }

    public function orderDetail($id)
    {

    	$order = Order::findorfail($id);
    	return view('order.orderDetail',compact('order'));
    }

    public function receiveOrderForm()
    {

	return view('order.orderReceive');
    }

    public function getOrder($id)
    {

        $p =Purchase::where('order_id',$id)->get();

        $o =Order::findorfail($id);
        $s = Supplier::findorfail($o->supplier_id);
         
         $data['p']=$p;
         $data['o']=$o;
         $data['s']=$s;
    	echo json_encode($data);

    }
    public function reportForm(Request $request)
    {
         $order =Order::findorfail($request->order_id);
            $order->status ='complete';
            $order->save();
             
            foreach ($request->item_id as $key => $value) {

                $item = Item::findorfail($value);
                //echo $request->quantity[$key]."<br>";
                $item->quantity = $item->quantity + $request->quantity[$key];
                $item->price = $request->price[$key];
                $item->gst = $request->expense[$key];
                $item->update();

                $o_r = new ReceivedStock();
                $o_r->order_id = $request->order_id;
                $o_r->quantity = $request->quantity[$key];
                $o_r->date = date('Y-m-d');
                $o_r->purchaseId = $request->p_id[$key];
                $o_r->save();
            }

        $data = $request;

        return view('report')->with('data',$data)->with('order',$order);
    }

    public function receivePurchase(Request $request)
    {

         $order =Order::findorfail($request->order_id);
            $order->status ='complete';
            $order->save();
             
            foreach ($request->item_id as $key => $value) {

                $item = Item::findorfail($value);
                //echo $request->quantity[$key]."<br>";
                $item->quantity = $item->quantity + $request->quantity[$key];
                $item->price = $request->price[$key];
                $item->gst = $request->expense[$key];
                $item->update();

                $o_r = new ReceivedStock();
                $o_r->order_id = $request->order_id;
                $o_r->quantity = $request->quantity[$key];
                $o_r->date = date('Y-m-d');
                $o_r->purchaseId = $request->p_id[$key];
                $o_r->save();
            }

        return redirect(url('/'));
    }

    public function completeOrderList()
    {
        return view('order.orderComplete');
    }
    public function completeOrderDetail($id)
    {
        $order = Order::findorfail($id);
        return view('order.completeOrderDetail',compact('order'));
    }


    public function saleStockForm()
    {


        return view('sale.saleStock');
    }

    public function getItem($id)
    {
        $item =Item::findorfail($id);
        return $item;
    }

    public function ajaxGetAllItems()
    {
        return Item::all();
    }
    public function saleStock(Request $request)
    {

        foreach ($request->quantity as $key => $value) {
            $qty = Item::findorfail($request->id[$key]);
            if($qty->quantity >= $request->quantity[$key])
            {
            $s_item =new SaleStock();
            $s_item->title = $request->title[$key];
            $s_item->id = $request->id[$key];
            $s_item->price = $request->price[$key];
            $s_item->stockQty = $request->stockQty[$key];
            $s_item->quantity = $request->quantity[$key];
            $s_item->description = $request->description[$key];
            $s_item->date =$request->date;
                $s_item->save();
                
                $qty->quantity = $qty->quantity - $request->quantity[$key];
                $qty->save();
                }
        }
        return back();
    }

    public function saleList()
    {

        return view('sale.saleList');
    }

    public function updateItem(Request $request)
    {

        $i = Item::findorfail($request->id);
        if($i->quantity > 0)
        $i->salePrice =$request->salePrice;
        $i->description=$request->description;
        $i->save();
         return redirect(url('items-list'));
    }

}

