@extends('layouts.master')

@section('title')
  CHANGE PASSWORD
@endsection

@section('pagetitle')
CHANGE PASSWORD
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

	    <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">EDITING RECORD</h4>
          </div>
          
          <div class="card-content">
          {{ Form::model($user,['method'=>'POST','route' => ['admin.userUpdate', $user->_id, 'files' => true]]) }}
              @method('PATCH')
              @csrf
              

                <div class="form-group">
                  <label class="control-label">Name<star>*</star></label>
                  {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}

                  @if ($errors->has('name'))
                      <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label class="control-label">Email<star>*</star></label>
                  {{ Form::text('email',null,array('class'=>'form-control','id'=>'email')) }}

                  @if ($errors->has('email'))
                      <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                  @endif
                </div>

                <div class="form-group">
                  <label class="control-label">Change Password<star>*</star></label>
                  <input type="password" class="form-control" name="password">

                  @if ($errors->has('password'))
                    <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                  @endif

                </div>

             
                  
                <div class="row">
                  <div class="col-sm-12" >
                    <div class="form-group pull-right">
                      <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button>
                    </div>
                  </div> 
                </div>
            
          </div>
        </div>
	    </div>

	  </div>
  </div>
</div>

@endsection

@section('script')
    
@endsection
