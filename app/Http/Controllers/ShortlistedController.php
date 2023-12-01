<?php

namespace App\Http\Controllers;

use App\Models\Shortlisted;
use App\Models\Strand;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Applicant;
use App\Models\User;
use Redirect;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Yajra\Datatables\Datatables;
use App\Models\Year;
use Illuminate\Support\Facades\Session;
use Auth;


class ShortlistedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $user = Auth::user();

        {
            if($user->role == 'admin'){
                // $strand = 'Accountancy, Business, Management';
                $shortlisted = Shortlisted::all()->where('year_id', $taon)->where('status', 'shortlisted');
            }
            if($user->role == 'ABM'){
                // $strand = 'Accountancy, Business, Management';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Accountancy, Business and Management')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'GAS'){
                // $strand = 'General Academic Strand';
                $shortlisted = Shortlisted::all()->where('strand_name', 'General Academic Strand')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'HUMSS'){
                // $strand = 'Humanities and Social Sciences';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Humanities and Social Sciences')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'STEM'){
                // $strand = 'Science, Technology, Engineering, Mathematics';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Science, Technology, Engineering, Mathematics')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'CARE'){
                // $strand = 'Caregiving (Nursing Arts)';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Caregiving (Nursing Arts)')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'EIM'){
                // $strand = 'Electrical Installation and Maintenance';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Electrical Installation and Maintenance')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'HE'){
                // $strand = 'Home Economics';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Home Economics')->where('status', 'shortlisted')->where('year_id', $taon);
            }
            if($user->role == 'ICT'){
                // $strand = 'Information and Communications Technology';
                $shortlisted = Shortlisted::all()->where('strand_name', 'Information and Communications Technology')->where('status', 'shortlisted')->where('year_id', $taon);
            }
        
        }
        $all = collect($shortlisted)->sortByDesc('updated_at');
        
        if ($request->ajax()) {
            $data = $all;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'admin.shortlisted.action')
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="sl_checkbox" data-id="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox','action'])
                    ->make();


        }
      
        return View('admin.shortlisted.index', compact('shortlisted', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd("HEY");
        if($request->toEnlist == null)
        {
            return redirect()->back()->withErrors(['Students' => 'No selected Student']);
        }

        if($request->toEnlist != null){
            if(Session::missing('schoolyear')){
                $default = Year::all()->last();
                $taon = $default->id;
            }
            else{
                $taon = Session::get('schoolyear');
            }
    
            $role = Auth::user()->role;
            if($role == 'admin')
            {
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->orderBy('name')->pluck('name', '_id');
                $strands = Strand::pluck('name', '_id');
            }
            if($role == 'ABM'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7b883e464e6d2a0eb52b')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'GAS'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7b9a3e464e6d2a0eb52c')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'HUMSS'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7bac3e464e6d2a0eb52d')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'STEM'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7be23e464e6d2a0eb52e')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'CARE'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c273e464e6d2a0eb52f')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'EIM'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c3a3e464e6d2a0eb530')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'HE'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c613e464e6d2a0eb531')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
            if($role == 'ICT'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c6f3e464e6d2a0eb532')->pluck('name', '_id');
                $strands = Strand::where('code', $role)->pluck('name', '_id');
            }
    
            $people = $_GET['toEnlist'];
    
            $arr_applicant = array();
    
            foreach($people as $id)
            {
                $applicant = Applicant::where('_id', '=', $id)->where('year_id', $taon)->get();
                
                array_push($arr_applicant, $applicant);
            }
            // dd($arr_applicant);
            return View::make('admin.shortlisted.create', compact('arr_applicant', 'sections', 'strands'));
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
        // dd($request);
        $role = Auth::user()->role;
        $people = $_POST['arr'];

        if($this->isOnline()){
            foreach($people as $id)
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
                $strand = Strand::where('code', $role)->get()->first();

                $appli = Applicant::where('_id', '=', $id)->where('year_id', $taon)->get();

                $section = Section::with('strand')->find($request->section_id);
                $shortlisted = new Shortlisted;
                $shortlisted->year_id = $taon;
                $shortlisted->strand_id = $section->strand_id;
                $shortlisted->section_id = $request->section_id;
                $shortlisted->status = "shortlisted";
                $shortlisted->strand_name = $section->strand->name;
                $shortlisted->section_name = $section->name;

                foreach($appli as $app)
                {
                    $comma=",";
                    if($app->extname == 'N/A'){
                        $shortlisted->name = collect([strtoupper($app->lname).$comma, strtoupper($app->fname), strtoupper($app->mname)])->implode(' ');
                    }
                    else{
                        $shortlisted->name = collect([strtoupper($app->lname).$comma, strtoupper($app->fname), strtoupper($app->mname), strtoupper($app->extname)])->implode(' ');
                    }
                    
                    $shortlisted->applicant_id = $app->id;
                    $app->status = "shortlisted";
                    $app->update(); 

                    // SEND EMAIL TO ALL SHORTLISTEDS

                    $mail_data = [
                        'recipient' => 'joshualuis.tanap@gmail.com',
                        'from' => 'shamwebandmobile@gmail.com',
                        'subject' => 'Application Update',
                        'body' => 'You passed the interview. Please wait for another email confirming your credentials before logging in in https://seniorhigh-svnhs.com/',
                        'fullname' => $shortlisted->name,
                    ];

                    \Mail::send('email-shortlisted', $mail_data, function($message) use($mail_data){
                        $message->to($mail_data['recipient'])
                        ->from($mail_data['from'])
                        ->subject($mail_data['subject']);
                    });
                    
                }
                $shortlisted->save();
            }

            return Redirect::route('applicants.emailed');

        }
        else{
            return redirect()->back()->withInput()->with('error', 'Check your interet connection');
        }
        
    }

    public function isOnline($site = "https://youtube.com/"){
        if(@fopen($site, "r")){
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shortlisted  $shortlisted
     * @return \Illuminate\Http\Response
     */
    public function show(Shortlisted $shortlisted)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shortlisted  $shortlisted
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
        $shortlisted =  Shortlisted::find($id);
        $sections = Section::where('year_id', $taon)->pluck('name', '_id');

        // dd($shortlisted);

        return View::make('admin.shortlisted.edit', compact('shortlisted', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *s
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shortlisted  $shortlisted
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shortlisted =  Shortlisted::find($id);
        $shortlisted->section_id = $request->section_id;

        $section = Section::find($request->section_id);
        $strand = Strand::find($section->strand_id);
        $shortlisted->section_name = $section->name;
        $shortlisted->strand_name = $strand->name;
        
        $shortlisted->update();

        return Redirect::route('shortlisteds.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shortlisted  $shortlisted
     * @return \Illuminate\Http\Response
     */

    // public function schedule($id)
    // {
    //     $find = Shortlisted::find($id);

    //     dd($find);
    //     return view::
    // }
    public function destroy($id)
    {
        // dd("HEY");
        $shortlisted = Shortlisted::find($id);
        $applicant = Applicant::find($shortlisted->applicant_id);
        //$user = User::where('applicant_id', $shortlisted->applicant_id)->get();
        // dd($user);
        $applicant->status = "applicant";
        $applicant->update();
        // dd($applicant->status);
        $shortlisted->delete();
   
        return Redirect::route('shortlisteds.index');
    }

}
