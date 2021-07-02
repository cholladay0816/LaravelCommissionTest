<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\CashierWebhookController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CommissionPresetController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OnboardingController;
use Illuminate\Support\Facades\Route;

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

Route::post(
    '/stripe/webhook',
    [CashierWebhookController::class, 'handleWebhook']
);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/explore', [ExploreController::class, 'index'])
->name('explore');

Route::get('/onboarding', [OnboardingController::class, 'index'])
    ->name('onboarding');

Route::get('/creator/{user:name}/{page?}', [CreatorController::class, 'show'])
    ->name('creator.show');

Route::get('/gallery/{gallery}', [\App\Http\Controllers\GalleryController::class, 'show'])
    ->name('gallery.show');

Route::get('/attachments/{attachment}', [AttachmentController::class, 'show'])
    ->middleware('attachments.canview')
    ->name('attachments.show');

Route::get('/reviews/{user}', [\App\Http\Controllers\ReviewController::class, 'index'])
    ->name('reviews.index');

Route::get('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'show'])
    ->name('reviews.show');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/reviews/create/{commission}', [\App\Http\Controllers\ReviewController::class, 'create'])
        ->name('reviews.create');
    Route::post('/reviews/create/{commission}', [\App\Http\Controllers\ReviewController::class, 'store'])
        ->name('reviews.store');
    Route::get('/ratings/create/{review}', [\App\Http\Controllers\RatingController::class, 'create'])
        ->name('ratings.create');
    Route::post('/ratings/create/{review}', [\App\Http\Controllers\RatingController::class, 'store'])
        ->name('ratings.store');

    Route::post('/gallery', [\App\Http\Controllers\GalleryController::class, 'store'])
        ->name('gallery.store');

    Route::resource('/commissionpresets', CommissionPresetController::class);

    Route::resource('/notifications', NotificationController::class, ['index'])
        ->names(['notifications.index']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('commissions')->group(function () {
        Route::get('/new/{user}/{commissionpreset?}', [CommissionController::class, 'create'])
            ->name('commissions.create');
        Route::post('/new/{user}/{commissionpreset?}', [CommissionController::class, 'store'])
            ->name('commissions.store');
        Route::get('/{commission}/checkout', [CommissionController::class, 'checkout'])
            ->middleware('commissions.canview')
            ->name('commissions.checkout');
        Route::get('/{commission}', [CommissionController::class, 'show'])
            ->middleware('commissions.canview')
            ->name('commissions.show');

        Route::put('/{commission}', [CommissionController::class, 'update'])
            ->middleware('commissions.canview')
            ->name('commissions.update');

        Route::delete('/{commission}', [CommissionController::class, 'destroy'])
            ->middleware('commissions.canview')
            ->name('commissions.destroy');

        Route::get('/', [CommissionController::class, 'commissions'])
            ->name('commissions.index');
    });
    Route::get('/orders', [CommissionController::class, 'orders'])
        ->name('commissions.orders');
});
