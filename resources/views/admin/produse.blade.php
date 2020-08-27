@extends('admin.master_admin')

@section('continut')

@if(session()->has("msj"))
	<center>
@if(session()->has("ok"))
	<br><br>
	<h3 id="someEffect" style="color:red;">{{session("ok")}}</h3>
    <script type="text/javascript">
   $("#someEffect").fadeOut(3000);
</script>
@endif 
<br>
<br>
<form>
@foreach($det as $k => $v)
<button formaction="/admin/pro/{{$k}}" formmethod="GET" id="logSubmit">{{$v}}</button><br>
@endforeach
</form>

<br>
<form>
<button formaction="/admin/produse/adauga" formmethod="GET" id="fsubmit">Add New Product</button><br>
<button type="submit" formaction="/admin" formmethod="GET" id="backAdmin">Back To Admin</button>
</form>
</center>
@else
NOT LOGGED IN	
@endif
@endsection
