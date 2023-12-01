<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher_Schedule;
use App\Models\Curriculum;
use App\Models\Strand;
use App\Models\Grade;
use App\Models\Applicant;
use App\Models\Registration;
use App\Models\Shortlisted;
use App\Models\Attendance;
use App\Models\Year;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Redirect;
use View;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;


class UserController extends Controller
{
    public function signin()
    {
        return view('signin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'email| required',
            'password' => 'required| min:4'
        ]);
        
        // dd($request);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password'), 'status' => 'enable']))
        {
            if(Auth()->user()->role == 'admin' || 
            Auth()->user()->role == 'ABM' ||
            Auth()->user()->role == 'GAS' ||
            Auth()->user()->role == 'HUMSS' ||
            Auth()->user()->role == 'STEM' ||
            Auth()->user()->role == 'CARE' ||
            Auth()->user()->role == 'EIM' ||
            Auth()->user()->role == 'HE' ||
            Auth()->user()->role == 'ICT' && Auth()->user()->status == 'enable')
            {
                Session::put('image', Auth()->user()->image);
                return redirect()->route('admin.dashboard');
            }
            elseif(Auth()->user()->role == 'teacher' && Auth()->user()->status == 'enable')
            {
                return redirect()->route('getProfile');
            }
            elseif(Auth()->user()->role == 'student' && Auth()->user()->status == 'enable')
            {
                return redirect()->route('getProfile'); 
            }
        }
        else{
           return redirect()->back()->withErrors(['message' => 'Invalid email or password.']);
        }
     }

     public function getProfile(){
        // dd( $animal_injury);
        $user = Auth::user()->role;
        if($user == 'admin')
        {
            $years = Year::orderBy('year', 'DESC')->get();
            // dd($years);
            Session::put('years', $years);

            $admin = User::where('_id',Auth::id())->first();    
            Session::put('image', $admin->image);
            return view('admin.profile', compact('admin'));
        }

        elseif($user == 'teacher' || $user == 'ABM' || $user == 'GAS' || $user == 'HUMSS' || $user == 'STEM' || $user == 'CARE' || $user == 'EIM' || $user == 'HE' || $user == 'ICT')
        {      
            $p = User::where('_id',Auth::id())->with('teacher')->first(); 
            if(Session::missing('schoolyear')){
                $teacherfind = Teacher::find($p->teacher->id);
                $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
                // dd($p);
                $taon = $latest->year_id;
            }
            else{
                $taon = Session::get('schoolyear');
                $t = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->where('year_id',$taon)->get()->first();
                if($t == null)
                {
                    $teacherfind = Teacher::find($p->teacher->id);
                    $latest = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->last();
                    // dd($p);
                    $taon = $latest->year_id;
                }
            }

            $p = User::where('_id',Auth::id())->with('student')->first();  
            $teacher = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->where('year_id',$taon)->get()->first();
            // dd($teacher);
            $yearIDs = Teacher::where('lname',$p->teacher->lname)->where('fname',$p->teacher->fname)->where('mname',$p->teacher->mname)->get()->pluck('year_id');
            // dd($yearIDs);
            $years = Year::whereIn('_id', $yearIDs)->orderBy('year', 'DESC')->get();
            Session::put('image', $teacher->image);
            Session::put('studyears', $years);

            // dd($teacher);
            
            // $teacher_id = $profile->teacher_id;
            // $teachsched = Teacher_Schedule::all()->where('teacher_id', $profile->teacher_id);
            // dd($teachsched);
            return view('teacher.profile', compact('teacher'));
        }

        elseif($user == 'student')
        {            
            $p = User::where('_id',Auth::id())->with('student')->first(); 

            if(Session::missing('schoolyear')){
                // $default = Year::all()->last();
                // $taon = $default->id;
                $studentfind = Student::find($p->student->id);
                $latest = Student::where('lname',$p->student->lname)->where('fname',$p->student->fname)->where('mname',$p->student->mname)->get()->last();
                $taon = $latest->year_id;
                Session::put('schoolyear', $taon);
                // dump('default');
            }
            else{
                $taon = Session::get('schoolyear');
                // dump('laman');
            }
            
            $student = Student::where('lname',$p->student->lname)->where('fname',$p->student->fname)->where('mname',$p->student->mname)->where('year_id',$taon)->get()->last();

            $yearIDs = Student::where('lname',$p->student->lname)->where('fname',$p->student->fname)->where('mname',$p->student->mname)->get()->pluck('year_id');
            $years = Year::whereIn('_id', $yearIDs)->orderBy('year', 'DESC')->get();
            // dd($student);
            Session::put('studyears', $years);
            $show = Attendance::where('student_id', $student->id)->where('status','!=', 'ABSENT')->get(); 
            $not = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->get();
            Session::put('image', $student->image);
            $attend = count($show);
            $absent = count($not);


            return view('student.profile', compact('student', 'attend', 'absent'));
        }
    }

    public function schoolYear($id)
    {
        // dd($id);
        Session::put('schoolyear', $id);

        return Redirect::route('admin.dashboard');
    }

    public function reports(){
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $mortality = $this->mortality();
        $version = $this->version();
        $drill = $this->drill();

        $students = $this->students();

        // dd($drill);

        $male = $this->male();
        $female = $this->female();

        // dd($male, $female);
        // $atRisk = $this->atRisk();
        
        $year = Year::find($taon);

        $sy = Year::all();
        $years = [];
        foreach($sy as $y)
        {
            $years[] = $y->year;
        }

        $yearOptions = [];

        foreach ($sy as $year) {
            $yearOptions[$year->id] = $year->year;
        }
        
        return view('admin.reports',compact(
            'mortality', 'male', 'female', 'version', 'drill', 'year', 'students', 'years', 'yearOptions'
        ));
        
    }
    
    public function dashboard(){

        // dd(Auth()->user());
        $years = Year::orderBy('year', 'DESC')->get();
        // dd($years);
        Session::put('years', $years);

        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        
        $abms = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'ABM');})->get();
        $gases = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'GAS');})->get();
        $humsses = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'HUMSS');})->get();
        $stems = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'STEM');})->get();  
        $cares = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'CARE');})->get();
        $eims = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'EIM');})->get();
        $hes = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'HE');})->get();
        $icts = Student::where('year_id', $taon)->whereHas('strand', function($query) {$query->where('code', 'ICT');})->get();

        $countabm = count($abms);
        $countgas = count($gases);
        $counthumss = count($humsses);
        $countstem = count($stems);
        $countcare = count($cares);
        $counteim = count($eims);
        $counthe = count($hes);
        $countict = count($icts);
        // dd($countabm);

        $register = Registration::where('year_id', $taon)->get()->last();

        $dateStart = new DateTime($register->start);
        $start = $dateStart->format('F j, Y, g:i A');
        $dateEnd = new DateTime($register->end);
        $end = $dateEnd->format('F j, Y, g:i A');

        $dateStart1 = new DateTime($register->deadStart);
        $dstart = $dateStart1->format('F j, Y, g:i A');
        $dateEnd1 = new DateTime($register->deadEnd);
        $dend = $dateEnd1->format('F j, Y, g:i A');

        $applicants = Applicant::where('status', 'applicant')->where('year_id', $taon)->get();
        $shortlisteds = Shortlisted::where('status', 'shortlisted')->where('year_id', $taon)->get();
        $students = Student::where('year_id', $taon)->get();
        $countapplicants = count($applicants);
        $countshortlisteds = count($shortlisteds);
        $countstudents = count($students);
        // dd($countappli);

        $year = Year::find($taon);
        
        
        $abmStrand = Strand::where('code', 'ABM')->get()->first();
        $gasStrand = Strand::where('code', 'GAS')->get()->first();
        $humssStrand = Strand::where('code', 'HUMSS')->get()->first();
        $stemStrand = Strand::where('code', 'STEM')->get()->first();
        $careStrand = Strand::where('code', 'CARE')->get()->first();
        $eimStrand = Strand::where('code', 'EIM')->get()->first();
        $heStrand = Strand::where('code', 'HE')->get()->first();
        $ictStrand = Strand::where('code', 'ICT')->get()->first();

        $this->closeRegistration();

        return view('admin.dashboard',compact(
            'countabm','countgas','counthumss','countstem','countcare','counteim','counthe','countict', 
            'register', 'countapplicants', 'countshortlisteds', 'countstudents', 'year', 'start', 'end', 'dstart', 'dend',
            'abmStrand', 'gasStrand', 'humssStrand', 'stemStrand', 'careStrand', 'eimStrand', 'heStrand', 'ictStrand' 
        ));
    }

    public function closeRegistration()
    {
        $open = Registration::get()->last();

        $currentDate = date('Y-m-d h:i:s');
        $currentDate = date('Y-m-d h:i:s', strtotime($currentDate));

        $startDate = date('Y-m-d h:i:s', strtotime($open->start));
        $endDate = date('Y-m-d h:i:s', strtotime($open->end));

        if (strtotime($currentDate) < strtotime($startDate) || strtotime($currentDate) > strtotime($endDate)) {
            $open->status = 'Close';
            $open->update();
        }
    }

    public function userChart()
    {
        // FOR CHART
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

        return $userArr;
    }

    public function createAdmin(){
        // dd($request);
        $user = new User;
        $user->name = 'SVNHS ADMIN';
        $user->email = 'shamwebandmobile@gmail.com';
        $user->password = bcrypt('password123');
        $user->role = 'admin';
        $user->save();

        $response =[
            'user' => $user,
            'message' => 'nice'
        ];
        return response($response, 201);
    }
    

    public function teacherList(Request $request){
        $users = User::where('role', 'teacher')->orWhere(function ($query) {$query->where('role', '<>', 'student')->where('role', '<>', 'admin');})->get();
    
        // dd($request->ajax());
        if ($request->ajax()) {
            $data = User::where('role', 'teacher')->orWhere(function ($query) {$query->where('role', '<>', 'student')->where('role', '<>', 'admin');})->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'admin.user.action')
                    ->make();

        }
      
        return view('admin.user.teachers',compact('users'));
    }

    public function studentList(Request $request){
        $users = User::where('role', 'student')->get();
        
        // dd($request->ajax());
        if ($request->ajax()) {
            $data = User::where('role', 'student')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'admin.user.action')
                    ->make();
        }
      
        return view('admin.user.students',compact('users'));
    }

    public function userStatus(Request $request, $id){
        $user = User::find($id);

        if($user->status == 'enable'){
            $user->status = 'disable';
        }
        else{
            $user->status = 'enable';
        }

        $user->update();
        
        if($user->role == 'teacher'){
           return redirect()->route('admin.teacherList'); 
        }
        else{
            return redirect()->route('admin.studentList'); 
        }
        
    }

    public function editProfile($id)
    {   
        $admin = User::find($id);
        // dd($admin);
        return View::make('admin.editProfile', compact('admin'));
    }

    public function updateProfile(Request $request, $id)
    {   
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
        // Update users
        $user = User::find($id);
        $user->name = strtoupper($request->name);
        $user->email = $request->email;

        if($request->hasFile('image'))
        {
            $user->image = $imagee;
        }
        $user->update();

        Session::put('image', $user->image);
        return Redirect::route('getProfile');

    }

    public function userEdit($id)
    {
        $user = User::find($id);
        return View::make('admin.user.userEdit', compact('user')); 
    }

    public function userUpdate(Request $request, $id)
    {
        if($request->password != null)
        {  
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
            ];
    
            $messages = [
                'name.required' => 'Please enter name',
                'email.required' => 'Please enter email address.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'Please enter password.',
                'password.min' => 'Your password must be at least :min characters long.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);
            $user->name = strtoupper($request->name);
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->update();

        }
        else{
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
            ];
    
            $messages = [
                'name.required' => 'Please enter name',
                'email.required' => 'Please enter email address.',
                'email.email' => 'Please enter a valid email address.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);
            $user->name = strtoupper($request->name);
            $user->email = $request->email;
            $user->update();

        }

        if($user->role == 'teacher')
        {
            return Redirect::route('admin.teacherList'); 
        }
        else{
            return Redirect::route('admin.studentList'); 
        }
      
    }

    public function showChange()
    {
        return view('auth.passwords.change');
    }

    public function changePass(Request $request)
    {
        // dd($request);
        $user = Auth::user();

        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'string'],
        ]);
        // dd("HEY");
        // Check if the current password is correct
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }
        // Update the user's password
        $user->password = Hash::make($validatedData['password']);
        // dd($user->password);
        $user->save();

        return redirect()->route('user.showChange')->with('success', 'Password changed successfully.');

    }


    public function mortality()
    {
        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}else{$taon = Session::get('schoolyear');}

        $abm = Strand::where('code', 'ABM')->first();
        $attendABM = Attendance::whereHas('student', function($query) use ($abm) {$query->where('strand_id', $abm->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $abmmcount = [];$abmArr = [];
        foreach ($attendABM as $key => $value) {$abmmcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($abmmcount[$i])){$abmArr[$i] = $abmmcount[$i];}else{$abmArr[$i] = 0;}}

        $gas = Strand::where('code', 'GAS')->first();
        $attendgas = Attendance::whereHas('student', function($query) use ($gas) {$query->where('strand_id', $gas->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $gasmcount = [];$gasArr = [];
        foreach ($attendgas as $key => $value) {$gasmcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($gasmcount[$i])){$gasArr[$i] = $gasmcount[$i];}else{$gasArr[$i] = 0;}}

        $humss = Strand::where('code', 'HUMSS')->first();
        $attendhumss = Attendance::whereHas('student', function($query) use ($humss) {$query->where('strand_id', $humss->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $humssmcount = [];$humssArr = [];
        foreach ($attendhumss as $key => $value) {$humssmcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($humssmcount[$i])){$humssArr[$i] = $humssmcount[$i];}else{$humssArr[$i] = 0;}}

        $stem = Strand::where('code', 'STEM')->first();
        $attendstem = Attendance::whereHas('student', function($query) use ($stem) {$query->where('strand_id', $stem->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $stemmcount = [];$stemArr = [];
        foreach ($attendstem as $key => $value) {$stemmcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($stemmcount[$i])){$stemArr[$i] = $stemmcount[$i];}else{$stemArr[$i] = 0;}}

        $care = Strand::where('code', 'CARE')->first();
        $attendcare = Attendance::whereHas('student', function($query) use ($care) {$query->where('strand_id', $care->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $caremcount = [];$careArr = [];
        foreach ($attendcare as $key => $value) {$caremcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($caremcount[$i])){$careArr[$i] = $caremcount[$i];}else{$careArr[$i] = 0;}}

        $eim = Strand::where('code', 'EIM')->first();
        $attendeim = Attendance::whereHas('student', function($query) use ($eim) {$query->where('strand_id', $eim->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $eimmcount = [];$eimArr = [];
        foreach ($attendeim as $key => $value) {$eimmcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($eimmcount[$i])){$eimArr[$i] = $eimmcount[$i];}else{$eimArr[$i] = 0;}}

        $he = Strand::where('code', 'HE')->first();
        $attendhe = Attendance::whereHas('student', function($query) use ($he) {$query->where('strand_id', $he->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $hemcount = [];$heArr = [];
        foreach ($attendhe as $key => $value) {$hemcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($hemcount[$i])){$heArr[$i] = $hemcount[$i];}else{$heArr[$i] = 0;}}

        $ict = Strand::where('code', 'HE')->first();
        $attendict = Attendance::whereHas('student', function($query) use ($ict) {$query->where('strand_id', $ict->id);})->where('year_id', $taon)->with('student')->where('status', 'ABSENT')->get()->groupBy(function($date) {return Carbon::parse($date->date)->format('m');});
        $ictmcount = [];$ictArr = [];
        foreach ($attendict as $key => $value) {$ictmcount[(int)$key] = count($value);}
        for($i = 0; $i <= 11; $i++){if(!empty($ictmcount[$i])){$ictArr[$i] = $ictmcount[$i];}else{$ictArr[$i] = 0;}}

        $data = [
            'ABM' => $abmArr,
            'GAS' => $gasArr,
            'HUMSS' => $humssArr,
            'STEM' => $stemArr,
            'CARE' => $careArr,
            'EIM' => $eimArr,
            'HE' => $heArr,
            'ICT' => $ictArr,

        ];
        return $data;
    } 

    public function atRisk()
    {
        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}else{$taon = Session::get('schoolyear');}
        
        $data = array();

        $abm = Strand::where('code', 'ABM')->first();
        $abmRisk = Student::with('year')->where('strand_id', $abm->id)->where('year_id', $taon)->get();
        $abmRiskWithAttendance = $abmRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $abmCount = count($abmRiskWithAttendance);
        array_push($data, $abmCount);

        $gas = Strand::where('code', 'GAS')->first();
        $gasRisk = Student::with('year')->where('strand_id', $gas->id)->where('year_id', $taon)->get();
        $gasRiskWithAttendance = $gasRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $gasCount = count($gasRiskWithAttendance);
        array_push($data, $gasCount);

        $humss = Strand::where('code', 'HUMSS')->first();
        $humssRisk = Student::with('year')->where('strand_id', $humss->id)->where('year_id', $taon)->get();
        $humssRiskWithAttendance = $humssRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $humssCount = count($humssRiskWithAttendance);
        array_push($data, $humssCount);

        $stem = Strand::where('code', 'STEM')->first();
        $stemRisk = Student::with('year')->where('strand_id', $stem->id)->where('year_id', $taon)->get();
        $stemRiskWithAttendance = $stemRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $stemCount = count($stemRiskWithAttendance);
        array_push($data, $stemCount);

        $care = Strand::where('code', 'CARE')->first();
        $careRisk = Student::with('year')->where('strand_id', $care->id)->where('year_id', $taon)->get();
        $careRiskWithAttendance = $careRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $careCount = count($careRiskWithAttendance);
        array_push($data, $careCount);

        $eim = Strand::where('code', 'EIM')->first();
        $eimRisk = Student::with('year')->where('strand_id', $eim->id)->where('year_id', $taon)->get();
        $eimRiskWithAttendance = $eimRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $eimCount = count($eimRiskWithAttendance);
        array_push($data, $eimCount);

        $he = Strand::where('code', 'HE')->first();
        $heRisk = Student::with('year')->where('strand_id', $he->id)->where('year_id', $taon)->get();
        $heRiskWithAttendance = $heRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $heCount = count($heRiskWithAttendance);
        array_push($data, $heCount);

        $ict = Strand::where('code', 'ICT')->first();
        $ictRisk = Student::with('year')->where('strand_id', $ict->id)->where('year_id', $taon)->get();
        $ictRiskWithAttendance = $ictRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
            return $attendanceCount > 3;});
        $ictCount = count($ictRiskWithAttendance);
        array_push($data, $ictCount);

        // dd($data);
        return $data;
    }

    public function male()
    {
        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}else{$taon = Session::get('schoolyear');}

        $male = array();

        $abm = Strand::where('code', 'ABM')->first();
        $abmMale = Student::where('strand_id', $abm->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $abmMcount = count($abmMale);
        array_push($male, $abmMcount);

        $gas = Strand::where('code', 'GAS')->first();
        $gasMale = Student::where('strand_id', $gas->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $gasMcount = count($gasMale);
        array_push($male, $gasMcount);

        $humss = Strand::where('code', 'HUMSS')->first();
        $humssMale = Student::where('strand_id', $humss->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $humssMcount = count($humssMale);
        array_push($male, $humssMcount);

        $stem = Strand::where('code', 'STEM')->first();
        $stemMale = Student::where('strand_id', $stem->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $stemMcount = count($stemMale);
        array_push($male, $stemMcount);

        $care = Strand::where('code', 'CARE')->first();
        $careMale = Student::where('strand_id', $care->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $careMcount = count($careMale);
        array_push($male, $careMcount);

        $eim = Strand::where('code', 'EIM')->first();
        $eimMale = Student::where('strand_id', $eim->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $eimMcount = count($eimMale);
        array_push($male, $eimMcount);

        $he = Strand::where('code', 'HE')->first();
        $heMale = Student::where('strand_id', $he->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $heMcount = count($heMale);
        array_push($male, $heMcount);

        $ict = Strand::where('code', 'ICT')->first();
        $ictMale = Student::where('strand_id', $ict->id)->where('gender', 'male')->where('year_id', $taon)->get();
        $ictMcount = count($ictMale);
        array_push($male, $ictMcount);

        return $male;
    }

    public function female()
    {
        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}else{$taon = Session::get('schoolyear');}

        $male = array();

        $abm = Strand::where('code', 'ABM')->first();
        $abmMale = Student::where('strand_id', $abm->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $abmMcount = count($abmMale);
        array_push($male, $abmMcount);

        $gas = Strand::where('code', 'GAS')->first();
        $gasMale = Student::where('strand_id', $gas->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $gasMcount = count($gasMale);
        array_push($male, $gasMcount);

        $humss = Strand::where('code', 'HUMSS')->first();
        $humssMale = Student::where('strand_id', $humss->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $humssMcount = count($humssMale);
        array_push($male, $humssMcount);

        $stem = Strand::where('code', 'STEM')->first();
        $stemMale = Student::where('strand_id', $stem->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $stemMcount = count($stemMale);
        array_push($male, $stemMcount);

        $care = Strand::where('code', 'CARE')->first();
        $careMale = Student::where('strand_id', $care->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $careMcount = count($careMale);
        array_push($male, $careMcount);

        $eim = Strand::where('code', 'EIM')->first();
        $eimMale = Student::where('strand_id', $eim->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $eimMcount = count($eimMale);
        array_push($male, $eimMcount);

        $he = Strand::where('code', 'HE')->first();
        $heMale = Student::where('strand_id', $he->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $heMcount = count($heMale);
        array_push($male, $heMcount);

        $ict = Strand::where('code', 'ICT')->first();
        $ictMale = Student::where('strand_id', $ict->id)->where('gender', 'female')->where('year_id', $taon)->get();
        $ictMcount = count($ictMale);
        array_push($male, $ictMcount);
        
        return $male;
    }

    public function drill()
    {
        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}else{$taon = Session::get('schoolyear');}
        
        $data = array();

        {
            $abm = Strand::where('code', 'ABM')->first();
            $abmRisk = Student::with('year')->where('strand_id', $abm->id)->where('year_id', $taon)->get();
            $abmRiskWithAttendance = $abmRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $abmCount = count($abmRiskWithAttendance);

            $gas = Strand::where('code', 'GAS')->first();
            $gasRisk = Student::with('year')->where('strand_id', $gas->id)->where('year_id', $taon)->get();
            $gasRiskWithAttendance = $gasRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $gasCount = count($gasRiskWithAttendance);

            $humss = Strand::where('code', 'HUMSS')->first();
            $humssRisk = Student::with('year')->where('strand_id', $humss->id)->where('year_id', $taon)->get();
            $humssRiskWithAttendance = $humssRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $humssCount = count($humssRiskWithAttendance);

            $stem = Strand::where('code', 'STEM')->first();
            $stemRisk = Student::with('year')->where('strand_id', $stem->id)->where('year_id', $taon)->get();
            $stemRiskWithAttendance = $stemRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $stemCount = count($stemRiskWithAttendance);

            $care = Strand::where('code', 'CARE')->first();
            $careRisk = Student::with('year')->where('strand_id', $care->id)->where('year_id', $taon)->get();
            $careRiskWithAttendance = $careRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $careCount = count($careRiskWithAttendance);

            $eim = Strand::where('code', 'EIM')->first();
            $eimRisk = Student::with('year')->where('strand_id', $eim->id)->where('year_id', $taon)->get();
            $eimRiskWithAttendance = $eimRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $eimCount = count($eimRiskWithAttendance);

            $he = Strand::where('code', 'HE')->first();
            $heRisk = Student::with('year')->where('strand_id', $he->id)->where('year_id', $taon)->get();
            $heRiskWithAttendance = $heRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $heCount = count($heRiskWithAttendance);

            $ict = Strand::where('code', 'ICT')->first();
            $ictRisk = Student::with('year')->where('strand_id', $ict->id)->where('year_id', $taon)->get();
            $ictRiskWithAttendance = $ictRisk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $ictCount = count($ictRiskWithAttendance);
        }


        for($i=0; $i<=7; $i++)
        {
            if($i == 0){
                $data[$i]['name'] = $abm->code;
                $data[$i]['num'] = $abmCount;
            }
            if($i == 1){
                $data[$i]['name'] = $gas->code;
                $data[$i]['num'] = $gasCount;
            }
            if($i == 2){
                $data[$i]['name'] = $humss->code;
                $data[$i]['num'] = $humssCount;
            }
            if($i == 3){
                $data[$i]['name'] = $stem->code;
                $data[$i]['num'] = $stemCount;
            }
            if($i == 4){
                $data[$i]['name'] = $care->code;
                $data[$i]['num'] = $careCount;
            }
            if($i == 5){
                $data[$i]['name'] = $eim->code;
                $data[$i]['num'] = $eimCount;
            }
            if($i == 6){
                $data[$i]['name'] = $he->code;
                $data[$i]['num'] = $heCount;
            }
            if($i == 7){
                $data[$i]['name'] = $ict->code;
                $data[$i]['num'] = $ictCount;
            }
        }

        return $data;
    }

    public function version()
    {
        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}else{$taon = Session::get('schoolyear');}

        $data = array();
        
        $abm = Strand::where('code', 'ABM')->first();
        $sections = Section::where('year_id', $taon)->get()->sortBy('name')->values();
        $secArr = [];

        $count = count($sections);
        for ($i = 0; $i < $count; $i++) {
            $risk = Student::with('section', 'strand')->where('section_id', $sections[$i]->id)->where('year_id', $taon)->get();
            $riskWithAttendance = $risk->filter(function($student) {$attendanceCount = Attendance::where('student_id', $student->id)->where('status', 'ABSENT')->count();
                return $attendanceCount > 3;});
            $data[$i]['section'] = $sections[$i]->name;
            $find = Section::with('strand')->where('name', $sections[$i]->name)->first();
            $data[$i]['browser'] = $find->strand->code;
            $data[$i]['num'] = count($riskWithAttendance);
        }

        return $data;

    }

    public function students()
    {
        $ye = Year::all();
        $year = count($ye);

        $abm = Strand::where('code', 'ABM')->first();
        $attendabm = Student::where('strand_id', $abm->id)->get()->groupBy('year_id')->values(0);
        $abmmcount = [];$abmArr = [];
        foreach ($attendabm as $key => $value) {$abmmcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($abmmcount[$i])){$abmArr[$i] = $abmmcount[$i];}else{$abmArr[$i] = 0;}}

        $gas = Strand::where('code', 'GAS')->first();
        $attendgas = Student::where('strand_id', $gas->id)->get()->groupBy('year_id')->values(0);
        $gasmcount = [];$gasArr = [];
        foreach ($attendgas as $key => $value) {$gasmcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($gasmcount[$i])){$gasArr[$i] = $gasmcount[$i];}else{$gasArr[$i] = 0;}}

        $humss = Strand::where('code', 'HUMSS')->first();
        $attendhumss = Student::where('strand_id', $humss->id)->get()->groupBy('year_id')->values(0);
        $humssmcount = [];$humssArr = [];
        foreach ($attendhumss as $key => $value) {$humssmcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($humssmcount[$i])){$humssArr[$i] = $humssmcount[$i];}else{$humssArr[$i] = 0;}}
        
        $stem = Strand::where('code', 'STEM')->first();
        $attendstem = Student::where('strand_id', $stem->id)->get()->groupBy('year_id')->values(0);
        $stemmcount = [];$stemArr = [];
        foreach ($attendstem as $key => $value) {$stemmcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($stemmcount[$i])){$stemArr[$i] = $stemmcount[$i];}else{$stemArr[$i] = 0;}}

        $care = Strand::where('code', 'CARE')->first();
        $attendcare = Student::where('strand_id', $care->id)->get()->groupBy('year_id')->values(0);
        $caremcount = [];$careArr = [];
        foreach ($attendcare as $key => $value) {$caremcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($caremcount[$i])){$careArr[$i] = $caremcount[$i];}else{$careArr[$i] = 0;}}

        $eim = Strand::where('code', 'EIM')->first();
        $attendeim = Student::where('strand_id', $eim->id)->get()->groupBy('year_id')->values(0);
        $eimmcount = [];$eimArr = [];
        foreach ($attendeim as $key => $value) {$eimmcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($eimmcount[$i])){$eimArr[$i] = $eimmcount[$i];}else{$eimArr[$i] = 0;}}

        $he = Strand::where('code', 'HE')->first();
        $attendhe = Student::where('strand_id', $he->id)->get()->groupBy('year_id')->values(0);
        $hemcount = [];$heArr = [];
        foreach ($attendhe as $key => $value) {$hemcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($hemcount[$i])){$heArr[$i] = $hemcount[$i];}else{$heArr[$i] = 0;}}
        
        $ict = Strand::where('code', 'ICT')->first();
        $attendict = Student::where('strand_id', $ict->id)->get()->groupBy('year_id')->values(0);
        $ictmcount = [];$ictArr = [];
        foreach ($attendict as $key => $value) {$ictmcount[$key] = count($value);}
        for($i = 0; $i <= $year-1; $i++){if(!empty($ictmcount[$i])){$ictArr[$i] = $ictmcount[$i];}else{$ictArr[$i] = 0;}}

        $data = [
            'ABM' => $abmArr,
            'GAS' => $gasArr,
            'HUMSS' => $humssArr,
            'STEM' => $stemArr,
            'CARE' => $careArr,
            'EIM' => $eimArr,
            'HE' => $heArr,
            'ICT' => $ictArr,

        ];

        // dd($data);
        return $data;
    } 

    public function pdfMortality()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }
        // dd($taon);
        $year = Year::find($taon);

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $mortality = $this->mortality();

        // dd($mortality);
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/depedLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.mortalityReport', 
        compact('mortality', 'currentDate','pic1','pic2', 'year'))
        ->setPaper('a4', 'landscape');

       

        // stream PDF to user's browser
        return $pdf->stream('mortalityReport.pdf');
    }

    public function pdfRisk()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }
        // dd($taon);
        $year = Year::find($taon);

        $risk = $this->atRisk();
        $strand = ['ABM', 'GAS', 'HUMSS', 'STEM', 'CARE', 'EIM', 'HE', 'ICT'];
        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 
        // dd($risk);
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/depedLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.riskReport', 
        compact('risk', 'currentDate','pic1','pic2', 'strand', 'year'))
        ->setPaper('a4', 'landscape');

        // stream PDF to user's browser
        return $pdf->stream('Risk-Report.pdf');
    }
    
    public function pdfStudentYear()
    {

        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }
        // dd($taon);
        $year = Year::find($taon);

        $students = $this->students();
        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $years = Year::all();
        // dd($students);
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/depedLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.studentYear', 
        compact('pic1','pic2', 'students','currentDate', 'years','year'))
        ->setPaper('a4', 'landscape');

        // stream PDF to user's browser
        return $pdf->stream('Student-Year.pdf');
    }

    public function pdfDemographics()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }
        // dd($taon);
        $year = Year::find($taon);

        $male = $this->male();
        $female = $this->female();
        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $strands = ['ABM', 'GAS', 'HUMSS', 'STEM', 'CARE', 'EIM', 'HE', 'ICT'];

        // dd($students);
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/depedLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.demographicsReport', 
        compact('pic1','pic2', 'male', 'currentDate', 'female', 'strands','year'))
        ->setPaper('a4', 'landscape');

        // stream PDF to user's browser
        return $pdf->stream('Demographics-Report.pdf');
    }

    public function pdfABM()
    {
        // dd("HEY");
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();

        $app = Applicant::where('firstchoice', 'Accountancy, Business and Management')->where('year_id', $taon)->orderBy('gwa', 'DESC')->orderBy('created_at', 'DESC')->take($reg->abm)->get();
        $wait = Applicant::where('firstchoice', 'Accountancy, Business and Management')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->wabm)->get();

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 
    
        $year = Year::find($taon);

        $strand = 'Accountancy, Business and Management';

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('ABM-Applicants.pdf');

    }

    public function pdfGAS()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'General Academic')->where('year_id', $taon)->orderByDesc('gwa')->orderBy('created_at', 'DESC')->take($reg->gas)->get();
        $wait = Applicant::where('firstchoice', 'General Academic')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->wgas)->get();

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $year = Year::find($taon);
        $strand = 'General Academic';
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('GAS-Applicants.pdf');

    }

    public function pdfHUMSS()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'Humanities and Social Sciences')->where('year_id', $taon)->orderByDesc('gwa')->orderBy('created_at', 'DESC')->take($reg->humss)->get();
        $wait = Applicant::where('firstchoice', 'Humanities and Social Sciences')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->whumss)->get();

        $year = Year::find($taon);
        $strand = 'Humanities and Social Sciences';

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('HUMSS-Applicants.pdf');

    }

    public function pdfSTEM()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('year_id', $taon)->orderByDesc('gwa')->take($reg->stem)->get();
        $wait = Applicant::where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->wstem)->get();

        $year = Year::find($taon);
        $strand = 'Science, Technology, Engineering and Mathematics';

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('STEM-Applicants.pdf');

    }

    public function pdfCARE()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'Caregiving (Nursing Arts)')->where('year_id', $taon)->orderByDesc('gwa')->take($reg->care)->get();
        $wait = Applicant::where('firstchoice', 'Caregiving (Nursing Arts)')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->wcare)->get();

        $year = Year::find($taon);
        $strand = 'Caregiving (Nursing Arts)';

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('CARE-Applicants.pdf');

    }

    public function pdfEIM()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'Electrical Installation and Maintenance')->where('year_id', $taon)->orderByDesc('gwa')->take($reg->eim)->get();
        $wait = Applicant::where('firstchoice', 'Electrical Installation and Maintenance')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->weim)->get();

        $year = Year::find($taon);
        $strand = 'Electrical Installation and Maintenance';

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('EIM-Applicants.pdf');

    }

    public function pdfHE()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'Home Economics')->where('year_id', $taon)->orderByDesc('gwa')->take($reg->he)->get();
        $wait = Applicant::where('firstchoice', 'Home Economics')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->whe)->get();

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $year = Year::find($taon);
        $strand = 'Home Economics';
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('HE-Applicants.pdf');

    }

    public function pdfICT()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        $app = Applicant::where('firstchoice', 'Information and Communications Technology')->where('year_id', $taon)->orderByDesc('gwa')->take($reg->ict)->get();
        $wait = Applicant::where('firstchoice', 'Information and Communications Technology')->where('year_id', $taon)->whereNotIn('id', $app->pluck('id'))->orderByDesc('gwa')->skip($app->count())->take($reg->wict)->get();
        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $year = Year::find($taon);
        $strand = 'Information and Communications Technology';
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.applicantsReport', 
        compact('app','currentDate','pic1','pic2', 'year', 'strand', 'wait'))
        ->setPaper('a4', 'portrait');

        // stream PDF to user's browser
        return $pdf->stream('ICT-Applicants.pdf');

    }


    public function pdfGraduates(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $year = Year::find($request->year);

        $app = Student::where('promotedto', 'graduation')->where('year_id', $request->year)->get();
        $app2 = Student::where('promotedto', '12')->where('year_id', $request->year)->get();
        
        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 

        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.graduates', 
        // compact('app','currentDate','pic1','pic2', 'year'))
        // ->setPaper('a4', 'portrait');

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.graduates', 
        compact('app','currentDate', 'app2', 'pic1', 'pic2', 'year'))
        ->setPaper('a4', 'portrait');


        // stream PDF to user's browser
        return $pdf->stream('Graduates('.$year->year.').pdf');

    }


    public function pdfInterview(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $year = Year::find($taon);

        $app = Applicant::where('year_id', $taon)
        ->whereIn('emailStat', ['UNATTENDED', 'emailed'])
        ->orderBy('fullname', 'asc')
        ->get();

        $now = $this->currentDate();
        $currentDate = $now->format('F d, Y, h:i A'); 
        
        $path1 = base_path('public/assets/img/svnhsLogo.png');
        $type1 = pathinfo($path1, PATHINFO_EXTENSION);
        $data1 = file_get_contents($path1);
        $pic1 = 'data:/image' . $type1 . ';base64,' . base64_encode($data1);

        $path2 = base_path('public/assets/img/shsLogo.png');
        $type2 = pathinfo($path2, PATHINFO_EXTENSION);
        $data2 = file_get_contents($path2);
        $pic2 = 'data:/image' . $type2 . ';base64,' . base64_encode($data2);

        // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.graduates', 
        // compact('app','currentDate','pic1','pic2', 'year'))
        // ->setPaper('a4', 'portrait');

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('admin.report.interviewReport', 
        compact('app','currentDate', 'pic1', 'pic2', 'year'))
        ->setPaper('a4', 'portrait');


        // stream PDF to user's browser
        return $pdf->stream('Interviewee('.$year->year.').pdf');

    }

    public function currentDate()
    {
        $currentDate = Carbon::now('Asia/Singapore');
        
        // dd($currentDate);
        return $currentDate;
    }
}
