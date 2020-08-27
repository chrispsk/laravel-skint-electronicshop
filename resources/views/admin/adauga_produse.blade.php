@extends('admin.master_admin')

@section('continut')
<br>
<center>
@if($errors->any())
	@foreach ($errors->all() as $eroare)
     <div style="color:red;">{{ $eroare }}</div>
	 @endforeach
@endif
</center>
@if(session()->has("msj"))
	<br>
	<center>
ADD PRODUCT<br>
<form method="POST" action="/admin/produse/process" enctype='multipart/form-data'>
@csrf
<input type="text" name="denumire" placeholder="Denumire" id="logInput"> <br>
<input type="text" name="pret" placeholder="Pret" id="logInput"> <br>
<input type="file" name="poza" id="logSubmit">►(best 800x800) <br>
<textarea name="detalii" placeholder="Detalii Produs"></textarea><br>
<input type="submit" value="Add Product" id="logSubmit"><br>
<button type="submit" formaction="/admin" formmethod="GET" id="backAdmin">Back To Admin</button>
</form>
</center>
@else
NOT LOGGED IN	
@endif
@endsection
