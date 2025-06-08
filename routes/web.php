<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\FriendController;

Route::middleware('auth')->group(function () {
    Route::get('/friends/search', [FriendController::class, 'search']);
    Route::post('/friends/request', [FriendController::class, 'sendRequest']);
    Route::get('/friends/requests', [FriendController::class, 'incomingRequests']);
    Route::post('/friends/respond', [FriendController::class, 'respondRequest']);
});
Route::middleware('auth')->get('/friends/api', function (Request $request) {
    $user = $request->user();

    $friends = $user->friendRequests()
        ->where('status', 'accepted')
        ->get()
        ->map(function ($request) use ($user) {
            return $request->sender_id === $user->id ? $request->receiver : $request->sender;
        })
        ->values();

    return response()->json($friends);
});

require __DIR__.'/auth.php';


Route::get('/{any}', function () {
    return Inertia::render('Dashboard'); // like 'Dashboard' or 'NotFound'
})->where('any', '.*');