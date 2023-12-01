<?php

namespace App\Http\Controllers;

use App\Models\Strand;
use Illuminate\Http\Request;
use View;
use DB;
use Redirect;
use Illuminate\Support\Facades\Session;

class StrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strands = Strand::all();
        // foreach($strands as $strand)
        // {
        //     dump($strand->section);
        // }
        // dd($strands);
        
        return View::make('admin.strand.index', compact('strands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('admin.strand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $strand = new Strand;
        $strand->name = $request->name;
        $strand->code = $request->code;
        $strand->description = $request->description;     
        $strand->save();
        return Redirect::route('strands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Strand $strand
     * @return \Illuminate\Http\Response
     */
    public function show(Strand $strand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $strand = Strand::find($id);
        return View::make('admin.strand.edit', compact('strand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $strand = Strand::find($id);
        $strand->name = $request->name;
        $strand->code = $request->code;
        $strand->description = $request->description;
        $strand->save();
        return Redirect::route('strands.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Strand  $strand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $strand = Strand::find($id);
        $strand->delete();
   
        return Redirect::route('strands.index');
    }
}
