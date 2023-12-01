<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Validation\Rule;
use App\Models\Curriculum;
use App\Models\Teacher_Curriculum;
use App\Models\User;
use App\Models\Section;
use App\Models\Student;
use App\Models\Strand;
use App\Models\Teacher_Schedule;
use App\Models\Semester;
use App\Models\Registration;
use App\Models\Attendance;
use App\Models\Student_Curriculum;
use App\Models\Year;
use App\Models\Grade;
use Illuminate\Http\Request;
use View;
use DB;
use Redirect;
use Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Validator;

use Twilio\Rest\Client;
use Exception;
use App\Rules\PhoneNumber;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if ($request->ajax()) {
            $data = Teacher::where('year_id', $taon)->latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'admin.teacher.action')
                    ->make();
        }
      
        return view('admin.teacher.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $rescuers = Rescuer::pluck('rescuer_lname','id');
        $subjects = Curriculum::pluck('name', '_id');
        $strands = array('ABM' => 'ABM', 'GAS' => 'GAS', 'HUMSS' => 'HUMSS', 'STEM' => 'STEM', 'CARE' => 'CARE', 'HE' => 'HE', 'EIM' => 'EIM', 'ICT' => 'ICT');
        // dd($subjects);
        return View::make('admin.teacher.create', compact('subjects', 'strands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        // $validator = Validator::make($request->all(), 
        // [
        //     'email' => ['required', 'email', 'unique:users,email', 'ends_with:@gmail.com'],
        // ]);
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('applicants', 'email')
                    ->whereNull('deleted_at')
                    ->where(function ($query) {
                        $query->where('status', '!=', 'rejected');
                    }),
                Rule::unique('users', 'email')
            ],
        ]);

        // dd("HEY");
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'There was an error with your submission.');
        }

        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        
        $imageString = '';
        for ($i = 0; $i < $length; $i++) {
            $imageString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $comma=",";
        // dd($request);
        $teacher = new Teacher;
        $teacher->educattainment = $request->educattainment;
        $teacher->position = $request->position;
        $teacher->numberofteaching = $request->numberofteaching;
        $teacher->fname = $request->fname;
        if($request->mname == 'N/A' || $request->mname == null)
        {
                $teacher->mname = 'N/A';
        }
        else{
            $teacher->mname = $request->mname;
        }
               
        $teacher->lname = $request->lname;
        $teacher->contact = $request->contact;
        $teacher->email = strtolower($request->email);
        $teacher->image = $request->image;
        $teacher->gender = $request->gender;

        $teacher->birthdate = $request->birthdate;

        $birthdate = new \DateTime($teacher->birthdate);
        $currentDate = new \DateTime();
        $teacher->age = $currentDate->diff($birthdate)->y;

        $teacher->civilstatus = $request->civilstatus;
        $teacher->address = $request->address;
        $teacher->certificate = $request->certificate;
        $teacher->major = $request->major;
        $teacher->minor = $request->minor;

        if($request->coordinator == null)
        {
            $teacher->coordinator = 'teacher';
        }
        else{
            $teacher->coordinator = $request->coordinator;
        }
        $teacher->year_id = $taon;

        if($teacher->mname == 'N/A' || $teacher->mname == null)
        {
            $teacher->fullname = collect([strtoupper($teacher->lname).$comma, strtoupper($teacher->fname)])->implode(' ');
        }
        else{
            $teacher->fullname = collect([strtoupper($teacher->lname).$comma, strtoupper($teacher->fname), strtoupper($teacher->mname)])->implode(' ');
        }

        $image = time().$imageString.'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('storage/images'), $image);
        $input['image'] = 'storage/images/'.$image;
        $teacher->image = $input['image'];

        $teacher->save();

        $id = $teacher->id;
        $last = Teacher::find($id);

        $user = new User;
        $user->name = $teacher->fullname;
        $user->email = $last->email;
        $user->password = bcrypt(strtoupper($last->lname));
        $user->teacher_id = $last->id;
        $user->image = $last->image;
        if($request->coordinator == null)
        {
            $user->role = 'teacher';
        }
        else{
            $user->role = $request->coordinator;
        }
        $user->status = 'enable';
        $user->save();

        return Redirect::route('teachers.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teacher::find($id);

        return View::make('admin.teacher.singleteacher', compact('teacher'));
    }

    public function editProfile($id)
    {   
        $teacher = Teacher::find($id);

        return View::make('teacher.editProfile', compact('teacher'));
    }

    public function updateProfile(Request $request, $id)
    {

        $find = Teacher::find($id);
        $all = Teacher::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->get();
        
        if($request->hasFile('image'))
        {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            
            $imageString = '';
            for ($i = 0; $i < $length; $i++) {
                $imageString .= $characters[random_int(0, $charactersLength - 1)];
            }
            
            $image = time().$imageString.'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('storage/images'), $image);
            // $input['image'] = 'storage/images/'.$image;
            // $teacher->image = $input['image'];
            $imagee = 'storage/images/'.$image;
            
        }

        foreach($all as $teacher)
        {
            $teacher->educattainment = $request->educattainment;
            $teacher->position = $request->position;
            $teacher->numberofteaching = $request->numberofteaching;
            $teacher->fname = $request->fname;
            if($request->mname == 'N/A' || $request->mname == null)
            {
                $teacher->mname = 'N/A';
            }
            else{
                $teacher->mname = $request->mname;
            }
            $teacher->lname = $request->lname;
            $teacher->contact = $request->contact;
            // $teacher->email = $request->email;
            $teacher->gender = $request->gender;
            $teacher->age = $request->age;
            $teacher->civilstatus = $request->civilstatus;
            $teacher->birthdate = $request->birthdate;
            $teacher->address = $request->address;
            $teacher->certificate = $request->certificate;
            $teacher->major = $request->major;
            $teacher->minor = $request->minor;

            $comma=",";

            if($teacher->mname == 'N/A' || $teacher->mname == null)
            {
                $teacher->fullname = collect([strtoupper($teacher->lname).$comma, strtoupper($teacher->fname)])->implode(' ');
            }
            else{
                $teacher->fullname = collect([strtoupper($teacher->lname).$comma, strtoupper($teacher->fname), strtoupper($teacher->mname)])->implode(' ');
            }
            
            // dump($teacher->fullname);
            if($request->hasFile('image'))
            {
                $teacher->image = $imagee;
            }

            $teacher->update();
        }
        
        // Update users
        $user = User::where('name', $find->fullname)->get()->first();
        $user->name = $teacher->fullname;
        $user->image = $teacher->image;
        $user->update();
        Session::put('image',$user->image);

        return Redirect::route('getProfile');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $find = Teacher::find($id);
        $teacher = Teacher::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->get()->first();
        // $teacher_curriculum = DB::table('teacher_curriculum')->where('teacher_id',$id)->pluck('curriculum_id')->toArray();
        $curriculums = Curriculum::pluck('name','_id');
        $strands = array('ABM' => 'ABM', 'GAS' => 'GAS', 'HUMSS' => 'HUMSS', 'STEM' => 'STEM', 'CARE' => 'CARE', 'HE' => 'HE', 'EIM' => 'EIM', 'ICT' => 'ICT');
        $user = User::where('teacher_id', $teacher->id)->get()->first();
        // dd($strands);

        return View::make('admin.teacher.edit', compact('teacher', 'strands', 'user'));
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $comma=",";
        $find = Teacher::find($id);
        $all = Teacher::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->get();

        if($request->hasFile('image'))
        {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            
            $imageString = '';
            for ($i = 0; $i < $length; $i++) {
                $imageString .= $characters[random_int(0, $charactersLength - 1)];
            }
            
            $image = time().$imageString.'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('storage/images'), $image);
            // $input['image'] = 'storage/images/'.$image;
            // $teacher->image = $input['image'];
            $imagee = 'storage/images/'.$image;
            
        }
        

        foreach($all as $teacher)
        {
            $teacher->educattainment = $request->educattainment;
            $teacher->position = $request->position;
            $teacher->numberofteaching = $request->numberofteaching;
            $teacher->fname = $request->fname;
            $teacher->lname = $request->lname;
            if($request->mname == 'N/A' || $request->mname == null)
            {
                $teacher->mname = 'N/A';
            }
            else{
                $teacher->mname = $request->mname;
            }
            $teacher->contact = $request->contact;
            $teacher->email = strtolower($request->email);
            
            $teacher->gender = $request->gender;
            // $teacher->age = $request->age;
            $teacher->civilstatus = $request->civilstatus;
            $teacher->birthdate = $request->birthdate;
            
            $birthdate = new \DateTime($teacher->birthdate);
            $currentDate = new \DateTime();
            $teacher->age = $currentDate->diff($birthdate)->y;

            $teacher->address = $request->address;
            $teacher->certificate = $request->certificate;
            $teacher->major = $request->major;
            $teacher->minor = $request->minor;
            if($request->coordinator == null)
            {
                $teacher->coordinator = 'teacher';
            }
            else{
                $teacher->coordinator = $request->coordinator;
            }
            
            if($teacher->mname == 'N/A' || $teacher->mname == null)
            {
                $teacher->fullname = collect([strtoupper($teacher->lname).$comma, strtoupper($teacher->fname)])->implode(' ');
            }
            else{
                $teacher->fullname = collect([strtoupper($teacher->lname).$comma, strtoupper($teacher->fname), strtoupper($teacher->mname)])->implode(' ');
            }

            if($request->hasFile('image'))
            {
                $teacher->image = $imagee;
            }
            $teacher->update();
        }



        // Update users
        $user = User::where('name', $find->fullname)->get()->first();

        $user->name = $teacher->fullname;
        $user->email = $teacher->email;
        if($request->coordinator == null)
        {
            $user->role = 'teacher';   
        }
        else{
            $user->role = $request->coordinator;   
        }
        $user->status = 'enable';

        if($request->hasFile('image'))
        {
            $user->image = $imagee;
        }

        $user->update();
        // dd("ASA DULO KA TANGA");

        return Redirect::route('teachers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);


        // $user = User::where('teacher_id', $teacher->id)->get();
        $user = User::where('name', $teacher->fullname)->get()->first();
        // dd($user);
        $teacher->delete();
        $user->delete();
        return Redirect::route('teachers.index');
    }

    public function sem(Request $request)
    {
        // dd($request);
        Session::put('semester', $request->semester_id);

        return Redirect::route('teacher.subjects');

    }

    public function coorStrands(){
        Session::forget('mon_error');Session::forget('tue_error');Session::forget('wed_error');Session::forget('thu_error');Session::forget('fri_error');
        Session::forget('schedules');
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump($default);
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }

        if(Auth()->user()->role == 'ABM'){
            $abm_strand = Strand::where('code', 'ABM')->get();foreach($abm_strand as $abm){$abm_id = $abm->id;}
            $abm = Strand::where('code', 'ABM')->get()->first();
            $name = $abm->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $abm_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'GAS'){
            $gas_strand = Strand::where('code', 'GAS')->get();foreach($gas_strand as $gas){$gas_id = $gas->id;}
            $gas = Strand::where('code', 'GAS')->get()->first();
            $name = $gas->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $gas_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'HUMSS'){
            $humss_strand = Strand::where('code', 'HUMSS')->get();foreach($humss_strand as $humss){$humss_id = $humss->id;}
            $humss = Strand::where('code', 'HUMSS')->get()->first();
            $name = $humss->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $humss_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'STEM'){
            $stem_strand = Strand::where('code', 'STEM')->get();foreach($stem_strand as $stem){$stem_id = $stem->id;}
            $stem = Strand::where('code', 'STEM')->get()->first();
            $name = $stem->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $stem_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'CARE'){
            $care_strand = Strand::where('code', 'CARE')->get();foreach($care_strand as $care){$care_id = $care->id;}
            $care = Strand::where('code', 'CARE')->get()->first();
            $name = $care->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $care_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'EIM'){
            $eim_strand = Strand::where('code', 'EIM')->get();foreach($eim_strand as $eim){$eim_id = $eim->id;}
            $eim = Strand::where('code', 'EIM')->get()->first();
            $name = $eim->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $eim_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'HE'){
            $he_strand = Strand::where('code', 'HE')->get();foreach($he_strand as $he){$he_id = $he->id;}
            $he = Strand::where('code', 'HE')->get()->first();
            $name = $he->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $he_id)->with('teacher')->where('year_id', $taon)->get();
        }
        if(Auth()->user()->role == 'ICT'){
            $ict_strand = Strand::where('code', 'ICT')->get();foreach($ict_strand as $ict){$ict_id = $ict->id;}
            $ict = Strand::where('code', 'ICT')->get()->first();
            $name = $ict->name;
            $strand = Section::with('teacher_schedule')->where('strand_id', $ict_id)->with('teacher')->where('year_id', $taon)->get();
        }
        
        return View::make('admin.student.strand', compact(
            'strand','name'
        ));

    }

    public function subjects()
    {
        // dd('HEY');
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }


        $teacher_id = Auth::user()->teacher_id;
        $schedules = Teacher_Curriculum::where('teacher_id', $teacher_id)->where('year_id',  $taon)->where('semester_id', $semester)->get(); 

        // dd($schedules);
        $dup_cur = array();

        foreach($schedules as $sub){
            array_push($dup_cur, $sub->curriculum_id);
        }
        
        $f_arr = array_unique($dup_cur);
        $aray = array();
        foreach($f_arr as $curr)
        {
            $subjects = Teacher_Curriculum::with('teacher')->with('section')->with('curriculum')->where('teacher_id', $teacher_id)->where('curriculum_id', $curr)->where('year_id',  $taon)->where('semester_id', $semester)->get();  
            $sub = Curriculum::where('_id', $curr)->get();
            foreach($sub as $s)
            {
                $aray[$s->name] = $subjects;
            }

        }

        $fetch = Teacher_Curriculum::where('curriclum_id', '63e00e95c96ed692e10ea31e')->where('teacher_id', '63de88823e464e6d2a0eb537')->get();
        // dd($fetch, $aray);

        $sem = Semester::find($semester);
        $year = Year::find($taon);

        // dd($aray);
        return View::make('teacher.students', compact( 
            'aray', 'sem', 'year',
        ));

    }

    // LIST OF STUDENTS FOR ATTENDANCE
    public function attendance(Request $request)
    {
        // dd($request);
        $teach_curr = $request->curriculum_id;
        $subject = Teacher_Curriculum::with('section')->with('curriculum')->find($request->curriculum_id);
        // dd($subject);
        $students = Student_Curriculum::with('student')->where('section_id', $request->section_id)->where('curriculum_id', $subject->curriculum_id)->where('teacher_id', $subject->teacher_id)->get()->sortBy('student.lname');
        return View::make('teacher.attendance', compact('students', 'subject', 'teach_curr'));
    }
    
    // LIST OF ALL THE ATTENDANCE OF A SECTION
    public function attendanceList(Request $request)
    {
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }


        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        $curriculum_id = $request->curriculum_id;
        $teacher_id = $request->teacher_id;
        $section_id = $request->section_id;
        $teach_curr = $request->teach_curr;
        $list = Attendance::where('section_id', $request->section_id)
        ->where('teacher_id', $request->teacher_id)
        ->where('curriculum_id', $request->curriculum_id)
        ->where('year_id', $taon)
        ->where('semester_id', $semester)
        ->orderBy('date', 'DESC')
        ->get();

        $non = array();
        foreach($list as $date){
            array_push($non, $date->date);
        }
        $final = array_unique($non);
        return View::make('teacher.attendanceList', compact('final', 'curriculum_id', 'teacher_id', 'section_id', 'teach_curr'));
    }

    //SMS Function
    function gw_send_sms($user,$pass,$sms_from,$sms_to,$sms_msg)  
    {        
        // dd($user,$pass,$sms_from,$sms_to,$sms_msg);   
                $query_string = "api.aspx?apiusername=".$user."&apipassword=".$pass;
                $query_string .= "&senderid=".rawurlencode($sms_from)."&mobileno=".rawurlencode($sms_to);
                $query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";        
                $url = "http://gateway.onewaysms.com.au:10001/".$query_string;       
                $fd = @implode ('', file ($url));      
                if ($fd)  
                {                       
            if ($fd > 0) {
            Print("MT ID : " . $fd);
            $ok = "success";
            }        
            else {
            print("Please refer to API on Error : " . $fd);
            $ok = "fail";
            }
                }           
                else      
                {                       
                            // no contact with gateway                      
                            $ok = "fail";       
                }           
                return $ok;  
    }  

    // STORING OF ATTENDANCE
    public function storeAttendance(Request $request)
    { 
        // dd($request);

        // $this->gw_send_sms($user,$pass,$sms_from,$sms_to,$sms_msg);

        // $basic  = new \Vonage\Client\Credentials\Basic("af30e821", "6iBbTTnFeVgOKqMs");
        // $client = new \Vonage\Client($basic);

        // $response = $client->sms()->send(
        //     new \Vonage\SMS\Message\SMS("639267468786", 'SHAM', 'HI THIS IS THE SHAM DEVELOPER JOSH.')
        // );
        
        // $message = $response->current();
        
        // if ($message->getStatus() == 0) {
        //     echo "The message was sent successfully\n";
        // } else {
        //     echo "The message failed with status: " . $message->getStatus() . "\n";
        // }
        // dd("DONE");

        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }


        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        // dd($request->stud_ids);
        $teacher_id = Auth::user()->teacher_id;

        foreach($request->stud_ids as $id => $status){
            
            
            $new = new Attendance;
            $new->student_id = $id;
            $new->status = strtoupper($status);
            $new->date = $request->date;
            $new->teacher_id = $teacher_id;
            $new->curriculum_id = $request->curriculum;
            $new->section_id = $request->section;
            $new->year_id = $taon;
            $new->semester_id = $semester;
            $new->save();

            if($new->status == 'ABSENT')
            {
                
                $msgDate = Carbon::createFromFormat('Y-m-d', $new->date)->format('F j, Y');  
                $student = Student::find($id);
                $subject = Curriculum::find($request->curriculum);
                
                // ONEWAY SMS
                // $user = "APIRK13NRU4KX";
                // $pass = "APIRK13NRU4KXRK13N";
                // $sms_from = "09267468786";
                // $sms_to = "09460748235";
                // $sms_msg = "Good Day, we are informing you that your son/daughter, " . $student->fullname . " is " . strtoupper($status) . " on " . $msgDate;
                // // UNCOMMENT THIS IF YOU WANT TO SMS NOTIFICATION
                // $this->gw_send_sms($user,$pass,$sms_from,$sms_to,$sms_msg);

                // TWILLIO SMS
                if ($student->guardiancontact != 'N/A') {
                    $parentContact = $student->guardiancontact;
                } elseif ($student->mothercontact != 'N/A') {
                    $parentContact = $student->mothercontact;
                } elseif ($student->fathercontact != 'N/A') {
                    $parentContact = $student->fathercontact;
                } else {
                    $parentContact = 'no contact';
                }

                if($parentContact != 'no contact')
                {
                    $receiver_number = "+639267468786";
                    // $receiver_number = $parentContact;
                    $message = "Good Day, we are informing you that your son/daughter, " . $student->fullname . " is " . strtoupper($status) . " on " . $msgDate;

                    try 
                    {
                        $account_sid = "AC8143bbb8b6e1d705c1e3f00db55945f2";
                        $auth_token = "a37879190b87eff968fec2d69f597a00";
                        $twilio_number = "+16073605684";

                        $client = new Client($account_sid, $auth_token);
                        $client->messages->create($receiver_number, [
                            'from' => $twilio_number, 
                            'body' => $message
                        ]);
                    } 
                    catch (Exception $e) 
                    {
                        dd("Error: ". $e->getMessage());
                    }
                }
            }
            
        }
        // dd();
        return Redirect::route('teacher.subjects');
    }

    // EDITING OF ATTENDANCE
    public function editAttendance(Request $request)
    { 
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }


        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        $subject = Teacher_Curriculum::with('section')->with('curriculum')->find($request->teach_curr);
        $students = Attendance::with('student')
        ->where('section_id', $request->section_id)
        ->where('curriculum_id', $request->curriculum_id)
        ->where('teacher_id', $request->teacher_id)
        ->where('date', $request->date)
        ->where('year_id', $taon)
        ->where('semester_id', $semester)
        ->get();

        foreach($students as $student){
            $date = $student->date;
        }
        return View::make('teacher.attendanceEdit', compact('students', 'subject', 'date'));
    }

    // EDITING OF ATTENDANCE
    public function updateAttendance(Request $request)
    { 
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }


        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        $teacher_id = Auth::user()->teacher_id;
        $todelete = array();
        foreach($request->stud_ids as $id => $status){
            $students = Attendance::with('student')
            ->where('date', $request->date)
            ->where('student_id', $id)
            ->where('curriculum_id', $request->curriculum)
            ->where('section_id', $request->section)
            ->where('teacher_id', $teacher_id)
            ->where('year_id', $taon)
            ->where('semester_id', $semester)
            ->get();
            foreach($students as $student){
                array_push($todelete, $student->id);
            }   
        }
        foreach($todelete as $id){
            $bye = Attendance::find($id);
            $bye->delete();
        }
        foreach($request->stud_ids as $id => $status){
            $new = new Attendance;
            $new->student_id = $id;
            $new->status = strtoupper($status);
            $new->date = $request->date;
            $new->teacher_id = $teacher_id;
            $new->curriculum_id = $request->curriculum;
            $new->section_id = $request->section;
            $new->year_id = $taon;
            $new->semester_id = $semester;
            $new->save();
        }
        return Redirect::route('teacher.subjects');
    }

    // VIEWING OF MASTERLIST
    public function studentList(Request $request)
    {
        // dd($request);
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        // dd($id);
        $teach_curr = $request->curriculum_id;
        $subject = Teacher_Curriculum::with('section')->with('curriculum')->find($request->curriculum_id);

        $currentDateTime = Carbon::now('Asia/Singapore');
        $formattedDateTime = $currentDateTime->format('F j, Y, h:i A');
        // dd($formattedDateTime);
        // dd($subject);

        $regular = Grade::where('teacher_id', $subject->teacher_id)
        ->where('section_id', $subject->section_id)
        ->where('year_id', $taon)
        ->where('semester_id', $subject->semester_id)
        ->where('curriculum_id', $subject->curriculum_id)
        ->get();

        $transferee = Grade::where('teacher_id', $subject->teacher_id)
        ->where('year_id', $taon)
        ->where('semester_id', $subject->semester_id)
        ->where('curriculum_id', $subject->curriculum_id)
        ->whereHas('student', function ($query) {
            $query->where('status', 'Transferee');
        })
        ->get();

        $merge = $regular->merge($transferee);
        $students = $merge->sortBy('student.lname');

        // dd($students);

        return View::make('teacher.studentList', compact('students', 'subject', 'teach_curr'));
    }

    // VIEWING OF GRADES
    public function viewGrades($teach_curr, $section_id, ){
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        $dead = Registration::where('year_id', $taon)->get()->first();

        $currentDate = date('Y-m-d h:i:s');
        $currentDate = date('Y-m-d h:i:s', strtotime($currentDate));

        $startDate = date('Y-m-d h:i:s', strtotime($dead->deadStart));
        $endDate = date('Y-m-d h:i:s', strtotime($dead->deadEnd));

        if ($currentDate < $startDate || $currentDate > $endDate || $dead->deadStat == 'Close') {
            // currentDate is not between startDate and endDate
            // Add your code here for the case when the condition is true
            $edit = 'NO';
        }
        else
        {
            $edit = 'YES';
        }

        // dd($currentDate, $startDate, $endDate);
        $teacher_id = Auth::user()->teacher_id;
        // $teach_curr = $teach_curr;
        $subject = Teacher_Curriculum::with('section', 'curriculum', 'year', 'semester')->find($teach_curr);

        $regular = Grade::where('teacher_id', $subject->teacher_id)
        ->where('section_id', $subject->section_id)
        ->where('year_id', $taon)
        ->where('semester_id', $subject->semester_id)
        ->where('curriculum_id', $subject->curriculum_id)
        ->get();

        $transferee = Grade::where('teacher_id', $subject->teacher_id)
        ->where('year_id', $taon)
        ->where('semester_id', $subject->semester_id)
        ->where('curriculum_id', $subject->curriculum_id)
        ->whereHas('student', function ($query) {
            $query->where('status', 'Transferee');
        })
        ->get();

        $merge = $regular->merge($transferee);
        $grades = $merge->sortBy('student.lname');

        return View::make('teacher.viewGrades', compact('subject', 'teach_curr', 'grades', 'edit'));
    }

    public function updateGrade(Request $request){

        // dd($request);
        $teach_curr = $request->teach_curr;
        $section_id = $request->section_id;
        $grade_ids = $request->grade_ids;
        $q1 = $request->q1;
        $q2 = $request->q2;
        for( $i=0 ; $i<= count($grade_ids)-1 ; $i++)
        {
            $uGrade = Grade::find($grade_ids[$i]);
            $uGrade->q1 = $q1[$i];
            $uGrade->q2 = $q2[$i];
            
            // IF Q1 AND Q2 HAS VALUE
            if($uGrade->q1 != null && $uGrade->q2 != null){
                $sum = $q1[$i] + $q2[$i];
                $final = $sum / 2;
                $uGrade->final = $final;
                
                if($final >= 75)
                {
                    $uGrade->remarks = 'PASSED';
                }
                else{
                    $uGrade->remarks = 'FAILED';
                }
            }
            elseif($uGrade->q1 == null && $uGrade->q2 == null)
            {
                $uGrade->final = null;
                $uGrade->remarks = null;
            }

            $uGrade->update();
        }
        return redirect()->route('teacher.viewGrades', ['teach_curr' => $teach_curr, 'section' => $section_id])->with('message', 'Grades Updated Successfully');
        
    }

    // SHOW ALL STUDENT IN ADVISORY CLASS
    public function advisory(){
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
       
        $teacher = Auth::user()->teacher_id;

        // for finding the year
        $findteacher = Teacher::find($teacher);
        // dd($findteacher);
        $section = Section::where('teacher_id', $teacher)->where('year_id', $taon)->get()->first();

        if($section == null){
            return redirect()->route('getProfile')->with('error', 'This teacher has no Advisory class within that School Year');   
        }
        else{
             $students = Student::where('section_id', $section->id)->where('year_id', $section->year_id)->get()->sortBy('lname');
             return View::make('teacher.advisory', compact('students', 'section'));
        }    
    }

    // VIEW GRADES OF SPECIFIC STUDENT
    public function studentGrades($id){

        if(Session::missing('schoolyear')){
            $default = Year::all()->first();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        
        $student = Student::find($id);
        $year = Year::find($taon);
        $first = array();
        $second = array();
        $grades = Grade::with('curriculum', 'teacher')->where('student_id', $id)->where('year_id', $student->year_id)->get();
     
        foreach($grades as $g){
            if($g->semester->semester == 'First'){if($g->final != null){array_push($first, $g->final);} }
            if($g->semester->semester == 'Second'){if($g->final != null){array_push($second, $g->final);}}}

        if(empty($first)){$firstGWA = 0;}else{$firstGWA = array_sum($first) / count($first);}
        if(empty($second)){$secondGWA = 0;}else{$secondGWA = array_sum($second) / count($second);}


       
        
        return View::make('teacher.studentGrade', compact('student', 'grades','firstGWA', 'secondGWA','year'));
    }   

    public function clearance(Request $request){
        // dd($request->student_ids);
        if($request->student_ids == null)
        {
            return redirect()->back()->with('select', 'Please Select a Student');   
        }
        else
        {
            foreach($request->student_ids as $id){
                $student = Student::find($id);
                // dd($student);
                if($student->clearance == null){
                    $grades = Grade::where('student_id', $id)->where('year_id', $student->year_id)->get();
                    // dump($grades);
                    $garray = array();
                    foreach($grades as $grade){
                        array_push($garray, $grade->remarks);
                    }

                    if(in_array("FAILED", $garray) || in_array(null, $garray)){
                        return redirect()->back()->with('message', 'Student/s not eligible for clearance. Please check grades');   
                    }
                }
            }

            foreach($request->student_ids as $id)
            {
                $student = Student::find($id);

                $student->clearance = 'cleared';
                $student->update();
                
            }

            return redirect()->back()->with('message', 'Student/s Cleared');   
            
        }

    }

    public function teacherSchedule()
    {
        $p = User::where('_id',Auth::id())->with('teacher')->first(); 
        if(Session::missing('schoolyear')){
            $teacherfind = Teacher::find($p->teacher->id);
            $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
            $taon = $latest->year_id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        
        $teacherfind = Teacher::find($p->teacher->id);
        $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->where('year_id', $taon)->get()->last();

        $schedules = Teacher_Schedule::where('teacher_id', $latest->id)->get()->sortBy('start');
        $forsem = Teacher_Schedule::where('teacher_id', $latest->id)->get()->sortBy('start');
        $curriculums = Curriculum::pluck('name', '_id');

        $fullname = $p->teacher->fullname;

        $foryear = Teacher_Schedule::
        whereHas('teacher', function ($query) use ($fullname) {
            $query->where('fullname', $fullname);
        })
        ->get();

        $foryear = $foryear->sortByDesc(function ($schedule) {
            return $schedule->semester->semester;
        });

        // NO DUPLICATION OF SEM
        $allsem = array();
        foreach($foryear as $a){
            $allsem[$a->semester->semester] = $a->semester_id;
        }
        $fsem = array_unique($allsem);
        $sem_array = array();

        foreach($fsem as $semi => $sem){
            $sched = Teacher_Schedule::whereHas('teacher', function ($query) use ($fullname) {
                $query->where('fullname', $fullname);
            })->where('year_id', $taon)->where('semester_id', $sem)->get();
            $sem_array[$semi] = $sched;
        }

        $allSec = Section::all();
        $sections = $allSec->mapWithKeys(function ($section) {
            return [$section->_id => $section->glevel . ' - ' . $section->name];
        });
    
        
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        // $teacherschedule= Teacher_Schedule::where('teacher_id', $latest->id)->with('teacher')->with('section')->with('curriculum')->get()->sortBy('start');
        return View::make('teacher.teacherSchedule', compact( 
            'sem_array', 'days', 'curriculums', 'sections'
        ));

    }

    public function viewReportCard($id)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->first();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        
        // $user = Auth::user();
        $find = Student::find($id);
        $student = Student::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->where('year_id', $taon)->get()->first();
        $grades = Grade::with('student', 'curriculum', 'teacher', 'year', 'semester')
        ->where('student_id', $student->id)->where('year_id', $taon)->get();

        $first = array();
        $second = array();
        foreach($grades as $g){
            if($g->semester->semester == 'First'){if($g->final != null){array_push($first, $g->final);} }
            if($g->semester->semester == 'Second'){if($g->final != null){array_push($second, $g->final);}}}

        
        if(empty($first)){$firstGWA = 0;}else{$firstGWA = array_sum($first) / count($first);}
        if(empty($second)){$secondGWA = 0;}else{$secondGWA = array_sum($second) / count($second);}

        $allAttendance = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get();
        $totalAll = count($allAttendance);

        $present = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get();
        $totalPresent = count($present);

        $allAbsent= Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get();
        $totalAbsent = count($allAbsent);
  
        // COUNT ALL ATTENDANCE
        $attend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get()
        ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
        $usermcount = [];
        $userArr = [];
        $studattend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get()
        ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
        $studmcount = [];
        $studArr = [];
        $studabsent = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get()
        ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');}); 
        $absmcount = [];
        $absdArr = [];
        
        // PRESENT
        foreach ($studattend as $key => $value) {$studmcount[(int)$key] = count($value);}
        // TOTAL
        foreach ($attend as $key => $value) {$usermcount[(int)$key] = count($value);}
        // ABSENT
        foreach ($usermcount as $key => $value) {$absmcount[$key] = $value - $studmcount[$key];}
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$month[$i-1]]['total'] = $usermcount[$i];
                $userArr[$month[$i-1]]['attend'] = $studmcount[$i];
                $userArr[$month[$i-1]]['absent'] = $absmcount[$i];
            } else {
                $userArr[$month[$i-1]]['total'] = 0;
                $userArr[$month[$i-1]]['attend'] = 0;
                $userArr[$month[$i-1]]['absent'] = 0;
            }
        }

        $syGWA = ($firstGWA+ $secondGWA) / 2;
        $year = Year::find($taon);

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/depedLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('student.reportcard', compact('grades', 'student', 'userArr', 'year', 'firstGWA', 'secondGWA', 'pic1', 'pic2', 'totalPresent', 'totalAll', 'totalAbsent', 'syGWA'))->setPaper('a4', 'landscape');

    // stream PDF to user's browser
    return $pdf->stream('reportCard.pdf');
    }

    public function downloadReportCard($id)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->first();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        
        // $user = Auth::user();
        $find = Student::with('section', 'strand')->find($id);
        $student = Student::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->where('year_id', $taon)->get()->first();
        $grades = Grade::with('student', 'curriculum', 'teacher', 'year', 'semester')
        ->where('student_id', $student->id)->where('year_id', $taon)->get();

        $first = array();
        $second = array();
        foreach($grades as $g){
            if($g->semester->semester == 'first'){if($g->final != null){array_push($first, $g->final);} }
            if($g->semester->semester == 'second'){if($g->final != null){array_push($second, $g->final);}}}

        if(empty($first)){$firstGWA = 0;}else{$firstGWA = array_sum($first) / count($first);}
        if(empty($second)){$secondGWA = 0;}else{$secondGWA = array_sum($second) / count($second);}

        $allAttendance = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get();
        $totalAll = count($allAttendance);

        $present = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get();
        $totalPresent = count($present);

        $allAbsent= Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get();
        $totalAbsent = count($allAbsent);
  
        // COUNT ALL ATTENDANCE
        $attend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get()
        ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
        $usermcount = [];
        $userArr = [];
        $studattend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get()
        ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
        $studmcount = [];
        $studArr = [];
        $studabsent = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get()
        ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');}); 
        $absmcount = [];
        $absdArr = [];
        
        // PRESENT
        foreach ($studattend as $key => $value) {$studmcount[(int)$key] = count($value);}
        // TOTAL
        foreach ($attend as $key => $value) {$usermcount[(int)$key] = count($value);}
        // ABSENT
        foreach ($usermcount as $key => $value) {$absmcount[$key] = $value - $studmcount[$key];}
        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                $userArr[$month[$i-1]]['total'] = $usermcount[$i];
                $userArr[$month[$i-1]]['attend'] = $studmcount[$i];
                $userArr[$month[$i-1]]['absent'] = $absmcount[$i];
            } else {
                $userArr[$month[$i-1]]['total'] = 0;
                $userArr[$month[$i-1]]['attend'] = 0;
                $userArr[$month[$i-1]]['absent'] = 0;
            }
        }

        $syGWA = ($firstGWA+ $secondGWA) / 2;
        $year = Year::find($taon);

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/depedLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('student.reportcard', compact('grades', 'student', 'userArr', 'year', 'firstGWA', 'secondGWA', 'pic1', 'pic2', 'totalPresent', 'totalAll', 'totalAbsent', 'syGWA'))->setPaper('a4', 'landscape');

    // download PDF
    return $pdf->download('Report Card.pdf');
    }

    public function allViewReportCard(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->first();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        
        // $user = Auth::user();
        // dd($request);
        $stud_ids = explode(",", $request->student_ids);
        // dd($request->student_ids);
        if($request->student_ids == null)
        {
            return redirect()->back()->with('select', 'Please Select a Student');   
        }
        else{
            foreach($stud_ids as $id)
            {
                $find = Student::find($id);
                $student = Student::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->where('year_id', $taon)->get()->first();
                $grades = Grade::with('student', 'curriculum', 'teacher', 'year', 'semester')
                ->where('student_id', $student->id)->where('year_id', $taon)->get();
        
                $first = array();
                $second = array();
                foreach($grades as $g){
                    if($g->semester->semester == 'First'){if($g->final != null){array_push($first, $g->final);} }
                    if($g->semester->semester == 'Second'){if($g->final != null){array_push($second, $g->final);}}}
        
                if(empty($first)){$firstGWA = 0;}else{$firstGWA = array_sum($first) / count($first);}
                if(empty($second)){$secondGWA = 0;}else{$secondGWA = array_sum($second) / count($second);}
        
                $allAttendance = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get();
                $totalAll = count($allAttendance);
        
                $present = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get();
                $totalPresent = count($present);
        
                $allAbsent= Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get();
                $totalAbsent = count($allAbsent);
          
                // COUNT ALL ATTENDANCE
                $attend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get()
                ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
                $usermcount = [];
                $userArr = [];
                $studattend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get()
                ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
                $studmcount = [];
                $studArr = [];
                $studabsent = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get()
                ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');}); 
                $absmcount = [];
                $absdArr = [];
            
                // PRESENT
                foreach ($studattend as $key => $value) {$studmcount[(int)$key] = count($value);}
                // TOTAL
                foreach ($attend as $key => $value) {$usermcount[(int)$key] = count($value);}
                // ABSENT
                // dd($studattend, $attend);
                foreach ($usermcount as $key => $value) {$absmcount[$key] = $value - $studmcount[$key];}
                $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                for ($i = 1; $i <= 12; $i++) {
                    if (!empty($usermcount[$i])) {
                        $userArr[$month[$i-1]]['total'] = $usermcount[$i];
                        $userArr[$month[$i-1]]['attend'] = $studmcount[$i];
                        $userArr[$month[$i-1]]['absent'] = $absmcount[$i];
                    } else {
                        $userArr[$month[$i-1]]['total'] = 0;
                        $userArr[$month[$i-1]]['attend'] = 0;
                        $userArr[$month[$i-1]]['absent'] = 0;
                    }
                }
        
                $syGWA = ($firstGWA+ $secondGWA) / 2;
                $year = Year::find($taon);
        
                $path1 = base_path('public/assets/img/svnhsLogo.png');
                $type1 = pathinfo($path1, PATHINFO_EXTENSION);
                $data1 = file_get_contents($path1);
                $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

                $path2 = base_path('public/assets/img/depedLogo.png');
                $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                $data2 = file_get_contents($path2);
                $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

                if($student->section->teacher_id == "TBD")
                {
                    $adviser = "TBD";
                }
                else{
                    $adviser = $student->section->teacher->fullname;
                }
 
                $data = ['adviser'=>$adviser,'grades'=>$grades, 'student'=>$student, 'userArr'=>$userArr, 'year'=>$year, 'firstGWA'=>$firstGWA, 'secondGWA'=>$secondGWA, 'pic1'=>$pic1, 'pic2'=>$pic2, 'totalPresent'=>$totalPresent, 'totalAll'=>$totalAll, 'totalAbsent'=>$totalAbsent, 'syGWA'=>$syGWA];
                $final[$id] = $data;
                // dump($pdf);
            }
            // dd($final);
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('student.allReportcard', compact('final'))->setPaper('a4', 'landscape');
            
    
    
            // stream PDF to user's browser
            return $pdf->stream('allReportCard.pdf');
        }
        
    }

    public function allDownloadReportCard(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->first();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        // dd($request->student_ids);
        $stud_ids = explode(",", $request->student_ids);
        // dd($stud_ids);
        if($request->student_ids  == null)
        {
            return redirect()->back()->with('select', 'Please Select a Student');   
        }
        else{
            foreach($stud_ids as $id)
            {
                    // $user = Auth::user();
                $find = Student::with('section', 'strand')->find($id);
                $student = Student::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->where('year_id', $taon)->get()->first();
                $grades = Grade::with('student', 'curriculum', 'teacher', 'year', 'semester')
                ->where('student_id', $student->id)->where('year_id', $taon)->get();

                $first = array();
                $second = array();
                foreach($grades as $g){
                    if($g->semester->semester == 'first'){if($g->final != null){array_push($first, $g->final);} }
                    if($g->semester->semester == 'second'){if($g->final != null){array_push($second, $g->final);}}}

                if(empty($first)){$firstGWA = 0;}else{$firstGWA = array_sum($first) / count($first);}
                if(empty($second)){$secondGWA = 0;}else{$secondGWA = array_sum($second) / count($second);}

                $allAttendance = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get();
                $totalAll = count($allAttendance);

                $present = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get();
                $totalPresent = count($present);

                $allAbsent= Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get();
                $totalAbsent = count($allAbsent);
        
                // COUNT ALL ATTENDANCE
                $attend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('semester_id', $semester)->get()
                ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
                $usermcount = [];
                $userArr = [];
                $studattend = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status', '!=', 'ABSENT')->where('semester_id', $semester)->get()
                ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');});
                $studmcount = [];
                $studArr = [];
                $studabsent = Attendance::where('student_id', $student->id)->where('year_id', $student->year_id)->where('status','ABSENT')->where('semester_id', $semester)->get()
                ->groupBy(function ($date) {return Carbon::parse($date->date)->format('m');}); 
                $absmcount = [];
                $absdArr = [];
                
                // PRESENT
                foreach ($studattend as $key => $value) {$studmcount[(int)$key] = count($value);}
                // TOTAL
                foreach ($attend as $key => $value) {$usermcount[(int)$key] = count($value);}
                // ABSENT
                foreach ($usermcount as $key => $value) {$absmcount[$key] = $value - $studmcount[$key];}
                $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                for ($i = 1; $i <= 12; $i++) {
                    if (!empty($usermcount[$i])) {
                        $userArr[$month[$i-1]]['total'] = $usermcount[$i];
                        $userArr[$month[$i-1]]['attend'] = $studmcount[$i];
                        $userArr[$month[$i-1]]['absent'] = $absmcount[$i];
                    } else {
                        $userArr[$month[$i-1]]['total'] = 0;
                        $userArr[$month[$i-1]]['attend'] = 0;
                        $userArr[$month[$i-1]]['absent'] = 0;
                    }
                }

                $syGWA = ($firstGWA+ $secondGWA) / 2;
                $year = Year::find($taon);
                if($student->section->teacher_id == "TBD")
                {
                    $adviser = "TBD";
                }
                else{
                    $adviser = $student->section->teacher->fullname;
                }

                $path1 = base_path('public/assets/img/svnhsLogo.png');
                $type1 = pathinfo($path1, PATHINFO_EXTENSION);
                $data1 = file_get_contents($path1);
                $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

                $path2 = base_path('public/assets/img/depedLogo.png');
                $type2 = pathinfo($path2, PATHINFO_EXTENSION);
                $data2 = file_get_contents($path2);
                $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

                $data = ['grades'=>$grades, 'student'=>$student, 'userArr'=>$userArr, 'year'=>$year, 'firstGWA'=>$firstGWA, 'secondGWA'=>$secondGWA, 'pic1'=>$pic1,'pic2'=>$pic2, 'totalPresent'=>$totalPresent, 'totalAll'=>$totalAll, 'totalAbsent'=>$totalAbsent, 'syGWA'=>$syGWA, 'adviser'=>$adviser, ];
                $final[$id] = $data;

            }

            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('student.allReportcard', compact('final'))->setPaper('a4', 'landscape');

            // download PDF
            return $pdf->download('Report Card.pdf');
        }
        
    }

}
