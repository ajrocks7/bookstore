<?php

use Illuminate\Support\Facades\Route;
use Elastic\Elasticsearch\ClientBuilder;
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

//front end
Route::get('/', function () {
   // $client = ClientBuilder::create()
  //  ->setHosts(['localhost:9200'])
   // ->build();
    return view('welcome');
});
Route::post('/Searchbook', [App\Http\Controllers\HomeController::class, 'Searchbook']);
Route::post('/filterbook', [App\Http\Controllers\HomeController::class, 'filterbook']);

Route::post('/Searchsuggestions', [App\Http\Controllers\HomeController::class, 'Searchsuggestions']);
Route::get('/getproductdata/{id}', [App\Http\Controllers\HomeController::class, 'getproductdata']);
Route::get('/indexProduct', [App\Http\Controllers\HomeController::class, 'indexProduct']);
//login 
Route::group(['prefix' => 'Admin'], function(){
    Auth::routes();
  
});

//Admin side
Route::group(['middleware' => 'is_admin'],function(){
    Route::group(['prefix' => 'Admin'], function(){
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
        Route::get('listproducts', [App\Http\Controllers\HomeController::class, 'listproducts'])->name('productlist');
        Route::get('/addproductsbyapi',[App\Http\Controllers\HomeController::class, 'addproductsbyapi']);
        Route::get('addproducts',[App\Http\Controllers\HomeController::class, 'addproducts'])->name('addproducts');
        Route::post('saveproduct',[App\Http\Controllers\HomeController::class, 'saveproduct']);
        Route::get('editproduct/{id}',[App\Http\Controllers\HomeController::class, 'editproduct']);
        Route::post('deleteproduct',[App\Http\Controllers\HomeController::class, 'deleteproduct']);
        Route::get('/deleteindex', [App\Http\Controllers\HomeController::class, 'deleteindex']);
}
);  
}
);

