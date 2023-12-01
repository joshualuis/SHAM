<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StrandController;
use App\Http\Controllers\ShortlistedController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\DrillController;
// use App\Http\Controllers\TeacherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('kim', [AnnouncementController::class, 'kim'])->name('announcements.kim');

// Route::post('/sections/storeSubject', [SectionController::class, 'storeSubject']);

// Route::get('/posts', [PostController::class, 'show']);
// Route::post('/posts/add', [PostController::class, 'store']);
// Route::put('/posts/edit/{id}', [PostController::class, 'edit']);
// Route::delete('/posts/delete/{id}', [PostController::class, 'destroy']);

// Route::resource('teacher', 'TeacherController');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// FOR TICKET UPDATE
Route::get('ticket', [ApplicantController::class, 'ticket'])->name('ticket');
Route::POST('ticket/update', [ApplicantController::class, 'ticketUpdate'])->name('ticketUpdate');

// FOR RESCHED
Route::get('resched', [ApplicantController::class, 'resched'])->name('resched');
Route::get('resched/details', [ApplicantController::class, 'details'])->name('details');
Route::get('resched/edit', [ApplicantController::class, 'reschedEdit'])->name('reschedEdit');
Route::POST('resched/update', [ApplicantController::class, 'reschedUpdate'])->name('reschedUpdate');

// Route::get('ticket/{applicant}', [ApplicantController::class, 'ticket'])->name('ticket');

// LANDING PAGE
Route::get('/', [AnnouncementController::class, 'show'])->name('landing');

// CONTACT US
Route::post('/contactUs', [AnnouncementController::class, 'contactUs'])->name('contactUs');

Route::get('/charts', [AnnouncementController::class, 'charts']);
Route::get('/absentee', [AnnouncementController::class, 'absentee']);

Route::get('/getData', [AnnouncementController::class, 'getData']);

// LOGIN
Route::get('getLogin', [UserController::class, 'signin'])->name('getLogin');
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('/', [UserController::class, 'logout'])->name('landing');

Route::get('getProfile', [UserController::class, 'getProfile'])->name('getProfile')->middleware('role:admin,teacher,student,ABM,GAS,HUMSS,STEM,CARE,EIM,HE,ICT');
Route::resource('admin/years', YearController::class)->only([
    'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',])->middleware('role:admin');

// FOR SCHOOL YEAR AND SEMESTER
Route::get('admin/schoolyear/{year}', [UserController::class, 'schoolYear'])->name('admin.schoolYear')->middleware('role:admin,student,teacher,ABM,GAS,HUMSS,STEM,CARE,EIM,HE,ICT');
Route::post('admin/subject/semester', [SubjectController::class, 'sem'])->name('admin.sem')->middleware('role:admin,student,teacher,ABM,GAS,HUMSS,STEM,CARE,EIM,HE,ICT');

// For create admin and teacher
Route::get('createAdmin', [UserController::class, 'createAdmin'])->name('create.admin');
// Route::post('teacherUser', [UserController::class, 'teacherUser'])->name('create.teacher');

// For Registration
Route::get('applicants/create', [ApplicantController::class, 'create'])->name('applicants.create');
Route::post('applicants', [ApplicantController::class, 'store'])->name('applicants.store');

// FOR CHANGING PASSWORD STUDENT AND TEACHERS
Route::get('user/showChange', [UserController::class, 'showChange'])->name('user.showChange');
Route::post('user/changePass', [UserController::class, 'changePass'])->name('user.changePass');

// STUDENT ROUTES
Route::middleware('auth', 'role:student')->group(function(){
    Route::get('student/studentSchedule', [StudentController::class, 'studentSchedule'])->name('student.studentSchedule');

    // FOR GRADES
    Route::get('student/viewGrades', [StudentController::class, 'viewGrades'])->name('student.viewGrades');
    // Route::get('student/viewReportCard', [StudentController::class, 'viewReportCard'])->name('student.viewReportCard');
    // Route::get('student/downloadReportCard', [StudentController::class, 'downloadReportCard'])->name('student.downloadReportCard');

    // EDIT PROFILE
    Route::get('student/edit/{student}', [StudentController::class, 'editProfile'])->name('student.editProfile');
    Route::patch('student/update/{student}', [StudentController::class, 'updateProfile'])->name('student.updateProfile');
    // Route::get('student/reportcard', function(){
    //     return view('student.reportcard');
    // });

});


