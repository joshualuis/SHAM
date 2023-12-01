@extends('layouts.master')

@section('title')
  TEACHERS
@endsection

@section('pagetitle')
  TEACHERS 
@endsection

@section('css')

@endsection

@section('content')




<div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <a href="/admin/years">
        <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	      </button>
      </a><br><br>
	    
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">EDITING RECORD</h4>
	      </div>
	      
        <div class="card-content">
        {{ Form::model($year, ['method' => 'PATCH', 'route' => ['years.update', $year->_id], 'files' => true, 'enctype' => 'multipart/form-data']) }}
            @csrf
            <div class="row">

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Principal<star>*</star></label>
                    {{ Form::text('principal',null,array('class'=>'form-control','id'=>'principal')) }}                 
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                      <label class="control-label">Title<star>*</star></label>
                      {{ Form::text('title',null,array('class'=>'form-control','id'=>'title')) }}                 
                    </div>
                  </div>
                </div>

              <div class="row">
                <br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="/admin/years" class="btn btn-wd" role="button">Cancel</a>
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
