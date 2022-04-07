<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CatController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

Route::namespace('Admin')->prefix('dashboard')->group(function(){
    Route::get('/login',[AuthController::class,'login'])->name('admin.login');
    Route::post('/dologin',[AuthController::class,'dologin'])->name('admin.doLogin');
   
   Route::middleware('Adminauth')->group(function(){
        Route::get('/logout',[AuthController::class,'logout'])->name('admin.logout');
        Route::get('/',[HomeController::class,'index'])->name('admin.home');
        Route::get('/changestatus/{id}',[HomeController::class,'changestatus'])->name('admin.changestatus');
        Route::post('/changestatus',[HomeController::class,'updatestatus'])->name('admin.buyerstatus.update');
        Route::get('/add_buyer',[HomeController::class,'add_buyer'])->name('admin.buyer.add');
        Route::post('/add_buyer',[HomeController::class,'store_buyer'])->name('admin.buyer.store');
        Route::get('/edit_buyer/{id}',[HomeController::class,'edit_buyer'])->name('admin.editbuyer');
        Route::post('/update_buyer',[HomeController::class,'update_buyer'])->name('admin.buyer.update');

       
        

     //Categoriyes

     Route::group(['prefix'=>'cats'],function(){
      Route::get('/',[CatController::class,'index'])->name('admin.cat.index');
      Route::get('/create',[CatController::class,'create'])->name('admin.cat.create');
      Route::post('/store',[CatController::class,'store'])->name('admin.cat.store');
      Route::get('/edit/{id}',[CatController::class,'edit'])->name('admin.cat.edit');
      Route::post('/update',[CatController::class,'update'])->name('admin.cat.update');
      Route::get('/delete/{id}',[CatController::class,'destroy'])->name('admin.cat.delete');

     }); 
    

   Route::prefix('product')->group(function(){
       Route::get('/',[ProductController::class,'index'])->name('admin.product.index');
       Route::get('/create',[ProductController::class,'create'])->name('admin.product.create');
       Route::post('/store',[ProductController::class,'store'])->name('admin.product.store');

       Route::get('/edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
       Route::post('/update',[ProductController::class,'update'])->name('admin.product.update');

       Route::get('/delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');


      });

      //orders//
      Route::get('/orders',[OrderController::class,'index'])->name('admin.orders.index');
      Route::get('/view-order/{id}',[OrderController::class,'view'])->name('admin.orders.view');
      Route::get('/orderstatus/{id}',[OrderController::class,'orderstatus'])->name('admin.orders.update_status');

      
     
      


   });

});