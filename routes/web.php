<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantTableController;

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\InventoryTransactionController;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExpenseController;

use App\Http\Controllers\KitchenOrderController;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\CouponController;
use App\Http\Controllers\FeedbackController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityLogController;

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\WebsiteContentController;
use App\Http\Controllers\EditableContentController;




/*
|--------------------------------------------------------------------------
| CUSTOMER WEBSITE
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'home'])
    ->name('home');

Route::get('/table/{tableNumber}', [FrontendController::class, 'scanTable'])
    ->name('table.scan');

Route::get('/menu', [FrontendController::class, 'menu'])
    ->name('menu');

Route::get('/category/{category}', [FrontendController::class, 'category'])
    ->name('category');

Route::get('/menu-item/{menuItem}', [FrontendController::class, 'show'])
    ->name('menu.show');


/*
|--------------------------------------------------------------------------
| CART
|--------------------------------------------------------------------------
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/add/{menuItem}', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');

Route::post('/cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');


/*
|--------------------------------------------------------------------------
| COUPON
|--------------------------------------------------------------------------
*/

Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])
    ->name('coupon.apply');


/*
|--------------------------------------------------------------------------
| CHECKOUT / ORDERS
|--------------------------------------------------------------------------
*/

Route::get('/checkout', [FrontendController::class, 'checkout'])
    ->name('checkout');

Route::post('/place-order', [FrontendController::class, 'placeOrder'])
    ->name('place.order');

Route::get('/track-order/{order}', [FrontendController::class, 'trackOrder'])
    ->name('track.order');


/*
|--------------------------------------------------------------------------
| RESERVATION
|--------------------------------------------------------------------------
*/

Route::get('/reservation', [FrontendController::class, 'reservation'])
    ->name('reservation.front');

Route::post('/reservation', [FrontendController::class, 'storeReservation'])
    ->name('reservation.store');


/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/about', [FrontendController::class, 'about'])
    ->name('about');

Route::get('/contact', [FrontendController::class, 'contact'])
    ->name('contact');

Route::post('/contact', [FrontendController::class, 'storeContact'])
    ->name('contact.store');


/*
|--------------------------------------------------------------------------
| FEEDBACK / REVIEWS
|--------------------------------------------------------------------------
*/

Route::get('/reviews', [FrontendController::class, 'feedback'])
    ->name('feedback.front');

Route::post('/reviews', [FrontendController::class, 'storeFeedback'])
    ->name('feedback.store');


