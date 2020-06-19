<?php

use Illuminate\Http\Request;

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

Route::get("/home",function(){
    $token = request()->bearerToken();
    $user = \App\User::where("token",$token)->first();
    if ($token && $user) {
     return [
      "user" => $user
     ];
    }else{
     abort(401);
    }
   });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
