<?php

// login and register routes

// Login Routes...// Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
// Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'])->name('password');
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'])->name('password');
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm'])->name('reset');
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset'])->name('reset');




Route::middleware(['auth'])->group(function () {
    
Route::post('report-form','ItemController@reportForm');


// Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);


// Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('update-user','AdminController@updateuser');


Route::get("/",function()
{

return view("admin.dashboard");

});
// report rouet
Route::get('create-report',"ItemSaleController@createReport");
Route::post("show-report-form",'ItemSaleController@showReportForm');

Route::get("admin-dashboard",'AdminController@dashboard');
Route::get("profile",'AdminController@profile');

//  ajax get item route

Route::get('get-item/{id}','ItemController@getAjaxItem');
Route::post('update-item','ItemController@updateItem');

///

/*sale items*/
Route::get('sale-item','ItemController@saleItem');
Route::post('sale-items','ItemSaleController@saleItems');
Route::get('sales-list','ItemSaleController@saleList');
Route::get('sale-detail/{id}','ItemSaleController@saleDetail');


/// categories list 
Route::get('categories-list','AdminController@categoriesList');
Route::post('save-category','AdminController@saveCategory');

Route::get('get-items/{id}','ItemController@getItems');
Route::post('save-category-ajax',"ItemController@saveCateAjax");
Route::post('save-order','ItemController@purchaseItem');


/// items route

Route::get('items-list',"ItemController@itemsList");
Route::get("place-order","ItemController@placeOrder");
Route::get('pending-orders','ItemController@orderList');
Route::get('receive-order-form','ItemController@receiveOrderForm');
Route::post('order-save-print','ItemController@savePrintOrder');
Route::post('receive-order','ItemController@receivePurchase');
Route::get('complete-orders-list','ItemController@completeOrderList');
Route::get('complete-order-detail/{id}','ItemController@completeOrderDetail');
Route::get('get-order/{id}','ItemController@getOrder');

Route::get('order-detail/{id}','ItemController@orderDetail');
//supplier route
Route::get("supplier-list","AdminController@supplierList");
Route::post('save-supplier','AdminController@saveSupplier');

// customers
Route::get('customers-list','AdminController@customerList');
Route::post('save-customer','AdminController@saveCustomer');
Route::post('ajax-save-customer','AdminController@ajaxSaveCustomer');
// save product 
Route::post("add-product","ItemController@saveProduct");

});



