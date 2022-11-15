<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\UserProfileController;
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

/*
 * Mobile Api
 */
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'verify_mail']);
Route::post('resend', [AuthController::class, 'send_mail']);
Route::post('forget_password', [AuthController::class, 'forget_password']);
Route::post('update_password', [AuthController::class, 'update_password']);

Route::post('contact_us', [\App\Http\Controllers\api\ContactUsController::class, 'contact_us']);

Route::middleware('auth:api')->group(function () {
    Route::get('get_user_info', [UserProfileController::class, 'user_info']);
    Route::post('project_by_userid', [\App\Http\Controllers\api\ProjectController::class, 'project_by_userid']);
    Route::post('get_project_tasks_by_userid', [\App\Http\Controllers\api\TaskListController::class, 'get_project_tasks_by_userid']);
    Route::post('update_task_status', [\App\Http\Controllers\api\TaskListController::class, 'update_task_status']);
    Route::get('logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:api','isAdmin'])->group(function (){
    Route::get('all_users_info', [UserProfileController::class, 'all_users']);
    Route::get('all_projects', [\App\Http\Controllers\api\ProjectController::class, 'all_projects']);
    Route::post('add_project', [\App\Http\Controllers\api\ProjectController::class, 'add_project']);
    Route::post('add_task', [\App\Http\Controllers\api\TaskListController::class, 'add_task']);
    Route::get('edit_project/{id}', [\App\Http\Controllers\api\ProjectController::class, 'edit_project']);
    Route::put('update_project', [\App\Http\Controllers\api\ProjectController::class, 'update_project']);
    Route::delete('delete_project/{id}', [\App\Http\Controllers\api\ProjectController::class, 'delete_project']);
    Route::get('project_tasks/{id}', [\App\Http\Controllers\api\TaskListController::class, 'get_task']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
