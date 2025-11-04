<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalkController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\ConferenceFavoriteController;
use Laravel\Socialite\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //talks
    Route::get("/talks/create", [TalkController::class, "create"])->name("talks.create");
    Route::post("/talks", [TalkController::class, "store"])->name("talks.store");
    Route::get("/talks", [TalkController::class, "index"])->name("talks.index");
    Route::get("/talks/{talk}", [TalkController::class, "show"])->name("talks.show")->can("view", "talk");
    Route::get("/talks/{talk}/edit", [TalkController::class, "edit"])->name("talks.edit");
    Route::patch("/talks/{talk}", [TalkController::class, "update"])->name("talks.update");
    Route::delete("/talks/{talk}", [TalkController::class, "destroy"])->name("talks.delete");

    Route::get("/conferences", [ConferenceController::class, "index"])->name("conferences.index");
    Route::get("/conferences/{conference}", [ConferenceController::class, "show"])->name("conferences.show");
    Route::post("/conferences/{conference}/favorite", [ConferenceFavoriteController::class, "store"])->name("conferences.favorite");
    Route::delete("/conferences/{conference}/unfavorite", [ConferenceFavoriteController::class, "destroy"])->name("conferences.unfavorite");

});

require __DIR__.'/auth.php';

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
 
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
        "avatar" => $githubUser->avatar
    ]);
 
    Auth::login($user);

    return redirect("/profile");

    // $user->token
});