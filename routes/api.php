<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\ShortlistedController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobileController;

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

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('announcementmobile', [MobileController::class, 'announcementmobile']);

Route::post('validateEmail', [MobileController::class, 'validateEmail']);
Route::post('applicantStatus', [MobileController::class, 'applicantStatus']);

Route::get('teachersmobile', [MobileController::class, 'indexteachers']);
Route::get('teachersmobile/{id}', [MobileController::class, 'singledatateachers']);
Route::post('teachersmobilepicture', [MobileController::class, 'editteacherspicture']);
Route::put('teachersmobileinfo/{id}', [MobileController::class, 'editteachersinfo']);
Route::put('teachersmobilebackground/{id}', [MobileController::class, 'editteachersbackground']);
Route::get('teachersmobileschedule/{id}', [MobileController::class, 'scheduleteachers']);
Route::get('teachersadvisee/{id}', [MobileController::class, 'teachersadvisee']);
Route::put('teacherschangepassword/{id}', [MobileController::class, 'teacherschangepassword']);

Route::get('checkopenregistration', [MobileController::class, 'openregistration']);
Route::get('applicantsmobile', [MobileController::class, 'indexapplicants']);
Route::post('applicantsmobile', [MobileController::class, 'storeapplicants']);

Route::get('studentsmobile', [MobileController::class, 'indexstudents']);
Route::get('studentsmobile/{id}', [MobileController::class, 'singledatastudents']);
Route::post('studentsmobilepicture', [MobileController::class, 'editstudentspicture']);
Route::put('studentsmobileinfo/{id}', [MobileController::class, 'editstudentsinfo']);
Route::put('studentsmobileguardian/{id}', [MobileController::class, 'editstudentsguardian']);
Route::get('studentsmobileschedule/{id}', [MobileController::class, 'schedulestudents']);
Route::get('studentsmobilegrade/{id}', [MobileController::class, 'gradesstudents']);
Route::put('studentschangepassword/{id}', [MobileController::class, 'studentschangepassword']);

Route::get('attendancehomemobile/{id}', [MobileController::class, 'attendancehomepage']);
Route::get('attendancemobile/{id}', [MobileController::class, 'attendance']);
Route::post('attendancemobile', [MobileController::class, 'storeattendance']);
