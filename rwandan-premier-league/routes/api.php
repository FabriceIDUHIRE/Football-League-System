<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/getPunishedEntities', function (Request $request) {
    $type = $request->query('type');

    if ($type === 'player') {
        return response()->json(Player::all(['id', 'name']));
    } elseif ($type === 'coach') {
        return response()->json(Coach::all(['id', 'name']));
    } elseif ($type === 'referee') {
        return response()->json(Referee::all(['id', 'name']));
    } elseif ($type === 'team') {
        return response()->json(Team::all(['id', 'name']));
    }

    return response()->json([]);
});

