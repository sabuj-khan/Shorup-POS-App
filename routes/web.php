<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerifyMiddleware;

// Route::get('/', function () {
//     return view('pages.landing-page');
// });


// Page Route
Route::get('/', [PageController::class, 'landingPage']);

Route::get('/registration', [PageController::class, 'registrationPage']);
Route::get('/login', [PageController::class, 'loginPage']);
Route::get('/sendOTP', [PageController::class, 'sendOTPPage']);
Route::get('/verifyOTP', [PageController::class, 'verifyOTPPage']);
Route::get('/resetPassword', [PageController::class, 'resetPasswordPage'])->middleware(TokenVerifyMiddleware::class);
Route::get('/dashboard', [PageController::class, 'dashboardPage'])->middleware(TokenVerifyMiddleware::class);
Route::get('/userProfile', [PageController::class, 'userProfilePage'])->middleware(TokenVerifyMiddleware::class);



// Auth APIs for Ajux calling
Route::post('/user-registration', [UserController::class, 'userRegistration']);
Route::post('/user-login', [UserController::class, 'userLogin']);
Route::post('/send-otp', [UserController::class, 'sendOTPToEmail']);
Route::post('/verify-otp', [UserController::class, 'verifyOTP']);

// Reset Password
Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware(TokenVerifyMiddleware::class);

Route::get('/logout', [UserController::class, 'logoutAction']);
Route::get('/user-profile', [UserController::class, 'userProfileAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/user-profile-update', [UserController::class, 'userProfileUpdate'])->middleware(TokenVerifyMiddleware::class);


// Category APIs for Ajux calling

Route::get('/categoryPage', [CategoryController::class, 'categoryPageShow'])->middleware(TokenVerifyMiddleware::class);

Route::get('/category-list', [CategoryController::class, 'categoryListShow'])->middleware(TokenVerifyMiddleware::class);
Route::post('/category-create', [CategoryController::class, 'categoryCreateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/category-update', [CategoryController::class, 'categoryUpdateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/category-delete', [CategoryController::class, 'categoryDeleteAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/category-by-id', [CategoryController::class, 'categoryByIdAction'])->middleware(TokenVerifyMiddleware::class);

// Customer APIs for Ajux calling
Route::get('/customers', [CustomerController::class, 'customerPage'])->middleware(TokenVerifyMiddleware::class);

Route::get('/customers-list', [CustomerController::class, 'customerListAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/customers-create', [CustomerController::class, 'customerCreateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/customers-update', [CustomerController::class, 'customerUpdateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/customers-delete', [CustomerController::class, 'customerDeleteAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/customers-by-id', [CustomerController::class, 'customerByIdAction'])->middleware(TokenVerifyMiddleware::class);

// Product APIs for Ajux calling

Route::get('/products', [ProductController::class, 'productPage'])->middleware(TokenVerifyMiddleware::class);

Route::get('/product-list', [ProductController::class, 'productListAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/product-create', [ProductController::class, 'productCreateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/product-update', [ProductController::class, 'productUpdateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/product-delete', [ProductController::class, 'productDeleteAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/product-by-id', [ProductController::class, 'productByIdAction'])->middleware(TokenVerifyMiddleware::class);


// Invoice APIs
Route::get('/salePage', [InvoiceController::class, 'salePageAction'])->middleware(TokenVerifyMiddleware::class);
Route::get('/invoicePage', [InvoiceController::class, 'invoicePageAction'])->middleware(TokenVerifyMiddleware::class);

Route::get('/invoice-list', [InvoiceController::class, 'invoiceListAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/invoice-create', [InvoiceController::class, 'invoiceCreateAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/invoice-details', [InvoiceController::class, 'invoiceDetailsAction'])->middleware(TokenVerifyMiddleware::class);
Route::post('/invoice-delete', [InvoiceController::class, 'invoiceDeleteAction'])->middleware(TokenVerifyMiddleware::class);

// Dashboard Summary
Route::get('/dashboard-sammary', [DashboardController::class, 'dashboardSummary'])->middleware(TokenVerifyMiddleware::class);

// Report APIs
Route::get('/reportPage', [DashboardController::class, 'reportPageAction'])->middleware(TokenVerifyMiddleware::class);
Route::get('/sales-report/{FromData}/{ToData}', [DashboardController::class, 'salesReportAction'])->middleware(TokenVerifyMiddleware::class);





