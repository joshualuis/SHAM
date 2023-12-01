<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Year;
use Illuminate\Http\Request;
use View;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

        $sections = Section::with('teacher', 'strand')->where('year_id', $taon)->get()->sortBy('name');

        // dd($sections);
        
        
        return View::make('admin.section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $teachers = Teacher::all()->where('year_id', $taon)->sortBy('fullname');
        $advisors = \App\Models\Section::with('teacher')->where('year_id', $taon)->get();
        $sections = Section::all()->where('year_id', $taon);
        $strands = Strand::pluck('name', '_id');

        // dd($advisors);
        // dd();

        if(count($advisors) == 0){
             $teachers = Teacher::all()->where('year_id', $taon)->sortBy('fullname');
            $diff = array();
            foreach($teachers as $t){
               
               $diff[$t->id] = $t->fullname;
            }
            // dd($diff);
            
            return View::make('admin.section.create', compact('teachers', 'diff', 'strands'));
        }
        else{
            
            foreach($advisors as $advisor)
            {
                if($advisor->teacher_id == 'TBD')
                {
                    $adarr[$advisor->teacher_id] = 'TBD';
                }
                else
                {
                    $adarr[$advisor->teacher_id] = $advisor->teacher->fullname;
                }

            }
            foreach($teachers as $teacher)
            {
                $teacharr[$teacher->_id] = $teacher->fullname;
            }

            $diff = array_diff($teacharr, $adarr);

            // dd($diff);
            
            return View::make('admin.section.create', compact('teachers', 'diff', 'strands'));
        }

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        // dd($request);
        if(empty($request->input('teacher_id'))){
            $section = new Section;
            $section->year_id = $taon;
            $section->name = $request->name;
            $section->room = $request->room;
            $section->glevel = $request->glevel;
            $section->strand_id = $request->strand_id;
            $section->fullname = $request->glevel . '-' . $request->name;
            $section->teacher_id = "TBD";
            
            $section->save();
            return Redirect::route('sections.index');
        }
        else {
            $section = new Section;
            $section->year_id = $taon;
            $section->name = $request->name;
            $section->room = $request->room;
            $section->glevel = $request->glevel;
            $section->strand_id = $request->strand_id;
            $section->teacher_id = $request->teacher_id;
            $section->fullname = $request->glevel . '-' . $request->name;
            $section->save();
            return Redirect::route('sections.index');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
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
        // dd("nice");
        $section = \App\Models\Section::with('teacher')->where('year_id', $taon)->find($id);
        // dd($section->teacher_id);
         $teachers = Teacher::all()->where('year_id', $taon)->sortBy('fullname');
        $strands = Strand::pluck('name', '_id');
        // dd($strands);
        $advisors = \App\Models\Section::with('teacher')->where('year_id', $taon)->get();
        foreach($advisors as $advisor)
        {
            if($advisor->teacher_id == 'TBD')
            {
                $adarr[$advisor->teacher_id] = 'TBD';
            }
            else
            {
                $adarr[$advisor->teacher_id] = $advisor->teacher->fullname;
            }

        }
        foreach($teachers as $teacher)
        {
            $teacharr[$teacher->_id] = $teacher->fullname;
        }

        // dd($teacharr, $adarr);

        
        if($section->teacher_id == 'TBD')
        {
            $diff = array_diff($teacharr, $adarr);
        }
        else
        {
            $diff = array_diff($teacharr, $adarr);
            $diff[$section->teacher->_id] = $section->teacher->fullname;
        }

        // dd($strands);
        
        return View::make('admin.section.edit', compact('section', 'diff', 'strands'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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

        if(empty($request->input('teacher_id'))){
            $section = Section::find($id);
            $section->year_id = $taon;
            $section->name = $request->name;
            $section->room = $request->room;
            $section->glevel = $request->glevel;
            $section->strand_id = $request->strand_id;
            $section->fullname = $request->glevel . '-' . $request->name;
            $section->teacher_id = "TBD";
            $section->save();
            return Redirect::route('sections.index');
        }
        else {
            $section = Section::find($id);
            $section->year_id = $taon;
            $section->name = $request->name;
            $section->room = $request->room;
            $section->glevel = $request->glevel;
            $section->strand_id = $request->strand_id;
            $section->fullname = $request->glevel . '-' . $request->name;
            $section->teacher_id = $request->teacher_id;
            $section->save();
            return Redirect::route('sections.index');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);

        // dd($section);
        $section->delete();
   
        return Redirect::route('sections.index');
    }

}
