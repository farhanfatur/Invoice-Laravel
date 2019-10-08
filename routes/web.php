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

Route::get('/', function () {
    return view('auth.customer-login');
})->name("customerLogin");
Route::post("customer-login", ["as" => "customer-login", "uses" => "Auth\LoginController@login"]);
Route::get("logout", "Auth\LoginController@logout")->name("adminLogout");
Auth::routes();

Route::group(["prefix" => "customer"], function() {
	Route::group(["middleware" => "authCustomerLogin"], function() {
		Route::get("/", function() {
			return view("content.customer-view");
		})->name("customerView");
	});
});
Route::group(["prefix" => "admin"], function() {
	
		Route::get("/", function() {
			return view("auth.admin-login");
		})->name("adminLogin");
		Route::post("admin-login", ["as" => "admin-login", "uses" => "Auth\AdminLoginController@login"]);
	
			
		Route::post("admin-register", "Auth\AdminRegisterController@register")->name("admin-register");

		Route::get("register", function() {
			return view("auth.admin-register");
		});
	Route::group(["middleware" => "authAdmin"], function() {
		Route::get('home', function() {
			return view("content.admin-view");
		})->name('home');
		
		Route::get("customer", function() {
			return view("content.customer-index");
		});
		Route::get("product", function() {
			return view("content.product-view");
		});
		Route::get("invoice", function() {
			return view("content.invoice-view");
		});
		Route::get("report", function() {
			return view("content.invoice-report");
		});
		Route::post("logout", "Auth\AdminLoginController@logout")->name("adminLogout");
	});
	Route::post("api/productreport", "ReportController@ProductperMonth");
});
