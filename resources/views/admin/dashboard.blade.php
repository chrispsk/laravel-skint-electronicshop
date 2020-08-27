@extends('admin.master_admin')

@section('continut')
<br>
@if(session()->has("msj"))
	<center>
<br><br><br><br>
<form>
<button type="submit" formaction="/admin/produse" formmethod="GET" id="logSubmit">List Of Products</button><br>
<button type="submit" formaction="/admin/comenzi" formmethod="GET" id="logSubmit">List Of Orders</button>
</form>
</center>
@else
NOT LOGGED IN	
@endif
@endsection



