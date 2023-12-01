@extends('layouts.master')

@section('title')
  OPEN REGISTRATION
@endsection

@section('pagetitle')
   OPEN REGISTRATION
@endsection

@section('css')
@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <a href="javascript:history.back()">
        <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	      </button>
      </a><br><br>
	    
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">OPEN A NEW REGISTRATION</h4>
	      </div>
	      
        <div class="card-content">
        {!! Form::open(['route' => 'registrations.store']) !!}
            @csrf
            <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Status<star>*</star></label>
                    {!! Form::select('status', ['Open' => 'Open', 'Close' => 'Close'], null,['placeholder' => 'Select','class' => 'form-control']) !!}                 </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Start<star>*</star></label>
                    {{ Form::datetimeLocal('start',null,array('class'=>'form-control')) }}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">End<star>*</star></label>
                    {{ Form::datetimeLocal('end',null,array('class'=>'form-control')) }}
                  </div>
                </div>
              </div>
              <label class="control-label"><h5>Target Number of Applicants per Strand</h5></label>

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">ABM<star>*</star></label>
                    <input class="form-control" type="number" id="abm" name="abm" value="{{old('abm')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">GAS<star>*</star></label>
                    <input class="form-control" type="number" id="gas" name="gas" value="{{old('gas')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">HUMSS<star>*</star></label>
                    <input class="form-control" type="number" id="humss" name="humss" value="{{old('humss')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">STEM<star>*</star></label>
                    <input class="form-control" type="number" id="stem" name="stem" value="{{old('stem')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">CARE<star>*</star></label>
                    <input class="form-control" type="number" id="care" name="care" value="{{old('care')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">HE<star>*</star></label>
                    <input class="form-control" type="number" id="he" name="he" value="{{old('he')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">EIM<star>*</star></label>
                    <input class="form-control" type="number" id="eim" name="eim" value="{{old('eim')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">ICT<star>*</star></label>
                    <input class="form-control" type="number" id="ict" name="ict" value="{{old('ict')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

              </div>


                <div class="row">
                  <br>
                  <div class="col-sm-12" >
                    <div class="form-group pull-right">
                      <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button>
                      <a href="javascript:history.back()" id="cancelBtn" onclick="showNotification('top','center')" class="btn btn-wd" role="button">Cancel</a>
                    </div>
                  </div> 
                </div>

              <br>

              {!! Form::close() !!} 
	      </div>
	    </div>
	  </div>
  </div>
</div>





@endsection

@section('script')

  
@endsection

              