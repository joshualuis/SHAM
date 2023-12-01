<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Student;
use App\Models\Applicant;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Teacher;
use App\Models\Teacher_Curriculum;
use App\Models\Teacher_Schedule;
use App\Models\Student_Schedule;
use App\Models\Curriculum;
use App\Models\Attendance;
use App\Models\Announcement;
use App\Models\Grade;
use App\Models\User;
use App\Models\Year;
use App\Models\Registration;
use Illuminate\Support\Facades\Log;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Validator;

class MobileController extends Controller
{
    
    public function validateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ticket' => ['required', 'email', 'unique:applicants,email', 'ends_with:@gmail.com'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'failed'], 200);
            // return redirect()->back()->withErrors($validator)->withInput()->with('error', 'There was an error with your submission.');
         }
         return response()->json(['message' => 'success'], 200);
    }
    
    public function announcementmobile()
    {
        $latest = Announcement::get()->last();
        return response()->json($latest);
    }
    
    public function applicantStatus(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'ticket' => ['required', 'exists:applicants,_id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Ticket Number not found'], 200);
            // return redirect()->back()->withErrors($validator)->withInput()->with('error', 'There was an error with your submission.');
         }

        $find = Applicant::find($request->ticket);
        if($find->emailStat == 'Not Yet' || $find->emailStat == null)
        {
            $message = 'Your application is still on process.';
        }
        elseif($find->emailStat == 'emailed')
        {
            $message = 'Your application has been processed. Please check your email for the scheduled interview.';
        }
        
        
        return response()->json(['message' => $message], 200);
        // return redirect()->back()->with('message', $message);
    }

    // STUDENTSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
    public function indexstudents()
    {
        $students = Student::all();
        return response()->json(['data' => $students]);
    }

    public function singledatastudents($id)
    {
        // id = student_id
        $students = Student::find($id);
        $students->section_id = Section::find($students->section_id)->name;
        $students->strand_id = Strand::find($students->strand_id)->name;
        return response()->json($students);
    }

    public function editstudentspicture(Request $request)
    {
        Log::info('id='.$request->id);
        Log::info('image='.$request->image);
        
        // id = student_id
        $students = Student::find($request->id);

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        
        $imageString = '';
        for ($i = 0; $i < $length; $i++) {
            $imageString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $imageName = time().$imageString.'.jpg';

        $imagee = $request->image;
        $image = str_replace('data:image/jpg;base64,', '', $imagee);
        $image = str_replace(' ', '+', $image);
        \File::put('storage/images/'.$imageName, base64_decode($image));

        Log::info('image=storage/images/'.$imageName);

        $students->update(['image' => 'storage/images/'.$imageName ]);

        $response =[
            '_id' => $request->id,
            'image' => $imageName
        ];
        
        return response()->json($response);
    }

    public function editstudentsinfo($id, Request $request)
    {
        // id = student_id
        $students = Student::find($id);
        $students->update(['birthdate' => $request->birthdate,
                            'age' => $request->age,
                            'contact' => $request->contact,
                            'gender' => $request->gender,
                            'mothertongue' => $request->mothertongue,
                            'religion' => $request->religion,
                            'housestreet' => $request->housestreet,
                            'barangay' => $request->barangay,
                            'city' => $request->city,
                            'province' => $request->province,
                            'region' => $request->region]);
        return response()->json($students);
    }

    public function editstudentsguardian($id, Request $request)
    {
        // id = student_id
        $students = Student::find($id);
        $students->update(['mothername' => $request->mothername,
                            'mothercontact' => $request->mothercontact,
                            'fathername' => $request->fathername,
                            'fathercontact' => $request->fathercontact,
                            'guardianname' => $request->guardianname,
                            'guardiancontact' => $request->guardiancontact]);
        return response()->json($students);
    }

    public function schedulestudents($id)
    {
        // id = student_id
        $student = Student::find($id);
        $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->last();
        $studentssched= Student_Schedule::where('student_id', $studentz->id)->get()->last();

        if ($studentssched === null) {
            $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-2)->first();
            $studentssched= Student_Schedule::where('student_id', $studentz->id)->get()->last();    

            if ($studentssched === null) {
                $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-3)->first();
                $studentssched= Student_Schedule::where('student_id', $studentz->id)->get()->last();     
                
                if ($studentssched === null) {
                    $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-4)->first();
                    $studentssched= Student_Schedule::where('student_id', $studentz->id)->get()->last();     

                    if ($studentssched === null) {
                        $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-5)->first();
                        $studentssched= Student_Schedule::where('student_id', $studentz->id)->get()->last();                    
                    }                
                } 
            }        
        } 

        if ($studentssched === null) {
            $studentsschedule= Student_Schedule::where('student_id', $id)
                                            ->with('student')->with('section')->with('curriculum')->with('teacher')->with('semester')
                                            ->get()->sortBy('start');
        }  
        else{
            $studentsschedsem = $studentssched->semester_id;
            $studentsschedyear = $studentssched->year_id;
            $studentsschedule= Student_Schedule::where('student_id', $studentz->id)
                                            ->where('semester_id', $studentsschedsem)      
                                            ->where('year_id', $studentsschedyear) 
                                            ->with('student')->with('section')->with('curriculum')->with('teacher')->with('semester')
                                            ->get()->sortBy('start');
        }

        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();

        foreach($studentsschedule as $t){
            $response =[ 'schedID' => $t->id,
                'day' => $t->day,
                'sectionID' => $t->section->id,
                'sectionName' => $t->section->name,
                'curriculumID' => $t->curriculum->id,
                'curriculumName' => $t->curriculum->name,
                'teacherID' => $t->teacher->id,
                'teacherName' => collect([$t->teacher->fname, $t->teacher->mname, $t->teacher->lname])->implode(' '),
                'studentID' => $t->student->id,
                'room' => $t->room,
                'start' => $t->start,
                'end' => $t->end,
                'status' => $t->status,
                'yearID' => $t->year_id,
                'semesterID' => $t->semester_id ];
            if ($t->day == 'monday'){
                array_push($monday, $response); }
            if ($t->day == 'tuesday'){
                array_push($tuesday, $response); }
            if ($t->day == 'wednesday'){
                array_push($wednesday, $response); }
            if ($t->day == 'thursday'){
                array_push($thursday, $response); }
            if ($t->day == 'friday'){
                array_push($friday, $response); }
        }

        return response()->json(['monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 
                                                        'thursday' => $thursday, 'friday' => $friday]);
    }

    public function gradesstudents($id)
    {
        // id = student_id
        $student = Student::find($id);
        $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->last();
        $grades = Grade::where('student_id', $studentz->id)->get()->last();

        if ($grades === null) {
            $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-2)->first();
            $grades = Grade::where('student_id', $studentz->id)->get()->last();
            if ($grades === null) {
                $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-3)->first();
                $grades = Grade::where('student_id', $studentz->id)->get()->last();
                if ($grades === null) {
                    $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-4)->first();
                    $grades = Grade::where('student_id', $studentz->id)->get()->last();
                    if ($grades === null) {
                        $studentz = Student::where('lname',$student->lname)->where('fname',$student->fname)->where('mname',$student->mname)->get()->nth(-5)->first();
                        $grades = Grade::where('student_id', $studentz->id)->get()->last();
                    } 
                } 
            }  
        }  
        
        if ($grades === null) {
            $gradesss = Grade::where('student_id', $id)->with('student')->with('curriculum')->with('teacher')->get();
        } 
        else{
            $gradessem = $grades->semester_id;
            $gradesyear = $grades->year_id;
            $gradesss = Grade::where('student_id', $studentz->id)
                                ->where('semester_id', $gradessem)
                                ->where('year_id', $gradesyear)
                                ->with('student')->with('curriculum')->with('teacher')->get();
        }


        $gradess = array();

        foreach($gradesss as $g){
            $response =[
                'curriculumID' => $g->curriculum->id,
                'curriculumName' => $g->curriculum->name,
                'teacherID' => $g->teacher->id,
                'teacherName' => collect([$g->teacher->fname, $g->teacher->mname, $g->teacher->lname])->implode(' '),
                'studentID' => $g->student->id,
                'q1' => $g->q1,
                'q2' => $g->q2,
                'final' => $g->final,
                'remarks' => $g->remarks,
                'yearID' => $g->year_id,
                'semesterID' => $g->semester_id,
            ];
            array_push($gradess, $response); 
        }
        return response()->json(['data' => $gradess]);
    }
    
    public function studentschangepassword($id, Request $request)
    {
        // id = student_id
        $students = Student::find($id);
        $user = User::where('name', $students->fullname)->first();

        if (Hash::check($request->currentpassword, $user->password)) {
            $newHash = bcrypt($request->newpassword);
            $user->update(['password' => $newHash]);

            return response()->json(['message' => 'Password Changed Successfully'], 200);
        } 
        else {
            return response()->json(['message' => 'Current Password is Incorrect'], 401);
        }
    }


    // APPLICANTSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
    public function openregistration()
    {
        $reg = Registration::get()->first();

        if ($reg === null) {
            $response =['status' => "Close"];
        } 
        else{
            $currentDate = date('Y-m-d h:i:s');
            $currentDate = date('Y-m-d h:i:s', strtotime($currentDate));
            $startDate = date('Y-m-d h:i:s', strtotime($reg->start));
            $endDate = date('Y-m-d h:i:s', strtotime($reg->end));

            if ($currentDate >= $startDate && $currentDate <= $endDate && $reg->status == 'Open'){
                $stat = $reg->status;
                $response =['status' => "Open"];
            }
            else{
                $response =['status' => "Close"];
            }
        }
        
        return response()->json($response, 200);
    }
    
    public function indexapplicants()
    {
        $applicants = Applicant::all();
        return response()->json(['data' => $applicants]);
    }

    public function storeapplicants(Request $request)
    {

        Log::info($request->image);

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        
        $imageString = '';
        for ($i = 0; $i < $length; $i++) {
            $imageString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $repString = '';
        for ($i = 0; $i < $length; $i++) {
            $repString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $birthString = '';
        for ($i = 0; $i < $length; $i++) {
            $birthString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $imageName = time().$imageString.'.jpg';
        $cardName = time().$repString.'.jpg';
        $certName = time().$birthString.'.jpg';

        $imagee = $request->image;
        $image = str_replace('data:image/jpg;base64,', '', $imagee);
        $image = str_replace(' ', '+', $image);
        \File::put('storage/images/'. $imageName, base64_decode($image));

        $cardd = $request->reportcard;
        $card = str_replace('data:image/jpg;base64,', '', $cardd);
        $card = str_replace(' ', '+', $card);
        \File::put('storage/images/'. $cardName, base64_decode($card));

        $certt = $request->birthcertificate;
        $cert = str_replace('data:image/jpg;base64,', '', $certt);
        $cert = str_replace(' ', '+', $cert);
        \File::put('storage/images/'. $certName, base64_decode($cert));

        $applicant = new Applicant;

        $applicant->image  = 'storage/images/'.$imageName;
        $applicant->reportcard  = 'storage/images/'.$cardName;
        $applicant->birthcertificate  = 'storage/images/'.$certName;

        $applicant->studentstatus  = $request->studentstatus;
        $applicant->lrnstat  = $request->lrnstat;

        $applicant->gradetoenroll = "Grade 11";
        $applicant->presentgrade  = "Grade 10";

        $applicant->section  = $request->section;
        $applicant->yeartofinish  = $request->yeartofinish;
        $applicant->lastschoolattended  = $request->lastschoolattended;
        $applicant->lastschooladdress  = $request->lastschooladdress;
        $applicant->schoolid  = $request->schoolid;
        $applicant->schooltype  = $request->schooltype;

        $applicant->schooltoenroll  = "Signal Village National High School";
        $applicant->schooladdress  = "Ballecer St., Central Signal Village, Taguig City";
        $applicant->semester  = "First Semester";

        $applicant->firstchoice  = $request->firstchoice;
        $applicant->secondchoice  = $request->secondchoice;
        $applicant->thirdchoice  = $request->thirdchoice;

        if($request->firstchoice == "Accountancy, Business, Management" || 
            $request->firstchoice == "Science, Technology, Engineering, Mathematics" ||
            $request->firstchoice == "General Academic Track" ||
            $request->firstchoice == "Humanities and Social Sciences")
            {
                $applicant->track = "Academic";
            }
            else{
                $applicant->track = "Tech-Voc";
            }

        $applicant->status = "applicant";

        $applicant->englishgrade  = $request->englishgrade;
        $applicant->mathgrade  = $request->mathgrade;
        $applicant->sciencegrade  = $request->sciencegrade;
        $applicant->filipinograde  = $request->filipinograde;

        $applicant->lrn  = $request->lrn;
        $applicant->psanumber  = $request->psanumber;
        $applicant->email = strtolower($request->email);

        $applicant->fname = mb_strtoupper($request->fname, 'UTF-8');
        $applicant->mname = mb_strtoupper($request->mname, 'UTF-8');
        $applicant->lname = mb_strtoupper($request->lname, 'UTF-8');
        $applicant->extname = mb_strtoupper($request->extname, 'UTF-8');

        $applicant->birthdate  = $request->birthdate;
        $applicant->age  = $request->age;
        $applicant->gender  = $request->gender;
        $applicant->contact  = $request->contact;

        $applicant->mothertongue  = $request->mothertongue;
        $applicant->religion  = $request->religion;
        
        $applicant->indipeople  = $request->indipeople;
        $applicant->specialneeds  = $request->specialneeds;
        $applicant->assistivedevices  = $request->assistivedevices;
        
        $applicant->yesindipeople = $request->yesindipeople;
        $applicant->yesspecialneeds = $request->yesspecialneeds;
        $applicant->yesassistivedevices = $request->yesassistivedevices;

        $applicant->housestreet  = $request->housestreet;
        $applicant->barangay  = $request->barangay;
        $applicant->city  = $request->city;
        $applicant->province  = $request->province;
        $applicant->region  = $request->region;

        $applicant->fathername  = $request->fathername;
        $applicant->fathereducation  = $request->fathereducation;
        $applicant->fatheremployment  = $request->fatheremployment;
        $applicant->fatherworkstat  = $request->fatherworkstat;
        $applicant->fathercontact  = $request->fathercontact;

        $applicant->mothername  = $request->mothername;
        $applicant->mothereducation  = $request->mothereducation;
        $applicant->motheremployment  = $request->motheremployment;
        $applicant->motherworkstat  = $request->motherworkstat;
        $applicant->mothercontact  = $request->mothercontact;

        $applicant->guardianname  = $request->guardianname;
        $applicant->guardianeducation  = $request->guardianeducation;
        $applicant->guardianemployment  = $request->guardianemployment;
        $applicant->guardianworkstat  = $request->guardianworkstat;
        $applicant->guardiancontact  = $request->guardiancontact;
        
        $applicant->emailStat = 'Not Yet';
        
        $gwa = ((int)$request->mathgrade + (int)$request->englishgrade + (int)$request->filipinograde + (int)$request->sciencegrade) / 4;
        $applicant->gwa = (string)$gwa;
        
        $comma=",";
            if($applicant->extname == 'N/A'){
                $applicant->fullname = collect([strtoupper($applicant->lname).$comma, strtoupper($applicant->fname), strtoupper($applicant->mname)])->implode(' ');
            }
            else{
                $applicant->fullname = collect([strtoupper($applicant->lname).$comma, strtoupper($applicant->fname), strtoupper($applicant->mname), strtoupper($applicant->extname)])->implode(' ');
            }
            
        $reg = Registration::get()->first();
        $yearr = $reg->year_id;
        $applicant->year_id = $yearr;

        $applicant->save();

        //email
        $find = Applicant::where('email', $request->email)->get()->first();
        $year = Year::find(yearr);
        $mail_data = [
            'recipient' => 'joshualuis.tanap@gmail.com',
            'from' => 'shamwebandmobile@gmail.com',
            'subject' => 'Application Update',
            'body' => $year->year,
            'fullname' => $applicant->fullname,
            'ticket' => $find->id,
        ];

        \Mail::send('email-applicant', $mail_data, function($message) use($mail_data){
            $message->to($mail_data['recipient'])
            ->from($mail_data['from'])
            ->subject($mail_data['subject']);
        }); 

        $response =[
            'image' => $imageNamee,
            'reportcard' => $cardNamee,
            'birthcertificate' => $certNamee
            ];

        return response()->json($response, 200);
    }


    // TEACHERSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS
    public function indexteachers()
    {
        $teachers = Teacher::all();
        return response()->json(['data' => $teachers]);
    }

    public function singledatateachers($id)
    {
        // id = teacher_id
        $teachers = Teacher::find($id);
        return response()->json($teachers);
    }

    public function editteacherspicture(Request $request)
    {
        Log::info('id='.$request->id);
        Log::info('image='.$request->image);
        
        // id = teacher_id
        $teachers = Teacher::find($request->id);

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        
        $imageString = '';
        for ($i = 0; $i < $length; $i++) {
            $imageString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $imageName = time().$imageString.'.jpg';

        $imagee = $request->image;
        $image = str_replace('data:image/jpg;base64,', '', $imagee);
        $image = str_replace(' ', '+', $image);
        \File::put('storage/images/'.$imageName, base64_decode($image));

        Log::info('image=storage/images/'.$imageName);

        $teachers->update(['image' => 'storage/images/'.$imageName ]);

        $response =[
            '_id' => $request->id,
            'image' => $imageName
        ];
        
        return response()->json($response);
    }

    public function editteachersinfo($id, Request $request)
    {
        // id = teacher_id
        $teachers = Teacher::find($id);
        $teachers->update(['birthdate' => $request->birthdate,
                            'age' => $request->age,
                            'gender' => $request->gender,
                            'civilstatus' => $request->civilstatus,
                            'contact' => $request->contact,
                            'address' => $request->address]);
        return response()->json($teachers);
    }

    public function editteachersbackground($id, Request $request)
    {
        // id = teacher_id
        $teachers = Teacher::find($id);
        $teachers->update(['major' => $request->major,
                            'certificate' => $request->certificate,
                            'minor' => $request->minor,
                            'position' => $request->position,
                            'numberofteaching' => $request->numberofteaching,
                            'educattainment' => $request->educattainment]);
        return response()->json($teachers);
    }

    public function scheduleteachers($id)
    {
        // id = teacher_id
        $teacher = Teacher::find($id); 
        $teacherz = Teacher::where('lname',$teacher->lname)->where('fname',$teacher->fname)->where('mname',$teacher->mname)->get()->last();
        $teachersched= Teacher_Schedule::where('teacher_id', $teacherz->id)->get()->last();

        if ($teachersched === null) {
            $teacherz = Teacher::where('lname',$teacher->lname)->where('fname',$teacher->fname)->where('mname',$teacher->mname)->get()->nth(-2)->first();
            $teachersched= Teacher_Schedule::where('teacher_id', $teacherz->id)->get()->last();  

            if ($teachersched === null) {
                $teacherz = Teacher::where('lname',$teacher->lname)->where('fname',$teacher->fname)->where('mname',$teacher->mname)->get()->nth(-3)->first();
                $teachersched= Teacher_Schedule::where('teacher_id', $teacherz->id)->get()->last();    

                if ($teachersched === null) {
                    $teacherz = Teacher::where('lname',$teacher->lname)->where('fname',$teacher->fname)->where('mname',$teacher->mname)->get()->nth(-4)->first();
                    $teachersched= Teacher_Schedule::where('teacher_id', $teacherz->id)->get()->last();    

                    if ($teachersched === null) {
                        $teacherz = Teacher::where('lname',$teacher->lname)->where('fname',$teacher->fname)->where('mname',$teacher->mname)->get()->nth(-5)->first();
                        $teachersched= Teacher_Schedule::where('teacher_id', $teacherz->id)->get()->last();                        
                    } 
                }                     
            }            
        }

        if ($teachersched === null) {
            $teacherschedule= Teacher_Schedule::where('teacher_id', $id)     
                                            ->with('teacher')->with('section')->with('curriculum')
                                            ->get()->sortBy('start');                       
        } 
        else{
            $teacherschedsem = $teachersched->semester_id;
            $teacherschedyear = $teachersched->year_id;
            $teacherschedule= Teacher_Schedule::where('teacher_id', $teacherz->id)
                                            ->where('semester_id', $teacherschedsem)      
                                            ->where('year_id', $teacherschedyear)        
                                            ->with('teacher')->with('section')->with('curriculum')
                                            ->get()->sortBy('start');
        }
                            
        $monday = array();
        $tuesday = array();
        $wednesday = array();
        $thursday = array();
        $friday = array();

        foreach($teacherschedule as $t){
            $response =[
                'schedID' => $t->id,
                'day' => $t->day,
                'sectionID' => $t->section->id,
                'sectionName' => $t->section->name,
                'curriculumID' => $t->curriculum->id,
                'curriculumName' => $t->curriculum->name,
                'teacherID' => $t->teacher->id,
                'room' => $t->room,
                'start' => $t->start,
                'end' => $t->end,
                'yearID' => $t->year_id,
                'semesterID' => $t->semester_id,
            ];
            if ($t->day == 'monday'){
                array_push($monday, $response); 
            }
            if ($t->day == 'tuesday'){
                array_push($tuesday, $response); 
            }
            if ($t->day == 'wednesday'){
                array_push($wednesday, $response); 
            }
            if ($t->day == 'thursday'){
                array_push($thursday, $response); 
            }
            if ($t->day == 'friday'){
                array_push($friday, $response); 
            }
        }

        return response()->json(['monday' => $monday, 'tuesday' => $tuesday, 'wednesday' => $wednesday, 
                                                        'thursday' => $thursday, 'friday' => $friday]);
    }

    public function teachersadvisee($id)
    {
        // id = teacher_id
        $studentz = array();

        $section = \App\Models\Section::where('teacher_id', $id)->get();
        foreach($section as $s){
            $students = Student::where('section_id', $s->id)->orderBy('lname')->get()->sortBy('lname');
            foreach($students as $st){
                array_push($studentz, $st); 
            }
        }
        
        return response()->json(['data' => $studentz]);
    }
    
    public function teacherschangepassword($id, Request $request)
    {
        // id = teacher_id
        $teachers = Teacher::find($id);
        $user = User::where('name', $teachers->fullname)->first();
        
        if (Hash::check($request->currentpassword, $user->password)) {
            $newHash = bcrypt($request->newpassword);
            $user->update(['password' => $newHash]);

            return response()->json(['message' => 'Password Changed Successfully'], 200);
        } 
        else {
            return response()->json(['message' => 'Current Password is Incorrect'], 401);
        }
    }


    // ATTENDANCEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
    public function attendancehomepage($id)
    {
        // id = teacher_id
        $array = array();
        $arrayy = array_unique($array);
        $teacherschedule= Teacher_Curriculum::where('teacher_id', $id)->with('section')->with('curriculum')
                                            ->with('teacher')->get()->sortBy('curriculum_id');
        foreach($teacherschedule as $t){
            $response =[
                'schedID' => $t->id,
                'sectionID' => $t->section->id,
                'sectionName' => $t->section->name,
                'curriculumID' => $t->curriculum->id,
                'curriculumName' => $t->curriculum->name,
                'teacherID' => $t->teacher->id,
                'yearID' => $t->year_id,
                'semesterID' => $t->semester_id,
            ];

            array_push($array, $response);
        }
        return response()->json(['data' => $array]);
    }

    public function attendance($id)
    {
        // id = section_id
        $students = Student::where('section_id', $id)->orderBy('lname')->get();
        return response()->json(['data' => $students]);
    }

    public function storeattendance(Request $request)
    {
        $attendance = Attendance::create($request->all());
        return response()->json($attendance, 200);
    }


}