<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group([
    'prefix' => '/auth',
], function () {
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::group(['middleware' => 'auth:user'], function () {
        Route::get('/profile-details', [UserAuthController::class, 'getProfileDetails']);
        Route::post('/logout', [UserAuthController::class, 'logout']);
        Route::post('/change-password', [UserAuthController::class, 'changePassword']);
    });
});

Route::group([
    'prefix' => '/banner_categories',
    'controller' => BannerCategoryController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getCategoryWithBanners');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});

Route::group([
    'prefix' => '/banners',
    'controller' => BannerController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});

Route::group([
    'prefix' => '/vendor_categories',
    'controller' => VendorCategoryController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});

Route::group([
    'prefix' => '/vendors',
    'controller' => VendorController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});

Route::group([
    'prefix' => '/product_categories',
    'controller' => ProductCategoryController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});


Route::group([
    'prefix' => '/product_sub_categories',
    'controller' => ProductSubCategoryController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getSubCategoryWithProducts');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});

Route::group([
    'prefix' => '/commissions',
    'controller' => CommissionController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/attributes',
    'controller' => AttributeController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/attribute_values',
    'controller' => AttributeValueController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/products',
    'controller' => ProductController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('update-status/{id}', 'updateStatus');
});

Route::group([
    'prefix' => '/floors',
    'controller' => FloorController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getFloorWithSpaces');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/spaces',
    'controller' => SpaceController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/sections',
    'controller' => SectionController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/users',
    'controller' => UserController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/wallets',
    'controller' => WalletController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/product_attributes',
    'controller' => ProductAttributeController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/features',
    'controller' => FeatureController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/carts',
    'controller' => CartController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/cart_items',
    'controller' => CartItemController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/orders',
    'controller' => OrderController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});
Route::group([
    'prefix' => '/roles',
    'controller' => RoleController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::group([
    'prefix' => '/media',
    'controller' => MediaController::class,
    // 'middleware' => ''
], function () {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'find');
    Route::post('/', 'create');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});
