<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Attendance;
use App\Models\Registration;
use App\Models\Section; 
use App\Models\Shortlisted;
use App\Models\Student_Schedule; 
use App\Models\Teacher_Curriculum; 
use App\Models\Student_Curriculum; 
use App\Models\Teacher_Schedule; 
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use App\Models\User; 
use App\Models\Teacher;
use App\Models\Strand;
use App\Models\Semester;
use App\Models\Grade;
use App\Models\Year;
use App\Models\Announcement; 
use View;
use Redirect;
use DB;
use Carbon\Carbon;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $attendance = Attendance::all();
        // $appli = Applicant::all();
        // $register = Registration::all();
        // $section = Section::all();
        // $short = Shortlisted::all();
        // $studsched = Student_Schedule::all();
        // $teachcurr = Teacher_Curriculum::all();
        // $teachsched = Teacher_Schedule::all();
        // $student = Student::all();
        // $teach = Teacher::all();

        // foreach($teach as $a)
        // {
        //     $a->year_id = '63f2c7f7c09e0387a8087712';
        //     $a->update();
        // }

        // dd("HEY");
        $announcements = Announcement::all();
        return View::make('admin.announcement.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.announcement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $announcement = new Announcement;
        $announcement->announcement = $request->announcement;
        date_default_timezone_set('Asia/Singapore');
        $announcement->date = date('d-m-y h:i:s A');   
        $announcement->save();
        return Redirect::route('announcements.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function charts()
    {

        $users = User::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 0; $i <= 11; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }
        // dd($userArr);
        return view('admin.chart.charts', compact('userArr'));
    }

    public function absentee()
    {
        $users = User::select('id', 'created_at')
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $usermcount = [];
        $userArr = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        for($i = 0; $i <= 11; $i++){
            if(!empty($usermcount[$i])){
                $userArr[$i] = $usermcount[$i];    
            }else{
                $userArr[$i] = 0;    
            }
        }
        // dd($userArr);
        return view('admin.chart.absentee', compact('userArr'));
    }

    public function show()
    {
        // if(Session::missing('schoolyear')){
        //     $default = Year::all()->last();
        //     $taon = $default->id;
        //     // dump("DEFAULT YUNG YEAR MO TANAGA");
        // }
        // else{
        //     $taon = Session::get('schoolyear');
        //     // dump("AYAN MERON NANG YEAR");
        // }

        // // DEFAULT FIRST SEM
        // $sem = Semester::all()->first();
        // $semester = $sem->id;

        // // dd("HEY");
        // $latest = Announcement::get()->last();
        // // dd($latest->); 
        return View::make('landing');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();
   
        return Redirect::route('announcements.index');
    }

    public function kim(){
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }
        // $sem = Semester::all()->first();
        // $semester = $sem->id;

        // $last = Student::all()->where('year_id', $taon)->last();    
        // $section_subs = Teacher_Schedule::
        // where('section_id', $last->section_id)
        // ->where('year_id', $taon)
        // ->where('semester_id', $semester)
        // ->get();

        // dd($section_subs);

        Student_Schedule::truncate(); 
        // Teacher_Schedule::truncate(); 
        // Teacher_Curriculum::truncate(); 
        Student_Curriculum::truncate(); 
        // Shortlisted::truncate();  
        // Student::truncate();  
        Grade::truncate();  
        // Attendance::truncate();  
        // $users = User::all()->where('role', 'student');
        // foreach($users as $user){
        //     $delete = User::find($user->id);
        //     $delete->delete();
        // }

        // $applicants = Applicant::all();
        // foreach($applicants as $applicant){
        //     // dump($applicant->id);
        //     $applicant->status = 'applicant';
        //     $applicant->update();
        // }

        echo 'DELETED NA BOSSING';
    }

    public function contactUs(Request $request)
    {
        // dd($request);
        // SEND EMAIL TO APPLICANT
        $from = strtolower($request->email);

        $mail_data = [
            'recipient' => 'joshualuis.tanap@gmail.com',
            'from' => 'shamwebandmobile@gmail.com',
            'subject' => 'Feedback',
            'email' => $from,
            'body' => $request->message,
            'fullname' => strtoupper($request->fname) . ', ' . strtoupper($request->lname),
        ];

        // dd($mail_data);
        \Mail::send('email-contactUs', $mail_data, function($message) use($mail_data){
            $message->to($mail_data['recipient'])
            ->from($mail_data['from'])
            ->subject($mail_data['subject']);
        }); 

        // dd('DONE');
        return redirect()->route('landing');
        
    }
}