// TEACHER ROUTES
Route::middleware('auth', 'role:teacher,ABM,GAS,HUMSS,STEM,CARE,EIM,HE,ICT')->group(function(){

    Route::get('teacher/teacherSchedule', [TeacherController::class, 'teacherSchedule'])->name('teacher.teacherSchedule');
    Route::get('teacher/subjects', [TeacherController::class, 'subjects'])->name('teacher.subjects');

    // FOR ATTENDANCE
    Route::post('teacher/attendance', [TeacherController::class, 'attendance'])->name('teacher.attendance');
    Route::post('teacher/attendance/store', [TeacherController::class, 'storeAttendance'])->name('teacher.storeAttendance');
    Route::post('teacher/attendance/list', [TeacherController::class, 'attendanceList'])->name('teacher.attendanceList');
    Route::post('teacher/attendance/{teacher}/edit', [TeacherController::class, 'editAttendance'])->name('teacher.editAttendance');
    Route::post('teacher/attendance/update', [TeacherController::class, 'updateAttendance'])->name('teacher.updateAttendance');

    // FOR GRADES
    Route::post('teacher/studentList', [TeacherController::class, 'studentList'])->name('teacher.studentList');
    Route::get('teacher/viewGrades/{teach_curr}/{section}', [TeacherController::class, 'viewGrades'])->name('teacher.viewGrades');
    Route::post('teacher/updateGrade', [TeacherController::class, 'updateGrade'])->name('teacher.updateGrade');

    // FOR TEACHER ADVISORY
    Route::get('teacher/advisory', [TeacherController::class, 'advisory'])->name('teacher.advisory');
    Route::get('teacher/studentGrades/{student}', [TeacherController::class, 'studentGrades'])->name('teacher.studentGrades');
    Route::post('teacher/clearance', [TeacherController::class, 'clearance'])->name('teacher.clearance');

    // PDF GRADE
    Route::get('teacher/viewReportCard/{student}', [TeacherController::class, 'viewReportCard'])->name('teacher.viewReportCard');
    Route::get('teacher/downloadReportCard/{student}', [TeacherController::class, 'downloadReportCard'])->name('teacher.downloadReportCard');
    // PRINT ALL PDF
    Route::post('teacher/allViewReportCard', [TeacherController::class, 'allViewReportCard'])->name('teacher.allViewReportCard');
    Route::post('teacher/allDownloadReportCard', [TeacherController::class, 'allDownloadReportCard'])->name('teacher.allDownloadReportCard');

    // FOR SEMESTER
    Route::post('teacher/subject/semester', [TeacherController::class, 'sem'])->name('teacher.sem');

    // FOR PROFILE
    Route::get('teacher/edit/{teacher}', [TeacherController::class, 'editProfile'])->name('teacher.editProfile');
    Route::patch('teacher/update/{teacher}', [TeacherController::class, 'updateProfile'])->name('teacher.updateProfile');

    //FOR COOR ONLY 
    Route::get('teacher/strands', [TeacherController::class, 'coorStrands'])->name('teacher.strands');
});

Route::resource('admin/registrations', RegistrationController::class)->only([
    'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',])->middleware('role:admin');

Route::get('admin/deadline/{registration}/edit', [RegistrationController::class, 'deadline'])->name('admin.deadline')->middleware('role:admin');
Route::patch('admin/deadline/{registration}/update', [RegistrationController::class, 'deadUpdate'])->name('admin.deadUpdate');

