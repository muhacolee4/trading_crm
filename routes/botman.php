<?php

use App\Http\Controllers\Botman\BotmanController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/get-started', [BotmanController::class, 'teleSetup']);