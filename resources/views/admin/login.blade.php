@extends('admin.master_admin')
@section('continut')
<br><br>
<center>
<form method="POST" action="/login">
@csrf
<input type="text" name="user" placeholder="Username" id="logInput"> <br>
<input type="password" name="pass" placeholder="Password" id="logInput"> <br>
<input type="submit" value="Submit" id="logSubmit">
</form>
</center>
@endsection



