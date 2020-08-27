@extends('public.master_public')  

@section('continut')
<div class="column" id="fix" style="background-color:#aaa;">

@if($errors->any())
	@foreach ($errors->all() as $eroare)
     <div style="color:red;">{{ $eroare }}</div>
	 @endforeach
@endif

@if(session()->has("ord"))
{{session("ord")}}
@endif


@if(session("cart") == false)
	<div style="color:red;">Cos is empty!</div>

@else

	@php 
    $total = 0 
	@endphp

	
@foreach($all as $num)

<form>
@csrf
{{$num['pr']->denumire}} | Price:{{$num['pr']->pret}}
<input type="text" id="finput" name="qu" value="{{$num['qnt']}}">
<input type="hidden" name="_method" value="PUT">
<input type="hidden" name="hi" value="{{$num['pr']->idP}}">
<button type="submit" formaction="/cos" formmethod="POST" name="del" value="as1" id="fsubmit">DELETE</button>
<button type="submit" formaction="/cos" formmethod="POST" name="upd" value="as2" id="fsubmit">UPDATE</button> 
</form> 
<br>

@php 
    $total += $num['pr']->pret * $num['qnt']
@endphp


@endforeach


TOTAL: {{ $total }} 

@endif

<a href="/comenzi/date-user">Buy</a>

</div> 
@endsection


  