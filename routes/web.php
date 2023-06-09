<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryTypeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecommendationController;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;

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
    return view('welcome');
});

Route::get('/dashboard', function () {

    return view('dashboard');
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about-us');



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/login', [LoginController::class, 'loginuser'])->name('login');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



    
    Route::resource('/department', DepartmentController::class);
    Route::resource('/inventory_type', InventoryTypeController::class);
    Route::resource('/item_category', ItemCategoryController::class);
    Route::resource('/location', LocationController::class);
    Route::resource('/unit_type', UnitTypeController::class);
    Route::resource('/prefix', PrefixController::class);
    Route::resource('/item', ItemController::class);
    Route::resource('/inventory', InventoryController::class);

    
    Route::get('/items.csv', [ItemController::class, 'exportCSV'])->name('item.csv')->withoutMiddleware(['auth']);
    Route::get('/items/print', [ItemController::class, 'print'])->name('item.print')->withoutMiddleware(['auth']);
    Route::get('/items/pdf', [ItemController::class, 'pdf'])->name('item.pdf')->withoutMiddleware(['auth']);
    Route::get('/items/printqr', [ItemController::class, 'printqr'])->name('item.printqr')->withoutMiddleware(['auth']);
    Route::get('/', [ItemController::class, 'guestPage'])->name('guest.page')->withoutMiddleware(['auth']);
    

    Route::get('/get-item-details/{id}', 'InventoryController@getItemDetails');
    Route::get('/fetch-advices', [ItemController::class, 'fetchAdvices'])->name('fetchAdvices');
    Route::get('/items/generateAdviceForAllItems', [ItemController::class, 'generateAdviceForAllItems'])->name('item.generateAdviceForAllItems');
    Route::get('/items/messages', [ItemController::class, 'getMessages'])->name('item.getMessages');
    Route::get('/items/deleted_assets', [ItemController::class, 'deletedAssets'])->name('item.deletedAssets');

    Route::middleware(['auth', 'admin_or_officer'])->group(function () {
        Route::resource('/user', UserController::class);
        Route::get('/users/deleted_users', [UserController::class, 'deletedUsers'])->name('user.deletedUsers');
        Route::put('/users/{id}/restore', [UserController::class, 'restore'])->name('user.restore');
        
    });
    
    Route::get('/item/{id}/details', [ItemController::class, 'showDetails'])
    ->name('item.showDetails')
    ->withoutMiddleware(['auth']);
    Route::put('/items/{id}', [ItemController::class, 'markAsDeleted'])->name('item.markAsDeleted');
    Route::put('/items/{id}/restore', [ItemController::class, 'restore'])->name('item.restore');
    Route::resource('logs', 'App\Http\Controllers\LogController');
    Route::post('/item/fix/{id}', [ItemController::class, 'fix'])->name('item.fix');

 
    







    
    
    





      
      


});

require __DIR__.'/auth.php';