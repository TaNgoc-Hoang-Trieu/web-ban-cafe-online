<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ShopController;

route::get('/',[HomeController::class,'home']);

route::get('/contact',[HomeController::class,'contact']);

route::get('/shop',[HomeController::class,'shop']);

route::get('myorders',[HomeController::class,'myorders'])->
middleware(['auth', 'verified']);
    
route::get('my_detail_order/{id}',[HomeController::class,'my_detail_order'])->
middleware(['auth', 'verified']);


route::get('delete_order/{id}',[HomeController::class,'delete_order'])->
    middleware(['auth', 'verified']);

route::get('/dashboard',[HomeController::class,'login_home'])->
    middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admin/dashboard',[HomeController::class,'index'])->
    middleware(['auth','admin']);

    //category
route::get('view_category',[AdminController::class,'view_category'])->
    middleware(['auth','admin']);

route::post('add_category',[AdminController::class,'add_category'])->
    middleware(['auth','admin']);

route::get('delete_category/{id}',[AdminController::class,'delete_category'])->
    middleware(['auth','admin']);

route::get('edit_category/{id}',[AdminController::class,'edit_category'])->
    middleware(['auth','admin']);

route::post('update_category/{id}',[AdminController::class,'update_category'])->
    middleware(['auth','admin']);

    //product
route::get('add_product',[AdminController::class,'add_product'])->
    middleware(['auth','admin']);

route::post('upload_product',[AdminController::class,'upload_product'])->
    middleware(['auth','admin']);

route::get('view_product',[AdminController::class,'view_product'])->
    middleware(['auth','admin']);

route::get('delete_product/{id}',[AdminController::class,'delete_product'])->
    middleware(['auth','admin']);

route::get('delete_orders/{id}',[AdminController::class,'delete_orders'])->
    middleware(['auth','admin']);

route::get('update_product/{slug}',[AdminController::class,'update_product'])->
    middleware(['auth','admin']);

route::post('edit_product/{id}',[AdminController::class,'edit_product'])->
    middleware(['auth','admin']);

route::get('search_product',[AdminController::class,'search_product'])->
    middleware(['auth','admin']);

route::get('search_order',[AdminController::class,'search_order'])->
    middleware(['auth','admin']);
    //orders
route::get('view_orders',[AdminController::class,'view_orders'])->
    middleware(['auth','admin']);
    
route::get('detail_order/{id}',[AdminController::class,'detail_order'])->
    middleware(['auth','admin']);

route::get('on_the_way/{id}',[AdminController::class,'on_the_way'])->
    middleware(['auth','admin']);

route::get('delivered/{id}',[AdminController::class,'delivered'])->
    middleware(['auth','admin']);

route::get('print_pdf/{id}',[AdminController::class,'print_pdf'])->
    middleware(['auth','admin']);
    //user
route::get('view_users',[AdminController::class,'view_users'])->
    middleware(['auth','admin']);
route::get('search_user',[AdminController::class,'search_user'])->
    middleware(['auth','admin']);
route::get('delete_user/{id}',[AdminController::class,'delete_user'])->
    middleware(['auth','admin']);
route::get('a_unlock_account/{id}',[AdminController::class,'a_change_user'])->
    middleware(['auth','admin']);
route::get('a_lock_account/{id}',[AdminController::class,'a_lock_account'])->
    middleware(['auth','admin']);
    //details product

route::get('product_details/{id}',[HomeController::class,'product_details']);
    //cart
route::get('add_cart/{id}',
[HomeController::class,'add_cart'])->middleware(['auth', 'verified']);
route::get('mycart',
[HomeController::class,'mycart'])->middleware(['auth', 'verified']);

route::get('delete_cart/{id}',[HomeController::class,'delete_cart'])->
    middleware(['auth', 'verified']);

route::get('minus_cart/{id}',[HomeController::class,'minus_cart'])->
    middleware(['auth', 'verified']);

route::get('plus_cart/{id}',[HomeController::class,'plus_cart'])->
    middleware(['auth', 'verified']);

    //order
route::post('comfirm_order',
[HomeController::class,'comfirm_order'])->middleware(['auth', 'verified']);

Route::controller(HomeController::class)->group(function(){

    Route::get('stripe/{value}', 'stripe');

    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');

});
route::get('search_product_home',[HomeController::class,'search_product_home']);
route::get('edit_user/{id}',[HomeController::class,'edit_user'])
->middleware(['auth', 'verified']);
route::post('update_user/{id}',[HomeController::class,'update_user'])
->middleware(['auth', 'verified']);

//-----------manager----------
route::get('manager/dashboard',[ManagerController::class,'manager_users'])->
middleware(['auth','manager']);
route::get('m_search_user',[ManagerController::class,'m_search_user'])->
    middleware(['auth','manager']);
route::get('m_delete_user/{id}',[ManagerController::class,'m_delete_user'])->
    middleware(['auth','manager']);
route::get('change_admin/{id}',[ManagerController::class,'change_admin'])->
    middleware(['auth','manager']);
route::get('change_user/{id}',[ManagerController::class,'change_user'])->
    middleware(['auth','manager']);
route::get('unlock_account/{id}',[ManagerController::class,'change_user'])->
    middleware(['auth','manager']);
route::get('lock_account/{id}',[ManagerController::class,'lock_account'])->
    middleware(['auth','manager']);

// shop
route::get('category_search',[ShopController::class,'category_search']);