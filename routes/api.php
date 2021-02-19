<?php
use App\Http\Controllers\StudentController;
use app\Http\Controllers\Academic_staffController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::get('/student',[StudentController::class,'index']);
 Route::get('/academicStaff',[Academic_staffControllerController::class,'index']);
Route::get('/greeting', function () {
    $name="Galmy Louis";
    
    return $name;
});

