<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\KitchenController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::get('/', function () {
    if (Auth::guest()) {
        //is a Laravel guest so redirect
        return redirect('login');
       }
    return view('main');
});

//Show register form
Route::get('/users/register', [UserController::class, 'create']);

//Show User Management form
Route::get('/users', [UserController::class, 'usermanagement']);

// Store user
Route::post('/users/store', [UserController::class, 'store']);

// Show edit user form
Route::get('/users/{user}/edit', [UserController::class, 'edit']);

//Update user
Route::put('/users/{user}', [UserController::class, 'update']);

//Delete user
Route::delete('/users/{user}', [UserController::class, 'destroy']);

//show login form
Route::get('/login', [UserController::class, 'login']);

//Log user out
Route::post('/logout', [UserController::class, 'logout' ]);

//log user in
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'view']);


//Inventory Management
Route::get('/inventory', [InventoryController::class, 'view']);

//Store catagory
Route::post('/category/store', [InventoryController::class,'category_store']);

//Category Management
Route::get('/inventory/category/add', [InventoryController::class, 'categories']);

//edit category
Route::get('/inventory/categories/{category}/edit', [InventoryController::class, 'category_edit']);

//update category
Route::put('/category/{category}', [InventoryController::class, 'category_update']);

//store item
Route::post('/item/store', [InventoryController::class, 'store']);

//edit item
Route::get('/inventory/items/{item}/edit', [InventoryController::class, 'item_edit']);

//delete item
Route::delete('/items/{item}/delete', [InventoryController::class, 'item_delete']);

//Update item
Route::put('/item/{item}', [InventoryController::class, 'item_update']);

//Item Management
Route::get('/inventory/item/add', [InventoryController::class, 'item']);

//Customers 
Route::get('/customers', [CustomerController::class, 'view']);

// Add customers - View Form
Route::get('/customers/add', [CustomerController::class, 'add']);

// Store Customer
Route::post('/customers/store', [CustomerController::class, 'store']);

// Edit Form Customer
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit']);

// View Particular Customer
Route::get('/customers/{customer}', [CustomerController::class, 'single']);

// Update Customer
Route::put('/customers/{customer}/update', [CustomerController::class, 'update']);

// Delete customer
Route::delete('/customers/{customer}/delete', [CustomerController::class, 'delete']);

//Kitchen 
Route::get('/kitchen', [KitchenController::class, 'index']);

//Bar 
Route::get('/bar', [BarController::class, 'index']);

//Order 
Route::get('/orders', [OrderController::class, 'view']);

// Show add Order form
Route::get('/orders/add', [OrderController::class, 'show']);

// Store Orders
Route::post('/orders/store', [OrderController::class, 'store']);

// Show Add items to order
Route::get('/orders/{order_no}/additems', [OrderController::class, 'additems']);

// Order List Resource
Route::resource('/orders/{id}/additems', OrderItemsController::class);

// update order list item
Route::put('/orderitems/{id}/update', [OrderItemsController::class, 'update_item']);

// update order list item - bar
Route::put('/orderitems/bar/{id}/update', [BarController::class, 'update_item']);

//Tables 
Route::get('/tables', [TableController::class, 'view']);

// Show add table form
Route::get('/tables/add', [TableController::class, 'show']);

// Add table to database
Route::post('/tables/store', [TableController::class, 'store']);

//Reserve table 
Route::get('/tables/{table}', [TableController::class, 'reserve']);

//Reserve table 
Route::post('/tables/{table}/reserve', [TableController::class, 'reserve_update']);

// transactions
Route::get('/reports', function() {
    if (Auth::guest()) {
        //is a Laravel guest so redirect
        return redirect('login');
       }
    return view('reports.index');
});

// Search Items
Route::get('/search/item', [InventoryController::class, 'search']);


// Kitch Ajaxs
Route::get('/ajax/kitchen_new', [AjaxController::class, 'new']);

// PUBLIC Routes
Route::get('/public/tables', [PublicController::class, 'viewTable']);
Route::get('/ajax/public/tables', [PublicController::class, 'fetch']);