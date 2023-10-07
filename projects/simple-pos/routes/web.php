<?php

use App\Http\Controllers\Admin\Api\ApiController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Profile\ProfileController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Stock\StockController;
use App\Http\Controllers\Admin\User\UserController;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);



Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/filter', [DashboardController::class, 'filter']);

    Route::middleware('role:1')->group(function () {
        Route::resource('category', CategoryController::class)->except(['create', 'update', 'show']);
        Route::resource('user', UserController::class)->except(['create', 'update', 'show']);
        Route::resource('product', ProductController::class)->except(['create', 'update']);
        Route::get('setting', [SettingController::class, 'index']);
        Route::post('setting', [SettingController::class, 'store'])->name('setting.store');

        Route::get('profile', [ProfileController::class, 'index']);
        Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
    });

    Route::middleware('role:1,2')->group(function () {
        Route::resource('customer', CustomerController::class)->except(['create', 'update', 'show']);

        Route::get('order/{id}/print', [OrderController::class, 'print']);
        Route::resource('order', OrderController::class)->except(['edit', 'destroy']);

        Route::resource('stock', StockController::class)->except(['create', 'edit', 'update', 'show']);

        Route::prefix('api')->group(function () {
            Route::get('product', [ApiController::class, 'product']);
        });
    });
});

// Route::get('tes', function () {

//     $periode = collect(CarbonPeriod::create('2023-01-01', '2023-03-31'));
//     $product = Product::select('product.*')
//         ->category()
//         ->stock()
//         ->avaragePurchasePrice()
//         ->groupBy('product.id')
//         ->where('product.selling_price', '>', 0)
//         ->get();

//     $customer = Customer::all();


//     DB::beginTransaction();

//     try {
//         for ($i = 0; $i < 100; $i++) {
//             // get random periode
//             $total = 0;

//             // detail
//             $detail = [];

//             // get 2-5 product random
//             $productRandom = $product->random(rand(2, 5));

//             // get random customer
//             $customerRandom = $customer->random();

//             // get random date
//             $date = $periode->random();

//             foreach ($productRandom as $item) {
//                 $stock = Stock::create([
//                     'product_id' => $item->id,
//                     'qty' => rand(1, 5),
//                     'purchase_price' => $item->avarage_purchase_price,
//                     'selling_price' => $item->selling_price,
//                     'description' => 'Order',
//                     'status' => config('constants.stock.out'),
//                     'updated_at' => now(),
//                 ]);

//                 $total += $stock->selling_price * $stock->qty;

//                 $detail[] = new OrderDetail([
//                     'discount' => 0,
//                     'stock_id' => $stock->id,
//                 ]);
//             }

//             $discount = rand(0, 30) * 1000;
//             $change = rand(0, 100) * 1000;
//             $order = Order::create([
//                 'invoice_code' => 'INV-' . Carbon::parse($date)->format('Ymd') . '-' . rand(1000, 9999),
//                 'customer_id' => $customerRandom->id,
//                 'amount' => $total - $discount,
//                 'paid' => $total - $discount + $change,
//                 'change' => $change,
//                 'discount' => $discount,
//                 'status' => 1,
//                 'user_id' => rand(1, 3),
//                 'created_at' => Carbon::parse($date)->format('Ymd') . ' ' . rand(0, 23) . ':' . rand(0, 59) . ':' . rand(0, 59),
//                 'updated_at' => Carbon::parse($date)->format('Ymd') . ' ' . rand(0, 23) . ':' . rand(0, 59) . ':' . rand(0, 59),
//             ]);

//             $order->detail()->saveMany($detail);
//         }
//         DB::commit();
//         return 'success';
//     } catch (\Throwable $th) {
//         DB::rollBack();
//         throw $th;
//     }
// });