/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | PDF EXPORTS
    |--------------------------------------------------------------------------
    */

    Route::prefix('export')->group(function () {

        Route::get('/orders', [ExportController::class, 'orders'])
            ->name('export.orders');

        Route::get('/users', [ExportController::class, 'users'])
            ->name('export.users');

        Route::get('/customers', [ExportController::class, 'customers'])
            ->name('export.customers');

        Route::get('/expenses', [ExportController::class, 'expenses'])
            ->name('export.expenses');

        Route::get('/menu-items', [ExportController::class, 'menuItems'])
            ->name('export.menu-items');

    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */

    Route::resource('roles', RoleController::class)
        ->middleware('role:Admin');

    Route::resource('users', UserController::class)
        ->middleware('role:Admin');

    Route::resource('settings', SettingController::class)
        ->middleware('role:Admin');

    Route::put(
        '/website-content/{content}',
        [WebsiteContentController::class, 'update']
    )
        ->name('website-content.update')
        ->middleware('role:Admin');


    /*
    |--------------------------------------------------------------------------
    | EDITABLE CONTENT - ADMIN ONLY
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'role:Admin'])->group(function () {

        Route::get(
            '/editable-content/{page}/{key}/edit',
            [EditableContentController::class, 'edit']
        )
            ->name('editable-content.edit');

        Route::post(
            '/editable-content/{page}/{key}',
            [EditableContentController::class, 'update']
        )
            ->name('editable-content.update');

    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN + MANAGER
    |--------------------------------------------------------------------------
    */

    Route::resource('categories', CategoryController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('menu-items', MenuItemController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('suppliers', SupplierController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('ingredients', IngredientController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('inventory-transactions', InventoryTransactionController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('expenses', ExpenseController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('reports', ReportController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('attendances', AttendanceController::class)
        ->middleware('role:Admin,Manager');

    Route::resource('activity-logs', ActivityLogController::class)
        ->middleware('role:Admin,Manager');


    /*
    |--------------------------------------------------------------------------
    | ADMIN + MANAGER + WAITER
    |--------------------------------------------------------------------------
    */

    Route::resource('customers', CustomerController::class)
        ->middleware('role:Admin,Manager,Waiter');

    Route::resource('orders', OrderController::class)
        ->middleware('role:Admin,Manager,Waiter');

    Route::patch(
        '/orders/{order}/status',
        [OrderController::class, 'updateStatus']
    )
        ->name('orders.updateStatus')
        ->middleware('role:Admin,Manager,Waiter');

    Route::resource('reservations', ReservationController::class)
        ->middleware('role:Admin,Manager,Waiter');

    Route::resource('restaurant-tables', RestaurantTableController::class)
        ->middleware('role:Admin,Manager,Waiter');

    Route::resource('coupons', CouponController::class)
        ->middleware('role:Admin,Manager,Waiter');

    Route::resource('feedback', FeedbackController::class)
        ->middleware('role:Admin,Manager,Waiter');


    /*
    |--------------------------------------------------------------------------
    | ADMIN + CHEF
    |--------------------------------------------------------------------------
    */

    Route::resource('kitchen-orders', KitchenOrderController::class)
        ->middleware('role:Admin,Chef');

    Route::patch(
        '/kitchen-orders/{order}/status',
        [KitchenOrderController::class, 'updateStatus']
    )
        ->name('kitchen-orders.updateStatus');


    /*
    |--------------------------------------------------------------------------
    | CONTACT MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::resource('contacts', ContactController::class)
        ->middleware('role:Admin,Manager');


    /*
    |--------------------------------------------------------------------------
    | MY ORDERS
    |--------------------------------------------------------------------------
    */

    Route::get('/my-orders', [FrontendController::class, 'myOrders'])
        ->name('my.orders');

    Route::post('/my-orders/search', [FrontendController::class, 'searchOrders'])
        ->name('my.orders.search');


    /*
    |--------------------------------------------------------------------------
    | WAITER ORDERS
    |--------------------------------------------------------------------------
    */

    Route::get('/waiter/orders', [OrderController::class, 'waiterOrders'])
        ->name('waiter.orders')
        ->middleware('role:Admin,Manager,Waiter');


    /*
    |--------------------------------------------------------------------------
    | DELIVER ORDERS
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/orders/{order}/deliver',
        [OrderController::class, 'deliverOrder']
    )
        ->name('orders.deliver')
        ->middleware('role:Admin,Manager,Waiter');


    /*
    |--------------------------------------------------------------------------
    | RESTAURANT TABLE AVAILABILITY
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/restaurant-tables/{restaurantTable}/available',
        [RestaurantTableController::class, 'makeAvailable']
    )
        ->name('restaurant-tables.available');

    Route::patch(
        '/restaurant-tables/{table}/available',
        [RestaurantTableController::class, 'markAvailable']
    )
        ->name('restaurant-tables.available');


    /*
    |--------------------------------------------------------------------------
    | WAITER DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/waiter-dashboard', [FrontendController::class, 'waiter'])
        ->middleware('auth')
        ->name('waiter.dashboard');


    /*
    |--------------------------------------------------------------------------
    | DELIVER ORDER
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/orders/{order}/deliver',
        [OrderController::class, 'deliver']
    )
        ->name('orders.deliver');


    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth', 'role:Admin,Waiter'])->group(function () {

        Route::resource('notifications', NotificationController::class);

    });


    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */

    Route::patch(
        '/orders/{order}/pay',
        [OrderController::class, 'markAsPaid']
    )
        ->name('orders.pay');

    Route::patch(
        '/orders/{order}/paid',
        [OrderController::class, 'markPaid']
    )
        ->name('orders.mark-paid');


    Route::middleware(['auth'])->group(function () {

        Route::get(
            '/editable-content/{page}/{key}/edit',
            [EditableContentController::class, 'edit']
        )
            ->name('editable-content.edit');

        Route::post(
            '/editable-content/{page}/{key}',
            [EditableContentController::class, 'update']
        )
            ->name('editable-content.update');

    });
Route::get(
    '/kitchen-inventory',
    [IngredientController::class, 'inventory']
)->name('kitchen-inventory.index');

    /*
    |--------------------------------------------------------------------------
    | IMPORTANT
    |--------------------------------------------------------------------------
    |
    | DO NOT add the table.scan route here.
    | It should exist ONLY outside the auth middleware
    | near the top of this file.
    |
    |--------------------------------------------------------------------------
    */

});

