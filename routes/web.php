<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('tests','TestController')->except(['destroy', 'update']);;
    Route::resource('roles','RoleController')->except(['store']);
    Route::resource('permissions','PermissionController');
    Route::resource('users','UserController')->except(['show', 'edit', 'update', 'delete']);
    Route::resource('brands','BrandController');
    Route::resource('brand-users','BrandUserController');
    Route::resource('products','ProductController');
    Route::resource('inventories','InventoryController');
    Route::resource('discounts','DiscountController');
    Route::resource('vouchers','VoucherController');
    Route::resource('districts','DistrictController');
    Route::resource('company-names','CompanyNameController');
    Route::resource('delivery-companies','DeliveryCompanyController');
    Route::resource('sales','SaleController');
});

Route::get('view-invoice/{sale}', 'SaleController@viewInvoice')->name('sales.view_invoice');
Route::get('returned-products/{sale}', 'SaleController@returnedProducts')->name('sales.returned_products');
Route::post('returned-products/', 'SaleController@storeReturnedProducts')->name('sales.store_returned_products');
Route::get('generate-invoices/', 'SaleController@generateInvoices')->name('sales.generate_invoices');
Route::post('generate-invoices/', 'SaleController@storeGenerateInvoices');
Route::get('bulk-delete/', 'SaleController@bulkDelete');

Route::get('/get-product', 'InventoryController@getProduct')->name('get_product');
Route::get('/get-company', 'CompanyNameController@getCompany')->name('get_company');
Route::get('/get-district', 'DistrictController@getDistrict')->name('get_district');
Route::get('getCompanyZone', 'DeliveryCompanyController@getCompanyZone');
Route::get('/update-handling-status', 'SaleController@updateHandlingStatus')->name('sales.update_handling_status');
Route::get('/update-delivery-status', 'SaleController@updateDeliveryStatus')->name('sales.update_delivery_status');
Route::get('reports-sales', 'ReportController@sales')->name('reports.sales');
Route::get('getInventoryInfo', 'InventoryController@getInventoryInfo');
Route::get('/table', 'TestController@table');

// Route::get('/get-all-roles', 'RoleController@getAllRoles');