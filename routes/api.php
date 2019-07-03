<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('authenticate', 'AuthController@authenticate')->name('api.authenticate');
    Route::post('register', 'AuthController@register')->name('api.register');
});

Route::group(['middleware' => ['api','auth'], 'prefix' => 'auth'], function () {
    Route::get('authenticated', 'AuthController@getAuthenticatedUser')->name('api.authenticated');
});

Route::group(['middleware' => ['api','auth'],'prefix' => 'supplier'],function (){
    Route::get('get/{suppliers_id}','SupplierController@getSupplier')->name('supplier.getSupplier');
    Route::post('add/','SupplierController@createSupplier')->name('supplier.createSupplier');
    Route::put('edit/{supplier_id}','SupplierController@editSupplier')->name('supplier.editSupplier');
    Route::delete('delete/{supplier_id}','SupplierController@deleteSupplier')->name('supplier.deleteSupplier');
});

Route::group(['middleware' => ['api','auth'],'prefix' => 'company'],function (){
    Route::get('cost','CompanyController@returnCompanyTotalCost')->name('company.returnCompanyTotalCost');
});
