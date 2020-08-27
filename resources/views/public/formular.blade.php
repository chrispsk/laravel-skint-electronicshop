@extends('public.master_public')  

@section('continut')
<div class="column" id="fix" style="background-color:#aaa;">
@if($errors->any())
	@foreach ($errors->all() as $eroare)
     <div class="eroare">{{ $eroare }}</div>
	 @endforeach
@endif

	@php 
    $total = 0 
	@endphp

<table id="proTable">	
<tr><th>Product Name</th><th>Price</th><th>Quantity</th></tr>
@foreach($all as $num)
<tr><td>{{$num['pr']->denumire}}</td><td>{{$num['pr']->pret}}</td><td>{{$num['qnt']}}</td></tr>


    @php 
    $total += $num['pr']->pret * $num['qnt']
	@endphp
@endforeach
</table>
TOTAL: {{ $total }}

       <div id="fform">
<form method = "post" action="/comenzi">
@csrf
<label for="fname">Full Name</label>
<input type="text" id="finput" name="nume" placeholder="Name">

<label for="faddress">Address</label>
<input type="text" id="finput" name="adresa" placeholder="Address">

<label for="fphone">Phone</label>
<input type="text" id="finput" name="telefon" placeholder="Phone">

<label for="femail">Email</label>
<input type="text" id="finput" name="email" placeholder="Email">
<input type="submit" id="fsubmit" value="Buy">|<button formaction="/cos" formmethod="GET" id="fsubmit">Go Back</button>
</form> </div>
</div> 
@endsection
