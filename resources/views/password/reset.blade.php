<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<form action="/password/reset" method="post">
   <input type="hidden" name="_token" value="{{ csrf_token() }}">

 <div class="form-group">
   <label for="login-form-email">E-mail</label>
   <input type="email" name="email" id="email" class="form-control" tabindex="1" placeholder="Email" value="{{ old('email') }}">
 </div>

 <div class="form-group">
   <label for="login-form-password">New password</label>
   <input type="password" class="form-control" name="password" id="login-form-password" tabindex="2" placeholder="Password" tabindex="4">
 </div><!-- /.form-group -->

 <div class="form-group">
   <label for="login-form-password-retype">Confirm new password</label>
   <input type="password" class="form-control" name="password_confirmation" id="login-form-password-retype" tabindex="3" placeholder="Confirm password">
 </div><!-- /.form-group -->

 <div class="form-group">
   <input type="submit"  class="btn btn-primary pull-right" name="reset-confirm" id="reset-confirm" tabindex="4" value="Reset Password">
 </div>
</form>
</body>
</html>