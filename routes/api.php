<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('version', function () {
    return response()->json(['version' => config('app.version')]);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    Log::debug('User:' . serialize($request->user()));
    return $request->user();
});


Route::namespace('App\\Http\\Controllers\\API\V1')->group(function () {
    Route::get('profile', 'ProfileController@profile');
    Route::put('profile', 'ProfileController@updateProfile');
    Route::post('change-password', 'ProfileController@changePassword');
    Route::get('tag/list', 'TagController@list');
    Route::get('category/list', 'CategoryController@list');
    Route::post('product/upload', 'ProductController@upload');

    Route::apiResources([
        'user' => 'UserController',
        'product' => 'ProductController',
        'category' => 'CategoryController',
        'tag' => 'TagController',
    ]);
});

Route::get('region', function () {
    return [
        'success' => true,
        "data" => DB::table('regions')->get()
    ];

    return response()->json($response, 200);
});

Route::get('region/{code}/province', function (string $code) {
    return [
        'success' => true,
        "data" => DB::table('provinces')
            ->where("regionCode", $code)
            ->get()
    ];

    return response()->json($response, 200);
});

Route::get('region/{code}/district', function (string $code) {
    return [
        'success' => true,
        "data" => DB::table('districts')
            ->where("regionCode", $code)
            ->get()
    ];

    return response()->json($response, 200);
});

Route::get('province/{code}/district', function (string $code) {
    return [
        'success' => true,
        "data" => DB::table('districts')
            ->where("provinceCode", $code)
            ->get()
    ];

    return response()->json($response, 200);
});

Route::get('district/{code}/barangay', function (string $code) {
    return [
        'success' => true,
        "data" => DB::table('barangays')
            ->where("municipalityCode", $code)
            ->orWhere("cityCode", $code)
            ->get()
    ];

    return response()->json($response, 200);
});

// Route::get('city/{code}/barangay', function (string $code) {
//     return [
//         'success' => true,
//         "data" => DB::table('barangays')->where("cityCode", $code)->get()
//     ];

//     return response()->json($response, 200);
// });

// Route::get('municipality/{code}/barangay', function (string $code) {
//     return [
//         'success' => true,
//         "data" => DB::table('barangays')->where("municipalityCode", $code)->get()
//     ];

//     return response()->json($response, 200);
// });

// Route::get('province/{code}/city', function (string $code) {
//     return [
//         'success' => true,
//         "data" => DB::table('cities')->where("provinceCode", $code)->get()
//     ];

//     return response()->json($response, 200);
// });

// Route::get('province/{code}/municipality', function (string $code) {
//     return [
//         'success' => true,
//         "data" => DB::table('municipalities')->where("provinceCode", $code)->get()
//     ];

//     return response()->json($response, 200);
// });
