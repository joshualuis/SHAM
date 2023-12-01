@extends('layouts.master')

@section('title')
    Change Password
@endsection

@section('pagetitle')
    Change Password
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
                        </div>
	                    <div class="col-md-6">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><B>Change Password</b></h4>
	                                <p class="category"></p>
	                            </div>

                                <div class="card-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if(session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif

                                            <div class="alert alert-danger" id="error-message" style="display:none;"></div>
                                            <form method="POST" action="{{ route('user.changePass') }}" onsubmit="return validatePassword()">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="current_password">Current Password</label>
                                                        <input class="form-control border-input" id="current_password" type="password" name="current_password" required >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="password">New Password</label>
                                                        <input class="form-control border-input" id="password" type="password" name="password" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="password_confirmation">Confirm New Password</label>
                                                        <input class="form-control border-input" id="password_confirmation" type="password" name="password_confirmation" required>
                                                    </div>
                                                </div>

                                                <div class="text-center">
                                                    <button class="btn btn-info btn-fill btn-wd" type="submit">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
	                        </div>
                        </div>
                    </div>
                </div>


@endsection

@section('script')
<script>
function validatePassword() {
  var newPassword = document.getElementById("password").value;
  var confirmNewPassword = document.getElementById("password_confirmation").value;
  var errorMessage = document.getElementById("error-message");

  if (newPassword != confirmNewPassword) {
    alert("New password and confirm new password must match.");
    $('#error-message').show(); 

    document.getElementById("password").value = "";
    document.getElementById("password_confirmation").value = "";
    document.getElementById("current_password").value = "";

    errorMessage.innerText = "Please enter your password again.";
    errorMessage.style.display = "block";

    return false;
  }

  errorMessage.style.display = "none";
  $('#error-message').hide(); 
  return true;
}
</script>

@endsection