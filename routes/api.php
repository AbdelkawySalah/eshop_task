<?php

use App\Http\Controllers\Api\Admin\CatController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\OrderController;
use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\User\UserAuthController;
use App\Http\Controllers\Api\User\UserOrderController;




use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//catgories

Route::group(['middleware' => 'api','prefix' => 'admin'], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::group(['middleware' => 'api','prefix' => 'user'], function ($router) {
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::post('/refresh', [UserAuthController::class, 'refresh']);
    Route::get('/user-profile', [UserAuthController::class, 'userProfile']);    
});


Route::group(['namespace'=>'Api\Admin','middleware'=>'jwt.verified','prefix'=>'admin'],function(){
     //catgory
     Route::get('/showallcatgories',[CatController::class,'index']);
     Route::post('/addcatgory',[CatController::class,'store']);
     Route::get('/showcatgory/{id}',[CatController::class,'showcatgory']);
     Route::get('/deletecatgory/{id}',[CatController::class,'destroy']);
     Route::post('/update_catgeory',[CatController::class,'update']);

    //products
    Route::get('/showproducts',[ProductController::class,'index']);
    Route::post('/addproduct',[ProductController::class,'store']);
    Route::get('/showproduct/{id}',[ProductController::class,'showproduct']);
    Route::get('/deleteproduct/{id}',[ProductController::class,'destroy']);
    Route::post('/updateproduct',[ProductController::class,'update']);

    //orders
    Route::get('/showorders',[OrderController::class,'index']);
    Route::get('/changeOrderstatus/{id}',[OrderController::class,'orderstatus']);


//user









});

Route::group(['namespace'=>'Api\User','middleware'=>['jwt.verified'],'prefix'=>'user'],function(){
    //catgory
    Route::get('/showorders',[UserOrderController::class,'index']);
    Route::post('/add-to-cart',[UserOrderController::class,'addtocart']);
    Route::get('cart',[UserOrderController::class,'viewcart']);
    Route::post('addorder',[UserOrderController::class,'placeorder']);
    // Route::get('my-orders',[OrderController::class,'index']);

  

});
