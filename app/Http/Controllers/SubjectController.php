<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Student;
use App\Models\Curriculum;
use App\Models\Teacher_Schedule;
use App\Models\Teacher_Curriculum;
use App\Models\Student_Curriculum;
use App\Models\Student_Schedule;
use App\Models\Semester;
use App\Models\Year;
use App\Models\Grade;
use View;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;
use \stdClass;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function sem(Request $request)
     {

         Session::put('semester', $request->semester_id);
 
         return Redirect::route('subjects.index', [$request->section_id]);

     }

    public function index($id)
    {
        Session::forget('mon_error');Session::forget('tue_error');Session::forget('wed_error');Session::forget('thu_error');Session::forget('fri_error');
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump("DEFAULT YUNG YEAR MO TANAGA");
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }
        
        // dd(Session::all());

        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }
        
        $section = Section::find($id);
        $schedules = Teacher_Schedule::with('section')->with('teacher')->with('curriculum')->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        $curriculums = Curriculum::pluck('name', '_id');
        $teachers = Teacher::where('year_id', $taon)->orderBy('lname')->pluck('fullname', '_id');
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $sem = Semester::find($semester);
        $year = Year::find($taon);


        return View::make('admin.student.viewSchedule', compact('section', 'curriculums', 'days', 'teachers', 'schedules', 'sem', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // dd("nice");
        $section = Section::find($id);
        $curriculums = Curriculum::pluck('name', '_id');
        $teachers = Teacher::where('year_id', $taon)->orderBy('lname')->pluck('fullname', '_id');
        // dump($day);
        
        return View::make('admin.schedule.create', compact('section', 'curriculums', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        
        if(Session::missing('semester')){
            $default = Semester::all()->first();
            $semester = $default->id;
        }
        else{
            $semester = Session::get('semester');
        }

        // dd("HEY");
        $section = Section::find($id);
        $schedules = Teacher_Schedule::with('section')->with('teacher')->with('curriculum')->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        if($section->strand->code == 'ABM'){
            $abmCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'ABM');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($abmCurr);
        }
        if($section->strand->code == 'GAS'){
            $gasCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'GAS');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($gasCurr);
        }
        if($section->strand->code == 'HUMSS'){
            $humssCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'HUMSS');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($humssCurr);
        }
        if($section->strand->code == 'STEM'){
            $stemCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'STEM');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($stemCurr);
        }
        if($section->strand->code == 'CARE'){
            $careCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'CARE');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($careCurr);
        }
        if($section->strand->code == 'EIM'){
            $eimCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'EIM');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($eimCurr);
        }
        if($section->strand->code == 'HE'){
            $heCurr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'HE');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($heCurr);
        }
        if($section->strand->code == 'ICT'){
            $icturr = Curriculum::with('strand')->whereHas('strand', function ($query) {$query->where('code', 'ICT');})->pluck('name', '_id');
            $other = Curriculum::with('strand')->where('level', '!=', 'SPECIALIZED')->pluck('name', '_id');
            $curriculums = $other->merge($icturr);
        }

        $teachers = Teacher::where('year_id', $taon)->orderBy('lname')->pluck('fullname', '_id');

        // dump($schedules);
        if(Session::has('schedules'))
        {
            $schedules = Session::get('schedules');
        }
    
        // dd($schedules);
        $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $sem = Semester::find($semester);
        $year = Year::find($taon);

        return View::make('admin.schedule.edit', compact( 
            'section', 'curriculums', 'days', 'teachers', 'schedules', 'sem', 'year'
        ));

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
        // dd("BALIK MO");
        Session::forget('mon_error');Session::forget('tue_error');Session::forget('wed_error');Session::forget('thu_error');Session::forget('fri_error');
        Session::forget('schedules');

        if(Session::missing('schoolyear')){$default = Year::all()->last();$taon = $default->id;}
        else{$taon = Session::get('schoolyear');}

        if(Session::missing('semester')){$default = Semester::all()->first();$semester = $default->id;}
        else{$semester = Session::get('semester');}

        $sched_ids = Teacher_Schedule::where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        $stud_ids = Student_Schedule::where('section_id', $id)->where('status', 'Regular')->where('year_id', $taon)->where('semester_id', $semester)->get();
        $grade_ids = Grade::where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
        
        $toUpdate = array();

        if($request->mon_curriculums != null || $request->tue_curriculums != null || $request->wed_curriculums != null || $request->thu_curriculums != null || $request->fri_curriculums != null ){
            
        // VALIDATE FOR CONFILICTING SCHED FOR TEACHER AND REQUESTED TIME
            // MONDAY
            if($request->mon_curriculums != null){
                $mon_curriculums = $request->mon_curriculums;
                $mon_teachers = $request->mon_teachers;
                $mon_room = $request->mon_room;
                $mon_start = $request->mon_start;
                $mon_end = $request->mon_end;
                $mon_max = count($request->mon_curriculums);
                if (count($mon_start) !== count(array_unique($mon_start))) {Session::put('mon_error', 'Conflicting Schedule in Monday. Please check inputted time before Saving');}
                if (count($mon_end) !== count(array_unique($mon_end))) {Session::put('mon_error', 'Conflicting Schedule in Monday. Please check inputted time before Saving');}
                for($i=0; $i <= $mon_max-1; $i ++){
                    $mon_scheds[$mon_start[$i]] = $mon_end[$i]; 
                    foreach ($mon_scheds as $key1 => $value1) {
                        foreach ($mon_scheds as $key2 => $value2) {             
                        if ($key1 != $key2 && $value1 != $value2) { // avoid comparing the same key
                            if($key1 >= $key2 && $key1 <= $value2 || $value1 >= $key2 && $value1 <= $value2)
                            {Session::put('mon_error', 'Conflicting Schedule in Monday. Please check inputted time before Saving');}}}}
                    $find_sched = Teacher_Schedule::where('day', 'monday')->where('section_id', '!=', $id)->where('teacher_id', $mon_teachers[$i])->where('year_id', $taon)->where('semester_id', $semester)->get();
                    foreach($find_sched as $find){
                        $rstart = strtotime($mon_start[$i]);
                        $rend = strtotime($mon_end[$i]);
                        $tstart = strtotime($find->start);
                        $tend = strtotime($find->end);
                        if ($rstart >= $tstart && $rstart <= $tend || $rend >= $tstart && $rend <= $tend) {
                            Session::put('mon_error', 'Conflicting Schedule in Monday. Please check other Sections.');}}
                        }   
            }
            // TUESDAY
            if($request->tue_curriculums != null){
                $tue_curriculums = $request->tue_curriculums;
                $tue_teachers = $request->tue_teachers;
                $tue_room = $request->tue_room;
                $tue_start = $request->tue_start;
                $tue_end = $request->tue_end;
                $tue_max = count($request->tue_curriculums);
                if (count($tue_start) !== count(array_unique($tue_start))) {Session::put('tue_error', 'Conflicting Schedule in Tuesday. Please check inputted time before Saving');}
                if (count($tue_end) !== count(array_unique($tue_end))) {Session::put('tue_error', 'Conflicting Schedule in Tuesday. Please check inputted time before Saving');}
                for($i=0; $i <= $tue_max-1; $i ++){
                    $tue_scheds[$tue_start[$i]] = $tue_end[$i]; 
                    foreach ($tue_scheds as $key1 => $value1) {
                        foreach ($tue_scheds as $key2 => $value2) {             
                          if ($key1 != $key2 && $value1 != $value2) { // avoid comparing the same key
                            if($key1 >= $key2 && $key1 <= $value2 || $value1 >= $key2 && $value1 <= $value2)
                            {Session::put('tue_error', 'Conflicting Schedule in Tuesday. Please check inputted time before Saving');}}}}
                    $find_sched = Teacher_Schedule::where('day', 'tuesday')->where('section_id', '!=', $id)->where('teacher_id', $tue_teachers[$i])->where('year_id', $taon)->where('semester_id', $semester)->get();
                    foreach($find_sched as $find){
                        $rstart = strtotime($tue_start[$i]);
                        $rend = strtotime($tue_end[$i]);
                        $tstart = strtotime($find->start);
                        $tend = strtotime($find->end);
                        if ($rstart >= $tstart && $rstart <= $tend || $rend >= $tstart && $rend <= $tend) {
                            Session::put('tue_error', 'Conflicting Schedule in Tuesday. Please check other Sections.');}}}   
            }
            // WEDNESDAY
            if($request->wed_curriculums != null){
                $wed_curriculums = $request->wed_curriculums;
                $wed_teachers = $request->wed_teachers;
                $wed_room = $request->wed_room;
                $wed_start = $request->wed_start;
                $wed_end = $request->wed_end;
                $wed_max = count($request->wed_curriculums);
                if (count($wed_start) !== count(array_unique($wed_start))) {Session::put('wed_error', 'Conflicting Schedule in Wednesday. Please check inputted time before Saving');}
                if (count($wed_end) !== count(array_unique($wed_end))) {Session::put('wed_error', 'Conflicting Schedule in Wednesday. Please check inputted time before Saving');}
                for($i=0; $i <= $wed_max-1; $i ++){
                    $wed_scheds[$wed_start[$i]] = $wed_end[$i]; 
                    foreach ($wed_scheds as $key1 => $value1) {
                        foreach ($wed_scheds as $key2 => $value2) {             
                          if ($key1 != $key2 && $value1 != $value2) { // avoid comparing the same key
                            if($key1 >= $key2 && $key1 <= $value2 || $value1 >= $key2 && $value1 <= $value2)
                            {Session::put('wed_error', 'Conflicting Schedule in Wednesday. Please check inputted time before Saving');}}}}
                    $find_sched = Teacher_Schedule::where('day', 'wednesday')->where('section_id', '!=', $id)->where('teacher_id', $wed_teachers[$i])->where('year_id', $taon)->where('semester_id', $semester)->get();
                    foreach($find_sched as $find){
                        $rstart = strtotime($wed_start[$i]);
                        $rend = strtotime($wed_end[$i]);
                        $tstart = strtotime($find->start);
                        $tend = strtotime($find->end);
                        if ($rstart >= $tstart && $rstart <= $tend || $rend >= $tstart && $rend <= $tend) {
                            Session::put('wed_error', 'Conflicting Schedule in Wednesday. Please check other Sections.');}}}   
            }
            // THURSDAY
            if($request->thu_curriculums != null){
                $thu_curriculums = $request->thu_curriculums;
                $thu_teachers = $request->thu_teachers;
                $thu_room = $request->thu_room;
                $thu_start = $request->thu_start;
                $thu_end = $request->thu_end;
                $thu_max = count($request->thu_curriculums);
                if (count($thu_start) !== count(array_unique($thu_start))) {Session::put('thu_error', 'Conflicting Schedule in Thursday. Please check inputted time before Saving');}
                if (count($thu_end) !== count(array_unique($thu_end))) {Session::put('thu_error', 'Conflicting Schedule in Thursday. Please check inputted time before Saving');}
                for($i=0; $i <= $thu_max-1; $i ++){
                    $thu_scheds[$thu_start[$i]] = $thu_end[$i]; 
                    foreach ($thu_scheds as $key1 => $value1) {
                        foreach ($thu_scheds as $key2 => $value2) {             
                          if ($key1 != $key2 && $value1 != $value2) { // avoid comparing the same key
                            if($key1 >= $key2 && $key1 <= $value2 || $value1 >= $key2 && $value1 <= $value2)
                            {Session::put('thu_error', 'Conflicting Schedule in Thursday. Please check inputted time before Saving');}}}}
                    $find_sched = Teacher_Schedule::where('day', 'thursday')->where('section_id', '!=', $id)->where('teacher_id', $thu_teachers[$i])->where('year_id', $taon)->where('semester_id', $semester)->get();
                    foreach($find_sched as $find){
                        $rstart = strtotime($thu_start[$i]);
                        $rend = strtotime($thu_end[$i]);
                        $tstart = strtotime($find->start);
                        $tend = strtotime($find->end);
                        if ($rstart >= $tstart && $rstart <= $tend || $rend >= $tstart && $rend <= $tend) {
                            Session::put('thu_error', 'Conflicting Schedule in Thursday. Please check other Sections.');}}}   
            }
            // FRIDAY
            if($request->fri_curriculums != null){
                $fri_curriculums = $request->fri_curriculums;
                $fri_teachers = $request->fri_teachers;
                $fri_room = $request->fri_room;
                $fri_start = $request->fri_start;
                $fri_end = $request->fri_end;
                $fri_max = count($request->fri_curriculums);
                if (count($fri_start) !== count(array_unique($fri_start))) {Session::put('fri_error', 'Conflicting Schedule in Friday. Please check inputted time before Saving');}
                if (count($fri_end) !== count(array_unique($fri_end))) {Session::put('fri_error', 'Conflicting Schedule in Friday. Please check inputted time before Saving');}
                for($i=0; $i <= $fri_max-1; $i ++){
                    $fri_scheds[$fri_start[$i]] = $fri_end[$i]; 
                    foreach ($fri_scheds as $key1 => $value1) {
                        foreach ($fri_scheds as $key2 => $value2) {             
                          if ($key1 != $key2 && $value1 != $value2) { // avoid comparing the same key
                            if($key1 >= $key2 && $key1 <= $value2 || $value1 >= $key2 && $value1 <= $value2)
                            {Session::put('fri_error', 'Conflicting Schedule in Friday. Please check inputted time before Saving');}}}}
                    $find_sched = Teacher_Schedule::where('day', 'friday')->where('section_id', '!=', $id)->where('teacher_id', $fri_teachers[$i])->where('year_id', $taon)->where('semester_id', $semester)->get();
                    foreach($find_sched as $find){
                        $rstart = strtotime($fri_start[$i]);
                        $rend = strtotime($fri_end[$i]);
                        $tstart = strtotime($find->start);
                        $tend = strtotime($find->end);
                        if ($rstart >= $tstart && $rstart <= $tend || $rend >= $tstart && $rend <= $tend) {
                            Session::put('fri_error', 'Conflicting Schedule in Friday. Please check other Sections.');}}}   
            }
            // dd(Session::get('tue_error'));
            if(Session::has('mon_error') || Session::has('tue_error') || Session::has('wed_error') || Session::has('thu_error') || Session::has('fri_error'))
            {
                $data = new stdClass();
                $count = 0;
                if (isset($mon_max)) {
                    for ($j = 0; $j <= $mon_max - 1; $j++) {
                        $mon_obj = new stdClass();
                        $mon_obj->curriculum_id = $request->mon_curriculums[$j];
                        $mon_obj->teacher_id = $request->mon_teachers[$j];
                        $mon_obj->day = 'monday';
                        $mon_obj->room = $request->mon_room[$j];
                        $mon_obj->start = $request->mon_start[$j];
                        $mon_obj->end = $request->mon_end[$j];
                        $data->{$count} = $mon_obj;
                        $count++;
                    }
                }

                if (isset($tue_max)) {
                    for ($j = 0; $j <= $tue_max - 1; $j++) {
                        $tue_obj = new stdClass();
                        $tue_obj->curriculum_id = $request->tue_curriculums[$j];
                        $tue_obj->teacher_id = $request->tue_teachers[$j];
                        $tue_obj->day = 'tuesday';
                        $tue_obj->room = $request->tue_room[$j];
                        $tue_obj->start = $request->tue_start[$j];
                        $tue_obj->end = $request->tue_end[$j];
                        $data->{$count} = $tue_obj;
                        $count++;
                    }
                }

                if (isset($wed_max)) {
                    for ($j = 0; $j <= $wed_max - 1; $j++) {
                        $wed_obj = new stdClass();
                        $wed_obj->curriculum_id = $request->wed_curriculums[$j];
                        $wed_obj->teacher_id = $request->wed_teachers[$j];
                        $wed_obj->day = 'wednesday';
                        $wed_obj->room = $request->wed_room[$j];
                        $wed_obj->start = $request->wed_start[$j];
                        $wed_obj->end = $request->wed_end[$j];
                        $data->{$count} = $wed_obj;
                        $count++;
                    }
                }

                if (isset($thu_max)) {
                    for ($j = 0; $j <= $thu_max - 1; $j++) {
                        $thu_obj = new stdClass();
                        $thu_obj->curriculum_id = $request->thu_curriculums[$j];
                        $thu_obj->teacher_id = $request->thu_teachers[$j];
                        $thu_obj->day = 'thursday';
                        $thu_obj->room = $request->thu_room[$j];
                        $thu_obj->start = $request->thu_start[$j];
                        $thu_obj->end = $request->thu_end[$j];
                        $data->{$count} = $thu_obj;
                        $count++;
                    }
                }

                if (isset($fri_max)) {
                    for ($j = 0; $j <= $fri_max - 1; $j++) {
                        $fri_obj = new stdClass();
                        $fri_obj->curriculum_id = $request->fri_curriculums[$j];
                        $fri_obj->teacher_id = $request->fri_teachers[$j];
                        $fri_obj->day = 'friday';
                        $fri_obj->room = $request->fri_room[$j];
                        $fri_obj->start = $request->fri_start[$j];
                        $fri_obj->end = $request->fri_end[$j];
                        $data->{$count} = $fri_obj;
                        $count++;
                    }
                }
                Session::put('schedules', $data);
                // dd($data);
                return $this->edit($id);
            }
            else{

                // dd("STOPER");
                // DELETE SUBJECT OF TEACHER
                $curr_ids = Teacher_Curriculum::all()->where('year_id', $taon)->where('semester_id', $semester);
                $Tid = array();
                foreach($sched_ids as $scheds)
                {
                    array_push($Tid, $scheds->teacher_id);
                }
                $final = array_unique($Tid);
                foreach($curr_ids as $curs)
                {
                    foreach($final as $one){
                    if($one == $curs->teacher_id){
                            $tobe = Teacher_Curriculum::where('teacher_id', $one)->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            foreach($tobe as $delete){
                                $delete->delete();
                            }
                    }
                    }  
                }

                // DELETE SUBJECT OF STUDENT
                $studcurrs = Student_Curriculum::all()->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester);
                // dd($studcurrs);
                $Sid = array();
                
                foreach($studcurrs as $scheds)
                {
                    array_push($Sid, $scheds->student_id);
                }
                $studfinal = array_unique($Sid);

                foreach($studcurrs as $curs)
                {
                    foreach($studfinal as $one){
                        if($one == $curs->student_id){
                            $tobe = Student_Curriculum::where('student_id', $one)->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            foreach($tobe as $delete){
                                $delete->delete();
                            }
                        }
                    }  
                }

                // Delete all schedule of section
                foreach($sched_ids as $id){   
                    $delete = Teacher_Schedule::find($id->id);
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
                //                      Monday
                //-------------------------------------------------
                if($request->mon_curriculums != null){
                    $mon_curriculums = $request->mon_curriculums;
                    $mon_teachers = $request->mon_teachers;
                    $mon_room = $request->mon_room;
                    $mon_start = $request->mon_start;
                    $mon_end = $request->mon_end;
                    foreach($mon_curriculums as $index => $data){foreach ($mon_curriculums as $i => $value) {if ($value === null){$mon_curriculums[$i] = "N/A";}}}
                    foreach($mon_teachers as $index => $data){foreach ($mon_teachers as $i => $value) {if ($value === null){$mon_teachers[$i] = "N/A";}}}
                    foreach($mon_room as $index => $data){foreach ($mon_room as $i => $value) {if ($value === null){$mon_room[$i] = "N/A";}}}
                    foreach($mon_start as $index => $data){foreach ($mon_start as $i => $value) {if ($value === null){$mon_start[$i] = "N/A";}}}
                    foreach($mon_end as $index => $data){foreach ($mon_end as $i => $value) {if ($value === null){$mon_end[$i] = "N/A";}}}
                    $mon_max = count($mon_curriculums);
                    for($i=0; $i<=$mon_max-1; $i++){
                        if($mon_curriculums[$i] != "N/A" && $mon_teachers[$i] != "N/A" && $mon_room[$i] != "N/A" && $mon_start[$i] != "N/A" && $mon_end[$i] != "N/A"){
                            $schedule = new Teacher_Schedule;
                            $schedule->day = "monday";
                            $schedule->section_id = $request->section_id;
                            $schedule->curriculum_id = $mon_curriculums[$i];
                            $schedule->teacher_id = $mon_teachers[$i];
                            $schedule->room = $mon_room[$i];
                            $schedule->start = $mon_start[$i];
                            $schedule->end = $mon_end[$i];
                            $schedule->year_id = $taon;
                            $schedule->semester_id = $semester;
                            $schedule->save();
                            
                            // ADD SUBJECTS WITH NO DUPLICATION
                            $teacher_sub = Teacher_Curriculum::where('section_id', $schedule->section_id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            if(count($teacher_sub) == 0){
                                $new = new Teacher_Curriculum;
                                $new->teacher_id = $schedule->teacher_id;
                                $new->section_id = $schedule->section_id;
                                $new->curriculum_id = $schedule->curriculum_id;
                                $new->year_id = $taon;
                                $new->semester_id = $semester;
                                $new->save();
                            }
                            else{
                                foreach($teacher_sub as $sub){
                                    if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                    {}
                                    elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                        $new = new Teacher_Curriculum;
                                        $new->teacher_id = $schedule->teacher_id;
                                        $new->section_id = $schedule->section_id;
                                        $new->curriculum_id = $schedule->curriculum_id;
                                        $new->year_id = $taon;
                                        $new->semester_id = $semester;
                                        $new->save();
                                    }
                                }
                            }
                            // FOR STUDENTS
                            $students = Student::where('section_id', $request->section_id)->where('status', 'Regular')->where('year_id', $taon)->get();
                            // dd($students);
                            foreach($students as $student){ 
                                $studSched = new Student_Schedule;
                                $studSched->curriculum_id = $schedule->curriculum_id;
                                $studSched->student_id = $student->id;
                                $studSched->section_id = $request->section_id;
                                $studSched->teacher_id = $schedule->teacher_id;
                                $studSched->room = $schedule->room;
                                $studSched->day = "monday";
                                $studSched->start = $schedule->start;
                                $studSched->end = $schedule->end;
                                $studSched->status = "Regular";
                                $studSched->year_id = $taon;
                                $studSched->semester_id = $semester;
                                $studSched->save();

                                $stud_sub = Student_Curriculum::where('student_id', $student->id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('status', 'Regular')->where('year_id', $taon)->where('semester_id', $semester)->get();
                                // dump($stud_sub);
                                if(count($stud_sub) == 0){
                                    // dump("ZERO");
                                    $bago = new Student_Curriculum;
                                    $bago->student_id = $student->id;
                                    $bago->teacher_id = $schedule->teacher_id;
                                    $bago->section_id = $schedule->section_id;
                                    $bago->curriculum_id = $schedule->curriculum_id;
                                    $bago->status = "Regular";
                                    $bago->year_id = $taon;
                                    $bago->semester_id = $semester;
                                    $bago->save();
                                }
                                else{ 
                                    // dump("MULTIPLE");
                                    foreach($stud_sub as $sub){
                                        if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                        {}
                                        elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                            $bago = new Student_Curriculum;
                                            $bago->student_id = $student->id;
                                            $bago->teacher_id = $schedule->teacher_id;
                                            $bago->section_id = $schedule->section_id;
                                            $bago->curriculum_id = $schedule->curriculum_id;
                                            $bago->status = "Regular";
                                            $bago->year_id = $taon;
                                            $bago->semester_id = $semester;
                                            $bago->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                // ------------------------------------------------- 
                //                       Tuesday
                // -------------------------------------------------
                if($request->tue_curriculums != null){
                    $tue_curriculums = $request->tue_curriculums;
                    $tue_teachers = $request->tue_teachers;
                    $tue_room = $request->tue_room;
                    $tue_start = $request->tue_start;
                    $tue_end = $request->tue_end;
                    foreach($tue_curriculums as $index => $data){foreach ($tue_curriculums as $i => $value) {if ($value === null){$tue_curriculums[$i] = "N/A";}}}
                    foreach($tue_teachers as $index => $data){foreach ($tue_teachers as $i => $value) {if ($value === null){$tue_teachers[$i] = "N/A";}}}
                    foreach($tue_room as $index => $data){foreach ($tue_room as $i => $value) {if ($value === null){$tue_room[$i] = "N/A";}}}
                    foreach($tue_start as $index => $data){foreach ($tue_start as $i => $value) {if ($value === null){$tue_start[$i] = "N/A";}}}
                    foreach($tue_end as $index => $data){foreach ($tue_end as $i => $value) {if ($value === null){$tue_end[$i] = "N/A";}}}
                    $tue_max = count($tue_curriculums);
                    for($i=0; $i<=$tue_max-1; $i++){
                        if($tue_curriculums[$i] != "N/A" && $tue_teachers[$i] != "N/A" && $tue_room[$i] != "N/A" && $tue_start[$i] != "N/A" && $tue_end[$i] != "N/A"){
                            $schedule = new Teacher_Schedule;
                            $schedule->day = "tuesday";
                            $schedule->section_id = $request->section_id;
                            $schedule->curriculum_id = $tue_curriculums[$i];
                            $schedule->teacher_id = $tue_teachers[$i];
                            $schedule->room = $tue_room[$i];
                            $schedule->start = $tue_start[$i];
                            $schedule->end = $tue_end[$i];
                            $schedule->year_id = $taon;
                            $schedule->semester_id = $semester;
                            $schedule->save();
                            
                            // ADD SUBJECTS WITH NO DUPLICATION
                            $teacher_sub = Teacher_Curriculum::where('section_id', $schedule->section_id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            if(count($teacher_sub) == 0){
                                $new = new Teacher_Curriculum;
                                $new->teacher_id = $schedule->teacher_id;
                                $new->section_id = $schedule->section_id;
                                $new->curriculum_id = $schedule->curriculum_id;
                                $new->year_id = $taon;
                                $new->semester_id = $semester;
                                $new->save();
                            }
                            else{
                                foreach($teacher_sub as $sub){
                                    if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                    {}
                                    elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                        $new = new Teacher_Curriculum;
                                        $new->teacher_id = $schedule->teacher_id;
                                        $new->section_id = $schedule->section_id;
                                        $new->curriculum_id = $schedule->curriculum_id;
                                        $new->year_id = $taon;
                                        $new->semester_id = $semester;
                                        $new->save();
                                    }
                                }
                            }
                            // FOR STUDENTS
                            $students = Student::where('section_id', $schedule->section_id)->where('section_id', $request->section_id)->where('status', 'Regular')->where('year_id', $taon)->get();
                            foreach($students as $student){ 
                                $studSched = new Student_Schedule;
                                $studSched->curriculum_id = $schedule->curriculum_id;
                                $studSched->student_id = $student->id;
                                $studSched->section_id = $request->section_id;
                                $studSched->teacher_id = $schedule->teacher_id;
                                $studSched->room = $schedule->room;
                                $studSched->day = "tuesday";
                                $studSched->start = $schedule->start;
                                $studSched->end = $schedule->end;
                                $studSched->status = "Regular";
                                $studSched->year_id = $taon;
                                $studSched->semester_id = $semester;
                                $studSched->save();
                
                                $stud_sub = Student_Curriculum::where('student_id', $student->id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('status', 'Regular')->where('year_id', $taon)->where('semester_id', $semester)->get();
                                // dd($stud_sub);
                                if(count($stud_sub) == 0){
                                    $bago = new Student_Curriculum;
                                    $bago->student_id = $student->id;
                                    $bago->teacher_id = $schedule->teacher_id;
                                    $bago->section_id = $schedule->section_id;
                                    $bago->curriculum_id = $schedule->curriculum_id;
                                    $bago->status = "Regular";
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
                                            $bago->student_id = $student->id;
                                            $bago->teacher_id = $schedule->teacher_id;
                                            $bago->section_id = $schedule->section_id;
                                            $bago->curriculum_id = $schedule->curriculum_id;
                                            $bago->status = "Regular";
                                            $bago->year_id = $taon;
                                            $bago->semester_id = $semester;
                                            $bago->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                //------------------------------------------------- 
                //                    Wednesday
                //-------------------------------------------------
                if($request->wed_curriculums != null){
                    $wed_curriculums = $request->wed_curriculums;
                    $wed_teachers = $request->wed_teachers;
                    $wed_room = $request->wed_room;
                    $wed_start = $request->wed_start;
                    $wed_end = $request->wed_end;
                    foreach($wed_curriculums as $index => $data){foreach ($wed_curriculums as $i => $value) {if ($value === null){$wed_curriculums[$i] = "N/A";}}}
                    foreach($wed_teachers as $index => $data){foreach ($wed_teachers as $i => $value) {if ($value === null){$wed_teachers[$i] = "N/A";}}}
                    foreach($wed_room as $index => $data){foreach ($wed_room as $i => $value) {if ($value === null){$wed_room[$i] = "N/A";}}}
                    foreach($wed_start as $index => $data){foreach ($wed_start as $i => $value) {if ($value === null){$wed_start[$i] = "N/A";}}}
                    foreach($wed_end as $index => $data){foreach ($wed_end as $i => $value) {if ($value === null){$wed_end[$i] = "N/A";}}}
                    $wed_max = count($wed_curriculums);
                    for($i=0; $i<=$wed_max-1; $i++){
                        if($wed_curriculums[$i] != "N/A" && $wed_teachers[$i] != "N/A" && $wed_room[$i] != "N/A" && $wed_start[$i] != "N/A" && $wed_end[$i] != "N/A"){
                            $schedule = new Teacher_Schedule;
                            $schedule->day = "wednesday";
                            $schedule->section_id = $request->section_id;
                            $schedule->curriculum_id = $wed_curriculums[$i];
                            $schedule->teacher_id = $wed_teachers[$i];
                            $schedule->room = $wed_room[$i];
                            $schedule->start = $wed_start[$i];
                            $schedule->end = $wed_end[$i];
                            $schedule->year_id = $taon;
                            $schedule->semester_id = $semester;
                            $schedule->save();
                            
                            // ADD SUBJECTS WITH NO DUPLICATION
                            $teacher_sub = Teacher_Curriculum::where('section_id', $schedule->section_id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            if(count($teacher_sub) == 0){
                                $new = new Teacher_Curriculum;
                                $new->teacher_id = $schedule->teacher_id;
                                $new->section_id = $schedule->section_id;
                                $new->curriculum_id = $schedule->curriculum_id;
                                $new->year_id = $taon;
                                $new->semester_id = $semester;
                                $new->save();
                            }
                            else{
                                foreach($teacher_sub as $sub){
                                    if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                    {}
                                    elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                        $new = new Teacher_Curriculum;
                                        $new->teacher_id = $schedule->teacher_id;
                                        $new->section_id = $schedule->section_id;
                                        $new->curriculum_id = $schedule->curriculum_id;
                                        $new->year_id = $taon;
                                        $new->semester_id = $semester;
                                        $new->save();
                                    }
                                }
                            }
                            // FOR STUDENTS
                            $students = Student::where('section_id', $request->section_id)->where('status', 'Regular')->where('year_id', $taon)->get();
                            foreach($students as $student){ 
                                $studSched = new Student_Schedule;
                                $studSched->curriculum_id = $schedule->curriculum_id;
                                $studSched->student_id = $student->id;
                                $studSched->section_id = $request->section_id;
                                $studSched->teacher_id = $schedule->teacher_id;
                                $studSched->room = $schedule->room;
                                $studSched->day = "wednesday";
                                $studSched->start = $schedule->start;
                                $studSched->end = $schedule->end;
                                $studSched->status = "Regular";
                                $studSched->year_id = $taon;
                                $studSched->semester_id = $semester;
                                $studSched->save();
                
                                $stud_sub = Student_Curriculum::where('student_id', $student->id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('status', 'Regular')->where('year_id', $taon)->where('semester_id', $semester)->get();
                                if(count($stud_sub) == 0){
                                    $bago = new Student_Curriculum;
                                    $bago->student_id = $student->id;
                                    $bago->teacher_id = $schedule->teacher_id;
                                    $bago->section_id = $schedule->section_id;
                                    $bago->curriculum_id = $schedule->curriculum_id;
                                    $bago->status = "Regular";
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
                                            $bago->student_id = $student->id;
                                            $bago->teacher_id = $schedule->teacher_id;
                                            $bago->section_id = $schedule->section_id;
                                            $bago->curriculum_id = $schedule->curriculum_id;
                                            $bago->status = "Regular";
                                            $bago->year_id = $taon;
                                            $bago->semester_id = $semester;
                                            $bago->save();
                                        }
                                    }
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
                    $thu_teachers = $request->thu_teachers;
                    $thu_room = $request->thu_room;
                    $thu_start = $request->thu_start;
                    $thu_end = $request->thu_end;
                    foreach($thu_curriculums as $index => $data){foreach ($thu_curriculums as $i => $value) {if ($value === null){$thu_curriculums[$i] = "N/A";}}}
                    foreach($thu_teachers as $index => $data){foreach ($thu_teachers as $i => $value) {if ($value === null){$thu_teachers[$i] = "N/A";}}}
                    foreach($thu_room as $index => $data){foreach ($thu_room as $i => $value) {if ($value === null){$thu_room[$i] = "N/A";}}}
                    foreach($thu_start as $index => $data){foreach ($thu_start as $i => $value) {if ($value === null){$thu_start[$i] = "N/A";}}}
                    foreach($thu_end as $index => $data){foreach ($thu_end as $i => $value) {if ($value === null){$thu_end[$i] = "N/A";}}}
                    $thu_max = count($thu_curriculums);
                    for($i=0; $i<=$thu_max-1; $i++){
                        if($thu_curriculums[$i] != "N/A" && $thu_teachers[$i] != "N/A" && $thu_room[$i] != "N/A" && $thu_start[$i] != "N/A" && $thu_end[$i] != "N/A"){
                            $schedule = new Teacher_Schedule;
                            $schedule->day = "thursday";
                            $schedule->section_id = $request->section_id;
                            $schedule->curriculum_id = $thu_curriculums[$i];
                            $schedule->teacher_id = $thu_teachers[$i];
                            $schedule->room = $thu_room[$i];
                            $schedule->start = $thu_start[$i];
                            $schedule->end = $thu_end[$i];
                            $schedule->year_id = $taon;
                            $schedule->semester_id = $semester;
                            $schedule->save();
                            
                            // ADD SUBJECTS WITH NO DUPLICATION
                            $teacher_sub = Teacher_Curriculum::where('section_id', $schedule->section_id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            if(count($teacher_sub) == 0){
                                $new = new Teacher_Curriculum;
                                $new->teacher_id = $schedule->teacher_id;
                                $new->section_id = $schedule->section_id;
                                $new->curriculum_id = $schedule->curriculum_id;
                                $new->year_id = $taon;
                                $new->semester_id = $semester;
                                $new->save();
                            }
                            else{
                                foreach($teacher_sub as $sub){
                                    if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                    {}
                                    elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                        $new = new Teacher_Curriculum;
                                        $new->teacher_id = $schedule->teacher_id;
                                        $new->section_id = $schedule->section_id;
                                        $new->curriculum_id = $schedule->curriculum_id;
                                        $new->year_id = $taon;
                                        $new->semester_id = $semester;
                                        $new->save();
                                    }
                                }
                            }
                            // FOR STUDENTS
                            $students = Student::where('section_id', $request->section_id)->where('status', 'Regular')->where('year_id', $taon)->get();
                            foreach($students as $student){ 
                                $studSched = new Student_Schedule;
                                $studSched->curriculum_id = $schedule->curriculum_id;
                                $studSched->student_id = $student->id;
                                $studSched->section_id = $request->section_id;
                                $studSched->teacher_id = $schedule->teacher_id;
                                $studSched->room = $schedule->room;
                                $studSched->day = "thursday";
                                $studSched->start = $schedule->start;
                                $studSched->end = $schedule->end;
                                $studSched->status = "Regular";
                                $studSched->year_id = $taon;
                                $studSched->semester_id = $semester;
                                $studSched->save();
                
                                $stud_sub = Student_Curriculum::where('student_id', $student->id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('status', 'Regular')->where('year_id', $taon)->where('semester_id', $semester)->get();
                                if(count($stud_sub) == 0){
                                    $bago = new Student_Curriculum;
                                    $bago->student_id = $student->id;
                                    $bago->teacher_id = $schedule->teacher_id;
                                    $bago->section_id = $schedule->section_id;
                                    $bago->curriculum_id = $schedule->curriculum_id;
                                    $bago->status = "Regular";
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
                                            $bago->student_id = $student->id;
                                            $bago->teacher_id = $schedule->teacher_id;
                                            $bago->section_id = $schedule->section_id;
                                            $bago->curriculum_id = $schedule->curriculum_id;
                                            $bago->status = "Regular";
                                            $bago->year_id = $taon;
                                            $bago->semester_id = $semester;
                                            $bago->save();
                                        }
                                    }
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
                    $fri_teachers = $request->fri_teachers;
                    $fri_room = $request->fri_room;
                    $fri_start = $request->fri_start;
                    $fri_end = $request->fri_end;
                    foreach($fri_curriculums as $index => $data){foreach ($fri_curriculums as $i => $value) {if ($value === null){$fri_curriculums[$i] = "N/A";}}}
                    foreach($fri_teachers as $index => $data){foreach ($fri_teachers as $i => $value) {if ($value === null){$fri_teachers[$i] = "N/A";}}}
                    foreach($fri_room as $index => $data){foreach ($fri_room as $i => $value) {if ($value === null){$fri_room[$i] = "N/A";}}}
                    foreach($fri_start as $index => $data){foreach ($fri_start as $i => $value) {if ($value === null){$fri_start[$i] = "N/A";}}}
                    foreach($fri_end as $index => $data){foreach ($fri_end as $i => $value) {if ($value === null){$fri_end[$i] = "N/A";}}}
                    $fri_max = count($fri_curriculums);
                    for($i=0; $i<=$fri_max-1; $i++){
                        if($fri_curriculums[$i] != "N/A" && $fri_teachers[$i] != "N/A" && $fri_room[$i] != "N/A" && $fri_start[$i] != "N/A" && $fri_end[$i] != "N/A"){
                            $schedule = new Teacher_Schedule;
                            $schedule->day = "friday";
                            $schedule->section_id = $request->section_id;
                            $schedule->curriculum_id = $fri_curriculums[$i];
                            $schedule->teacher_id = $fri_teachers[$i];
                            $schedule->room = $fri_room[$i];
                            $schedule->start = $fri_start[$i];
                            $schedule->end = $fri_end[$i];
                            $schedule->year_id = $taon;
                            $schedule->semester_id = $semester;
                            $schedule->save();
                            
                            // ADD SUBJECTS WITH NO DUPLICATION
                            $teacher_sub = Teacher_Curriculum::where('section_id', $schedule->section_id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                            if(count($teacher_sub) == 0){
                                $new = new Teacher_Curriculum;
                                $new->teacher_id = $schedule->teacher_id;
                                $new->section_id = $schedule->section_id;
                                $new->curriculum_id = $schedule->curriculum_id;
                                $new->year_id = $taon;
                                $new->semester_id = $semester;
                                $new->save();
                            }
                            else{
                                foreach($teacher_sub as $sub){
                                    if($sub->curriculum_id == $schedule->curriculum_id && $sub->section_id == $schedule->section_id && $sub->teacher_id == $schedule->teacher_id)
                                    {}
                                    elseif($sub->curriculum_id != $schedule->curriculum_id && $sub->section_id != $schedule->section_id && $sub->teacher_id != $schedule->teacher_id){
                                        $new = new Teacher_Curriculum;
                                        $new->teacher_id = $schedule->teacher_id;
                                        $new->section_id = $schedule->section_id;
                                        $new->curriculum_id = $schedule->curriculum_id;
                                        $new->year_id = $taon;
                                        $new->semester_id = $semester;
                                        $new->save();
                                    }
                                }
                            }
                            // FOR STUDENTS
                            $students = Student::where('section_id', $request->section_id)->where('status', 'Regular')->where('year_id', $taon)->get();
                            foreach($students as $student){ 
                                $studSched = new Student_Schedule;
                                $studSched->curriculum_id = $schedule->curriculum_id;
                                $studSched->student_id = $student->id;
                                $studSched->section_id = $request->section_id;
                                $studSched->teacher_id = $schedule->teacher_id;
                                $studSched->room = $schedule->room;
                                $studSched->day = "friday";
                                $studSched->start = $schedule->start;
                                $studSched->end = $schedule->end;
                                $studSched->status = "Regular";
                                $studSched->year_id = $taon;
                                $studSched->semester_id = $semester;
                                $studSched->save();
                
                                $stud_sub = Student_Curriculum::where('student_id', $student->id)->where('teacher_id', $schedule->teacher_id)->where('curriculum_id', $schedule->curriculum_id)->where('status', 'Regular')->where('year_id', $taon)->where('semester_id', $semester)->get();
                                if(count($stud_sub) == 0){
                                    $bago = new Student_Curriculum;
                                    $bago->student_id = $student->id;
                                    $bago->teacher_id = $schedule->teacher_id;
                                    $bago->section_id = $schedule->section_id;
                                    $bago->curriculum_id = $schedule->curriculum_id;
                                    $bago->status = "Regular";
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
                                            $bago->student_id = $student->id;
                                            $bago->teacher_id = $schedule->teacher_id;
                                            $bago->section_id = $schedule->section_id;
                                            $bago->curriculum_id = $schedule->curriculum_id;
                                            $bago->status = "Regular";
                                            $bago->year_id = $taon;
                                            $bago->semester_id = $semester;
                                            $bago->save();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                
                // CREATING GRADE OF STUDENTS PER SECTION
                $students = Student::where('section_id', $request->section_id)->where('status', 'Regular')->where('year_id', $taon)->get();

                foreach($students as $student)
                {
                    $first = Semester::all()->first();
                    $second = Semester::all()->last();

                    $all_sub = Student_Schedule::with('curriculum')->where('student_id', $student->id)->where('semester_id', $semester)->where('year_id', $taon)->get();

                    $dup_sub = array();
                    foreach($all_sub as $sub){
                        array_push($dup_sub, $sub->curriculum_id);
                    }
                    $final_sub = array_unique($dup_sub);

                    foreach($final_sub as $curr_id){
                        $sched = Student_Schedule::where('curriculum_id', $curr_id)->where('student_id', $student->id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                        foreach($sched as $isked){
                            $grade = new Grade;
                            $grade->student_id = $student->id;
                            $grade->curriculum_id = $curr_id;
                            $grade->teacher_id = $isked->teacher_id;
                            $grade->year_id = $taon;
                            $grade->section_id = $student->section_id;
                            $grade->semester_id = $semester;
                            $grade->q1 = null;
                            $grade->q2 = null;
                            $grade->final = null;
                            
                        }
                        $grade->save();
                    }
                }

                return Redirect::route('students.index');
            }
            
        }
        else{

            // DELETE SUBJECTS OF TEACHER
            $curr_ids = Teacher_Curriculum::all()->where('year_id', $taon)->where('semester_id', $semester);
            $Tid = array();
            
            foreach($sched_ids as $scheds)
            {
                array_push($Tid, $scheds->teacher_id);
            }
            $final = array_unique($Tid);

            foreach($curr_ids as $curs)
            {
                foreach($final as $one){
                   if($one == $curs->teacher_id){
                        $tobe = Teacher_Curriculum::where('teacher_id', $one)->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                        foreach($tobe as $delete){
                            $delete->delete();

                        }
                   }
                }  
            }

            // DELETE SUBJECT OF STUDENT
            $studcurrs = Student_Curriculum::all()->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester);
            // dd($studcurrs);
            $Sid = array();
            
            foreach($studcurrs as $scheds)
            {
                array_push($Sid, $scheds->student_id);
            }
            $studfinal = array_unique($Sid);

            foreach($studcurrs as $curs)
            {
                foreach($studfinal as $one){
                   if($one == $curs->student_id){
                        $tobe = Student_Curriculum::where('student_id', $one)->where('section_id', $id)->where('year_id', $taon)->where('semester_id', $semester)->get();
                        foreach($tobe as $delete){
                            $delete->delete();
                        }
                   }
                }  
            }

            // Delete all schedule of section
            foreach($sched_ids as $id){   
                $delete = Teacher_Schedule::find($id->id);
                $delete->delete();
            }

            // Delete all student schedule
            foreach($stud_ids as $id){   
                $delete = Student_Schedule::find($id->id);
                $delete->delete();
            }

            // Delete all grades of students in section
            foreach($grade_ids as $id){   
                $delete = Grade::find($id->id);
                $delete->delete();
            }
            return Redirect::route('students.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
