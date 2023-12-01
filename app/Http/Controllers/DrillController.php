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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DrillController extends Controller
{
    public function drill($id){
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
            // dump($default);
        }
        else{
            $taon = Session::get('schoolyear');
            // dump("AYAN MERON NANG YEAR");
        }

        $strand = Strand::find($id);

        if($strand->code == 'ABM')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'GAS')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'HUMSS')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'STEM')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'CARE')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'EIM')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'HE')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        if($strand->code == 'ICT')
        {
            $sections = Section::with('teacher_schedule')->where('strand_id', $strand->id)->with('teacher')->where('year_id', $taon)->get();
        }

        return View::make('admin.drilldown.drill', compact(
            'sections', 'strand'
        ));

    }

    public function viewStudents($id)
    {
        $section = Section::find($id);
        $students = Student::where('section_id', $id)->orderBy('lname')->get();

        return View::make('admin.drilldown.viewStudents', compact('section', 'students'));
    }
}
