<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Registration;
use App\Models\Year;
use DateTime;
use Illuminate\Http\Request;
use View;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registration::all();
        // $registrations = DB::table('registrations')->select('_id')->get();
        
        return View::make('admin.registration.index', compact('registrations'));
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
        }
        else{
            $taon = Session::get('schoolyear');
        }

        // $year = Year::find($taon);
        // dd($year);
        
        // $selectYear = array("2021-2022", "2022-2023", "2023-2024", "2024-2025", "2025-2026", "2026-2027", "2027-2028", "2028-2029", "2029-2030", "2030-2031");
        // $years = Year::all();

        // foreach($years as $y)
        // {
        //     if(($key = array_search($y->year, $selectYear)) !== false){
        //         unset($selectYear[$key]);
        //     }
        // }
        // return View::make('admin.registration.create', compact('selectYear'));
        return View::make('admin.registration.create');
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
        }
        else{
            $taon = Session::get('schoolyear');
        }

        $allReg = Registration::all();

        foreach($allReg as $reg){
            $reg->status = 'Close';
            $reg->update();
        }

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
        $open->year_id = $taon;

        //Deadline
        $open->deadStat = 'Close';
        $open->deadStart = '';
        $open->deadEnd = '';
        
        $open->save();

        // dd($last->id);
        return Redirect::route('admin.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registration = Registration::find($id);
        return View::make('admin.registration.edit', compact('registration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->abm);
        $register = Registration::find($id);
        $register->start = $request->start;
        $register->end = $request->end;
        $register->status = $request->status;
        $register->abm = $request->abm;
        $register->gas = $request->gas;
        $register->humss = $request->humss;
        $register->stem = $request->stem;
        $register->care = $request->care;
        $register->he = $request->he;
        $register->eim = $request->eim;
        $register->ict = $request->ict;

        $register->wabm = $request->wabm;
        $register->wgas = $request->wgas;
        $register->whumss = $request->whumss;
        $register->wstem = $request->wstem;
        $register->wcare = $request->wcare;
        $register->whe = $request->whe;
        $register->weim = $request->weim;
        $register->wict = $request->wict;

        $register->update();
        return Redirect::route('admin.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $Registration)
    {
        //
    }

    public function deadline($id)
    {
        $deadline = Registration::find($id);

        return View::make('admin.deadline.edit', compact('deadline'));
    }

    public function deadUpdate(Request $request, $id)
    {
        // dd($request);
        $ded = Registration::find($id);
        $ded->deadStat = $request->deadStat;
        $ded->deadStart = $request->deadStart;
        $ded->deadEnd = $request->deadEnd;
        // dd($ded);
        $ded->update();

        return Redirect::route('admin.dashboard');
    }
}
