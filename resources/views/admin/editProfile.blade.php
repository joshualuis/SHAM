@extends('layouts.master')

@section('title')
PROFILE
@endsection

@section('pagetitle')
   PROFILE
@endsection

@section('css')

@endsection

@section('content')
{{ Form::model($admin,['method'=>'PATCH' ,'route' => ['admin.updateProfile', $admin->_id, 'files' => true], 'enctype' => 'multipart/form-data']) }}
@csrf
<div class="container-fluid">       
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="card-title">Change User Profile</h4>
                </div>

                <div class="card-content">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lrn" class="control-label">Name</label>
                                    {{ Form::text('name',null,array('class'=>'form-control','id'=>'lrn')) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="psanumber" class="control-label">Email.</label>
                                    {{ Form::text('email',null,array('class'=>'form-control','id'=>'psanumber')) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="control-label">Role</label>
                                    {{ Form::text('role',null,array('class'=>'form-control','id'=>'email', 'disabled' => true)) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fname" class="control-label">Account Status</label>
                                    {{ Form::text('status',null,array('class'=>'form-control','id'=>'fname', 'disabled' => true)) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Change Profile Photo</label><br>
                                    <img src= "{{URL::asset($admin->image)}}" style="width:100px; height:100px; margin-left:10px;" /> <br><br>
                                    <input class="form-control" type="file" id="image" name="image" value="{{old('image')}}" placeholder="Upload image" style="text-transform:uppercase" >
                                </div>
                            </div>
                    </div>

                            <div class="row"><br>
                                <div class="col-sm-12" >
                                <div class="form-group pull-right">
                                    <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button>
                                    <a href="javascript:history.back()" id="cancelBtn" onclick="showNotification('top','center')" class="btn btn-wd" role="button">Cancel</a>
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

@endsection


