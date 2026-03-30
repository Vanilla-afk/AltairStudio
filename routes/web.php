<?php

use App\Http\Controllers\Landing\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class);
