<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FrontController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\frontend\RatingController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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

// Route::get('/home', function () {
//     return view('welcome');
// });

Route::get('/',[FrontendController::class,'index']);

// Auth::Routes();

Route::get('/login',[LoginController::class,'loginView'])->name('login');

Route::post('/authenticate',[LoginController::class,'authenticates']);

Route::get('/logout',[LoginController::class,'logout']);


Route::get('/register',[RegisterController::class,'registerView'])->name('register');

Route::post('/store',[RegisterController::class,'store']);

Route::get('categories',[FrontendController::class,'category']);


Route::get('Category/{slug}',[FrontendController::class,'viewCategory']);


Route::get('Category/{cate_slug}/{prod_slug}',[FrontendController::class,'viewProduct']);


Route::get('product-list',[FrontendController::class,'prodcutListUsingAjax']);

Route::post('search-product',[FrontendController::class,'searchProduct']);

Route::middleware(['auth','isAdmin'])->group(function(){

   Route::get('/dashboard',[FrontController::class,'index']);

   Route::get('/category',[CategoryController::class,'index']);

   Route::get('/addcategory',[CategoryController::class,'addcategory']);

   Route::post('/insertData',[CategoryController::class,'insertData']);

   Route::get('delete/{id}',[CategoryController::class,'delete']);

   Route::get('edit/{id}',[CategoryController::class,'edit']);

   Route::put('update/{id}',[CategoryController::class,'update']);

   Route::get('product',[ProductController::class,'index']);

   Route::get('addproducts',[ProductController::class,'addproduct']);

   Route::post('/insertproduct',[ProductController::class,'insertproduct']);

   Route::get('deletepro/{id}',[ProductController::class,'delete']);

   Route::get('editpro/{id}',[ProductController::class,'edit']);

   Route::put('updatepro/{id}',[ProductController::class,'updatepro']);

   Route::get('orders',[OrderController::class,'orders']);

   Route::get('admin/view-order/{id}',[OrderController::class,'view']);

   Route::put('update-order/{id}',[OrderController::class,'updateOrder']);

   Route::get('order-history',[OrderController::class,'orderHistory']);

   Route::get('users',[DashboardController::class,'users']);

   Route::get('admin/view-users/{id}',[DashboardController::class,'view']);
});

Route::middleware(['auth'])->group(function(){

   Route::get('cart',[CartController::class,'viewCart']);

   Route::post('/update-cart-qty',[CartController::class,'updateQty']);

   Route::get('/checkoutView',[CheckoutController::class,'index']);

   Route::post('/place-order',[CheckoutController::class,'placeOrder']);

   Route::get('my-orders',[UserController::class,'index']);

   Route::get('view-order/{id}',[UserController::class,'view']);


   Route::get('wishlist',[WishlistController::class,'viewWish']);

   Route::post('proceed-to-pay',[CheckoutController::class,'proceedToPay']);

   Route::post('/add-rating',[RatingController::class,'add']);

   Route::get('add-review/{product_slug}/{userreview}',[ReviewController::class,'add']);

   Route::post('add-review',[ReviewController::class,'addReview']);

   Route::get('edit-review/{prod_slug}/{userreview}',[ReviewController::class,'editReview']);

   Route::put('update-review',[ReviewController::class,'updateReview']);

   Route::get('profile',[UserController::class,'Settings']);

   Route::post('profile-set',[UserController::class,'profileStore']);

});
Route::post('/add-to-cart',[CartController::class,'addProduct']);

Route::post('/add-to-wishlist',[WishlistController::class,'addProduct']);


Route::post('/delete-cart-item',[CartController::class,'deletePro']);

Route::post('/delete-wish-item',[WishlistController::class,'deletepro']);

Route::get('/load-cart-data',[CartController::class,'cartCount']);


Route::get('/load-wish-data',[WishlistController::class,'wishCount']);

Route::get('/forgot-password',[ForgotPasswordController::class,"showForgotPasswordForm"])->name('forgot.password.get');

Route::post('/forgot-password',[ForgotPasswordController::class,"submitForgetPasswordForm"])->name('forgot.password.post');

Route::get('reset-password/{token}',[ForgotPasswordController::class,"showResetPasswordForm"])->name('reset.password.get');

Route::post('reset-password',[ForgotPasswordController::class,"submitResetPasswordForm"])->name('reset.password.post');
