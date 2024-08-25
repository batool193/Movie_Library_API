<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


/**
 * Register API routes for the Movie resource
 * 
 * This will automatically create routes for the following actions:
 * - index: GET /movies
 * - store: POST /movies
 * - show: GET /movies/{movie}
 * - update: PUT/PATCH /movies/{movie}
 * - destroy: DELETE /movies/{movie}
 */

Route::apiResource("movies",MovieController::class);


/**
 * Register API routes for the Rating resource
 * 
 * This will automatically create routes for the following actions:
 * - index: GET /rating
 * - store: POST /rating
 * - show: GET /rating/{rating}
 * - update: PUT/PATCH /rating/{rating}
 * - destroy: DELETE /rating/{rating}
 */

Route::apiResource("rating",MovieController::class);