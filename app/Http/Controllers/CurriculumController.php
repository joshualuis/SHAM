<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Teacher_Curriculum;
use App\Models\Strand;
use App\Models\Year;
use Yajra\Datatables\Datatables;
use App\Models\User;
use Illuminate\Http\Request;
use View;
use DB;
use Redirect;   
use Illuminate\Support\Facades\Session;

class CurriculumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $curriculums = Curriculum::with('strand')->get();
        // dd($curriculums);
        if ($request->ajax()) {
            $data = Curriculum::with('strand')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'admin.curriculum.action')
                    ->make();
        }
      
        return view('admin.curriculum.index', compact('curriculums'));

       
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.curriculum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $strand = Strand::find($request->strand_id);
        if($strand == null)
        {
            $curriculum = new Curriculum;
            $curriculum->description = $request->description;
            $curriculum->name = $request->name;
            $curriculum->level = $request->level;
            $curriculum->strand_id = 'None';
            $curriculum->save();
        }
        else{
            $curriculum = new Curriculum;
            $curriculum->description = $request->description;
            $curriculum->name = $request->name;
            $curriculum->level = $request->level;
            $curriculum->strand_id = $strand->id;
            $curriculum->save();
        }
        
        // dd($curriculum);
        return Redirect::route('curriculums.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function show(Curriculum $curriculum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curriculum = Curriculum::find($id);

        return View::make('admin.curriculum.edit', compact('curriculum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $curriculum = Curriculum::find($id);
        $curriculum->description = $request->description;
        $curriculum->name = $request->name;
        $curriculum->level = $request->level;
        $curriculum->save();
        return Redirect::route('curriculums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curriculum = Curriculum::find($id);
        $curriculum->delete();
   
        return Redirect::route('curriculums.index');
    }
}
