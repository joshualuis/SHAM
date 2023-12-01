<?php

namespace App\Http\Controllers;

use App\Models\Year;
use App\Models\Teacher;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Redirect;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $years = Year::all()->sortBy('year');
        // dd($years);
        if ($request->ajax()) {
            $data = Year::orderBy('year', 'ASC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'admin.year.action')
                    ->make();
        }
      
        return view('admin.year.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $years = Year::all();
        // $prev = $years->nth(2)->last();

        // $all = Teacher::where('year_id', '6445e01fcb27bbd957004b12')->get();
        // $reg = Registration::where('year_id', '6445e01fcb27bbd957004b12')->get();

        // dd($all, $reg);
        // foreach($reg as $r)
        // {
        //     $r->delete();
        // }
        // foreach($all as $d)
        // {
        //     $d->delete();
        // }
        // dd('DONE');
        // $selectYear = array("2021-2022", "2022-2023", "2023-2024", "2024-2025", "2025-2026", "2026-2027", "2027-2028", "2028-2029", "2029-2030", "2030-2031");
        $year = Year::all()->last();
        $parts = explode("-", $year->year);

        $currentYear = $parts[1];
        $selectYear = array();
        for ($i = 0; $i < 20; $i++) {
            $startYear = $currentYear + $i;
            $endYear = $startYear + 1;
            $selectYear[] = $startYear . '-' . $endYear;
        }

        return view('admin.year.create', compact('selectYear'));
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
        $new = new Year;
        $new->year = $request->schooltaon;
        $new->principal = strtoupper($request->principal);
        $new->title = $request->title;
        $new->save();

        $last = Year::get()->last();

        $open = new Registration;
        $open->start = $request->start;
        $open->end = $request->end;
        $open->status = $request->status;
        $open->abm = $request->abm;
        $open->gas = $request->gas;
        $open->humss = $request->humss;
        $open->stem = $request->stem;
        $open->care = $request->care;
        $open->he = $request->he;
        $open->eim = $request->eim;
        $open->ict = $request->ict;

        $open->wabm = $request->wabm;
        $open->wgas = $request->wgas;
        $open->whumss = $request->whumss;
        $open->wstem = $request->wstem;
        $open->wcare = $request->wcare;
        $open->whe = $request->whe;
        $open->weim = $request->weim;
        $open->wict = $request->wict;

        $open->year_id = $last->id;
        $open->save();

        Session::put('schoolyear', $last->id);

        // PASS ALL TEACHER FROM PREVIOUS YEAR
        $years = Year::all();
        $prev = $years->nth(2)->last();
        $prev_teachers = Teacher::where('year_id', $prev->id)->get();

        foreach($prev_teachers as $oldT)
        {
            $newT = new Teacher;
            $newT->position = $oldT->position;
            $newT->numberofteaching = $oldT->numberofteaching;
            $newT->fname = $oldT->fname;
            $newT->mname = $oldT->mname;
            $newT->lname = $oldT->lname;
            $newT->contact = $oldT->contact;
            $newT->email = $oldT->email;
            $newT->image = $oldT->image;
            $newT->gender = $oldT->gender;
            // $newT->age = $oldT->age;
            $newT->civilstatus = $oldT->civilstatus;
            $newT->birthdate = $oldT->birthdate;

            $birthdate = new \DateTime($newT->birthdate);
            $currentDate = new \DateTime();
            $newT->age = $currentDate->diff($birthdate)->y;

            $newT->address = $oldT->address;
            $newT->certificate = $oldT->certificate;
            $newT->major = $oldT->major;
            $newT->minor = $oldT->minor;
            $newT->coordinator = $oldT->coordinator;
            $newT->year_id = $last->id;
            $newT->fullname = $oldT->fullname;
            $newT->educattainment = $oldT->educattainment;
            $newT->save();
        }
        // dd($secondToLastYear);
        $teachers = Teacher::all()->where('year_id', );
        
        return Redirect::route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(Year $year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        return view('admin.year.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Year $year)
    {
        $year->principal = strtoupper($request->principal);
        $year->title = $request->title;
        $year->update();
        return Redirect::route('years.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Year $year)
    {
        //
    }
}
