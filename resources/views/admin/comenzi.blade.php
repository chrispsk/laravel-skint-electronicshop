@extends('admin.master_admin')

@section('continut')
<br>
@if(session()->has("msj"))
	<br>
VIZUALIZARE LISTA COMENZI<br>
{!!$content!!}
<br>
<form>
<button type="submit" formaction="/admin" formmethod="GET" id="backAdmin">Back To Admin</button>
</form>
@else
NOT LOGGED IN	
@endif
@endsection
