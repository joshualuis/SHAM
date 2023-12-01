<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Student;
use App\Models\Shortlisted;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Student_Schedule;
use App\Models\Curriculum;
use App\Models\Teacher_Schedule;
use App\Models\Student_Curriculum;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Year;
use Redirect;
use View;
use Illuminate\Support\Facades\Session;
use Auth;
use Validator;
use Illuminate\Validation\Rule;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $students = Student::with('section')->where('year_id', $taon)->get();

        $abm_strand = Strand::where('code', 'ABM')->get();foreach($abm_strand as $abm){$abm_id = $abm->id;}
        $gas_strand = Strand::where('code', 'GAS')->get();foreach($gas_strand as $gas){$gas_id = $gas->id;}
        $humss_strand = Strand::where('code', 'HUMSS')->get();foreach($humss_strand as $humss){$humss_id = $humss->id;}
        $stem_strand = Strand::where('code', 'STEM')->get();foreach($stem_strand as $stem){$stem_id = $stem->id;}
        $care_strand = Strand::where('code', 'CARE')->get();foreach($care_strand as $care){$care_id = $care->id;}
        $eim_strand = Strand::where('code', 'EIM')->get();foreach($eim_strand as $eim){$eim_id = $eim->id;}
        $he_strand = Strand::where('code', 'HE')->get();foreach($he_strand as $he){$he_id = $he->id;}
        $ict_strand = Strand::where('code', 'ICT')->get();foreach($ict_strand as $ict){$ict_id = $ict->id;}

        $abms = Section::with('teacher_schedule')->where('strand_id', $abm_id)->with('teacher')->where('year_id', $taon)->get();
        $gases = Section::with('teacher_schedule')->where('strand_id', $gas_id)->with('teacher')->where('year_id', $taon)->get();
        $humsses = Section::with('teacher_schedule')->where('strand_id', $humss_id)->with('teacher')->where('year_id', $taon)->get();
        $stems = Section::with('teacher_schedule')->where('strand_id', $stem_id)->with('teacher')->where('year_id', $taon)->get();
        $cares = Section::with('teacher_schedule')->where('strand_id', $care_id)->with('teacher')->where('year_id', $taon)->get();
        $eims = Section::with('teacher_schedule')->where('strand_id', $eim_id)->with('teacher')->where('year_id', $taon)->get();
        $hes = Section::with('teacher_schedule')->where('strand_id', $he_id)->with('teacher')->where('year_id', $taon)->get();
        $icts = Section::with('teacher_schedule')->where('strand_id', $ict_id)->with('teacher')->where('year_id', $taon)->get();

        // dd($cares);

        
        return View::make('admin.student.index', compact(
            'abms', 'gases', 'humsses', 'stems', 'cares', 'eims', 'hes', 'icts', 
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$people_ids = $request->people_ids;

        $people = $_GET['toEnlist'];

        // dd($people);
        $arr_shortlisted = array();

        foreach($people as $id)
        {
            $shortlisted = Shortlisted::where('_id', '=', $id)->get();
            array_push($arr_shortlisted, $shortlisted);
        }
        // dd($arr_shortlisted);
        return View::make('admin.students.create', compact('arr_shortlisted'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->people_ids);
        if($request->people_ids == null)
        {
            return redirect()->back()->withErrors(['Students' => 'No selected Student']);
        }

        if($request->people_ids != null){
            // dd($request);
            if(Session::missing('schoolyear')){
                $default = Year::all()->last();
                $taon = $default->id;
                // dump("DEFAULT YUNG YEAR MO TANAGA");
            }
            else{
                $taon = Session::get('schoolyear');
                // dump("AYAN MERON NANG YEAR");
            }

            // DEFAULT FIRST SEM
            $sem = Semester::all()->first();
            $semester = $sem->id;

            //$people = $_POST['toEnlist'];
            $people_ids = $request->people_ids;
            //dd($people_ids);
            foreach($people_ids as $id)
            {
                $shortlisted = Shortlisted::where('_id', '=', $id)->where('year_id', $taon)->get();
                foreach($shortlisted as $short)
                {
                    $short->status = "enrolled";
                    $short->update();

                    $short->applicant->status = "enrolled";
                    $short->applicant->update();
                    
                    $student = new Student;

                    // Section and Strand
                    $student->year_id = $taon;
                    $student->section_id = $short->section_id;
                    $student->strand_id = $short->strand_id;
                    $student->status = 'Regular';

                    $section = Section::find($short->section_id);

                    $student->glevel = $section->glevel;

                    $student->lrn = $short->applicant->lrn;
                    $student->psanumber = $short->applicant->psanumber;
                    $student->email = $short->applicant->email;
                    $student->fname = strtoupper($short->applicant->fname);
                    $student->mname = strtoupper($short->applicant->mname);
                    $student->lname = strtoupper($short->applicant->lname);

                    if($short->applicant->extname == 'N/A'){
                        $student->extname = 'N/A';
                    }
                    else{
                        $student->extname = $short->applicant->extname;
                    }

                    $comma=",";
                    if($student->extname == 'N/A'){
                        $student->fullname = collect([strtoupper($student->lname).$comma, strtoupper($student->fname), strtoupper($student->mname)])->implode(' ');
                    }
                    else{
                        $student->fullname = collect([strtoupper($student->lname).$comma, strtoupper($student->fname), strtoupper($student->mname), strtoupper($student->extname)])->implode(' ');
                    }

                    // $student->age = $short->applicant->age;
                    $student->birthdate = $short->applicant->birthdate;
                    $birthdate = new \DateTime($student->birthdate);
                    $currentDate = new \DateTime();
                    $student->age = $currentDate->diff($birthdate)->y;

                    $student->gender = $short->applicant->gender;
                    $student->contact = $short->applicant->contact;
                    $student->mothertongue = $short->applicant->mothertongue;
                    $student->religion = $short->applicant->religion;

                    // Address
                    $student->housestreet = $short->applicant->housestreet;
                    $student->barangay = $short->applicant->barangay;
                    $student->city = $short->applicant->city;
                    $student->province = $short->applicant->province;
                    $student->region = $short->applicant->region;

                    $student->indipeople = $short->applicant->indipeople;
                    $student->specialneeds = $short->applicant->specialneeds;
                    $student->assistivedevices = $short->applicant->assistivedevices;
                    
                    // INDI
                    if($student->indipeople == 'No'){
                        $student->yesindipeople = 'N/A';
                    }
                    elseif ($student->indipeople == 'Yes' && $short->applicant->yesindipeople != null){
                        $student->yesindipeople = $short->applicant->yesindipeople;
                    }
                    
                    // SPECIAL
                    if($student->specialneeds == 'No'){
                        $student->yesspecialneeds = 'N/A';
                    }
                    elseif ($student->specialneeds == 'Yes' && $short->applicant->yesspecialneeds != null){
                        $student->yesspecialneeds = $short->applicant->yesspecialneeds;
                    }
                    
                    // ASSIST
                    if($student->assistivedevices == 'No'){
                        $student->yesassistivedevices = 'N/A';
                    }
                    elseif ($student->assistivedevices == 'Yes' && $short->applicant->yesassistivedevices != null){
                        $student->yesassistivedevices = $short->applicant->yesassistivedevices;
                    }



                    // Mother
                    $student->mothername = $short->applicant->mothername;
                    $student->mothereducation = $short->applicant->mothereducation;
                    $student->motheremployment = $short->applicant->motheremployment;
                    $student->motherworkstat = $short->applicant->motherworkstat;
                    $student->mothercontact = $short->applicant->mothercontact;
                    
                    // Father
                    $student->fathername = $short->applicant->fathername;
                    $student->fathereducation  = $short->applicant->fathereducation;
                    $student->fatheremployment = $short->applicant->fatheremployment;
                    $student->fatherworkstat = $short->applicant->fatherworkstat;
                    $student->fathercontact = $short->applicant->fathercontact;

                    // Guardian
                    $student->guardianname = $short->applicant->guardianname;
                    $student->guardianeducation = $short->applicant->guardianeducation;
                    $student->guardianemployment = $short->applicant->guardianemployment;
                    $student->guardianworkstat = $short->applicant->guardianworkstat;
                    $student->guardiancontact = $short->applicant->guardiancontact;

                    // Images
                    $student->image = $short->applicant->image;
                }

                $student->save();

                // CREATE NEW STUDENT SCHEDULE BASED ON THE SECTION
                foreach($shortlisted as $short)
                {
                    // FIND THE STUDENT
                    $last = Student::where('lname', $short->applicant->lname)
                    ->where('mname', $short->applicant->mname)
                    ->where('fname', $short->applicant->fname)
                    ->where('year_id', $taon)->first();    

                    // FIND THE SCHEDULE OF THE SECTION
                    $section_subs = Teacher_Schedule::
                    where('section_id', $last->section_id)
                    ->where('year_id', $taon)
                    ->where('semester_id', $semester)
                    ->get();

                    // ADD STUDENT SCHEDULE BASED ON THE SECTION SCHEDULE
                    foreach($section_subs as $sub){
                        $stud_sched = new Student_Schedule;
                        $stud_sched->curriculum_id = $sub->curriculum_id;
                        $stud_sched->student_id = $last->id;
                        $stud_sched->section_id = $last->section_id;
                        $stud_sched->teacher_id = $sub->teacher_id;
                        $stud_sched->day = $sub->day;
                        $stud_sched->start = $sub->start;
                        $stud_sched->end = $sub->end;
                        $stud_sched->year_id = $sub->year_id;
                        $stud_sched->semester_id = $sub->semester_id;
                        $stud_sched->save();
                    }

                    foreach($section_subs as $schedule){
                        // CREATE NEW STUDENT CURRICULUM
                        $stud_sub = Student_Curriculum::where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                        if(count($stud_sub) == 0){
                            $bago = new Student_Curriculum;
                            $bago->student_id = $last->id;
                            $bago->teacher_id = $schedule->teacher_id;
                            $bago->section_id = $schedule->section_id;
                            $bago->curriculum_id = $schedule->curriculum_id;
                            $bago->year_id = $taon;
                            $bago->semester_id = $semester;
                            $bago->save();
                        }
                        else{ 
                            foreach($stud_sub as $sub){
                                if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                {}
                                elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                    $bago = new Student_Curriculum;
                                    $bago->student_id = $last->id;
                                    $bago->teacher_id = $schedule->teacher_id;
                                    $bago->section_id = $schedule->section_id;
                                    $bago->curriculum_id = $schedule->curriculum_id;
                                    $bago->year_id = $taon;
                                    $bago->semester_id = $semester;
                                    $bago->save();
                                }
                            }
                            
                        }
                    }
                }

                // CREATE NEW GRADE FOR NEW Regular STUDENT
                foreach($shortlisted as $short)
                {
                    $last = Student::where('lname', $short->applicant->lname)
                    ->where('mname', $short->applicant->mname)
                    ->where('fname', $short->applicant->fname)
                    ->where('year_id', $taon)->first();  

                    $first = Semester::all()->first();
                    $second = Semester::all()->last();

                    $all_sub = Student_Schedule::with('curriculum')->where('student_id', $last->id)->where('semester_id', $first->id)->get();

                    $dup_sub = array();
                    foreach($all_sub as $sub){
                        array_push($dup_sub, $sub->curriculum_id);
                    }
                    $final_sub = array_unique($dup_sub);

                    foreach($final_sub as $curr_id){
                        $sched = Student_Schedule::where('curriculum_id', $curr_id)->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $first->id)->get();
                        foreach($sched as $isked){
                            $grade = new Grade;
                            $grade->student_id = $last->id;
                            $grade->curriculum_id = $curr_id;
                            $grade->teacher_id = $isked->teacher_id;
                            $grade->section_id = $last->section_id;
                            $grade->year_id = $taon;
                            $grade->semester_id = $first->id;
                            $grade->q1 = null;
                            $grade->q2 = null;
                            $grade->final = null;
                            
                        }
                        $grade->save();
                    }
                }

                // CREATE NEW USER FOR NEW STUDENT
                foreach($shortlisted as $short)
                {
                    $comma=",";
                    $last = Student::all()->where('year_id', $taon)->last();
                    // Create User
                    $user = new User;
                    if($short->applicant->extname == 'N/A'){
                        $user->name = collect([strtoupper($short->applicant->lname).$comma, strtoupper($short->applicant->fname), strtoupper($short->applicant->mname)])->implode(' ');
                    }
                    else{
                        $user->name = collect([strtoupper($short->applicant->lname).$comma, strtoupper($short->applicant->fname), strtoupper($short->applicant->mname), strtoupper($short->applicant->extname)])->implode(' ');
                    }
                    
                    $user->email = $short->applicant->email;
                    // dump($user->email);
                    $user->password = bcrypt(strtoupper($short->applicant->lname));
                    $user->student_id = $last->id;
                    $user->role = 'student';
                    $user->status = 'enable';
                    $user->image = $short->applicant->image;
                    
                    $emailpassword = strtoupper($short->applicant->lname);
                    $mail_data = [
                        // CHANCE THE RECIPIENT
                        'recipient' => 'joshualuis.tanap@gmail.com',
                        'from' => 'shamwebandmobile@gmail.com',
                        'subject' => 'Enrollment update',
                        'email' => $user->email,
                        'password' => $emailpassword,
                    ];

                    \Mail::send('student-email-template', $mail_data, function($message) use($mail_data){
                        $message->to($mail_data['recipient'])
                        ->from($mail_data['from'])
                        ->subject($mail_data['subject']);
                    });
                    // dump($user);
                }
                // dump($user);
                $user->save();
            }
            return response()->json(['code'=>1,'msg'=>'New student has been enrolled']);
        }
        
    }

    public function evaluate($id)
    {

        $section = Section::find($id);
        $core = Curriculum::where('strand_id', 'None')->where('level', 'CORE')->get();
        $applied = Curriculum::where('strand_id', 'None')->where('level', 'APPLIED')->get();
        $specialized = Curriculum::where('strand_id', $section->strand_id)->get();
        // dd($checklist);  

        return View::make('admin.student.evaluate', compact('core', 'applied', 'specialized', 'section'));
    }

    public function createTransferee(Request $request)
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
        
        $semester = "63f35b94bde739958336b5c8";
        // dd($semester);
        $section = Section::find($request->section_id);
        $schedules = Teacher_Schedule::with('section')->with('teacher')->with('curriculum')->where('section_id', $request->section_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        if($request->items == null)
        {
            $mon = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'monday')->where('year_id', $taon)->where('semester_id', $semester)->get();
            $tue = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'tuesday')->where('year_id', $taon)->where('semester_id', $semester)->get();
            $wed = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'wednesday')->where('year_id', $taon)->where('semester_id', $semester)->get();
            $thu = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'thursday')->where('year_id', $taon)->where('semester_id', $semester)->get();
            $fri = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'friday')->where('year_id', $taon)->where('semester_id', $semester)->get();
        }
        else{
            $mon = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'monday')->where('year_id', $taon)->where('semester_id', $semester)->whereNotIn('curriculum_id', $request->items)->get();
            $tue = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'tuesday')->where('year_id', $taon)->where('semester_id', $semester)->whereNotIn('curriculum_id', $request->items)->get();
            $wed = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'wednesday')->where('year_id', $taon)->where('semester_id', $semester)->whereNotIn('curriculum_id', $request->items)->get();
            $thu = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'thursday')->where('year_id', $taon)->where('semester_id', $semester)->whereNotIn('curriculum_id', $request->items)->get();
            $fri = Teacher_Schedule::with('teacher', 'section', 'curriculum')->where('day', 'friday')->where('year_id', $taon)->where('semester_id', $semester)->whereNotIn('curriculum_id', $request->items)->get();
        }
        

        if(count($mon) == 0){
            $mon_sched = array();
        }
        else{
            foreach($mon as $data){
                $mon_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($tue) == 0){
            $tue_sched = array();
        }
        else{
            foreach($tue as $data){
                $tue_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($wed) == 0){
            $wed_sched = array();
        }
        else{
            foreach($wed as $data){
                $wed_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($thu) == 0){
            $thu_sched = array();
        }
        else{
            foreach($thu as $data){
                $thu_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($fri) == 0){
            $fri_sched = array();
        }
        else{
             foreach($fri as $data){
            $fri_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }  
        }

        // dd($mon_sched);
       
        return View::make('admin.student.newStudent', compact(
            'section', 'mon_sched', 'tue_sched', 'wed_sched', 'thu_sched', 'fri_sched', 'schedules',
        ));
    }

    // FOR TRANSFEREE
    public function storeTransferee(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        
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


        // DEFAULT FIRST SEM
        $sem = Semester::all()->first();
        $semester = $sem->id;

        //FIND STRAND
        $strand = Section::with('strand')->find($request->section_id);
        // STUDENT STORE
        {
            $student = new Student;
            // Section and Strand
            $student->year_id = $taon;
            $student->section_id = $request->section_id;
            $student->strand_id = $strand->strand->id;
            $student->status = 'Transferee';

            $section = Section::find($request->section_id);
            
            $student->glevel = $section->glevel;

            $student->lrn = $request->lrn;
            $student->psanumber = $request->psanumber;
            $student->email = $request->email;
            $student->fname = strtoupper($request->fname);
            $student->mname = strtoupper($request->mname);
            $student->lname = strtoupper($request->lname);

            if($request->extname == 'N/A' || $request->extname == null){
                $student->extname = 'N/A';
            }
            else{
                $student->extname = $request->extname;
            }

            $comma=",";
            if($student->extname == 'N/A'){
                $student->fullname = collect([strtoupper($student->lname).$comma, strtoupper($student->fname), strtoupper($student->mname)])->implode(' ');
            }
            else{
                $student->fullname = collect([strtoupper($student->lname).$comma, strtoupper($student->fname), strtoupper($student->mname), strtoupper($student->extname)])->implode(' ');
            }
            
            $student->age = $request->age;
            $student->birthdate = $request->birthdate;
            $student->gender = $request->gender;
            $student->contact = $request->contact;
            $student->mothertongue = $request->mothertongue;
            $student->religion = $request->religion;
            // Address
            $student->housestreet = $request->housestreet;
            $student->barangay = $request->barangay;
            $student->city = $request->city;
            $student->province = $request->province;
            $student->region = $request->region;

            $student->indipeople = $request->indipeople;
            $student->specialneeds = $request->specialneeds;
            $student->assistivedevices = $request->assistivedevices;

            // INDI
            if($student->indipeople == 'No'){
                $student->yesindipeople = 'N/A';
            }
            elseif ($student->indipeople == 'Yes' && $request->yesindipeople != null){
                $student->yesindipeople = $request->yesindipeople;
            }

            // SPECIAL
            if($student->specialneeds == 'No'){
                $student->yesspecialneeds = 'N/A';
            }
            elseif ($student->specialneeds == 'Yes' && $request->yesspecialneeds != null){
                $student->yesspecialneeds = $request->yesspecialneeds;
            }

            // ASSIST
            if($student->assistivedevices == 'No'){
                $student->yesassistivedevices = 'N/A';
            }
            elseif ($student->assistivedevices == 'Yes' && $request->yesassistivedevices != null){
                $student->yesassistivedevices = $request->yesassistivedevices;
            }


            // Mother
            $student->mothername = $request->mothername;
            $student->mothereducation = $request->mothereducation;
            $student->motheremployment = $request->motheremployment;
            $student->motherworkstat = $request->motherworkstat;
            $student->mothercontact = $request->mothercontact;
            // Father
            $student->fathername = $request->fathername;
            $student->fathereducation  = $request->fathereducation;
            $student->fatheremployment = $request->fatheremployment;
            $student->fatherworkstat = $request->fatherworkstat;
            $student->fathercontact = $request->fathercontact;
            // Guardian
            $student->guardianname = $request->guardianname;
            $student->guardianeducation = $request->guardianeducation;
            $student->guardianemployment = $request->guardianemployment;
            $student->guardianworkstat = $request->guardianworkstat;
            $student->guardiancontact = $request->guardiancontact;
            // Images
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            
            $imageString = '';
            for ($i = 0; $i < $length; $i++) {
                $imageString .= $characters[random_int(0, $charactersLength - 1)];
            }

            $image = time().$imageString.'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('storage/images'), $image);
            $input['image'] = 'storage/images/'.$image;
            $student->image = $input['image'];
            
            $student->save();
        }
        // CREATE NEW STUDENT SCHEDULE BASED ON THE SECTION
        $last = Student::where('lname', $student->lname)->where('mname', $student->mname)->where('fname', $student->fname)->where('year_id', $taon)->first(); 

        if($request->mon_curriculums != null || $request->tue_curriculums != null || $request->wed_curriculums != null || $request->thu_curriculums != null || $request->fri_curriculums != null ){
            //------------------------------------------------- 
            //                     Monday
            //-------------------------------------------------
            if($request->mon_curriculums != null){
                $mon_curriculums = $request->mon_curriculums;
                foreach($mon_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('section_id', $studSched->section_id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Tuesday
            //-------------------------------------------------
            if($request->tue_curriculums != null){
                $tue_curriculums = $request->tue_curriculums;
                foreach($tue_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('section_id', $studSched->section_id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Wednesday
            //-------------------------------------------------
            if($request->wed_curriculums != null){
                $wed_curriculums = $request->wed_curriculums;
                foreach($wed_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('section_id', $studSched->section_id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Thursday
            //-------------------------------------------------
            if($request->thu_curriculums != null){
                $thu_curriculums = $request->thu_curriculums;
                foreach($thu_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('section_id', $studSched->section_id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Friday
            //-------------------------------------------------
            if($request->fri_curriculums != null){
                $fri_curriculums = $request->fri_curriculums;
                foreach($fri_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('section_id', $studSched->section_id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }
        }

        // CREATE NEW GRADE FOR NEW Regular STUDENT
        $first = Semester::all()->first();
        $second = Semester::all()->last();

        $all_sub = Student_Schedule::with('curriculum')->where('student_id', $last->id)->where('semester_id', $first->id)->where('year_id', $taon)->get();

        $dup_sub = array();
        foreach($all_sub as $sub){
            // dump($sub->curriculum_id);
            array_push($dup_sub, $sub->curriculum_id);
        }
        $final_sub = array_unique($dup_sub);

        foreach($final_sub as $curr_id){
            $sched = Student_Schedule::where('curriculum_id', $curr_id)->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $first->id)->get();
            foreach($sched as $isked){
                $grade = new Grade;
                $grade->student_id = $last->id;
                $grade->curriculum_id = $curr_id;
                $grade->teacher_id = $isked->teacher_id;
                $grade->section_id = $last->section_id;
                $grade->year_id = $taon;
                $grade->semester_id = $first->id;
                $grade->q1 = null;
                $grade->q2 = null;
                $grade->final = null;
            }
            $grade->save();
        }

        // CREATE NEW USER FOR NEW STUDENT
        $comma=",";
        $last = Student::all()->where('year_id', $taon)->last();
        // Create User
        $user = new User;
        if($request->extname == 'N/A' || $request->extname == null){
            $user->name = collect([$request->lname.$comma, $request->fname, $request->mname])->implode(' ');
        }
        else{
            $user->name = collect([$request->lname.$comma, $request->fname, $request->mname, $request->extname])->implode(' ');
        }
        $user->email = $request->email;
        $user->password = bcrypt(strtoupper($request->lname));
        $user->student_id = $last->id;
        $user->role = 'student';
        $user->status = 'enable';
        $user->image = $last->image;
        $user->save();
        
        return Redirect::route('students.show', $last->section_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd("HEY");
        $section = \App\Models\Section::with('teacher', 'strand')->find($id);
        $students = Student::where('section_id', $section->id)->orderBy('lname')->get();
        // dd($section);

        return View::make('admin.student.viewStudents', compact('section', 'students'));
    }

    public function showStudent($id)
    {
        // dd($id);
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }

        // DEFAULT FIRST SEM
        
        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        $student = Student::find($id);
        $section = Section::find($student->section_id);

        $isked_stud = Student_Schedule::with('section')->with('teacher')->with('curriculum')->where('student_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        // dd($isked_stud);

        $schedules = array();
        foreach($isked_stud as $d)
        {
            $to = Teacher_Schedule::with('section')->with('teacher')->with('curriculum')
            ->where('section_id', $d->section_id)
            ->where('curriculum_id', $d->curriculum_id)
            ->where('teacher_id', $d->teacher_id)
            ->where('start', $d->start)
            ->where('end', $d->end)
            ->where('day', $d->day)
            ->where('year_id', $d->year_id)
            ->where('semester_id', $d->semester_id)
            ->get();
            // dump($to, $d);
            array_push($schedules, $to);
        }

        // dd();    

        $mon = Teacher_Schedule::with('teacher')->with('section')->with('curriculum')->where('day', 'monday')->where('year_id', $taon)->where('semester_id', $semester)->get();
        $tue = Teacher_Schedule::with('teacher')->with('section')->with('curriculum')->where('day', 'tuesday')->where('year_id', $taon)->where('semester_id', $semester)->get();
        $wed = Teacher_Schedule::with('teacher')->with('section')->with('curriculum')->where('day', 'wednesday')->where('year_id', $taon)->where('semester_id', $semester)->get();
        $thu = Teacher_Schedule::with('teacher')->with('section')->with('curriculum')->where('day', 'thursday')->where('year_id', $taon)->where('semester_id', $semester)->get();
        $fri = Teacher_Schedule::with('teacher')->with('section')->with('curriculum')->where('day', 'friday')->where('year_id', $taon)->where('semester_id', $semester)->get();

        if(count($mon) == 0){
            $mon_sched = array();
        }
        else{
            foreach($mon as $data){
                $mon_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($tue) == 0){
            $tue_sched = array();
        }
        else{
            foreach($tue as $data){
                $tue_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($wed) == 0){
            $wed_sched = array();
        }
        else{
            foreach($wed as $data){
                $wed_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($thu) == 0){
            $thu_sched = array();
        }
        else{
            foreach($thu as $data){
                $thu_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }
        }
        if(count($fri) == 0){
            $fri_sched = array();
        }
        else{
             foreach($fri as $data){
            $fri_sched[$data->id] = collect([$data->curriculum->name, $data->teacher->fullname, $data->section->name,$data->start,$data->end])->implode(' | ');
            }  
        }


        $secSched = Teacher_Schedule::with('section')->with('teacher')->with('curriculum')->where('section_id', $section->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        $curriculums = Curriculum::pluck('name', '_id');
        $teachers = Teacher::where('year_id', $taon)->pluck('fullname', '_id');
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $sem = Semester::find($semester);
        $year = Year::find($taon);


        // dd($tue_sched);
        return View::make('admin.student.newStudentEdit', compact(
            'student', 'section', 'schedules', 'mon_sched', 'tue_sched', 'wed_sched', 'thu_sched', 'fri_sched', 'curriculums', 'teachers', 'days', 'secSched', 'sem', 'year'
        ));
    }

    public function sem(Request $request)
    {
        // dd($request);
        Session::put('semester', $request->semester_id);

        return Redirect::route('admin.showStudent', [$request->student_id]);

    }

    public function showStudentUpdate(Request $request, $id)
    {
        $tao_id = $id;

        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        $find = Student::find($tao_id); 
        $all = Student::where('lname', $find->lname)->where('mname', $find->mname)->where('fname', $find->fname)->get();

        // if($request->hasFile('image'))
        // {
        //     $length = 10;
        //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        //     $charactersLength = strlen($characters);
            
        //     $imageString = '';
        //     for ($i = 0; $i < $length; $i++) {
        //         $imageString .= $characters[random_int(0, $charactersLength - 1)];
        //     }
            
        //     $image = time().$imageString.'.'.$request->file('image')->extension();
        //     $request->file('image')->move(public_path('storage/images'), $image);
        //     // $input['image'] = 'storage/images/'.$image;
        //     // $teacher->image = $input['image'];
        //     $imagee = 'storage/images/'.$image;
            
        // }

        // UPDATE ALL STUDENT
        foreach($all as $last)
        {

            // $last->status = $request->status;
            // $last->lrn = $request->lrn;
            // $last->psanumber = $request->psanumber;
            // $last->email = $request->email;
            // $last->fname = strtoupper($request->fname);
            // $last->mname = strtoupper($request->mname);
            // $last->lname = strtoupper($request->lname);

            // if($request->extname == 'N/A'){
            //     $last->extname = 'N/A';
            // }
            // else{
            //     $last->extname = $request->extname;
            // }

            $comma=",";
            // if($last->extname == 'N/A'){
            //     $last->fullname = collect([strtoupper($last->lname).$comma, strtoupper($last->fname), strtoupper($last->mname)])->implode(' ');
            // }
            // else{
            //     $last->fullname = collect([strtoupper($last->lname).$comma, strtoupper($last->fname), strtoupper($last->mname), strtoupper($last->extname)])->implode(' ');
            // }
        
            // $last->age = $request->age;
            $last->birthdate = $request->birthdate;
            $birthdate = new \DateTime($last->birthdate);
            $currentDate = new \DateTime();
            $last->age = $currentDate->diff($birthdate)->y;

            $last->gender = $request->gender;
            // $last->contact = $request->contact;
            $last->mothertongue = $request->mothertongue;
            $last->religion = $request->religion;
            // Address
            $last->housestreet = $request->housestreet;
            $last->barangay = $request->barangay;
            $last->city = $request->city;
            $last->province = $request->province;
            $last->region = $request->region;

            // $last->indipeople = $request->indipeople;
            // $last->specialneeds = $request->specialneeds;
            // $last->assistivedevices = $request->assistivedevices;

            // // INDI
            // if($last->indipeople == 'No'){
            //     $last->yesindipeople = 'N/A';
            // }
            // elseif ($last->indipeople == 'Yes' && $request->yesindipeople != null){
            //     $last->yesindipeople = $request->yesindipeople;
            // }
            
            // // SPECIAL
            // if($last->specialneeds == 'No'){
            //     $last->yesspecialneeds = 'N/A';
            // }
            // elseif ($last->specialneeds == 'Yes' && $request->yesspecialneeds != null){
            //     $last->yesspecialneeds = $request->yesspecialneeds;
            // }

            // // ASSIST
            // if($last->assistivedevices == 'No'){
            //     $last->yesassistivedevices = 'N/A';
            // }
            // elseif ($last->assistivedevices == 'Yes' && $request->yesassistivedevices != null){
            //     $last->yesassistivedevices = $request->yesassistivedevices;
            // }

            
            // Mother
            $last->mothername = $request->mothername;
            // $last->mothereducation = $request->mothereducation;
            // $last->motheremployment = $request->motheremployment;
            // $last->motherworkstat = $request->motherworkstat;
            $last->mothercontact = $request->mothercontact;
            // Father
            $last->fathername = $request->fathername;
            // $last->fathereducation  = $request->fathereducation;
            // $last->fatheremployment = $request->fatheremployment;
            // $last->fatherworkstat = $request->fatherworkstat;
            $last->fathercontact = $request->fathercontact;
            // Guardian
            $last->guardianname = $request->guardianname;
            // $last->guardianeducation = $request->guardianeducation;
            // $last->guardianemployment = $request->guardianemployment;
            // $last->guardianworkstat = $request->guardianworkstat;
            $last->guardiancontact = $request->guardiancontact;

            // if($request->hasFile('image'))
            // {
            //     $last->image = $imagee;
            // }
            $last->update();
        }
        
        $find = Student::find($id); 
        $last = Student::where('lname',$find->lname)->where('fname',$find->fname)->where('mname',$find->mname)->get()->first();

        if($last->status == "Transferee")
        {
            $stud_ids = Student_Schedule::where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
            $grade_ids = Grade::where('section_id', $last->section_id)->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
            $studcurrs = Student_Curriculum::all()->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $semester);
            // DELETE STUDENT CURR
            
            // CREATE NEW STUDENT SCHEDULE BASED ON THE SECTION
            // dd("UMABOT");
            if($request->mon_curriculums != null || $request->tue_curriculums != null || $request->wed_curriculums != null || $request->thu_curriculums != null || $request->fri_curriculums != null ){
                

                // Delete all student curriculum
                foreach($studcurrs as $id){   
                    $delete = Student_Curriculum::find($id->id);
                    $delete->delete();
                }

                // Delete all student schedule
                foreach($stud_ids as $id){   
                    $delete = Student_Schedule::find($id->id);
                    $delete->delete();
                }

                // Delete all grades of student in section
                foreach($grade_ids as $id){   
                    $delete = Grade::find($id->id);
                    $delete->delete();
                }
            //------------------------------------------------- 
            //                     Monday
            //-------------------------------------------------
            if($request->mon_curriculums != null){
                $mon_curriculums = $request->mon_curriculums;
                foreach($mon_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('student_id', $last->id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    // dd($stud_sub);
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            // dd("STOP");

            //------------------------------------------------- 
            //                     Tuesday
            //-------------------------------------------------
            if($request->tue_curriculums != null){
                $tue_curriculums = $request->tue_curriculums;
                foreach($tue_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('student_id', $last->id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Wednesday
            //-------------------------------------------------
            if($request->wed_curriculums != null){
                $wed_curriculums = $request->wed_curriculums;
                foreach($wed_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('student_id', $last->id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Thursday
            //-------------------------------------------------
            if($request->thu_curriculums != null){
                $thu_curriculums = $request->thu_curriculums;
                foreach($thu_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('student_id', $last->id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            //------------------------------------------------- 
            //                     Friday
            //-------------------------------------------------
            if($request->fri_curriculums != null){
                $fri_curriculums = $request->fri_curriculums;
                foreach($fri_curriculums as $id)
                {
                    $thesched = Teacher_Schedule::find($id);
                    // FOR STUDENTS
                    $studSched = new Student_Schedule;
                    $studSched->curriculum_id = $thesched->curriculum_id;
                    $studSched->student_id = $last->id;
                    $studSched->section_id = $thesched->section_id;
                    $studSched->teacher_id = $thesched->teacher_id;
                    $studSched->room = $thesched->room;
                    $studSched->day = $thesched->day;
                    $studSched->start = $thesched->start;
                    $studSched->end = $thesched->end;
                    $studSched->status = "Transferee";
                    $studSched->year_id = $thesched->year_id;
                    $studSched->semester_id = $thesched->semester_id;
                    $studSched->save();

                    $stud_sub = Student_Curriculum::where('student_id', $last->id)->where('teacher_id', $studSched->teacher_id)->where('curriculum_id', $studSched->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                    if(count($stud_sub) == 0){
                        $bago = new Student_Curriculum;
                        $bago->student_id = $last->id;
                        $bago->teacher_id = $thesched->teacher_id;
                        $bago->section_id = $thesched->section_id;
                        $bago->curriculum_id = $thesched->curriculum_id;
                        $bago->status = "Transferee";
                        $bago->year_id = $thesched->year_id;
                        $bago->semester_id = $thesched->semester_id;
                        $bago->save();
                    }
                    else{ 
                        foreach($stud_sub as $sub){
                            if($sub->curriculum_id == $studSched->curriculum_id && $sub->section_id == $studSched->section_id && $sub->teacher_id == $studSched->teacher_id)
                            {}
                            elseif($sub->curriculum_id != $studSched->curriculum_id && $sub->section_id != $studSched->section_id && $sub->teacher_id != $studSched->teacher_id){
                                $bago = new Student_Curriculum;
                                $bago->student_id = $last->id;
                                $bago->teacher_id = $thesched->teacher_id;
                                $bago->section_id = $thesched->section_id;
                                $bago->curriculum_id = $thesched->curriculum_id;
                                $bago->status = "Transferee";
                                $bago->year_id = $thesched->year_id;
                                $bago->semester_id = $thesched->semester_id;
                                $bago->save();
                            }
                        }
                    }
                }
            }

            // CREATE NEW GRADE FOR NEW Regular STUDENT
            $all_sub = Student_Schedule::with('semester')->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
            $dup_sub = array();
            foreach($all_sub as $sub){
                // dump($sub->curriculum_id);
                array_push($dup_sub, $sub->curriculum_id);
            }
            $final_sub = array_unique($dup_sub);

            $array = array();
            foreach($final_sub as $curr_id){
                $sched = Student_Schedule::where('curriculum_id', $curr_id)->where('student_id', $last->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                foreach($sched as $isked){
                    array_push($array, $curr_id);
                    $grade = new Grade;
                    $grade->student_id = $last->id;
                    $grade->curriculum_id = $curr_id;
                    $grade->teacher_id = $isked->teacher_id;
                    $grade->section_id = $last->section_id;
                    $grade->year_id = $taon;
                    $grade->status = 'Transferee';
                    $grade->semester_id = $semester;
                    $grade->q1 = null;
                    $grade->q2 = null;
                    $grade->final = null;
                    
                }
                $grade->save();
            }

            // dd("BEFORE USER");
            // UPDATE USER FOR STUDENT
            // $comma=",";
            // $user = User::find('student_id', $last->id);
            // if($last->extname == 'N/A'){
            //     $user->name = collect([$last->lname.$comma, $last->fname, $last->mname])->implode(' ');
            // }
            // else{
            //     $user->name = collect([$last->lname.$comma, $last->fname, $last->mname, $last->extname])->implode(' ');
            // }
            // $user->email = $last->email;
            // $user->password = bcrypt(strtoupper($last->lname));
            // $user->student_id = $last->id;
            // $user->image = $last->image;
            // $user->update();

            }
            // IF NO SCHED IS SAVED, DELETE STUD_CURR, STUD_SCHED, GRADES
            elseif($request->mon_curriculums == null && $request->tue_curriculums == null && $request->wed_curriculums == null && $request->thu_curriculums == null && $request->fri_curriculums == null ){

                // Delete all student schedule
                foreach($studcurrs as $id){   
                    $delete = Student_Curriculum::find($id->id);
                    $delete->delete();
                }
    
                // Delete all student schedule
                foreach($stud_ids as $id){   
                    $delete = Student_Schedule::find($id->id);
                    $delete->delete();
                }
    
                // Delete all grades of student in section
                foreach($grade_ids as $id){   
                    $delete = Grade::find($id->id);
                    $delete->delete();
                }

            }
        }
        return Redirect::route('students.show', $last->section_id);
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $student = Student::find($id);
        return response()->json($student);
    }

    public function editProfile($id)
    {   
        $student = Student::find($id);

        return View::make('student.editProfile', compact('student'));
    }

    public function updateProfile(Request $request, $id)
    {

        $find = Student::find($id);
        
        // $findname = $find->fullname;
        // dd(User::where('name', $findname)->get()->first());

        $all = Student::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->get();
        $first = Student::where('lname', $find->lname)->where('fname', $find->fname)->where('mname', $find->mname)->get()->first();

        foreach($all as $student)
        {
            $student->lrn = $request->lrn;
            $student->psanumber = $request->psanumber;
            // $student->email = $request->email;
            $student->fname = strtoupper($request->fname);
            $student->mname = strtoupper($request->mname);
            $student->lname = strtoupper($request->lname);
        
            if($request->extname == 'N/A' || $request->extname == null){
                $student->extname = 'N/A';
            }
            else{
                $student->extname = $request->extname;
            }
        
            $comma=",";
            if($student->extname == 'N/A'){
                $student->fullname = collect([strtoupper($student->lname).$comma, strtoupper($student->fname), strtoupper($student->mname)])->implode(' ');
            }
            else{
                $student->fullname = collect([strtoupper($student->lname).$comma, strtoupper($student->fname), strtoupper($student->mname), strtoupper($student->extname)])->implode(' ');
            }
        
            // $student->age = $request->age;
            $student->birthdate = $request->birthdate;
            $birthdate = new \DateTime($student->birthdate);
            $currentDate = new \DateTime();
            $student->age = $currentDate->diff($birthdate)->y;
            
            $student->gender = $request->gender;
            $student->contact = $request->contact;
            $student->mothertongue = $request->mothertongue;
            $student->religion = $request->religion;
            // Address
            $student->housestreet = $request->housestreet;
            $student->barangay = $request->barangay;
            $student->city = $request->city;
            $student->province = $request->province;
            $student->region = $request->region;
        
            $student->indipeople = $request->indipeople;
            $student->specialneeds = $request->specialneeds;
            $student->assistivedevices = $request->assistivedevices;
        
            // INDI
            if($student->indipeople == 'No'){
                $student->yesindipeople = 'N/A';
            }
            elseif ($student->indipeople == 'Yes' && $request->yesindipeople != null){
                $student->yesindipeople = $request->yesindipeople;
            }
            
            // SPECIAL
            if($student->specialneeds == 'No'){
                $student->yesspecialneeds = 'N/A';
            }
            elseif ($student->specialneeds == 'Yes' && $request->yesspecialneeds != null){
                $student->yesspecialneeds = $request->yesspecialneeds;
            }
        
            // ASSIST
            if($student->assistivedevices == 'No'){
                $student->yesassistivedevices = 'N/A';
            }
            elseif ($student->assistivedevices == 'Yes' && $request->yesassistivedevices != null){
                $student->yesassistivedevices = $request->yesassistivedevices;
            }
        
            
            // Mother
            $student->mothername = $request->mothername;
            $student->mothereducation = $request->mothereducation;
            $student->motheremployment = $request->motheremployment;
            $student->motherworkstat = $request->motherworkstat;
            $student->mothercontact = $request->mothercontact;
            // Father
            $student->fathername = $request->fathername;
            $student->fathereducation  = $request->fathereducation;
            $student->fatheremployment = $request->fatheremployment;
            $student->fatherworkstat = $request->fatherworkstat;
            $student->fathercontact = $request->fathercontact;
            // Guardian
            $student->guardianname = $request->guardianname;
            $student->guardianeducation = $request->guardianeducation;
            $student->guardianemployment = $request->guardianemployment;
            $student->guardianworkstat = $request->guardianworkstat;
            $student->guardiancontact = $request->guardiancontact;

            if($request->image != null)
            {
                // Images
                $length = 10;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                
                $imageString = '';
                for ($i = 0; $i < $length; $i++) {
                    $imageString .= $characters[random_int(0, $charactersLength - 1)];
                }
        
                $image = time().$imageString.'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('storage/images'), $image);
                $input['image'] = 'storage/images/'.$image;
                $student->image = $input['image'];
                // dump($student->image);
            }

            $student->update();
            // dump($student);
        }
        
        $user = User::where('student_id', $first->id)->get()->first();
        
        $user->name = $student->fullname;
        $user->image = $student->image;
        $user->update();

        Session::put('image',$user->image);
        
        return Redirect::route('getProfile');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student = Student::find($id);
        $student->fname = $request->fname;
        $student->mname = $request->mname;
        $student->lname = $request->lname;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->address = $request->address;
        $student->save();
        return Redirect::route('shortlisteds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student = Student::find($id);
        $student->delete();
   
        return Redirect::route('shortlisteds.index');

    }

    public function studentSchedule()
    {    

        $user = Auth::user();
        $fullname = $user->student->fullname;
        
        $foryear = Student_Schedule::with('year', 'semester')
        ->whereHas('student', function ($query) use ($fullname) {
            $query->where('fullname', $fullname);
        })
        ->get();

        $foryear = $foryear->sortByDesc(function ($schedule) {
            return $schedule->year->year;
        });

        // NO DUPLICATION OF YEAR
        $allyear = array();
        foreach($foryear as $a){
            $allyear[$a->year->year] = $a->year_id;
        }
        $fyear = array_unique($allyear);

        // NO DUPLICATION OF SEM
        $allsem = array();
        foreach($foryear as $a){
            $allsem[$a->semester->semester] = $a->semester_id;
        }
        $fsem = array_unique($allsem);
        
        // dd($fyear, $fsem);
        $year_array = array();
        $sem_array = array();

        foreach($fyear as $schoolyear => $year){
            foreach($fsem as $semi => $sem){
                $sched = Student_Schedule::with('semester', 'year')->whereHas('student', function ($query) use ($fullname) {
                    $query->where('fullname', $fullname);
                })->where('year_id', $year)->where('semester_id', $sem)->get();
                $sem_array[$semi] = $sched;
            }
            $year_array[$schoolyear] = $sem_array;
        }

        $curriculums = Curriculum::pluck('name', '_id');
        $teachers = Teacher::pluck('lname', '_id');
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

        return View::make('student.studentSchedule', compact( 
             'curriculums', 'days', 'teachers', 'year_array',
        ));
    }

    public function viewGrades()
    {
        // if(Session::missing('schoolyear')){
        //     $default = Year::all()->last();
        //     $taon = $default->id;
        // // }
        // else{
            $taon = Session::get('schoolyear');
        // }
        // $at = Year::find($taon);
        // dd($at);

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        
        $user = Auth::user();
        
        $find = Student::with('section', 'strand')->find($user->student_id);
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
        
        // dd($attend, $studattend);
        // PRESENT
        foreach ($studattend as $key => $value) {$studmcount[(int)$key] = count($value);}
        // TOTAL
        foreach ($attend as $key => $value) {$usermcount[(int)$key] = count($value);}
        // ABSENT


        // dd($studattend, $attend);
        foreach ($usermcount as $key => $value) 
        {
            
             $absmcount[$key] = $value - $studmcount[$key];
            // xdump($value);
            // dump($absmcount[(int)$key]);
        }
        // dd();
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
        
        // dd($userArr);
        $syGWA = ($firstGWA+ $secondGWA) / 2;
        if($student->section->teacher_id == "TBD")
        {
            $adviser = "TBD";
        }
        else{
            $adviser = $student->section->teacher->fullname;
        }
        $year = Year::find($taon);
        return View::make('student.viewGrades', compact( 
            'grades', 'student', 'userArr', 'year', 'firstGWA', 'secondGWA', 'totalPresent', 'totalAll', 'totalAbsent', 'syGWA', 'adviser'
        ));
    }

    public function listClearance($id)
    {
        // dd("HEY");

        $section = Section::with('teacher', 'strand')->find($id);
        
        // dd($section);
        $cleared = Student::where('section_id', $id)->where('clearance', 'cleared')->where('year_id', $section->year_id)->get();

        $year = Year::where('_id', '>', $section->year_id)->orderBy('_id','asc')->first();

        if($section->glevel == '12'){
            $all = Student::where('section_id', $id)->where('year_id', $section->year_id)->get();

            $allStudent = count($all);
            $allCleared = count($cleared);

            return View::make('admin.student.listClearance', compact( 
                'cleared', 'section', 'allStudent', 'allCleared'
            ));
        }

        if($year == null)
        {
            Alert::warning('CLEARANCE', 'Please create a new school year first to promote the Grade 11 students.');
            return redirect()->route('students.index');   
        }

        if($section->glevel == '11'){
            
            $all = Student::where('section_id', $id)->where('year_id', $section->year_id)->get();
    
            $adviser = Section::with('teacher')->where('year_id', $year->id)->get();
            
            // dd()
            $allTeacher = Teacher::all()->where('year_id', $year->id);
    
            $adviserArr = array();
            foreach($adviser as $teach){
                if($teach->teacher_id == 'TBD'){  
                }
                else{
                     $adviserArr[$teach->teacher_id] = $teach->teacher->fullname;
                }
               
            }
    
            $lahat = array();
            foreach($allTeacher as $teach){
                $lahat[$teach->id] = $teach->fullname;
            }   
    
            $fteacher = array_diff($lahat, $adviserArr);
    
            $allStudent = count($all);
            $allCleared = count($cleared);
            
            return View::make('admin.student.listClearance', compact( 
                'cleared', 'section', 'allStudent', 'allCleared', 'fteacher'
            ));
        }
       
    }

    public function promote(Request $request)
    {
        $section = Section::with('teacher', 'year')->find($request->section_id);
        // dd($request);
        $year = Year::where('_id', '>', $section->year_id)->orderBy('_id','asc')->first();

        // IF THE STUDENT IS GRADE 11
        if($section->glevel == '11'){
            
            $cleared = Student::where('section_id', $request->section_id)->where('clearance', 'cleared')->where('year_id', $section->year_id)->get();

            // CREATE NEW SECTION
            $newSection = new Section;
            $newSection->name = $request->sectionName;
            $newSection->room = $request->room;
            $newSection->teacher_id = $request->teacher_id;
            $newSection->strand_id = $section->strand_id;
            $newSection->year_id = $year->id;
            $newSection->glevel = '12';
            $newSection->fullname = $newSection->glevel . '-' . $newSection->name;
            $newSection->save();
            
            // FIND THE NEW SECTION
            $found = Section::where('name', $newSection->name)
            ->where('room', $newSection->room)
            ->where('teacher_id', $newSection->teacher_id)
            ->where('strand_id', $newSection->strand_id)
            ->where('year_id', $newSection->year_id)->get()->first();

            foreach($cleared as $student)
            {
                $new = new Student;
                // Section and Strand
                $new->year_id = $year->id;
                $new->section_id = $found->id; 
                $new->strand_id = $found->strand_id;
                $new->status = 'Regular';
                $new->glevel = '12';
                $new->lrn = $student->lrn;
                $new->psanumber = $student->psanumber;
                $new->email = $student->email;
                $new->fname = strtoupper($student->fname);
                $new->mname = strtoupper($student->mname);
                $new->lname = strtoupper($student->lname);
                
                if($request->extname == 'N/A' || $request->extname == null){
                    $new->extname = 'N/A';
                }
                else{
                    $new->extname = $request->extname;
                }

                $comma=",";
                if($new->extname == 'N/A'){
                    $new->fullname = collect([strtoupper($new->lname).$comma, strtoupper($new->fname), strtoupper($new->mname)])->implode(' ');
                }
                else{
                    $new->fullname = collect([strtoupper($new->lname).$comma, strtoupper($new->fname), strtoupper($new->mname), strtoupper($new->extname)])->implode(' ');
                }

                // $new->age = $student->age;
                $new->birthdate = $student->birthdate;

                $birthdate = new \DateTime($new->birthdate);
                $currentDate = new \DateTime();
                $new->age = $currentDate->diff($birthdate)->y;

                $new->gender = $student->gender;
                $new->contact = $student->contact;
                $new->mothertongue = $student->mothertongue;
                $new->religion = $student->religion;

                // Address
                $new->housestreet = $student->housestreet;
                $new->barangay = $student->barangay;
                $new->city = $student->city;
                $new->province = $student->province;
                $new->region = $student->region;

                $new->indipeople = $student->indipeople;
                $new->specialneeds = $student->specialneeds;
                $new->assistivedevices = $student->assistivedevices;

                // INDI
                if($new->indipeople == 'No'){
                    $new->yesindipeople = 'N/A';
                }
                elseif ($new->indipeople == 'Yes' && $student->yesindipeople != null){
                    $new->yesindipeople = $student->yesindipeople;
                }
                
                // SPECIAL
                if($new->specialneeds == 'No'){
                    $new->yesspecialneeds = 'N/A';
                }
                elseif ($new->specialneeds == 'Yes' && $student->yesspecialneeds != null){
                    $new->yesspecialneeds = $student->yesspecialneeds;
                }

                // ASSIST
                if($new->assistivedevices == 'No'){
                    $new->yesassistivedevices = 'N/A';
                }
                elseif ($new->assistivedevices == 'Yes' && $student->yesassistivedevices != null){
                    $new->yesassistivedevices = $student->yesassistivedevices;
                }


                // Mother
                $new->mothername = $student->mothername;
                $new->mothereducation = $student->mothereducation;
                $new->motheremployment = $student->motheremployment;
                $new->motherworkstat = $student->motherworkstat;
                $new->mothercontact = $student->mothercontact;
                
                // Father
                $new->fathername = $student->fathername;
                $new->fathereducation  = $student->fathereducation;
                $new->fatheremployment = $student->fatheremployment;
                $new->fatherworkstat = $student->fatherworkstat;
                $new->fathercontact = $student->fathercontact;

                // Guardian
                $new->guardianname = $student->guardianname;
                $new->guardianeducation = $student->guardianeducation;
                $new->guardianemployment = $student->guardianemployment;
                $new->guardianworkstat = $student->guardianworkstat;
                $new->guardiancontact = $student->guardiancontact;

                // Images
                $new->image = $student->image;
                $new->promotedto = '12';

                $new->save();
            }
            
    
        }

        return Redirect::route('students.index');
    }

    public function promoteGraduation($id)
    {
        // dd("HEY");
        // FOR GRADE 12 STUDENTS
        $section = Section::with('teacher', 'year')->find($id);
        $cleared = Student::where('section_id', $section->id)->where('clearance', 'cleared')->where('year_id', $section->year_id)->get();

        foreach($cleared as $student){
            $stud = Student::find($student->id);
            $stud->promotedto = 'graduation';
            $stud->update();
        }

        return Redirect::route('students.index');
    }


    public function allStudents(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        if ($request->ajax()) {
            $data = Student::where('year_id', $taon)->get();
            $dataSorted = $data->sortBy(function ($student) {
                return $student->section->fullname;
            });
            return Datatables::of($dataSorted)
                    ->addIndexColumn()
                    ->addColumn('section_name', function($row) {
                        return $row->section->fullname;
                    })
                    ->addColumn('action', 'admin.student.action')
                    ->make();
        }
      
        return view('admin.student.allStudents');
    }

}
