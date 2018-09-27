<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Investor;
use App\Supplier;
use App\Customer;
use App\Category;
use Session;
use Image;
use App\User;
class AdminController extends Controller
{



      public function updateUser(Request $request)
      {
        $user = User::findorfail(Auth::user()->id);
        $user->phone = $request->phone;
        $user->message= $request->message;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->save();
        $request->session()->put('success','shahhahah');
        return redirect(url('profile'));

      }

    public function categoriesList()
    {
        return view('category.categoriesList');
    }

    public function saveCategory(Request $request)
    {

        Category::create($request->all());
        Session::flash('message', "Category has been added successfully!!");
        return back();
 
    }

    public function supplierList()
    {
        return view('supplier.supplierList');

    }

    public function customerList()
    {
        return view('customer.customerList');

    }

    public function saveCustomer(Request $request)
    {

        Customer::create($request->all());

        return redirect(url('customers-list'));
    }
    public function ajaxSaveCustomer(Request $request)
    {

        $c =Customer::create($request->all());
        echo json_encode($c);
    }
    
    public function saveSupplier(Request $request)
    {
        $supplier =Supplier::create($request->all());
        return redirect(url("supplier-list"));
    }

    public function dashboard()
    {
        return view("admin.dashboard");
    }
    

    public function profile()
    {
        return view("admin.profile");
    }

    public function addInvestorForm()
    {
    	return view('Investor.addInvestorForm');
    }

    public function saveInvestor(Request $request)
    {

    	$image_path = $request->image->getClientOriginalName();
        $request->image->move(public_path().'/InvestorImages',$image_path);
    	$investor = new Investor();

    	$investor->name = $request->name;
    	$investor->email = $request->email;
    	$investor->phone = $request->phone;
    	$investor->address = $request->address;
    	$investor->mobile = $request->mobile;
    	$investor->image = $image_path;
    	$investor->save();
    	return redirect(url('investor-list'));
    }


    public function investorList()
    {
        return view('Investor.investorsList');
    }

    public function editInvestorForm($id)
    {

        $investor = Investor::findorfail($id);
        return view('Investor.editInvestor',compact('investor'));
    }

    public function updateInvestor(Request $request, $id)
    {
        $investor = Investor::findorfail($id);
        $investor->name = $request->name;
        $investor->email = $request->email;
        $investor->mobile = $request->mobile;
        $investor->address = $request->address;
        $investor->phone = $request->phone;
        if(isset($request->image))
        {
        $image_path = $request->image->getClientOriginalName();

        //$img =Image::make($request->image)->resize(300,200);
        $request->image->move(public_path().'/InvestorImages',$image_path);
        $investor->image = $image_path;
        }
        $investor->save();

        return redirect(url('investor-list'));
    }

    public function investorDetail($id)
    {
        return view('Investor.investorDetail');
    }
    
    public function deleteInvestor($id)
    {
        $investor = Investor::findorfail($id);
        $investor->delete();
        return redirect(url('investor-list'));
    }


}
