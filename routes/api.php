<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\SpeakerResource;
use App\Models\User;

Route::middleware(["throttle:public_api"])->group(function() {
    Route::get("speakers", function() {
        return SpeakerResource::collection(User::all());
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});
