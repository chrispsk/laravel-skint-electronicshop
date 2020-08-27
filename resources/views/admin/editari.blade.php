@extends('admin.master_admin')

@section('continut')
<br>
@if(session()->has("msj"))
	<br>
<center>
AICI EDITARE PRODUSE (stergere, update)<br>
<form method="POST" enctype="multipart/form-data">
@csrf
<label>Product Name</label><br>
<input type="text" name="denumire" value="{{$as[1]}}" id="logInput"><br>
<label>Price</label><br>
<input type="text" name="pret" value="{{$as[2]}}" id="logInput">
<br>
<img src="{{ asset('images/'.$as[3]) }}" alt="Forest" style="width:10%;">
<label>Picture</label><br>
<input type="file" name="addPic" id="logSubmit">►(best 800x800)<br>
<input type="hidden" name="pname" value="{{$as[3]}}">
<input type="hidden" name="idd" value="{{$as[0]}}">
<label>Details Product</label><br>
 <textarea name="detalii">{{$as[4]}}</textarea> 
<input type="hidden" name="_method" value="PUT"><br>
<button type="submit" formaction="/admin/produse/editare" formmethod="POST" name="upd" value="as2" id="logSubmit">UPDATE</button> <br>
<button type="submit" formaction="/admin/produse/editare" formmethod="POST" name="del" value="as1" id="logSubmit">DELETE</button><br>
<button type="submit" formaction="/admin" formmethod="GET" id="backAdmin">Back To Admin</button>
</form>
<center>
@else
NOT LOGGED IN	
@endif
@endsection
