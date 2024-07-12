<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('/',function(){
    
    return response()->json([
        'sucess'=>true
    ]);
});

Route::post('/upload',[FileController::class,'upload']);
Route::get('/download/{file}',[FileController::class,'download']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
