<?php

use App\Http\Controllers\VaultController;
use App\Http\Resources\Vault as VaultResource;
use App\Models\Vault;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ping', function () {
    return response()->json(['pong']);
});

//Route::apiResources('vault', [VaultController::class]);

Route::prefix('v1')->group(function () {
    Route::get('vault/{vault:owner}', function (Vault $vault){
        return new VaultResource($vault);
    });

    Route::get('vaults', function (Request $request) {
            return VaultResource::collection(Vault::all());
    });
});
