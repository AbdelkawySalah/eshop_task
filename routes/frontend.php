<?php

use App\Http\Controllers\FrontEnd\HomepageController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontEnd\AuthController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\WishlistController;
use App\Http\Controllers\FrontEnd\CheckOutController;
use App\Http\Controllers\FrontEnd\OrderController;



Route::group(['namespace'=>'FrontEnd'],function(){

    Route::get('/login',[AuthController::class,'login'])->name('user.login');
    Route::post('/dologin',[AuthController::class,'dologin'])->name('user.doLogin');


    Route::get('/',[HomepageController::class,'index'])->name('front.homepage');
    Route::get('/catgory/{id}',[HomepageController::class,'showproducts'])->name('front.showproducts');
  
    Route::middleware(['auth'])->group(function(){
        Route::get('/logout',[AuthController::class,'logout'])->name('user.logout');
        Route::get('/product/{id}',[HomepageController::class,'viewproduct'])->name('front.viewproduct');
       
        //cart
        Route::post('/add-to-cart',[CartController::class,'addtocart'])->name('front.add-to-cart');
        Route::get('/load-cart-data',[CartController::class,'cartcount']);
        Route::get('cart',[CartController::class,'viewcart']);
        Route::post('update-cart',[CartController::class,'updatecart']);
        Route::post('delete-from-cart',[CartController::class,'deleteproduct']);

        //wishlist
        Route::get('wishlist',[WishlistController::class,'index']);
        Route::post('add-to-wishlist',[WishlistController::class,'add']);
        Route::post('remove-from-wishlist',[WishlistController::class,'remove']);
        Route::get('load-wishlist-data',[WishlistController::class,'wishlistcount']);

       //checkout
       Route::get('checkout',[CheckOutController::class,'index']);
       Route::post('place-order',[CheckOutController::class,'placeorder']);
       Route::get('my-orders',[OrderController::class,'index']);
       Route::get('view-order/{id}',[OrderController::class,'vieworder']);


       //pay
       Route::post('procceed-to-pay',[CheckOutController::class,'pay']);





   });


    // Route::get('/cat/{id}',[CourseController::class,'showcourses'])->name('front.coursescat');
    // Route::get('/cat/{c_id}/course/{cours_id}',[CourseController::class,'showcourse'])->name('front.showcourse');
    // Route::get('/contact',[ContactController::class,'index'])->name('front.contact');
    // Route::post('/message/newsletter',[MessageController::class,'newsletter'])->name('front.message.newsletter');
    // Route::post('/message/contactus',[MessageController::class,'contactus'])->name('front.message.contactus');
    // Route::post('/message/enroll',[MessageController::class,'enroll'])->name('front.message.enroll');


});