<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\pageController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\pageHistoryController;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\page;
use App\Models\pageHistory;


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


//Auth::routes(['verified'=>true]);

Route::get('/Usuario/main',[UsuariosController::class,'index']);
Route::post('/Usuario/signUp',[UsuariosController::class,'store']);
Route::post('/Usuario/logIn',[UsuariosController::class,'login']);
Route::delete('/Usuario/delete/{id}',[UsuariosController::class,'destroy']);
Route::put('/Usuario/update',[UsuariosController::class,'update']);

Route::post('/email/verify/{id}/{hash}',[UsuariosController::class,'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/resend',[UsuariosController::class,'resend'])->middleware(['throttle:6,1'])->name('verification.send');
Route::get('/profile', function () {
    // Only verified users may access this route...
})->middleware('verified');

Route::get('/page/consult',[pageController::class,'index']);
Route::post('/page/create',[pageController::class,'store']);
Route::post('/page/update/{id}',[pageController::class,'update']);
Route::post('/page/verification',[pageController::class,'verificationName']);
Route::post('/page/search',[pageController::class,'searchPage']);
Route::post('/page/search/data',[pageController::class,'searchData']);
Route::get('/pageHistory/consult/{id}',[pageHistoryController::class,'consultData']);
Route::get('/pageHistory',[pageHistoryController::class,'index']);



Route::post('/post/create',[PostController::class,'store']);
Route::post('/post/update/{id}',[PostController::class,'update']);

Route::get('/greeting', function () {
    
    // $array = array("foo", "bar", "hello", "world","galmy");
    // var_dump($array);
    // return print_r($array);
    $page=new page();
    $page=DB::table('pages')->max('lastVersion');
  
    return $page;
});

