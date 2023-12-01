<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LOGIN</title>

    <link href="assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="popup">
	<div class="form">
    <form method="POST" action="/login">
                        @csrf

		<h2>LOGIN</h2>
		
		<div class="form-elemet">
			@if ($errors->has('message'))
				<div class="alert alert-danger">{{ $errors->first('message') }}</div>
			@endif
		</div>

		<div class="form-element">
			<label for="email">Email</label>
			<input id="email" placeholder="Enter your email"type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

		</div>
		<div class="form-element">
			<label for="password">Password</label>
			<input id="password"placeholder="Enter your password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

		</div>
		<div class="form-element">
			<input type="checkbox" id="remember" name="remember">
			<label for="remember-me">Remember me</label>
		</div>
		<div class="form-element">
			<button> {{ __('Login') }}</button>
		</div>
		
        </form>
		</div>
	</div>
</body>
</html>