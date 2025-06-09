<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\LocationController;



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () { // routes for session and registration controller
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
use App\Http\Controllers\FriendController;

Route::middleware('auth')->group(function () { // routes for friend management controller
    Route::get('/friends/search', [FriendController::class, 'search']);
    Route::post('/friends/request', [FriendController::class, 'sendRequest']);
    Route::get('/friends/requests', [FriendController::class, 'incomingRequests']);
    Route::post('/friends/respond', [FriendController::class, 'respondRequest']);
});
Route::middleware('auth')->get('/friends/api', function (Request $request) { // API endpoint to get friends list
    $user = $request->user();

    $friendRequests = $user->friendRequests()->where('status', 'accepted');

    $friends = $friendRequests->map(function ($request) use ($user) {
        $friend = $request->sender_id === $user->id ? $request->receiver : $request->sender;

        return [
            'id' => $friend->id,
            'name' => $friend->name,
            'email' => $friend->email,
            'avatar' => $friend->avatar,
            'latitude' => $friend->latitude,
            'longitude' => $friend->longitude,
            'distance_km' => $user->distanceTo($friend),
        ];
    })->values();

    return response()->json($friends);
});

Route::middleware('auth')->get('/api/me', function (Request $request) { // API endpoint to get authenticated user details
    return response()->json($request->user());
});

use App\Http\Controllers\AccountController;

Route::middleware('auth')->group(function () { // routes for account management controller
    Route::get('/my-account', fn () => Inertia\Inertia::render('MyAccount'))->name('account');
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
});

Route::middleware(['auth'])->post('/location', [LocationController::class, 'update']);

Route::post('/location', [LocationController::class, 'update'])->middleware('auth');

require __DIR__.'/auth.php';


Route::get('/{any}', function () { // Catch-all route to redirect any other requests to vue router
    return Inertia::render('Dashboard'); 
})->where('any', '.*');