// ADMIN ROUTES
Route::middleware('auth', 'role:admin,ABM,GAS,HUMSS,STEM,CARE,EIM,HE,ICT')->group(function(){

    // UNATTENDED
    Route::get('admin/applicant/unattended', [ApplicantController::class, 'unattended'])->name('applicant.unattended');
    Route::get('admin/applicant/unattended/revert/{applicant}', [ApplicantController::class, 'revert'])->name('applicant.revert');
    Route::patch('admin/applicant/unattended/revertUpdate/{applicant}', [ApplicantController::class, 'revertUpdate'])->name('applicant.revertUpdate');
    // REQUEST RESCHED
    Route::get('admin/applicant/showRequest', [ApplicantController::class, 'showRequest'])->name('applicant.showRequest');
    Route::get('admin/applicant/editRequest/{applicant}', [ApplicantController::class, 'editRequest'])->name('applicant.editRequest');
    Route::patch('admin/applicant/updateRequest/{applicant}', [ApplicantController::class, 'updateRequest'])->name('applicant.updateRequest');


    // SHORTLISTED DELETE
    // Route::get('admin/shortlisted/remove/{shortlisted}', [ShortlistedController::class, 'remove'])->name('shortlisteds.remove');

    // FOR REPORTS
    Route::post('reports/mortality', [UserController::class, 'pdfMortality'])->name('admin.pdfMortality');
    Route::post('reports/risk', [UserController::class, 'pdfRisk'])->name('admin.pdfRisk');
    Route::post('reports/studentYear', [UserController::class, 'pdfStudentYear'])->name('admin.pdfStudentYear');
    Route::post('reports/demographics', [UserController::class, 'pdfDemographics'])->name('admin.pdfDemographics');

    Route::post('reports/abm', [UserController::class, 'pdfABM'])->name('admin.pdfABM');
    Route::post('reports/gas', [UserController::class, 'pdfGAS'])->name('admin.pdfGAS');
    Route::post('reports/humss', [UserController::class, 'pdfHUMSS'])->name('admin.pdfHUMSS');
    Route::post('reports/stem', [UserController::class, 'pdfSTEM'])->name('admin.pdfSTEM');
    Route::post('reports/care', [UserController::class, 'pdfCARE'])->name('admin.pdfCARE');
    Route::post('reports/eim', [UserController::class, 'pdfEIM'])->name('admin.pdfEIM');
    Route::post('reports/he', [UserController::class, 'pdfHE'])->name('admin.pdfHE');
    Route::post('reports/ict', [UserController::class, 'pdfICT'])->name('admin.pdfICT');

    Route::post('reports/graduates', [UserController::class, 'pdfGraduates'])->name('admin.graduates');
    Route::post('reports/interview', [UserController::class, 'pdfInterview'])->name('admin.interview');

    // FOR APPLICANTS EMAILED (REMOVING AND RESCHEDULING)
    Route::get('admin/applicant/schedule/edit/{applicant}', [ApplicantController::class, 'edit'])->name('applicant.edit');
    Route::get('admin/applicant/emailed/remove/{applicant}', [ApplicantController::class, 'emailedRemove'])->name('applicant.emailedRemove');


    // ALL STUDENTS
    Route::get('admin/allStudents', [StudentController::class, 'allStudents'])->name('student.allStudents');

    //DRILLDOWN
    Route::get('admin/drill/{strand}', [DrillController::class, 'drill'])->name('drill.drill');
    Route::get('admin/drill/section/{section}', [DrillController::class, 'viewStudents'])->name('drill.viewStudents');

    // FOR PROFILE
    Route::get('admin/edit/{admin}', [UserController::class, 'editProfile'])->name('admin.editProfile');
    Route::patch('admin/update/{teacher}', [UserController::class, 'updateProfile'])->name('admin.updateProfile');

    // FOR QUOTAS
    Route::get('admin/abmTop', [ApplicantController::class, 'abmTop'])->name('applicants.abmTop');
    Route::get('admin/gasTop', [ApplicantController::class, 'gasTop'])->name('applicants.gasTop');
    Route::get('admin/humssTop', [ApplicantController::class, 'humssTop'])->name('applicants.humssTop');
    Route::get('admin/stemTop', [ApplicantController::class, 'stemTop'])->name('applicants.stemTop');

    Route::get('admin/careTop', [ApplicantController::class, 'careTop'])->name('applicants.careTop');
    Route::get('admin/eimTop', [ApplicantController::class, 'eimTop'])->name('applicants.eimTop');
    Route::get('admin/heTop', [ApplicantController::class, 'heTop'])->name('applicants.heTop');
    Route::get('admin/ictTop', [ApplicantController::class, 'ictTop'])->name('applicants.ictTop');

    // FOR REPORTS
    Route::get('admin/reports', [UserController::class, 'reports'])->name('admin.reports');

    // FOR EMAILED APPLICANTS
    Route::get('admin/applicants/emailed', [ApplicantController::class, 'emailed'])->name('applicants.emailed');
    Route::get('admin/applicants/createEmail', [ApplicantController::class, 'createEmail'])->name('applicants.createEmail');
    Route::post('admin/applicants/emailing', [ApplicantController::class, 'emailing'])->name('applicants.emailing');

    // FOR WAITING LIST
    Route::get('admin/applicants/wait', [ApplicantController::class, 'wait'])->name('applicants.wait');

    // FOR PROMOTION
    Route::get('admin/students/listClearance/{section}', [StudentController::class, 'listClearance'])->name('admin.listClearance');
    Route::post('admin/students/promote', [StudentController::class, 'promote'])->name('admin.promote');
    Route::get('admin/students/promoteGraduation/{section}', [StudentController::class, 'promoteGraduation'])->name('admin.promoteGraduation');


    // FOR DISABLE TEACHER
    Route::get('admin/users/teachers', [UserController::class, 'teacherList'])->name('admin.teacherList');
    Route::get('admin/users/students', [UserController::class, 'studentList'])->name('admin.studentList');
    Route::get('admin/users/{user}', [UserController::class, 'userStatus'])->name('admin.userStatus');
    Route::get('admin/users/edit/{user}', [UserController::class, 'userEdit'])->name('admin.userEdit');
    Route::patch('admin/users/update/{user}', [UserController::class, 'userUpdate'])->name('admin.userUpdate');

    // FOR TRANSFEREE
    Route::post('admin/students/transferee/create', [StudentController::class, 'createTransferee'])->name('admin.createTransferee');
    Route::get('admin/students/transferee/evaluate/{section}', [StudentController::class, 'evaluate'])->name('admin.evaluate');
    Route::post('admin/students/transferee/store', [StudentController::class, 'storeTransferee'])->name('admin.storeTransferee');

    // FOR EDITING AND UPDATING OF STUDENT INFORMATION
    Route::get('admin/students/showStudent/{student}', [StudentController::class, 'showStudent'])->name('admin.showStudent');
    Route::patch('admin/students/showStudent/update/{student}', [StudentController::class, 'showStudentUpdate'])->name('admin.showStudentUpdate');

    // FOR SEMESTER 
    Route::post('admin/student/semester', [StudentController::class, 'sem'])->name('admin.student.sem');

    // FOR DASHBOARD
    Route::get('admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');

    // FOR SUBJECT
    Route::get('admin/subject/{section}/view', [SubjectController::class, 'index'])->name('subjects.index');
    Route::get('admin/subject/{section}/create', [SubjectController::class, 'create'])->name('subjects.create');
    Route::post('admin/subject', [SubjectController::class, 'store'])->name('subjects.store');

    

    Route::resource('admin/subject', SubjectController::class)->only([
        'destroy', 'show', 'update', 'edit',]);

    Route::resource('admin/announcements', AnnouncementController::class)->only([
        'destroy', 'update', 'edit', 'index',]);

    Route::resource('admin/applicants', ApplicantController::class)->only([
        'destroy', 'show', 'update', 'edit', 'index',]);

    Route::resource('admin/curriculums', CurriculumController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);

    Route::resource('admin/shortlisteds', ShortlistedController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);
    
    Route::resource('admin/strands', StrandController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);

    Route::resource('admin/students', StudentController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);


    Route::resource('admin/strands', StrandController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);

    Route::resource('admin/teachers', TeacherController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);

    Route::resource('admin/sections', SectionController::class)->only([
        'destroy', 'show', 'store', 'update', 'edit', 'index', 'create',]);

});

// Route::get('/sections/{section}/createSubject', [SectionController::class, 'createSubject'])->name('sections.createSubject');

// Route::post('sections/createSubject', [SectionController::class, 'createSubject']);

// Route::post('sections/storeSubject', [SectionController::class, 'storeSubject'])->name('sections.storeSubject');   
