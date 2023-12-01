<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
// use App\Models\Applicant_Studentaddress;
// use App\Models\Applicant_Parent;
// use App\Models\Applicant_Studentinfo;
use Illuminate\Validation\Rule;
use App\Models\Teacher;
use App\Models\Strand;
use App\Models\Shortlisted;
use App\Models\Section;
use App\Models\Year;
use Illuminate\Http\Request;
use View;
use Redirect;
use DB;
use Yajra\Datatables\Datatables;
use App\Models\Registration;
use Illuminate\Support\Facades\Session;
use Auth;
use DateTime;
use Validator;
use App\Rules\PhoneNumber;
use Twilio\Rest\Client;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class ApplicantController extends Controller
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
                // $strand = 'Accountancy, Business and Management';
                $applicants = Applicant::where('status', 'applicant')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('year_id', $taon)->get()->sortByDesc('created_at');
                // dd($applicants);
                // $applicants = Applicant::all();
            }
            if($user->role == 'ABM'){
                // $strand = 'Accountancy, Business and Management';
                $applicants = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'GAS'){
                // $strand = 'General Academic';
                $applicants = Applicant::all()->where('firstchoice', 'General Academic')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'HUMSS'){
                // $strand = 'Humanities and Social Sciences';
                $applicants = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'STEM'){
                // $strand = 'Science, Technology, Engineering and Mathematics';
                $applicants = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'CARE'){
                // $strand = 'Caregiving (Nursing Arts)';
                $applicants = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'EIM'){
                // $strand = 'Electrical Installation and Maintenance';
                $applicants = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'HE'){
                // $strand = 'Home Economics';
                $applicants = Applicant::all()->where('firstchoice', 'Home Economics')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
            if($user->role == 'ICT'){
                // $strand = 'Information and Communications Technology';
                $applicants = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->whereNotIn('reschedCount', ['1', '2'])->whereNotIn('intStat', ['UNATTENDED', 'VOID'])->where('status', 'applicant')->where('year_id', $taon);
            }
    
        }
       
        $strands = Strand::pluck('_id', 'name');
        $sections = Section::pluck('_id', 'name');

        if ($request->ajax()) {
            $data = $applicants;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="toEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->addColumn('action', 'applicant.viewaction')
                    ->rawColumns(['checkbox', 'action'])
                    ->make();


        }
        // dd($request->ajax());
      
        return view('applicant.index',compact('applicants', 'strands', 'sections', 'year'));
    }

    public function emailedRemove($id)
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
        // dd($taon);
        $year = Year::find($taon);

        $applicant = Applicant::find($id);
        $applicant->emailStat = 'UNATTENDED';
        $applicant->intStat = 'UNATTENDED';
        $applicant->update();

        // SEND EMAIL TO ALL SHORTLISTEDS
        // $mail_data = [
        //     'recipient' => 'joshualuis.tanap@gmail.com',
        //     'from' => 'shamwebandmobile@gmail.com',
        //     'subject' => 'Application Update',
        //     'body' => $formattedDate,
        //     'fullname' => $applicant->fullname
        // ];

        // \Mail::send('email-template', $mail_data, function($message) use($mail_data){
        //     $message->to($mail_data['recipient'])
        //     ->from($mail_data['from'])
        //     ->subject($mail_data['subject']);
        // }); 
        
        return view('applicant.emailed', compact('year')); 

    }

    public function unattended(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        $check = $this->allUpdate();

        $year = Year::find($taon);
        $user = Auth::user();
        if($user->role == 'admin'){
            $applicants = Applicant::where('emailStat', 'UNATTENDED')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('year_id', $taon)->get()->sortByDesc('created_at');
        }
        if($user->role == 'ABM'){
            // $strand = 'Accountancy, Business and Management';
            $applicants = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'GAS'){
            // $strand = 'General Academic';
            $applicants = Applicant::all()->where('firstchoice', 'General Academic')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'HUMSS'){
            // $strand = 'Humanities and Social Sciences';
            $applicants = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'STEM'){
            // $strand = 'Science, Technology, Engineering and Mathematics';
            $applicants = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'CARE'){
            // $strand = 'Caregiving (Nursing Arts)';
            $applicants = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'EIM'){
            // $strand = 'Electrical Installation and Maintenance';
            $applicants = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'HE'){
            // $strand = 'Home Economics';
            $applicants = Applicant::all()->where('firstchoice', 'Home Economics')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }
        if($user->role == 'ICT'){
            // $strand = 'Information and Communications Technology';
            $applicants = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('reschedStat', '!=', 'emailed')->where('reschedCount', '!=', '2')->where('emailStat', 'UNATTENDED')->where('year_id', $taon);
        }

        // dd($applicants);
        if ($request->ajax()) {
            $data = $applicants;
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="toEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->addColumn('action', 'applicant.resched.unattendAction')
                    ->rawColumns(['checkbox', 'action'])
                    ->make();
        }
        // dd($request->ajax());
      
        return view('applicant.resched.unattended',compact('applicants', 'year'));

    }

    public function revert ($id)
    {
        // dd($id);
        $applicant = Applicant::find($id);   
        $dateString = $applicant->intDate;
        $date = Carbon::createFromFormat('F d, Y, h:i A', $dateString);
        $dateTime = $date->format('Y-m-d\TH:i');

        return view('applicant.resched.edit',compact('applicant', 'dateTime'));
    }

    public function revertUpdate(Request $request, $id)
    {
        
        // $datetimeLocalValue = "2023-04-28T10:13";
        $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->intDate);
        $formattedDate = $date->format('F d, Y, h:i A');

        $find = Applicant::find($id);
        $find->emailStat = "emailed";
        $find->intStat = "";
        $find->intDate = $formattedDate;
        $find->update();

        return Redirect::route('applicant.unattended');
        
    }


    public function showRequest(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        $year = Year::find($taon);
        $user = Auth::user();
        {
            if($user->role == 'admin'){
                // $strand = 'Accountancy, Business and Management';
                $applicants = Applicant::where('reschedStat', 'YES')->where('year_id', $taon)->get()->sortByDesc('created_at');
                // dd($applicants);
                // $applicants = Applicant::all();
            }
            if($user->role == 'ABM'){
                // $strand = 'Accountancy, Business and Management';
                $applicants = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'GAS'){
                // $strand = 'General Academic';
                $applicants = Applicant::all()->where('firstchoice', 'General Academic')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'HUMSS'){
                // $strand = 'Humanities and Social Sciences';
                $applicants = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'STEM'){
                // $strand = 'Science, Technology, Engineering and Mathematics';
                $applicants = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'CARE'){
                // $strand = 'Caregiving (Nursing Arts)';
                $applicants = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'EIM'){
                // $strand = 'Electrical Installation and Maintenance';
                $applicants = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'HE'){
                // $strand = 'Home Economics';
                $applicants = Applicant::all()->where('firstchoice', 'Home Economics')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
            if($user->role == 'ICT'){
                // $strand = 'Information and Communications Technology';
                $applicants = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('reschedStat', 'YES')->where('year_id', $taon);
            }
        }
        

        // dd($applicants);
        if ($request->ajax()) {
            $data = $applicants;
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', 'applicant.request.requestAction')    
                    ->rawColumns(['checkbox', 'action'])
                    ->make();
        }
        // dd($request->ajax());
      
        return view('applicant.resched.unattended',compact('applicants', 'year'));
    }

    public function editRequest($id)
    {
        // dd($id);
        $applicant = Applicant::find($id);   
        $dateString = $applicant->intDate;
        $date = Carbon::createFromFormat('F d, Y, h:i A', $dateString);
        $dateTime = $date->format('Y-m-d\TH:i');

        // dd();
        return view('applicant.request.editRequest',compact('applicant', 'dateTime'));
    }

    public function updateRequest(Request $request, $id)
    {   
        $date = Carbon::createFromFormat('Y-m-d\TH:i', $request->reschedInt);
        $formattedDate = $date->format('F d, Y, h:i A');

        $find = Applicant::find($id);
        $find->emailStat = "emailed";
        $find->intStat = "";
        $find->reschedStat = "emailed";
        $find->reschedInt = $formattedDate;
        $find->intDate = $formattedDate;

        // dd($find);
        $find->update();

        // SEND EMAIL TO ALL SHORTLISTEDS
        // $mail_data = [
        //     'recipient' => 'joshualuis.tanap@gmail.com',
        //     'from' => 'shamwebandmobile@gmail.com',
        //     'subject' => 'Application Update',
        //     'body' => $formattedDate,
        //     'fullname' => $find->fullname
        // ];

        // \Mail::send('email-requestInterview', $mail_data, function($message) use($mail_data){
        //     $message->to($mail_data['recipient'])
        //     ->from($mail_data['from'])
        //     ->subject($mail_data['subject']);
        // }); 

        return Redirect::route('applicant.unattended');
    }

    public function allUpdate()
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }

        $currentTime = Carbon::now();

        // FIRST UNATTENDED
        $all = Applicant::raw(function ($collection) use ($taon) {
            return $collection->find([
                '$and' => [
                    ['emailStat' => ['$ne' => "Not Yet"]],
                    ['status' => ['$ne' => 'enrolled']],
                    ['year_id' => $taon],
                ],
            ]);
        });
        foreach ($all as $a) {
            if(!isset($a->reschedStat))
            {
                $intDate = Carbon::createFromFormat('F j, Y, g:i A', $a->intDate);
                if ($intDate < $currentTime) {
                    $find = Applicant::find($a->id);
                    $find->emailStat = 'UNATTENDED';
                    $find->intStat = 'UNATTENDED';
                    $find->update();
                }
            }
        }
        
        // VOIDED
        $void = Applicant::raw(function ($collection) use ($taon) {
            return $collection->find([
                '$and' => [
                    ['reschedCount' => '1'],
                    ['year_id' => $taon],
                ],
            ]);
        });
        foreach ($void as $v) {
            $intDate = Carbon::createFromFormat('F j, Y, g:i A', $v->intDate);
            if ($intDate < $currentTime) {
                $find = Applicant::find($v->id);
                $find->intStat = 'VOID';
                $find->reschedCount = '2';
                $find->update();
            }
        }


    }

    public function emailed(Request $request)
    {

        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $user = Auth::user();
        $check = $this->allUpdate();
        $reg = Registration::where('year_id', $taon)->get()->first();
        $year = Year::find($taon);
        // dd($reg);
        if($user->role == 'admin'){
            $applicants = [];
            
            if($reg != null)
            {
                $abms = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->abm);
                $gas = Applicant::all()->where('firstchoice', 'General Academic')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->gas);
                $humss = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->humss);
                $stem = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->stem);

                $care = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->care);
                $eim = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->eim);
                $he = Applicant::all()->where('firstchoice', 'Home Economics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->he);
                $ict = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->ict);
            }
            else{
                $abms = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
                $gas = Applicant::all()->where('firstchoice', 'General Academic')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
                $humss = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
                $stem = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);

                $care = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
                $eim = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
                $he = Applicant::all()->where('firstchoice', 'Home Economics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
                $ict = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon);
            }
            
            foreach($abms as $a){$applicants[] = $a;}
            foreach($gas as $a){$applicants[] = $a;}
            foreach($humss as $a){$applicants[] = $a;}
            foreach($stem as $a){$applicants[] = $a;}
            foreach($care as $a){$applicants[] = $a;}
            foreach($eim as $a){$applicants[] = $a;}
            foreach($he as $a){$applicants[] = $a;}
            foreach($ict as $a){$applicants[] = $a;}
        }
        if($user->role == 'ABM'){
            // $strand = 'Accountancy, Business and Management';
            $applicants = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->abm);
        }
        if($user->role == 'GAS'){
            // $strand = 'General Academic';
            $applicants = Applicant::all()->where('firstchoice', 'General Academic')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->gas);
        }
        if($user->role == 'HUMSS'){
            // $strand = 'Humanities and Social Sciences';
            $applicants = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->humss);
        }
        if($user->role == 'STEM'){
            // $strand = 'Science, Technology, Engineering and Mathematics';
            $applicants = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->stem);
        }
        if($user->role == 'CARE'){
            // $strand = 'Caregiving (Nursing Arts)';
            $applicants = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->care);
        }
        if($user->role == 'EIM'){
            // $strand = 'Electrical Installation and Maintenance';
            $applicants = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->eim);
        }
        if($user->role == 'HE'){
            // $strand = 'Home Economics';
            $applicants = Applicant::all()->where('firstchoice', 'Home Economics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->he);
        }
        if($user->role == 'ICT'){
            // $strand = 'Information and Communications Technology';
            $applicants = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->take($reg->ict);
        }

        $all = collect($applicants)->sortByDesc('updated_at');
        
        if ($request->ajax()) {
            $data = $all;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="toEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->addColumn('action', 'applicant.action')
                    ->rawColumns(['checkbox', 'action'])
                    ->make();
        }
        // dd($request->ajax());
      
        return view('applicant.emailed',compact('applicants', 'year'));
    }

    public function wait(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $user = Auth::user();
        $reg = Registration::where('year_id', $taon)->get()->first();

        if($user->role == 'admin'){
            $wait = [];

            $Wabms = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->abm)->take(20);
            $Wgas = Applicant::all()->where('firstchoice', 'General Academic')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->gas)->take(20);
            $Whumss = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->humss)->take(20);
            $Wstem = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->stem)->take(20);

            $Wcare = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->care)->take(20);
            $Weim = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->eim)->take(20);
            $Whe = Applicant::all()->where('firstchoice', 'Home Economics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->he)->take(20);
            $Wict = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->ict)->take(20);
            foreach($Wabms as $a){$wait[] = $a;}
            foreach($Wgas as $a){$wait[] = $a;}
            foreach($Whumss as $a){$wait[] = $a;}
            foreach($Wstem as $a){$wait[] = $a;}
            foreach($Wcare as $a){$wait[] = $a;}
            foreach($Weim as $a){$wait[] = $a;}
            foreach($Whe as $a){$wait[] = $a;}
            foreach($Wict as $a){$wait[] = $a;}
        }
        if($user->role == 'ABM'){
            // $strand = 'Accountancy, Business and Management';
            $wait = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->abm)->take(20);
        }
        if($user->role == 'GAS'){
            // $strand = 'General Academic';
            $wait = Applicant::all()->where('firstchoice', 'General Academic')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->gas)->take(20);
        }
        if($user->role == 'HUMSS'){
            // $strand = 'Humanities and Social Sciences';
            $wait = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->humss)->take(20);
        }
        if($user->role == 'STEM'){
            // $strand = 'Science, Technology, Engineering and Mathematics';
            $wait = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->stem)->take(20);
        }
        if($user->role == 'CARE'){
            // $strand = 'Caregiving (Nursing Arts)';
            $wait = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->care)->take(20);
        }
        if($user->role == 'EIM'){
            // $strand = 'Electrical Installation and Maintenance';
            $wait = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->eim)->take(20);
        }
        if($user->role == 'HE'){
            // $strand = 'Home Economics';
            $wait = Applicant::all()->where('firstchoice', 'Home Economics')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->he)->take(20);
        }
        if($user->role == 'ICT'){
            // $strand = 'Information and Communications Technology';
            $wait = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('status', 'applicant')->where('emailStat', 'emailed')->where('year_id', $taon)->skip($reg->ict)->take(20);
        }
        
        $all = collect($wait)->sortByDesc('updated_at');

        if ($request->ajax()) {
            $data = $all;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="toEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
        // dd($request->ajax());
      
        return view('applicant.emailed',compact('wait'));
    }

    public function createEmail(Request $request)
    {
        // $all = Applicant::all();
        $q = $request->toEnlist;
        $w = $request->abmtoEnlist;
        $e = $request->gastoEnlist;
        $r = $request->humsstoEnlist;
        $t = $request->stemtoEnlist;
        $y = $request->caretoEnlist;
        $u = $request->eimtoEnlist;
        $i = $request->hetoEnlist;
        $o = $request->icttoEnlist;


        $mainEnlist = array();
        // dd($q,$w,$e,$r,$t,$y,$u,$i,$o);
        if (!is_null($q)) {
            $mainEnlist = array_merge($mainEnlist, $q);
        }
        if (!is_null($w)) {
            $mainEnlist = array_merge($mainEnlist, $w);
        }
        if (!is_null($e)) {
            $mainEnlist = array_merge($mainEnlist, $e);
        }
        if (!is_null($r)) {
            $mainEnlist = array_merge($mainEnlist, $r);
        }
        if (!is_null($t)) {
            $mainEnlist = array_merge($mainEnlist, $t);
        }
        if (!is_null($y)) {
            $mainEnlist = array_merge($mainEnlist, $y);
        }
        if (!is_null($u)) {
            $mainEnlist = array_merge($mainEnlist, $u);
        }
        if (!is_null($i)) {
            $mainEnlist = array_merge($mainEnlist, $i);
        }
        if (!is_null($o)) {
            $mainEnlist = array_merge($mainEnlist, $o);
        }

        // dd($mainEnlist == null);

        if($mainEnlist == null)
        {
            return redirect()->back();
        }
        
        

        if($mainEnlist != null){
            if(Session::missing('schoolyear')){
                $default = Year::all()->last();
                $taon = $default->id;
            }
            else{
                $taon = Session::get('schoolyear');
            }
    
            $role = Auth::user()->role;
            if($role == 'ABM'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7b883e464e6d2a0eb52b')->pluck('name', '_id');
            }
            if($role == 'GAS'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7b9a3e464e6d2a0eb52c')->pluck('name', '_id');
            }
            if($role == 'HUMSS'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7bac3e464e6d2a0eb52d')->pluck('name', '_id');
            }
            if($role == 'STEM'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7be23e464e6d2a0eb52e')->pluck('name', '_id');
            }
            if($role == 'CARE'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c273e464e6d2a0eb52f')->pluck('name', '_id');
            }
            if($role == 'EIM'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c3a3e464e6d2a0eb530')->pluck('name', '_id');
            }
            if($role == 'HE'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c613e464e6d2a0eb531')->pluck('name', '_id');
            }
            if($role == 'ICT'){
                $sections = Section::where('year_id', $taon)->where('glevel', '11')->where('strand_id', '63de7c6f3e464e6d2a0eb532')->pluck('name', '_id');
            }
    
            // $people = $_GET['toEnlist'];
    
            // dd($people);
    
            $arr_applicant = array();
    
            foreach($mainEnlist as $id)
            {
                $applicant = Applicant::where('_id', '=', $id)->where('year_id', $taon)->get();
                
                array_push($arr_applicant, $applicant);
            }
            // dd($arr_applicant);
            return View::make('applicant.createEmail', compact('arr_applicant'));
        }

        
       
    }

    public function isOnline($site = "https://youtube.com/")
    {
        if(@fopen($site, "r")){
            return true;
        }
        else{
            return false;
        }
    }

    public function emailing(Request $request)
    {
        $date = new DateTime($request->date);
        $formattedDate = $date->format('F j, Y, g:i A');
        $people = $_POST['arr'];

        if($this->isOnline()){
            // dd("HAHA");
            foreach($people as $id)
            {
                $applicant = Applicant::find($id);

                if($applicant->emailStat == 'emailed')
                {}
                else{
                    $applicant->emailStat = 'emailed';
                    $applicant->intDate = $formattedDate;
                    
                    // SEND EMAIL TO ALL SHORTLISTEDS
                    $mail_data = [
                        'recipient' => 'joshualuis.tanap@gmail.com',
                        'from' => 'shamwebandmobile@gmail.com',
                        'subject' => 'Application Update',
                        'body' => $formattedDate,
                        'fullname' => $applicant->fullname
                    ];

                    \Mail::send('email-template', $mail_data, function($message) use($mail_data){
                        $message->to($mail_data['recipient'])
                        ->from($mail_data['from'])
                        ->subject($mail_data['subject']);
                    }); 
                }
                $applicant->update();
            }

            return Redirect::route('applicants.index');

        }
        else{
            return redirect()->back()->withInput()->with('error', 'Check your interet connection');
        }
        
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
        // dd($taon);
        $year = Year::find($taon);

        $open = Registration::get()->first();

        $year_id = $open->year_id;
      

        $currentDate = date('Y-m-d h:i:s');
        $currentDate = date('Y-m-d h:i:s', strtotime($currentDate));

        $startDate = date('Y-m-d h:i:s', strtotime($open->start));
        $endDate = date('Y-m-d h:i:s', strtotime($open->end));

        if (strtotime($currentDate) < strtotime($startDate) || strtotime($currentDate) > strtotime($endDate)) {
            $open->status = 'Close';
            $open->update();
        }
        
        if ($currentDate >= $startDate && $currentDate <= $endDate && $open->status == 'Open') {
            return View::make('applicant.create', compact('year_id', 'year'));
        } else {
            
            Alert::warning('EARLY REGISTRATION FOR THE NEXT SCHOOL YEAR IS STILL CLOSE.', '');
            return redirect('/');
        }
        
        
    }

    public function appshort(){
        dd("HEY");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), 
        // [
        //     'email' => ['required', 'email', 'unique:applicants,email', 'ends_with:@gmail.com'],
        // ]);

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
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'There was an error with your submission.');
         }

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

        // dd($randomString);
        // dd($image);
        // ----------------------------------- APPLICANT STORE
        if ($request->hasFile('image') && $request->hasFile('reportcard') && $request->hasFile('birthcertificate')){

            $applicant = new Applicant;
            
            $reg = Registration::get()->first();
            $yearr = $reg->year_id;
            $applicant->year_id = $yearr;
            // $applicant->year_id = $request->year_id;
            
            $applicant->studentstatus = $request->studentstatus;
            $applicant->lrnstat = $request->lrnstat;
            $applicant->gradetoenroll = 'Grade 11';
            // $applicant->presentgrade = 'Grade 12';
            $applicant->section = $request->section;
            $applicant->yeartofinish = $request->yeartofinish;
            $applicant->image = $request->image;
            $applicant->lastschoolattended = $request->lastschoolattended;
            $applicant->lastschooladdress = $request->lastschooladdress;
            $applicant->schoolid = $request->schoolid;
            $applicant->schooltype = $request->schooltype;
            $applicant->schooltoenroll = 'Signal Village National High School';
            $applicant->schooladdress = 'Ballecer St., Central Signal Village, Taguig City';
            $applicant->semester = 'First Semester';

            $image = time().$imageString.'.'.$request->file('image')->extension();
            $request->file('image')->move(public_path('storage/images'), $image);
            $input['image'] = 'storage/images/'.$image;
            $applicant->image = $input['image'];

            $reportcard = time().$repString.'.'.$request->file('reportcard')->extension();
            $request->file('reportcard')->move(public_path('storage/images'), $reportcard);
            $rinput['reportcard'] = 'storage/images/'.$reportcard;
            $applicant->reportcard = $rinput['reportcard'];

            $birthcertificate = time().$birthString.'.'.$request->file('birthcertificate')->extension();
            $request->file('birthcertificate')->move(public_path('storage/images'), $birthcertificate);
            $binput['birthcertificate'] = 'storage/images/'.$birthcertificate;
            $applicant->birthcertificate = $binput['birthcertificate'];
    
            $applicant->firstchoice = $request->firstchoice;
            $applicant->secondchoice = $request->secondchoice;
            $applicant->thirdchoice = $request->thirdchoice;
    
            if($request->firstchoice == "Accountancy, Business and Management" || 
            $request->firstchoice == "Science, Technology, Engineering and Mathematics" ||
            $request->firstchoice == "General Academic Track" ||
            $request->firstchoice == "Humanities and Social Sciences")
            {
                $applicant->track = "Academic";
            }
            else{
                $applicant->track = "Tech-Voc";
            }

            $applicant->englishgrade = $request->englishgrade;
            $applicant->mathgrade = $request->mathgrade;
            $applicant->sciencegrade = $request->sciencegrade;
            $applicant->filipinograde = $request->filipinograde;

            $gwa = ((int)$request->mathgrade + (int)$request->englishgrade + (int)$request->filipinograde + (int)$request->sciencegrade) / 4;
            $applicant->gwa = (string)$gwa;

            $applicant->status = "applicant";
    
            $applicant->lrn = $request->lrn;
            $applicant->psanumber = $request->psanumber;
            $applicant->email = $request->email;
            $applicant->fname = mb_strtoupper($request->fname, 'UTF-8');
            if($request->mname == 'N/A' || $request->mname == null)
            {
                $applicant->mname = 'N/A';
            }
            else{
                $applicant->mname = mb_strtoupper($request->mname, 'UTF-8');
            }
            $applicant->lname = mb_strtoupper($request->lname, 'UTF-8');
            $applicant->extname = mb_strtoupper($request->extname, 'UTF-8');

            $comma=",";
            if($applicant->extname == 'N/A' && $applicant->mname == 'N/A'){
                $applicant->fullname = collect([mb_strtoupper($applicant->lname, 'UTF-8').$comma, mb_strtoupper($applicant->fname, 'UTF-8')])->implode(' ');
            }
            elseif($applicant->extname == 'N/A' && $applicant->mname != 'N/A'){
                $applicant->fullname = collect([mb_strtoupper($applicant->lname, 'UTF-8').$comma, mb_strtoupper($applicant->fname, 'UTF-8'), mb_strtoupper($applicant->mname, 'UTF-8')])->implode(' ');
            }
            elseif($applicant->extname != 'N/A' && $applicant->mname == 'N/A'){
                $applicant->fullname = collect([mb_strtoupper($applicant->lname, 'UTF-8').$comma, mb_strtoupper($applicant->fname, 'UTF-8'), mb_strtoupper($applicant->extname, 'UTF-8')])->implode(' ');
            }
            else{
                $applicant->fullname = collect([mb_strtoupper($applicant->lname, 'UTF-8').$comma, strtoupper($applicant->fname, 'UTF-8'), mb_strtoupper($applicant->mname, 'UTF-8'), mb_strtoupper($applicant->extname, 'UTF-8')])->implode(' ');
            }

            $applicant->birthdate = $request->birthdate;
            $birthdate = new \DateTime($applicant->birthdate);
            $currentDate = new \DateTime();
            $applicant->age = $currentDate->diff($birthdate)->y;


            $applicant->gender = $request->gender;
            $applicant->contact = $request->contact;
            $applicant->mothertongue = $request->mothertongue;
            $applicant->religion = $request->religion;

            $applicant->indipeople = $request->indipeople;
            $applicant->specialneeds = $request->specialneeds;
            $applicant->assistivedevices = $request->assistivedevices;

            // INDI
            if($applicant->indipeople == 'No'){
                $applicant->yesindipeople = 'N/A';
            }
            elseif ($applicant->indipeople == 'Yes' && $request->yesindipeople != null){
                $applicant->yesindipeople = $request->yesindipeople;
            }
            
            // SPECIAL
            if($applicant->specialneeds == 'No'){
                $applicant->yesspecialneeds = 'N/A';
            }
            elseif ($applicant->specialneeds == 'Yes' && $request->yesspecialneeds != null){
                $applicant->yesspecialneeds = $request->yesspecialneeds;
            }

            // ASSIST
            if($applicant->assistivedevices == 'No'){
                $applicant->yesassistivedevices = 'N/A';
            }
            elseif ($applicant->assistivedevices == 'Yes' && $request->yesassistivedevices != null){
                $applicant->yesassistivedevices = $request->yesassistivedevices;
            }
    
            $applicant->mothername = $request->mothername;
            $applicant->mothereducation = $request->mothereducation;
            $applicant->motheremployment = $request->motheremployment;
            $applicant->motherworkstat = $request->motherworkstat;
            $applicant->mothercontact = $request->mothercontact;
            $applicant->fathername = $request->fathername;
            $applicant->fathereducation = $request->fathereducation;
            $applicant->fatheremployment = $request->fatheremployment;
            $applicant->fatherworkstat = $request->fatherworkstat;
            $applicant->fathercontact = $request->fathercontact;
            $applicant->guardianname = $request->guardianname;
            $applicant->guardianeducation = $request->guardianeducation;
            $applicant->guardianemployment = $request->guardianemployment;
            $applicant->guardianworkstat = $request->guardianworkstat;
            $applicant->guardiancontact = $request->guardiancontact;
    
            $applicant->housestreet = $request->housestreet;
            $applicant->barangay = $request->barangay;
            $applicant->city = $request->city;
            $applicant->province = $request->province;
            $applicant->region = $request->region;
            $applicant->emailStat = 'Not Yet';
    
            // dd($applicant);
            $applicant->save();

            $find = Applicant::where('email', $request->email)->get()->first();
            $year = Year::find($request->year_id);

            // SEND EMAIL TO ALL SHORTLISTEDS
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

            // SMS NOTIFICATION
            // $receiver_number = "+639267468786";
            // $message = "Good day " . $applicant->fullname . " ! We received your application. This is your application ticket: " . $find->id . " Check your applciation updates in our website https://seniorhigh-svnhs.com/ticket. ";


            // try 
            // {
            //     $account_sid = "AC8143bbb8b6e1d705c1e3f00db55945f2";
            //     $auth_token = "a37879190b87eff968fec2d69f597a00";
            //     $twilio_number = "+16073605684";

            //     $client = new Client($account_sid, $auth_token);
            //     $client->messages->create($receiver_number, [
            //         'from' => $twilio_number, 
            //         'body' => $message
            //     ]);
            // } 
            // catch (Exception $e) 
            // {
            //     dd("Error: ". $e->getMessage());
            // }
  
        }


        return Redirect::route('landing');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $applicant = Applicant::find($id);

        return View::make('applicant.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicant = Applicant::find($id);
        $date = date('Y-m-d\TH:i', strtotime($applicant->intDate));
        // dd($date);
        return view('applicant.edit',compact('applicant', 'date'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        $applicant = Applicant::find($id);
        $applicant->intDate = date('F j, Y, g:i A', strtotime($request->intDate));
        
        // SEND EMAIL TO ALL SHORTLISTEDS
        $mail_data = [
            'recipient' => 'joshualuis.tanap@gmail.com',
            'from' => 'shamwebandmobile@gmail.com',
            'subject' => 'Application Update',
            'body' => $applicant->intDate,
            'fullname' => $applicant->fullname
        ];

        \Mail::send('email-reschedule', $mail_data, function($message) use($mail_data){
            $message->to($mail_data['recipient'])
            ->from($mail_data['from'])
            ->subject($mail_data['subject']);
        }); 

        $applicant->update();
        return Redirect::route('applicants.emailed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $applicant = Applicant::find($id);
        $applicant->delete();
   
        return Redirect::route('applicants.index');
    }


    public function abmTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        // $regs = Registration::get()->first();
        if($reg == null)
        {
            $abm = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('year_id', $taon);
        }
        else{
            $abm = Applicant::all()->where('firstchoice', 'Accountancy, Business and Management')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->abm);
        }
    
        if ($request->ajax()) {
            $data = $abm;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="abmtoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
      
        return view('applicant.index',compact('abm'));
    }

    public function gasTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $gas = Applicant::all()->where('firstchoice', 'General Academic')->where('year_id', $taon);
        }
        else{
            $gas = Applicant::all()->where('firstchoice', 'General Academic')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->gas);
        }
        
        if ($request->ajax()) {
            $data = $gas;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="gastoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
      
        return view('applicant.index',compact('gas'));
    }

    public function humssTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $humss = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('year_id', $taon);
        }
        else{
            $humss = Applicant::all()->where('firstchoice', 'Humanities and Social Sciences')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->humss);
        }

        if ($request->ajax()) {
            $data = $humss;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="humsstoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
    
        return view('applicant.index',compact('humss'));
    }

    public function stemTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $stem = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('year_id', $taon);
        }
        else{
            $stem = Applicant::all()->where('firstchoice', 'Science, Technology, Engineering and Mathematics')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->stem);
        }
    
        if ($request->ajax()) {
            $data = $stem;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="stemtoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
    
        return view('applicant.index',compact('stem'));
    }

    public function careTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $care = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('year_id', $taon);
        }
        else{
            $care = Applicant::all()->where('firstchoice', 'Caregiving (Nursing Arts)')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->care);
        }
        
        if ($request->ajax()) {
            $data = $care;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="caretoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
    
        return view('applicant.index',compact('care'));
    }

    public function eimTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $eim = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('year_id', $taon);
        }
        else{
            $eim = Applicant::all()->where('firstchoice', 'Electrical Installation and Maintenance')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->eim);
        }

        if ($request->ajax()) {
            $data = $eim;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="eimtoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
    
        return view('applicant.index',compact('eim'));
    }

    public function heTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $he = Applicant::all()->where('firstchoice', 'Home Economics')->where('year_id', $taon);
        }
        else{
            $he = Applicant::all()->where('firstchoice', 'Home Economics')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->he);
        }

        if ($request->ajax()) {
            $data = $he;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="hetoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
    
        return view('applicant.index',compact('he'));
    }

    public function ictTop(Request $request)
    {
        if(Session::missing('schoolyear')){
            $default = Year::all()->last();
            $taon = $default->id;
        }
        else{
            $taon = Session::get('schoolyear');
        }
        $reg = Registration::where('year_id', $taon)->get()->first();
        if($reg == null)
        {
            $ict = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('year_id', $taon);
        }
        else{
            $ict = Applicant::all()->where('firstchoice', 'Information and Communications Technology')->where('year_id', $taon)->sortByDesc('gwa')->take($reg->ict);
        }

        if ($request->ajax()) {
            $data = $ict;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('checkbox', function($row){
                        return '<input type="checkbox" name="icttoEnlist[]" value="'.$row['id'].'"><label></label>';
                    })
                    ->rawColumns(['checkbox'])
                    ->make();
        }
    
        return view('applicant.index',compact('ict'));
    }

    public function ticket()
    {
        return view('application-status');
    }

    public function ticketUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            '_id' => ['required', 'exists:applicants,_id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Ticket does not exist');
         }

        $find = Applicant::find($request->_id);
        if($find->emailStat == 'Not Yet' || $find->emailStat == null)
        {
            $message = 'Your application is still on process.';
            return redirect()->back()->with('message', $message);
        }
        elseif($find->emailStat == 'emailed')
        {
            $message = 'Your application has been processed. Please check your email for the scheduled interview.';
            return redirect()->back()->with('message', $message);
        }
        elseif($find->emailStat == "UNATTENDED" && $find->requestCount = "1")
        {
            $message = 'Interview unattended. You can request once';
            $request = 'yes';
            return redirect()->back()->with(['message' => $message, 'request' => $request]);
        }
        
    }

    public function resched()
    {
        return view('resched.resched');
    }

    public function reschedEdit(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            '_id' => ['required', 'exists:applicants,_id'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'There was an error with your submission.');
         }

        $find = Applicant::find($request->_id);
        if($request->_id == $find->id && $request->birthdate == $find->birthdate 
        // && $find->emailStat == 'emailed' && $find->reschedStat != 'YES' && $find->reschedCount != "1"
        )
        {

            return view('resched.details',compact('find'));
        }
        else
        {
            $message = 'Incorrect Credentials or Application voided';
        }
        
        return redirect()->back()->with('message', $message);
    }

    public function reschedUpdate(Request $request)
    {
        $find = Applicant::find($request->id);
        $find->reschedStat = 'YES';
        $find->reschedReason = $request->reason;
        $find->reschedCount = "1";
        $find->update();
        
        Alert::warning('Request submitted! Wait 1-3 days for processing', '');
        return redirect('/');
    
    }


    

}
